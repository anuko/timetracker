<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttUser');
import('ttUserHelper');

if ($auth->isPasswordExternal()) {
  header('Location: login.php');
  exit();
}

$cl_login = $request->getParameter('login');

$form = new Form('resetPasswordForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'login','value'=>$cl_login));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.reset_password')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_login)) $err->add($i18n->get('error.field'), $i18n->get('label.login'));

  if ($err->no()) {
    if (!ttUserHelper::getUserByLogin($cl_login)) {
      // User with a specified login was not found.
      // In this case, if login looks like email, try finding user by email.
      if (ttValidEmail($cl_login)) {
        $login = ttUserHelper::getUserByEmail($cl_login);
        if ($login)
          $cl_login = $login;
        else
          $err->add($i18n->get('error.no_login'));
      } else
        $err->add($i18n->get('error.no_login'));
    }
  }

  if ($err->no()) {
    $user = new ttUser($cl_login); // Note: reusing $user from initialize.php here.

    // Protection against flooding user mailbox with too many password reset emails.
    if (ttUserHelper::recentRefExists($user->id)) $err->add($i18n->get('error.access_denied'));
  }

  if ($err->no()) {
    // Prepare and save a temporary reference for user.
    $cryptographically_strong = true;
    $random_bytes = openssl_random_pseudo_bytes(16, $cryptographically_strong);
    if ($random_bytes === false) die ("openssl_random_pseudo_bytes function call failed...");
    $temp_ref = bin2hex($random_bytes);
    ttUserHelper::saveTmpRef($temp_ref, $user->id);

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
      if (ttValidEmail($cl_login))
        $receiver = $cl_login;
      else
        $err->add($i18n->get('error.no_email'));
    }

    if ($receiver) {
      import('mail.Mailer');
      $mailer = new Mailer();
      $mailer->setCharSet(CHARSET);
      $mailer->setSender(SENDER);
      $mailer->setReceiver("$receiver");
      if ((!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off')) || ($_SERVER['SERVER_PORT'] == 443))
        $secure_connection = true;
      if($secure_connection)
        $http = 'https';
      else
        $http = 'http';

      $cl_subject = $user_i18n->get('form.reset_password.email_subject');

      $dir_name = trim(@constant('DIR_NAME'), '/');
      if (!empty($dir_name))
        $app_root = '/'.$dir_name;

      $pass_edit_url = $http.'://'.$_SERVER['HTTP_HOST'].$app_root.'/password_change.php?ref='.$temp_ref;

      $mailer->setMailMode(MAIL_MODE);
      if ($mailer->send($cl_subject, sprintf($user_i18n->get('form.reset_password.email_body'), $_SERVER['REMOTE_ADDR'], $pass_edit_url)))
        $msg->add($i18n->get('form.reset_password.message'));
      else
        $err->add($i18n->get('error.mail_send'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.resetPasswordForm.login.focus()"');
$smarty->assign('title', $i18n->get('title.reset_password'));
$smarty->assign('content_page_name', 'password_reset2.tpl');
$smarty->display('index2.tpl');
