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

// ttAdmin class is used to perform admin tasks.
class ttAdmin {

  // Constructor.
  function __construct() {
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
}
