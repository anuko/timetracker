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
// End of access checks.

$cl_name = $cl_cost = null;
if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_cost = trim($request->getParameter('cost'));
}

$form = new Form('predefinedExpenseForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>$cl_name));
$form->addInput(array('type'=>'text','class'=>'text-field-with-hint','maxlength'=>'40','name'=>'cost','value'=>$cl_cost));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidFloat($cl_cost)) $err->add($i18n->get('error.field'), $i18n->get('label.cost'));
  if ($err->no()) {
    if (ttPredefinedExpenseHelper::insert(array(
        'name' => $cl_name,
        'cost' => $cl_cost))) {
        header('Location: predefined_expenses.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.add_predefined_expense'));
$smarty->assign('content_page_name', 'predefined_expense_add.tpl');
$smarty->display('index.tpl');
