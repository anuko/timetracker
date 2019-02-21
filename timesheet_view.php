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

// $timesheet_items = ttTimesheetHelper::getTimesheetItems($timesheet_id);

$currency = $user->getCurrency();
$decimalMark = $user->getDecimalMark();

$smarty->assign('subtotal', $currency.' '.str_replace('.', $decimalMark, sprintf('%8.2f', round($subtotal, 2))));
if ($tax) $smarty->assign('tax', $currency.' '.str_replace('.', $decimalMark, sprintf('%8.2f', round($tax, 2))));
$smarty->assign('total', $currency.' '.str_replace('.', $decimalMark, sprintf('%8.2f', round($total, 2))));

if ('.' != $decimalMark) {
  foreach ($invoice_items as &$item)
    $item['cost'] = str_replace('.', $decimalMark, $item['cost']);
}

// Calculate colspan for invoice summary.
$colspan = 4;
$trackingMode = $user->getTrackingMode();
if (MODE_PROJECTS == $trackingMode)
  $colspan++;
elseif (MODE_PROJECTS_AND_TASKS == $trackingMode)
  $colspan += 2;

$form = new Form('invoiceForm');
// Hidden control for invoice id.
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_invoice_id));
// invoiceForm only contains controls for "Mark paid" block below invoice table.
if ($user->isPluginEnabled('ps')) {
  $mark_paid_action_options = array('1'=>$i18n->get('dropdown.paid'),'2'=>$i18n->get('dropdown.not_paid'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'mark_paid_action_options',
    'data'=>$mark_paid_action_options,
    'value'=>$cl_mark_paid_action_option));
  $form->addInput(array('type'=>'submit','name'=>'btn_mark_paid','value'=>$i18n->get('button.submit')));
}

if ($request->isPost()) {
  if ($request->getParameter('btn_mark_paid')) {
    // User clicked the "Mark paid" button to mark all invoice items either paid or not paid.

    // Determine user action.
    $mark_paid = $request->getParameter('mark_paid_action_options') == 1 ? true : false;
    ttInvoiceHelper::markPaid($cl_invoice_id, $mark_paid);

    // Re-display this form.
    header('Location: invoice_view.php?id='.$cl_invoice_id);
    exit();
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('invoice_id', $cl_invoice_id);
$smarty->assign('timesheet', $timesheet);
$smarty->assign('client_name', $client['name']);
$smarty->assign('client_address', $client['address']);
$smarty->assign('show_project', MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode);
$smarty->assign('show_task', MODE_PROJECTS_AND_TASKS == $trackingMode);
$smarty->assign('invoice_items', $invoice_items);
$smarty->assign('colspan', $colspan);
$smarty->assign('title', $i18n->get('title.timesheet'));
$smarty->assign('content_page_name', 'timesheet_view.tpl');
$smarty->display('index.tpl');
