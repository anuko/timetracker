<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('../initialize.php');
import('form.Form');
import('ttGroupHelper');

// Mobile pages are no longer separate. Redirect to main page.
header('Location: ../tasks.php');
exit();
// Below is no longer used code.

// Access checks.
if (!(ttAccessAllowed('view_own_tasks') || ttAccessAllowed('manage_tasks'))) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

if($user->can('manage_tasks')) {
  $active_tasks = ttGroupHelper::getActiveTasks();
  $inactive_tasks = ttGroupHelper::getInactiveTasks();
} else
  $active_tasks = $user->getAssignedTasks();

$smarty->assign('active_tasks', $active_tasks);
$smarty->assign('inactive_tasks', $inactive_tasks);
$smarty->assign('title', $i18n->get('title.tasks'));
$smarty->assign('content_page_name', 'mobile/tasks.tpl');
$smarty->display('mobile/index.tpl');
