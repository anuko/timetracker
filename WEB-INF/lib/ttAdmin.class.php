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

import('ttUser');
import('ttRoleHelper');

// ttAdmin class is used to perform admin tasks.
class ttAdmin {

  var $err = null; // Error object, passed to us as reference.
                   // We use it to communicate errors to caller.

  // Constructor.
  function __construct(&$err = null) {
    $this->err = $err;
  }

  // getSubgroups rerurns an array of subgroups for a group.
  static function getSubgroups($group_id) {
    $mdb2 = getConnection();

    $subgroups = array();
    $sql =  "select id from tt_groups where parent_id = $group_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $subgroups[] = $val;
      }
    }
    return $subgroups;
  }

  // markGroupDeleted marks a group and everything in it as deleted.
  // This function is called in context of a logged on admin who may
  // operate on any group.
  static function markGroupDeleted($group_id) {
    $mdb2 = getConnection();

    // Keep the logic simple by returning false on first error.

    // Obtain subgroups and call self recursively on them.
    $subgroups = ttAdmin::getSubgroups($group_id);
    foreach($subgroups as $subgroup) {
      if (!ttAdmin::markGroupDeleted($subgroup['id']))
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
      if (!ttAdmin::deleteGroupEntriesFromTable($group_id, $table))
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
      if (!ttAdmin::markGroupDeletedInTable($group_id, $table))
        return false;
    }

    // Mark group deleted.
    global $user;
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);
    $sql = "update tt_groups set status = null $modified_part where id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // updateGroup updates a (top) group with new information.
  static function updateGroup($fields) {
    $group_id = (int)$fields['group_id'];
    if (!$group_id) return false; // Nothing to update.

    $mdb2 = getConnection();
    global $user;
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);

    // Update group name if it changed.
    if ($fields['old_group_name'] != $fields['new_group_name']) {
      $name_part = 'name = '.$mdb2->quote($fields['new_group_name']);
      $sql = 'update tt_groups set '.$name_part.$modified_part.' where id = '.$group_id;
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;
    }

    // Update group manager.
    $user_id = $fields['user_id'];
    $login_part = 'login = '.$mdb2->quote($fields['new_login']);
    if ($fields['password1'])
      $password_part = ', password = md5('.$mdb2->quote($fields['password1']).')';
    $name_part = ', name = '.$mdb2->quote($fields['user_name']);
    $email_part = ', email = '.$mdb2->quote($fields['email']);
    $sql = 'update tt_users set '.$login_part.$password_part.$name_part.$email_part.$modified_part.'where id = '.$user_id;
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // validateUserInfo validates account information entered by user.
  function validateUserInfo($fields) {
    global $i18n;
    global $user;
    global $auth;

    $result = true;

    if (!ttValidString($fields['name'])) {
      $this->err->add($i18n->get('error.field'), $i18n->get('label.person_name'));
      $result = false;
    }
    if (!ttValidString($fields['login'])) {
      $this->err->add($i18n->get('error.field'), $i18n->get('label.login'));
      $result = false;
    }
    // If we change login, it must be unique.
    if ($fields['login'] != $user->login) {
      if (ttUserHelper::getUserByLogin($fields['login'])) {
        $this->err->add($i18n->get('error.user_exists'));
        $result = false;
      }
    }
    if (!$auth->isPasswordExternal() && ($fields['password1'] || $fields['password2'])) {
      if (!ttValidString($fields['password1'])) {
        $this->err->add($i18n->get('error.field'), $i18n->get('label.password'));
        $result = false;
      }
      if (!ttValidString($fields['password2'])) {
        $this->err->add($i18n->get('error.field'), $i18n->get('label.confirm_password'));
        $result = false;
      }
      if ($fields['password1'] !== $fields['password2']) {
        $this->err->add($i18n->get('error.not_equal'), $i18n->get('label.password'), $i18n->get('label.confirm_password'));
        $result = false;
      }
    }
    if (!ttValidEmail($fields['email'], true)) {
      $this->err->add($i18n->get('error.field'), $i18n->get('label.email'));
      $result = false;
    }

    return $result;
  }

  // updateSelf validates user input and updates admin account with new information.
  function updateSelf($fields) {
    if (!$this->validateUserInfo($fields)) return false; // Can't continue as user input is invalid.

    global $user;
    global $i18n;
    $mdb2 = getConnection();

    // Update self.
    $user_id = $user->id;
    $login_part = 'login = '.$mdb2->quote($fields['login']);
    if ($fields['password1'])
      $password_part = ', password = md5('.$mdb2->quote($fields['password1']).')';
    $name_part = ', name = '.$mdb2->quote($fields['name']);
    $email_part = ', email = '.$mdb2->quote($fields['email']);
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);
    $sql = 'update tt_users set '.$login_part.$password_part.$name_part.$email_part.$modified_part.'where id = '.$user_id;
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) {
      $this->err->add($i18n->get('error.db'));
      return false;
    }

    return true;
  }

  // getGroupName obtains group name.
  static function getGroupName($group_id) {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select name from tt_groups where id = $group_id";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['name'];
    }

    return false;
  }

  // getOrgDetails obtains group name and its top manager details.
  static function getOrgDetails($group_id) {
    $result = array();
    $mdb2 = getConnection();

    $sql = "select g.name as group_name, u.id as manager_id, u.name as manager_name, u.login as manager_login, u.email as manager_email".
      " from tt_groups g".
      " inner join tt_users u on (u.group_id = g.id)".
      " inner join tt_roles r on (r.id = u.role_id and r.rank = 512)".
      " where g.id = $group_id";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val;
    }

    return false;
  }

  // deleteGroupEntriesFromTable is a generic helper function for markGroupDeleted.
  // It deletes entries in ONE table belonging to a given group.
  static function deleteGroupEntriesFromTable($group_id, $table_name) {
    $mdb2 = getConnection();

    $sql = "delete from $table_name where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // markGroupDeletedInTable is a generic helper function for markGroupDeleted.
  // It updates ONE table by setting status to NULL for all records belonging to a group.
  static function markGroupDeletedInTable($group_id, $table_name) {
    $mdb2 = getConnection();

    // Add modified info to sql for some tables, depending on table name.
    if ($table_name == 'tt_users') {
      global $user;
      $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);
    }

    $sql = "update $table_name set status = null $modified_part where group_id = $group_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // createGroup creates a new top group and returns its id.
  // It is a helper function for createOrg.
  static function createGroup($fields) {
    global $user;
    $mdb2 = getConnection();

    $name = $mdb2->quote($fields['group_name']);
    $currency = $mdb2->quote($fields['currency']);
    $lang = $mdb2->quote($fields['lang']);
    $created = 'now()';
    $created_ip = $mdb2->quote($_SERVER['REMOTE_ADDR']);
    $created_by = $user->id;

    $sql = "insert into tt_groups (name, currency, lang, created, created_ip, created_by)".
      " values($name, $currency, $lang, $created, $created_ip, $created_by)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    $group_id = $mdb2->lastInsertID('tt_groups', 'id');

    // Update org_id with group_id.
    $sql = "update tt_groups set org_id = $group_id where org_id is NULL and id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return $group_id;
  }

  // createOrgManager creates a new user (top manager role) in a group.
  // It is a helper function for createOrg.
  static function createOrgManager($fields) {
    global $user;
    $mdb2 = getConnection();

    $role_id = ttRoleHelper::getTopManagerRoleID();
    $login = $mdb2->quote($fields['login']);
    $password = 'md5('.$mdb2->quote($fields['password']).')';
    $name = $mdb2->quote($fields['user_name']);
    $group_id = (int) $fields['group_id'];
    $org_id = $group_id;
    $email = $mdb2->quote($fields['email']);
    $created = 'now()';
    $created_ip = $mdb2->quote($_SERVER['REMOTE_ADDR']);
    $created_by = $user->id;

    $columns = '(login, password, name, group_id, org_id, role_id, email, created, created_ip, created_by)';
    $values = "values($login, $password, $name, $group_id, $org_id, $role_id, $email, $created, $created_ip, $created_by)";

    $sql = "insert into tt_users $columns $values";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // The createOrg function creates an organization in Time Tracker.
  static function createOrg($fields) {
    // There are 3 steps that we need to 2 when creating a new organization.
    //   1. Create a new group with null parent_id.
    //   2. Create pre-defined roles in it.
    //   3. Create a top manager account for new group.

    // Create a new group.
    $group_id = ttAdmin::createGroup($fields);
    if (!$group_id) return false;

    // Create predefined roles.
    if (!ttRoleHelper::createPredefinedRoles($group_id, $fields['lang']))
      return false;

    // Create user.
    $fields['group_id'] = $group_id;
    if (!ttAdmin::createOrgManager($fields))
      return false;

    return true;
  }
}
