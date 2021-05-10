<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttGroupHelper');

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
// End of access checks.

// TODO: extend and re-design notifications.
// Currently they only work with fav reports, which are bound to users.

$form = new Form('notificationsForm');

if ($request->isPost()) {
  if ($request->getParameter('btn_add')) {
    // The Add button clicked. Redirect to notification_add.php page.
    header('Location: notification_add.php');
    exit();
  }
} else {
  $form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));
  $notifications = ttGroupHelper::getNotifications();
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('notifications', $notifications);
$smarty->assign('title', $i18n->get('title.notifications'));
$smarty->assign('content_page_name', 'notifications.tpl');
$smarty->display('index.tpl');
