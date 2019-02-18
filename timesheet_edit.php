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
import('ttTimesheetHelper');

// Access checks.
if (!(ttAccessAllowed('manage_own_timesheets') || ttAccessAllowed('manage_timesheets'))) {
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
  $cl_comment = $timesheet['submitter_comment'];
  $cl_status = $timesheet['status'];
}

$form = new Form('timesheetForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_timesheet_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'timesheet_name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'comment','style'=>'width: 250px; height: 40px;','value'=>$cl_comment));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->get('dropdown.status_active'),INACTIVE=>$i18n->get('dropdown.status_inactive'))));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_comment, true)) $err->add($i18n->get('error.field'), $i18n->get('label.comment'));

  if ($err->no()) {
    if ($request->getParameter('btn_save')) {
      $existing_timesheet = ttTimesheetHelper::getTimesheetByName($cl_name, $timesheet['user_id']);
      if (!$existing_timesheet || ($cl_timesheet_id == $existing_timesheet['id'])) {
         // Update project information.
         if (ttTimesheetHelper::update(array(
           'id' => $cl_timesheet_id,
           'name' => $cl_name,
           'submitter_comment' => $cl_comment,
           'status' => $cl_status))) {
           header('Location: timesheets.php');
           exit();
        } else
           $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.object_exists'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.timesheetForm.timesheet_name.focus()"');
$smarty->assign('show_users', count($users) > 0);
$smarty->assign('show_tasks', $show_tasks);
$smarty->assign('title', $i18n->get('title.edit_timesheet'));
$smarty->assign('content_page_name', 'timesheet_edit.tpl');
$smarty->display('index.tpl');
