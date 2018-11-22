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
import('ttGroupHelper');

// Access checks.
if (!ttAccessAllowed('delete_group')) {
  header('Location: access_denied.php'); // No rights.
  exit();
}
if (!$user->isGroupValid($request->getParameter('id'))) {
  header('Location: access_denied.php'); // Wrong group id.
  exit();
}
// End of access checks.

$group_id = (int)$request->getParameter('id');
$group_name = ttGroupHelper::getGroupName($group_id);

$form = new Form('groupForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$group_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    $markedDeleted = ttGroupHelper::markGroupDeleted($group_id);
    if ($markedDeleted) {
      // TODO: conditional redirects don't look nice. Any better ideas?
      if ($group_id == $user->group_id) {
        // We marked deleted our own group. Logout and redirect to login page.
        $auth->doLogout();
        session_unset();
        header('Location: login.php');
        exit();
      } else {
        // We marked deleted a subgroup. Redirect to groups.pgp.
        header('Location: groups.php');
        exit();
      }
    } else
      $err->add($i18n->get('error.db'));
  }

  if ($request->getParameter('btn_cancel')) {
    // TODO: conditional redirects don't look nice. Any better ideas?
    if ($group_id == $user->group_id) {
      header('Location: group_edit.php');
      exit();
    } else {
      header('Location: groups.php');
      exit();
    }
  }
} // isPost

$smarty->assign('group_to_delete', $group_name);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.delete_group'));
$smarty->assign('content_page_name', 'group_delete.tpl');
$smarty->display('index.tpl');
