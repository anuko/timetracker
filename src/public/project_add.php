<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttProjectHelper');
import('ttGroupHelper');
import('ttFileHelper');

// Access checks.
if (!ttAccessAllowed('manage_projects')) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS != $user->getTrackingMode() && MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

$showFiles = $user->isPluginEnabled('at');
$users = ttGroupHelper::getActiveUsers();
foreach ($users as $user_item)
  $all_users[$user_item['id']] = $user_item['name'];

$tasks = ttGroupHelper::getActiveTasks();
foreach ($tasks as $task_item)
  $all_tasks[$task_item['id']] = $task_item['name'];
$show_tasks = MODE_PROJECTS_AND_TASKS == $user->getTrackingMode() && count($tasks) > 0;

$cl_name = $cl_description = '';
if ($request->isPost()) {
  $cl_name = trim($request->getParameter('project_name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_users = $request->getParameter('users', array());
  $cl_tasks = $request->getParameter('tasks', array());
} else {
  foreach ($users as $user_item)
    $cl_users[] = $user_item['id'];
  foreach ($tasks as $task_item)
    $cl_tasks[] = $task_item['id'];
}

$form = new Form('projectForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'project_name','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','value'=>$cl_description));
if ($showFiles)
  $form->addInput(array('type'=>'upload','name'=>'newfile','value'=>$i18n->get('button.submit')));
$form->addInput(array('type'=>'checkboxgroup','name'=>'users','data'=>$all_users,'layout'=>'H','value'=>$cl_users));
if ($show_tasks)
  $form->addInput(array('type'=>'checkboxgroup','name'=>'tasks','data'=>$all_tasks,'layout'=>'H','value'=>$cl_tasks));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  if (!ttGroupHelper::validateCheckboxGroupInput($cl_users, 'tt_users')) $err->add($i18n->get('error.field'), $i18n->get('label.users'));
  if (!ttGroupHelper::validateCheckboxGroupInput($cl_tasks, 'tt_tasks')) $err->add($i18n->get('error.field'), $i18n->get('label.tasks'));

  if ($err->no()) {
    if (!ttProjectHelper::getProjectByName($cl_name)) {
      $id = ttProjectHelper::insert(array('name' => $cl_name,
        'description' => $cl_description,
        'users' => $cl_users,
        'tasks' => $cl_tasks,
        'status' => ACTIVE));

      // Put a new file in storage if we have it.
      if ($id && $showFiles && $_FILES['newfile']['name']) {
        $fileHelper = new ttFileHelper($err);
        $fields = array('entity_type'=>'project',
          'entity_id' => $id,
          'file_name' => $_FILES['newfile']['name']);
        $fileHelper->putFile($fields);
      }
      if ($id) {
        header('Location: projects.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.object_exists'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.projectForm.project_name.focus()"');
$smarty->assign('show_files', $showFiles);
$smarty->assign('show_users', count($users) > 0);
$smarty->assign('show_tasks', $show_tasks);
$smarty->assign('title', $i18n->get('title.add_project'));
$smarty->assign('content_page_name', 'project_add.tpl');
$smarty->display('index.tpl');
