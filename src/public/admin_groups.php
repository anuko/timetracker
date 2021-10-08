<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('ttOrgHelper');

// Access checks.
if (!ttAccessAllowed('administer_site')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$smarty->assign('groups', ttOrgHelper::getOrgs());
$smarty->assign('title', $i18n->get('title.groups'));
$smarty->assign('content_page_name', 'admin_groups.tpl');
$smarty->display('index.tpl');
