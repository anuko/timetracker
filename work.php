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
import('ttWorkHelper');

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

$workHelper = new ttWorkHelper($err);

if($user->can('manage_work')) {
  $active_work = $workHelper->getActiveWork(); // Active work items this group is outsourcing.
  $available_offers = $workHelper->getAvailableOffers(); // Available offers from other organizations.
}
if($user->can('bid_on_work')) {
  $available_work = $workHelper->getAvailableWork(); // Currently available work items from other orgs.
  $active_offers = $workHelper->getActiveOffers(); // Active offers this group makes available to other groups.
}
if($user->can('update_work')) {
  // $in_progress_work = ttWorkHelper::getInProgressWork(); // Work items in progress for other groups.
  // $completed_work = ttWorkHelper::getCompletedWork(); // Completed work items for other groups.
}
// $available_offers = ttWorkHelper::getAvailableOffers(); // Currently available offers to do work.
// TODO: review access rights for the code above.

$smarty->assign('active_work', $active_work);
$smarty->assign('available_work', $available_work);
$smarty->assign('active_offers', $active_offers);
$smarty->assign('available_offers', $available_offers);
$smarty->assign('title', $i18n->get('title.work'));
$smarty->assign('content_page_name', 'work.tpl');
$smarty->display('index.tpl');
