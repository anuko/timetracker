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

// Access check.
if (!ttAccessCheck(right_data_entry) || (MODE_PROJECTS != $user->tracking_mode && MODE_PROJECTS_AND_TASKS != $user->tracking_mode)) {
  header('Location: access_denied.php');
  exit();
}

if($user->canManageTeam()) {
  $active_projects = ttTeamHelper::getActiveProjects($user->team_id);
  $inactive_projects = ttTeamHelper::getInactiveProjects($user->team_id);
} else
  $active_projects = $user->getAssignedProjects();

$smarty->assign('active_projects', $active_projects);
$smarty->assign('inactive_projects', $inactive_projects);
$smarty->assign('title', $i18n->getKey('title.projects'));
$smarty->assign('content_page_name', 'projects.tpl');
$smarty->display('index.tpl');
