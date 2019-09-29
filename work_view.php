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
import('ttWorkHelper');
import('form.Form');

// Access checks.
if (!$user->isPluginEnabled('wk')) {
  header('Location: feature_disabled.php');
  exit();
}
if (!ttAccessAllowed('bid_on_work')) {
  header('Location: access_denied.php');
  exit();
}
$cl_work_id = (int)$request->getParameter('id');
$workHelper = new ttWorkHelper($err);
$work_item = $workHelper->getAvailableWorkItem($cl_work_id);
if (!$work_item) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$cl_client = $work_item['group_name'];
$cl_name = $work_item['subject'];
$cl_description = $work_item['descr_short'];
$cl_details = $work_item['descr_long'];
$cl_budget = $work_item['amount_with_currency'];

$form = new Form('workForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_work_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'client','value'=>$cl_client));
$form->getElement('client')->setEnabled(false);
$form->addInput(array('type'=>'textarea','maxlength'=>'100','name'=>'work_name','style'=>'width: 400px;','value'=>$cl_name));
$form->getElement('work_name')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 400px; height: 80px;','value'=>$cl_description));
$form->getElement('description')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'details','style'=>'width: 400px; height: 200px;','value'=>$cl_details));
$form->getElement('details')->setEnabled(false);
$form->addInput(array('type'=>'text','name'=>'budget','value'=>$cl_budget));
$form->getElement('budget')->setEnabled(false);

$smarty->assign('work_id', $cl_work_id);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.work'));
$smarty->assign('content_page_name', 'work_view.tpl');
$smarty->display('index.tpl');
