<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

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
// End of access checks.

if($user->can('manage_clients')) {
  $active_clients = ttGroupHelper::getActiveClients(true);
  $inactive_clients = ttGroupHelper::getInactiveClients(true);
} else
  $active_clients = $user->getAssignedClients();

$smarty->assign('active_clients', $active_clients);
$smarty->assign('inactive_clients', $inactive_clients);
$smarty->assign('title', $i18n->get('title.clients'));
$smarty->assign('content_page_name', 'clients.tpl');
$smarty->display('index.tpl');
