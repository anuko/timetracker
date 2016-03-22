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

// Access check.
if (!ttAccessCheck(right_data_entry)) {
  header('Location: access_denied.php');
  exit();
}

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
if (in_array('cf', explode(',', $user->plugins))) {
  require_once('../plugins/CustomFields.class.php');
  $custom_fields = new CustomFields($user->team_id);
  $smarty->assign('custom_fields', $custom_fields);
}

// Initialize variables.
$cl_start = trim($request->getParameter('browser_time'));
$cl_finish = trim($request->getParameter('browser_time'));
// Custom field.
$cl_cf_1 = trim($request->getParameter('cf_1', ($request->getMethod()=='POST'? null : @$_SESSION['cf_1'])));
$_SESSION['cf_1'] = $cl_cf_1;
$cl_billable = 1;
if (in_array('iv', explode(',', $user->plugins))) {
  if ($request->getMethod() == 'POST') {
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

// Obtain uncompleted record. Assumtion is that only 1 uncompleted record is allowed.
$uncompleted = ttTimeHelper::getUncompleted($user->getActiveUser());
$enable_controls = ($uncompleted == null);

// Elements of timeRecordForm.
$form = new Form('timerRecordForm');

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $user->tracking_mode && in_array('cl', explode(',', $user->plugins))) {
    $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'enable'=>$enable_controls,
      'value'=>$cl_client,
      'data'=>$active_clients,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
  // Note: in other modes the client list is filtered to relevant clients only. See below.
}

if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
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
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))));

  // Dropdown for clients if the clients plugin is enabled.
  if (in_array('cl', explode(',', $user->plugins))) {
    $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
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
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
  }
}

if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  $task_list = ttTeamHelper::getActiveTasks($user->team_id);
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'style'=>'width: 250px;',
    'enable'=>$enable_controls,
    'value'=>$cl_task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
}
if (in_array('iv', explode(',', $user->plugins)))
  $form->addInput(array('type'=>'checkbox','name'=>'billable','data'=>1,'value'=>$cl_billable,'enable'=>$enable_controls));
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on button click.
$form->addInput(array('type'=>'hidden','name'=>'browser_time','value'=>''));  // User current time, which gets filled in on button click.
$enable_start = $uncompleted ? false : true;
if (!$uncompleted)
  $form->addInput(array('type'=>'submit','name'=>'btn_start','onclick'=>'browser_time.value=get_time()','value'=>$i18n->getKey('label.start'),'enable'=>$enable_start));
else
  $form->addInput(array('type'=>'submit','name'=>'btn_stop','onclick'=>'browser_time.value=get_time()','value'=>$i18n->getKey('label.finish'),'enable'=>!$enable_start));

// If we have custom fields - add controls for them.
if ($custom_fields && $custom_fields->fields[0]) {
  // Only one custom field is supported at this time.
  if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT) {
    $form->addInput(array('type'=>'text','name'=>'cf_1','value'=>$cl_cf_1));
  } else if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN) {
    $form->addInput(array('type'=>'combobox','name'=>'cf_1',
      'style'=>'width: 250px;',
      'value'=>$cl_cf_1,
      'data'=>$custom_fields->options,
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))
    ));
  }
}

// Determine lock date. Time entries earlier than lock date cannot be created or modified.
$lock_interval = $user->lock_interval;
$lockdate = 0;
if ($lock_interval > 0) {
  $lockdate = new DateAndTime();
  $lockdate->decDay($lock_interval);
}

// Submit.
if ($request->getMethod() == 'POST') {
  if ($request->getParameter('btn_start')) {
    // Start button clicked. We need to create a new uncompleted record with only the start time.
    $cl_finish = null;

    // Validate user input.
    if (in_array('cl', explode(',', $user->plugins)) && in_array('cm', explode(',', $user->plugins)) && !$cl_client)
      $errors->add($i18n->getKey('error.client'));
    if ($custom_fields) {
      if (!ttValidString($cl_cf_1, !$custom_fields->fields[0]['required'])) $errors->add($i18n->getKey('error.field'), $custom_fields->fields[0]['label']);
    }
    if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
      if (!$cl_project) $errors->add($i18n->getKey('error.project'));
    }
    if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
      if (!$cl_task) $errors->add($i18n->getKey('error.task'));
    }
    // Finished validating user input.

    // Prohibit creating entries in future.
    if (defined('FUTURE_ENTRIES') && !isTrue(FUTURE_ENTRIES)) {
      $browser_today = new DateAndTime(DB_DATEFORMAT, $request->getParameter('browser_today', null));
      if ($selected_date->after($browser_today))
        $errors->add($i18n->getKey('error.future_date'));
    }

    // Prohibit creating time entries in locked interval.
    if($lockdate && $selected_date->before($lockdate))
      $errors->add($i18n->getKey('error.period_locked'));

    // Prohibit creating another uncompleted record.
    if ($errors->no() && $uncompleted) {
      $errors->add($i18n->getKey('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->getKey('error.goto_uncompleted')."</a>");
    }

    // Prohibit creating an overlapping record.
    if ($errors->no()) {
      if (ttTimeHelper::overlaps($user->getActiveUser(), $cl_date, $cl_start, $cl_finish))
        $errors->add($i18n->getKey('error.overlap'));
    }

    if ($errors->no()) {
      $id = ttTimeHelper::insert(array(
        'date' => $cl_date,
        'user_id' => $user->getActiveUser(),
        'client' => $cl_client,
        'project' => $cl_project,
        'task' => $cl_task,
        'start' => $cl_start,
        'finish' => $cl_finish,
        'duration' => $cl_duration,
        'note' => $cl_note,
        'billable' => $cl_billable));

      // Insert a custom field if we have it.
      $result = true;
      if ($id && $custom_fields && $cl_cf_1) {
        if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
          $result = $custom_fields->insert($id, $custom_fields->fields[0]['id'], null, $cl_cf_1);
        else if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
          $result = $custom_fields->insert($id, $custom_fields->fields[0]['id'], $cl_cf_1, null);
      }

      if ($id && $result) {
        header('Location: timer.php');
        exit();
      }
      $errors->add($i18n->getKey('error.db'));
    }
  }
  if ($request->getParameter('btn_stop')) {
    // Stop button clicked. We need to finish an uncompleted record in progress.
    $record = ttTimeHelper::getRecord($uncompleted['id'], $user->getActiveUser());

    // Can we complete this record?
    if (ttTimeHelper::isValidInterval($record['start'], $cl_finish) // finish time is greater than start time
      && !ttTimeHelper::overlaps($user->getActiveUser(), $cl_date, $record['start'], $cl_finish)) { // no overlap
      $res = ttTimeHelper::update(array(
        'id'=>$record['id'],
        'date'=>$cl_date,
        'user_id'=>$user->getActiveUser(),
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
        $errors->add($i18n->getKey('error.db'));
    } else {
      // Cannot complete, redirect for manual edit.
      header('Location: time_edit.php?id='.$record['id']);
      exit();
    }
  }
} // POST

$week_total = ttTimeHelper::getTimeForWeek($user->getActiveUser(), $cl_date);
$smarty->assign('week_total', $week_total);

$smarty->assign('uncompleted', $uncompleted);



$smarty->assign('time_records', ttTimeHelper::getRecords($user->getActiveUser(), $cl_date));
$smarty->assign('day_total', ttTimeHelper::getTimeForDay($user->getActiveUser(), $cl_date));
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('timestring', $selected_date->toString($user->date_format));
$smarty->assign('title', $i18n->getKey('title.time'));
$smarty->assign('content_page_name', 'mobile/timer.tpl');
$smarty->display('mobile/index.tpl');
