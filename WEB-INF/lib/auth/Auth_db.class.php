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
  	$sql = "SELECT id FROM tt_users 
      WHERE login = ".$mdb2->quote($login)." AND password = md5(".$mdb2->quote($password).") AND status = 1";

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
        WHERE login = ".$mdb2->quote($login)." AND password = password(".$mdb2->quote($password).") AND status = 1";
      $res = $mdb2->query($sql);
      if (is_a($res, 'PEAR_Error')) {
        die($res->getMessage());
      }
      $val = $res->fetchRow();
      if ($val['id'] > 0) {
        return array('login'=>$login,'id'=>$val['id']);
      }
      return false;
    }
  }

  function isPasswordExternal() {
    return false;
  }
}