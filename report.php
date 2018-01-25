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
import('form.ActionForm');
import('ttReportHelper');
import('ttTeamHelper');

// Access check.
if (!ttAccessCheck(right_view_reports)) {
  header('Location: access_denied.php');
  exit();
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

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields($user->team_id);
  $smarty->assign('custom_fields', $custom_fields);
}

$form = new Form('reportForm');

// Report settings are stored in session bean before we get here from reports.php.
$bean = new ActionForm('reportBean', $form, $request);
$client_id = $bean->getAttribute('client');

// Do we need to show checkboxes?
if ($bean->getAttribute('chpaid') ||
   ($client_id && $bean->getAttribute('chinvoice') && ('no_grouping' == $bean->getAttribute('group_by')) && !$user->isClient())) {
  $smarty->assign('use_checkboxes', true);
}

// Controls for "Mark paid" block.
if ($bean->getAttribute('chpaid')) {
  $mark_paid_select_options = array('1'=>$i18n->getKey('dropdown.all'),'2'=>$i18n->getKey('dropdown.select'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'mark_paid_select_options',
    'data'=>$mark_paid_select_options,
    'value'=>$cl_mark_paid_select_option));
  $mark_paid_action_options = array('1'=>$i18n->getKey('dropdown.paid'),'2'=>$i18n->getKey('dropdown.not_paid'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'mark_paid_action_options',
    'data'=>$mark_paid_action_options,
    'value'=>$cl_mark_paid_action_option));
  $form->addInput(array('type'=>'submit','name'=>'btn_mark_paid','value'=>$i18n->getKey('button.submit')));
  $smarty->assign('use_mark_paid', true);
}

// Controls for "Assign to invoice" block.
if ($client_id && $bean->getAttribute('chinvoice') && ('no_grouping' == $bean->getAttribute('group_by')) && !$user->isClient()) {
  // Client is selected and we are displaying the invoice column.
  $recent_invoices = ttTeamHelper::getRecentInvoices($user->team_id, $client_id);
  if ($recent_invoices) {
    $assign_invoice_select_options = array('1'=>$i18n->getKey('dropdown.all'),'2'=>$i18n->getKey('dropdown.select'));
    $form->addInput(array('type'=>'combobox',
      'name'=>'assign_invoice_select_options',
      'data'=>$assign_invoice_select_options,
      'value'=>$cl_assign_invoice_select_option));
    $form->addInput(array('type'=>'combobox',
      'name'=>'recent_invoice',
      'data'=>$recent_invoices,
      'datakeys'=>array('id','name'),
      'value'=>$cl_recent_invoice_option,
      'empty'=>array(''=>$i18n->getKey('dropdown.select_invoice'))));
    $form->addInput(array('type'=>'submit','name'=>'btn_assign','value'=>$i18n->getKey('button.submit')));
    $smarty->assign('use_assign_to_invoice', true);
  }
}

if ($request->isPost()) {
  if ($request->getParameter('btn_mark_paid')) {
    // User clicked the "Mark paid" button to mark some or all items either paid or not paid.

    // Determine user action.
    $mark_paid = $request->getParameter('mark_paid_action_options') == 1 ? true : false;

    // Obtain 2 arrays or record ids, one for log, another for expense items.
    if (1 == $request->getParameter('mark_paid_select_options')) {
      // We are marking all report items. Get the arrays from session.
      $item_ids = ttReportHelper::getFromSession();
      $time_log_ids = $item_ids['report_item_ids'];
      $expense_item_ids = $item_ids['report_item_expense_ids'];
    } else if (2 == $request->getParameter('mark_paid_select_options')) {
      // We are marking only selected items. Get the arrays from $_POST.
      foreach($_POST as $key => $val) {
        if ('log_id_' == substr($key, 0, 7))
          $time_log_ids[] = substr($key, 7);
        if ('item_id_' == substr($key, 0, 8))
          $expense_item_ids[] = substr($key, 8);
      }
    }
    // Mark as requested.
    if ($time_log_ids || $expense_item_ids) {
      ttReportHelper::markPaid($time_log_ids, $expense_item_ids, $mark_paid);
    }

    // Re-display this form.
    header('Location: report.php');
    exit();
  }

  if ($request->getParameter('btn_assign')) {
    // User clicked the Submit button to assign all or some items to a recent invoice.

    // Determine invoice id.
    $invoice_id = $request->getParameter('recent_invoice');

    // Obtain 2 arrays or record ids, one for log, another for expense items.
    if (1 == $request->getParameter('assign_invoice_select_options')) {
      // We are assigning all report items. Get the arrays from session.
      $item_ids = ttReportHelper::getFromSession();
      $time_log_ids = $item_ids['report_item_ids'];
      $expense_item_ids = $item_ids['report_item_expense_ids'];
    } else if (2 == $request->getParameter('assign_invoice_select_options')) {
      // We are marking only selected items. Get the arrays from $_POST.
      foreach($_POST as $key => $val) {
        if ('log_id_' == substr($key, 0, 7))
          $time_log_ids[] = substr($key, 7);
        if ('item_id_' == substr($key, 0, 8))
          $expense_item_ids[] = substr($key, 8);
      }
    }
    // Assign as requested.
    if ($time_log_ids || $expense_item_ids) {
      ttReportHelper::assignToInvoice($invoice_id, $time_log_ids, $expense_item_ids);
    }
    // Re-display this form.
    header('Location: report.php');
    exit();
  }
} // isPost

$group_by = $bean->getAttribute('group_by');

$report_items = ttReportHelper::getItems($bean);
// Store record ids in session in case user wants to act on records such as marking them all paid.
if ($request->isGet() && $user->isPluginEnabled('ps'))
  ttReportHelper::putInSession($report_items);

if ('no_grouping' != $group_by)
  $subtotals = ttReportHelper::getSubtotals($bean);
$totals = ttReportHelper::getTotals($bean);

// Assign variables that are used to print subtotals.
if ($report_items && 'no_grouping' != $group_by) {
  $smarty->assign('print_subtotals', true);
  $smarty->assign('first_pass', true);
  $smarty->assign('group_by', $group_by);
  $smarty->assign('prev_grouped_by', '');
  $smarty->assign('cur_grouped_by', '');
}
// Determine group by header.
if ('no_grouping' != $group_by) {
  if ('cf_1' == $group_by)
    $smarty->assign('group_by_header', $custom_fields->fields[0]['label']);
  else {
    $key = 'label.'.$group_by;
    $smarty->assign('group_by_header', $i18n->getKey($key));
  }
}
// Assign variables that are used to alternate color of rows for different dates.
$smarty->assign('prev_date', '');
$smarty->assign('cur_date', '');
$smarty->assign('report_row_class', 'rowReportItem');

$smarty->assign('forms', array($form->getName()=>$form->toArray()));

$smarty->assign('report_items', $report_items);
$smarty->assign('subtotals', $subtotals);
$smarty->assign('totals', $totals);
$smarty->assign('bean', $bean);
$smarty->assign('title', $i18n->getKey('title.report').": ".$totals['start_date']." - ".$totals['end_date']);
$smarty->assign('content_page_name', 'report.tpl');
$smarty->display('index.tpl');
