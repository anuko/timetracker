<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('DateAndTime');
import('ttExpenseHelper');

// Access checks.
if (!(ttAccessAllowed('track_own_expenses') || ttAccessAllowed('track_expenses'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('ex')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_id = (int)$request->getParameter('id');
// Get the expense item we are deleting.
$expense_item = ttExpenseHelper::getItem($cl_id);
if (!$expense_item || $expense_item['approved'] || $expense_item['invoice_id']) {
  // Prohibit deleting not ours, approved, or invoiced items.
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

if ($request->isPost()) {
  if ($request->getParameter('delete_button')) { // Delete button pressed.

    // Determine if it is okay to delete the record.
    $item_date = new DateAndTime(DB_DATEFORMAT, $expense_item['date']);
    if ($user->isDateLocked($item_date))
      $err->add($i18n->get('error.range_locked'));

    if ($err->no()) {
      // Mark the record as deleted.
      if (ttExpenseHelper::markDeleted($cl_id)) {
        header('Location: expenses.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    }
  }
  if ($request->getParameter('cancel_button')) { // Cancel button pressed.
    header('Location: expenses.php');
    exit();
  }
} // isPost

$form = new Form('expenseItemForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
$form->addInput(array('type'=>'submit','name'=>'delete_button','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'cancel_button','value'=>$i18n->get('button.cancel')));

$show_project = MODE_PROJECTS == $user->getTrackingMode() || MODE_PROJECTS_AND_TASKS == $user->getTrackingMode();

$smarty->assign('forms', array($form->getName() => $form->toArray()));
$smarty->assign('expense_item', $expense_item);
$smarty->assign('show_project', $show_project);
$smarty->assign('title', $i18n->get('title.delete_expense'));
$smarty->assign('content_page_name', 'expense_delete.tpl');
$smarty->display('index.tpl');
