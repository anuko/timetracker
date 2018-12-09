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
import('ttGroupHelper');

// Access checks.
if (!(ttAccessAllowed('view_own_tasks') || ttAccessAllowed('manage_tasks'))) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
  header('Location: feature_disabled.php');
  exit();
}
if ($request->isPost() && !$user->isGroupValid($request->getParameter('group'))) {
  header('Location: access_denied.php'); // Wrong group id in post.
  exit();
}
// End of access checks.

if ($request->isPost()) {
  $group_id = $request->getParameter('group');
  $user->setOnBehalfGroup($group_id);
  // Tasks feature may not be available in new group, check and redirect.
  if (MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
    header('Location: feature_disabled.php');
    exit();
  }
} else {
  $group_id = $user->getGroup();
}

$form = new Form('tasksForm');
if ($user->can('manage_subgroups')) {
  $groups = $user->getGroupsForDropdown();
  if (count($groups) > 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'this.form.submit();',
      'name'=>'group',
      'style'=>'width: 250px;',
      'value'=>$group_id,
      'data'=>$groups,
      'datakeys'=>array('id','name')));
    $smarty->assign('group_dropdown', 1);
  }
}

if($user->can('manage_tasks')) {
  $active_tasks = ttGroupHelper::getActiveTasks();
  $inactive_tasks = ttTeamHelper::getInactiveTasks($group_id);
} else
  $active_tasks = $user->getAssignedTasks();

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('active_tasks', $active_tasks);
$smarty->assign('inactive_tasks', $inactive_tasks);
$smarty->assign('title', $i18n->get('title.tasks'));
$smarty->assign('content_page_name', 'tasks.tpl');
$smarty->display('index.tpl');
