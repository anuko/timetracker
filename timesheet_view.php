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
import('ttTimesheetHelper');

// Access checks.
if (!(ttAccessAllowed('view_own_timesheets') || ttAccessAllowed('view_timesheets') || ttAccessAllowed('view_all_timesheets') || ttAccessAllowed('view_client_timesheets'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('ts')) {
  header('Location: feature_disabled.php');
  exit();
}
$timesheet_id = (int)$request->getParameter('id');
$timesheet = ttTimesheetHelper::getTimesheet($timesheet_id);
if (!$timesheet) {
  header('Location: access_denied.php');
  exit();
}
// TODO: add other checks here for timesheet being appropriate for user role.
// TODO: if this is a timeheet submit, validate approver id, too.
// End of access checks.

$options = ttTimesheetHelper::getReportOptions($timesheet);
$subtotals = ttReportHelper::getSubtotals($options);
$totals = ttReportHelper::getTotals($options);
$notClient = !$user->isClient();

// Determine which controls to show and obtain date for them.
$showSubmit = $notClient && !$timesheet['submit_status'];
if ($showSubmit) $approvers = ttTimesheetHelper::getApprovers($timesheet['user_id']);
$canApprove = $user->can('approve_timesheets') || $user_>can('approve_all_timesheets');
$showApprove = $notClient && $timesheet['submit_status'] && !$timesheet['approval_status'];

// Add a form with controls.
$form = new Form('timesheetForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$timesheet['id']));

if ($showSubmit) {
  if (count($approvers) >= 1) {
    $form->addInput(array('type'=>'combobox',
      'name'=>'approver',
      'style'=>'width: 200px;',
      'data'=>$approvers,
      'datakeys'=>array('id','name')));
  }
  $form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));
}

if ($showApprove) {
  $form->addInput(array('type'=>'submit','name'=>'btn_approve','value'=>$i18n->get('button.approve')));
  $form->addInput(array('type'=>'submit','name'=>'btn_disapprove','value'=>$i18n->get('button.disapprove')));
}

// Submit.
if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {
    $fields = array('timesheet_id' => $timesheet['id'],
      'approver_id' => $approver_id); // TODO: obtain (and check) approver id above during access checks.
    if (ttTimesheetHelper::submitTimesheet($fields)) {
      // Redirect to self.
      header('Location: timesheet_view.php?id='.$timesheet['id']);
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
}

$smarty->assign('not_client', $notClient);
$smarty->assign('group_by_header', ttReportHelper::makeGroupByHeader($options));
$smarty->assign('timesheet', $timesheet);
$smarty->assign('subtotals', $subtotals);
$smarty->assign('totals', $totals);
$smarty->assign('show_submit', $showSubmit);
$smarty->assign('show_approve', $showApprove);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.timesheet'));
$smarty->assign('content_page_name', 'timesheet_view.tpl');
$smarty->display('index.tpl');
