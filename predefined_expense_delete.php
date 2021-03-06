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


$predefined_expense_to_delete = $predefined_expense['name'];

$form = new Form('predefinedExpenseDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$predefined_expense_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if (ttPredefinedExpenseHelper::delete($predefined_expense_id)) {
      header('Location: predefined_expenses.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: predefined_expenses.php');
    exit();
  }
} // isPost

$smarty->assign('predefined_expense_to_delete', $predefined_expense_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.predefinedExpenseDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_predefined_expense'));
$smarty->assign('content_page_name', 'predefined_expense_delete.tpl');
$smarty->display('index.tpl');
