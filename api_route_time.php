<?php
import('ttTimeHelper');

function handle_req_time($params,$body,$user) {
    $action = "add";
    // cl_client, $cl_task, $cl_project,  $cl_start, $cl_finish, $cl_duration, $cl_billable=1
    if(count($params)>0) {
        $action = $params[0];
    }
    
    switch($action) {
        case 'add':
            echo json_encode(add_time_entry($body));
            break;
    }
}

function add_time_entry($time_entry) {
    global $user, $err, $i18n;
    $cl_client = null; $cl_task = null; $cl_project = null;  $cl_start = null; $cl_finish = null; $cl_duration = null; $cl_billable=1;
    
    $config = new ttConfigHelper($user->getConfig());
    $showClient = $user->isPluginEnabled('cl');
    $trackingMode = $user->getTrackingMode();
    $showProject = MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode;
    $showTask = MODE_PROJECTS_AND_TASKS == $trackingMode;
    $taskRequired = false;
    $recordType = $user->getRecordType();
    $showStart = TYPE_START_FINISH == $recordType || TYPE_ALL == $recordType;
    $showDuration = TYPE_DURATION == $recordType || TYPE_ALL == $recordType;
    $oneUncompleted = $config->getDefinedValue('one_uncompleted');

    extract($time_entry, EXTR_OVERWRITE);
    $selected_date = new ttDate($cl_date);

    if ($showTask) $taskRequired = $config->getDefinedValue('task_required');

    // Validate user input.
    if ($showClient && $user->isOptionEnabled('client_required') && !$cl_client){
      $i18n->add('error.client');
      return;
    }
    // Validate input in time custom fields.
    if (isset($custom_fields) && $custom_fields->timeFields) {
      foreach ($timeCustomFields as $timeField) {
        // Validation is the same for text and dropdown fields.
        if (!ttValidString($timeField['value'], !$timeField['required'])) $err->add($i18n->get('error.field'), htmlspecialchars($timeField['label']));
      }
    }
    if ($showProject) {
      if (!$cl_project) $err->add($i18n->get('error.project'));
    }
    if ($showTask && $taskRequired) {
      if (!$cl_task) $err->add($i18n->get('error.task'));
    }
    if (strlen($cl_duration) == 0) {
      if ($cl_start || $cl_finish) {
        if (!ttTimeHelper::isValidTime($cl_start))
          $err->add($i18n->get('error.field'), $i18n->get('label.start'));
        if ($cl_finish) {
          if (!ttTimeHelper::isValidTime($cl_finish))
            $err->add($i18n->get('error.field'), $i18n->get('label.finish'));
          if (!ttTimeHelper::isValidInterval($cl_start, $cl_finish))
            $err->add($i18n->get('error.interval'), $i18n->get('label.finish'), $i18n->get('label.start'));
        }
      } else {
        if ($showStart) {
          $err->add($i18n->get('error.empty'), $i18n->get('label.start'));
          $err->add($i18n->get('error.empty'), $i18n->get('label.finish'));
        }
        if ($showDuration)
          $err->add($i18n->get('error.empty'), $i18n->get('label.duration'));
      }
    } else {
      if (false === ttTimeHelper::postedDurationToMinutes($cl_duration))
        $err->add($i18n->get('error.field'), $i18n->get('label.duration'));
    }
    if (!ttValidString($cl_note, true)) $err->add($i18n->get('error.field'), $i18n->get('label.note'));
    if ($user->isPluginEnabled('tp') && !ttValidTemplateText($cl_note)) {
      $err->add($i18n->get('error.field'), $i18n->get('label.note'));
    }
    // Finished validating user input.

    // Prohibit creating entries in future.
    if (!$user->isOptionEnabled('future_entries')) {
      $server_tomorrow = new ttDate();
      $server_tomorrow->incrementDay();
      if ($selected_date->after($server_tomorrow))
        $err->add($i18n->get('error.future_date'));
    }

    // Prohibit creating entries in locked range.
    if ($user->isDateLocked($selected_date))
      $err->add($i18n->get('error.range_locked'));

    // Prohibit creating another uncompleted record.
    if ($err->no() && $oneUncompleted) {
      if (($not_completed_rec = ttTimeHelper::getUncompleted($user_id)) && (($cl_finish == '') && ($cl_duration == '')))
        $err->add($i18n->get('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->get('error.goto_uncompleted')."</a>");
    }

    // Prohibit creating an overlapping record.
    if ($err->no()) {
      if (ttTimeHelper::overlaps($user_id, $cl_date, $cl_start, $cl_finish))
        $err->add($i18n->get('error.overlap'));
    }
    
    // Insert record.
    if ($err->no()) {
      $id = ttTimeHelper::insert(array(
        'date' => $cl_date,
        'client' => $cl_client,
        'project' => $cl_project,
        'task' => $cl_task,
        'start' => $cl_start,
        'finish' => $cl_finish,
        'duration' => $cl_duration,
        'note' => $cl_note,
        'billable' => $cl_billable));

      // Insert time custom fields if we have them.
      $result = true;
      if ($id && isset($custom_fields) && $custom_fields->timeFields) {
        $result = $custom_fields->insertTimeFields($id, $timeCustomFields);
      }

      if ($id && $result && $err->no()) {
        return array('id'=> $id,'result' => $result);
      }
      $err->add($i18n->get('error.db'));
      
    }

    return array('error'=>$err->getErrors());
}