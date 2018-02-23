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
    $rights = $fields['rights'];
    $status = $fields['status'];

    $sql = "insert into tt_roles (team_id, name, rank, rights, status)
      values ($team_id, ".$mdb2->quote($name).", $rank, ".$mdb2->quote($rights).", ".$mdb2->quote($status).")";
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

  // createDefaultRoles - creates a set of predefined roles for the team to use.
  static function createDefaultRoles()
  {
    $mdb2 = getConnection();
    global $i18n;
    global $user;

    // Active roles.
    $name = $mdb2->quote($i18n->getKey('role.user.label'));
    $description = $mdb2->quote($i18n->getKey('role.user.description'));
    $rights = $mdb2->quote('data_entry,view_own_data,manage_own_settings,view_users');
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 4, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $name = $mdb2->quote($i18n->getKey('role.client.label'));
    $description = $mdb2->quote($i18n->getKey('role.client.description'));
    $rights = $mdb2->quote('data_entry,view_own_data,manage_own_settings,view_users');  // TODO: adjust rights.
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 16, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $name = $mdb2->quote($i18n->getKey('role.comanager.label'));
    $description = $mdb2->quote($i18n->getKey('role.comanager.description'));
    $rights = $mdb2->quote('data_entry,view_own_data,manage_own_settings,view_users');  // TODO: adjust rights.
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 68, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $name = $mdb2->quote($i18n->getKey('role.manager.label'));
    $description = $mdb2->quote($i18n->getKey('role.manager.description'));
    $rights = $mdb2->quote('data_entry,view_own_data,manage_own_settings,view_users');  // TODO: adjust rights.
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 324, $rights, 1)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Inactive roles.
    $name = $mdb2->quote($i18n->getKey('role.supervisor.label'));
    $description = $mdb2->quote($i18n->getKey('role.supervisor.description'));
    $rights = $mdb2->quote('data_entry,view_own_data,manage_own_settings,view_users'); // TODO: adjust rights.
    $sql = "insert into tt_roles (team_id, name, description, rank, rights, status) values($user->team_id, $name, $description, 12, $rights, 0)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }
}
