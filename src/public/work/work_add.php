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
  header('Location: ../access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('wk')) {
  header('Location: ../feature_disabled.php');
  exit();
}
// Do we have offer_id?
$cl_offer_id = (int)$request->getParameter('offer_id');
if ($cl_offer_id) {
  $workHelper = new ttWorkHelper($err);
  $offer = $workHelper->getAvailableOffer($cl_offer_id);
  if (!$offer) {
    header('Location: ../access_denied.php');
    exit();
  }
}
// End of access checks.

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('work_name'));
  $cl_work_type = $request->getParameter('work_type');
  $cl_description = trim($request->getParameter('description'));
  $cl_details = trim($request->getParameter('details'));
  $cl_currency_id = $request->getParameter('currency');
  $cl_budget = $request->getParameter('budget');
}
// Override some fields for work being created on an available offer.
if ($offer) {
  $cl_name = $offer['subject'];
  $cl_work_type = 0; // one-time work
  $cl_currency_id = ttWorkHelper::getCurrencyID($offer['currency']);
  $cl_budget = $offer['amount'];
}

$form = new Form('workForm');
if ($offer)
  $form->addInput(array('type'=>'hidden','name'=>'offer_id','value'=>$cl_offer_id));
$form->addInput(array('type'=>'text','name'=>'work_name','maxlength'=>'128','style'=>'width: 400px;','value'=>$cl_name));
$WORK_TYPE_OPTIONS = array('0'=>$i18n->get('work.type.one_time'),'1'=>$i18n->get('work.type.ongoing'));
$form->addInput(array('type'=>'combobox','name'=>'work_type','data'=>$WORK_TYPE_OPTIONS,'value'=>$cl_work_type));
$form->addInput(array('type'=>'textarea','name'=>'description','maxlength'=>'512','style'=>'width: 400px; height: 80px;','value'=>$cl_description));
$form->addInput(array('type'=>'textarea','name'=>'details','style'=>'width: 400px; height: 200px;','value'=>$cl_details));
// Add a dropdown for currency.
$currencies = ttWorkHelper::getCurrencies();
$form->addInput(array('type'=>'combobox','name'=>'currency','data'=>$currencies,'datakeys'=>array('id','name'),'value'=>$cl_currency_id));
$form->addInput(array('type'=>'floatfield','maxlength'=>'10','name'=>'budget','format'=>'.2','value'=>$cl_budget));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));
// Disable some controls for work being created on an available offer.
if ($offer) {
  $form->getElement('work_name')->setEnabled(false);
  $form->getElement('work_type')->setEnabled(false);
  $form->getElement('currency')->setEnabled(false);
  $form->getElement('budget')->setEnabled(false);
}

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.work'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  if (!ttValidString($cl_details, true)) $err->add($i18n->get('error.field'), $i18n->get('label.details'));
  if (!ttValidString($cl_budget)) $err->add($i18n->get('error.field'), $i18n->get('label.budget'));

  // Ensure user email exists (required for workflow).
  if (!$user->getEmail()) $err->add($i18n->get('error.no_email'));

  if ($err->no()) {
    $workHelper = new ttWorkHelper($err);
    $fields = array('offer_id' => $cl_offer_id,
      'subject' => $cl_name,
      'type' => $cl_work_type,
      'descr_short' => $cl_description,
      'descr_long' => $cl_details,
      'currency' => ttWorkHelper::getCurrencyName($cl_currency_id),
      'amount' => $cl_budget);
     if ($workHelper->putOwnWorkItem($fields)) {
        header('Location: work.php');
        exit();
    }
  }
} // isPost

$smarty->assign('offer', $offer);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.workForm.work_name.focus()"');
$smarty->assign('title', $i18n->get('title.add_work'));
$smarty->assign('content_page_name', 'work/work_add.tpl');
$smarty->display('work/index.tpl');
