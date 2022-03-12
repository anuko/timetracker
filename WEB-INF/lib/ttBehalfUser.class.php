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
// | https://www.anuko.com/time-tracker/credits.htm
// +----------------------------------------------------------------------+

import('ttConfigHelper');
import('ttGroupHelper');

// ttBehalfUser class stores a set of "on behalf user" attributes.
// An instance in kept in ttUser class when user is working on behalf of someone.
class ttBehalfUser {
  // Work in progress, build on when need arises.
  var $name = null;             // User name.
  var $id = null;               // User id.
  var $quota_percent = 100.0;   // Time quota percent for quotas plugin.
  var $email = null;            // User email.

  // Constructor.
  // Note: org_id is needed because we may construct an object in
  // ttUser constructor, when global $user object does not yet exist.
  function __construct($id, $org_id) {
    $mdb2 = getConnection();

    $sql = "select u.name, u.id, u.quota_percent, u.email".
      " from tt_users u".
      " where u.id = $id and u.org_id = $org_id and u.status = 1";

    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return;

    $val = $res->fetchRow();
    if ($val['id'] > 0) {
      $this->name = $val['name'];
      $this->id = $val['id'];
      if ($val['quota_percent']) $this->quota_percent = $val['quota_percent'];
      $this->email = $val['email'];
    }
  }
}
