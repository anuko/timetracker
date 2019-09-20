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
$offer = $workHelper->getOffer($cl_offer_id);
if (!$offer) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$currencies = ttWorkHelper::getCurrencies();

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('offer_name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_details = trim($request->getParameter('details'));
  $cl_currency = $request->getParameter('currency');
  $cl_budget = $request->getParameter('budget');
} else {
  $cl_name = $offer['subject'];
  $cl_description = $offer['descr_short'];
  $cl_details = $offer['descr_long'];
  $currency = $offer['currency'];
  $cl_currency = array_search($currency, $currencies);
  $cl_budget = $offer['amount'];
}

$form = new Form('offerForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_offer_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'offer_name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'textarea','name'=>'details','style'=>'width: 250px; height: 80px;','value'=>$cl_details));
$form->addInput(array('type'=>'combobox','name'=>'currency','data'=>$currencies,'value'=>$cl_currency));
$form->addInput(array('type'=>'floatfield','maxlength'=>'10','name'=>'budget','format'=>'.2','value'=>$cl_budget));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  if (!ttValidString($cl_details, true)) $err->add($i18n->get('error.field'), $i18n->get('label.details'));
  if (!ttValidString($cl_budget)) $err->add($i18n->get('error.field'), $i18n->get('label.budget'));

  // Ensure user email exists (required for workflow).
  if (!$user->getEmail()) $err->add($i18n->get('error.no_email'));

  if ($err->no()) {
    if ($request->getParameter('btn_save')) {
      // Update offer information.
      $fields = array('work_id'=>$cl_offer_id,
        'subject'=>$cl_name,
        'descr_short' => $cl_description,
        'descr_long' => $cl_details,
        'currency' => $currencies[$cl_currency],
        'amount' => $cl_budget);
      if ($workHelper->updateOffer($fields)) {
        header('Location: work.php');
        exit();
      }
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.edit_offer'));
$smarty->assign('content_page_name', 'offer_edit.tpl');
$smarty->display('index.tpl');
