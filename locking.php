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

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('lk')) {
  header('Location: feature_disabled.php');
  exit();
}

$cl_lock_spec = $request->isPost() ? $request->getParameter('lock_spec') : $user->lock_spec;

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
