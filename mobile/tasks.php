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
import('form.Form');
import('ttTeamHelper');

// Access check.
if (!ttAccessAllowed('manage_tasks') || MODE_PROJECTS_AND_TASKS != $user->tracking_mode) {
  header('Location: access_denied.php');
  exit();
}

$smarty->assign('active_tasks', ttTeamHelper::getActiveTasks($user->team_id));
$smarty->assign('inactive_tasks', ttTeamHelper::getInactiveTasks($user->team_id));
$smarty->assign('title', $i18n->get('title.tasks'));
$smarty->assign('content_page_name', 'mobile/tasks.tpl');
$smarty->display('mobile/index.tpl');
