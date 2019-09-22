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
import('ttAdminWorkHelper');
import('form.Form');

// Access checks.
if (!ttAccessAllowed('administer_site')) {
  header('Location: access_denied.php');
  exit();
}
$cl_work_id = (int)$request->getParameter('id');
$adminWorkHelper = new ttAdminWorkHelper($err);
$work_item = $adminWorkHelper->getWork($cl_work_id);
if (!$work_item) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$work_to_delete = $work_item['subject'];

$form = new Form('workDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_work_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if ($adminWorkHelper->deleteWork($cl_work_id)) {
      header('Location: admin_work.php');
      exit();
    }
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: admin_work.php');
    exit();
  }
} // isPost

$smarty->assign('work_to_delete', $work_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.workDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_work'));
$smarty->assign('content_page_name', 'work_delete.tpl');
$smarty->display('index.tpl');
