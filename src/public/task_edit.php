<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttGroupHelper');
import('ttTaskHelper');

// Access checks.
if (!ttAccessAllowed('manage_tasks')) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
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

$projects = ttGroupHelper::getActiveProjects();

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_status = $request->getParameter('status');
  $cl_projects = $request->getParameter('projects');
  if ($cl_projects == null) $cl_projects = array();
} else {
  $cl_name = $task['name'];
  $cl_description = $task['description'];
  $cl_status = $task['status'];
  $assigned_projects = ttTaskHelper::getAssignedProjects($cl_task_id);
  $cl_projects = array();
  foreach ($assigned_projects as $project_item)
    $cl_projects[] = $project_item['id'];
}

$form = new Form('taskForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_task_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','value'=>$cl_description));
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
        $err->add($i18n->get('error.object_exists'));
    }

    if ($request->getParameter('btn_copy')) {
      if (!ttTaskHelper::getTaskByName($cl_name)) {
        if (ttTaskHelper::insert(array(
          'name' => $cl_name,
          'description' => $cl_description,
          'status' => $cl_status,
          'projects' => $cl_projects))) {
          header('Location: tasks.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.object_exists'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('show_projects', count($projects) > 0);
$smarty->assign('title', $i18n->get('title.edit_task'));
$smarty->assign('content_page_name', 'task_edit.tpl');
$smarty->display('index.tpl');
