<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttNotificationHelper');

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('no')) {
  header('Location: feature_disabled.php');
  exit();
}
if (!$user->exists()) {
  header('Location: access_denied.php'); // No users in subgroup.
  exit();
}
$cl_notification_id = (int)$request->getParameter('id');
$notification = ttNotificationHelper::get($cl_notification_id);
if (!$notification) {
  header('Location: access_denied.php'); // Wrong notification id.
  exit();
}
// End of access checks.

$notification_to_delete = $notification['name'];

$form = new Form('notificationDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_notification_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if (ttNotificationHelper::delete($cl_notification_id)) {
      header('Location: notifications.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: notifications.php');
    exit();
  }
} // isPost

$smarty->assign('notification_to_delete', $notification_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.notificationDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_notification'));
$smarty->assign('content_page_name', 'notification_delete.tpl');
$smarty->display('index.tpl');
