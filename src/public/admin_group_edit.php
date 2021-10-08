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
$group_id = (int)$request->getParameter('id');
$group_name = ttAdmin::getGroupName($group_id);
if (!($group_id && $group_name)) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$org_details = ttAdmin::getOrgDetails($group_id);
if (!$org_details) $err->add($i18n->get('error.db'));

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
  $cl_group_name = $org_details['group_name'];
  $cl_manager_name = $org_details['manager_name'];
  $cl_manager_login = $org_details['manager_login'];
  if (!$auth->isPasswordExternal()) {
    $cl_password1 = $cl_password2 = '';
  }
  $cl_manager_email = $org_details['manager_email'];
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

    // Validate user input.
    if (!ttValidString($cl_group_name))
      $err->add($i18n->get('error.field'), $i18n->get('label.group_name'));
    if (!ttValidString($cl_manager_name))
      $err->add($i18n->get('error.field'), $i18n->get('label.manager_name'));
    if (!ttValidString($cl_manager_login))
      $err->add($i18n->get('error.field'), $i18n->get('label.manager_login'));
    // If we change login, it must be unique.
    if ($cl_manager_login != $org_details['manager_login']) {
      if (ttUserHelper::getUserByLogin($cl_manager_login)) {
        $err->add($i18n->get('error.user_exists'));
      }
    }
    if (!$auth->isPasswordExternal() && ($cl_password1 || $cl_password2)) {
      if (!ttValidString($cl_password1))
        $err->add($i18n->get('error.field'), $i18n->get('label.password'));
      if (!ttValidString($cl_password2))
        $err->add($i18n->get('error.field'), $i18n->get('label.confirm_password'));
      if ($cl_password1 !== $cl_password2)
        $err->add($i18n->get('error.not_equal'), $i18n->get('label.password'), $i18n->get('label.confirm_password'));
    }
    if (!ttValidEmail($cl_manager_email, true))
      $err->add($i18n->get('error.field'), $i18n->get('label.email'));

    if ($err->no()) {
      if (ttAdmin::updateGroup(array('group_id' => $group_id,
        'old_group_name' => $org_details['group_name'],
        'new_group_name' => $cl_group_name,
        'user_id' => $org_details['manager_id'],
        'user_name' => $cl_manager_name,
        'old_login' => $org_details['manager_login'],
        'new_login' => $cl_manager_login,
        'password1' => $cl_password1,
        'password2' => $cl_password2,
        'email' => $cl_manager_email))) {
        header('Location: admin_groups.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
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
