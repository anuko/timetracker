<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('DateAndTime');
import('ttInvoiceHelper');
import('ttClientHelper');
import('form.Form');

// Access checks.
if (!(ttAccessAllowed('manage_invoices') || ttAccessAllowed('view_client_invoices'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('iv')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_invoice_id = (int)$request->getParameter('id');
$invoice = ttInvoiceHelper::getInvoice($cl_invoice_id);
if (!$invoice) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$invoice_date = new DateAndTime(DB_DATEFORMAT, $invoice['date']);
$client = ttClientHelper::getClient($invoice['client_id'], true);
if (!$client) // In case client was deleted.
  $client = ttClientHelper::getDeletedClient($invoice['client_id']);

$invoice_items = ttInvoiceHelper::getInvoiceItems($cl_invoice_id);
$tax_percent = $client['tax'];

$subtotal = 0;
$tax = 0;
foreach($invoice_items as $item)
  $subtotal += $item['cost'];
if ($tax_percent > 0) {
  $tax_expenses = $user->isPluginEnabled('et');
  foreach($invoice_items as $item) {
    if ($item['type'] == 2 && !$tax_expenses)
      continue;
    $tax += round($item['cost'] * $tax_percent / 100, 2);
  }
}
$total = $subtotal + $tax;

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
if ($user->isPluginEnabled('ps') && !$user->isClient()) {
  $mark_paid_action_options = array('1'=>$i18n->get('dropdown.paid'),'2'=>$i18n->get('dropdown.not_paid'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'mark_paid_action_options',
    'data'=>$mark_paid_action_options,
    'value'=>$cl_mark_paid_action_option));
  $form->addInput(array('type'=>'submit','name'=>'btn_mark_paid','value'=>$i18n->get('button.submit')));
  $smarty->assign('show_mark_paid', true);
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
$smarty->assign('invoice_name', $invoice['name']);
$smarty->assign('invoice_date', $invoice_date->toString($user->getDateFormat()));
$smarty->assign('client_name', $client['name']);
$smarty->assign('client_address', $client['address']);
$smarty->assign('show_project', MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode);
$smarty->assign('show_task', MODE_PROJECTS_AND_TASKS == $trackingMode);
$smarty->assign('invoice_items', $invoice_items);
$smarty->assign('colspan', $colspan);
$smarty->assign('title', $i18n->get('title.view_invoice'));
$smarty->assign('content_page_name', 'invoice_view.tpl');
$smarty->display('index.tpl');
