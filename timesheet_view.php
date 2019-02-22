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
// End of access checks.

$options = ttTimesheetHelper::getReportOptions($timesheet);
$subtotals = ttReportHelper::getSubtotals($options);
$totals = ttReportHelper::getTotals($options);
$notClient = !$user->isClient();

// Determine managers we can submit this timesheet for approval to.
$approvers = ttTimesheetHelper::getApprovers($timesheet['user_id']);

$smarty->assign('not_client', $notClient);
$smarty->assign('group_by_header', ttReportHelper::makeGroupByHeader($options));
$smarty->assign('timesheet', $timesheet);
$smarty->assign('subtotals', $subtotals);
$smarty->assign('totals', $totals);
$smarty->assign('title', $i18n->get('title.timesheet'));
$smarty->assign('content_page_name', 'timesheet_view.tpl');
$smarty->display('index.tpl');
