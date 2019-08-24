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
import('ttGroupHelper');

// Access checks.
if (!(ttAccessAllowed('manage_invoices') || ttAccessAllowed('view_client_invoices'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('iv')) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

if ($request->isPost()) {
  $sort_option_1 = $request->getParameter('sort_option_1');
  $sort_order_1 = $request->getParameter('sort_order_1');
  $sort_option_2 = $request->getParameter('sort_option_2');
  $sort_order_2 = $request->getParameter('sort_order_2');
}

$invoices = ttGroupHelper::getActiveInvoices();

$form = new Form('invoicesForm');

// Prepare an array of sort options.
$sort_options['name'] = $i18n->get('label.thing_name');
$sort_options['client'] = $i18n->get('label.client');
$sort_options['date'] = $i18n->get('label.date');

$form->addInput(array('type'=>'combobox',
  'name'=>'sort_option_1',
  'onchange'=>'this.form.sorting_changed.value=1;this.form.submit();',
  //'style'=>'width: 250px;',
  'data'=>$sort_options,
  'value'=>$sort_option_1));
$form->addInput(array('type'=>'combobox',
  'name'=>'sort_option_2',
  'onchange'=>'this.form.sorting_changed.value=1;this.form.submit();',
  //'style'=>'width: 250px;',
  'data'=>$sort_options,
  'value'=>$sort_option_2,
  'empty'=>array(''=>$i18n->get('dropdown.no'))));

// Prepare an array of sort order.
$sort_order['ascending'] = $i18n->get('dropdown.ascending');
$sort_order['descending'] = $i18n->get('dropdown.descending');

$form->addInput(array('type'=>'combobox',
  'name'=>'sort_order_1',
  'onchange'=>'this.form.sorting_changed.value=1;this.form.submit();',
  'data'=>$sort_order,
  'value'=>$sort_order_1));
$form->addInput(array('type'=>'combobox',
  'name'=>'sort_order_2',
  'onchange'=>'this.form.sorting_changed.value=1;this.form.submit();',
  'data'=>$sort_order,
  'value'=>$sort_order_2));


$form->addInput(array('type'=>'hidden','name'=>'sorting_changed'));

if ($request->isPost()) {
  // Validate user input.
  if (!ttInvoiceHelper::validSortOption($sort_option_1)) $err->add($i18n->get('error.field'),  $i18n->get('label.sort'));
  if (!ttInvoiceHelper::validSortOption($sort_option_2, true)) $err->add($i18n->get('error.field'),  $i18n->get('label.sort'));
  if (!ttInvoiceHelper::validSortOrder($sort_order_1)) $err->add($i18n->get('error.field'),  $i18n->get('label.sort'));
  if (!ttInvoiceHelper::validSortOrder($sort_order_2)) $err->add($i18n->get('error.field'),  $i18n->get('label.sort'));
  if ($sort_option_1 == $sort_option_2) $err->add($i18n->get('error.field'),  $i18n->get('label.sort'));

  if($request->getParameter('sorting_changed')) {
    // User changed sorting. Get invoices sorted accordingly.
    $sort_options = array('sort_option_1'=>$sort_option_1,
      'sort_order_1'=>$sort_order_1,
      'sort_option_2'=>$sort_option_2,
      'sort_order_2'=>$sort_order_2);
    $invoices = ttGroupHelper::getActiveInvoices($sort_options);
  }
}

$smarty->assign('invoices', $invoices);
$smarty->assign('show_sorting_options', count($invoices) > 1);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.invoices'));
$smarty->assign('content_page_name', 'invoices.tpl');
$smarty->display('index.tpl');
