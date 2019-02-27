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
if (!(ttAccessAllowed('manage_own_timesheets') || ttAccessAllowed('manage_timesheets') || ttAccessAllowed('manage_all_timesheets'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('ts')) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('timesheet_name'));
  $cl_comment = trim($request->getParameter('submitter_comment'));

  // Report settings are stored in session bean before we get here.
  $bean = new ActionForm('reportBean', new Form('reportForm'), $request);
  $bean->loadBean();
}

$form = new Form('timesheetForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'timesheet_name','style'=>'width: 250px;','value'=>$cl_name));

$form->addInput(array('type'=>'datefield','maxlength'=>'20','name'=>'start','value'=>$cl_start));
$form->addInput(array('type'=>'datefield','maxlength'=>'20','name'=>'finish','value'=>$cl_finish));

$form->addInput(array('type'=>'textarea','name'=>'submitter_comment','style'=>'width: 250px; height: 40px;','value'=>$cl_comment));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_comment, true)) $err->add($i18n->get('error.field'), $i18n->get('label.comment'));

  if ($err->no()) {
    $user_id = $bean->getDetachedAttribute('timesheet_user_id');
    if (!ttTimesheetHelper::getTimesheetByName($cl_name, $user_id)) {
      if (ttTimesheetHelper::insert(array('user_id' => $user_id,
        'client_id' => $bean->getAttribute('client'),
        'name' => $cl_name,
        'comment' => $cl_comment))) {
          header('Location: timesheets.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.object_exists'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.timesheetForm.timesheet_name.focus()"');
$smarty->assign('title', $i18n->get('title.add_timesheet'));
$smarty->assign('content_page_name', 'timesheet_add.tpl');
$smarty->display('index.tpl');
