<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('form.ActionForm');
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
// End of access checks.

$projects = ttGroupHelper::getActiveProjects();

$cl_name = $cl_description = '';
if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_projects = $request->getParameter('projects');
} else {
  foreach ($projects as $project_item)
    $cl_projects[] = $project_item['id'];
}

$form = new Form('taskForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','value'=>$cl_description));
$form->addInput(array('type'=>'checkboxgroup','name'=>'projects','layout'=>'H','data'=>$projects,'datakeys'=>array('id','name'),'value'=>$cl_projects));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));

  if ($err->no()) {
    if (!ttTaskHelper::getTaskByName($cl_name)) {
      if (ttTaskHelper::insert(array(
        'name' => $cl_name,
        'description' => $cl_description,
        'status' => ACTIVE,
        'projects' => $cl_projects))) {
          header('Location: tasks.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.object_exists'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('show_projects', count($projects) > 0);
$smarty->assign('onload', 'onLoad="document.taskForm.name.focus()"');
$smarty->assign('title', $i18n->get('title.add_task'));
$smarty->assign('content_page_name', 'task_add.tpl');
$smarty->display('index.tpl');
