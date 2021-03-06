<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttUserHelper');
import('ttRoleHelper');

// Access checks.
if (!ttAccessAllowed('manage_own_settings')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->exists()) {
  header('Location: access_denied.php');  // No users in subgroup.
  exit();
}
// End of access checks.

$can_manage_account = $user->behalfGroup ? $user->can('manage_subgroups') : $user->can('manage_own_account');
if ($user->behalf_id) $user_details = $user->getUserDetails($user->behalf_id);
$current_login = $user->behalf_id ? $user_details['login'] : $user->login;

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_login = trim($request->getParameter('login'));
  if (!$auth->isPasswordExternal()) {
    $cl_password1 = $request->getParameter('password1');
    $cl_password2 = $request->getParameter('password2');
  }
  $cl_email = trim($request->getParameter('email'));
} else {
  if ($user->behalf_id) {
    $cl_name = $user_details['name'];
    $cl_login = $user_details['login'];
    $cl_email = $user_details['email'];
  } else {
    $cl_name = $user->name;
    $cl_login = $user->login;
    $cl_email = $user->email;
  }
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
  if ($cl_login != $current_login && ttUserHelper::getUserByLogin($cl_login))
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
    $fields = $can_manage_account ?
      array('name'=>$cl_name,'login'=>$cl_login,'password'=>$cl_password1,'email'=>$cl_email) :
      array('password'=>$cl_password1);
    $update_result = ttUserHelper::update($user->getUser(), $fields);
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
