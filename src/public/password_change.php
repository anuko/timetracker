<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttUserHelper');
import('ttUser');

$auth->doLogout();

// Access checks.
$cl_ref = $request->getParameter('ref');
if (!$cl_ref || $auth->isPasswordExternal()) {
  header('Location: login.php');
  exit();
}
$user_id = ttUserHelper::getUserIdByTmpRef($cl_ref);
if (!$user_id) {
  header('Location: access_denied.php'); // No user found by provided reference.
  exit();
}
// End of access checks.

$user = new ttUser(null, $user_id); // Note: reusing $user from initialize.php.
// In case user language is different - reload $i18n.
if ($i18n->lang != $user->lang) {
  $i18n->load($user->lang);
  $smarty->assign('i18n', $i18n->keys);
}
if ($user->custom_logo) {
  $smarty->assign('custom_logo', 'img/'.$user->group_id.'.png');
  $smarty->assign('mobile_custom_logo', '../img/'.$user->group_id.'.png');
}
$smarty->assign('user', $user);

$cl_password1 = $request->getParameter('password1');
$cl_password2 = $request->getParameter('password2');

$form = new Form('newPasswordForm');
$form->addInput(array('type'=>'password','maxlength'=>'120','name'=>'password1','value'=>$cl_password1));
$form->addInput(array('type'=>'password','maxlength'=>'120','name'=>'password2','value'=>$cl_password2));
$form->addInput(array('type'=>'hidden','name'=>'ref','value'=>$cl_ref));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_password1)) $err->add($i18n->get('error.field'), $i18n->get('label.password'));
  if (!ttValidString($cl_password2)) $err->add($i18n->get('error.field'), $i18n->get('label.confirm_password'));
  if ($cl_password1 !== $cl_password2)
    $err->add($i18n->get('error.not_equal'), $i18n->get('label.password'), $i18n->get('label.confirm_password'));

  if ($err->no()) {
    // Use the "limit" plugin if we have one. Ignore include errors.
    // The "limit" plugin is not required for normal operation of Time Tracker.
    $cl_login = $user->login; // $cl_login is used in access_check.cpp.
    @include('plugins/limit/access_check.php');

    ttUserHelper::setPassword($user_id, $cl_password1);

    if ($auth->doLogin($user->login, $cl_password1)) {
      setcookie(LOGIN_COOKIE_NAME, $user->login, time() + COOKIE_EXPIRE, '/');
      // Redirect, depending on user role.
      if ($user->can('administer_site')) {
        header('Location: admin_groups.php');
      } elseif ($user->isClient()) {
        header('Location: reports.php');
      } else {
        header('Location: time.php');
      }
      exit();
    } else {
      $err->add($i18n->get('error.auth'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName() => $form->toArray()));
$smarty->assign('title', $i18n->get('title.change_password'));
$smarty->assign('content_page_name', 'password_change.tpl');
$smarty->display('index.tpl');
