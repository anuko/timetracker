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

require_once('../initialize.php');
import('ttWorkHelper');

// Access checks.
if (!ttAccessAllowed('manage_work')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('wk')) {
  header('Location: feature_disabled.php');
  exit();
}
$work_id = (int)$request->getParameter('id');
$workHelper = new ttWorkHelper($err);
$work_item = $workHelper->getOwnWorkItem($work_id);
if (!$work_item) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$work_item_offers = $workHelper->getOwnWorkItemOffers($work_id);

$smarty->assign('work_item', $work_item);
$smarty->assign('work_item_offers', $work_item_offers);
$smarty->assign('title', $i18n->get('work.label.offers'));
$smarty->assign('content_page_name', 'work/work_offers.tpl');
$smarty->display('work/index.tpl');
