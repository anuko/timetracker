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

class Auth {

  // isAuthenticated - checks authentication status for user.
  function isAuthenticated() {
    if (isset($_SESSION['authenticated'])) {
// This check does not work properly because we are not getting here. Need to improve.
//        if (!isset($_COOKIE['tt_login'])) {
//          die ("Your browser's cookie functionality is turned off. Please turn it on.");
//        }

      global $smarty;
      $smarty->assign('authenticated', true); // Used in header.tpl for menu display.
      return true;
    }
    session_write_close();
    return false;
  }

  /**
   * authenticate - main function for authentication. Returns an array with 'login' key set to login
   * and other values depending on the underlying authentication module.
   * Returns false if error. For actual implementation see classes in WEB-INF/lib/auth/.
   */
  function authenticate($login, $password)
  {
    return false;
  }

  // isPasswordExternal - returns true if actual password is not stored in the internal DB.
  function isPasswordExternal()
  {
    return false;
  }

  // doLogin - perfoms a login procedure.
  function doLogin($login, $password) {
    $auth = $this->authenticate($login, $password);

    if (defined('AUTH_DEBUG') && isTrue(AUTH_DEBUG)) {
      echo '<br>'; var_dump($auth); echo '<br />';
    }

    if ($auth === false)
      return false;

    $login = $auth['login'];

    $mdb2 = getConnection();
    $sql = "SELECT id FROM tt_users WHERE login = ".$mdb2->quote($login)." AND status = 1";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      if (defined('AUTH_DEBUG') && isTrue(AUTH_DEBUG))
        echo 'db error!<br />';
      return false;
    }
    $val = $res->fetchRow();
    if (!$val['id']) {
      if (defined('AUTH_DEBUG') && isTrue(AUTH_DEBUG))
        echo 'login "'.$login.'" does not exist in Time Tracker database.<br />';
      return false;
    }

    $this->setAuth($val['id'], $login);
    return true;
  }

  // doLogout - clears logon data from session.
  function doLogout() {
    unset($_SESSION['authenticated']);
    unset($_SESSION['authenticated_user_id']);
    unset($_SESSION['login']);
  }

  // setAuth - stores authorization data in session.
  function setAuth($userid, $username) {
    $_SESSION['authenticated'] = true;
    $_SESSION['authenticated_user_id'] = $userid; // NOTE: using "user_id" instead of "authenticated_user_id" gets us in trouble
                                                  // with older PHP when register_globals = On. What happens is that any time we set
                                                  // $user_id variable in script, $_SESSION['user_id'] is also changed automatically. 
    $_SESSION['login'] = $username;
  }

  // getUserLogin - retrieves user login from session.
  function getUserLogin() {
    return $_SESSION['login'];
  }

  // getUserId - retrieves user ID from session.
  function getUserId() {
    if (isset($_SESSION['authenticated_user_id']))
      return $_SESSION['authenticated_user_id'];
    else
      return null;
  }

  static function &factory($module, $params = array())
  {
    import('auth.Auth_'.$module);
    $class = 'Auth_' . $module;
    if (class_exists($class)) {
      $new_class = new $class($params);
      return $new_class;
    } else {
      die('Class '.$class.' not found');
    }
  }
}
