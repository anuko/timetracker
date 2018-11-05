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

  var $group_id = null;    // Group we are exporting.
  var $file     = null;    // File to write to.
  var $indentation = null; // A string consisting of a number of spaces.

  // Constructor.
  function __construct($group_id, $file, $indentation) {

    $this->group_id = $group_id;
    $this->file = $file;
    $this->indentation = $indentation;

    // TODO: Build a list of subgroups here.
  }

  // writeData writes group data into file.
  function writeData() {
    // TODO: write code here.

    // Write group info. Something dummy for now to test...
    fwrite($this->file, $this->indentation."<group>\n");
    fwrite($this->file, $this->indentation."</group>\n");
    //
    //
    // Call itself recursively for all subgroups.
  }
}
