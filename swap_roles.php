<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttUserHelper');

// Access checks.
if (!ttAccessAllowed('swap_roles')) {
  header('Location: access_denied.php');
  exit();
}
$users_for_swap = ttTeamHelper::getUsersForSwap();
if (!is_array($users_for_swap) || sizeof($users_for_swap) == 0) {
  header('Location: access_denied.php');
  exit();
}
if ($request->isPost()) {
  $user_id = (int)$request->getParameter('swap_with');
  $user_details = $user->getUserDetails($user_id);
  if (!$user_details) {
    header('Location: access_denied.php');
    exit();
  }
}
// End of access checks.

$form = new Form('swapForm');
$form->addInput(array('type'=>'combobox','name'=>'swap_with','data'=>$users_for_swap,'datakeys'=>array('id','name')));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {
    if (ttTeamHelper::swapRolesWith($user_id)) {
      header('Location: users.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }

  if ($request->getParameter('btn_cancel')) {
    header('Location: users.php');
    exit();
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.swapForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.swap_roles'));
$smarty->assign('content_page_name', 'swap_roles2.tpl');
$smarty->display('index2.tpl');
