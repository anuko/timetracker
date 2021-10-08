<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('lk')) {
  header('Location: feature_disabled.php');
  exit();
}

$cl_lock_spec = $request->isPost() ? $request->getParameter('lock_spec') : $user->getLockSpec();

$form = new Form('lockingForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'lock_spec','style'=>'width: 250px;','value'=>$cl_lock_spec));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidCronSpec($cl_lock_spec)) $err->add($i18n->get('error.field'), $i18n->get('label.schedule'));

  if ($err->no()) {
    if ($user->updateGroup(array('lock_spec' => $cl_lock_spec))) {
      header('Location: group_edit.php');
      exit();
    } else {
      $err->add($i18n->get('error.db'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.locking'));
$smarty->assign('content_page_name', 'locking.tpl');
$smarty->display('index.tpl');
