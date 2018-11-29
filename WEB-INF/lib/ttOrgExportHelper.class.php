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

import('ttTeamHelper');
import('ttTimeHelper');
import('ttGroupExportHelper');

// ttOrgExportHelper handles export of organizations consisting of multiple groups
// into XML file for import (migrating) to another server.
class ttOrgExportHelper {

  var $fileName = null; // Name of file with data.

  // createDataFile creates a file with all data for the entire organization.
  function createDataFile($compress = false) {
    global $user;

    // Create a temporary file.
    $dirName = dirname(TEMPLATE_DIR . '_c/.');
    $tmp_file = tempnam($dirName, 'tt');

    // Open the file for writing.
    $file = fopen($tmp_file, 'wb');
    if (!$file) return false;

    // Write XML to the file.
    fwrite($file, "<?xml version=\"1.0\"?>\n");
    $org_part = "<org schema=\"".$this->getVersion()."\">\n";
    fwrite($file, $org_part);

    // Use ttGroupExportHelper to export all groups.
    $groupExportHelper = new ttGroupExportHelper($user->group_id, $file, '  ');  // 2 spaces indentation for home group.
    $groupExportHelper->writeData();

    fwrite($file, "</org>\n");
    fclose($file);

    if ($compress) {
      $this->fileName = tempnam($dirName, 'tt');
      $this->compress($tmp_file, $this->fileName);
      unlink($tmp_file);
    } else
      $this->fileName = $tmp_file;

    return true;
  }

  // getFileName - returns file name.
  function getFileName() {
    return $this->fileName;
  }

  // compress - compresses the content of the $in file into $out file.
  function compress($in, $out) {
    // Initial checks of file names and permissions.
    if (!file_exists($in) || !is_readable ($in))
      return false;
    if ((!file_exists($out) && !is_writable(dirname($out))) || (file_exists($out) && !is_writable($out)))
      return false;

    $in_file = fopen($in, 'rb');

    if (function_exists('bzopen')) {
      if (!$out_file = bzopen($out, 'w'))
        return false;

      while (!feof ($in_file)) {
        $buffer = fread($in_file, 4096);
        bzwrite($out_file, $buffer, 4096);
      }
      bzclose($out_file);
    }
    fclose ($in_file);
    return true;
  }

  private function getVersion() {
    $mdb2 = getConnection();
    $sql = "select param_value from tt_site_config where param_name = 'version_db'";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['param_value'];
        $result[] = $val;
    }
    return false;
  }
}
