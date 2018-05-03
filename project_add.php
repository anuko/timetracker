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
import('ttProjectHelper');
import('ttTeamHelper');

// Access checks.
if (!ttAccessAllowed('manage_projects')) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS != $user->tracking_mode && MODE_PROJECTS_AND_TASKS != $user->tracking_mode) {
  header('Location: feature_disabled.php');
  exit();
}

$users = ttTeamHelper::getActiveUsers();
foreach ($users as $user_item)
  $all_users[$user_item['id']] = $user_item['name'];

$tasks = ttTeamHelper::getActiveTasks($user->group_id);
foreach ($tasks as $task_item)
  $all_tasks[$task_item['id']] = $task_item['name'];

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
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'project_name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'checkboxgroup','name'=>'users','data'=>$all_users,'layout'=>'H','value'=>$cl_users));
if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
  $form->addInput(array('type'=>'checkboxgroup','name'=>'tasks','data'=>$all_tasks,'layout'=>'H','value'=>$cl_tasks));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));

  if ($err->no()) {
    if (!ttProjectHelper::getProjectByName($cl_name)) {
      if (ttProjectHelper::insert(array(
        'group_id' => $user->group_id,
        'name' => $cl_name,
        'description' => $cl_description,
        'users' => $cl_users,
        'tasks' => $cl_tasks,
        'status' => ACTIVE))) {
          header('Location: projects.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.project_exists'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.projectForm.project_name.focus()"');
$smarty->assign('title', $i18n->get('title.add_project'));
$smarty->assign('content_page_name', 'project_add.tpl');
$smarty->display('index.tpl');
