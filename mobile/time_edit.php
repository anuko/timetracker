<?php
// +----------------------------------------------------------------------+
// | Anuko Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) Anuko International Ltd. (https://www.anuko.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors:
// | https://www.anuko.com/time_tracker/credits.htm
// +----------------------------------------------------------------------+

require_once('../initialize.php');
import('form.Form');
import('ttUserHelper');
import('ttTeamHelper');
import('ttClientHelper');
import('ttTimeHelper');
import('DateAndTime');

// Access checks.
if (!ttAccessAllowed('track_own_time')) {
  header('Location: access_denied.php');
  exit();
}
$cl_id = (int)$request->getParameter('id');
$time_rec = ttTimeHelper::getRecord($cl_id, $user->getActiveUser());
if (!$time_rec || $time_rec['invoice_id']) {
  // Prohibit editing not ours or invoiced records.
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('../plugins/CustomFields.class.php');
  $custom_fields = new CustomFields($user->group_id);
  $smarty->assign('custom_fields', $custom_fields);
}

$item_date = new DateAndTime(DB_DATEFORMAT, $time_rec['date']);

// Initialize variables.
$cl_start = $cl_finish = $cl_duration = $cl_date = $cl_note = $cl_project = $cl_task = $cl_billable = null;
if ($request->isPost()) {
  $cl_start = trim($request->getParameter('start'));
  $cl_finish = trim($request->getParameter('finish'));
  $cl_duration = trim($request->getParameter('duration'));
  $cl_date = $request->getParameter('date');
  $cl_note = trim($request->getParameter('note'));
  $cl_cf_1 = trim($request->getParameter('cf_1'));
  $cl_client = $request->getParameter('client');
  $cl_project = $request->getParameter('project');
  $cl_task = $request->getParameter('task');
  $cl_billable = 1;
  if ($user->isPluginEnabled('iv'))
    $cl_billable = $request->getParameter('billable');
} else {
  $cl_client = $time_rec['client_id'];
  $cl_project = $time_rec['project_id'];
  $cl_task = $time_rec['task_id'];
  $cl_start = $time_rec['start'];
  $cl_finish = $time_rec['finish'];
  $cl_duration = $time_rec['duration'];
  $cl_date = $item_date->toString($user->date_format);
  $cl_note = $time_rec['comment'];

  // If we have custom fields - obtain values for them.
  if ($custom_fields) {
    // Get custom field value for time record.
    $fields = $custom_fields->get($time_rec['id']);
    if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
      $cl_cf_1 = $fields[0]['value'];
    elseif ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
      $cl_cf_1 = $fields[0]['option_id'];
  }

  $cl_billable = $time_rec['billable'];

  // Add an info message to the form if we are editing an uncompleted record.
  if (strlen($cl_start) > 0 && $cl_start == $cl_finish && $cl_duration == '0:00') {
    $cl_finish = '';
    $cl_duration = '';
    $msg->add($i18n->get('form.time_edit.uncompleted'));
  }
}

// Initialize elements of 'timeRecordForm'.
$form = new Form('timeRecordForm');

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $user->tracking_mode && $user->isPluginEnabled('cl')) {
    $active_clients = ttTeamHelper::getActiveClients($user->group_id, true);
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'value'=>$cl_client,
      'data'=>$active_clients,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
  // Note: in other modes the client list is filtered to relevant clients only. See below.
}

if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  // Dropdown for projects assigned to user.
  $project_list = $user->getAssignedProjects();
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillTaskDropdown(this.value);',
    'name'=>'project',
    'style'=>'width: 250px;',
    'value'=>$cl_project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));

  // Dropdown for clients if the clients plugin is enabled.
  if ($user->isPluginEnabled('cl')) {
    $active_clients = ttTeamHelper::getActiveClients($user->group_id, true);
    // We need an array of assigned project ids to do some trimming.
    foreach($project_list as $project)
      $projects_assigned_to_user[] = $project['id'];

    // Build a client list out of active clients. Use only clients that are relevant to user.
    // Also trim their associated project list to only assigned projects (to user).
    foreach($active_clients as $client) {
      $projects_assigned_to_client = explode(',', $client['projects']);
      if (is_array($projects_assigned_to_client) && is_array($projects_assigned_to_user))
        $intersection = array_intersect($projects_assigned_to_client, $projects_assigned_to_user);
      if ($intersection) {
        $client['projects'] = implode(',', $intersection);
        $client_list[] = $client;
      }
    }
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'value'=>$cl_client,
      'data'=>$client_list,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
  }
}

if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  $task_list = ttTeamHelper::getActiveTasks($user->group_id);
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'style'=>'width: 250px;',
    'value'=>$cl_task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));
}

// Add other controls.
if ((TYPE_START_FINISH == $user->record_type) || (TYPE_ALL == $user->record_type)) {
  $form->addInput(array('type'=>'text','name'=>'start','value'=>$cl_start,'onchange'=>"formDisable('start');"));
  $form->addInput(array('type'=>'text','name'=>'finish','value'=>$cl_finish,'onchange'=>"formDisable('finish');"));
  if ($user->punch_mode && !$user->canOverridePunchMode()) {
    // Make the start and finish fields read-only.
    $form->getElement('start')->setEnabled(false);
    $form->getElement('finish')->setEnabled(false);
  }
}
if ((TYPE_DURATION == $user->record_type) || (TYPE_ALL == $user->record_type))
  $form->addInput(array('type'=>'text','name'=>'duration','value'=>$cl_duration,'onchange'=>"formDisable('duration');"));
$form->addInput(array('type'=>'datefield','name'=>'date','maxlength'=>'20','value'=>$cl_date));
$form->addInput(array('type'=>'textarea','name'=>'note','class'=>'mobile-textarea','value'=>$cl_note));
// If we have custom fields - add controls for them.
if ($custom_fields && $custom_fields->fields[0]) {
  // Only one custom field is supported at this time.
  if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT) {
    $form->addInput(array('type'=>'text','name'=>'cf_1','value'=>$cl_cf_1));
  } elseif ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN) {
    $form->addInput(array('type'=>'combobox',
      'name'=>'cf_1',
      'style'=>'width: 250px;',
      'value'=>$cl_cf_1,
      'data'=>$custom_fields->options,
      'empty' => array('' => $i18n->get('dropdown.select'))));
  }
}
// Hidden control for record id.
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
if ($user->isPluginEnabled('iv'))
  $form->addInput(array('type'=>'checkbox','name'=>'billable','value'=>$cl_billable));
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_save click.
$form->addInput(array('type'=>'submit','name'=>'btn_save','onclick'=>'browser_today.value=get_date()','value'=>$i18n->get('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));

if ($request->isPost()) {

  // Validate user input.
  if ($user->isPluginEnabled('cl') && $user->isPluginEnabled('cm') && !$cl_client)
    $err->add($i18n->get('error.client'));
  if ($custom_fields) {
    if (!ttValidString($cl_cf_1, !$custom_fields->fields[0]['required'])) $err->add($i18n->get('error.field'), $custom_fields->fields[0]['label']);
  }
  if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
    if (!$cl_project) $err->add($i18n->get('error.project'));
  }
  if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode && $user->task_required) {
    if (!$cl_task) $err->add($i18n->get('error.task'));
  }
  if (!$cl_duration) {
    if ('0' == $cl_duration)
      $err->add($i18n->get('error.field'), $i18n->get('label.duration'));
    elseif ($cl_start || $cl_finish) {
      if (!ttTimeHelper::isValidTime($cl_start))
        $err->add($i18n->get('error.field'), $i18n->get('label.start'));
      if ($cl_finish) {
        if (!ttTimeHelper::isValidTime($cl_finish))
          $err->add($i18n->get('error.field'), $i18n->get('label.finish'));
        if (!ttTimeHelper::isValidInterval($cl_start, $cl_finish))
          $err->add($i18n->get('error.interval'), $i18n->get('label.finish'), $i18n->get('label.start'));
      }
    } else {
      if ((TYPE_START_FINISH == $user->record_type) || (TYPE_ALL == $user->record_type)) {
        $err->add($i18n->get('error.empty'), $i18n->get('label.start'));
        $err->add($i18n->get('error.empty'), $i18n->get('label.finish'));
      }
      if ((TYPE_DURATION == $user->record_type) || (TYPE_ALL == $user->record_type))
        $err->add($i18n->get('error.empty'), $i18n->get('label.duration'));
    }
  } else {
    if (false === ttTimeHelper::postedDurationToMinutes($cl_duration))
      $err->add($i18n->get('error.field'), $i18n->get('label.duration'));
  }
  if (!ttValidDate($cl_date)) $err->add($i18n->get('error.field'), $i18n->get('label.date'));
  if (!ttValidString($cl_note, true)) $err->add($i18n->get('error.field'), $i18n->get('label.note'));
  // Finished validating user input.

  // This is a new date for the time record.
  $new_date = new DateAndTime($user->date_format, $cl_date);

  // Prohibit creating entries in future.
  if (!$user->future_entries) {
    $browser_today = new DateAndTime(DB_DATEFORMAT, $request->getParameter('browser_today', null));
    if ($new_date->after($browser_today))
      $err->add($i18n->get('error.future_date'));
  }

  // Save record.
  if ($request->getParameter('btn_save')) {
    // We need to:
    // 1) Prohibit saving locked entries in any form.
    // 2) Prohibit saving completed unlocked entries into locked range.
    // 3) Prohibit saving uncompleted unlocked entries when another uncompleted entry exists.

    // Now, step by step.
    if ($err->no()) {
      // 1) Prohibit saving locked entries in any form.
      if ($user->isDateLocked($item_date))
        $err->add($i18n->get('error.range_locked'));

      // 2) Prohibit saving completed unlocked entries into locked range.
      if ($err->no() && $user->isDateLocked($new_date))
        $err->add($i18n->get('error.range_locked'));

      // 3) Prohibit saving uncompleted unlocked entries when another uncompleted entry exists.
      $uncompleted = ($cl_finish == '' && $cl_duration == '');
      if ($uncompleted) {
        $not_completed_rec = ttTimeHelper::getUncompleted($user->getActiveUser());
        if ($not_completed_rec && ($time_rec['id'] <> $not_completed_rec['id'])) {
          // We have another not completed record.
          $err->add($i18n->get('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->get('error.goto_uncompleted')."</a>");
        }
      }
    }

    // Prohibit creating an overlapping record.
    if ($err->no()) {
      if (ttTimeHelper::overlaps($user->getActiveUser(), $new_date->toString(DB_DATEFORMAT), $cl_start, $cl_finish, $cl_id))
        $err->add($i18n->get('error.overlap'));
    }

    // Now, an update.
    if ($err->no()) {
      $res = ttTimeHelper::update(array(
          'id'=>$cl_id,  
          'date'=>$new_date->toString(DB_DATEFORMAT),
          'user_id'=>$user->getActiveUser(),
          'client'=>$cl_client,
          'project'=>$cl_project,
          'task'=>$cl_task,
          'start'=>$cl_start,
          'finish'=>$cl_finish,
          'duration'=>$cl_duration,
          'note'=>$cl_note,
          'billable'=>$cl_billable));

      // If we have custom fields - update values.
      if ($res && $custom_fields) {
        if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
          $res = $custom_fields->update($cl_id, $custom_fields->fields[0]['id'], null, $cl_cf_1);
        elseif ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
          $res = $custom_fields->update($cl_id, $custom_fields->fields[0]['id'], $cl_cf_1, null);
      }
      if ($res)
      {
        header('Location: time.php?date='.$new_date->toString(DB_DATEFORMAT));
        exit();
      }
    }
  }

  if ($request->getParameter('btn_delete')) {
    header("Location: time_delete.php?id=$cl_id");
    exit();
  }
} // isPost

$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('title', $i18n->get('title.edit_time_record'));
$smarty->assign('content_page_name', 'mobile/time_edit.tpl');
$smarty->display('mobile/index.tpl');
