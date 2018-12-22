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
import('ttGroupHelper');
import('ttTimeHelper');

// Access checks.
if (!(ttAccessAllowed('view_users') || ttAccessAllowed('manage_users'))) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Prepare a list of active users.
$rank = $user->getMaxRankForGroup($user->getGroup());
if ($user->can('view_users'))
  $options = array('status'=>ACTIVE,'include_clients'=>true,'include_login'=>true,'include_role'=>true);
else /* if ($user->can('manage_users')) */
  $options = array('status'=>ACTIVE,'max_rank'=>$rank,'include_clients'=>true,'include_self'=>true,'include_login'=>true,'include_role'=>true);
$active_users = $user->getUsers($options);

// Prepare a list of inactive users.
if($user->can('manage_users')) {
  $options = array('status'=>INACTIVE,'max_rank'=>$rank,'include_clients'=>true,'include_login'=>true,'include_role'=>true);
  $inactive_users = $user->getUsers($options);
}

$uncompleted_indicators = $user->getConfigOption('uncompleted_indicators');
if ($uncompleted_indicators) {
  // Check each active user if they have an uncompleted time entry.
  foreach ($active_users as $key => $active_user) {
    $active_users[$key]['has_uncompleted_entry'] = (bool) ttTimeHelper::getUncompleted($active_user['id']);
  }
  $smarty->assign('uncompleted_indicators', true);
}

$smarty->assign('active_users', $active_users);
$smarty->assign('inactive_users', $inactive_users);
$smarty->assign('can_delete_manager', $can_delete_manager);
$smarty->assign('title', $i18n->get('title.users'));
$smarty->assign('content_page_name', 'mobile/users.tpl');
$smarty->display('mobile/index.tpl');
