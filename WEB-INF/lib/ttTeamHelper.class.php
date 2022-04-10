<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('ttUserHelper');
import('ttInvoiceHelper');

// Class ttTeamHelper - contains helper functions that operate with groups.
class ttTeamHelper {

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

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

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

  // The getInactiveUsers obtains all inactive users in a group.
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

  // The getAllProjects obtains all projects in a group.
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

  // getActiveRolesForUser - returns an array of relevant active roles for user with rank less than self.
  // "Relevant" means that client roles are filtered out if Client plugin is disabled.
  static function getActiveRolesForUser()
  {
    global $user;
    $result = array();
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Determine max rank. If we are working in on behalf group
    // then rank restriction does not apply.
    $max_rank = $user->behalfGroup ? MAX_RANK : $user->rank;

    $sql = "select id, name, description, `rank`, rights from tt_roles where group_id = $group_id and org_id = $org_id and `rank` < $max_rank and status = 1 order by `rank`";
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

  // getActiveRoles - returns an array of active roles for a group.
  static function getActiveRoles($group_id)
  {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, description, `rank`, rights from tt_roles where group_id = $group_id and status = 1 order by `rank`";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $val['is_client'] = in_array('track_own_time', explode(',', $val['rights'])) ? 0 : 1; // Clients do not have track_own_time right.
        $result[] = $val;
      }
    }
    return $result;
  }

  // getInactiveRoles - returns an array of inactive roles for a group.
  static function getInactiveRoles($group_id)
  {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name, `rank`, description from tt_roles
      where group_id = $group_id and status = 0 order by `rank`";
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

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Determine max rank. If we are working in on behalf group
    // then rank restriction does not apply.
    $max_rank = $user->behalfGroup ? MAX_RANK : $user->rank;

    $sql = "select id, name, description, `rank`, rights from tt_roles where group_id = $group_id and org_id = $org_id and `rank` < $max_rank and status = 0 order by `rank`";
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

  // The getAllClients obtains all clients in a group.
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

  // The getAllInvoices returns an array of all invoices for a group.
  static function getAllInvoices()
  {
    global $user;

    $result = array();
    $mdb2 = getConnection();

    $sql = "select * from tt_invoices where group_id = $user->group_id";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getUserToProjectBinds - obtains all user to project binds for a group.
  static function getUserToProjectBinds($group_id) {
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_user_project_binds".
      " where user_id in (select id from tt_users where group_id = $group_id)".
      " and group_id = $group_id order by user_id, status, project_id";
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

  // The getAllCustomFields obtains all custom fields in a group.
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

  // The getAllCustomFieldOptions obtains all custom field options in a group.
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

  // getFavReports - obtains all favorite reports for all users in a group.
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

  // getMonthlyQuotas - obtains monthly quotas for a group.
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

  // The delete function permanently deletes all data for a group.
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

    // Delete cron entries.
    $sql = "delete from tt_cron where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Delete predefined expenses.
    $sql = "delete from tt_predefined_expenses where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Delete monthly quotas.
    $sql = "delete from tt_monthly_quotas where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Delete group.
    $sql = "delete from tt_groups where id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // The deleteTasks deletes all tasks and task binds for an inactive group.
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

  // The deleteCustomFields cleans up tt_custom_field_log, tt_custom_field_options and tt_custom_fields tables for an inactive group.
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
}
