<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttGroupHelper');
import('ttTimesheetHelper');

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
if (!$user->isPluginEnabled('ts')) {
  header('Location: feature_disabled.php');
  exit();
}
if ($request->isPost()) {
  $userChanged = (bool)$request->getParameter('user_changed'); // Reused in multiple places below.
  if ($userChanged && !($user->can('track_time') && $user->isUserValid((int)$request->getParameter('user')))) {
    header('Location: access_denied.php'); // Group changed, but no rght or wrong user id.
    exit();
  }
}
// End of access checks.

// Determine user for whom we display this page.
if ($request->isPost() && $userChanged) {
  $user_id = (int)$request->getParameter('user');
  $user->setOnBehalfUser($user_id);
} else {
  $user_id = $user->getUser();
}

$group_id = $user->getGroup();

$showFiles = $user->isPluginEnabled('at');

// Elements of timesheetsForm.
$form = new Form('timesheetsForm');

if ($user->can('track_time')) {
  $rank = $user->getMaxRankForGroup($group_id);
  if ($user->can('track_own_time'))
    $options = array('status'=>ACTIVE,'max_rank'=>$rank,'include_self'=>true,'self_first'=>true);
  else
    $options = array('status'=>ACTIVE,'max_rank'=>$rank);
  $user_list = $user->getUsers($options);
  if (count($user_list) >= 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'document.timesheetsForm.user_changed.value=1;document.timesheetsForm.submit();',
      'name'=>'user',
      'style'=>'width: 250px;',
      'value'=>$user_id,
      'data'=>$user_list,
      'datakeys'=>array('id','name')));
    $form->addInput(array('type'=>'hidden','name'=>'user_changed'));
    $smarty->assign('user_dropdown', 1);
  }
}

$active_timesheets = ttTimesheetHelper::getActiveTimesheets();
$inactive_timesheets = ttTimesheetHelper::getInactiveTimesheets();

$showClient = $user->isPluginEnabled('cl');

$smarty->assign('active_timesheets', $active_timesheets);
$smarty->assign('inactive_timesheets', $inactive_timesheets);
$smarty->assign('show_client', $showClient);
$smarty->assign('show_files', $showFiles);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.timesheets'));
$smarty->assign('content_page_name', 'timesheets.tpl');
$smarty->display('index.tpl');
