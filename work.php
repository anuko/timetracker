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
import('ttGroupHelper');

// Access checks.
if (!(ttAccessAllowed('update_work') || ttAccessAllowed('bid_on_work')  || ttAccessAllowed('manage_work'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('wk')) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

if($user->can('manage_work')) {
  // $active_work = ttWorkHelper::getActiveWork(); // Active work items this group is outsourcing.
  // $inactive_work = ttWorkHelper::getInactiveWork(); // Inactive work items this group was outsourcing.
}
if($user->can('bid_on_work')) {
  // $available_work = ttWorkHelper::getAvailableWork(); // Currently available work items from other groups.
}
if($user->can('update_work')) {
  // $in_progress_work = ttWorkHelper::getInProgressWork(); // Work items in progress for other groups.
  // $completed_work = ttWorkHelper::getCompletedWork(); // Completed work items for other groups.
}

$smarty->assign('active_work', $active_work);
$smarty->assign('inactive_work', $inactive_work);
$smarty->assign('available_work', $available_work);
$smarty->assign('in_progress_work', $in_progress_work);
$smarty->assign('completed_work', $completed_work);
$smarty->assign('title', $i18n->get('title.work'));
$smarty->assign('content_page_name', 'work.tpl');
$smarty->display('index.tpl');
