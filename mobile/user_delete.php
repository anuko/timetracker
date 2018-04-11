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

require_once('../initialize.php');
import('form.Form');
import('ttUser');

// Access checks.
if (!ttAccessAllowed('manage_users')) {
  header('Location: access_denied.php');
  exit();
}
$user_id = (int)$request->getParameter('id');
$user_details = $user->getUser($user_id);
if (!$user_details) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$smarty->assign('user_to_delete', $user_details['name']." (".$user_details['login'].")");

// Create confirmation form.
$form = new Form('userDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$user_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if ($user->markUserDeleted($user_id)) {
      // If we deleted the "on behalf" user reset its info in session.
      if ($user_id == $user->behalf_id) {
        unset($_SESSION['behalf_id']);
        unset($_SESSION['behalf_name']);
      }
      // If we deleted our own account, do housekeeping and logout.
      if ($user->id == $user_id) {
        // Remove tt_login cookie that stores login name.
        unset($_COOKIE['tt_login']);
        setcookie('tt_login', NULL, -1);

        $auth->doLogout();
        header('Location: login.php');
      } else {
        header('Location: users.php');
      }
      exit();
    } else {
      $err->add($i18n->get('error.db'));
    }
  }
  if ($request->getParameter('btn_cancel')) {
    header('Location: users.php');
    exit();
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.delete_user'));
$smarty->assign('content_page_name', 'mobile/user_delete.tpl');
$smarty->display('mobile/index.tpl');
