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

require_once('initialize.php');
import('form.Form');
import('DateAndTime');
import('ttClientHelper');
import('ttTeamHelper');
import('ttTime');
import('ttTimeHelper');
import('ttUserHelper');

// This is a now removed check whether user browser supports cookies.
// if (!isset($_COOKIE['tt_PHPSESSID'])) {
  // This test gives a false-positive if user goes directly to this page
  // as from a desktop shortcut (on first request only).
  // die ("Your browser's cookie functionality is turned off. Please turn it on.");
// }

// Access check.
if (!ttAccessCheck(right_data_entry)) {
  header('Location: access_denied.php');
  exit();
}

$time = new ttTime($user, $request);

// Use custom fields plugin if it is enabled.
if ($time->custom_fields) {
  $smarty->assign('custom_fields', $time->custom_fields);
}

if ($user->isPluginEnabled('mq')){
  require_once('plugins/MonthlyQuota.class.php');
  $quota = new MonthlyQuota();
  $month_quota = $quota->get($time->date->mYear, $time->date->mMonth);
  $month_total = ttTimeHelper::getTimeForMonth($user->getActiveUser(), $time->date);
  $minutes_left = ttTimeHelper::toMinutes($month_quota) - ttTimeHelper::toMinutes($month_total);
  
  $smarty->assign('month_total', $month_total);
  $smarty->assign('over_quota', $minutes_left < 0);
  $smarty->assign('quota_remaining', ttTimeHelper::toAbsDuration($minutes_left));
}

// Initialize session variables.
// TODO: get rid of session and make it stateless
$_SESSION['date'] = $time->date->toString(DB_DATEFORMAT);
$_SESSION['cf_1'] = $time->custom_field;

$_SESSION['billable'] = (int)$time->billable;
$_SESSION['client'] = $time->client;
$_SESSION['project'] = $time->project;
$_SESSION['task'] = $time->task;

// Elements of timeRecordForm.
$form = new Form('timeRecordForm');

if ($user->canManageTeam()) {
  $user_list = ttTeamHelper::getActiveUsers(array('putSelfFirst'=>true));
  if (count($user_list) > 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'this.form.submit();',
      'name'=>'onBehalfUser',
      'style'=>'width: 250px;',
      'value'=>$time->on_behalf_id,
      'data'=>$user_list,
      'datakeys'=>array('id','name')));
    $smarty->assign('on_behalf_control', 1);
  }
}

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $user->tracking_mode && $user->isPluginEnabled('cl')) {
  $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillProjectDropdown(this.value);',
    'name'=>'client',
    'style'=>'width: 250px;',
    'value'=>$time->client,
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
    'value'=>$time->project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))));

  // Dropdown for clients if the clients plugin is enabled.
  if ($user->isPluginEnabled('cl')) {
    $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
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
      'value'=>$time->client,
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
    'value'=>$time->task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
}

// Add other controls.
if ((TYPE_START_FINISH == $user->record_type) || (TYPE_ALL == $user->record_type)) {
  $form->addInput(array('type'=>'text','name'=>'start','value'=>$time->start,'onchange'=>"formDisable('start');"));
  $form->addInput(array('type'=>'text','name'=>'finish','value'=>$time->finish,'onchange'=>"formDisable('finish');"));
}
if (!$user->canManageTeam() && defined('READONLY_START_FINISH') && isTrue(READONLY_START_FINISH)) {
  // Make the start and finish fields read-only.
  $form->getElement('start')->setEnable(false);
  $form->getElement('finish')->setEnable(false);
}
if ((TYPE_DURATION == $user->record_type) || (TYPE_ALL == $user->record_type))
  $form->addInput(array('type'=>'text','name'=>'duration','value'=>$time->duration,'onchange'=>"formDisable('duration');"));

$form->addInput(array('type'=>'textarea','name'=>'note','style'=>'width: 600px; height:'.NOTE_INPUT_HEIGHT.'px;','value'=>$time->note));
$form->addInput(array('type'=>'calendar','name'=>'date','value'=>$time->date->toString(DB_DATEFORMAT))); // calendar
if ($user->isPluginEnabled('iv'))
  $form->addInput(array('type'=>'checkbox','name'=>'billable','data'=>1,'value'=>$time->billable));

$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_submit click.
$form->addInput(array('type'=>'submit','name'=>'btn_submit','onclick'=>'browser_today.value=get_date()','value'=>$i18n->getKey('button.submit')));

// If we have custom fields - add controls for them.
if ($time->custom_fields && $time->custom_fields->fields[0]) {
  // Only one custom field is supported at this time.
  if ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT) {
    $form->addInput(array('type'=>'text','name'=>'cf_1','value'=>$time->custom_field));
  } elseif ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN) {
    $form->addInput(array('type'=>'combobox','name'=>'cf_1',
      'style'=>'width: 250px;',
      'value'=>$time->custom_field,
      'data'=>$time->custom_fields->options,
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
  }
}

// Submit.
if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {

    // Validate user input.
    $err = $time->validate($err);
    
    // Insert record.
    if ($err->no()) {
      $id = ttTimeHelper::insert(array(
        'date' => $time->date->toString(DB_DATEFORMAT),
        'user_id' => $user->getActiveUser(),
        'client' => $time->client,
        'project' => $time->project,
        'task' => $time->task,
        'start' => $time->start,
        'finish' => $time->finish,
        'duration' => $time->duration,
        'note' => $time->note,
        'billable' => $time->billable));

      // Insert a custom field if we have it.
      // TODO: two dependant inserts should be in a transaction/unit of work so we do not get incosistent data if
      // something goes wrong with second insert
      $result = true;
      if ($id && $time->custom_fields && $time->custom_field) {
        if ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
          $result = $time->custom_fields->insert($id, $time->custom_fields->fields[0]['id'], null, $time->custom_field);
        elseif ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
          $result = $time->custom_fields->insert($id, $time->custom_fields->fields[0]['id'], $time->custom_field, null);
      }
      
      if ($id && $result) {
        header('Location: time.php');
        exit();
      }
      $err->add($i18n->getKey('error.db'));
    }
  } elseif ($request->getParameter('btn_stop')) {
    // Stop button pressed to finish an uncompleted record.
    $record_id = $request->getParameter('record_id');
    $record = ttTimeHelper::getRecord($record_id, $user->getActiveUser());
    $browser_date = $request->getParameter('browser_date');
    $browser_time = $request->getParameter('browser_time');

    // Can we complete this record?
    if ($record['date'] == $browser_date                                // closing today's record
      && ttTimeHelper::isValidInterval($record['start'], $browser_time) // finish time is greater than start time
      && !ttTimeHelper::overlaps($user->getActiveUser(), $browser_date, $record['start'], $browser_time)) { // no overlap
      $res = ttTimeHelper::update(array(
          'id'=>$record['id'],
          'date'=>$record['date'],
          'user_id'=>$user->getActiveUser(),
          'client'=>$record['client_id'],
          'project'=>$record['project_id'],
          'task'=>$record['task_id'],
          'start'=>$record['start'],
          'finish'=>$browser_time,
          'note'=>$record['comment'],
          'billable'=>$record['billable']));
      if (!$res)
        $err->add($i18n->getKey('error.db'));
    } else {
      // Cannot complete, redirect for manual edit.
      header('Location: time_edit.php?id='.$record_id);
      exit();
    }
  }
  elseif ($request->getParameter('onBehalfUser')) {
    if($user->canManageTeam()) {
      unset($_SESSION['behalf_id']);
      unset($_SESSION['behalf_name']);

      if($time->on_behalf_id != $user->id) {
        $_SESSION['behalf_id'] = $time->on_behalf_id;
        $_SESSION['behalf_name'] = ttUserHelper::getUserName($time->on_behalf_id);
      }
      header('Location: time.php');
      exit();
    }
  }
} // isPost

$smarty->assign('week_total', ttTimeHelper::getTimeForWeek($user->getActiveUser(), $time->date));
$smarty->assign('day_total', ttTimeHelper::getTimeForDay($user->getActiveUser(), $time->date));
$smarty->assign('time_records', ttTimeHelper::getRecords($user->getActiveUser(), $time->date));
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('timestring', $time->date->toString($user->date_format));
$smarty->assign('title', $i18n->getKey('title.time'));
$smarty->assign('content_page_name', 'time.tpl');
$smarty->display('index.tpl');
