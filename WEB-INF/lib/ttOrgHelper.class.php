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

// Class ttOrgHelper contains helper functions that operate with organizations.
// Organizations are collections of nested groups of users.
class ttOrgHelper {

  // The getOrgs function returns an array of all active organizations on the server.
  static function getOrgs() {
    $result = array();
    $mdb2 = getConnection();

    $sql =  "select id, name, created, lang from tt_groups".
            " where status = 1 and org_id = id and parent_id is NULL order by id desc";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $val['date'] = substr($val['created'], 0, 10); // Strip the time.
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // The getName function returns organization name (which is a name of its top group).
  static function getName($org_id) {
    $mdb2 = getConnection();

    $sql = "select name from tt_groups where id = $org_id and (status = 1 or status = 0) and parent_id is NULL";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['name'];
    }
    return false;
  }

  // The getInactiveOrgs is a maintenance function that returns an array of inactive organization ids (max 5 for now).
  static function getInactiveOrgs() {
    $inactive_orgs = array();
    $mdb2 = getConnection();

    // Determine inactive organizations by querying the database for max access timestamp for its users.
    $cutoff_timestamp = $mdb2->quote(date('Y-m-d', strtotime('-1 year')));
    $sql = "select org_id from".
      " (select max(accessed) as last_access, org_id from tt_users where org_id > 0 group by org_id order by last_access, org_id) as t".
      " where last_access is null or last_access < $cutoff_timestamp limit 5"; // Max 5 orgs at a time for now...
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $inactive_orgs[] = $val['org_id'];
      }
      return $inactive_orgs;
    }
    return false;
  }

  // deleteOrg deletes data for the entire organization from database permanently.
  static function deleteOrg($org_id) {
    // Go one table at a time and remove all records with matching org_id.
    // The order is backwards to import (see ttOrgImportHelper). Remove groups last.
    // This leaves us with something partially working if an error occurs.
    $mdb2 = getConnection();

    $tables = array(
      'tt_config',
      'tt_cron',
      'tt_fav_reports',
      'tt_monthly_quotas',
      'tt_predefined_expenses',
      'tt_expense_items',
      'tt_custom_field_log',
      'tt_custom_field_options',
      'tt_custom_fields',
      'tt_log',
      'tt_timesheets', // TODO: check if order is correct. After doing export.
      'tt_invoices',
      'tt_user_project_binds',
      'tt_users',
      'tt_client_project_binds',
      'tt_clients',
      'tt_project_task_binds',
      'tt_projects',
      'tt_tasks',
      'tt_roles',
      'tt_groups'
    );
    foreach($tables as $table) {
      $sql = "delete from $table where org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;
    }
    return true;
  }
}
