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

// The ttRoleHelper is a class to help with custom group roles.
class ttRoleHelper {
  // insert - inserts an entry into tt_roles table.
  static function insert($fields)
  {
    $mdb2 = getConnection();

    $team_id = (int) $fields['team_id'];
    $name = $fields['name'];
    $rank = (int) $fields['rank'];
    $rights = $fields['rights'];
    $status = $fields['status'];

    $sql = "insert into tt_roles (team_id, name, rank, rights, status)
      values ($team_id, ".$mdb2->quote($name).", $rank, ".$mdb2->quote($rights).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }
}
