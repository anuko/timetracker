<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('ttConfigHelper');
import('form.Form');
import('form.ActionForm');
import('ttReportHelper');
import('ttGroupHelper');
import('ttTimesheetHelper');

// Access checks.
if (!(ttAccessAllowed('view_own_reports') || ttAccessAllowed('view_reports') || ttAccessAllowed('view_all_reports')  || ttAccessAllowed('view_client_reports'))) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$config = new ttConfigHelper($user->getConfig());

if ($user->isPluginEnabled('ap')) {
  $cl_mark_approved_select_option = $request->getParameter('mark_approved_select_options', ($request->isPost() ? null : @$_SESSION['mark_approved_select_option']));
  $_SESSION['mark_approved_select_option'] = $cl_mark_approved_select_option;
  $cl_mark_approved_action_option = $request->getParameter('mark_approved_action_options', ($request->isPost() ? null : @$_SESSION['mark_approved_action_option']));
  $_SESSION['mark_aproved_action_option'] = $cl_mark_approved_action_option;
}
if ($user->isPluginEnabled('ps')) {
  $cl_mark_paid_select_option = $request->getParameter('mark_paid_select_options', ($request->isPost() ? null : @$_SESSION['mark_paid_select_option']));
  $_SESSION['mark_paid_select_option'] = $cl_mark_paid_select_option;
  $cl_mark_paid_action_option = $request->getParameter('mark_paid_action_options', ($request->isPost() ? null : @$_SESSION['mark_paid_action_option']));
  $_SESSION['mark_paid_action_option'] = $cl_mark_paid_action_option;
}
if ($user->isPluginEnabled('iv')) {
  $cl_assign_invoice_select_option = $request->getParameter('assign_invoice_select_options', ($request->isPost() ? null : @$_SESSION['assign_invoice_select_option']));
  $_SESSION['assign_invoice_select_option'] = $cl_assign_invoice_select_option;
  $cl_recent_invoice_option = $request->getParameter('recent_invoice', ($request->isPost() ? null : @$_SESSION['recent_invoice_option']));
  $_SESSION['recent_invoice_option'] = $cl_recent_invoice_option;
}
if ($user->isPluginEnabled('ts')) {
  $cl_assign_timesheet_select_option = $request->getParameter('assign_timesheet_select_options', ($request->isPost() ? null : @$_SESSION['assign_timesheet_select_option']));
  $_SESSION['assign_timesheet_select_option'] = $cl_assign_timesheet_select_option;
  $cl_timesheet_option = $request->getParameter('timesheet', ($request->isPost() ? null : @$_SESSION['timesheet_option']));
  $_SESSION['timesheet_option'] = $cl_timesheet_option;
}

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields();
  $smarty->assign('custom_fields', $custom_fields);
}

$form = new Form('reportViewForm');

// Report settings are stored in session bean before we get here from reports.php.
$bean = new ActionForm('reportBean', new Form('reportForm'), $request);
// If we are in post, load the bean from session, as the constructor does it only in get.
if ($request->isPost()) $bean->loadBean();

$client_id = $bean->getAttribute('client');
$options = ttReportHelper::getReportOptions($bean);

// Do we need to show checkboxes? We show them in the following 4 situations:
// - We can approve items.
// - We can mark items as paid.
// - We can assign items to invoices.
// - We can assign items to a timesheet.
// Determine these conditions separately.
if ($bean->getAttribute('chapproved') && ($user->can('approve_reports') || $user->can('approve_all_reports')))
  $useMarkApproved = true;
if ($bean->getAttribute('chpaid') && $user->can('manage_invoices'))
  $useMarkPaid = true;
if ($bean->getAttribute('chinvoice') && $client_id && 'no_grouping' == $bean->getAttribute('group_by1') && !$user->isClient() && $user->can('manage_invoices'))
  $useAssignToInvoice = true;
if ($bean->getAttribute('chtimesheet')) {
  $timesheets = ttTimesheetHelper::getMatchingTimesheets($options);
  if ($timesheets) $useAssignToTimesheet = true;
}

$use_checkboxes = $useMarkApproved || $useMarkPaid || $useAssignToInvoice || $useAssignToTimesheet;
if ($use_checkboxes)
  $smarty->assign('use_checkboxes', true);

// Controls for "Mark approved" block.
if ($useMarkApproved) {
  $mark_approved_select_options = array('1'=>$i18n->get('dropdown.all'),'2'=>$i18n->get('dropdown.select'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'mark_approved_select_options',
    'data'=>$mark_approved_select_options,
    'value'=>$cl_mark_approved_select_option));
  $mark_approved_action_options = array('1'=>$i18n->get('dropdown.approved'),'2'=>$i18n->get('dropdown.not_approved'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'mark_approved_action_options',
    'data'=>$mark_approved_action_options,
    'value'=>$cl_mark_approved_action_option));
  $form->addInput(array('type'=>'submit','name'=>'btn_mark_approved','value'=>$i18n->get('button.submit')));
  $smarty->assign('use_mark_approved', true);
}

// Controls for "Mark paid" block.
if ($useMarkPaid) {
  $mark_paid_select_options = array('1'=>$i18n->get('dropdown.all'),'2'=>$i18n->get('dropdown.select'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'mark_paid_select_options',
    'data'=>$mark_paid_select_options,
    'value'=>$cl_mark_paid_select_option));
  $mark_paid_action_options = array('1'=>$i18n->get('dropdown.paid'),'2'=>$i18n->get('dropdown.not_paid'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'mark_paid_action_options',
    'data'=>$mark_paid_action_options,
    'value'=>$cl_mark_paid_action_option));
  $form->addInput(array('type'=>'submit','name'=>'btn_mark_paid','value'=>$i18n->get('button.submit')));
  $smarty->assign('use_mark_paid', true);
}

// Controls for "Assign to invoice" block.
if ($useAssignToInvoice) {
  // Client is selected and we are displaying the invoice column.
  $recent_invoices = ttGroupHelper::getRecentInvoices($client_id);
  if ($recent_invoices) {
    $assign_invoice_select_options = array('1'=>$i18n->get('dropdown.all'),'2'=>$i18n->get('dropdown.select'));
    $form->addInput(array('type'=>'combobox',
      'name'=>'assign_invoice_select_options',
      'data'=>$assign_invoice_select_options,
      'value'=>$cl_assign_invoice_select_option));
    $form->addInput(array('type'=>'combobox',
      'name'=>'recent_invoice',
      'data'=>$recent_invoices,
      'datakeys'=>array('id','name'),
      'value'=>$cl_recent_invoice_option,
      'empty'=>array(''=>$i18n->get('dropdown.select_invoice'))));
    $form->addInput(array('type'=>'submit','name'=>'btn_assign_invoice','value'=>$i18n->get('button.submit')));
    $smarty->assign('use_assign_to_invoice', true);
  }
}

// Controls for "Assign to timesheet" block.
if ($useAssignToTimesheet) {
  $assign_timesheet_select_options = array('1'=>$i18n->get('dropdown.all'),'2'=>$i18n->get('dropdown.select'));
  $form->addInput(array('type'=>'combobox',
      'name'=>'assign_timesheet_select_options',
      'data'=>$assign_timesheet_select_options,
      'value'=>$cl_assign_timesheet_select_option));
  $form->addInput(array('type'=>'combobox',
      'name'=>'timesheet',
      'data'=>$timesheets,
      'datakeys'=>array('id','name'),
      'value'=>$cl_timesheet_option,
      'empty'=>array(''=>$i18n->get('dropdown.select_timesheet'))));
  $form->addInput(array('type'=>'submit','name'=>'btn_assign_timesheet','value'=>$i18n->get('button.submit')));
  $smarty->assign('use_assign_to_timesheet', true);
}

if ($request->isPost()) {

  // Validate parameters and at the same time build arrays of record ids.
  if (($request->getParameter('btn_mark_approved') && 2 == $request->getParameter('mark_approved_select_options'))
       || ($request->getParameter('btn_mark_paid') && 2 == $request->getParameter('mark_paid_select_options'))
       || ($request->getParameter('btn_assign_invoice') && 2 == $request->getParameter('assign_invoice_select_options'))
       || ($request->getParameter('btn_assign_timesheet') && 2 == $request->getParameter('assign_timesheet_select_options'))) {
    // We act on selected records. Are there any?
    foreach($_POST as $key => $val) {
      if ('log_id_' == substr($key, 0, 7))
        $time_log_ids[] = substr($key, 7);
      if ('item_id_' == substr($key, 0, 8))
        $expense_item_ids[] = substr($key, 8);
    }
    if (!$time_log_ids && !$expense_item_ids) $err->Add($i18n->get('error.record')); // There are no selected records.
    // Validation of parameteres ended here.
  } else {
    // We are assigning all report items. Get the arrays from session.
    // Note: getting from session assures we act only on previously displayed records.
    // Rebuilding from $bean may get us a different set.
    $item_ids = ttReportHelper::getFromSession();
    $time_log_ids = $item_ids['report_item_ids'];
    $expense_item_ids = $item_ids['report_item_expense_ids'];
    // The above code is here because the arrays are used in both "Mark paid" and "Assign to invoice" handlers below.
  }

  if ($err->no()) {
    if ($request->getParameter('btn_mark_approved')) {
      // User clicked the "Mark approved" button to mark some or all items either approved or not approved.

      // Determine user action.
      $mark_approved = $request->getParameter('mark_approved_action_options') == 1 ? true : false;

      // Mark as requested.
      if ($time_log_ids || $expense_item_ids) {
        ttReportHelper::markApproved($time_log_ids, $expense_item_ids, $mark_approved);
      }

      // Re-display this form.
      header('Location: report.php');
      exit();
    }

    if ($request->getParameter('btn_mark_paid')) {
      // User clicked the "Mark paid" button to mark some or all items either paid or not paid.

      // Determine user action.
      $mark_paid = $request->getParameter('mark_paid_action_options') == 1 ? true : false;

      // Mark as requested.
      if ($time_log_ids || $expense_item_ids) {
        ttReportHelper::markPaid($time_log_ids, $expense_item_ids, $mark_paid);
      }

      // Re-display this form.
      header('Location: report.php');
      exit();
    }

    if ($request->getParameter('btn_assign_invoice')) {
      // User clicked the Submit button to assign all or some items to a recent invoice.

      // Determine invoice id.
      $invoice_id = $request->getParameter('recent_invoice');

      // Assign as requested.
      if ($time_log_ids || $expense_item_ids) {
        ttReportHelper::assignToInvoice($invoice_id, $time_log_ids, $expense_item_ids);
      }
      // Re-display this form.
      header('Location: report.php');
      exit();
    }

    if ($request->getParameter('btn_assign_timesheet')) {
      // User clicked the Submit button to assign all or some items to a timesheet.

      // Determine invoice id.
      $timesheet_id = $request->getParameter('timesheet');

      // Assign as requested.
      if ($time_log_ids) {
        ttReportHelper::assignToTimesheet($timesheet_id, $time_log_ids);
      }
      // Re-display this form.
      header('Location: report.php');
      exit();
    }
  }
} // isPost

$report_items = ttReportHelper::getItems($options);
// Store record ids in session in case user wants to act on records such as marking them all paid.
if ($request->isGet() && $use_checkboxes)
  ttReportHelper::putInSession($report_items);

if (ttReportHelper::grouping($options)) {
  $subtotals = ttReportHelper::getSubtotals($options);
  $smarty->assign('group_by_header', ttReportHelper::makeGroupByHeader($options));
  if ($report_items) {
    // Assign variables that are used to print subtotals.
    $smarty->assign('print_subtotals', true);
    $smarty->assign('first_pass', true);
    $smarty->assign('prev_grouped_by', '');
    $smarty->assign('cur_grouped_by', '');
  }
}
$totals = ttReportHelper::getTotals($options);

// Determine column span for note field.
$colspan = 0;
if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) $colspan++;
if ($custom_fields && $custom_fields->userFields) {
  foreach ($custom_fields->userFields as $userField) {
    $checkbox_control_name = 'show_user_field_'.$userField['id'];
    if ($bean->getAttribute($checkbox_control_name)) $colspan++;
  }
}
if ($bean->getAttribute('chclient')) $colspan++;
if ($bean->getAttribute('chproject')) $colspan++;
if ($bean->getAttribute('chtask')) $colspan++;
if ($custom_fields && $custom_fields->timeFields) {
  foreach ($custom_fields->timeFields as $timeField) {
    $checkbox_control_name = 'show_time_field_'.$timeField['id'];
    if ($bean->getAttribute($checkbox_control_name)) $colspan++;
  }
}
if ($bean->getAttribute('chstart')) $colspan++;
if ($bean->getAttribute('chfinish')) $colspan++;
if ($bean->getAttribute('chduration')) $colspan++;
if ($bean->getAttribute('chunits')) $colspan++;
if ($bean->getAttribute('chcost')) $colspan++;
if ($bean->getAttribute('chapproved')) $colspan++;
if ($bean->getAttribute('chpaid')) $colspan++;
if ($bean->getAttribute('chip')) $colspan++;
if ($bean->getAttribute('chinvoice')) $colspan++;
if ($bean->getAttribute('chtimesheet')) $colspan++;
if ($bean->getAttribute('chfiles')) $colspan++;

// Assign variables that are used to alternate color of rows for different dates.
$smarty->assign('prev_date', '');
$smarty->assign('cur_date', '');
$smarty->assign('report_row_class', 'rowReportItem');
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('report_items', $report_items);
$smarty->assign('subtotals', $subtotals);
$smarty->assign('totals', $totals);
$smarty->assign('note_on_separate_row', $user->getConfigOption('report_note_on_separate_row'));
$smarty->assign('colspan', $colspan);
$smarty->assign('bean', $bean);
$smarty->assign('title', $i18n->get('title.report').": ".$totals['start_date']." - ".$totals['end_date']);
$smarty->assign('content_page_name', 'report.tpl');
$smarty->display('index.tpl');
