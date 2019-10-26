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
import('ttWorkHelper');

// Access checks.
if (!ttAccessAllowed('manage_work')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('wk')) {
  header('Location: feature_disabled.php');
  exit();
}
// Do we have work_id?
$cl_work_id = (int)$request->getParameter('work_id');
if ($cl_work_id) {
  $workHelper = new ttWorkHelper($err);
  $work_item = $workHelper->getAvailableWorkItem($cl_work_id);
  if (!$work_item) {
    header('Location: access_denied.php');
    exit();
  }
}
// End of access checks.
if ($work_item) $cl_name = $work_item['subject'];

if ($request->isPost()) {
  $cl_message_body = trim($request->getParameter('message_body'));
}








$form = new Form('messageForm');
if ($cl_work_id) {
  $form->addInput(array('type'=>'hidden','name'=>'work_id','value'=>$cl_work_id));
}
$form->addInput(array('type'=>'textarea','name'=>'message_body','style'=>'width: 400px; height: 80px;vertical-align: middle','value'=>$cl_message_body));
$form->addInput(array('type'=>'submit','name'=>'btn_send','value'=>$i18n->get('work.button.send_message')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_message_body)) $err->add($i18n->get('error.field'), $i18n->get('work.label.message'));

  // Ensure user email exists (required for workflow).
  if (!$user->getEmail()) $err->add($i18n->get('error.no_email'));

  if ($err->no()) {
    $workHelper = new ttWorkHelper($err);
    $fields = array('work_id'=>$cl_work_id,
      'message_body' => $cl_message_body);
    if ($workHelper->sendMessage($fields)) {
      $msg->add($i18n->get('work.msg.message_sent'));
      //  header('Location: work.php'); // TODO: where to redirect?
      // exit();
    }
  }
} // isPost

$smarty->assign('work_item', $work_item);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.offerForm.work_name.focus()"');
$smarty->assign('title', $i18n->get('work.title.send_message'));
$smarty->assign('content_page_name', 'work_message.tpl');
$smarty->display('index.tpl');
