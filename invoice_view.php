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
import('DateAndTime');
import('ttInvoiceHelper');
import('ttClientHelper');

// Access check.
if (!ttAccessCheck(right_view_invoices)) {
  header('Location: access_denied.php');
  exit();
}

$invoice_id = (int)$request->getParameter('id');
$invoice = ttInvoiceHelper::getInvoice($invoice_id);
$invoice_date = new DateAndTime(DB_DATEFORMAT, $invoice['date']);
$client = ttClientHelper::getClient($invoice['client_id'], true);
if (!$client) // In case client was deleted.
  $client = ttClientHelper::getDeletedClient($invoice['client_id']);

$invoice_items = ttInvoiceHelper::getInvoiceItems($invoice_id);
$tax_percent = $client['tax'];

$subtotal = 0;
$tax = 0;
foreach($invoice_items as $item)
  $subtotal += $item['cost'];
if ($tax_percent) {
  $tax_expenses = in_array('et', explode(',', $user->plugins));
  foreach($invoice_items as $item) {
    if ($item['type'] == 2 && !$tax_expenses)
      continue;
    $tax += round($item['cost'] * $tax_percent / 100, 2);
  }
}
$total = $subtotal + $tax; 

$smarty->assign('subtotal', $user->currency.' '.str_replace('.', $user->decimal_mark, sprintf('%8.2f', round($subtotal, 2))));
if ($tax) $smarty->assign('tax', $user->currency.' '.str_replace('.', $user->decimal_mark, sprintf('%8.2f', round($tax, 2))));
$smarty->assign('total', $user->currency.' '.str_replace('.', $user->decimal_mark, sprintf('%8.2f', round($total, 2))));

if ('.' != $user->decimal_mark) {
  foreach ($invoice_items as &$item)
    $item['cost'] = str_replace('.', $user->decimal_mark, $item['cost']);
}

// Calculate colspan for invoice summary.
$colspan = 4;
if (MODE_PROJECTS == $user->tracking_mode)
  $colspan++;
else if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
  $colspan += 2;

$smarty->assign('invoice_id', $invoice_id);
$smarty->assign('invoice_name', $invoice['name']);
$smarty->assign('invoice_date', $invoice_date->toString($user->date_format));
$smarty->assign('client_name', $client['name']);
$smarty->assign('client_address', $client['address']);
$smarty->assign('invoice_items', $invoice_items);
$smarty->assign('colspan', $colspan);
$smarty->assign('title', $i18n->getKey('title.view_invoice'));
$smarty->assign('content_page_name', 'invoice_view.tpl');
$smarty->display('index.tpl');
