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
import('ttUserHelper');
import('ttRoleHelper');

// Access checks.
if (!ttAccessAllowed('manage_own_settings')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$can_manage_account = $user->can('manage_own_account');

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_login = trim($request->getParameter('login'));
  if (!$auth->isPasswordExternal()) {
    $cl_password1 = $request->getParameter('password1');
    $cl_password2 = $request->getParameter('password2');
  }
  $cl_email = trim($request->getParameter('email'));
} else {
  $cl_name = $user->name;
  $cl_login = $user->login;
  $cl_email = $user->email;
}

$form = new Form('profileForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>$cl_name,'enable'=>$can_manage_account));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'login','value'=>$cl_login,'enable'=>$can_manage_account));
if (!$auth->isPasswordExternal()) {
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password1','value'=>$cl_password1));
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password2','value'=>$cl_password2));
}
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'email','value'=>$cl_email,'enable'=>$can_manage_account));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.person_name'));
  if (!ttValidString($cl_login)) $err->add($i18n->get('error.field'), $i18n->get('label.login'));

  // New login must be unique.
  if ($cl_login != $user->login && ttUserHelper::getUserByLogin($cl_login))
    $err->add($i18n->get('error.user_exists'));

  if (!$auth->isPasswordExternal() && ($cl_password1 || $cl_password2)) {
    if (!ttValidString($cl_password1)) $err->add($i18n->get('error.field'), $i18n->get('label.password'));
    if (!ttValidString($cl_password2)) $err->add($i18n->get('error.field'), $i18n->get('label.confirm_password'));
    if ($cl_password1 !== $cl_password2)
      $err->add($i18n->get('error.not_equal'), $i18n->get('label.password'), $i18n->get('label.confirm_password'));
  }
  if (!ttValidEmail($cl_email, true)) $err->add($i18n->get('error.field'), $i18n->get('label.email'));
  // Finished validating user input.

  if ($err->no()) {
    $update_result = ttUserHelper::update($user->id, array(
        'name' => $cl_name,
        'login' => $cl_login,
        'password' => $cl_password1,
        'email' => $cl_email,
        'status' => ACTIVE));
    if ($update_result) {
      header('Location: time.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('auth_external', $auth->isPasswordExternal());
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.profile'));
$smarty->assign('content_page_name', 'profile_edit.tpl');
$smarty->display('index.tpl');
