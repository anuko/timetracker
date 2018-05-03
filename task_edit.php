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
import('ttTeamHelper');
import('ttTaskHelper');

// Access checks.
if (!ttAccessAllowed('manage_tasks')) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS_AND_TASKS != $user->tracking_mode) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_task_id = (int)$request->getParameter('id');
$task = ttTaskHelper::get($cl_task_id);
if (!$task) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$projects = ttTeamHelper::getActiveProjects($user->group_id);

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_status = $request->getParameter('status');
  $cl_projects = $request->getParameter('projects');
} else {
  $cl_name = $task['name'];
  $cl_description = $task['description'];
  $cl_status = $task['status'];
  $assigned_projects = ttTaskHelper::getAssignedProjects($cl_task_id);
  foreach ($assigned_projects as $project_item)
    $cl_projects[] = $project_item['id'];
}

$form = new Form('taskForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_task_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->get('dropdown.status_active'),INACTIVE=>$i18n->get('dropdown.status_inactive'))));
$form->addInput(array('type'=>'checkboxgroup','name'=>'projects','layout'=>'H','data'=>$projects,'datakeys'=>array('id','name'),'value'=>$cl_projects));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_copy','value'=>$i18n->get('button.copy')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));

  if ($err->no()) {
    if ($request->getParameter('btn_save')) {
      $existing_task = ttTaskHelper::getTaskByName($cl_name);
      if (!$existing_task || ($cl_task_id == $existing_task['id'])) {
        // Update task information.
        if (ttTaskHelper::update(array(
          'task_id' => $cl_task_id,
          'name' => $cl_name,
          'description' => $cl_description,
          'status' => $cl_status,
          'projects' => $cl_projects))) {
          header('Location: tasks.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.task_exists'));
    }

    if ($request->getParameter('btn_copy')) {
      if (!ttTaskHelper::getTaskByName($cl_name)) {
        if (ttTaskHelper::insert(array(
          'group_id' => $user->group_id,
          'name' => $cl_name,
          'description' => $cl_description,
          'status' => $cl_status,
          'projects' => $cl_projects))) {
          header('Location: tasks.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.task_exists'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.edit_task'));
$smarty->assign('content_page_name', 'task_edit.tpl');
$smarty->display('index.tpl');
