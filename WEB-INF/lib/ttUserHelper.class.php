<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

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

    // Some protection for brute force attacks to guess a reference for user.
    // This limits an available window for brute force guessing to 1 hour.
    $sql = "delete from tt_tmp_refs where created < now() - interval 1 hour";
    $affected = $mdb2->exec($sql);

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
    $org_id = (int) $fields['org_id'];
    $rate = str_replace(',', '.', isset($fields['rate']) ? $fields['rate'] : 0);
    $quota_percent = str_replace(',', '.', isset($fields['quota_percent']) ? $fields['quota_percent'] : 100);
    if($rate == '')
      $rate = 0;
    if (array_key_exists('status', $fields)) { // Key exists and may be NULL during migration of deleted acounts.
      $status_f = ', status';
      $status_v = ', '.$mdb2->quote($fields['status']);
    }
    $created_ip_v = ', '.$mdb2->quote($_SERVER['REMOTE_ADDR']);
    $created_by_v = ', '.$user->id;

    $sql = "insert into tt_users (name, login, password, group_id, org_id, role_id, client_id, rate, quota_percent, email, created, created_ip, created_by $status_f) values (".
      $mdb2->quote($fields['name']).", ".$mdb2->quote($fields['login']).
      ", $password, $group_id, $org_id, ".$mdb2->quote($fields['role_id']).", ".$mdb2->quote($fields['client_id']).", $rate, $quota_percent, ".$mdb2->quote($email).", now() $created_ip_v $created_by_v $status_v)";
    $affected = $mdb2->exec($sql);

    // Now deal with project assignment.
    if (!is_a($affected, 'PEAR_Error')) {
      $last_id = $mdb2->lastInsertID('tt_users', 'id');
      $projects = isset($fields['projects']) ? $fields['projects'] : array();
      if (count($projects) > 0) {
        // We have at least one project assigned. Insert corresponding entries in tt_user_project_binds table.
        foreach($projects as $p) {
          if(!isset($p['rate']))
            $p['rate'] = 0;
          else
            $p['rate'] = str_replace(',', '.', $p['rate']);

          $sql = "insert into tt_user_project_binds (project_id, user_id, group_id, org_id, rate, status)".
            " values(".$p['id'].", $last_id, $group_id, $org_id, ".$p['rate'].", 1)";
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
    if (!$user_id)
      return false;

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Prepare query parts.
    if (isset($fields['login'])) {
      $login_part = ", login = ".$mdb2->quote($fields['login']);
    }

    if (isset($fields['password']))
      $pass_part = ', password = md5('.$mdb2->quote($fields['password']).')';

    if (isset($fields['name']))
      $name_part = ', name = '.$mdb2->quote($fields['name']);

    if ($user->can('manage_users')) {
      if (isset($fields['role_id'])) {
        $role_id = (int) $fields['role_id'];
        $role_part = ", role_id = $role_id";
      }
      if (array_key_exists('client_id', $fields)) // Could be NULL.
        $client_part = ", client_id = ".$mdb2->quote($fields['client_id']);
    }

    if (array_key_exists('rate', $fields)) {
      $rate = str_replace(',', '.', isset($fields['rate']) ? $fields['rate'] : 0);
      if($rate == '') $rate = 0;
      $rate_part = ", rate = ".$mdb2->quote($rate); 
    }

    if (array_key_exists('quota_percent', $fields)) {
      $quota_percent = str_replace(',', '.', isset($fields['quota_percent']) ? $fields['quota_percent'] : 100);
      $quota_percent_part = ", quota_percent = ".$mdb2->quote($quota_percent);
    }

    if (isset($fields['email']))
      $email_part = ', email = '.$mdb2->quote($fields['email']);

    if (isset($fields['status'])) {
      $status = (int) $fields['status']; 
      $status_part = ", status = $status";
    }

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;
    $parts = ltrim($login_part.$pass_part.$name_part.$role_part.$client_part.$rate_part.$quota_percent_part.$email_part.$modified_part.$status_part, ',');

    $sql = "update tt_users set $parts".
      " where id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    if (array_key_exists('projects', $fields)) {
      // Deal with project assignments.
      // Note: we cannot simply delete old project binds and insert new ones because it screws up reporting
      // (when looking for cost while entries for de-assigned projects exist).
      // Therefore, we must iterate through all projects and only delete the binds when no time entries are present,
      // otherwise de-activate the bind (set its status to inactive). This will keep the bind
      // and its rate in database for reporting.

      $all_projects = ttTeamHelper::getAllProjects($user->getGroup());
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
            ttUserHelper::insertBind(array(
              'user_id' => $user_id,
              'project_id' => $project_id,
              'rate' => $rate,
              'status' => ACTIVE));
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

  // The recentRefExists determines if a reasonably recent user reference already exists.
  // We do it similar to ttRegistrator::registeredRecently().
  static function recentRefExists($user_id) {
    $mdb2 = getConnection();

    $sql = "select count(*) as cnt from tt_tmp_refs where user_id = $user_id and created > now() - interval 15 minute";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error'))
      return false;
    $val = $res->fetchRow();
    if ($val['cnt'] == 0)
      return false; // No references in last 15 minutes.
    if ($val['cnt'] >= 2)
      return true;  // 2 or more references in last 15 mintes.

    // If we are here, there was exactly one reference during last 15 minutes.
    // Determine if it occurred within the last minute in a separate query.
    $sql = "select created from tt_tmp_refs where user_id = $user_id and created > now() - interval 1 minute";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error'))
      return false;
    $val = $res->fetchRow();
    if ($val)
      return true;

    return false;
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

    if (!is_a($affected, 'PEAR_Error')) {
      $sql = "delete from tt_tmp_refs where user_id = $user_id";
      $affected = $mdb2->exec($sql);
    }
    return (!is_a($affected, 'PEAR_Error'));
  }

  // insertBind - inserts a user to project bind into tt_user_project_binds table.
  static function insertBind($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;
    $user_id = (int) $fields['user_id'];
    $project_id = (int) $fields['project_id'];
    $rate = $mdb2->quote($fields['rate']);
    $status = $mdb2->quote($fields['status']);

    $sql = "insert into tt_user_project_binds (user_id, project_id, group_id, org_id, rate, status)".
      " values($user_id, $project_id, $group_id, $org_id, $rate, $status)";
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

  // canAdd determines if we can add a user in case there is a limit.
  static function canAdd($num_users = 1) {
    $mdb2 = getConnection();
    $sql = "select param_value from tt_site_config where param_name = 'max_users'";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    if (!$val) return true; // No limit.

    $max_count = $val['param_value'];
    $sql = "select count(*) as user_count from tt_users where group_id > 0 and status is not null";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    if ($val['user_count'] <= $max_count - $num_users)
      return true; // Limit not reached.

    return false;
  }

  // getUserRank - obtains a rank for a given user.
  static function getUserRank($user_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select r.rank from tt_users u".
      " left join tt_roles r on (u.role_id = r.id)".
      " where u.id = $user_id and u.group_id = $group_id and u.org_id = $org_id";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return 0;
    $val = $res->fetchRow();
    return $val['rank'];
  }
}
