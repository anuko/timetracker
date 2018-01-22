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
if ($client_id && $bean->getAttribute('chinvoice') && ('no_grouping' == $bean->getAttribute('group_by')) && !$user->isClient()) {
  // Client is selected and we are displaying the invoice column.
  $recent_invoices = ttTeamHelper::getRecentInvoices($user->team_id, $client_id);
  if ($recent_invoices) {
    $form->addInput(array('type'=>'combobox',
      'name'=>'recent_invoice',
      'data'=>$recent_invoices,
      'datakeys'=>array('id','name'),
      'empty'=>array(''=>$i18n->getKey('dropdown.select_invoice'))));
    $form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->getKey('button.submit')));
    $smarty->assign('use_checkboxes', true);
  }
}

if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {
    // User clicked the Submit button to assign some items to a recent invoice.
    foreach($_POST as $key => $val) {
      if ('log_id_' == substr($key, 0, 7))
        $time_log_ids[] = substr($key, 7);
      if ('item_id_' == substr($key, 0, 8))
        $expense_item_ids[] = substr($key, 8);
      if ('recent_invoice' == $key)
        $invoice_id = $val;
    }
    if ($time_log_ids || $expense_item_ids) {
      // Some records are checked for invoice editing. Adjust their invoice accordingly.
      ttReportHelper::assignToInvoice($invoice_id, $time_log_ids, $expense_item_ids);
    }
    // Re-display this form.
    header('Location: report.php');
    exit();
  }
} // isPost

$group_by = $bean->getAttribute('group_by');

$report_items = ttReportHelper::getItems($bean);
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
