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

require_once('../initialize.php');
import('form.Form');
import('ttWorkHelper');

// Access checks.
if (!ttAccessAllowed('manage_work')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('wk')) {
  header('Location: feature_disabled.php');
  exit();
}
// Do we have work_id?
$cl_work_id = (int)$request->getParameter('work_id');
if ($cl_work_id) {
  $workHelper = new ttWorkHelper($err);
  $work_item = $workHelper->getAvailableWorkItem($cl_work_id);
  if (!$work_item) {
    header('Location: access_denied.php');
    exit();
  }
}
// End of access checks.
if ($work_item) $cl_name = $work_item['subject'];

if ($request->isPost()) {
  if (!$work_item)
    $cl_name = trim($request->getParameter('offer_name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_details = trim($request->getParameter('details'));
  $cl_currency_id = $request->getParameter('currency');
  if (!$cl_currency_id && $work_item) $cl_currency_id = ttWorkHelper::getCurrencyID($work_item['currency']);
  $cl_budget = $request->getParameter('budget');
  $cl_payment_info = $request->getParameter('payment_info');
} else {
  if ($work_item) {
    $cl_currency_id = ttWorkHelper::getCurrencyID($work_item['currency']);
  }
}

$form = new Form('offerForm');
if ($cl_work_id) {
  $form->addInput(array('type'=>'hidden','name'=>'work_id','value'=>$cl_work_id));
  $form->addInput(array('type'=>'textarea','name'=>'work_description','style'=>'width: 400px; height: 80px;','value'=>$work_item['descr_short']));
  $form->getElement('work_description')->setEnabled(false);
}
$form->addInput(array('type'=>'text','name'=>'offer_name','maxlength'=>'128','style'=>'width: 400px;','value'=>$cl_name));
if ($work_item) $form->getElement('offer_name')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'description','maxlength'=>'512','style'=>'width: 400px; height: 80px;','value'=>$cl_description));
$form->addInput(array('type'=>'textarea','name'=>'details','style'=>'width: 400px; height: 200px;','value'=>$cl_details));
// Add a dropdown for currency.
$currencies = ttWorkHelper::getCurrencies();
$form->addInput(array('type'=>'combobox','name'=>'currency','data'=>$currencies,'datakeys'=>array('id','name'),'value'=>$cl_currency_id));
if ($work_item) $form->getElement('currency')->setEnabled(false); // Do not allow changing currency for offers on existing work items.
$form->addInput(array('type'=>'floatfield','maxlength'=>'10','name'=>'budget','format'=>'.2','value'=>$cl_budget));
$form->addInput(array('type'=>'textarea','name'=>'payment_info','maxlength'=>'256','style'=>'width: 400px; height: 40px;vertical-align: middle','value'=>$cl_payment_info));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.offer'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  if (!ttValidString($cl_details, true)) $err->add($i18n->get('error.field'), $i18n->get('label.details'));
  if (!ttValidString($cl_budget)) $err->add($i18n->get('error.field'), $i18n->get('label.budget'));
  if (!ttValidString($cl_payment_info)) $err->add($i18n->get('error.field'), $i18n->get('label.how_to_pay'));

  // Ensure user email exists (required for workflow).
  if (!$user->getEmail()) $err->add($i18n->get('error.no_email'));

  if ($err->no()) {
    $workHelper = new ttWorkHelper($err);
    $fields = array('work_id'=>$cl_work_id,
      'subject'=>$cl_name,
      'descr_short' => $cl_description,
      'descr_long' => $cl_details,
      'currency' => ttWorkHelper::getCurrencyName($cl_currency_id),
      'amount' => $cl_budget,
      'payment_info' => $cl_payment_info);
     if ($workHelper->putOwnOffer($fields)) {
        header('Location: work.php');
        exit();
    }
  }
} // isPost

$smarty->assign('work_item', $work_item);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.offerForm.work_name.focus()"');
$smarty->assign('title', $i18n->get('title.add_offer'));
$smarty->assign('content_page_name', 'work/offer_add.tpl');
$smarty->display('work/index.tpl');
