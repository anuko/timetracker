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

$cl_2fa_code = $request->getParameter('2fa_code');

$form = new Form('2faForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'2fa_code','value'=>$cl_2fa_code));
$form->addInput(array('type'=>'submit','name'=>'btn_login','value'=>$i18n->get('button.login')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_2fa_code)) $err->add($i18n->get('error.field'), $i18n->get('form.2fa.2fa_code'));

  // Get user id.
  $user_id = ttUserHelper::getUserIdByTmpRef($cl_2fa_code);
  if (!$user_id) $err->add($i18n->get('error.2fa_code'));

  if ($err->no()) {
    $user = new ttUser(null, $user_id); // Note: reusing $user from initialize.php.
    $auth->setAuth($user_id, $user->login);

    // Redirect, depending on user role.
    if ($user->isClient()) {
      header('Location: reports.php');
    } else {
      header('Location: time.php');
    }
    exit();
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.2faForm.2fa_code.focus()"');
$smarty->assign('title', $i18n->get('title.2fa'));
$smarty->assign('content_page_name', '2fa.tpl');
$smarty->display('index.tpl');
