<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('ttRoleHelper');

// Class ttGroupHelper - contains helper functions that operate with groups.
// This is a planned replacement for ttTeamHelper as we move forward with subgroups.
class ttGroupHelper {

  // The getGroupName function returns group name.
  static function getGroupName($group_id) {
    global $user;
    $mdb2 = getConnection();

    $sql = "select name from tt_groups where id = $group_id and org_id = $user->org_id and (status = 1 or status = 0)";
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
    $parent_id = $user->getGroup();
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
    $parent_id = $user->getGroup();
    $org_id = $user->org_id;
    $group_key = ttRandomString();
    $name = $fields['name'];
    $description = $fields['description'];

    // We need to inherit attributes from the parent group.
    $attrs = ttGroupHelper::getGroupAttrs($parent_id);

    $columns = '(parent_id, org_id, group_key, name, description, currency, decimal_mark, lang, date_format,'.
      ' time_format, week_start, tracking_mode, project_required, record_type, bcc_email,'.
      ' allow_ip, password_complexity, plugins, lock_spec,'.
      ' workday_minutes, config, created, created_ip, created_by)';

    $values = " values ($parent_id, $org_id";
    $values .= ', '.$mdb2->quote($group_key);
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
    $values .= ', '.(int)$attrs['record_type'];
    $values .= ', '.$mdb2->quote($attrs['bcc_email']);
    $values .= ', '.$mdb2->quote($attrs['allow_ip']);
    $values .= ', '.$mdb2->quote($attrs['password_complexity']);
    $values .= ', '.$mdb2->quote($attrs['plugins']);
    $values .= ', '.$mdb2->quote($attrs['lock_spec']);
    $values .= ', '.(int)$attrs['workday_minutes'];
    $values .= ', '.$mdb2->quote($attrs['config']);
    $values .= ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$user->id;
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
    $subgroups = (array) $user->getSubgroups($group_id);
    foreach($subgroups as $subgroup) {
      if (!ttGroupHelper::markGroupDeleted($subgroup['id']))
        return false;
    }

    // Now do actual work with all entities.

    // Delete group files.
    ttGroupHelper::deleteGroupFiles($group_id);

    // Some things cannot be marked deleted as we don't have the status field for them.
    // Just delete such things (until we have a better way to deal with them).
    $tables_to_delete_from = array(
      'tt_config',
      'tt_predefined_expenses',
      'tt_client_project_binds',
      'tt_project_task_binds',
      'tt_project_template_binds'
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
    // as we'll lose track of what was deleted by users.
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
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;
    $sql = "update tt_groups set status = null $modified_part where id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // markGroupDeletedInTable is a generic helper function for markGroupDeleted.
  // It updates ONE table by setting status to NULL for all records belonging to a group.
  static function markGroupDeletedInTable($group_id, $table_name) {
    global $user;
    $mdb2 = getConnection();

    // Add modified info to sql for some tables, depending on table name.
    $modified_part = '';
    if ($table_name == 'tt_users') {
      $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;
    }

    $org_id = $user->org_id; // The only security measure we use here for match.
    $sql = "update $table_name set status = null $modified_part where group_id = $group_id and org_id = $org_id";
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

    $group_id = $user->getGroup();
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

  // The getActiveClients returns an array of active clients for a group.
  static function getActiveClients($all_fields = false)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;
    if ($all_fields)
      $sql = "select * from tt_clients where group_id = $group_id and org_id = $org_id and status = 1 order by upper(name)";
    else
      $sql = "select id, name from tt_clients where group_id = $group_id and org_id = $org_id and status = 1 order by upper(name)";

    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getInactiveClients returns an array of inactive clients for a group.
  static function getInactiveClients($all_fields = false)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;
    if ($all_fields)
      $sql = "select * from tt_clients where group_id = $group_id and org_id = $org_id and status = 0 order by upper(name)";
    else
      $sql = "select id, name from tt_clients where group_id = $group_id and org_id = $org_id and status = 0 order by upper(name)";

    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getActiveProjects - returns an array of active projects for a group.
  static function getActiveProjects($includeFiles = false)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $filePart = '';
    $fileJoin = '';
    if ($includeFiles) {
      $filePart = ', if(Sub1.entity_id is null, 0, 1) as has_files';
      $fileJoin =  " left join (select distinct entity_id from tt_files".
      " where entity_type = 'project' and group_id = $group_id and org_id = $org_id and status = 1) Sub1".
      " on (p.id = Sub1.entity_id)";
    }

    $sql = "select p.id, p.name, p.description, p.tasks $filePart from tt_projects p $fileJoin".
      " where p.group_id = $group_id and p.org_id = $org_id and p.status = 1 order by upper(p.name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getInactiveProjects - returns an array of inactive projects for a group.
  static function getInactiveProjects($includeFiles = false)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $filePart = '';
    $fileJoin = '';
    if ($includeFiles) {
      $filePart = ', if(Sub1.entity_id is null, 0, 1) as has_files';
      $fileJoin =  " left join (select distinct entity_id from tt_files".
      " where entity_type = 'project' and group_id = $group_id and org_id = $org_id and status = 1) Sub1".
      " on (p.id = Sub1.entity_id)";
    }

    $sql = "select p.id, p.name, p.description, p.tasks $filePart from tt_projects p $fileJoin".
      "  where p.group_id = $group_id and p.org_id = $org_id and p.status = 0 order by upper(p.name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getPredefinedExpenses - obtains predefined expenses for a group.
  static function getPredefinedExpenses() {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    $sql = "select id, name, cost from tt_predefined_expenses".
      " where group_id = $group_id and org_id = $org_id";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      $decimal_mark = $user->getDecimalMark();
      $replaceDecimalMark = ('.' != $decimal_mark);

      while ($val = $res->fetchRow()) {
        if ($replaceDecimalMark)
          $val['cost'] = str_replace('.', $decimal_mark, $val['cost']);
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // The getActiveInvoices returns an array of active invoices for a group.
  static function getActiveInvoices($sort_options = false)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $addPaidStatus = $user->isPluginEnabled('ps');
    $result = array();

    $client_part = '';
    if ($user->isClient())
      $client_part = "and i.client_id = $user->client_id";

    // Prepare order by part.
    $order_by_part = 'order  by ';
    if (!$sort_options)
      $order_by_part .= 'name';
    else {
      $order_by_part .= $sort_options['sort_option_1'];
      if ($sort_options['sort_order_1'] == 'descending') $order_by_part .= ' desc';

      if ($sort_options['sort_option_2']) {
        $order_by_part .= ', '.$sort_options['sort_option_2'];
        if ($sort_options['sort_order_2'] == 'descending') $order_by_part .= ' desc';
      }
    }

    $sql = "select i.id, i.name, i.date, i.client_id, i.status, c.name as client from tt_invoices i".
      " left join tt_clients c on (c.id = i.client_id)".
      " where i.status = 1 and i.group_id = $group_id and i.org_id = $org_id $client_part $order_by_part";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      $dt = new DateAndTime(DB_DATEFORMAT);
      while ($val = $res->fetchRow()) {
        // Localize date.
        $dt->parseVal($val['date']);
        $val['date'] = $dt->toString($user->getDateFormat());
        if ($addPaidStatus)
          $val['paid'] = ttInvoiceHelper::isPaid($val['id']);
        $result[] = $val;
      }
    }
    return $result;
  }

  // getNotifications - obtains notification descriptions for a group.
  static function getNotifications() {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    $sql = "select c.id, c.cron_spec, c.email, c.report_condition, fr.name from tt_cron c".
      " left join tt_fav_reports fr on (fr.id = c.report_id)".
      " where c.group_id = $group_id and c.org_id = $org_id and c.status = 1 and fr.status = 1";
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

  // The getActiveUsers obtains all active users excluding clients in a given group.
  static function getActiveUsers($options = null) {
    global $user;
    global $i18n;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $client_part = " and u.client_id is null";

    if (isset($options['getAllFields']))
      $sql = "select u.*, r.name as role_name, r.rank from tt_users u left join tt_roles r on (u.role_id = r.id) where u.group_id = $group_id and u.org_id = $org_id and u.status = 1 $client_part order by upper(u.name)";
    else
      $sql = "select u.id, u.name from tt_users u where u.group_id = $group_id and u.org_id = $org_id and u.status = 1 $client_part order by upper(u.name)";
    $res = $mdb2->query($sql);
    $user_list = array();
    if (is_a($res, 'PEAR_Error'))
      return false;
    while ($val = $res->fetchRow()) {
      // Localize top manager role name, as it is not localized in db.
      if (isset($val['rank']) && $val['rank'] == 512)
        $val['role_name'] = $i18n->get('role.top_manager.label');
      $user_list[] = $val;
    }

    return $user_list;
  }

  // getActiveTasks - returns an array of active tasks for a group.
  static function getActiveTasks()
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, name, description from tt_tasks".
      " where group_id = $group_id and org_id = $org_id and status = 1 order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getInactiveTasks - returns an array of inactive tasks for a group.
  static function getInactiveTasks()
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, name, description from tt_tasks".
      " where group_id = $group_id and org_id = $org_id and status = 0 order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getActiveTemplates - returns an array of active templates for a group.
  static function getActiveTemplates()
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, name, description, content from tt_templates".
      " where group_id = $group_id and org_id = $org_id and status = 1 order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getInactiveTemplates - returns an array of active templates for a group.
  static function getInactiveTemplates()
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, name, description from tt_templates".
      " where group_id = $group_id and org_id = $org_id and status = 0 order by upper(name)";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // validateCheckboxGroupInput - validates user input in a group of checkboxes
  // in context of a specific database table.
  //
  // We need to make sure that input is a set of unique positive integers, and is
  // "relevant" to the current group (entities exists in table).
  //
  // It is a safeguard against manipulation of data in posts.
  static function validateCheckboxGroupInput($input, $table) {
    // Empty input is valid.
    if (!$input) return true;

    // Input containing duplicates is invalid.
    if (count($input) !== count(array_unique($input))) return false;

    // Input containing anything but positive integers is invalid.
    foreach ($input as $single_selection) {
      if (!is_numeric($single_selection) || $single_selection <= 0) return false;
    }

    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Now check the table. It must contain all entities associated with current group and org.
    $comma_separated = implode(',', $input);
    $sql = "select count(*) as item_count from $table".
      " where id in ($comma_separated) and group_id = $group_id and org_id = $org_id and status = 1";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;
    $val = $res->fetchRow();
    if (count($input) != $val['item_count'])
      return false; // Number of entities in table is different.

    return true; // All is good.
  }

  // The getUsers obtains all active and inactive (but not deleted) users in a group.
  static function getUsers() {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, name from tt_users where group_id = $group_id and org_id = $org_id and (status = 1 or status = 0) order by upper(name)";
    $res = $mdb2->query($sql);
    $user_list = array();
    if (is_a($res, 'PEAR_Error'))
      return false;
    while ($val = $res->fetchRow()) {
      $user_list[] = $val;
    }
    return $user_list;
  }

  // The getUsersForClient obtains all active and inactive users in a group that are relevant to a client.
  static function getUsersForClient($options) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    if (isset($options['status']))
      $where_part = 'where u.status = '.(int)$options['status'];
    else
      $where_part = 'where u.status is not null';

    $sql = "select u.id, u.name from tt_user_project_binds upb".
      " inner join tt_client_project_binds cpb on (upb.project_id = cpb.project_id and cpb.client_id = $user->client_id)".
      " inner join tt_users u on (u.id = upb.user_id and u.group_id = $group_id and u.org_id = $org_id)".
      " $where_part group by u.id order by upper(u.name)";
    $res = $mdb2->query($sql);
    $user_list = array();
    if (is_a($res, 'PEAR_Error'))
      return false;
    while ($val = $res->fetchRow()) {
      $user_list[] = $val;
    }
    return $user_list;
  }

  // The getRecentInvoices returns an array of recent invoices (max 3) for a client.
  static function getRecentInvoices($client_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select i.id, i.name from tt_invoices i".
      " left join tt_clients c on (c.id = i.client_id)".
      " where i.group_id = $group_id and i.org_id = $org_id and i.status = 1 and c.id = $client_id".
      " order by i.id desc limit 3";
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

  // deleteGroupFiles deletes files attached to all entities in the entire group.
  // Note that it is a permanent delete, not "mark deleted" by design.
  static function deleteGroupFiles($group_id) {

    global $user;
    $org_id = $user->org_id;

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

  // updateEntitiesModified updates the entities_modified field in tt_groups table
  // with a current timestamp.
  static function updateEntitiesModified() {
    global $user;
    $org_id = $user->org_id;
    $group_id = $user->getGroup();
    $mdb2 = getConnection();

    $sql = "update tt_groups set entities_modified = now() where id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
}
