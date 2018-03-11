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

// The ttRoleHelper is a class to help with custom group roles.
class ttRoleHelper {

  // get - gets details of a role identified by its id.
  static function get($id)
  {
    global $user;

    $mdb2 = getConnection();

    $sql = "select id, name, description, rank, rights, status from tt_roles
      where id = $id and team_id = $user->team_id and (status = 0 or status = 1)";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
	  if ($val['id'] != '') {
        return $val;
      } else
        return false;
    }
    return false;
  }

  // The getRoleByName looks up a role by name.
  static function getRoleByName($role_name) {

    $mdb2 = getConnection();
    global $user;

    $sql = "select id from tt_roles where team_id = $user->team_id and name = ".
      $mdb2->quote($role_name)." and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['id'])
        return $val;
    }
    return false;
  }

  // The getTopManagerRoleID obtains an ID for top manager role.
  static function getTopManagerRoleID() {
    $mdb2 = getConnection();

    $sql = "select id from tt_roles where team_id = 0 and rank = 512";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['id'])
        return $val['id'];
    }
    return false;
  }

  // The getLegacyRole obtains a legacy role value for a role_id.
  // This is a temporary function to allow usage of both old and new roles
  // while new role code is being written and deployed.
  static function getLegacyRole($role_id) {
    global $user;
    $mdb2 = getConnection();

    $sql = "select rank from tt_roles where team_id = $user->team_id and id = $role_id";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['rank']) {
        $rank = $val['rank'];
        if ($rank >= ROLE_MANAGER)
          return ROLE_MANAGER;
        else if ($rank >= ROLE_COMANAGER)
          return ROLE_COMANAGER;
        else if ($rank >= ROLE_CLIENT)
          return ROLE_CLIENT;
        else
          return ROLE_USER;
      }
    }
    return false;
  }

  // isClientRole determines if the role is a "client" role.
  // This simply means the role has no "data_entry" right.
  static function isClientRole($role_id) {
    global $user;
    $mdb2 = getConnection();

    $sql = "select rights from tt_roles where team_id = $user->team_id and id = $role_id";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['rights']) {
        return !in_array('data_entry', explode(',', $val['rights']));
      }
    }
    return false;
  }

  // getRoleByRank looks up a role by its rank.
  static function getRoleByRank($rank) {
    global $user;
    $mdb2 = getConnection();

    $rank = (int) $rank; // Cast to int just in case for better security.

    $sql = "select id from tt_roles where team_id = $user->team_id and rank = $rank and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['id'])
        return $val;
    }
    return false;
  }

  // update function updates a role in the database.
  static function update($fields) {
    global $user;
    $mdb2 = getConnection();

    $id = (int)$fields['id'];
    if (isset($fields['name'])) $name_part = 'name = '.$mdb2->quote($fields['name']);
    if (isset($fields['description'])) $descr_part = ', description = '.$mdb2->quote($fields['description']);
    if (isset($fields['status'])) $status_part = ', status = '.(int)$fields['status'];
    if (isset($fields['rights'])) $rights_part = ', rights = '.$mdb2->quote($fields['rights']);
    $parts = trim($name_part.$descr_part.$status_part.$rights_part, ',');
    $sql = "update tt_roles set $parts where id = $id and team_id = $user->team_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // delete - marks the role as deleted.
  static function delete($role_id) {
    global $user;

    $mdb2 = getConnection();

    // Mark the task as deleted.
    $sql = "update tt_roles set status = NULL where id = $role_id and team_id = $user->team_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // insert - inserts an entry into tt_roles table.
  static function insert($fields)
  {
    $mdb2 = getConnection();

    $team_id = (int) $fields['team_id'];
    $name = $fields['name'];
    $rank = (int) $fields['rank'];
    $description = $fields['description'];
    $rights = $fields['rights'];
    $status = $fields['status'];

    $sql = "insert into tt_roles (team_id, name, rank, description, rights, status)
      values ($team_id, ".$mdb2->quote($name).", $rank, ".$mdb2->quote($description).", ".$mdb2->quote($rights).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // rolesExist - checks whether roles for team already exist.
  static function rolesExist()
  {
    $mdb2 = getConnection();
    global $user;

    $sql = "select count(*) as count from tt_roles where team_id = $user->team_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['count'] > 0)
        return true; // Roles for team exist.
    }
    return false;
  }

  // createPredefinedRoles - creates a set of predefined roles for the team to use.
  static function createPredefinedRoles($team_id, $lang)
  {
    // We need localized role names and a new I18n object to obtain them.
    import('I18n');
    $i18n = new I18n();
    $i18n->load($lang);

    $mdb2 = getConnection();

    $rights_client = 'view_own_data,manage_own_settings';
    $rights_user = 'data_entry,view_own_data,manage_own_settings,view_users';
    $rights_supervisor = $rights_user.',on_behalf_data_entry,view_data,override_punch_mode,swap_roles,approve_timesheets';
    $rights_comanager = $rights_supervisor.',manage_users,manage_projects,manage_tasks,manage_custom_fields,manage_clients,manage_invoices';
    $rights_manager = $rights_comanager.',manage_features,manage_basic_settings,manage_advanced_settings,manage_roles,export_data,manage_subgroups';

    // Active roles.
    $name = $mdb2->quote($i18n->getKey('role.user.label'));
    $description = $mdb2->quote($i18n->getKey('role.user.description'));
    $rights = $mdb2->quote($rights_user);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($team_id, $name, $description, 4, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $name = $mdb2->quote($i18n->getKey('role.client.label'));
    $description = $mdb2->quote($i18n->getKey('role.client.description'));
    $rights = $mdb2->quote($rights_client);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($team_id, $name, $description, 16, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $name = $mdb2->quote($i18n->getKey('role.comanager.label'));
    $description = $mdb2->quote($i18n->getKey('role.comanager.description'));
    $rights = $mdb2->quote($rights_comanager);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($team_id, $name, $description, 68, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $name = $mdb2->quote($i18n->getKey('role.manager.label'));
    $description = $mdb2->quote($i18n->getKey('role.manager.description'));
    $rights = $mdb2->quote($rights_manager);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($team_id, $name, $description, 324, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Inactive roles.
    $name = $mdb2->quote($i18n->getKey('role.supervisor.label'));
    $description = $mdb2->quote($i18n->getKey('role.supervisor.description'));
    $rights = $mdb2->quote($rights_supervisor);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($team_id, $name, $description, 12, $rights, 0)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // createDefaultRoles - creates a set of predefined roles for the team to use.
  static function createDefaultRoles()
  {
    $mdb2 = getConnection();
    global $i18n;
    global $user;

    $rights_client = 'view_own_data,manage_own_settings';
    $rights_user = 'data_entry,view_own_data,manage_own_settings,view_users';
    $rights_supervisor = $rights_user.',on_behalf_data_entry,view_data,override_punch_mode,swap_roles,approve_timesheets';
    $rights_comanager = $rights_supervisor.',manage_users,manage_projects,manage_tasks,manage_custom_fields,manage_clients,manage_invoices';
    $rights_manager = $rights_comanager.',manage_features,manage_basic_settings,manage_advanced_settings,manage_roles,export_data,manage_subgroups';

    // Active roles.
    $name = $mdb2->quote($i18n->getKey('role.user.label'));
    $description = $mdb2->quote($i18n->getKey('role.user.description'));
    $rights = $mdb2->quote($rights_user);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 4, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $name = $mdb2->quote($i18n->getKey('role.client.label'));
    $description = $mdb2->quote($i18n->getKey('role.client.description'));
    $rights = $mdb2->quote($rights_client);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 16, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $name = $mdb2->quote($i18n->getKey('role.comanager.label'));
    $description = $mdb2->quote($i18n->getKey('role.comanager.description'));
    $rights = $mdb2->quote($rights_comanager);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 68, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $name = $mdb2->quote($i18n->getKey('role.manager.label'));
    $description = $mdb2->quote($i18n->getKey('role.manager.description'));
    $rights = $mdb2->quote($rights_manager);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 324, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Inactive roles.
    $name = $mdb2->quote($i18n->getKey('role.supervisor.label'));
    $description = $mdb2->quote($i18n->getKey('role.supervisor.description'));
    $rights = $mdb2->quote($rights_supervisor);
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 12, $rights, 0)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }
}
