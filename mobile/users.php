<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('../initialize.php');
import('form.Form');
import('ttTeamHelper');
import('ttGroupHelper');
import('ttTimeHelper');

// Mobile pages are no longer separate. Redirect to main page.
header('Location: ../users.php');
exit();
// Below is no longer used code.

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
