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

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('timesheet_name'));
  $cl_comment = trim($request->getParameter('comment'));
  $cl_status = $request->getParameter('status');
} else {
  $cl_name = $timesheet['name'];
  $cl_comment = $timesheet['comment'];
  $cl_status = $timesheet['status'];
}

// Can we delete this timesheet?
$canDelete = $timesheet['approve_status'] != 1
  || (($user->id == $timesheet['user_id'] && $user->can('approve_own_timesheets'))
  || ($user->id != $timesheet['user_id'] && $user->can('approve_timesheets')));

$form = new Form('timesheetForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_timesheet_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'timesheet_name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'comment','style'=>'width: 250px; height: 40px;','value'=>$cl_comment));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->get('dropdown.status_active'),INACTIVE=>$i18n->get('dropdown.status_inactive'))));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
if ($canDelete) $form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_comment, true)) $err->add($i18n->get('error.field'), $i18n->get('label.comment'));

  if ($request->getParameter('btn_save')) {
    if ($err->no()) {
      $existing_timesheet = ttTimesheetHelper::getTimesheetByName($cl_name);
      if (!$existing_timesheet || ($cl_timesheet_id == $existing_timesheet['id'])) {
         // Update timesheet information.
         if (ttTimesheetHelper::update(array(
           'id' => $cl_timesheet_id,
           'name' => $cl_name,
           'comment' => $cl_comment,
           'status' => $cl_status))) {
           header('Location: timesheets.php');
           exit();
        } else
           $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.object_exists'));
    }
  }

  if ($request->getParameter('btn_delete') && $canDelete) {
    header("Location: timesheet_delete.php?id=$cl_timesheet_id");
    exit();
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.timesheetForm.timesheet_name.focus()"');
$smarty->assign('can_delete', $canDelete);
$smarty->assign('title', $i18n->get('title.edit_timesheet'));
$smarty->assign('content_page_name', 'timesheet_edit.tpl');
$smarty->display('index.tpl');
