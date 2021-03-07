<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('../initialize.php');
import('form.Form');
import('ttOrgHelper');
import('ttUser');

// Mobile pages are no longer separate. Redirect to main page.
header('Location: ../login.php');
exit();
// Below is no longer used code.


if ($request->isPost()) {
  $cl_login = $request->getParameter('login');
} else {
  $cl_login = @$_COOKIE[LOGIN_COOKIE_NAME];
}
$cl_password = $request->getParameter('password');

$form = new Form('loginForm');
$form->addInput(array('type'=>'text','size'=>'25','maxlength'=>'100','name'=>'login','style'=>'width: 220px;','value'=>$cl_login));
$form->addInput(array('type'=>'password','size'=>'25','maxlength'=>'50','name'=>'password','style'=>'width: 220px;','value'=>$cl_password));
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_login click.
$form->addInput(array('type'=>'submit','name'=>'btn_login','onclick'=>'browser_today.value=get_date()','value'=>$i18n->get('button.login')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_login)) $err->add($i18n->get('error.field'), $i18n->get('label.login'));
  if (!ttValidString($cl_password)) $err->add($i18n->get('error.field'), $i18n->get('label.password'));

  if ($err->no()) {

    // Use the "limit" plugin if we have one. Ignore include errors.
    // The "limit" plugin is not required for normal operation of Time Tracker.
    @include('../plugins/limit/access_check.php');

    if ($auth->doLogin($cl_login, $cl_password)) {

      // Set current user date (as determined by user browser) into session.
      $current_user_date = $request->getParameter('browser_today', null);
      if ($current_user_date)
        $_SESSION['date'] = $current_user_date;

      // Remember user login in a cookie.
      setcookie(LOGIN_COOKIE_NAME, $cl_login, time() + COOKIE_EXPIRE, '/');

      $user = new ttUser(null, $auth->getUserId());
      // Redirect, depending on user role.
      if ($user->can('administer_site')) {
        header('Location: ../admin_groups.php');
      } elseif ($user->isClient()) {
        header('Location: ../reports.php');
      } else {
        header('Location: time.php');
      }
      exit();
    } else
      $err->add($i18n->get('error.auth'));
  }
} // isPost

if(!isTrue('MULTIORG_MODE') && !ttOrgHelper::getOrgs())
  $err->add($i18n->get('error.no_groups'));

// Determine whether to show login hint. It is currently used only for Windows LDAP authentication.
$show_hint = ('ad' == $GLOBALS['AUTH_MODULE_PARAMS']['type']);

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('show_hint', $show_hint);
$smarty->assign('onload', 'onLoad="document.loginForm.'.(!$cl_login?'login':'password').'.focus()"');
$smarty->assign('title', $i18n->get('title.login'));
$smarty->assign('content_page_name', 'mobile/login.tpl');
$smarty->display('mobile/index.tpl');
