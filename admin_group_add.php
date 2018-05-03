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
import('ttUserHelper');
import('ttRoleHelper');

// Access checks.
if (!ttAccessAllowed('administer_site')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

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
$form->addInput(array('type'=>'combobox','name'=>'lang','style'=>'width: 200px','data'=>$longname_lang,'datakeys'=>array('id','name'),'value'=>$cl_lang));

$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_name','value'=>$cl_manager_name));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_login','value'=>$cl_manager_login));
if (!$auth->isPasswordExternal()) {
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password1','value'=>$cl_password1));
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password2','value'=>$cl_password2));
}
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_email','value'=>$cl_manager_email));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));

if ($request->isPost()) {

  /*
   * Note: creating a group by admin is pretty much the same as self-registration,
   * except that created_by fields for group and user must be set to admin account.
   * Therefore, we'll reuse ttRegistrator instance to create a group here
   * and override created_by fields using ttRegistrator::setCreatedBy() function.
   */

  // Create fields array for ttRegistrator instance.
  if (!defined('CURRENCY_DEFAULT')) define('CURRENCY_DEFAULT', '$');
  $fields = array(
    'user_name' => $cl_manager_name,
    'login' => $cl_manager_login,
    'password1' => $cl_password1,
    'password2' => $cl_password2,
    'email' => $cl_manager_email,
    'group_name' => $cl_group_name,
    'currency' => CURRENCY_DEFAULT,
    'lang' => $cl_lang);

  // Create an instance of ttRegistrator class.
  import('ttRegistrator');
  $registrator = new ttRegistrator($fields, $err);
  $registrator->register();
  $registrator->setCreatedBy($user->id); // Override created_by to admin account.
  if ($err->no()) {
    header('Location: admin_groups.php');
    exit();
  }
} // isPost

$smarty->assign('auth_external', $auth->isPasswordExternal());
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.groupForm.group_name.focus()"');
$smarty->assign('content_page_name', 'admin_group_add.tpl');
$smarty->assign('title', $i18n->get('title.create_group'));
$smarty->display('index.tpl');
