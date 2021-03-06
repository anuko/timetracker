<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttPredefinedExpenseHelper');

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('ex')) {
  header('Location: feature_disabled.php');
  exit();
}
$predefined_expense_id = (int)$request->getParameter('id');
$predefined_expense = ttPredefinedExpenseHelper::get($predefined_expense_id);
if (!$predefined_expense) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_cost = trim($request->getParameter('cost'));
} else {
  $cl_name = $predefined_expense['name'];
  $cl_cost = $predefined_expense['cost'];
}

$form = new Form('predefinedExpenseForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$predefined_expense_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'text','maxlength'=>'40','name'=>'cost','style'=>'width: 100px;','value'=>$cl_cost));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidFloat($cl_cost)) $err->add($i18n->get('error.field'), $i18n->get('label.cost'));
  if ($err->no()) {
    if (ttPredefinedExpenseHelper::update(array(
        'id' => $predefined_expense_id,
        'name' => $cl_name,
        'cost' => $cl_cost))) {
        header('Location: predefined_expenses.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.edit_predefined_expense'));
$smarty->assign('content_page_name', 'predefined_expense_edit.tpl');
$smarty->display('index.tpl');
