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
import('DateAndTime');

// Access check.
if (!ttAccessAllowed('track_own_time')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$showClient = $user->isPluginEnabled('cl');
$showBillable = $user->isPluginEnabled('iv');
$trackingMode = $user->getTrackingMode();
$showProject = MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode;
$showTask = MODE_PROJECTS_AND_TASKS == $trackingMode;
if ($showTask) $taskRequired = $user->getConfigOption('task_required');

// Initialize and store date in session.
$cl_date  = $request->getParameter('date', @$_SESSION['date']);
$selected_date = new DateAndTime(DB_DATEFORMAT, $cl_date);
if($selected_date->isError())
  $selected_date = new DateAndTime(DB_DATEFORMAT);
if(!$cl_date)
  $cl_date = $selected_date->toString(DB_DATEFORMAT);
$_SESSION['date'] = $cl_date;
// TODO: for time page we may limit the day to today only.

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('../plugins/CustomFields.class.php');
  $custom_fields = new CustomFields();
  $smarty->assign('custom_fields', $custom_fields);
}

// Initialize variables.
$cl_start = trim($request->getParameter('browser_time'));
$cl_finish = trim($request->getParameter('browser_time'));
$cl_billable = 1;
if ($user->isPluginEnabled('iv')) {
  if ($request->isPost()) {
    $cl_billable = $request->getParameter('billable');
    $_SESSION['billable'] = (int) $cl_billable;
  } else 
    if (isset($_SESSION['billable']))
      $cl_billable = $_SESSION['billable'];
}
$cl_client = $request->getParameter('client', @$_SESSION['client']);
$_SESSION['client'] = $cl_client;
$cl_project = $request->getParameter('project', @$_SESSION['project']);
$_SESSION['project'] = $cl_project;
$cl_task = $request->getParameter('task', @$_SESSION['task']);
$_SESSION['task'] = $cl_task;

$timeCustomFields = array();
// If we have time custom fields - collect input.
if ($request->isPost()) {
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
}

// Obtain uncompleted record. Assumtion is that only 1 uncompleted record is allowed.
$uncompleted = ttTimeHelper::getUncompleted($user->getUser());
$enable_controls = ($uncompleted == null);

// Elements of timeRecordForm.
$form = new Form('timeRecordForm');

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $trackingMode && $showClient) {
    $active_clients = ttGroupHelper::getActiveClients(true);
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'enable'=>$enable_controls,
      'value'=>$cl_client,
      'data'=>$active_clients,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
  // Note: in other modes the client list is filtered to relevant clients only. See below.
}

// Billable checkbox.
if ($showBillable)
  $form->addInput(array('type'=>'checkbox','name'=>'billable','value'=>$cl_billable,'enable'=>$enable_controls));

// If we have time custom fields - add controls for them.
if ($custom_fields && $custom_fields->timeFields) {
  foreach ($custom_fields->timeFields as $timeField) {
    $field_name = 'time_field_'.$timeField['id'];
    if ($timeField['type'] == CustomFields::TYPE_TEXT) {
      $form->addInput(array('type'=>'text','name'=>$field_name,'style'=>'width: 250px;','value'=>$timeCustomFields[$timeField['id']]['value']));
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
  $project_list = $user->getAssignedProjects();
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillTaskDropdown(this.value);',
    'name'=>'project',
    'style'=>'width: 250px;',
    'enable'=>$enable_controls,
    'value'=>$cl_project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));

  // Client dropdown.
  if ($showClient) {
    $active_clients = ttGroupHelper::getActiveClients(true);
    // We need an array of assigned project ids to do some trimming. 
    foreach($project_list as $project)
      $projects_assigned_to_user[] = $project['id'];

    // Build a client list out of active clients. Use only clients that are relevant to user.
    // Also trim their associated project list to only assigned projects (to user).
    foreach($active_clients as $client) {
      $projects_assigned_to_client = explode(',', $client['projects']);
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
      'enable'=>$enable_controls,
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
    'enable'=>$enable_controls,
    'value'=>$cl_task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));
}

// A hidden control for today's date from user's browser.
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on button click.

// A hidden control for current time from user's browser.
$form->addInput(array('type'=>'hidden','name'=>'browser_time','value'=>''));  // User current time, which gets filled in on button click.

// Start and stop buttons.
$enable_start = $uncompleted ? false : true;
if (!$uncompleted)
  $form->addInput(array('type'=>'submit','name'=>'btn_start','onclick'=>'browser_time.value=get_time()','value'=>$i18n->get('label.start'),'enable'=>$enable_start));
else
  $form->addInput(array('type'=>'submit','name'=>'btn_stop','onclick'=>'browser_time.value=get_time()','value'=>$i18n->get('label.finish'),'enable'=>!$enable_start));

// Submit.
if ($request->isPost()) {
  if ($request->getParameter('btn_start')) {
    // Start button clicked. We need to create a new uncompleted record with only the start time.
    $cl_finish = null;

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
    if ($showTask && $taskRequired) {
      if (!$cl_task) $err->add($i18n->get('error.task'));
    }
    // Finished validating user input.

    // Prohibit creating entries in future.
    if (!$user->isOptionEnabled('future_entries')) {
      $browser_today = new DateAndTime(DB_DATEFORMAT, $request->getParameter('browser_today', null));
      if ($selected_date->after($browser_today))
        $err->add($i18n->get('error.future_date'));
    }

    // Prohibit creating time entries in locked interval.
    if ($user->isDateLocked($selected_date))
      $err->add($i18n->get('error.range_locked'));

    // Prohibit creating another uncompleted record.
    if ($err->no() && $uncompleted) {
      $err->add($i18n->get('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->get('error.goto_uncompleted')."</a>");
    }

    // Prohibit creating an overlapping record.
    if ($err->no()) {
      if (ttTimeHelper::overlaps($user->getUser(), $cl_date, $cl_start, $cl_finish))
        $err->add($i18n->get('error.overlap'));
    }

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
      if ($id && $custom_fields && $custom_fields->timeFields) {
        $result = $custom_fields->insertTimeFields($id, $timeCustomFields);
      }

      if ($id && $result) {
        header('Location: timer.php');
        exit();
      }
      $err->add($i18n->get('error.db'));
    }
  }
  if ($request->getParameter('btn_stop')) {
    // Stop button clicked. We need to finish an uncompleted record in progress.
    $record = ttTimeHelper::getRecord($uncompleted['id']);

    // Can we complete this record?
    if (ttTimeHelper::isValidInterval($record['start'], $cl_finish) // finish time is greater than start time
      && !ttTimeHelper::overlaps($user->getUser(), $cl_date, $record['start'], $cl_finish)) { // no overlap
      $res = ttTimeHelper::update(array(
        'id'=>$record['id'],
        'date'=>$cl_date,
        'client'=>$record['client_id'],
        'project'=>$record['project_id'],
        'task'=>$record['task_id'],
        'start'=>$record['start'],
        'finish'=>$cl_finish,
        'note'=>$record['comment'],
        'billable'=>$record['billable']));
      if ($res) {
        header('Location: timer.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    } else {
      // Cannot complete, redirect for manual edit.
      header('Location: time_edit.php?id='.$record['id']);
      exit();
    }
  }
} // isPost

$week_total = ttTimeHelper::getTimeForWeek($cl_date);
$smarty->assign('week_total', $week_total);
$smarty->assign('uncompleted', $uncompleted);
$smarty->assign('show_client', $showClient);
$smarty->assign('show_billable', $showBillable);
$smarty->assign('show_project', $showProject);
$smarty->assign('show_task', $showTask);
$smarty->assign('task_required', $taskRequired);
$smarty->assign('time_records', ttTimeHelper::getRecords($cl_date));
$smarty->assign('day_total', ttTimeHelper::getTimeForDay($cl_date));
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('timestring', $selected_date->toString($user->date_format));
$smarty->assign('title', $i18n->get('title.time'));
$smarty->assign('content_page_name', 'mobile/timer.tpl');
$smarty->display('mobile/index.tpl');
