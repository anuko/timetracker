<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttAdmin');

// Access checks.
if (!ttAccessAllowed('administer_site')) {
  header('Location: access_denied.php');
  exit();
}
$group_id = (int)$request->getParameter('id');
$group_name = ttAdmin::getGroupName($group_id);
if (!($group_id && $group_name)) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$form = new Form('groupForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$group_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if (ttAdmin::markGroupDeleted($group_id)) {
      header('Location: admin_groups.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }

  if ($request->getParameter('btn_cancel')) {
    header('Location: admin_groups.php');
    exit();
  }
} // isPost

$smarty->assign('group_to_delete', $group_name);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.delete_group'));
$smarty->assign('content_page_name', 'admin_group_delete.tpl');
$smarty->display('index.tpl');
