<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttProjectHelper');
import('ttGroupHelper');

// Access checks.
if (!ttAccessAllowed('manage_projects')) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS != $user->getTrackingMode() && MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_project_id = (int)$request->getParameter('id');
$project = ttProjectHelper::get($cl_project_id);
if (!$project) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$users = ttGroupHelper::getActiveUsers();
foreach ($users as $user_item)
  $all_users[$user_item['id']] = $user_item['name'];

$tasks = ttGroupHelper::getActiveTasks();
foreach ($tasks as $task_item)
  $all_tasks[$task_item['id']] = $task_item['name'];
$show_tasks = MODE_PROJECTS_AND_TASKS == $user->getTrackingMode() && count($tasks) > 0;

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('project_name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_status = $request->getParameter('status');
  $cl_users = $request->getParameter('users', array());
  $cl_tasks = $request->getParameter('tasks', array());
} else {
  $cl_name = $project['name'];
  $cl_description = $project['description'];
  $cl_status = $project['status'];
  $cl_users = ttProjectHelper::getAssignedUsers($cl_project_id);
  $cl_tasks = explode(',', $project['tasks']);
}

$form = new Form('projectForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_project_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'project_name','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','value'=>$cl_description));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->get('dropdown.status_active'),INACTIVE=>$i18n->get('dropdown.status_inactive'))));
$form->addInput(array('type'=>'checkboxgroup','name'=>'users','data'=>$all_users,'layout'=>'H','value'=>$cl_users));
if ($show_tasks)
  $form->addInput(array('type'=>'checkboxgroup','name'=>'tasks','data'=>$all_tasks,'layout'=>'H','value'=>$cl_tasks));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_copy','value'=>$i18n->get('button.copy')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  if (!ttGroupHelper::validateCheckboxGroupInput($cl_users, 'tt_users')) $err->add($i18n->get('error.field'), $i18n->get('label.users'));
  if (!ttGroupHelper::validateCheckboxGroupInput($cl_tasks, 'tt_tasks')) $err->add($i18n->get('error.field'), $i18n->get('label.tasks'));

  if ($err->no()) {
    if ($request->getParameter('btn_save')) {
      $existing_project = ttProjectHelper::getProjectByName($cl_name);
      if (!$existing_project || ($cl_project_id == $existing_project['id'])) {
        // Update project information.
        if (ttProjectHelper::update(array(
          'id' => $cl_project_id,
          'name' => $cl_name,
          'description' => $cl_description,
          'status' => $cl_status,
          'users' => $cl_users,
          'tasks' => $cl_tasks))) {
          header('Location: projects.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.object_exists'));
    }

    if ($request->getParameter('btn_copy')) {
      if (!ttProjectHelper::getProjectByName($cl_name)) {
        if (ttProjectHelper::insert(array('name' => $cl_name,
          'description' => $cl_description,
          'users' => $cl_users,
          'tasks' => $cl_tasks,
          'status' => ACTIVE))) {
          header('Location: projects.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.object_exists'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.projectForm.project_name.focus()"');
$smarty->assign('show_users', count($users) > 0);
$smarty->assign('show_tasks', $show_tasks);
$smarty->assign('title', $i18n->get('title.edit_project'));
$smarty->assign('content_page_name', 'project_edit.tpl');
$smarty->display('index.tpl');
