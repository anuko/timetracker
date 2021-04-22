<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('ttRoleHelper');

// ttAdmin class is used to perform admin tasks.
// Used as namespace, as it is a collection of static functions that we call
// from admin pages to administer the site as a whole.
class ttAdmin {

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

    // Delete group files.
    ttAdmin::deleteGroupFiles($group_id);

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
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;
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
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

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
    $password_part = '';
    if ($fields['password1'])
      $password_part = ', password = md5('.$mdb2->quote($fields['password1']).')';
    $name_part = ', name = '.$mdb2->quote($fields['user_name']);
    $email_part = ', email = '.$mdb2->quote($fields['email']);
    $sql = 'update tt_users set '.$login_part.$password_part.$name_part.$email_part.$modified_part.' where id = '.$user_id;
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // updateSelf updates admin account with new information.
  static function updateSelf($fields) {
    global $user;
    $mdb2 = getConnection();

    // Update self.
    $user_id = $user->id;
    $login_part = 'login = '.$mdb2->quote($fields['login']);
    if ($fields['password1'])
      $password_part = ', password = md5('.$mdb2->quote($fields['password1']).')';
    $name_part = ', name = '.$mdb2->quote($fields['name']);
    $email_part = ', email = '.$mdb2->quote($fields['email']);
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;
    $sql = 'update tt_users set '.$login_part.$password_part.$name_part.$email_part.$modified_part.' where id = '.$user_id;
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
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
    $mdb2 = getConnection();

    // Note: current code works with properly set top manager (rank 512).
    // However, we now allow export and import of subgroups, which seems to work well.
    // In this situation, imported role is no longer "Top manager", and this call fails.
    // Setting role id manually in database for top user to Top manager resolves the issue.
    //
    // TODO: assess whether it is safe / reasonable to promote role during export or import.
    // The problem is that user having 'export_data' right is not necessarily top user.
    // And if we do it by rank, what to do for multiple managers situation? First found?
    // Leaving to manual fixing for now.
    $sql = "select g.name as group_name, u.id as manager_id, u.name as manager_name, u.login as manager_login, u.email as manager_email".
      " from tt_groups g".
      " inner join tt_users u on (u.group_id = g.id)".
      " inner join tt_roles r on (r.id = u.role_id and r.rank = 512)". // Fails for partially imported org. See comment above.
      " where g.id = $group_id";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val;
    }

    return false;
  }

 // getOrg obtains org_id for group.
  static function getOrg($group_id) {
    $mdb2 = getConnection();

    $sql = "select org_id from tt_groups where id = $group_id";
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
    $modified_part = '';
    if ($table_name == 'tt_users') {
      global $user;
      $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;
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

    $group_key = $mdb2->quote(ttRandomString());
    $name = $mdb2->quote($fields['group_name']);
    $currency = $mdb2->quote($fields['currency']);
    $lang = $mdb2->quote($fields['lang']);
    $created = 'now()';
    $created_ip = $mdb2->quote($_SERVER['REMOTE_ADDR']);
    $created_by = $user->id;

    $sql = "insert into tt_groups (group_key, name, currency, lang, created, created_ip, created_by)".
      " values($group_key, $name, $currency, $lang, $created, $created_ip, $created_by)";
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
    // There are 3 steps that we need to do when creating a new organization.
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

  // deleteGroupFiles deletes files attached to all entities in the entire group.
  // Note that it is a permanent delete, not "mark deleted" by design.
  static function deleteGroupFiles($group_id) {

    $org = ttAdmin::getOrg($group_id);
    $org_id = $org['org_id'];

    // Delete all group files from the database.
    $mdb2 = getConnection();
    $sql = "delete from tt_files where org_id = $org_id and group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    if ($affected == 0) return true; // Do not call file storage utility.

    // Try to make a call to file storage server.
    $storage_uri = defined('FILE_STORAGE_URI') ? FILE_STORAGE_URI : "https://www.anuko.com/files/";
    $deletegroupfiles_uri = $storage_uri.'deletegroupfiles';

    // Obtain site id.
    $sql = "select param_value as site_id from tt_site_config where param_name = 'locker_id'";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    $site_id = $val['site_id'];
    if (!$site_id) return true; // Nothing to do.

    // Obtain site key.
    $sql = "select param_value as site_key from tt_site_config where param_name = 'locker_key'";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    $site_key = $val['site_key'];
    if (!$site_key) return true; // Can't continue without site key.

    // Obtain org key.
    $sql = "select group_key as org_key from tt_groups where id = $org_id";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    $org_key = $val['org_key'];
    if (!$org_key) return true; // Can't continue without org key.

    // Obtain group key.
    $sql = "select group_key as group_key from tt_groups where id = $group_id";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    $group_key = $val['group_key'];
    if (!$group_key) return true; // Can't continue without group key.

    $curl_fields = array('site_id' => $site_id,
      'site_key' => $site_key,
      'org_id' => $org_id,
      'org_key' => $org_key,
      'group_id' => $group_id,
      'group_key' => $group_key);

    // url-ify the data for the POST.
    $fields_string = '';
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $deletegroupfiles_uri);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute a post request.
    $result = curl_exec($ch);

    // Close connection.
    curl_close($ch);

    // Many things can go wrong with a remote call to file storage facility.
    // By design, we ignore such errors.
    return true;
  }
}
