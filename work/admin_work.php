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
import('ttAdminWorkHelper');

// Access checks.
if (!ttAccessAllowed('administer_site')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$adminWorkHelper = new ttAdminWorkHelper($err);

$adminItems = $adminWorkHelper->getItems();
$pending_work = $adminItems['pending_work'];
$pending_offers = $adminItems['pending_offers'];
$available_work = $adminItems['available_work'];
$available_offers = $adminItems['available_offers'];

$smarty->assign('pending_work', $pending_work);
$smarty->assign('pending_offers', $pending_offers);
$smarty->assign('available_work', $available_work);
$smarty->assign('available_offers', $available_offers);
$smarty->assign('title', $i18n->get('title.work'));
$smarty->assign('content_page_name', 'work/admin_work.tpl');
$smarty->display('work/index.tpl');
