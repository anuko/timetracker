<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');

if (!isTrue('MULTIORG_MODE') || $auth->isPasswordExternal()) {
  header('Location: login.php');
  exit();
}

// Use the "limit" plugin if we have one. Ignore include errors.
// The "limit" plugin is not required for normal operation of Time Tracker.
@include('plugins/limit/register.php');

$auth->doLogout();

if (!defined('CURRENCY_DEFAULT')) define('CURRENCY_DEFAULT', '$');

if ($request->isPost()) {
  $cl_group_name = trim($request->getParameter('group_name'));
  $cl_currency = trim($request->getParameter('currency'));
  if (!$cl_currency) $cl_currency = CURRENCY_DEFAULT;
  $cl_lang = $request->getParameter('lang');
  $cl_manager_name = trim($request->getParameter('manager_name'));
  $cl_manager_login = trim($request->getParameter('manager_login'));
  $cl_password1 = $request->getParameter('password1');
  $cl_password2 = $request->getParameter('password2');
  $cl_manager_email = trim($request->getParameter('manager_email'));
} else {
  $cl_currency = CURRENCY_DEFAULT;
  $cl_lang = $i18n->lang; // Browser setting from initialize.php.
}

$form = new Form('groupForm');
$form->addInput(array('type'=>'text','maxlength'=>'200','name'=>'group_name','value'=>$cl_group_name));
$form->addInput(array('type'=>'text','maxlength'=>'7','name'=>'currency','value'=>$cl_currency));

// Prepare an array of available languages.
$lang_files = I18n::getLangFileList();
foreach ($lang_files as $lfile) {
  $content = file(RESOURCE_DIR."/".$lfile);
  $lname = '';
  foreach ($content as $line) {
    if (strstr($line, 'i18n_language')) {
      $a = explode('=', $line);
      $lname = trim(str_replace(';','',str_replace("'","",$a[1])));
      break;
    }
  }
  unset($content);
  $longname_lang[] = array('id'=>I18n::getLangFromFilename($lfile),'name'=>$lname);
}
$longname_lang = mu_sort($longname_lang, 'name');
$form->addInput(array('type'=>'combobox','name'=>'lang','data'=>$longname_lang,'datakeys'=>array('id','name'),'value'=>$cl_lang));

$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_name','value'=>$cl_manager_name));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_login','value'=>$cl_manager_login));
$form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password1','value'=>$cl_password1));
$form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password2','value'=>$cl_password2));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_email','value'=>$cl_manager_email));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));

if ($request->isPost()) {
  // Create fields array for ttRegistrator instance.
  $fields = array(
    'user_name' => $cl_manager_name,
    'login' => $cl_manager_login,
    'password1' => $cl_password1,
    'password2' => $cl_password2,
    'email' => $cl_manager_email,
    'group_name' => $cl_group_name,
    'currency' => $cl_currency,
    'lang' => $cl_lang);

  // Create an instance of ttRegistrator class.
  import('ttRegistrator');
  $registrator = new ttRegistrator($fields, $err);
  $registrator->register();

  if ($err->no()) {
    // Registration successful.
    if ($auth->doLogin($cl_manager_login, $cl_password1)) {
      setcookie(LOGIN_COOKIE_NAME, $cl_manager_login, time() + COOKIE_EXPIRE, '/');
      header('Location: time.php');
    } else {
      header('Location: login.php');
    }
    exit();
  }
} // isPost

$smarty->assign('title', $i18n->get('title.add_group'));
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.groupForm.group_name.focus()"');
$smarty->assign('content_page_name', 'register2.tpl');
$smarty->display('index2.tpl');
