<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttUserHelper');
import('ttRoleHelper');
import('ttConfigHelper');

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$group = ttGroupHelper::getGroupAttrs($user->getGroup());

if ($request->isPost()) {
  $cl_group = trim($request->getParameter('group_name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_bcc_email = trim($request->getParameter('bcc_email'));
  $cl_allow_ip = trim($request->getParameter('allow_ip'));
} else {
  $cl_group = $group['name'];
  $cl_description = $group['description'];
  $cl_bcc_email = $group['bcc_email'];
  $cl_allow_ip = $group['allow_ip'];
}

$form = new Form('groupAdvancedForm');
$form->addInput(array('type'=>'text','maxlength'=>'200','name'=>'group_name','value'=>$cl_group,'enable'=>$advanced_settings));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'bcc_email','value'=>$cl_bcc_email));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'allow_ip','value'=>$cl_allow_ip));

$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  if ($request->getParameter('btn_save')) {
    // Validate user input.
    if (!ttValidString($cl_group)) $err->add($i18n->get('error.field'), $i18n->get('label.group_name'));
    if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
    if (!ttValidEmail($cl_bcc_email, true)) $err->add($i18n->get('error.field'), $i18n->get('label.bcc'));
    if (!ttValidIP($cl_allow_ip, true)) $err->add($i18n->get('error.field'), $i18n->get('form.group_edit.allow_ip'));
    // Finished validating user input.

    if ($err->no()) {
      if ($user->updateGroup(array(
        'name' => $cl_group,
        'description' => $cl_description,
        'bcc_email' => $cl_bcc_email,
        'allow_ip' => $cl_allow_ip))) {
        header('Location: success.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.edit_group'));
$smarty->assign('content_page_name', 'group_advanced_edit.tpl');
$smarty->display('index.tpl');
