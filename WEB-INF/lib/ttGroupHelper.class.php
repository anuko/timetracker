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

import('ttRoleHelper');

// Class ttGroupHelper - contains helper functions that operate with groups.
// This is a planned replacement for ttTeamHelper as we move forward with subgroups.
class ttGroupHelper {

  // The getGroupName function returns group name.
  static function getGroupName($group_id) {
    $mdb2 = getConnection();

    $sql = "select name from tt_groups where id = $group_id and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['name'];
    }
    return false;
  }

  // The getParentGroup determines a parent group for a given group.
  static function getParentGroup($group_id) {
    global $user;

    $mdb2 = getConnection();

    $sql = "select parent_id from tt_groups where id = $group_id and org_id = $user->org_id and status = 1";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['parent_id'];
    }
    return false;
  }

  // The getSubgroupByName obtain an immediate subgroup by name if one exists.
  static function getSubgroupByName($name) {
    global $user;

    $mdb2 = getConnection();
    $parent_id = $user->getActiveGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_groups where parent_id = $parent_id and org_id = $org_id".
      " and name = ".$mdb2->quote($name)." and status is not null";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val && $val['id'])
        return $val;
    }
    return false;
  }

  // The insertSubgroup inserts a new subgroup in database.
  static function insertSubgroup($fields) {
    global $user;

    $mdb2 = getConnection();
    $parent_id = $user->getActiveGroup();
    $org_id = $user->org_id;
    $name = $fields['name'];
    $description = $fields['description'];

    // We need to inherit other attributes from the parent group.
    $attrs = ttGroupHelper::getGroupAttrs($parent_id);

    $columns = '(parent_id, org_id, name, description, currency, decimal_mark, lang, date_format, time_format'.
      ', week_start, tracking_mode, project_required, task_required, record_type, bcc_email'.
      ', allow_ip, password_complexity, plugins, lock_spec'.
      ', workday_minutes, config, created, created_ip, created_by)';

    $values = " values ($parent_id, $org_id";
    $values .= ', '.$mdb2->quote($name);
    $values .= ', '.$mdb2->quote($description);
    $values .= ', '.$mdb2->quote($attrs['currency']);
    $values .= ', '.$mdb2->quote($attrs['decimal_mark']);
    $values .= ', '.$mdb2->quote($attrs['lang']);
    $values .= ', '.$mdb2->quote($attrs['date_format']);
    $values .= ', '.$mdb2->quote($attrs['time_format']);
    $values .= ', '.(int)$attrs['week_start'];
    $values .= ', '.(int)$attrs['tracking_mode'];
    $values .= ', '.(int)$attrs['project_required'];
    $values .= ', '.(int)$attrs['task_required'];
    $values .= ', '.(int)$attrs['record_type'];
    $values .= ', '.$mdb2->quote($attrs['bcc_email']);
    $values .= ', '.$mdb2->quote($attrs['allow_ip']);
    $values .= ', '.$mdb2->quote($attrs['password_complexity']);
    $values .= ', '.$mdb2->quote($attrs['plugins']);
    $values .= ', '.$mdb2->quote($attrs['lock_spec']);
    $values .= ', '.(int)$attrs['workday_minutes'];
    $values .= ', '.$mdb2->quote($attrs['config']);
    $values .= ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$mdb2->quote($user->id);
    $values .= ')';

    $sql = 'insert into tt_groups '.$columns.$values;
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    $subgroup_id = $mdb2->lastInsertID('tt_groups', 'id');

    // Copy roles from the parent group to child group.
    if (!ttRoleHelper::copyRolesToGroup($subgroup_id))
      return false;
    
    return $subgroup_id;
  }

  // markGroupDeleted marks a group and everything in it as deleted.
  // This function is called in context of a logged on user (global $user object).
  // It uses current user attributes for access checks and in sql queries.
  // Compare this with admin:
  //   admin can delete any group.
  //   user can delete only relevant groups and only if allowed.
  static function markGroupDeleted($group_id) {
    global $user;

    $mdb2 = getConnection();
    $org_id = $user->org_id;

    // Security check.
    if (!$user->isGroupValid($group_id))
      return false;

    // Keep the logic simple by returning false on first error.

    // Obtain subgroups and call self recursively on them.
    $subgroups = $user->getSubgroups($group_id);
    foreach($subgroups as $subgroup) {
      if (!$this->markGroupDeleted($subgroup['id']))
        return false;
    }

    // Now do actual work with all entities.

    // Some things cannot be marked deleted as we don't have the status field for them.
    // Just delete such things (until we have a better way to deal with them).
    $tables_to_delete_from = array(
      'tt_config',
      'tt_predefined_expenses',
      'tt_client_project_binds',
      'tt_project_task_binds'
    );
    foreach($tables_to_delete_from as $table) {
      if (!ttGroupHelper::deleteGroupEntriesFromTable($group_id, $table))
        return false;
    }

    // Now mark status deleted where we can.
    // Note: we don't mark tt_log, tt_custom_field_lod, or tt_expense_items deleted here.
    // Reasoning is:
    //
    // 1) Users may mark some of them deleted during their work.
    // If we mark all of them deleted here, we can't recover nicely
    // as we'll lose track of what was accidentally deleted by user.
    //
    // 2) DB maintenance script (Clean up DB from inactive groups) should
    // get rid of these items permanently eventually.
    $tables_to_mark_deleted_in = array(
      'tt_cron',
      'tt_fav_reports',
      // 'tt_expense_items',
      // 'tt_custom_field_log',
      'tt_custom_field_options',
      'tt_custom_fields',
      // 'tt_log',
      'tt_invoices',
      'tt_user_project_binds',
      'tt_users',
      'tt_clients',
      'tt_projects',
      'tt_tasks',
      'tt_roles'
    );
    foreach($tables_to_mark_deleted_in as $table) {
      if (!ttGroupHelper::markGroupDeletedInTable($group_id, $table))
        return false;
    }

    // Mark group deleted.
    $sql = "update tt_groups set status = null where id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // markGroupDeletedInTable is a generic helper function for markGroupDeleted.
  // It updates ONE table by setting status to NULL for all records belonging to a group.
  static function markGroupDeletedInTable($group_id, $table_name) {
    global $user;
    $mdb2 = getConnection();

    // TODO: add modified info to sql for some tables, depending on table name.

    $org_id = $user->org_id; // The only security measure we use here for match.
    $sql = "update $table_name set status = null where group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // deleteGroupEntriesFromTable is a generic helper function for markGroupDeleted.
  // It deletes entries in ONE table belonging to a given group.
  static function deleteGroupEntriesFromTable($group_id, $table_name) {
    global $user;
    $mdb2 = getConnection();

    $org_id = $user->org_id; // The only security measure we use here for match.
    $sql = "delete from $table_name where group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // getGroupAttrs obtains all group attributes.
  static function getGroupAttrs($group_id) {
    global $user;
    $mdb2 = getConnection();

    $sql =  "select * from tt_groups".
            " where status = 1 and id = $group_id and org_id = $user->org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
    }
    return $val;
  }

  // getRoles obtains all active and inactive roles in current group.
  static function getRoles() {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getActiveGroup();
    $org_id = $user->org_id;
    $sql =  "select * from tt_roles".
      " where group_id = $group_id and org_id = $org_id and status is not null";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;
    while ($val = $res->fetchRow()) {
      $roles[] = $val;
    }
    return $roles;
  }
}
