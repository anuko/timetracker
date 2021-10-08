<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('ttTimesheetHelper');
import('ttReportHelper');

// Access checks.
if (!(ttAccessAllowed('track_own_time') || ttAccessAllowed('track_time'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('ts')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_timesheet_id = (int)$request->getParameter('id');
$timesheet = ttTimesheetHelper::getTimesheet($cl_timesheet_id);
if (!$timesheet) {
  header('Location: access_denied.php');
  exit();
}
// TODO: add other checks here for timesheet being appropriate for user role.
// TODO: if this is a timesheet submit, validate approver id, too.
// End of access checks.

if ($request->isPost()) {
  $cl_comment = trim($request->getParameter('comment'));
  $approver_id = $request->getParameter('approver');
}

$options = ttTimesheetHelper::getReportOptions($timesheet);
$subtotals = ttReportHelper::getSubtotals($options);
$totals = ttReportHelper::getTotals($options);

// Determine which controls to show and obtain date for them.
$showApprovers = false;
$showSubmit = !$timesheet['submit_status'];
if ($showSubmit) {
  $approvers = ttTimesheetHelper::getApprovers();
  $showApprovers = count($approvers) >= 1;
}
$canApprove = $user->can('approve_timesheets') || $user->can('approve_own_timesheets');
$showApprove = $timesheet['submit_status'] && $timesheet['approve_status'] == null && $canApprove;

// Add a form with controls.
$form = new Form('timesheetForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$timesheet['id']));

if ($showSubmit) {
  if ($showApprovers) {
    $form->addInput(array('type'=>'combobox',
      'name'=>'approver',
      'style'=>'width: 200px;',
      'data'=>$approvers,
      'datakeys'=>array('id','name','email')));
  }
  $form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));
}

if ($showApprove) {
  $form->addInput(array('type'=>'textarea','name'=>'comment','maxlength'=>'250'));
  $form->addInput(array('type'=>'submit','name'=>'btn_approve','value'=>$i18n->get('button.approve')));
  $form->addInput(array('type'=>'submit','name'=>'btn_disapprove','value'=>$i18n->get('button.disapprove')));
}

// Submit.
if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {
    $fields = array('timesheet_id' => $timesheet['id'],
      'approver_id' => $approver_id);
    if (!ttTimesheetHelper::markSubmitted($fields))
      $err->add($i18n->get('error.db'));
    if ($err->no() && !ttTimesheetHelper::sendSubmitEmail($fields)) {
      $err->add($i18n->get('error.mail_send'));
    }
    if ($err->no()) {
      // Redirect to self.
      header('Location: timesheet_view.php?id='.$timesheet['id']);
      exit();
    }
  }

  if ($request->getParameter('btn_approve')) {
    $fields = array('timesheet_id' => $timesheet['id'],
      'name' => $timesheet['name'],
      'user_id' => $timesheet['user_id'],
      'comment' => $cl_comment);
    if (!ttTimesheetHelper::markApproved($fields))
      $err->add($i18n->get('error.db'));
    if ($err->no() && !ttTimesheetHelper::sendApprovedEmail($fields)) {
      $err->add($i18n->get('error.mail_send'));
    }
    if ($err->no()) {
      // Redirect to self.
      header('Location: timesheet_view.php?id='.$timesheet['id']);
      exit();
    }
  }

  if ($request->getParameter('btn_disapprove')) {
    $fields = array('timesheet_id' => $timesheet['id'],
      'name' => $timesheet['name'],
      'user_id' => $timesheet['user_id'],
      'comment' => $cl_comment);
    if (!ttTimesheetHelper::markDisapproved($fields))
      $err->add($i18n->get('error.db'));
    if ($err->no() && !ttTimesheetHelper::sendDisapprovedEmail($fields)) {
      $err->add($i18n->get('error.mail_send'));
    }
    if ($err->no()) {
      // Redirect to self.
      header('Location: timesheet_view.php?id='.$timesheet['id']);
      exit();
    }
  }
}

$smarty->assign('group_by_header', ttReportHelper::makeGroupByHeader($options));
$smarty->assign('timesheet', $timesheet);
$smarty->assign('subtotals', $subtotals);
$smarty->assign('totals', $totals);
$smarty->assign('show_approvers', $showApprovers);
$smarty->assign('show_submit', $showSubmit);
$smarty->assign('show_approve', $showApprove);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.timesheet').": ".$timesheet['start_date']." - ".$timesheet['end_date']);
$smarty->assign('content_page_name', 'timesheet_view.tpl');
$smarty->display('index.tpl');
