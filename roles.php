<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttTeamHelper');
import('ttRoleHelper');

// Access checks.
if (!ttAccessAllowed('manage_roles')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$smarty->assign('active_roles', ttTeamHelper::getActiveRolesForUser());
$smarty->assign('inactive_roles', ttTeamHelper::getInactiveRolesForUser());
$smarty->assign('title', $i18n->get('title.roles'));
$smarty->assign('content_page_name', 'roles.tpl');
$smarty->display('index.tpl');
