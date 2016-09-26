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

// Access check.
if (!ttAccessCheck(right_manage_team) || (MODE_PROJECTS != $user->tracking_mode && MODE_PROJECTS_AND_TASKS != $user->tracking_mode)) {
  header('Location: access_denied.php');
  exit();
}

$cl_project_id = (int)$request->getParameter('id');

$users = ttTeamHelper::getActiveUsers();
foreach ($users as $user_item)
  $all_users[$user_item['id']] = $user_item['name'];

$tasks = ttTeamHelper::getActiveTasks($user->team_id);
foreach ($tasks as $task_item)
  $all_tasks[$task_item['id']] = $task_item['name'];

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('project_name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_status = $request->getParameter('status');
  $cl_users = $request->getParameter('users', array());
  $cl_tasks = $request->getParameter('tasks', array());
} else {
  $project = ttProjectHelper::get($cl_project_id);
  $cl_name = $project['name'];
  $cl_description = $project['description'];
  $cl_status = $project['status'];

  $mdb2 = getConnection();
  $sql = "select user_id from tt_user_project_binds where status = 1 and project_id = $cl_project_id";
  $res = $mdb2->query($sql);
  if (is_a($res, 'PEAR_Error'))
    die($res->getMessage());
  while ($row = $res->fetchRow())
    $cl_users[] = $row['user_id'];

  $cl_tasks = explode(',', $project['tasks']);
}

$form = new Form('projectForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_project_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'project_name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->getKey('dropdown.status_active'),INACTIVE=>$i18n->getKey('dropdown.status_inactive'))));
$form->addInput(array('type'=>'checkboxgroup','name'=>'users','data'=>$all_users,'layout'=>'H','value'=>$cl_users));
if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
  $form->addInput(array('type'=>'checkboxgroup','name'=>'tasks','data'=>$all_tasks,'layout'=>'H','value'=>$cl_tasks));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->getKey('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_copy','value'=>$i18n->getKey('button.copy')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.description'));

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
           $err->add($i18n->getKey('error.db'));
      } else
        $err->add($i18n->getKey('error.project_exists'));
    }

    if ($request->getParameter('btn_copy')) {
      if (!ttProjectHelper::getProjectByName($cl_name)) {
        if (ttProjectHelper::insert(array(
          'team_id' => $user->team_id,
          'name' => $cl_name,
          'description' => $cl_description,
          'users' => $cl_users,
          'tasks' => $cl_tasks,
          'status' => ACTIVE))) {
          header('Location: projects.php');
          exit();
        } else
          $err->add($i18n->getKey('error.db'));
      } else
        $err->add($i18n->getKey('error.project_exists'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.projectForm.name.focus()"');
$smarty->assign('title', $i18n->getKey('title.edit_project'));
$smarty->assign('content_page_name', 'project_edit.tpl');
$smarty->display('index.tpl');
