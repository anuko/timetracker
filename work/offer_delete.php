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
import('ttWorkHelper');
import('form.Form');

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

$offer_to_delete = $offer['subject'];

$form = new Form('offerDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_offer_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if ($workHelper->deleteOwnOffer($cl_offer_id)) {
      header('Location: work.php');
      exit();
    }
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: work.php');
    exit();
  }
} // isPost

$smarty->assign('offer_to_delete', $offer_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.offerDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_offer'));
$smarty->assign('content_page_name', 'work/offer_delete.tpl');
$smarty->display('work/index.tpl');
