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

// Class ttGroupHelper - contains helper functions that operate with groups.
// This is a planned replacement for ttTeamHelper as we move forward with subgroups.
class ttGroupHelper {

  // The getGroupName function returns group name.
  static function getGroupName($group_id) {
    $mdb2 = getConnection();

    $sql = "select name from tt_groups where id = $group_id and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['name'];
    }
    return false;
  }

  // The getParentGroup determines a parent group for a given group.
  static function getParentGroup($group_id) {
    global $user;

    $mdb2 = getConnection();

    $sql = "select parent_id from tt_groups where id = $group_id and org_id = $user->org_id and status = 1";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['parent_id'];
    }
    return false;
  }

  // The getSubgroupByName obtain an immediate subgroup by name if one exists.
  static function getSubgroupByName($name) {
    global $user;

    $mdb2 = getConnection();
    $parent_id = $user->getActiveGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_groups where parent_id = $parent_id and org_id = $org_id".
      " and name = ".$mdb2->quote($name)." and status is not null";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val && $val['id'])
        return $val;
    }
    return false;
  }

  // The insertSubgroup inserts a new subgroup in database.
  static function insertSubgroup($fields) {
    global $user;

    $mdb2 = getConnection();
    $parent_id = $user->getActiveGroup();
    $org_id = $user->org_id;

    // TODO: inherit all attributes from the parent group, if not supplied.
    $name = $fields['name'];
    $description = $fields['description'];

    $created = 'now()';
    $created_ip = $mdb2->quote($_SERVER['REMOTE_ADDR']);

    $sql = "insert into tt_groups (parent_id, org_id, name, description, created, created_ip)".
      " values($parent_id, $org_id, ".$mdb2->quote($name).", ".$mdb2->quote($description).", $created, $created_ip)";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
    // TODO: design subgroup roles carefully. Perhaps roles are not to be touched in subgroups at all.
  }
}
