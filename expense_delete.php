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
$expense_item = ttExpenseHelper::getItem($cl_id, $user->getActiveUser());
if (!$expense_item || $expense_item['invoice_id']) {
  // Prohibit deleting not ours or invoiced items.
  header('Location: access_denied.php');
  exit();
}

if ($request->isPost()) {
  if ($request->getParameter('delete_button')) { // Delete button pressed.

    // Determine if it is okay to delete the record.
    $item_date = new DateAndTime(DB_DATEFORMAT, $expense_item['date']);
    if ($user->isDateLocked($item_date))
      $err->add($i18n->get('error.range_locked'));

    if ($err->no()) {
      // Mark the record as deleted.
      if (ttExpenseHelper::markDeleted($cl_id, $user->getActiveUser())) {
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

$smarty->assign('expense_item', $expense_item);
$smarty->assign('forms', array($form->getName() => $form->toArray()));
$smarty->assign('title', $i18n->get('title.delete_expense'));
$smarty->assign('content_page_name', 'expense_delete.tpl');
$smarty->display('index.tpl');
