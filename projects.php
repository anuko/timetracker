<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('ttGroupHelper');

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

$showFiles = $user->isPluginEnabled('at');

if($user->can('manage_projects')) {
  $active_projects = ttGroupHelper::getActiveProjects($showFiles);
  $inactive_projects = ttGroupHelper::getInactiveProjects($showFiles);
} else {
  $options['include_files'] = $showFiles;
  $active_projects = $user->getAssignedProjects($options);
}

$smarty->assign('active_projects', $active_projects);
$smarty->assign('inactive_projects', $inactive_projects);
$smarty->assign('show_files', $showFiles);
$smarty->assign('title', $i18n->get('title.projects'));
$smarty->assign('content_page_name', 'projects2.tpl');
$smarty->display('index2.tpl');
