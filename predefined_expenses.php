<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttGroupHelper');

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

$form = new Form('predefinedExpensesForm');

if ($request->isPost()) {
  if ($request->getParameter('btn_add')) {
    // The Add button clicked. Redirect to predefined_expense_add.php page.
    header('Location: predefined_expense_add.php');
    exit();
  }
} else {
  $form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));
  $predefinedExpenses = ttGroupHelper::getPredefinedExpenses();
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('predefined_expenses', $predefinedExpenses);
$smarty->assign('title', $i18n->get('title.predefined_expenses'));
$smarty->assign('content_page_name', 'predefined_expenses.tpl');
$smarty->display('index.tpl');
