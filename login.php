<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttOrgHelper');
import('ttUser');
import('ttUserHelper');

// Access checks.
if ($request->isPost()) {
  // Validate that browser_today parameter is in correct format.
  $browser_today = $request->getParameter('browser_today');
  if ($browser_today && !ttValidDbDateFormatDate($browser_today)) {
    header('Location: access_denied.php');
    exit();
  }
}
// End of access checks.

$cl_login = $request->getParameter('login');
if ($cl_login == null && $request->isGet()) $cl_login = @$_COOKIE[LOGIN_COOKIE_NAME];
$cl_password = $request->getParameter('password');

$form = new Form('loginForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'login','value'=>$cl_login));
$form->addInput(array('type'=>'password','maxlength'=>'50','name'=>'password','value'=>$cl_password));
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_login click.
$form->addInput(array('type'=>'submit','name'=>'btn_login','onclick'=>'browser_today.value=get_date()','value'=>$i18n->get('button.login')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_login)) $err->add($i18n->get('error.field'), $i18n->get('label.login'));
  if (!ttValidString($cl_password)) $err->add($i18n->get('error.field'), $i18n->get('label.password'));

  $loginSucceeded = $use2FA = false;

  if ($err->no()) {
    // Use the "limit" plugin if we have one. Ignore include errors.
    // The "limit" plugin is not required for normal operation of Time Tracker.
    @include('plugins/limit/access_check.php');

    // Check user login.
    $loginSucceeded = $auth->doLogin($cl_login, $cl_password);
    if ($loginSucceeded) {
      // Remember user login in a cookie.
      setcookie(LOGIN_COOKIE_NAME, $cl_login, time() + COOKIE_EXPIRE, '/');
    } else {
      $err->add($i18n->get('error.auth'));
    }
  }

  // Do we have to use 2FA?
  if ($err->no() && $loginSucceeded) {
    $user = new ttUser(null, $auth->getUserId());

    if ($user->initialized) {
      // Determine if we have to additionally use two-factor authentication.
      $config = $user->getConfigHelper();
      $use2FA = $config->getDefinedValue('2fa');
    } else {
      $err->add($i18n->get('error.db'));
    }
  }

  // If we have to use 2FA, email auth code to user and redirect to 2fa.php.
  if ($err->no() && $use2FA && !$user->can('override_2fa')) {
    // To keep things simple, we use the same code as for password resets.
    $cryptographically_strong = true;
    $random_bytes = openssl_random_pseudo_bytes(16, $cryptographically_strong);
    if ($random_bytes === false) die ("openssl_random_pseudo_bytes function call failed...");
    $temp_ref = bin2hex($random_bytes);
    ttUserHelper::saveTmpRef($temp_ref, $user->id);

    // For user languague in email.
    $user_i18n = null;
    if ($user->lang != $i18n->lang) {
      $user_i18n = new I18n();
      $user_i18n->load($user->lang);
    } else
      $user_i18n = &$i18n;

    // Where do we email to?
    $receiver = null;
    if ($user->email)
      $receiver = $user->email;
    else {
      if (ttValidEmail($user->login))
        $receiver = $user->login;
    }
    if (!$receiver) $err->add($user_i18n->get('error.no_email'));

    // Send 2FA_code email to user.
    if ($receiver) {
      import('mail.Mailer');
      $mailer = new Mailer();
      $mailer->setCharSet(CHARSET);
      $mailer->setSender(SENDER);
      $mailer->setReceiver("$receiver");

      $subject = $user_i18n->get('email.2fa_code.subject');
      $body = sprintf($user_i18n->get('email.2fa_code.body'), $temp_ref);

      $mailer->setMailMode(MAIL_MODE);
      if (!$mailer->send($subject, $body))
        $err->add($i18n->get('error.mail_send'));
    }

    $auth->doLogout();

    // Redirect to 2fa.php if we have no errors.
    if ($err->no()) {
      header('Location: 2fa.php');
      exit();
    }
  }

  if ($err->no() && $loginSucceeded) {
    // Set current user date (as determined by user browser) into session.
    $current_user_date = $request->getParameter('browser_today', null);
    if ($current_user_date)
      $_SESSION['date'] = $current_user_date;

    // Redirect, depending on user role.
    if ($user->can('administer_site')) {
      header('Location: admin_groups.php');
    } elseif ($user->isClient()) {
      header('Location: reports.php');
    } else {
      header('Location: time.php');
    }
    exit();
  }
} // isPost

if(!isTrue('MULTIORG_MODE') && !ttOrgHelper::getOrgs())
  $err->add($i18n->get('error.no_groups'));

// Determine whether to show login hint. It is currently used only for Windows LDAP authentication.
$show_hint = ('ad' == isset($GLOBALS['AUTH_MODULE_PARAMS']['type']) ? $GLOBALS['AUTH_MODULE_PARAMS']['type'] : null);

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('show_hint', $show_hint);
$smarty->assign('onload', 'onLoad="document.loginForm.'.(!$cl_login?'login':'password').'.focus()"');
$smarty->assign('about_text', $i18n->get('form.login.about'));
$smarty->assign('title', $i18n->get('title.login'));
$smarty->assign('content_page_name', 'login.tpl');
$smarty->display('index.tpl');
