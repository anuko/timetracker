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
if (!(ttAccessAllowed('view_own_clients') || ttAccessAllowed('manage_clients'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('cl')) {
  header('Location: feature_disabled.php');
  exit();
}
if ($request->isPost()) {
  $groupChanged = $request->getParameter('group_changed'); // Reused in multiple places below.
  if ($groupChanged && !($user->can('manage_subgroups') && $user->isGroupValid($request->getParameter('group')))) {
    header('Location: access_denied.php'); // Group changed, but no rght or wrong group id.
    exit();
  }
}

// Determine group for which we display this page.
if ($request->isPost() && $groupChanged) {
  $group_id = $request->getParameter('group');
  $user->setOnBehalfGroup($group_id);
} else {
  $group_id = $user->getGroup();
}

$form = new Form('clientsForm');
if ($user->can('manage_subgroups')) {
  $groups = $user->getGroupsForDropdown();
  if (count($groups) > 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'document.clientsForm.group_changed.value=1;document.clientsForm.submit();',
      'name'=>'group',
      'style'=>'width: 250px;',
      'value'=>$group_id,
      'data'=>$groups,
      'datakeys'=>array('id','name')));
    $form->addInput(array('type'=>'hidden','name'=>'group_changed'));
    $smarty->assign('group_dropdown', 1);
  }
}

if($user->can('manage_clients')) {
  $active_clients = ttGroupHelper::getActiveClients(true);
  $inactive_clients = ttGroupHelper::getInactiveClients(true);
} else
  $active_clients = $user->getAssignedClients();

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('active_clients', $active_clients);
$smarty->assign('inactive_clients', $inactive_clients);
$smarty->assign('title', $i18n->get('title.clients'));
$smarty->assign('content_page_name', 'clients.tpl');
$smarty->display('index.tpl');
