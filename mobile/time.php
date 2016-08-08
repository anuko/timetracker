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
import('DateAndTime');
import('ttClientHelper');
import('ttTaskHelper');
import('ttTeamHelper');
import('ttTime');
import('ttTimeHelper');
import('ttUserHelper');

// Access check.
if (!ttAccessCheck(right_data_entry)) {
  header('Location: access_denied.php');
  exit();
}

$time = new ttTime($user, $request);

// Determine previous and next dates for simple navigation.
$prev_date = date('Y-m-d', strtotime('-1 day', strtotime($time->date->toString(DB_DATEFORMAT))));
$next_date = date('Y-m-d', strtotime('+1 day', strtotime($time->date->toString(DB_DATEFORMAT))));

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

$form->addInput(array('type'=>'textarea','name'=>'note','style'=>'width: 250px; height: 60px;','value'=>$time->note));
if ($user->isPluginEnabled('iv'))
  $form->addInput(array('type'=>'checkbox','name'=>'billable','data'=>1,'value'=>$time->billable));

$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_submit click.
$form->addInput(array('type'=>'submit','name'=>'btn_submit','onclick'=>'browser_today.value=get_date()','value'=>$i18n->getKey('button.submit')));

// If we have custom fields - add controls for them.
if ($time->custom_fields && $time->custom_fields->fields[0]) {
  $smarty->assign('custom_fields', $time->custom_fields);
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
      $result = true;
      if ($id && $time->custom_fields && $time->custom_field) {
        if ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT){
          $result = $time->custom_fields->insert($id, $time->custom_fields->fields[0]['id'], null, $time->custom_field);
        }
        elseif ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN){
          $result = $time->custom_fields->insert($id, $time->custom_fields->fields[0]['id'], $time->custom_field, null);
        }
      }

      if ($id && $result) {
        header('Location: time.php');
        exit();
      }
      $err->add($i18n->getKey('error.db'));
    }
  }
} // isPost

$smarty->assign('next_date', $next_date);
$smarty->assign('prev_date', $prev_date);
$smarty->assign('time_records', ttTimeHelper::getRecords($user->getActiveUser(), $time->date));
$smarty->assign('day_total', ttTimeHelper::getTimeForDay($user->getActiveUser(), $time->date));
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('timestring', $time->date->toString($user->date_format));
$smarty->assign('title', $i18n->getKey('title.time'));
$smarty->assign('content_page_name', 'mobile/time.tpl');
$smarty->display('mobile/index.tpl');
