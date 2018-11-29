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

// Access checks.
if (!ttAccessAllowed('manage_roles')) {
  header('Location: access_denied.php');
  exit();
}
$group_id = (int)$request->getParameter('group_id');
if ($group_id && !$user->isGroupValid($group_id)) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

if ($group_id) {
  // We are passed a valid group_id (most likely from group_edit.php).
  // Set on behalf group accordingly.
  $user->setOnBehalfGroup($group_id);
}

$smarty->assign('active_roles', ttTeamHelper::getActiveRolesForUser());
$smarty->assign('inactive_roles', ttTeamHelper::getInactiveRolesForUser());
$smarty->assign('title', $i18n->get('title.roles'));
$smarty->assign('content_page_name', 'roles.tpl');
$smarty->display('index.tpl');
