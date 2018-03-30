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
// | https://www.anuko.com/content/time_tracker/open_source/credits.htm
// +----------------------------------------------------------------------+

/**
* Auth_db class is used to authenticate users against internal DB
* @package TimeTracker
*/
class Auth_db extends Auth {

  /**
   * Authenticate user against internal users DB
   *
   * @param string $login
   * @param string $password
   * @return mixed
   */
  function authenticate($login, $password)
  {
    $mdb2 = getConnection();

    // Try md5 password match first.
    $sql = "SELECT id FROM tt_users".
      " WHERE login = ".$mdb2->quote($login)." AND password = md5(".$mdb2->quote($password).") AND status = 1";

    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      die($res->getMessage());
    }

    $val = $res->fetchRow();
    if ($val['id'] > 0) {
      return array('login'=>$login,'id'=>$val['id']);
    } else {

      // If the OLD_PASSWORDS option is defined - set it.
      if (defined('OLD_PASSWORDS') && isTrue(OLD_PASSWORDS)) {
        $sql = "SET SESSION old_passwords = 1";
        $res = $mdb2->query($sql);
        if (is_a($res, 'PEAR_Error')) {
          die($res->getMessage());
        }
      }

      // Try legacy password match. This is needed for compatibility with older versions of TT.
      $sql = "SELECT id FROM tt_users
        WHERE login = ".$mdb2->quote($login)." AND password = old_password(".$mdb2->quote($password).") AND status = 1";
      $res = $mdb2->query($sql);
      if (is_a($res, 'PEAR_Error')) {
        return false; // Simply return false for a meaningful error message on screen, see the comment below.
        // die($res->getMessage()); // old_password() function is removed in MySQL 5.7.5.
                                    // We are getting a confusing "MDB2 Error: not found" in this case if we die.
        // TODO: perhaps it's time to simplify things and remove handling of old passwords completely.
      }
      $val = $res->fetchRow();
      if ($val['id'] > 0) {
        return array('login'=>$login,'id'=>$val['id']);
      }
    }

    // Special handling for admin@localhost - search for an account with admin role with a matching password.
    if ($login == 'admin@localhost') {
      $sql = "SELECT u.id, u.login FROM tt_users u".
        " LEFT JOIN tt_roles r on (u.role_id = r.id)".
        " WHERE r.rank = 1024 AND password = md5(".$mdb2->quote($password).") AND u.status = 1";
      $res = $mdb2->query($sql);
      if (is_a($res, 'PEAR_Error')) {
        die($res->getMessage());
      }
      $val = $res->fetchRow();
      if ($val['id'] > 0) {
        return array('login'=>$val['login'],'id'=>$val['id']);
      }
    }

    return false;
  }

  function isPasswordExternal() {
    return false;
  }
}