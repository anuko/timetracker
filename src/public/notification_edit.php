<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
require_once(LIBRARY_DIR.'/tdcron/class.tdcron.php');
require_once(LIBRARY_DIR.'/tdcron/class.tdcron.entry.php');
import('form.Form');
import('ttFavReportHelper');
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
$notification_id = (int)$request->getParameter('id');
$notification = ttNotificationHelper::get($notification_id);
if (!$notification) {
  header('Location: access_denied.php'); // Wrong notification id.
  exit();
}
if ($request->isPost()) {
  $cl_fav_report_id = (int) $request->getParameter('fav_report');
  if ($cl_fav_report_id && !ttFavReportHelper::get($cl_fav_report_id)) {
    header('Location: access_denied.php'); // Invalid fav report id in post.
    exit();
  }
}
// End of access checks.

$fav_reports = ttFavReportHelper::getReports();

if ($request->isPost()) {
  $cl_cron_spec = trim($request->getParameter('cron_spec'));
  $cl_email = trim($request->getParameter('email'));
  $cl_cc = trim($request->getParameter('cc'));
  $cl_subject = trim($request->getParameter('subject'));
  $cl_comment = trim($request->getParameter('comment'));
  $cl_report_condition = trim($request->getParameter('report_condition'));
} else {
  $notification = ttNotificationHelper::get($notification_id);
  $cl_fav_report_id = $notification['report_id'];
  $cl_cron_spec = $notification['cron_spec'];
  $cl_email = $notification['email'];
  $cl_cc = $notification['cc'];
  $cl_subject = $notification['subject'];
  $cl_comment = $notification['comment'];
  $cl_report_condition = $notification['report_condition'];
}

$form = new Form('notificationForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$notification_id));
$form->addInput(array('type'=>'combobox',
  'name'=>'fav_report',
  'value'=>$cl_fav_report_id,
  'data'=>$fav_reports,
  'datakeys'=>array('id','name'),
  'empty'=>array(''=>$i18n->get('dropdown.select'))));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'cron_spec','value'=>$cl_cron_spec));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'email','value'=>$cl_email));
$form->addInput(array('type'=>'text','name'=>'cc','value'=>$cl_cc));
$form->addInput(array('type'=>'text','name'=>'subject','value'=>$cl_subject));
$form->addInput(array('type'=>'textarea','name'=>'comment','value'=>$cl_comment));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'report_condition','value'=>$cl_report_condition));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!$cl_fav_report_id) $err->add($i18n->get('error.report'));
  if (!ttValidCronSpec($cl_cron_spec)) $err->add($i18n->get('error.field'), $i18n->get('label.schedule'));
  if (!ttValidEmailList($cl_email)) $err->add($i18n->get('error.field'), $i18n->get('form.email'));
  if (!ttValidEmailList($cl_cc, true)) $err->add($i18n->get('error.field'), $i18n->get('label.cc'));
  if (!ttValidString($cl_subject, true)) $err->add($i18n->get('error.field'), $i18n->get('label.subject'));
  if (!ttValidString($cl_comment, true)) $err->add($i18n->get('error.field'), $i18n->get('label.comment'));
  if (!ttValidCondition($cl_report_condition)) $err->add($i18n->get('error.field'), $i18n->get('label.condition'));

  if ($err->no()) {
    // Calculate next execution time.
    $next = tdCron::getNextOccurrence($cl_cron_spec, time());
    if (ttNotificationHelper::update(array(
        'id' => $notification_id,
        'cron_spec' => $cl_cron_spec,
        'next' => $next,
        'report_id' => $cl_fav_report_id,
        'email' => $cl_email,
        'cc' => $cl_cc,
        'subject' => $cl_subject,
        'comment' => $cl_comment,
        'report_condition' => $cl_report_condition,
        'status' => ACTIVE))) {
        header('Location: notifications.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.edit_notification'));
$smarty->assign('content_page_name', 'notification_edit.tpl');
$smarty->display('index.tpl');
