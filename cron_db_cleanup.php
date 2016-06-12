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

/*
 * cron_db_cleanup.php - this file is an entry point to execute a database cleanup job in Time Tracker.
 * It must be called externally (for example, from the system cron or task scheduler).
 */

require_once('initialize.php');
import('ttTeamHelper');


$inactive_teams = ttTeamHelper::getInactiveTeams();
$count = count($inactive_teams);
print "$count inactive teams found...<br>\n";
for ($i = 0; $i < $count; $i++) {
  print "  deleting team ".$inactive_teams[$i]."<br>\n";
  $res = ttTeamHelper::delete($inactive_teams[$i]);
}

if ($count > 0) {
  $mdb2 = getConnection();
  $mdb2->exec("OPTIMIZE TABLE tt_client_project_binds");
  $mdb2->exec("OPTIMIZE TABLE tt_client_project_binds");
  $mdb2->exec("OPTIMIZE TABLE tt_clients");
  $mdb2->exec("OPTIMIZE TABLE tt_config");
  $mdb2->exec("OPTIMIZE TABLE tt_custom_field_log");
  $mdb2->exec("OPTIMIZE TABLE tt_custom_field_options");
  $mdb2->exec("OPTIMIZE TABLE tt_custom_fields");
  $mdb2->exec("OPTIMIZE TABLE tt_expense_items");
  $mdb2->exec("OPTIMIZE TABLE tt_fav_reports");
  $mdb2->exec("OPTIMIZE TABLE tt_invoices");
  $mdb2->exec("OPTIMIZE TABLE tt_log");
  $mdb2->exec("OPTIMIZE TABLE tt_project_task_binds");
  $mdb2->exec("OPTIMIZE TABLE tt_projects");
  $mdb2->exec("OPTIMIZE TABLE tt_tasks");
  $mdb2->exec("OPTIMIZE TABLE tt_teams");
  $mdb2->exec("OPTIMIZE TABLE tt_tmp_refs");
  $mdb2->exec("OPTIMIZE TABLE tt_user_project_binds");
  $mdb2->exec("OPTIMIZE TABLE tt_users");
}

print "Done!<br>\n";
