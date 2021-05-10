<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttUserHelper');
import('ttAdmin');

// Access checks.
if (!ttAccessAllowed('administer_site')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$cl_group_name = $cl_lang = $cl_manager_name = $cl_manager_login =
$cl_password1 = $cl_password2 = $cl_manager_email = '';
if ($request->isPost()) {
  $cl_group_name = trim($request->getParameter('group_name'));
  $cl_lang = $request->getParameter('lang');
  $cl_manager_name = trim($request->getParameter('manager_name'));
  $cl_manager_login = trim($request->getParameter('manager_login'));
  if (!$auth->isPasswordExternal()) {
    $cl_password1 = $request->getParameter('password1');
    $cl_password2 = $request->getParameter('password2');
  }
  $cl_manager_email = trim($request->getParameter('manager_email'));
} else
  $cl_lang = $i18n->lang; // Browser setting from initialize.php.

$form = new Form('groupForm');
$form->addInput(array('type'=>'text','maxlength'=>'200','name'=>'group_name','value'=>$cl_group_name));

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
if (!$auth->isPasswordExternal()) {
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password1','value'=>$cl_password1));
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password2','value'=>$cl_password2));
}
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_email','value'=>$cl_manager_email));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_group_name))
    $err->add($i18n->get('error.field'), $i18n->get('label.group_name'));
  if (!ttValidString($cl_manager_name))
    $err->add($i18n->get('error.field'), $i18n->get('label.manager_name'));
  if (!ttValidString($cl_manager_login))
    $err->add($i18n->get('error.field'), $i18n->get('label.manager_login'));
  if (ttUserHelper::getUserByLogin($cl_manager_login))
    $err->add($i18n->get('error.user_exists'));
  if (!ttValidString($cl_password1))
    $err->add($i18n->get('error.field'), $i18n->get('label.password'));
  if (!ttValidString($cl_password2))
    $err->add($i18n->get('error.field'), $i18n->get('label.confirm_password'));
  if ($cl_password1 !== $cl_password2)
    $err->add($i18n->get('error.not_equal'), $i18n->get('label.password'), $i18n->get('label.confirm_password'));
  if (!ttValidEmail($cl_manager_email, true))
    $err->add($i18n->get('error.field'), $i18n->get('label.email'));
  if (!ttUserHelper::canAdd())
    $err->add($i18n->get('error.user_count'));

  if (!defined('CURRENCY_DEFAULT')) define('CURRENCY_DEFAULT', '$');

  if ($err->no()) {
    if (ttAdmin::createOrg(array('group_name' => $cl_group_name,
      'currency' => CURRENCY_DEFAULT,
      'lang' => $cl_lang,
      'user_name' => $cl_manager_name,
      'login' => $cl_manager_login,
      'password' => $cl_password1,
      'email' => $cl_manager_email))) {
      header('Location: admin_groups.php');
      exit();
    } else {
      $err->add($i18n->get('error.db'));
    }
  }
} // isPost

$smarty->assign('auth_external', $auth->isPasswordExternal());
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.groupForm.group_name.focus()"');
$smarty->assign('content_page_name', 'admin_group_add.tpl');
$smarty->assign('title', $i18n->get('title.add_group'));
$smarty->display('index.tpl');
