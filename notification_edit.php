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
require_once(LIBRARY_DIR.'/tdcron/class.tdcron.php');
require_once(LIBRARY_DIR.'/tdcron/class.tdcron.entry.php');
import('form.Form');
import('ttFavReportHelper');
import('ttNotificationHelper');

// Access check.
if (!ttAccessCheck(right_manage_team)) {
  header('Location: access_denied.php');
  exit();
}

$notification_id = (int) $request->getParameter('id');
$fav_reports = ttFavReportHelper::getReports($user->id);

if ($request->getMethod() == 'POST') {
  $cl_fav_report = trim($request->getParameter('fav_report'));
  $cl_cron_spec = trim($request->getParameter('cron_spec'));
  $cl_email = trim($request->getParameter('email'));
} else {
  $notification = ttNotificationHelper::get($notification_id);
  $cl_fav_report = $notification['report_id'];
  $cl_cron_spec = $notification['cron_spec'];
  $cl_email = $notification['email'];
}

$form = new Form('notificationForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$notification_id));
$form->addInput(array('type'=>'combobox',
  'name'=>'fav_report',
  'style'=>'width: 250px;',
  'value'=>$cl_fav_report,
  'data'=>$fav_reports,
  'datakeys'=>array('id','name'),
  'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'cron_spec','style'=>'width: 250px;','value'=>$cl_cron_spec));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'email','style'=>'width: 250px;','value'=>$cl_email));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->getKey('button.save')));

if ($request->getMethod() == 'POST') {
  // Validate user input.
  if (!$cl_fav_report) $errors->add($i18n->getKey('error.report')); 
  if (!ttValidCronSpec($cl_cron_spec)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.cron_schedule'));
  if (!ttValidEmail($cl_email)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.email'));

  if ($errors->isEmpty()) {
    // Calculate next execution time.
    $next = tdCron::getNextOccurrence($cl_cron_spec, mktime());

    if (ttNotificationHelper::update(array(
        'id' => $notification_id,
        'team_id' => $user->team_id,
        'cron_spec' => $cl_cron_spec,
        'next' => $next,
        'report_id' => $cl_fav_report,
        'email' => $cl_email,
        'status' => ACTIVE))) {
        header('Location: notifications.php');
        exit();
      } else
        $errors->add($i18n->getKey('error.db'));
  }
} // POST

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->getKey('title.add_notification'));
$smarty->assign('content_page_name', 'notification_edit.tpl');
$smarty->display('index.tpl');
