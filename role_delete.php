<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('ttRoleHelper');
import('form.Form');

// Access check.
if (!ttAccessAllowed('manage_roles')) {
  header('Location: access_denied.php');
  exit();
}
$cl_role_id = (int)$request->getParameter('id');
$role = ttRoleHelper::get($cl_role_id);
if (!$role) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$role_to_delete = $role['name'];

$form = new Form('roleDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_role_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if(ttRoleHelper::get($cl_role_id)) {
      if (ttRoleHelper::delete($cl_role_id)) {
        header('Location: roles.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.db'));
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: roles.php');
    exit();
  }
} // isPost

$smarty->assign('role_to_delete', $role_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.taskDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_role'));
$smarty->assign('content_page_name', 'role_delete.tpl');
$smarty->display('index.tpl');
