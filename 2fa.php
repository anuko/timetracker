<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttUser');
import('ttUserHelper');

// Access checks.
// ... anything to check?
// End of access checks.


$cl_login = $request->getParameter('login');
if ($cl_login == null && $request->isGet()) $cl_login = @$_COOKIE[LOGIN_COOKIE_NAME];
$cl_password = $request->getParameter('password');
$cl_auth_code = $request->getParameter('auth_code');

$form = new Form('twoFactorAuthForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'login','value'=>$cl_login));
$form->getElement('login')->setEnabled(false);
$form->addInput(array('type'=>'password','maxlength'=>'50','name'=>'password','value'=>$cl_password));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'auth_code','value'=>$cl_auth_code));
$form->addInput(array('type'=>'submit','name'=>'btn_login','value'=>$i18n->get('button.login')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_login)) $err->add($i18n->get('error.field'), $i18n->get('label.login'));
  if (!ttValidString($cl_password)) $err->add($i18n->get('error.field'), $i18n->get('label.password'));
  if (!ttValidString($cl_auth_code)) $err->add($i18n->get('error.field'), $i18n->get('form.2fa.2fa_code'));

  if ($err->no()) {
    // Get user id.
    $user_id = ttUserHelper::getUserIdByTmpRef($cl_auth_code);
    if (!$user_id)
      $err->add($i18n->get('error.2fa_code'));

    if ($err->no()) {
      // Additionally check user password for better protection
      // against brute force attacks guessing 2FA codes.
      $user = new ttUser(null, $user_id); // Note: reusing $user from initialize.php.
      // Check user password.
      if (!$auth->doLogin($user->login, $cl_password))
        $err->add($i18n->get('error.auth'));
    }

    if ($err->no()) {
      // Redirect, depending on user role.
      if ($user->isClient()) {
        header('Location: reports.php');
      } else {
        header('Location: time.php');
      }
      exit();
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.twoFactorAuthForm.auth_code.focus()"');
$smarty->assign('title', $i18n->get('title.2fa'));
$smarty->assign('content_page_name', '2fa.tpl');
$smarty->display('index.tpl');
