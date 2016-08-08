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

// Access check.
if (!ttAccessCheck(right_data_entry)) {
  header('Location: access_denied.php');
  exit();
}

$id = $request->getParameter('id');

// Get the time record we are editing.
$time_rec = ttTimeHelper::getRecord($id, $user->getActiveUser());

// Prohibit editing invoiced records.
if ($time_rec['invoice_id']) die($i18n->getKey('error.sys'));

// Initialize variables.
if ($request->isPost()) {
  $time = new ttTime($user, $request, $time_rec);
} else {
  $time = new ttTime($user, $time_rec);

  // Add an info message to the form if we are editing an uncompleted record.
  if (($time->start == $time->finish) && ($time->duration == '0:00')) {
    $task = ttTaskHelper::getTask($time->task);
    $allow_zero_duration = $task && $task['allow_zero_duration'];
    if (!$allow_zero_duration){
      $time->finish = '';
      $time->duration = '';
      $msg->add($i18n->getKey('form.time_edit.uncompleted'));
    }
  }
}

// Initialize elements of 'timeRecordForm'.
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

$form->addInput(array('type'=>'datefield','name'=>'date','maxlength'=>'20','value'=>$time->date->toString(DB_DATEFORMAT)));
$form->addInput(array('type'=>'textarea','name'=>'note','style'=>'width: 250px; height: 200px;','value'=>$time->note));
// If we have custom fields - add controls for them.
if ($time->custom_fields && $time->custom_fields->fields[0]) {
  $smarty->assign('custom_fields', $time->custom_fields);
  // Only one custom field is supported at this time.
  if ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT) {
    $form->addInput(array('type'=>'text','name'=>'cf_1','value'=>$time->custom_field));
  } elseif ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN) {
    $form->addInput(array('type'=>'combobox',
      'name'=>'cf_1',
      'style'=>'width: 250px;',
      'value'=>$time->custom_field,
      'data'=>$time->custom_fields->options,
      'empty' => array('' => $i18n->getKey('dropdown.select'))));
  }
}
// Hidden control for record id.
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$time->id));
if ($user->isPluginEnabled('iv'))
  $form->addInput(array('type'=>'checkbox','name'=>'billable','data'=>1,'value'=>$time->billable));

$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_save or btn_copy click.
$form->addInput(array('type'=>'submit','name'=>'btn_save','onclick'=>'browser_today.value=get_date()','value'=>$i18n->getKey('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_copy','onclick'=>'browser_today.value=get_date()','value'=>$i18n->getKey('button.copy')));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->getKey('label.delete')));

if ($request->isPost()) {

  if ($request->getParameter('btn_delete')) {
    header("Location: time_delete.php?id=$time->id");
    exit();
  }

  // Validate user input.
  $err = $time->validate($err);

  if ($err->no()){
    if ($request->getParameter('btn_save')){
      // Now, an update.
      $res = ttTimeHelper::update(array(
              'id'=>$time->id,
              'date'=>$time->date->toString(DB_DATEFORMAT),
              'user_id'=>$user->getActiveUser(),
              'client'=>$time->client,
              'project'=>$time->project,
              'task'=>$time->task,
              'start'=>$time->start,
              'finish'=>$time->finish,
              'duration'=>$time->duration,
              'note'=>$time->note,
              'billable'=>$time->billable));

      // If we have custom fields - update values.
      if ($res && $time->custom_fields) {
        if ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT){
          $res = $time->custom_fields->update($time->id, $time->custom_fields->fields[0]['id'], null, $time->custom_field);
        }
        elseif ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN){
          $res = $time->custom_fields->update($time->id, $time->custom_fields->fields[0]['id'], $time->custom_field, null);
        }
      }

      if ($res){
        header('Location: time.php?date='.$time->date->toString(DB_DATEFORMAT));
        exit();
      }
    }

    if ($request->getParameter('btn_copy')){
      // Save as new record.
      $id = ttTimeHelper::insert(array(
        'date'=>$time->date->toString(DB_DATEFORMAT),
        'user_id'=>$user->getActiveUser(),
        'client'=>$time->client,
        'project'=>$time->project,
        'task'=>$time->task,
        'start'=>$time->start,
        'finish'=>$time->finish,
        'duration'=>$time->duration,
        'note'=>$time->note,
        'billable'=>$time->billable));

      // Insert a custom field if we have it.
      $res = true;
      if ($id && $time->custom_fields && $time->custom_field) {
        if ($time->custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
          $res = $time->custom_fields->insert($id, $time->custom_fields->fields[0]['id'], null, $time->custom_field);
        elseif ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
          $res = $time->custom_fields->insert($id, $time->custom_fields->fields[0]['id'], $time->custom_field, null);
      }
      if ($id && $res) {
        header('Location: time.php?date='.$time->date->toString(DB_DATEFORMAT));
        exit();
      }
    }
    $err->add($i18n->getKey('error.db'));
  }
}   // isPost

$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('title', $i18n->getKey('title.edit_time_record'));
$smarty->assign('content_page_name', 'time_edit.tpl');
$smarty->display('index.tpl');
