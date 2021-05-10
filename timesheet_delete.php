<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttTimesheetHelper');

// Access checks.
if (!(ttAccessAllowed('track_own_time') || ttAccessAllowed('track_time'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('ts')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_timesheet_id = (int)$request->getParameter('id');
$timesheet = ttTimesheetHelper::getTimesheet($cl_timesheet_id);
if (!$timesheet) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$timesheet_to_delete = $timesheet['name'];

$form = new Form('timesheetDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_timesheet_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if (ttTimesheetHelper::delete($cl_timesheet_id)) {
      header('Location: timesheets.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: timesheets.php');
    exit();
  }
} // isPost

$smarty->assign('timesheet_to_delete', $timesheet_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.invoiceDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_timesheet'));
$smarty->assign('content_page_name', 'timesheet_delete.tpl');
$smarty->display('index.tpl');
