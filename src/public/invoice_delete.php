<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttInvoiceHelper');

// Access checks.
if (!ttAccessAllowed('manage_invoices')) {
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

$invoice_to_delete = $invoice['name'];

$form = new Form('invoiceDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_invoice_id));
$form->addInput(array('type'=>'combobox',
    'name'=>'delete_invoice_entries',
    'data'=>array('0'=>$i18n->get('dropdown.do_not_delete'),'1'=>$i18n->get('dropdown.delete')),
));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete'),'onclick'=>'return confirm_deleting_entries();'));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if (ttInvoiceHelper::delete($cl_invoice_id, $request->getParameter('delete_invoice_entries'))) {
      header('Location: invoices.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: invoices.php');
    exit();
  }
} // isPost

$smarty->assign('invoice_to_delete', $invoice_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.invoiceDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_invoice'));
$smarty->assign('content_page_name', 'invoice_delete.tpl');
$smarty->display('index.tpl');
