<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttGroupHelper');

// Access checks.
if (!(ttAccessAllowed('view_own_tasks') || ttAccessAllowed('manage_tasks'))) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

$config = $user->getConfigHelper();

if ($request->isPost()) {
  $cl_task_required = $request->getParameter('task_required');
} else {
  $cl_task_required = $config->getDefinedValue('task_required');
}

if($user->can('manage_tasks')) {
  $active_tasks = ttGroupHelper::getActiveTasks();
  $inactive_tasks = ttGroupHelper::getInactiveTasks();
} else
  $active_tasks = $user->getAssignedTasks();

$form = new Form('tasksForm');
$form->addInput(array('type'=>'checkbox','name'=>'task_required','value'=>$cl_task_required));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  if ($request->getParameter('btn_save')) {
    // Save button clicked. Update config.
    $config->setDefinedValue('task_required', $cl_task_required);
    if (!$user->updateGroup(array('config' => $config->getConfig()))) {
      $err->add($i18n->get('error.db'));
    }
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('active_tasks', $active_tasks);
$smarty->assign('inactive_tasks', $inactive_tasks);
$smarty->assign('title', $i18n->get('title.tasks'));
$smarty->assign('content_page_name', 'tasks.tpl');
$smarty->display('index.tpl');
