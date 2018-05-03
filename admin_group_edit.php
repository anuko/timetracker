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
import('ttAdmin');

// Access checks.
if (!ttAccessAllowed('administer_site')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$group_id = $request->getParameter('id');

$admin = new ttAdmin();
$group_details = $admin->getGroupDetails($group_id);

if ($request->isPost()) {
  $cl_group_name = trim($request->getParameter('group_name'));
  $cl_manager_name = trim($request->getParameter('manager_name'));
  $cl_manager_login = trim($request->getParameter('manager_login'));
  if (!$auth->isPasswordExternal()) {
    $cl_password1 = $request->getParameter('password1');
    $cl_password2 = $request->getParameter('password2');
  }
  $cl_manager_email = trim($request->getParameter('manager_email'));
} else {
  $cl_group_name = $group_details['group_name'];
  $cl_manager_name = $group_details['manager_name'];
  $cl_manager_login = $group_details['manager_login'];
  if (!$auth->isPasswordExternal()) {
    $cl_password1 = $cl_password2 = '';
  }
  $cl_manager_email = $group_details['manager_email'];
}

$form = new Form('groupForm');
$form->addInput(array('type'=>'text','maxlength'=>'80','name'=>'group_name','value'=>$cl_group_name));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_name','value'=>$cl_manager_name));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_login','value'=>$cl_manager_login));
if (!$auth->isPasswordExternal()) {
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password1','value'=>$cl_password1));
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'password2','value'=>$cl_password2));
}
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_email','value'=>$cl_manager_email));
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$group_id));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_save')) {
    // Create fields array for ttAdmin instance.
    $fields = array(
      'old_group_name' => $group_details['group_name'],
      'new_group_name' => $cl_group_name,
      'user_id' => $group_details['manager_id'],
      'user_name' => $cl_manager_name,
      'old_login' => $group_details['manager_login'],
      'new_login' => $cl_manager_login,
      'password1' => $cl_password1,
      'password2' => $cl_password2,
      'email' => $cl_manager_email);

    import('ttAdmin');
    $admin = new ttAdmin($err);
    $result = $admin->updateGroup($group_id, $fields);
    if ($result) {
      header('Location: admin_groups.php');
      exit();
    }
  }

  if ($request->getParameter('btn_cancel')) {
    header('Location: admin_groups.php');
    exit();
  }
} // isPost

$smarty->assign('auth_external', $auth->isPasswordExternal());
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.groupForm.manager_name.focus()"');
$smarty->assign('title', $i18n->get('title.edit_group'));
$smarty->assign('content_page_name', 'admin_group_edit.tpl');
$smarty->display('index.tpl');
