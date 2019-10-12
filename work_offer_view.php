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
require_once('plugins/work_constants.php');
import('ttWorkHelper');
import('form.Form');

// Access checks.
if (!$user->isPluginEnabled('wk')) {
  header('Location: feature_disabled.php');
  exit();
}
if (!ttAccessAllowed('manage_work')) {
  header('Location: access_denied.php');
  exit();
}
$cl_offer_id = (int)$request->getParameter('id');
$workHelper = new ttWorkHelper($err);
$offer = $workHelper->getOwnWorkItemOffer($cl_offer_id);
if (!$offer) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Get an associated work item.
$work_item = $workHelper->getOwnWorkItem($offer['work_id']);
if (!$work_item) $err->add($i18n->get('work.error.work_not_available'));

if ($request->isPost()) {
  $cl_client_comment = $request->getParameter('client_comment');
} else {
  $cl_client_comment = $offer['client_comment'];
}

$cl_contractor = $offer['group_name'];
$cl_name = $offer['subject'];
$cl_description = $offer['descr_short'];
$cl_details = $offer['descr_long'];
$cl_budget = $offer['amount_with_currency'];
$cl_status = $offer['status_label'];

$form = new Form('offerForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_offer_id));
$form->addInput(array('type'=>'text','name'=>'contractor','value'=>$cl_contractor));
$form->getElement('contractor')->setEnabled(false);
$form->addInput(array('type'=>'text','name'=>'offer_name','style'=>'width: 400px;','value'=>$cl_name));
$form->getElement('offer_name')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 400px; height: 80px;','value'=>$cl_description));
$form->getElement('description')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'details','style'=>'width: 400px; height: 200px;','value'=>$cl_details));
$form->getElement('details')->setEnabled(false);
$form->addInput(array('type'=>'text','name'=>'budget','value'=>$cl_budget));
$form->getElement('budget')->setEnabled(false);
$form->addInput(array('type'=>'text','name'=>'status','style'=>'width: 400px;','value'=>$cl_status));
$form->getElement('status')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'client_comment','style'=>'width: 400px; height: 80px;','value'=>$cl_client_comment));
if ($offer['status'] == STATUS_APPROVED) {
  $form->addInput(array('type'=>'submit','name'=>'btn_accept','value'=>$i18n->get('work.button.accept')));
  $form->addInput(array('type'=>'submit','name'=>'btn_decline','value'=>$i18n->get('work.button.decline')));
}

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_client_comment)) $err->add($i18n->get('error.field'), $i18n->get('label.comment'));

  // Ensure user email exists (required for workflow).
  if (!$user->getEmail()) $err->add($i18n->get('error.no_email'));

  if ($err->no()) {
    $workHelper = new ttWorkHelper($err);
    $fields = array('offer_id'=>$cl_offer_id,
      'client_comment'=>$cl_client_comment);

    if ($request->getParameter('btn_accept')) {
      // Accept offer.
      if ($workHelper->acceptOwnWorkItemOffer($fields)) {
        header('Location: work_offer_view.php?id='.$cl_offer_id);
        exit();
      }
    }

    if ($request->getParameter('btn_decline')) {
      // Decline offer.
      if ($workHelper->declineOwnWorkItemOffer($fields)) {
        header('Location: work_offer_view.php?id='.$cl_offer_id);
        exit();
      }
    }
  }
} // isPost

$smarty->assign('work_item', $work_item);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.offer'));
$smarty->assign('content_page_name', 'work_offer_view.tpl');
$smarty->display('index.tpl');
