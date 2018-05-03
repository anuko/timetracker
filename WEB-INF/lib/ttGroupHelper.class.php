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

  // The getTopGroups function returns an array of all active top groups on the server.
  static function getTopGroups() {
    $result = array();
    $mdb2 = getConnection();

    $sql =  "select id, name, created, lang from tt_groups".
            " where status = 1 and org_id is NULL order by id desc";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $val['date'] = substr($val['created'], 0, 10); // Strip the time.
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }
}
