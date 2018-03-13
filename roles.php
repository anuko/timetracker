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
import('ttTeamHelper');
import('ttRoleHelper');

// Access check.
if (!ttAccessAllowed('manage_roles')) {
  header('Location: access_denied.php');
  exit();
}

// If there are no roles in team, introduce default ones.
if (!ttRoleHelper::rolesExist()) ttRoleHelper::createDefaultRoles(); // TODO: refactor or remove after roles revamp.

$smarty->assign('active_roles', ttTeamHelper::getActiveRoles($user->team_id));
$smarty->assign('inactive_roles', ttTeamHelper::getInactiveRoles($user->team_id));
$smarty->assign('title', $i18n->getKey('title.roles'));
$smarty->assign('content_page_name', 'roles.tpl');
$smarty->display('index.tpl');
