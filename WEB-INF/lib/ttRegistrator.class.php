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
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.team_name'));
    if (!ttValidString($this->currency, true))
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.currency'));
    if (!ttValidString($this->user_name))
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.manager_name'));
    if (!ttValidString($this->login))
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.manager_login'));
    if (!ttValidString($this->password1))
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.password'));
    if (!ttValidString($this->password2))
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.confirm_password'));
    if ($this->password1 !== $this->password2)
      $this->err->add($i18n->getKey('error.not_equal'), $i18n->getKey('label.password'), $i18n->getKey('label.confirm_password'));    
    if (!ttValidEmail($this->email, true))
      $this->err->add($i18n->getKey('error.field'), $i18n->getKey('label.email'));
  }

  // The register function registers a user in Time Tracker.
  function register() {
    global $i18n;

    if ($this->err->yes())
      return; // There are errors, do not proceed.

    import('ttUserHelper');
    if (ttUserHelper::getUserByLogin($this->login)) {
      // User login already exists.
      $this->err->add($i18n->getKey('error.user_exists'));
      return;
    }

    // Create a new group.
    $this->group_id = $this->createGroup();
    if (!$this->group_id) {
      $this->err->add($i18n->getKey('error.db'));
      return;
    }

    import('ttRoleHelper');
    if (!ttRoleHelper::createPredefinedRoles($this->group_id, $this->lang)) {
      $err->add($i18n->getKey('error.db'));
      return;
    }
    $this->role_id = ttRoleHelper::getTopManagerRoleID();
    $this->user_id = $this->createUser();

    if (!$this->user_id) {
      $err->add($i18n->getKey('error.db'));
      return;
    }
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

    $sql = "insert into tt_teams (name, currency, lang, created, created_ip) values($name, $currency, $lang, $created, $created_ip)";
    $affected = $mdb2->exec($sql);

    if (!is_a($affected, 'PEAR_Error')) {
      $group_id = $mdb2->lastInsertID('tt_teams', 'id');
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

    $sql = 'insert into tt_users (login, password, name, team_id, role_id, email, created, created_ip) '.$values;
    $affected = $mdb2->exec($sql);
    if (!is_a($affected, 'PEAR_Error')) {
      $user_id = $mdb2->lastInsertID('tt_users', 'id');

      // Update created_by field for the team with user id, now that we have it.
      $sql = "update tt_teams set created_by = $user_id where id = $this->group_id and created_by is null";
      $affected = $mdb2->exec($sql);

      // Update created_by field for user by setting to self.
      $sql = "update tt_users set created_by = $user_id where id = $user_id and team_id = $this->group_id and created_by is null";
      $affected = $mdb2->exec($sql);

      return $user_id;
    }
    return false;
  }
}
