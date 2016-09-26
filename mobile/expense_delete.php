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
import('form.Form');
import('DateAndTime');
import('ttExpenseHelper');

// Access check.
if (!ttAccessCheck(right_data_entry) || !$user->isPluginEnabled('ex')) {
  header('Location: access_denied.php');
  exit();
}

$cl_id = $request->getParameter('id');
$expense_item = ttExpenseHelper::getItem($cl_id, $user->getActiveUser());

// Prohibit deleting invoiced records.
if ($expense_item['invoice_id']) die($i18n->getKey('error.sys'));

if ($request->isPost()) {
  if ($request->getParameter('delete_button')) { // Delete button pressed.

    // Determine if it is okay to delete the record.
    $item_date = new DateAndTime(DB_DATEFORMAT, $expense_item['date']);
    if ($user->isDateLocked($item_date))
      $err->add($i18n->getKey('error.range_locked'));

    if ($err->no()) {
      // Mark the record as deleted.
      if (ttExpenseHelper::markDeleted($cl_id, $user->getActiveUser())) {
        header('Location: expenses.php');
        exit();
      } else
        $err->add($i18n->getKey('error.db'));
    }
  }
  if ($request->getParameter('cancel_button')) { // Cancel button pressed.
    header('Location: expenses.php');
    exit();
  }
} // isPost

$form = new Form('expenseItemForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
$form->addInput(array('type'=>'submit','name'=>'delete_button','value'=>$i18n->getKey('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'cancel_button','value'=>$i18n->getKey('button.cancel')));

$smarty->assign('expense_item', $expense_item);
$smarty->assign('forms', array($form->getName() => $form->toArray()));
$smarty->assign('title', $i18n->getKey('title.delete_expense'));
$smarty->assign('content_page_name', 'mobile/expense_delete.tpl');
$smarty->display('mobile/index.tpl');
