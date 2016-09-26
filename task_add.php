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
import('form.ActionForm');
import('ttTeamHelper');
import('ttTaskHelper');

// Access check.
if (!ttAccessCheck(right_manage_team) || MODE_PROJECTS_AND_TASKS != $user->tracking_mode) {
  header('Location: access_denied.php');
  exit();
}

$projects = ttTeamHelper::getActiveProjects($user->team_id);

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_projects = $request->getParameter('projects');
} else {
  foreach ($projects as $project_item)
    $cl_projects[] = $project_item['id'];
}

$form = new Form('taskForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'checkboxgroup','name'=>'projects','layout'=>'H','data'=>$projects,'datakeys'=>array('id','name'),'value'=>$cl_projects));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->getKey('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.description'));

  if ($err->no()) {
    if (!ttTaskHelper::getTaskByName($cl_name)) {
      if (ttTaskHelper::insert(array(
        'team_id' => $user->team_id,
        'name' => $cl_name,
        'description' => $cl_description,
        'status' => ACTIVE,
        'projects' => $cl_projects))) {
          header('Location: tasks.php');
          exit();
        } else
          $err->add($i18n->getKey('error.db'));
    } else
      $err->add($i18n->getKey('error.task_exists'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.taskForm.name.focus()"');
$smarty->assign('title', $i18n->getKey('title.add_task'));
$smarty->assign('content_page_name', 'task_add.tpl');
$smarty->display('index.tpl');
