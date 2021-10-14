<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// NOTES:
//
// Auth_ldap.class.php was originally written for LDAP authentication with Windows Active Directory.
// It June 2011, it was extended to include support for OpenLDAP. The difference in the code is in the format
// of user identification that we pass to ldap_bind().
//
// Windows AD accepts username@domain.com while OpenLDAP needs something like "uid=username,ou=people,dc=domain,dc=com".
// Therefore, some branching in the code.
//
// In April 2012, a previously mandatory search for group membership was put in a conditional block (if ($member_of) -
// when mandatory membership in groups is actually defined in config.php).
// This made the module work with Sun Directory Server when NO GROUP MEMBERSHIP is specified.


/**
* Auth_ldap class to authenticate users against an LDAP server (Windows AD, OpenLDAP, and others).
* @package TimeTracker
*/
class Auth_ldap extends Auth {
  var $params;

  function __construct($params)
  {
    global $smarty;
    $this->params = $params;
    $smarty->assign('Auth_ldap_params', $this->params);
  }

  function ldap_escape($str){
    $illegal = array("(", ")", "#");
    $legal = array();
    foreach ($illegal as $id => $char) {
      $legal[$id] = "\\".$char;
    }
    $str = str_replace($illegal, $legal, $str); //replace them
    return $str;
  }

  /**
   * Authenticate user against LDAP server.
   *
   * @param string $login
   * @param string $password
   * @return mixed
   */
  function authenticate($login, $password)
  {
    // Special handling for admin@localhost - authenticate against db, not ldap.
    // It is a fallback mechanism when admin account in LDAP directory does not exist or is misconfigured.
    if ($login == 'admin@localhost') {
        import('auth.Auth_db');
        return Auth_db::authenticate($login, $password);
    }

    if (!function_exists('ldap_bind')) {
      die ('php_ldap extension not loaded!');
    }

    if (empty($this->params['server']) || empty($this->params['base_dn'])) {
      die('You must set server and base_dn in AUTH_MODULE_PARAMS in config.php');
    }

    $member_of = @$this->params['member_of'];

    $lc = ldap_connect($this->params['server']);

    if (isTrue('DEBUG')) {
      echo '<br />';
      echo '$lc='; var_dump($lc); echo '<br />';
      echo 'ldap_error()='; echo ldap_error($lc); echo '<br />';
    }

    if (!$lc) return false;

    ldap_set_option($lc, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($lc, LDAP_OPT_REFERRALS, 0);
    if (isTrue('DEBUG')) {
      ldap_set_option($lc, LDAP_OPT_DEBUG_LEVEL, 7);
    }
    // Additional options for secure ldap.
    // This insert is based on https://www.anuko.com/forum/viewtopic.php?f=4&t=2091
    // I can't test it at the moment. If things break please let us know!
    if (isset($this->params['tls_cacertdir'])) {
      ldap_set_option(null, LDAP_OPT_X_TLS_CACERTDIR, $this->params['tls_cacertdir']);
    }
    if (isset($this->params['tls_cacertfile'])) {
      ldap_set_option(null, LDAP_OPT_X_TLS_CACERTFILE, $this->params['tls_cacertfile']);
    }
    // End of addiitional options for secure ldap.

    // We need to handle Windows AD and OpenLDAP differently.
    if ($this->params['type'] == 'ad') {

      // Check if user specified full login.
      if (strpos($login, '@') === false) {
        // Append default domain.
        $login .= '@' . $this->params['default_domain'];
      }

      if (isTrue('DEBUG')) {
        echo '$login='; var_dump($login); echo '<br />';
      }

      $lb = @ldap_bind($lc, $login, $password);

      if (isTrue('DEBUG')) {
        echo '$lb='; var_dump($lb); echo '<br />';
        echo 'ldap_error()='; echo ldap_error($lc); echo '<br />';
      }

      if (!$lb) {
        ldap_unbind($lc);
        return false;
      }

      if ($member_of) {
        // Get groups the user is a member of from AD LDAP server.

        $filter = 'userPrincipalName='.Auth_ldap::ldap_escape($login);
        $fields = array('memberof');
        $sr = @ldap_search($lc, $this->params['base_dn'], $filter, $fields);

        if (isTrue('DEBUG')) {
          echo '$sr='; var_dump($sr); echo '<br />';
          echo 'ldap_error()='; echo ldap_error($lc); echo '<br />';
        }

        if (!$sr) {
          ldap_unbind($lc);
          return false;
        }

        $entries = @ldap_get_entries($lc, $sr);

        if (isTrue('DEBUG')) {
          echo '$entries='; var_dump($entries); echo '<br />';
          echo 'ldap_error()='; echo ldap_error($lc); echo '<br />';
        }

        if ($entries === false) {
          ldap_unbind($lc);
          return false;
        }

        $groups = array();

        // Extract group names. Assume the groups are in format: CN=<group_name>,...
        for ($i = 0; $i < @$entries[0]['memberof']['count']; $i++) {
          $grp = $entries[0]['memberof'][$i];
          $grp_fields = explode(',', $grp);
          $groups[] = substr($grp_fields[0], 3);
        }

        if (isTrue('DEBUG')) {
          echo '$member_of'; var_dump($member_of); echo '<br />';
        };

        // Check for group membership.
        foreach ($member_of as $check_grp) {
          if (!in_array($check_grp, $groups)) {
            ldap_unbind($lc);
            return false;
          }
        }
      }

      ldap_unbind($lc);
      return array('login' => $login, 'data' => $entries, 'member_of' => $groups);
    }

    if ($this->params['type'] == 'openldap') {

      // Assuming OpenLDAP server.

      if (empty($this->params['user_login_attribute'])) {
        $user_login_attribute = 'uid';
      } else {
        $user_login_attribute = $this->params['user_login_attribute'];
      }

      $login_oldap = $user_login_attribute.'='.Auth_ldap::ldap_escape($login).','.$this->params['base_dn'];

      if (isTrue('DEBUG')) {
        echo '$login_oldap='; var_dump($login_oldap); echo '<br />';
      }

      $lb = @ldap_bind($lc, $login_oldap, $password);

      if (isTrue('DEBUG')) {
        echo '$lb='; var_dump($lb); echo '<br />';
        echo 'ldap_error()='; echo ldap_error($lc); echo '<br />';
      }

      if (!$lb) {
        ldap_unbind($lc);
        return false;
      }

      if ($member_of) {

        if (isTrue('DEBUG')) {
          echo '$member_of : '; var_dump($member_of); echo '<br />';
        }

        $filter = $user_login_attribute.'='.Auth_ldap::ldap_escape($login); 	// ldap search filter
        $fields = array('memberof');                                            // ldap search attributes
        $sr = @ldap_search($lc, $this->params['base_dn'], $filter, $fields);

        if (isTrue('DEBUG')) {
          echo '$filter='; var_dump($filter); echo '<br />';
          echo '$fields='; var_dump($fields); echo '<br />';
          echo '$sr='; var_dump($sr); echo '<br />';
          echo 'ldap_error()='; echo ldap_error($lc); echo '<br />';
        }

        // if search failed it's likely that account is disabled
        if (!$sr) {
          ldap_unbind($lc);
          return false;
        }

        $entries = @ldap_get_entries($lc, $sr);

        if (isTrue('DEBUG')) {
          echo '$entries='; var_dump($entries); echo '<br />';
          echo 'ldap_error()='; echo ldap_error($lc); echo '<br />';
        }

        if ($entries === false) {
          ldap_unbind($lc);
          return false;
        }

        $groups = array(); // existing ldap group memberships

        for ($i = 0; $i < @$entries[0]['memberof']['count']; $i++) {
	  $grp = $entries[0]['memberof'][$i];
          $groups[] = $grp; // append group to array
          if (isTrue('DEBUG')) {
            var_dump($grp); echo ' appended to $groups<br />';
          }
        }

        // check for group membership
        foreach ($member_of as $check_grp) {
          if (isTrue('DEBUG')) {
            echo '$check_grp:'; var_dump($check_grp); echo '<br />';
          }
          if (!in_array($check_grp, $groups)) {
            ldap_unbind($lc);
            if (isTrue('DEBUG')) {
              echo '=> '.$login.' is not a member of '.$check_grp.'<br />';
            }
            return false;
          }
        }
      }

      ldap_unbind($lc);

      // check if the user specified full login
      if (strpos($login, '@') === false) {
	// append default domain
        $login .= '@' . $this->params['default_domain'];
      }

      return array('login' => $login, 'data' => $entries, 'member_of' => $groups);
    }

    // Server type is neither 'ad' or 'openldap'.
    return false;
  }

  function isPasswordExternal() {
    return true;
  }
}
