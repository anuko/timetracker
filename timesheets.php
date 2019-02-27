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
import('ttGroupHelper');
import('ttTimesheetHelper');

// Access checks.
if (!(ttAccessAllowed('view_own_timesheets') || ttAccessAllowed('view_timesheets') || ttAccessAllowed('view_all_timesheets'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('ts')) {
  header('Location: feature_disabled.php');
  exit();
}
if ($user->isClient()) {
  $users_for_client = ttGroupHelper::getUsersForClient($user->client_id);
  if (count($users_for_client) == 0) {
    header('Location: access_denied.php'); // There are no users for client.
    exit();
  }
}
if ($request->isPost()) {
  $userChanged = $request->getParameter('user_changed');
  if ($userChanged && !(ttTimesheetHelper::isUserValid($request->getParameter('user')))) {
    header('Location: access_denied.php'); // Wrong user id.
    exit();
  }
}
// End of access checks.

// Determine user for whom we display this page.
$notClient = !$user->isClient();
if ($request->isPost() && $userChanged) {
  $user_id = $request->getParameter('user');
} else {
  if ($notClient)
    $user_id = $user->getUser();
  else
    $user_id = $users_for_client[0]['id']; // First found user for a client.
}
$group_id = $user->getGroup();

// Elements of timesheetsForm.
$form = new Form('timesheetsForm');

if ($user->can('view_timesheets') || $user->can('view_all_timesheets')) {
  // Prepare user list for dropdown.
  if ($notClient) {
    $rank = $user->can('view_all_timesheets') ? MAX_RANK : $user->getMaxRankForGroup($group_id);
    if ($user->can('view_own_timesheets'))
      $options = array('max_rank'=>$rank,'include_self'=>true,'self_first'=>true);
    else
      $options = array('max_rank'=>$rank);
    $user_list = $user->getUsers($options);
  } else
    $user_list = $users_for_client; // Obtained above.

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

$active_timesheets = ttTimesheetHelper::getActiveTimesheets($user_id);
if ($notClient)
  $inactive_timesheets = ttTimesheetHelper::getInactiveTimesheets($user_id);

$showClient = $user->isPluginEnabled('cl') && $notClient;
$canEdit = $notClient && ($user->can('manage_own_timesheets') ||
  $user->can('manage_timesheets') || $user->can('manage_all_timesheets'));

$smarty->assign('active_timesheets', $active_timesheets);
$smarty->assign('inactive_timesheets', $inactive_timesheets);
$smarty->assign('show_client', $showClient);
$smarty->assign('not_client', $notClient);
$smarty->assign('can_edit', $canEdit);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.timesheets'));
$smarty->assign('content_page_name', 'timesheets.tpl');
$smarty->display('index.tpl');
