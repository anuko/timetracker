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

// ttAdmin class is used to perform admin tasks.
class ttAdmin {

  var $err = null;        // Error object, passed to us as reference.
                          // We use it to communicate errors to caller.

  // Constructor.
  function __construct(&$err = null) {
    $this->err = $err;
  }

  // getSubgroups rerurns an array of subgroups for a group.
  function getSubgroups($group_id) {
    return array(); // TODO: not yet implemented.
  }

  // getUsers obtains user ids in a group.
  function getUsers($group_id) {
    $mdb2 = getConnection();
    $sql = "select id from tt_users where team_id = $group_id";
    $res = $mdb2->query($sql);
    $users = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $users[] = $val;
      }
    }
    return $users;
  }

  // markUserDeleted marks a user and all things associated with user as deleted.
  function markUserDeleted($user_id) {
    $mdb2 = getConnection();

    // Mark user binds as deleted.
    $sql = "update tt_user_project_binds set status = NULL where user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Mark favorite reports as deleted.
    $sql = "update tt_fav_reports set status = NULL where user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Mark user as deleted.
    global $user;
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);
    $sql = "update tt_users set status = NULL $modified_part where id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // The markTasksDeleted deletes task binds and marks the tasks as deleted for a group.
  function markTasksDeleted($group_id) {
    $mdb2 = getConnection();
    $sql = "select id from tt_tasks where team_id = $group_id";
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

  // markGroupDeleted marks the group and everything in it as deleted.
  function markGroupDeleted($group_id) {

    // Keep the logic simple by returning false on first error.

    // Obtain subgroups and call self recursively on them.
    $subgroups = $this->getSubgroups();
    foreach($subgroups as $subgroup) {
      if (!$this->markGroupDeleted($subgroup['id']))
        return false;
    }

    // Now that we are done with subgroups, handle this group.
    $users = $this->getUsers($group_id);

    // Iterate through team users and mark them as deleted.
    foreach ($users as $one_user) {
      if (!$this->markUserDeleted($one_user['id']))
          return false;
    }

    // Mark tasks deleted.
    if (!$this->markTasksDeleted($group_id)) return false;

    $mdb2 = getConnection();

    // Mark roles deleted.
    $sql = "update tt_roles set status = NULL where team_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark projects deleted.
    $sql = "update tt_projects set status = NULL where team_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark clients deleted.
    $sql = "update tt_clients set status = NULL where team_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark invoices deleted.
    $sql = "update tt_invoices set status = NULL where team_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark custom fields deleted.
    $sql = "update tt_custom_fields set status = NULL where team_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark notifications deleted.
    $sql = "update tt_cron set status = NULL where team_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Note: we don't mark tt_log or tt_expense_items deleted here.
    // Reasoning is:
    //
    // 1) Users may mark some of them deleted during their work.
    // If we mark all of them deleted here, we can't recover nicely
    // as we'll lose track of what was deleted by user.
    //
    // 2) DB maintenance script (Clean up DB from inactive teams) should
    // get rid of these items permanently eventually.

    // Mark group deleted.
    global $user;
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);
    $sql = "update tt_teams set status = NULL $modified_part where id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // validateTeamInfo validates team information entered by user.
  function validateTeamInfo($fields) {
    global $i18n;
    global $auth;

    $result = true;

    if (!ttValidString($fields['group_name'], true)) {
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.team_name'));
      $result = false;
    }
    if (!ttValidString($fields['user_name'])) {
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.manager_name'));
      $result = false;
    }
    if (!ttValidString($fields['new_login'])) {
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.manager_login'));
      $result = false;
    }

    // If we change login, it must be unique.
    if ($fields['new_login'] != $fields['old_login']) {
      if (ttUserHelper::getUserByLogin($fields['new_login'])) {
        $this->err->add($i18n->getKey('error.user_exists'));
        $result = false;
      }
    }

    if (!$auth->isPasswordExternal() && ($fields['password1'] || $fields['password2'])) {
      if (!ttValidString($fields['password1'])) {
        $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.password'));
        $result = false;
      }
      if (!ttValidString($fields['password2'])) {
        $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.confirm_password'));
        $result = false;
      }
      if ($fields['password1'] !== $fields['password2']) {
        $this->err->add($i18n->getKey('error.not_equal'), $i18n->getKey('label.password'), $i18n->getKey('label.confirm_password'));
        $result = false;
      }
    }
    if (!ttValidEmail($fields['email'], true)) {
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.email'));
      $result = false;
    }

    return $result;
  }

  // updateTeam validates user input and updates the team with new information.
  function updateTeam($team_id, $fields) {
    if (!$this->validateTeamInfo($fields)) return false; // Can't continue as user input is invalid.

    $mdb2 = getConnection();

    // Update group name if it changed.
    if ($fields['old_group_name'] != $fields['new_group_name']) {
      $name = $mdb2->quote($fields['new_group_name']);
      $sql = "update tt_teams set name = $name where id = $team_id";
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

    $sql = 'update tt_users set '.$login_part.$password_part.$name_part.$email_part.'where id = '.$user_id;
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }
}
