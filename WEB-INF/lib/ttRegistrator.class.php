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
    if (!$thins->lang) $this->lang = 'en';
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
    // TODO: work in progress. Not implemented.
  }
}
