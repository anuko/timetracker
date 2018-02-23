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
import('ttTaskHelper');
import('form.Form');

// Access check.
if (!ttAccessCheck(right_manage_team) || MODE_PROJECTS_AND_TASKS != $user->tracking_mode) {
  header('Location: access_denied.php');
  exit();
}

$cl_task_id = (int)$request->getParameter('id');
$task = ttTaskHelper::get($cl_task_id);
$task_to_delete = $task['name'];

$form = new Form('taskDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_task_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->getKey('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->getKey('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if(ttTaskHelper::get($cl_task_id)) {
      if (ttTaskHelper::delete($cl_task_id)) {
        header('Location: tasks.php');
        exit();
      } else
        $err->add($i18n->getKey('error.db'));
    } else
      $err->add($i18n->getKey('error.db'));
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: tasks.php');
    exit();
  }
} // isPost

$smarty->assign('task_to_delete', $task_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.taskDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->getKey('title.delete_task'));
$smarty->assign('content_page_name', 'task_delete.tpl');
$smarty->display('index.tpl');
