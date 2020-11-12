<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('ttTaskHelper');
import('form.Form');

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

$task_to_delete = $task['name'];

$form = new Form('taskDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_task_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if(ttTaskHelper::get($cl_task_id)) {
      if (ttTaskHelper::delete($cl_task_id)) {
        header('Location: tasks.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.db'));
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: tasks.php');
    exit();
  }
} // isPost

$smarty->assign('task_to_delete', $task_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.taskDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_task'));
$smarty->assign('content_page_name', 'task_delete2.tpl');
$smarty->display('index2.tpl');
