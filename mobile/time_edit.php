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
import('ttGroupHelper');
import('ttClientHelper');
import('ttTimeHelper');
import('ttConfigHelper');
import('DateAndTime');

// Access checks.
if (!ttAccessAllowed('track_own_time')) {
  header('Location: access_denied.php');
  exit();
}
$cl_id = (int)$request->getParameter('id');
$time_rec = ttTimeHelper::getRecord($cl_id);
if (!$time_rec || $time_rec['approved'] || $time_rec['timesheet_id'] || $time_rec['invoice_id']) {
  // Prohibit editing not ours, approved, assigned to timesheet, or invoiced records.
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$user_id = $user->getUser();
$config = new ttConfigHelper($user->getConfig());

$showClient = $user->isPluginEnabled('cl');
$showBillable = $user->isPluginEnabled('iv');
$showPaidStatus = $user->isPluginEnabled('ps') && $user->can('manage_invoices');
$trackingMode = $user->getTrackingMode();
$showProject = MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode;
$showTask = MODE_PROJECTS_AND_TASKS == $trackingMode;
if ($showTask) $taskRequired = $config->getDefinedValue('task_required');
$recordType = $user->getRecordType();
$showStart = TYPE_START_FINISH == $recordType || TYPE_ALL == $recordType;
$showDuration = TYPE_DURATION == $recordType || TYPE_ALL == $recordType;

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('../plugins/CustomFields.class.php');
  $custom_fields = new CustomFields();
  $smarty->assign('custom_fields', $custom_fields);
}

$item_date = new DateAndTime(DB_DATEFORMAT, $time_rec['date']);
$confirm_save = $user->getConfigOption('confirm_save');

// Initialize variables.
$cl_start = $cl_finish = $cl_duration = $cl_date = $cl_note = $cl_project = $cl_task = $cl_billable = null;
if ($request->isPost()) {
  $cl_start = trim($request->getParameter('start'));
  $cl_finish = trim($request->getParameter('finish'));
  $cl_duration = trim($request->getParameter('duration'));
  $cl_date = $request->getParameter('date');
  $cl_note = trim($request->getParameter('note'));
  // If we have user custom fields - collect input.
  if ($custom_fields && $custom_fields->timeFields) {
    foreach ($custom_fields->timeFields as $timeField) {
      $control_name = 'time_field_'.$timeField['id'];
      $timeCustomFields[$timeField['id']] = array('field_id' => $timeField['id'],
        'control_name' => $control_name,
        'label' => $timeField['label'],
        'type' => $timeField['type'],
        'required' => $timeField['required'],
        'value' => trim($request->getParameter($control_name)));
    }
  }
  $cl_client = $request->getParameter('client');
  $cl_project = $request->getParameter('project');
  $cl_task = $request->getParameter('task');
  $cl_billable = 1;
  if ($showBillable)
    $cl_billable = $request->getParameter('billable');
  if ($showPaidStatus)
    $cl_paid = $request->getParameter('paid');
} else {
  $cl_client = $time_rec['client_id'];
  $cl_project = $time_rec['project_id'];
  $cl_task = $time_rec['task_id'];
  $cl_start = $time_rec['start'];
  $cl_finish = $time_rec['finish'];
  $cl_duration = $time_rec['duration'];
  $cl_date = $item_date->toString($user->getDateFormat());
  $cl_note = $time_rec['comment'];

  // If we have time custom fields - collect values from database.
  if ($custom_fields && $custom_fields->timeFields) {
    foreach ($custom_fields->timeFields as $timeField) {
      $control_name = 'time_field_'.$timeField['id'];
      $timeCustomFields[$timeField['id']] = array('field_id' => $timeField['id'],
        'control_name' => $control_name,
        'label' => $timeField['label'],
        'type' => $timeField['type'],
        'required' => $timeField['required'],
        'value' => $custom_fields->getTimeFieldValue($cl_id, $timeField['id'], $timeField['type']));
    }
  }

  $cl_billable = $time_rec['billable'];
  $cl_paid = $time_rec['paid'];

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
// Note: for other tracking modes the control is added further below.
if (MODE_TIME == $trackingMode && $showClient) {
    $active_clients = ttGroupHelper::getActiveClients(true);
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

// Billable checkbox.
if ($showBillable)
  $form->addInput(array('type'=>'checkbox','name'=>'billable','value'=>$cl_billable));

// Paid status checkbox.
if ($showPaidStatus)
  $form->addInput(array('type'=>'checkbox','name'=>'paid','value'=>$cl_paid));

// If we have time custom fields - add controls for them.
if ($custom_fields && $custom_fields->timeFields) {
  foreach ($custom_fields->timeFields as $timeField) {
    $field_name = 'time_field_'.$timeField['id'];
    if ($timeField['type'] == CustomFields::TYPE_TEXT) {
      $form->addInput(array('type'=>'text','name'=>$field_name,'value'=>$timeCustomFields[$timeField['id']]['value']));
    } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
      $form->addInput(array('type'=>'combobox','name'=>$field_name,
      'style'=>'width: 250px;',
      'data'=>CustomFields::getOptions($timeField['id']),
      'value'=>$timeCustomFields[$timeField['id']]['value'],
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
    }
  }
}

// If we show project dropdown, add controls for project and client.
if ($showProject) {
  // Dropdown for projects assigned to user.
  $options['include_templates'] = $user->isPluginEnabled('tp') && $config->getDefinedValue('bind_templates_with_projects');
  $project_list = $user->getAssignedProjects($options);
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillTaskDropdown(this.value);fillTemplateDropdown(this.value);prepopulateNote();',
    'name'=>'project',
    'style'=>'width: 250px;',
    'value'=>$cl_project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));

  // Dropdown for clients if the clients plugin is enabled.
  if ($showClient) {
    $active_clients = ttGroupHelper::getActiveClients(true);
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

// Task dropdown.
if ($showTask) {
  $task_list = ttGroupHelper::getActiveTasks();
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'style'=>'width: 250px;',
    'value'=>$cl_task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));
}

// Start and finish controls.
if ($showStart) {
  $form->addInput(array('type'=>'text','name'=>'start','value'=>$cl_start,'onchange'=>"formDisable('start');"));
  $form->addInput(array('type'=>'text','name'=>'finish','value'=>$cl_finish,'onchange'=>"formDisable('finish');"));
  if ($user->punch_mode && !$user->canOverridePunchMode()) {
    // Make the start and finish fields read-only.
    $form->getElement('start')->setEnabled(false);
    $form->getElement('finish')->setEnabled(false);
  }
}

// Duration control.
if ($showDuration)
  $form->addInput(array('type'=>'text','name'=>'duration','value'=>$cl_duration,'onchange'=>"formDisable('duration');"));

// Date field.
$form->addInput(array('type'=>'datefield','name'=>'date','maxlength'=>'20','value'=>$cl_date));

// If we have templates, add a dropdown to select one.
if ($user->isPluginEnabled('tp')){
  $template_list = ttGroupHelper::getActiveTemplates();
  if (count($template_list) >= 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillNote(this.value);',
      'name'=>'template',
      'style'=>'width: 250px;',
      'data'=>$template_list,
      'datakeys'=>array('id','name'),
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
    $smarty->assign('template_dropdown', 1);
    $smarty->assign('bind_templates_with_projects', $config->getDefinedValue('bind_templates_with_projects'));
    $smarty->assign('prepopulate_note', $config->getDefinedValue('prepopulate_note'));
    $smarty->assign('template_list', $template_list);
  }
}

// Note control.
$form->addInput(array('type'=>'textarea','name'=>'note','class'=>'mobile-textarea','value'=>$cl_note));

// Hidden control for record id.
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));

// A hidden control for today's date from user's browser.
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_save click.

// Copy button.
$on_click_action = 'browser_today.value=get_date();';
$form->addInput(array('type'=>'submit','name'=>'btn_copy','onclick'=>$on_click_action,'value'=>$i18n->get('button.copy')));

// Save button.
if ($confirm_save) $on_click_action .= 'return(confirmSave());';
$form->addInput(array('type'=>'submit','name'=>'btn_save','onclick'=>$on_click_action,'value'=>$i18n->get('button.save')));

// Delete button.
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));

if ($request->isPost()) {

  // Validate user input.
  if ($showClient && $user->isOptionEnabled('client_required') && !$cl_client)
    $err->add($i18n->get('error.client'));
  // Validate input in time custom fields.
  if ($custom_fields && $custom_fields->timeFields) {
    foreach ($timeCustomFields as $timeField) {
      // Validation is the same for text and dropdown fields.
      if (!ttValidString($timeField['value'], !$timeField['required'])) $err->add($i18n->get('error.field'), htmlspecialchars($timeField['label']));
    }
  }
  if ($showProject) {
    if (!$cl_project) $err->add($i18n->get('error.project'));
  }
  if ($showTask && $task_required) {
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
  if (!ttValidDate($cl_date)) $err->add($i18n->get('error.field'), $i18n->get('label.date'));
  if (!ttValidString($cl_note, true)) $err->add($i18n->get('error.field'), $i18n->get('label.note'));
  if ($user->isPluginEnabled('tp') && !ttValidTemplateText($cl_note)) {
    $err->add($i18n->get('error.field'), $i18n->get('label.note'));
  }
  if (!ttTimeHelper::canAdd()) $err->add($i18n->get('error.expired'));
  // Finished validating user input.

  // This is a new date for the time record.
  $new_date = new DateAndTime($user->getDateFormat(), $cl_date);

  // Prohibit creating entries in future.
  if (!$user->isOptionEnabled('future_entries')) {
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
        $not_completed_rec = ttTimeHelper::getUncompleted($user_id);
        if ($not_completed_rec && ($time_rec['id'] <> $not_completed_rec['id'])) {
          // We have another not completed record.
          $err->add($i18n->get('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->get('error.goto_uncompleted')."</a>");
        }
      }
    }

    // Prohibit creating an overlapping record.
    if ($err->no()) {
      if (ttTimeHelper::overlaps($user_id, $new_date->toString(DB_DATEFORMAT), $cl_start, $cl_finish, $cl_id))
        $err->add($i18n->get('error.overlap'));
    }

    // Now, an update.
    if ($err->no()) {
      $res = ttTimeHelper::update(array(
          'id'=>$cl_id,  
          'date'=>$new_date->toString(DB_DATEFORMAT),
          'client'=>$cl_client,
          'project'=>$cl_project,
          'task'=>$cl_task,
          'start'=>$cl_start,
          'finish'=>$cl_finish,
          'duration'=>$cl_duration,
          'note'=>$cl_note,
          'billable'=>$cl_billable,
          'paid'=>$cl_paid));

      // Update time custom fields if we have them.
      if ($res && $custom_fields && $custom_fields->timeFields) {
        $res = $custom_fields->updateTimeFields($cl_id, $timeCustomFields);
      }
      if ($res)
      {
        header('Location: time.php?date='.$new_date->toString(DB_DATEFORMAT));
        exit();
      }
    }
  }

  // Copy record.
  if ($request->getParameter('btn_copy')) {
    // We need to:
    // 1) Prohibit saving into locked range.
    // 2) Prohibit saving uncompleted unlocked entries when another uncompleted entry exists.

    // Now, step by step.
    if ($err->no()) {
      // 1) Prohibit saving into locked range.
      if ($user->isDateLocked($new_date))
        $err->add($i18n->get('error.range_locked'));

      // 2) Prohibit saving uncompleted unlocked entries when another uncompleted entry exists.
      $uncompleted = ($cl_finish == '' && $cl_duration == '');
      if ($uncompleted) {
        $not_completed_rec = ttTimeHelper::getUncompleted($user_id);
        if ($not_completed_rec) {
          // We have another not completed record.
          $err->add($i18n->get('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->get('error.goto_uncompleted')."</a>");
        }
      }
    }

    // Prohibit creating an overlapping record.
    if ($err->no()) {
      if (ttTimeHelper::overlaps($user_id, $new_date->toString(DB_DATEFORMAT), $cl_start, $cl_finish))
        $err->add($i18n->get('error.overlap'));
    }

    // Now, a new insert.
    if ($err->no()) {

      $id = ttTimeHelper::insert(array(
        'date'=>$new_date->toString(DB_DATEFORMAT),
        'client'=>$cl_client,
        'project'=>$cl_project,
        'task'=>$cl_task,
        'start'=>$cl_start,
        'finish'=>$cl_finish,
        'duration'=>$cl_duration,
        'note'=>$cl_note,
        'billable'=>$cl_billable,
        'paid'=>$cl_paid));

      // Insert time custom fields if we have them.
      $res = true;
      if ($id && $custom_fields && $custom_fields->timeFields) {
        $res = $custom_fields->insertTimeFields($id, $timeCustomFields);
      }
      if ($id && $res) {
        header('Location: time.php?date='.$new_date->toString(DB_DATEFORMAT));
        exit();
      }
      $err->add($i18n->get('error.db'));
    }
  }

  if ($request->getParameter('btn_delete')) {
    header("Location: time_delete.php?id=$cl_id");
    exit();
  }
} // isPost

if ($confirm_save) {
  $smarty->assign('confirm_save', true);
  $smarty->assign('entry_date', $cl_date);
}
$smarty->assign('show_client', $showClient);
$smarty->assign('show_billable', $showBillable);+
$smarty->assign('show_paid_status', $showPaidStatus);
$smarty->assign('show_project', $showProject);
$smarty->assign('show_task', $showTask);
$smarty->assign('task_required', $taskRequired);
$smarty->assign('show_start', $showStart);
$smarty->assign('show_duration', $showDuration);
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('title', $i18n->get('title.edit_time_record'));
$smarty->assign('content_page_name', 'mobile/time_edit.tpl');
$smarty->display('mobile/index.tpl');
