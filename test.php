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
import('ttConfigHelper');
import('ttUserHelper');
import('ttGroupHelper');
import('ttClientHelper');
import('ttTimeHelper');
import('ttFileHelper');
import('DateAndTime');

// Access checks.
if (!(ttAccessAllowed('track_own_time') || ttAccessAllowed('track_time'))) {
  header('Location: access_denied.php');
  exit();
}
if ($user->behalf_id && (!$user->can('track_time') || !$user->checkBehalfId())) {
  header('Location: access_denied.php'); // Trying on behalf, but no right or wrong user.
  exit();
}
if (!$user->behalf_id && !$user->can('track_own_time') && !$user->adjustBehalfId()) {
  header('Location: access_denied.php'); // Trying as self, but no right for self, and noone to work on behalf.
  exit();
}
if ($request->isPost()) {
  $userChanged = $request->getParameter('user_changed'); // Reused in multiple places below.
  if ($userChanged && !($user->can('track_time') && $user->isUserValid($request->getParameter('user')))) {
    header('Location: access_denied.php'); // User changed, but no right or wrong user id.
    exit();
  }
}
// End of access checks.

// Determine user for whom we display this page.
if ($request->isPost() && $userChanged) {
  $user_id = $request->getParameter('user');
  $user->setOnBehalfUser($user_id);
} else {
  $user_id = $user->getUser();
}

$group_id = $user->getGroup();
$config = new ttConfigHelper($user->getConfig());

// Initialize and store date in session.
$cl_date = $request->getParameter('date', @$_SESSION['date']);
$selected_date = new DateAndTime(DB_DATEFORMAT, $cl_date);
if($selected_date->isError())
  $selected_date = new DateAndTime(DB_DATEFORMAT);
if(!$cl_date)
  $cl_date = $selected_date->toString(DB_DATEFORMAT);
$_SESSION['date'] = $cl_date;

// Elements of timeRecordForm.
$form = new Form('timeRecordForm');

// Calendar.
$form->addInput(array('type'=>'calendar','name'=>'date','value'=>$cl_date)); // calendar

// A hidden control for today's date from user's browser.
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_submit click.

if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {

  }
} // isPost


$smarty->assign('selected_date', $selected_date);
$smarty->assign('week_total', $week_total);
$smarty->assign('day_total', ttTimeHelper::getTimeForDay($cl_date));
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns();prepopulateNote();"');
$smarty->assign('timestring', $selected_date->toString($user->getDateFormat()));
$smarty->assign('title', $i18n->get('title.time'));
$smarty->assign('content_page_name', 'test.tpl');
$smarty->display('index.tpl');

