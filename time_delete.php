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
import('ttUserHelper');
import('ttTimeHelper');
import('DateAndTime');

// Access check.
if (!ttAccessCheck(right_data_entry)) {
  header('Location: access_denied.php');
  exit();
}

$cl_id = $request->getParameter('id');
$time_rec = ttTimeHelper::getRecord($cl_id, $user->getActiveUser());

// Prohibit deleting invoiced records.
if ($time_rec['invoice_id']) die($i18n->getKey('error.sys'));

// Escape comment for presentation.
$time_rec['comment'] = htmlspecialchars($time_rec['comment']);

if ($request->isPost()) {
  if ($request->getParameter('delete_button')) { // Delete button pressed.

    // Determine if it's okay to delete the record.
    $item_date = new DateAndTime(DB_DATEFORMAT, $time_rec['date']);

    // Determine if the record is uncompleted.
    $uncompleted = ($time_rec['duration'] == '0:00');

    if ($user->isDateLocked($item_date) && !$uncompleted)
      $err->add($i18n->getKey('error.range_locked'));

    if ($err->no()) {

      // Delete the record.
      $result = ttTimeHelper::delete($cl_id, $user->getActiveUser());

      if ($result) {
        header('Location: time.php');
        exit();
      } else {
        $err->add($i18n->getKey('error.db'));
      }
    }
  }
  if ($request->getParameter('cancel_button')) { // Cancel button pressed.
    header('Location: time.php');
    exit();
  }
} // isPost

$form = new Form('timeRecordForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
$form->addInput(array('type'=>'submit','name'=>'delete_button','value'=>$i18n->getKey('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'cancel_button','value'=>$i18n->getKey('button.cancel')));

$smarty->assign('time_rec', $time_rec);
$smarty->assign('forms', array($form->getName() => $form->toArray()));
$smarty->assign('title', $i18n->getKey('title.delete_time_record'));
$smarty->assign('content_page_name', 'time_delete.tpl');
$smarty->display('index.tpl');
