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
import('ttAdmin');

// Access checks.
if (!ttAccessAllowed('delete_group')) {
  header('Location: access_denied.php');
  exit();
}
$group_id = (int)$request->getParameter('id');
if ($user->group_id != $group_id) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Note: reuse ttAdmin class here because deleting a group is a complicated task.
// This creates an issue of using the class for not intended purpose.
// However, otherwise we have to duplicate code, so reuse it is, for now.
$admin = new ttAdmin();
$group_details = $admin->getGroupDetails($group_id);
$group_name = $group_details['group_name'];

$form = new Form('groupForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$group_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if ($admin->markGroupDeleted($group_id)) {
      $auth->doLogout();
      session_unset();
      header('Location: login.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }

  if ($request->getParameter('btn_cancel')) {
    header('Location: group_edit.php');
    exit();
  }
} // isPost

$smarty->assign('group_to_delete', $group_name);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.delete_group'));
$smarty->assign('content_page_name', 'group_delete.tpl');
$smarty->display('index.tpl');
