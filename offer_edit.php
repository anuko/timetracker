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
import('ttWorkHelper');

// Access checks.
if (!ttAccessAllowed('bid_on_work')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('wk')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_offer_id = (int)$request->getParameter('id');
$workHelper = new ttWorkHelper($err);
$offer = $workHelper->getOwnOffer($cl_offer_id);
if (!$offer) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Is this offer associated with a work item?
$work_id = $offer['work_id'];
if ($work_id) {
  $work_item = $workHelper->getAvailableWorkItem($work_id);
  if (!$work_item) $err->add($i18n->get('work.error.work_not_available'));
}

$currencies = ttWorkHelper::getCurrencies();

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('offer_name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_details = trim($request->getParameter('details'));
  $cl_currency_id = $request->getParameter('currency');
  if (!$cl_currency_id && $work_item) $cl_currency_id = ttWorkHelper::getCurrencyID($work_item['currency']);
  $cl_budget = $request->getParameter('budget');
  $cl_payment_info = $request->getParameter('payment_info');
} else {
  $cl_name = $offer['subject'];
  $cl_description = $offer['descr_short'];
  $cl_details = $offer['descr_long'];
  $cl_currency_id = ttWorkHelper::getCurrencyID($offer['currency']);
  $cl_budget = $offer['amount'];
  $cl_payment_info = $offer['payment_info'];
  $cl_status = $offer['status_label'];
  $cl_moderator_comment = $offer['moderator_comment'];
}

$show_moderator_comment = $cl_moderator_comment != null;

$form = new Form('offerForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_offer_id));
if ($work_id) {
  $form->addInput(array('type'=>'textarea','name'=>'work_description','style'=>'width: 400px; height: 80px;','value'=>$work_item['descr_short']));
  $form->getElement('work_description')->setEnabled(false);
}
$form->addInput(array('type'=>'text','name'=>'offer_name','maxlength'=>'128','style'=>'width: 400px;','value'=>$cl_name));
if ($work_id) $form->getElement('offer_name')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'description','maxlength'=>'512','style'=>'width: 400px; height: 80px;','value'=>$cl_description));
$form->addInput(array('type'=>'textarea','name'=>'details','style'=>'width: 400px; height: 200px;','value'=>$cl_details));
$form->addInput(array('type'=>'combobox','name'=>'currency','data'=>$currencies,'datakeys'=>array('id','name'),'value'=>$cl_currency_id));
if ($work_id) $form->getElement('currency')->setEnabled(false);
$form->addInput(array('type'=>'floatfield','maxlength'=>'10','name'=>'budget','format'=>'.2','value'=>$cl_budget));
$form->addInput(array('type'=>'textarea','name'=>'payment_info','maxlength'=>'256','style'=>'width: 400px; height: 40px; vertical-align: middle','value'=>$cl_payment_info));
$form->addInput(array('type'=>'text','name'=>'status','style'=>'width: 400px;','value'=>$cl_status));
$form->getElement('status')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'moderator_comment','style'=>'width: 400px; height: 80px;','value'=>$cl_moderator_comment));
$form->getElement('moderator_comment')->setEnabled(false);
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

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
    if ($request->getParameter('btn_save')) {
      // Update offer information.
      $fields = array('offer_id'=>$cl_offer_id,
        'subject'=>$cl_name,
        'descr_short' => $cl_description,
        'descr_long' => $cl_details,
        'currency' => ttWorkHelper::getCurrencyName($cl_currency_id),
        'amount' => $cl_budget,
        'payment_info' => $cl_payment_info);
      if ($workHelper->updateOwnOffer($fields)) {
        header('Location: work.php');
        exit();
      }
    }
  }
} // isPost

if ($work_id) {
  $smarty->assign('work_id', $work_id);
  $smarty->assign('work_name', $work_item['subject']);
  $smarty->assign('work_description', $work_item['descr_short']);
}
$smarty->assign('show_moderator_comment', $show_moderator_comment);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.edit_offer'));
$smarty->assign('content_page_name', 'offer_edit.tpl');
$smarty->display('index.tpl');
