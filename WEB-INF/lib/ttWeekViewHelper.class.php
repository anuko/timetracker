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

// ttWeekViewHelper class groups together functions used in week view.
class ttWeekViewHelper {

  // makeRowLabel - builds a human readable label for a row in week view,
  // which is a combination ot record properties.
  // Client - Project - Task - Custom field 1.
  // Note that billable property is not part of the label. Instead,
  // we identify such records with a different color in week view.
  static function makeRowLabel($record) {
    global $user;
    // Start with client.
    if ($user->isPluginEnabled('cl'))
      $label = $record['client'];

    // Add project.
    if (!empty($label) && !empty($record['project'])) $label .= ' - ';
    $label .= $record['project'];

    // Add task.
    if (!empty($label) && !empty($record['task'])) $label .= ' - ';
    $label .= $record['task'];

    // Add custom field 1.
    if ($user->isPluginEnabled('cf')) {
      if (!empty($label) && !empty($record['cf_1_value'])) $label .= ' - ';
      $label .= $record['cf_1_value'];
    }

    return $label;
  }

  // parseFromWeekViewRow - obtains field value encoded in row identifier.
  // For example, for a row id like "cl:546,bl:0,pr:23456,ts:27464,cf_1:example text"
  // requesting a client "cl" should return 546.
  static function parseFromWeekViewRow($row_id, $field_label) {
    // Find beginning of label.
    $pos = strpos($row_id, $field_label);
    if ($pos === false) return null; // Not found.

    // Strip suffix from row id.
    $suffixPos = strrpos($row_id, '_');
    if ($suffixPos)
      $remaninder = substr($row_id, 0, $suffixPos);

    // Find beginning of value.
    $posBegin = 1 + strpos($remaninder, ':', $pos);
    // Find end of value.
    $posEnd = strpos($remaninder, ',', $posBegin);
    if ($posEnd === false) $posEnd = strlen($remaninder);
    // Return value.
    return substr($remaninder, $posBegin, $posEnd - $posBegin);
  }
}
