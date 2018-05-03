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
import('ttUser');
import('ttUserHelper');

if ($auth->isPasswordExternal()) {
  header('Location: login.php');
  exit();
}

$form = new Form('resetPasswordForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'login','style'=>'width: 300px;'));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.reset_password')));

if ($request->isPost()) {
  $cl_login = $request->getParameter('login');

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

    // Prepare and save a temporary reference for user.
    $temp_ref = md5(uniqid());
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
      $sender = new Mailer();
      $sender->setCharSet(CHARSET);
      $sender->setSender(SENDER);
      $sender->setReceiver("$receiver");
      if ((!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off')) || ($_SERVER['SERVER_PORT'] == 443))
        $secure_connection = true;
      if($secure_connection)
        $http = 'https';
      else
        $http = 'http';

      $cl_subject = $user_i18n->get('form.reset_password.email_subject');
      if (APP_NAME)
        $pass_edit_url = $http.'://'.$_SERVER['HTTP_HOST'].'/'.APP_NAME.'/password_change.php?ref='.$temp_ref;
      else
        $pass_edit_url = $http.'://'.$_SERVER['HTTP_HOST'].'/password_change.php?ref='.$temp_ref;

      $sender->setMailMode(MAIL_MODE);
      $res = $sender->send($cl_subject, sprintf($user_i18n->get('form.reset_password.email_body'), $_SERVER['REMOTE_ADDR'], $pass_edit_url));
      $smarty->assign('result_message', $res ? $i18n->get('form.reset_password.message') : $i18n->get('error.mail_send'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.resetPasswordForm.login.focus()"');
$smarty->assign('title', $i18n->get('title.reset_password'));
$smarty->assign('content_page_name', 'password_reset.tpl');
$smarty->display('index.tpl');
