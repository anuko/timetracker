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

$cl_notification_id = (int)$request->getParameter('id');
$notification = ttNotificationHelper::get($cl_notification_id);
$notification_to_delete = $notification['name'];

$form = new Form('notificationDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_notification_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if(ttNotificationHelper::get($cl_notification_id)) {
      if (ttNotificationHelper::delete($cl_notification_id)) {
        header('Location: notifications.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
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
