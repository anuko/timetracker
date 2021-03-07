<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('../initialize.php');
import('form.Form');
import('ttTeamHelper');
import('ttGroupHelper');

// Mobile pages are no longer separate. Redirect to main page.
header('Location: ../projects.php');
exit();
// Below is no longer used code.

// Access checks.
if (!(ttAccessAllowed('view_own_projects') || ttAccessAllowed('manage_projects'))) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS != $user->getTrackingMode() && MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

if($user->can('manage_projects')) {
  $active_projects = ttGroupHelper::getActiveProjects();
  $inactive_projects = ttGroupHelper::getInactiveProjects();
} else
  $active_projects = $user->getAssignedProjects();

$smarty->assign('active_projects', $active_projects);
$smarty->assign('inactive_projects', $inactive_projects);
$smarty->assign('title', $i18n->get('title.projects'));
$smarty->assign('content_page_name', 'mobile/projects.tpl');
$smarty->display('mobile/index.tpl');
