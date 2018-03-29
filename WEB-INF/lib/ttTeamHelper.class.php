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

import('ttUserHelper');
import('DateAndTime');
import('ttInvoiceHelper');

// Class ttTeamHelper - contains helper functions that operate with teams.
class ttTeamHelper {

  // The getUserCount function returns number of people in team.
  static function getUserCount($group_id) {
    $mdb2 = getConnection();

    $sql = "select count(id) as cnt from tt_users where group_id = $group_id and status = 1";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['cnt'];
    }
    return false;
  }

  // The getUsersForClient obtains all active and inactive users in a team that are relevant to a client.
  static function getUsersForClient() {
    global $user;
    $mdb2 = getConnection();

    $sql = "select u.id, u.name from tt_user_project_binds upb
      inner join tt_client_project_binds cpb on (upb.project_id = cpb.project_id and cpb.client_id = $user->client_id)
      inner join tt_users u on (u.id = upb.user_id)
      where (u.status = 1 or u.status = 0)
      group by u.id
      order by upper(u.name)";
    $res = $mdb2->query($sql);
    $user_list = array();
    if (is_a($res, 'PEAR_Error'))
      return false;
    while ($val = $res->fetchRow()) {
      $user_list[] = $val;
    }
    return $user_list;
  }

  // The getActiveUsers obtains all active users in a given team.
  static function getActiveUsers($options = null) {
    global $user;
    global $i18n;
    $mdb2 = getConnection();

    if (isset($options['getAllFields']))
      $sql = "select u.*, r.name as role_name, r.rank from tt_users u left join tt_roles r on (u.role_id = r.id) where u.group_id = $user->group_id and u.status = 1 order by upper(u.name)";
    else
      $sql = "select id, name from tt_users where group_id = $user->group_id and status = 1 order by upper(name)";
    $res = $mdb2->query($sql);
    $user_list = array();
    if (is_a($res, 'PEAR_Error'))
      return false;
    while ($val = $res->fetchRow()) {
      // Localize top manager role name, as it is not localized in db.
      if ($val['rank'] == 512)
        $val['role_name'] = $i18n->get('role.top_manager.label');
      $user_list[] = $val;
    }

    if (isset($options['putSelfFirst'])) {
      // Put own entry at the front.
      $cnt = count($user_list);
      for($i = 0; $i < $cnt; $i++) {
        if ($user_list[$i]['id'] == $user->id) {
          $self = $user_list[$i]; // Found self.
          array_unshift($user_list, $self); // Put own entry at the front.
          array_splice($user_list, $i+1, 1); // Remove duplicate.
        }
      }
    }
    return $user_list;
  }

  // The swapRolesWith swaps existing user role with that of another user.
  static function swapRolesWith($user_id) {
    global $user;
    $mdb2 = getConnection();

    // Obtain role id for the user we are swapping ourselves with.
    $sql = "select u.id, u.role_id from tt_users u left join tt_roles r on (u.role_id = r.id) where u.id = $user_id and u.group_id = $user->group_id and u.status = 1 and r.rank < $user->rank";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error'))
      return false;
    $val = $res->fetchRow();
    if (!$val['id'] || !$val['role_id'])
      return false;

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);

    // Promote user.
    $sql = "update tt_users set role_id = $user->role_id".$modified_part." where id = $user_id and group_id = $user->group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Demote self.
    $role_id = $val['role_id'];
    $sql = "update tt_users set role_id = $role_id".$modified_part." where id = $user->id and group_id = $user->group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // The getUsersForSwap obtains all users a current user can swap roles with.
  static function getUsersForSwap() {
    global $user;
    $mdb2 = getConnection();

    $sql = "select u.id, u.name, r.rank, r.rights from tt_users u left join tt_roles r on (u.role_id = r.id) where u.group_id = $user->group_id and u.status = 1 and r.rank < $user->rank order by upper(u.name)";
    $res = $mdb2->query($sql);
    $user_list = array();
    if (is_a($res, 'PEAR_Error'))
      return false;
    while ($val = $res->fetchRow()) {
      $isClient = in_array('track_own_time', explode(',', $val['rights'])) ? 0 : 1; // Clients do not have track_own_time right.
      if ($isClient)
        continue; // Skip adding clients.
      $user_list[] = $val;
    }

    return $user_list;
  }

    // The getUsers obtains all active and inactive (but not deleted) users in a given team.
  static function getUsers() {
    global $user;
    $mdb2 = getConnection();
    $sql = "select id, name from tt_users where group_id = $user->group_id and (status = 1 or status = 0) order by upper(name)";
    $res = $mdb2->query($sql);
    $user_list = array();
    if (is_a($res, 'PEAR_Error'))
      return false;
    while ($val = $res->fetchRow()) {
      $user_list[] = $val;
    }
    return $user_list;
  }

  // The getInactiveUsers obtains all inactive users in a given team.
  static function getInactiveUsers($group_id, $all_fields = false) {
    $mdb2 = getConnection();

    if ($all_fields)
      $sql = "select u.*, r.name as role_name from tt_users u left join tt_roles r on (u.role_id = r.id) where u.group_id = $group_id and u.status = 0 order by upper(u.name)";
    else
      $sql = "select id, name from tt_users where group_id = $group_id and status = 0 order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // The getAllUsers obtains all users in a given team.
  static function getAllUsers($group_id, $all_fields = false) {
    $mdb2 = getConnection();
    if ($all_fields)
      $sql = "select * from tt_users where group_id = $group_id order by upper(name)";
    else
      $sql = "select id, name from tt_users where group_id = $group_id order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getActiveProjects - returns an array of active projects for team.
  static function getActiveProjects($group_id)
  {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, description, tasks from tt_projects
      where group_id = $group_id and status = 1 order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getInactiveProjects - returns an array of inactive projects for team.
  static function getInactiveProjects($group_id)
  {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, description, tasks from tt_projects
      where group_id = $group_id and status = 0 order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getAllProjects obtains all projects in a given team.
  static function getAllProjects($group_id, $all_fields = false) {
    $mdb2 = getConnection();

    if ($all_fields)
      $sql = "select * from tt_projects where group_id = $group_id order by status, upper(name)";
    else
      $sql = "select id, name from tt_projects where group_id = $group_id order by status, upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getActiveTasks - returns an array of active tasks for team.
  static function getActiveTasks($group_id)
  {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, description from tt_tasks where group_id = $group_id and status = 1 order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getInactiveTasks - returns an array of inactive tasks for team.
  static function getInactiveTasks($group_id)
  {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, description from tt_tasks
      where group_id = $group_id and status = 0 order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getAllTasks obtains all tasks in a given team.
  static function getAllTasks($group_id, $all_fields = false) {
    $mdb2 = getConnection();

    if ($all_fields)
      $sql = "select * from tt_tasks where group_id = $group_id order by status, upper(name)";
    else
      $sql = "select id, name from tt_tasks where group_id = $group_id order by status, upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getActiveRolesForUser - returns an array of relevant active roles for user with rank less than self.
  // "Relevant" means that client roles are filtered out if Client plugin is disabled.
  static function getActiveRolesForUser()
  {
    global $user;
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, description, rank, rights from tt_roles where group_id = $user->group_id and rank < $user->rank and status = 1 order by rank";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $val['is_client'] = in_array('track_own_time', explode(',', $val['rights'])) ? 0 : 1; // Clients do not have data entry right.
        if ($val['is_client'] && !$user->isPluginEnabled('cl'))
          continue; // Skip adding a client role.
        $result[] = $val;
      }
    }
    return $result;
  }

  // getActiveRoles - returns an array of active roles for team.
  static function getActiveRoles($group_id)
  {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, description, rank, rights from tt_roles where group_id = $group_id and status = 1 order by rank";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $val['is_client'] = in_array('track_own_time', explode(',', $val['rights'])) ? 0 : 1; // Clients do not have data entry right.
        $result[] = $val;
      }
    }
    return $result;
  }

  // getInactiveRoles - returns an array of inactive roles for team.
  static function getInactiveRoles($group_id)
  {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, rank, description from tt_roles
      where group_id = $group_id and status = 0 order by rank";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getInactiveRolesForUser - returns an array of relevant active roles for user with rank less than self.
  // "Relevant" means that client roles are filtered out if Client plugin is disabled.
  static function getInactiveRolesForUser()
  {
    global $user;
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, description, rank, rights from tt_roles where group_id = $user->group_id and rank < $user->rank and status = 0 order by rank";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $val['is_client'] = in_array('track_own_time', explode(',', $val['rights'])) ? 0 : 1; // Clients do not have data entry right.
        if ($val['is_client'] && !$user->isPluginEnabled('cl'))
          continue; // Skip adding a client role.
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getActiveClients returns an array of active clients for team.
  static function getActiveClients($group_id, $all_fields = false)
  {
    $result = array();
    $mdb2 = getConnection();

    if ($all_fields)
      $sql = "select * from tt_clients where group_id = $group_id and status = 1 order by upper(name)";
    else
      $sql = "select id, name from tt_clients where group_id = $group_id and status = 1 order by upper(name)";

    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getInactiveClients returns an array of inactive clients for team.
  static function getInactiveClients($group_id, $all_fields = false)
  {
    $result = array();
    $mdb2 = getConnection();

    if ($all_fields)
      $sql = "select * from tt_clients where group_id = $group_id and status = 0 order by upper(name)";
    else
      $sql = "select id, name from tt_clients where group_id = $group_id and status = 0 order by upper(name)";

    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
      	$result[] = $val;
      }
    }
    return $result;
  }

  // The getAllClients obtains all clients in a given team.
  static function getAllClients($group_id, $all_fields = false) {
    $mdb2 = getConnection();

    if ($all_fields)
      $sql = "select * from tt_clients where group_id = $group_id order by status, upper(name)";
    else
      $sql = "select id, name from tt_clients where group_id = $group_id order by status, upper(name)";

    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // The getActiveInvoices returns an array of active invoices for team.
  static function getActiveInvoices($localizeDates = true)
  {
    global $user;
    $addPaidStatus = $user->isPluginEnabled('ps');

    $result = array();
    $mdb2 = getConnection();

    if ($user->isClient())
      $client_part = " and i.client_id = $user->client_id";

    $sql = "select i.id, i.name, i.date, i.client_id, i.status, c.name as client_name from tt_invoices i
      left join tt_clients c on (c.id = i.client_id)
      where i.status = 1 and i.group_id = $user->group_id $client_part order by i.name";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      $dt = new DateAndTime(DB_DATEFORMAT);
      while ($val = $res->fetchRow()) {
        if ($localizeDates) {
          $dt->parseVal($val['date']);
          $val['date'] = $dt->toString($user->date_format);
        }
        if ($addPaidStatus)
          $val['paid'] = ttInvoiceHelper::isPaid($val['id']);
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getAllInvoices returns an array of all invoices for team.
  static function getAllInvoices()
  {
    global $user;

    $result = array();
    $mdb2 = getConnection();

    $sql = "select * from tt_invoices where group_id = $user->group_id";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      $dt = new DateAndTime(DB_DATEFORMAT);
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getRecentInvoices returns an array of recent invoices (max 3) for a client.
  static function getRecentInvoices($group_id, $client_id)
  {
    global $user;

    $result = array();
    $mdb2 = getConnection();

    $sql = "select i.id, i.name from tt_invoices i
      left join tt_clients c on (c.id = i.client_id)
      where i.group_id = $group_id and i.status = 1 and c.id = $client_id
      order by i.id desc limit 3";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      $dt = new DateAndTime(DB_DATEFORMAT);
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getUserToProjectBinds - obtains all user to project binds for a team.
  static function getUserToProjectBinds($group_id) {
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_user_project_binds where user_id in (select id from tt_users where group_id = $group_id) order by user_id, status, project_id";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // The getAllCustomFields obtains all custom fields in a given team.
  static function getAllCustomFields($group_id) {
    $mdb2 = getConnection();

    $sql = "select * from tt_custom_fields where group_id = $group_id order by status";

    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // The getAllCustomFieldOptions obtains all custom field options in a given team.
  static function getAllCustomFieldOptions($group_id) {
    $mdb2 = getConnection();

    $sql = "select * from tt_custom_field_options where field_id in (select id from tt_custom_fields where group_id = $group_id) order by id";

    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // The getCustomFieldLog obtains all custom field log entries for a given team.
  static function getCustomFieldLog($group_id) {
    $mdb2 = getConnection();

    $sql = "select * from tt_custom_field_log where field_id in (select id from tt_custom_fields where group_id = $group_id) order by id";

    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getFavReports - obtains all favorite reports for all users in team.
  static function getFavReports($group_id) {
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_fav_reports where user_id in (select id from tt_users where group_id = $group_id)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getExpenseItems - obtains all expense items for all users in team.
  static function getExpenseItems($group_id) {
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_expense_items where user_id in (select id from tt_users where group_id = $group_id)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getPredefinedExpenses - obtains predefined expenses for team.
  static function getPredefinedExpenses($group_id) {
    global $user;
    $replaceDecimalMark = ('.' != $user->decimal_mark);

    $mdb2 = getConnection();

    $result = array();
    $sql = "select id, name, cost from tt_predefined_expenses where group_id = $group_id";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        if ($replaceDecimalMark)
          $val['cost'] = str_replace('.', $user->decimal_mark, $val['cost']);
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getNotifications - obtains notification descriptions for team.
  static function getNotifications($group_id) {
    $mdb2 = getConnection();

    $result = array();
    $sql = "select c.id, c.cron_spec, c.email, c.report_condition, fr.name from tt_cron c
      left join tt_fav_reports fr on (fr.id = c.report_id)
      where c.group_id = $group_id and c.status = 1 and fr.status = 1";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getMonthlyQuotas - obtains monthly quotas for team.
  static function getMonthlyQuotas($group_id) {
    $mdb2 = getConnection();

    $result = array();
    $sql = "select year, month, minutes from tt_monthly_quotas where group_id = $group_id";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // The markDeleted function marks the team and everything in it as deleted.
  static function markDeleted($group_id) {

    // Iterate through team users and mark them as deleted.
    $users = ttTeamHelper::getAllUsers($group_id);
    foreach ($users as $one_user) {
      if (!ttUserHelper::markDeleted($one_user['id'])) return false;
    }

    // Mark tasks deleted.
    if (!ttTeamHelper::markTasksDeleted($group_id)) return false;

    $mdb2 = getConnection();

    // Mark roles deleted.
    $sql = "update tt_roles set status = NULL where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark projects deleted.
    $sql = "update tt_projects set status = NULL where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark clients deleted.
    $sql = "update tt_clients set status = NULL where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark custom fields deleted.
    $sql = "update tt_custom_fields set status = NULL where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark group deleted.
    $sql = "update tt_groups set status = NULL where id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // The getTeamDetails function returns team details.
  static function getTeamDetails($group_id) {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select t.name as team_name, u.id as manager_id, u.name as manager_name, u.login as manager_login, u.email as manager_email
      from tt_groups t
      inner join tt_users u on (u.group_id = t.id)
      inner join tt_roles r on (r.id = u.role_id and r.rank = 512)
      where t.id = $group_id";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val;
    }

    return false;
  }

  // The insert function creates a new team.
  static function insert($fields) {

    global $user;
    $mdb2 = getConnection();

    // Start with team name and currency.
    $columns = 'name, currency';
    $values = $mdb2->quote(trim($fields['name'])).', '.$mdb2->quote(trim($fields['currency']));

    if ($fields['decimal_mark']) {
      $columns .= ', decimal_mark';
      $values .= ', '.$mdb2->quote($fields['decimal_mark']);
    }

    $lang = $fields['lang'];
    if (!$lang) {
      global $i18n;
      $lang = $i18n->lang;
    }
    $columns .= ', lang';
    $values .= ', '.$mdb2->quote($lang);

    if ($fields['date_format'] || defined('DATE_FORMAT_DEFAULT')) {
      $date_format = $fields['date_format'] ? $fields['date_format'] : DATE_FORMAT_DEFAULT;
      $columns .= ', date_format';
      $values .= ', '.$mdb2->quote($date_format);
    }

    if ($fields['time_format'] || defined('TIME_FORMAT_DEFAULT')) {
      $time_format = $fields['time_format'] ? $fields['time_format'] : TIME_FORMAT_DEFAULT;
      $columns .= ', time_format';
      $values .= ', '.$mdb2->quote($time_format);
    }

    if ($fields['week_start'] || defined('WEEK_START_DEFAULT')) {
      $week_start = $fields['week_start'] ? $fields['week_start'] : WEEK_START_DEFAULT;
      $columns .= ', week_start';
      $values .= ', '.(int)$week_start;
    }

    if ($fields['tracking_mode']) {
      $columns .= ', tracking_mode';
      $values .= ', '.(int)$fields['tracking_mode'];
    }

    if ($fields['project_required']) {
      $columns .= ', project_required';
      $values .= ', '.(int)$fields['project_required'];
    }

    if ($fields['task_required']) {
      $columns .= ', task_required';
      $values .= ', '.(int)$fields['task_required'];
    }

    if ($fields['record_type']) {
      $columns .= ', record_type';
      $values .= ', '.(int)$fields['record_type'];
    }

    if ($fields['bcc_email']) {
      $columns .= ', bcc_email';
      $values .= ', '.$mdb2->quote($fields['bcc_email']);
    }

    if ($fields['plugins']) {
      $columns .= ', plugins';
      $values .= ', '.$mdb2->quote($fields['plugins']);
    }

    if ($fields['lock_spec']) {
      $columns .= ', lock_spec';
      $values .= ', '.$mdb2->quote($fields['lock_spec']);
    }

    if ($fields['workday_minutes']) {
      $columns .= ', workday_minutes';
      $values .= ', '.(int)$fields['workday_minutes'];
    }

    if ($fields['config']) {
      $columns .= ', config';
      $values .= ', '.$mdb2->quote($fields['config']);
    }

    $columns .= ', created, created_ip, created_by';
    $values .= ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$mdb2->quote($user->id);

    $sql = "insert into tt_groups ($columns) values($values)";
    $affected = $mdb2->exec($sql);

    if (!is_a($affected, 'PEAR_Error')) {
      $group_id = $mdb2->lastInsertID('tt_groups', 'id');
      return $group_id;
    }

    return false;
  }

  // The update function updates team information.
  static function update($group_id, $fields)
  {
    global $user;
    $mdb2 = getConnection();
    $name_part = 'name = '.$mdb2->quote($fields['name']);
    $currency_part = '';
    $lang_part = '';
    $decimal_mark_part = '';
    $date_format_part = '';
    $time_format_part = '';
    $week_start_part = '';
    $tracking_mode_part = '';
    $task_required_part = ' , task_required = '.(int) $fields['task_required'];
    $record_type_part = '';
    $bcc_email_part = '';
    $plugins_part = '';
    $config_part = '';
    $lock_spec_part = '';
    $workday_minutes_part = '';

    if (isset($fields['currency'])) $currency_part = ', currency = '.$mdb2->quote($fields['currency']);
    if (isset($fields['lang'])) $lang_part = ', lang = '.$mdb2->quote($fields['lang']);
    if (isset($fields['decimal_mark'])) $decimal_mark_part = ', decimal_mark = '.$mdb2->quote($fields['decimal_mark']);
    if (isset($fields['date_format'])) $date_format_part = ', date_format = '.$mdb2->quote($fields['date_format']);
    if (isset($fields['time_format'])) $time_format_part = ', time_format = '.$mdb2->quote($fields['time_format']);
    if (isset($fields['week_start'])) $week_start_part = ', week_start = '.(int) $fields['week_start'];
    if (isset($fields['tracking_mode'])) $tracking_mode_part = ', tracking_mode = '.(int) $fields['tracking_mode'];
    if (isset($fields['record_type'])) $record_type_part = ', record_type = '.(int) $fields['record_type'];
    if (isset($fields['bcc_email'])) $bcc_email_part = ', bcc_email = '.$mdb2->quote($fields['bcc_email']);
    if (isset($fields['plugins'])) $plugins_part = ', plugins = '.$mdb2->quote($fields['plugins']);
    if (isset($fields['config'])) $config_part = ', config = '.$mdb2->quote($fields['config']);
    if (isset($fields['lock_spec'])) $lock_spec_part = ', lock_spec = '.$mdb2->quote($fields['lock_spec']);
    if (isset($fields['workday_minutes'])) $workday_minutes_part = ', workday_minutes = '.$mdb2->quote($fields['workday_minutes']);
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);

    $sql = "update tt_groups set $name_part $currency_part $lang_part $decimal_mark_part
      $date_format_part $time_format_part $week_start_part $tracking_mode_part $task_required_part $record_type_part
      $bcc_email_part $plugins_part $config_part $lock_spec_part $workday_minutes_part $modified_part where id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // The getInactiveTeams is a maintenance function that returns an array of inactive team ids (max 100).
  static function getInactiveTeams() {
    $inactive_teams = array();
    $mdb2 = getConnection();

    // Get all team ids for teams created or modified more than 8 months ago.
    // $ts = date('Y-m-d', strtotime('-1 year'));
    $ts = $mdb2->quote(date('Y-m-d', strtotime('-8 month')));
    $sql =  "select id from tt_groups where created < $ts and (modified is null or modified < $ts) order by id";
    $res = $mdb2->query($sql);

    $count = 0;
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $group_id = $val['id'];
        if (ttTeamHelper::isTeamActive($group_id) == false) {
          $count++;
          $inactive_teams[] = $group_id;
          // Limit the array size for perfomance by allowing this operation on small chunks only.
          if ($count >= 100) break;
        }
      }
      return $inactive_teams;
    }
    return false;
  }

  // The isTeamActive determines if a team is using Time Tracker or abandoned it.
  static function isTeamActive($group_id) {
    $users = array();

    $mdb2 = getConnection();
    $sql = "select id from tt_users where group_id = $group_id";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) die($res->getMessage());
    while ($val = $res->fetchRow()) {
      $users[] = $val['id'];
    }
    $user_list = implode(',', $users); // This is a comma-separated list of user ids.
    if (!$user_list)
      return false; // No users in team.

    $count = 0;
    $ts = date('Y-m-d', strtotime('-2 years'));
    $sql = "select count(*) as cnt from tt_log where user_id in ($user_list) and created > '$ts'";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if ($val = $res->fetchRow()) {
        $count = $val['cnt'];
      }
    }

    if ($count == 0)
      return false;  // No time entries for the last 2 years.

    if ($count <= 5) {
      // We will consider a team inactive if it has 5 or less time entries made more than 1 year ago.
      $count_last_year = 0;
      $ts = date('Y-m-d', strtotime('-1 year'));
      $sql = "select count(*) as cnt from tt_log where user_id in ($user_list) and created > '$ts'";
      $res = $mdb2->query($sql);
      if (!is_a($res, 'PEAR_Error')) {
        if ($val = $res->fetchRow()) {
          $count_last_year = $val['cnt'];
        }
        if ($count_last_year == 0)
          return false;  // No time entries for the last year and only a few entries before that.
      }
    }
    return true;
  }

  // The delete function permanently deletes all data for a team.
  static function delete($group_id) {
    $mdb2 = getConnection();

    // Delete users.
    $sql = "select id from tt_users where group_id = $group_id";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;
    while ($val = $res->fetchRow()) {
      $user_id = $val['id'];
      if (!ttUserHelper::delete($user_id)) return false;
    }

    // Delete tasks.
    if (!ttTeamHelper::deleteTasks($group_id)) return false;

    // Delete client to project binds.
    $sql = "delete from tt_client_project_binds where client_id in (select id from tt_clients where group_id = $group_id)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Delete projects.
    $sql = "delete from tt_projects where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Delete clients.
    $sql = "delete from tt_clients where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Delete invoices.
    $sql = "delete from tt_invoices where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Delete custom fields.
    if (!ttTeamHelper::deleteCustomFields($group_id)) return false;

    // Delete roles.
    $sql = "delete from tt_roles where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Delete group.
    $sql = "delete from tt_groups where id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // The markTasksDeleted deletes task binds and marks the tasks as deleted for a team.
  static function markTasksDeleted($group_id) {
    $mdb2 = getConnection();
    $sql = "select id from tt_tasks where group_id = $group_id";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;

    while ($val = $res->fetchRow()) {

      // Delete task binds.
      $task_id = $val['id'];
      $sql = "delete from tt_project_task_binds where task_id = $task_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;

      // Mark task as deleted.
      $sql = "update tt_tasks set status = NULL where id = $task_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;
    }

    return true;
  }

  // The deleteTasks deletes all tasks and task binds for an inactive team.
  static function deleteTasks($group_id) {
    $mdb2 = getConnection();
    $sql = "select id from tt_tasks where group_id = $group_id";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;

    while ($val = $res->fetchRow()) {

      // Delete task binds.
      $task_id = $val['id'];
      $sql = "delete from tt_project_task_binds where task_id = $task_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;

      // Delete task.
      $sql = "delete from tt_tasks where id = $task_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;
    }

    return true;
  }

  // The deleteCustomFields cleans up tt_custom_field_log, tt_custom_field_options and tt_custom_fields tables for an inactive team.
  static function deleteCustomFields($group_id) {
    $mdb2 = getConnection();
    $sql = "select id from tt_custom_fields where group_id = $group_id";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;

    while ($val = $res->fetchRow()) {
      $field_id = $val['id'];

      // Clean up tt_custom_field_log.
      $sql = "delete from tt_custom_field_log where field_id = $field_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;

      // Clean up tt_custom_field_options.
      $sql = "delete from tt_custom_field_options where field_id = $field_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;

      // Delete custom field.
      $sql = "delete from tt_custom_fields where id = $field_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;
    }

    return true;
  }

  // enablePlugin either enables or disables a specific plugin for team.
  static function enablePlugin($plugin, $enable = true)
  {
    global $user;
    if (!$user->can('manage_features'))
      return false;

    $plugin_array = explode(',', $user->plugins);
    if ($enable && !in_array($plugin, $plugin_array))
      $plugin_array[] = $plugin; // Add plugin to array.

    if (!$enable && in_array($plugin, $plugin_array)) {
      $key = array_search($plugin, $plugin_array);
      if ($key !== false)
        unset($plugin_array[$key]); // Remove plugin from array.
    }

    $plugins = implode(',', $plugin_array);
    if ($plugins != $user->plugins) {
      if (!ttTeamHelper::update($user->group_id, array('name' => $user->team,'plugins' => $plugins)))
        return false;
      $user->plugins = $plugins;
    }

    return true;
  }
}
