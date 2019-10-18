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
if (!ttAccessAllowed('manage_work')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('wk')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_work_id = (int)$request->getParameter('id');
$workHelper = new ttWorkHelper($err);
$work_item = $workHelper->getOwnWorkItem($cl_work_id);
if (!$work_item) {
  header('Location: access_denied.php');
  exit();
}
// Do we have offer_id?
$offer_id = $work_item['offer_id'];
if ($offer_id) {
  $offer = $workHelper->getAvailableOffer($offer_id);
  if (!$offer) {
    header('Location: access_denied.php');
    exit();
  }
}
// End of access checks.

$currencies = ttWorkHelper::getCurrencies();

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('work_name'));
  $cl_work_type = $request->getParameter('work_type');
  $cl_description = trim($request->getParameter('description'));
  $cl_details = trim($request->getParameter('details'));
  $cl_currency_id = $request->getParameter('currency');
  $cl_budget = $request->getParameter('budget');
} else {
  $cl_name = $work_item['subject'];
  $cl_work_type = $work_item['type'];
  $cl_description = $work_item['descr_short'];
  $cl_details = $work_item['descr_long'];
  $cl_currency_id = ttWorkHelper::getCurrencyID($work_item['currency']);
  $cl_budget = $work_item['amount'];
  $cl_status = $work_item['status_label'];
  $cl_moderator_comment = $work_item['moderator_comment'];
}
// Override some fields for work on an available offer.
if ($offer) {
  $cl_name = $offer['subject'];
  $cl_work_type = 0; // one-time work
  $cl_currency_id = ttWorkHelper::getCurrencyID($offer['currency']);
  $cl_budget = $offer['amount'];
}

$show_moderator_comment = $cl_moderator_comment != null;

$form = new Form('workForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_work_id));
$form->addInput(array('type'=>'text','name'=>'work_name','maxlength'=>'128','style'=>'width: 400px;','value'=>$cl_name));
$WORK_TYPE_OPTIONS = array('0'=>$i18n->get('work.type.one_time'),'1'=>$i18n->get('work.type.ongoing'));
$form->addInput(array('type'=>'combobox','name'=>'work_type','data'=>$WORK_TYPE_OPTIONS,'value'=>$cl_work_type));
$form->addInput(array('type'=>'textarea','name'=>'description','maxlength'=>'512','style'=>'width: 400px; height: 80px;','value'=>$cl_description));
$form->addInput(array('type'=>'textarea','name'=>'details','style'=>'width: 400px; height: 200px;','value'=>$cl_details));
$form->addInput(array('type'=>'combobox','name'=>'currency','data'=>$currencies,'datakeys'=>array('id','name'),'value'=>$cl_currency_id));
$form->addInput(array('type'=>'floatfield','maxlength'=>'10','name'=>'budget','format'=>'.2','value'=>$cl_budget));
$form->addInput(array('type'=>'text','name'=>'status','style'=>'width: 400px;','value'=>$cl_status));
$form->getElement('status')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'moderator_comment','style'=>'width: 400px; height: 80px;','value'=>$cl_moderator_comment));
$form->getElement('moderator_comment')->setEnabled(false);
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
// Disable some controls for work on an available offer.
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
    if ($request->getParameter('btn_save')) {
      // Update work information.
      $fields = array('work_id'=>$cl_work_id,
        'type'=>$cl_work_type,
        'subject'=>$cl_name,
        'descr_short' => $cl_description,
        'descr_long' => $cl_details,
        'currency' => ttWorkHelper::getCurrencyName($cl_currency_id),
        'amount' => $cl_budget);
      if ($offer_id > 0) {
        if ($workHelper->updateOwnWorkItemOnOffer($fields)) {
          header('Location: work.php');
          exit();
        }
      } else {
        if ($workHelper->updateOwnWorkItem($fields)) {
          header('Location: work.php');
          exit();
        }
      }
    }
  }
} // isPost

$smarty->assign('offer', $offer);
$smarty->assign('show_moderator_comment', $show_moderator_comment);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.edit_work'));
$smarty->assign('content_page_name', 'work_edit.tpl');
$smarty->display('index.tpl');
