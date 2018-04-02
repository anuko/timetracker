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

// ttRegistrator class is used to register a user in Time Tracker.
class ttRegistrator {
  var $user_name = null;  // User name.
  var $login = null;      // User login.
  var $password = null;   // User password.
  var $email = null;      // User email.
  var $group_name = null; // Group name.
  var $currency = null;   // Currency.
  var $lang = null;       // Language.
  var $group_id = null;   // Group id, set after we create a group.
  var $role_id = null;    // Role id for top managers.
  var $user_id = null;    // User id after registration.
  var $err = null;        // Error object, passed to us as reference.
                          // We use it to communicate errors to caller.

  // Constructor.
  function __construct($fields, &$err) {
    $this->user_name = $fields['user_name'];
    $this->login = $fields['login'];    
    $this->password1 = $fields['password1'];
    $this->password2 = $fields['password2'];
    $this->email = $fields['email'];
    $this->group_name = $fields['group_name'];
    $this->currency = $fields['currency'];
    $this->lang = $fields['lang'];
    if (!$this->lang) $this->lang = 'en';
    $this->err = $err;

    // Validate passed in parameters.
    $this->validate();
  }

  function validate() {
    global $i18n;

    if (!ttValidString($this->group_name, true))
      $this->err->add($i18n->get('error.field'), $i18n->get('label.group_name'));
    if (!ttValidString($this->currency, true))
      $this->err->add($i18n->get('error.field'), $i18n->get('label.currency'));
    if (!ttValidString($this->user_name))
      $this->err->add($i18n->get('error.field'), $i18n->get('label.manager_name'));
    if (!ttValidString($this->login))
      $this->err->add($i18n->get('error.field'), $i18n->get('label.manager_login'));
    if (!ttValidString($this->password1))
      $this->err->add($i18n->get('error.field'), $i18n->get('label.password'));
    if (!ttValidString($this->password2))
      $this->err->add($i18n->get('error.field'), $i18n->get('label.confirm_password'));
    if ($this->password1 !== $this->password2)
      $this->err->add($i18n->get('error.not_equal'), $i18n->get('label.password'), $i18n->get('label.confirm_password'));
    if (!ttValidEmail($this->email, true))
      $this->err->add($i18n->get('error.field'), $i18n->get('label.email'));
  }

  // The register function registers a user in Time Tracker.
  function register() {
    if ($this->err->yes()) return false; // There are errors, do not proceed.

    global $i18n;

    // Protection fom too many recent bot registrations from user IP.
    if ($this->registeredRecently()) {
      $this->err->add($i18n->get('error.access_denied'));
      return false;
    }

    import('ttUserHelper');
    if (ttUserHelper::getUserByLogin($this->login)) {
      // User login already exists.
      $this->err->add($i18n->get('error.user_exists'));
      return false;
    }

    // Create a new group.
    $this->group_id = $this->createGroup();
    if (!$this->group_id) {
      $this->err->add($i18n->get('error.db'));
      return false;
    }

    import('ttRoleHelper');
    if (!ttRoleHelper::createPredefinedRoles($this->group_id, $this->lang)) {
      $err->add($i18n->get('error.db'));
      return false;
    }
    $this->role_id = ttRoleHelper::getTopManagerRoleID();
    $this->user_id = $this->createUser();

    if (!$this->user_id) {
      $err->add($i18n->get('error.db'));
      return false;
    }

    if (!$this->setCreatedBy($this->user_id))
      return false;

    return true;
  }

  // The createGroup function creates a group in Time Tracker as part
  // of user registration process. This is a top group for user as top manager.
  function createGroup() {
    $mdb2 = getConnection();

    $name = $mdb2->quote($this->group_name);
    $currency = $mdb2->quote($this->currency);
    $lang = $mdb2->quote($this->lang);
    $created = 'now()';
    $created_ip = $mdb2->quote($_SERVER['REMOTE_ADDR']);

    $sql = "insert into tt_groups (name, currency, lang, created, created_ip) values($name, $currency, $lang, $created, $created_ip)";
    $affected = $mdb2->exec($sql);

    if (!is_a($affected, 'PEAR_Error')) {
      $group_id = $mdb2->lastInsertID('tt_groups', 'id');
      return $group_id;
    }
    return false;
  }

  // The createUser creates a user in database as part of registration process.
  function createUser() {
    $mdb2 = getConnection();

    $login = $mdb2->quote($this->login);
    $password = 'md5('.$mdb2->quote($this->password1).')';
    $name = $mdb2->quote($this->user_name);
    $email = $mdb2->quote($this->email);
    $created = 'now()';
    $created_ip = $mdb2->quote($_SERVER['REMOTE_ADDR']);
    $values = "values($login, $password, $name, $this->group_id, $this->role_id, $email, $created, $created_ip)";

    $sql = 'insert into tt_users (login, password, name, group_id, role_id, email, created, created_ip) '.$values;
    $affected = $mdb2->exec($sql);
    if (!is_a($affected, 'PEAR_Error')) {
      $user_id = $mdb2->lastInsertID('tt_users', 'id');
      return $user_id;
    }
    return false;
  }

  // The setCreatedBy sets created_by field for both group and user to passed in user_id.
  function setCreatedBy($user_id) {
    if ($this->err->yes()) return false; // There are errors, do not proceed.

    global $i18n;
    $mdb2 = getConnection();

    // Update group.
    $sql = "update tt_groups set created_by = $user_id where id = $this->group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) {
      $this->err->add($i18n->get('error.db'));
      return false;
    }

    // Update top manager.
    $sql = "update tt_users set created_by = $user_id where id = $user_id and group_id = $this->group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) {
      $this->err->add($i18n->get('error.db'));
      return false;
    }

    return true;
  }

  // registeredRecently determines if we already have a successful recent registration from user IP.
  // "recent" means "within the last minute" and is set in a query by the following condition:
  // "and created > now() - interval 1 minute". Change if necessary.
  function registeredRecently() {
    $mdb2 = getConnection();

    $ip_part = ' created_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']);
    $sql = 'select created from tt_groups where '.$ip_part.' and created > now() - interval 1 minute';
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error'))
      return false;
    $val = $res->fetchRow();
    if ($val)
      return true;

    return false;
  }
}
