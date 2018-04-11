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

import('ttTeamHelper');

// Class ttUserHelper contains helper functions for operations with users.
class ttUserHelper {

  // The getUserName function returns user name.
  static function getUserName($user_id) {
    $mdb2 = getConnection();

    $sql = "select name from tt_users where id = $user_id and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['name'];
    }
    return false;
  }

  // The getUserByLogin function obtains data for a user, who is identified by login.
  static function getUserByLogin($login) {
    $mdb2 = getConnection();

    $sql = "select id, name from tt_users where login = ".$mdb2->quote($login)." and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }

  // The getUserByEmail function is a helper function that tries to obtain user details identified by email.
  // This function works only when one such active user exists.
  static function getUserByEmail($email) {
    $mdb2 = getConnection();

    $sql = "select login, count(*) as cnt from tt_users where email = ".$mdb2->quote($email)." and status = 1 group by email";
    $res = $mdb2->query($sql);

    if (is_a($res, 'PEAR_Error'))
      return false;

    $val = $res->fetchRow();
    if (1 <> $val['cnt']) {
      // We either have no users or multiple users with a given email.
      return false;
    }
    return $val['login'];
  }

  // The getUserIdByTmpRef obtains user id from a temporary reference (used for password resets).
  static function getUserIdByTmpRef($ref) {
    $mdb2 = getConnection();

    $sql = "select user_id from tt_tmp_refs where ref = ".$mdb2->quote($ref);
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['user_id'];
    }
    return false;
  }

  // insert - inserts a user into database.
  static function insert($fields, $hash = true) {
    global $user;
    $mdb2 = getConnection();

    $password = $mdb2->quote($fields['password']);
    if($hash)
      $password = 'md5('.$password.')';
    $email = isset($fields['email']) ? $fields['email'] : '';
    $group_id = (int) $fields['group_id'];
    $rate = str_replace(',', '.', isset($fields['rate']) ? $fields['rate'] : 0);
    if($rate == '')
      $rate = 0;
    if (array_key_exists('status', $fields)) { // Key exists and may be NULL during migration of deleted acounts.
      $status_f = ', status';
      $status_v = ', '.$mdb2->quote($fields['status']);
    }
    $created_ip_v = ', '.$mdb2->quote($_SERVER['REMOTE_ADDR']);
    $created_by_v = ', '.$mdb2->quote($user->id);

    $sql = "insert into tt_users (name, login, password, group_id, role_id, client_id, rate, email, created, created_ip, created_by $status_f) values (".
      $mdb2->quote($fields['name']).", ".$mdb2->quote($fields['login']).
      ", $password, $group_id, ".$mdb2->quote($fields['role_id']).", ".$mdb2->quote($fields['client_id']).", $rate, ".$mdb2->quote($email).", now() $created_ip_v $created_by_v $status_v)";
    $affected = $mdb2->exec($sql);

    // Now deal with project assignment.
    if (!is_a($affected, 'PEAR_Error')) {
      $sql = "SELECT LAST_INSERT_ID() AS last_id";
      $res = $mdb2->query($sql);
      $val = $res->fetchRow();
      $last_id = $val['last_id'];

      $projects = isset($fields['projects']) ? $fields['projects'] : array();
      if (count($projects) > 0) {
        // We have at least one project assigned. Insert corresponding entries in tt_user_project_binds table.
        foreach($projects as $p) {
          if(!isset($p['rate']))
            $p['rate'] = 0;
          else
            $p['rate'] = str_replace(',', '.', $p['rate']);

          $sql = "insert into tt_user_project_binds (project_id, user_id, rate, status) values(".$p['id'].",".$last_id.",".$p['rate'].", 1)";
          $affected = $mdb2->exec($sql);
        }
      }
      return $last_id;
    }
    return false;
  }

  // update - updates a user in database.
  static function update($user_id, $fields) {
    global $user;
    $mdb2 = getConnection();

    // Check parameters.
    if (!$user_id || !isset($fields['login']))
      return false;

    // Prepare query parts.
    if (isset($fields['password']))
      $pass_part = ', password = md5('.$mdb2->quote($fields['password']).')';
    if (in_array('manage_users', $user->rights)) {
      if (isset($fields['role_id'])) {
        $role_id = (int) $fields['role_id'];
        $role_id_part = ", role_id = $role_id";
      }
      if (array_key_exists('client_id', $fields)) // Could be NULL.
        $client_part = ", client_id = ".$mdb2->quote($fields['client_id']);
    }

    if (array_key_exists('rate', $fields)) {
      $rate = str_replace(',', '.', isset($fields['rate']) ? $fields['rate'] : 0);
      if($rate == '') $rate = 0;
      $rate_part = ", rate = ".$mdb2->quote($rate); 
    }

    if (isset($fields['status'])) {
      $status = (int) $fields['status']; 
      $status_part = ", status = $status";
    }

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);

    $sql = "update tt_users set login = ".$mdb2->quote($fields['login']).
      "$pass_part, name = ".$mdb2->quote($fields['name']).
      "$role_id_part $client_part $rate_part $modified_part $status_part, email = ".$mdb2->quote($fields['email']).
      " where id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    if (array_key_exists('projects', $fields)) {
      // Deal with project assignments.
      // Note: we cannot simply delete old project binds and insert new ones because it screws up reporting
      // (when looking for cost while entries for de-assigned projects exist).
      // Therefore, we must iterate through all projects and only delete the binds when no time entries are present,
      // otherwise de-activate the bind (set its status to inactive). This will keep the bind
      // and its rate in database for reporting.

      $all_projects = ttTeamHelper::getAllProjects($user->group_id);
      $assigned_projects = isset($fields['projects']) ? $fields['projects'] : array();

      foreach($all_projects as $p) {
        // Determine if a project is assigned.
        $assigned = false;
        $project_id = $p['id'];
        $rate = '0.00';
        if (count($assigned_projects) > 0) {
          foreach ($assigned_projects as $ap) {
            if ($project_id == $ap['id']) {
              $assigned = true;
              if ($ap['rate']) {
                $rate = $ap['rate'];
                $rate = str_replace(",",".",$rate);
              }
              break;
            }
          }
        }

        if (!$assigned) {
          ttUserHelper::deleteBind($user_id, $project_id);
        } else {
          // Here we need to either update or insert new tt_user_project_binds record.
          // Determine if a record exists.
          $sql = "select id from tt_user_project_binds where user_id = $user_id and project_id = $project_id";
          $res = $mdb2->query($sql);
          if (is_a($res, 'PEAR_Error')) die ($res->getMessage());
          if ($val = $res->fetchRow()) {
            // Record exists. Update it.
            $sql = "update tt_user_project_binds set status = 1, rate = $rate where id = ".$val['id'];
            $affected = $mdb2->exec($sql);
            if (is_a($affected, 'PEAR_Error')) die ($affected->getMessage());
          } else {
            // Record does not exist. Insert it.
            ttUserHelper::insertBind($user_id, $project_id, $rate, 1);
          }
        }
      }
    }
    return true;
  }

  // The delete function permanently deletes a user and all associated data.
  static function delete($user_id) {
    $mdb2 = getConnection();

    // Delete custom field log entries for user, if we have them.
    $sql = "delete from tt_custom_field_log where log_id in
      (select id from tt_log where user_id = $user_id)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Delete log entries for user.
    $sql = "delete from tt_log where user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Delete expense items for user.
    $sql = "delete from tt_expense_items where user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Delete user binds.
    $sql = "delete from tt_user_project_binds where user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Clean up tt_config table.
    $sql = "delete from tt_config where user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false; 

    // Clean up tt_fav_reports table.
    $sql = "delete from tt_fav_reports where user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Delete user.
    $sql = "delete from tt_users where id = $user_id";
    $affected = $mdb2->exec($sql);    
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // The saveTmpRef saves a temporary reference for user that is used to reset user password.
  static function saveTmpRef($ref, $user_id) {
    $mdb2 = getConnection();

    $sql = "delete from tt_tmp_refs where created < now() - interval 1 hour";
    $affected = $mdb2->exec($sql);

    $sql = "insert into tt_tmp_refs (created, ref, user_id) values(now(), ".$mdb2->quote($ref).", $user_id)";
    $affected = $mdb2->exec($sql);
  }

  // The setPassword function updates password for user.
  static function setPassword($user_id, $password) {
    $mdb2 = getConnection();

    $sql = "update tt_users set password = md5(".$mdb2->quote($password).") where id = $user_id";
    $affected = $mdb2->exec($sql);

    return (!is_a($affected, 'PEAR_Error'));
  }

  // insertBind - inserts a user to project bind into tt_user_project_binds table.
  static function insertBind($user_id, $project_id, $rate, $status) {
    $mdb2 = getConnection();

    $sql = "insert into tt_user_project_binds (user_id, project_id, rate, status)
      values($user_id, $project_id, ".$mdb2->quote($rate).", $status)";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // deleteBind - deactivates user to project bind when time entries exist,
  // otherwise deletes it entirely.
  static function deleteBind($user_id, $project_id) {
    $mdb2 = getConnection();

    $sql = "select count(*) as cnt from tt_log where 
      user_id = $user_id and project_id = $project_id and status = 1";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) die ($res->getMessage());

    $count = 0;
    $val = $res->fetchRow();
    $count = $val['cnt'];

    if ($count > 0) {
      // Deactivate user bind.
      $sql = "select id from tt_user_project_binds where user_id = $user_id and project_id = $project_id";
       $res = $mdb2->query($sql);
       if (is_a($res, 'PEAR_Error')) die ($res->getMessage());
       if ($val = $res->fetchRow()) {
         $sql = "update tt_user_project_binds set status = 0 where id = ".$val['id'];
         $affected = $mdb2->exec($sql);
         if (is_a($affected, 'PEAR_Error')) die ($res->getMessage());
       }
    } else {
      // Delete user bind.
      $sql = "delete from tt_user_project_binds where user_id = $user_id and project_id = $project_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die ($res->getMessage());
    }
    return true;
  }

  // updateLastAccess - updates last access info for user in db.
  static function updateLastAccess() {
    global $user;
    $mdb2 = getConnection();
    $accessed_ip = $mdb2->quote($_SERVER['REMOTE_ADDR']);
    $sql = "update tt_users set accessed = now(), accessed_ip = $accessed_ip where id = $user->id";
    $mdb2->exec($sql);
  }
}
