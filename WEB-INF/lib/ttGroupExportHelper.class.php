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

// ttGroupExportHelper - this class is used to write data for a single group
// to a file. When group contains other groups, it reuses itself recursively.
//
// Currently, it is work in progress.
// When done, it should handle export of organizations containing multiple groups.
class ttGroupExportHelper {

  var $group_id = null;     // Group we are exporting.
  var $file     = null;     // File to write to.
  var $indentation = null;  // A string consisting of a number of spaces.
  var $subgroups = array(); // Immediate subgroups.

  // Constructor.
  function __construct($group_id, $file, $indentation) {
    global $user;

    $this->group_id = $group_id;
    $this->file = $file;
    $this->indentation = $indentation;

    // Build a list of subgroups.
    $mdb2 = getConnection();
    $sql =  "select id from tt_groups".
            " where status = 1 and parent_id = $this->group_id and org_id = $user->org_id order by id desc";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $this->subgroups[] = $val;
      }
    }
  }

  // writeData writes group data into file.
  function writeData() {
    // TODO: write code here.

    // Write group info. Something dummy for now to test...
    fwrite($this->file, $this->indentation."<group>\n");

    // Call itself recursively for all subgroups.
    foreach ($this->subgroups as $subgroup) {
      $subgroup_helper = new ttGroupExportHelper($subgroup['id'], $this->file, $this->indentation.'  ');
      $subgroup_helper->writeData();
    }

    fwrite($this->file, $this->indentation."</group>\n");
  }
}
