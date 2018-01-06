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

  // getRecordsForInterval - returns time records for a user for a given interval of dates.
  static function getRecordsForInterval($user_id, $start_date, $end_date) {
    global $user;
    $sql_time_format = "'%k:%i'"; //  24 hour format.
    if ('%I:%M %p' == $user->time_format)
      $sql_time_format = "'%h:%i %p'"; // 12 hour format for MySQL TIME_FORMAT function.

    $result = array();
    $mdb2 = getConnection();

    $client_field = null;
    if ($user->isPluginEnabled('cl'))
      $client_field = ', c.id as client_id, c.name as client';

    $custom_field_1 = null;
    if ($user->isPluginEnabled('cf')) {
      $custom_fields = new CustomFields($user->team_id);
      $cf_1_type = $custom_fields->fields[0]['type'];
      if ($cf_1_type == CustomFields::TYPE_TEXT) {
        $custom_field_1 = ', cfl.value as cf_1_value';
      } elseif ($cf_1_type == CustomFields::TYPE_DROPDOWN) {
        $custom_field_1 = ', cfo.id as cf_1_id, cfo.value as cf_1_value';
      }
    }

    $left_joins = " left join tt_projects p on (l.project_id = p.id)".
      " left join tt_tasks t on (l.task_id = t.id)";
    if ($user->isPluginEnabled('cl'))
      $left_joins .= " left join tt_clients c on (l.client_id = c.id)";
    if ($user->isPluginEnabled('cf')) {
      if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
        $left_joins .= 'left join tt_custom_field_log cfl on (l.id = cfl.log_id and cfl.status = 1) left join tt_custom_field_options cfo on (cfl.value = cfo.id) ';
      elseif ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
        $left_joins .= 'left join tt_custom_field_log cfl on (l.id = cfl.log_id and cfl.status = 1) left join tt_custom_field_options cfo on (cfl.option_id = cfo.id) ';
    }

    $sql = "select l.id as id, l.date as date, TIME_FORMAT(l.start, $sql_time_format) as start,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), $sql_time_format) as finish,
      TIME_FORMAT(l.duration, '%k:%i') as duration, p.id as project_id, p.name as project,
      t.id as task_id, t.name as task, l.comment, l.billable, l.invoice_id $client_field $custom_field_1
      from tt_log l
      $left_joins
      where l.date >= '$start_date' and l.date <= '$end_date' and l.user_id = $user_id and l.status = 1
      order by p.name, t.name, l.date, l.start, l.id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        if($val['duration']=='0:00')
          $val['finish'] = '';
        $result[] = $val;
      }
    } else return false;

    return $result;
  }

  // getDataForWeekView - builds an array to render a table of durations for week view.
  // In a week view we want one row representing the same attributes to have 7 values for each day of week.
  // We identify simlar records by a combination of client, billable, project, task, and custom field values.
  // This will allow us to extend the feature when more custom fields are added.
  //
  // "cl:546,bl:1,pr:23456,ts:27464,cf_1:example text"
  // The above means client 546, billable, project 23456, task 27464, custom field text "example text".
  //
  // "cl:546,bl:0,pr:23456,ts:27464,cf_1:7623"
  // The above means client 546, not billable, project 23456, task 27464, custom field option id 7623.
  //
  // Description of $dataArray format that the function returns.
  // $dataArray = array(
  //   array( // Row 0. This is a special, one-off row for a new week entry with empty values.
  //     'row_id' => null', // Row identifier. Null for a new entry.
  //     'label' => 'New entry', // Human readable label for the row describing what this time entry is for.
  //     'day_0' => array('control_id' => '0_day_0', 'tt_log_id' => null, 'duration' => null), // control_id is row_id plus day header for column.
  //     'day_1' => array('control_id' => '0_day_1', 'tt_log_id' => null, 'duration' => null),
  //     'day_2' => array('control_id' => '0_day_2', 'tt_log_id' => null, 'duration' => null),
  //     'day_3' => array('control_id' => '0_day_3', 'tt_log_id' => null, 'duration' => null),
  //     'day_4' => array('control_id' => '0_day_4', 'tt_log_id' => null, 'duration' => null),
  //     'day_5' => array('control_id' => '0_day_5', 'tt_log_id' => null, 'duration' => null),
  //     'day_6' => array('control_id' => '0_day_6', 'tt_log_id' => null, 'duration' => null)
  //   ),
  //   array( // Row 1.
  //     'row_id' => 'cl:546,bl:1,pr:23456,ts:27464,cf_1:7623_0', // Row identifier. See ttTimeHelper::makeRecordIdentifier().
  //     'label' => 'Anuko - Time Tracker - Coding',              // Human readable label for the row describing what this time entry is for.
  //     'day_0' => array('control_id' => '1_day_0', 'tt_log_id' => 12345, 'duration' => '00:00'), // control_id is row_id plus day header for column.
  //     'day_1' => array('control_id' => '1_day_1', 'tt_log_id' => 12346, 'duration' => '01:00'),
  //     'day_2' => array('control_id' => '1_day_2', 'tt_log_id' => 12347, 'duration' => '02:00'),
  //     'day_3' => array('control_id' => '1_day_3', 'tt_log_id' => null, 'duration' => null),
  //     'day_4' => array('control_id' => '1_day_4', 'tt_log_id' => 12348, 'duration' => '04:00'),
  //     'day_5' => array('control_id' => '1_day_5', 'tt_log_id' => 12349, 'duration' => '04:00'),
  //     'day_6' => array('control_id' => '1_day_6', 'tt_log_id' => null, 'duration' => null)
  //   ),
  //   array( // Row 2.
  //     'row_id' => 'bl:0_0',
  //     'label' => '', // In this case the label is empty as we don't have anything to put into it, as we only have billable flag.
  //     'day_0' => array('control_id' => '2_day_0', 'tt_log_id' => null, 'duration' => null),
  //     'day_1' => array('control_id' => '2_day_1', 'tt_log_id' => 12350, 'duration' => '01:30'),
  //     'day_2' => array('control_id' => '2_day_2', 'tt_log_id' => null, 'duration' => null),
  //     'day_3' => array('control_id' => '2_day_3', 'tt_log_id' => 12351,'duration' => '02:30'),
  //     'day_4' => array('control_id' => '2_day_4', 'tt_log_id' => 12352, 'duration' => '04:00'),
  //     'day_5' => array('control_id' => '2_day_5', 'tt_log_id' => null, 'duration' => null),
  //     'day_6' => array('control_id' => '2_day_6', 'tt_log_id' => null, 'duration' => null)
  //   )
  // );
  static function getDataForWeekView($user_id, $start_date, $end_date, $dayHeaders) {
    global $i18n;

    // Start by obtaining all records in interval.
    $records = ttWeekViewHelper::getRecordsForInterval($user_id, $start_date, $end_date);

    $dataArray = array();

    // Construct the first row for a brand new entry.
    $dataArray[] = array('row_id' => null,'label' => $i18n->getKey('form.week.new_entry')); // Insert row.
    // Insert empty cells with proper control ids.
    for ($i = 0; $i < 7; $i++) {
      $control_id = '0_'. $dayHeaders[$i];
      $dataArray[0][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'duration' => null);
    }

    // Iterate through records and build $dataArray cell by cell.
    foreach ($records as $record) {
      // Create record id without suffix.
      $record_id_no_suffix = ttTimeHelper::makeRecordIdentifier($record);
      // Handle potential multiple records with the same attributes by using a numerical suffix.
      $suffix = 0;
      $record_id = $record_id_no_suffix.'_'.$suffix;
      $day_header = substr($record['date'], 8); // Day number in month.
      while (ttTimeHelper::cellExists($record_id, $day_header, $dataArray)) {
        $suffix++;
        $record_id = $record_id_no_suffix.'_'.$suffix;
      }
      // Find row.
      $pos = ttTimeHelper::findRow($record_id, $dataArray);
      if ($pos < 0) {
        $dataArray[] = array('row_id' => $record_id,'label' => ttWeekViewHelper::makeRowLabel($record)); // Insert row.
        $pos = ttTimeHelper::findRow($record_id, $dataArray);
        // Insert empty cells with proper control ids.
        for ($i = 0; $i < 7; $i++) {
          $control_id = $pos.'_'. $dayHeaders[$i];
          $dataArray[$pos][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'duration' => null);
        }
      }
      // Insert actual cell data from $record (one cell only).
      $dataArray[$pos][$day_header] = array('control_id' => $pos.'_'. $day_header, 'tt_log_id' => $record['id'],'duration' => $record['duration']);
    }
    return $dataArray;
  }

  // getDayHeadersForWeek - obtains day column headers for week view, which are simply day numbers in month.
  static function getDayHeadersForWeek($start_date) {
    $dayHeaders = array();
    $objDate = new DateAndTime(DB_DATEFORMAT, $start_date);
    $dayHeaders[] = (string) $objDate->getDate(); // It returns an int on first call.
    if (strlen($dayHeaders[0]) == 1)              // Which is an implementation detail of DateAndTime class.
      $dayHeaders[0] = '0'.$dayHeaders[0];        // Add a 0 for single digit day.
    $objDate->incDay();
    $dayHeaders[] = $objDate->getDate(); // After incDay it returns a string with leading 0, when necessary.
    $objDate->incDay();
    $dayHeaders[] = $objDate->getDate();
    $objDate->incDay();
    $dayHeaders[] = $objDate->getDate();
    $objDate->incDay();
    $dayHeaders[] = $objDate->getDate();
    $objDate->incDay();
    $dayHeaders[] = $objDate->getDate();
    $objDate->incDay();
    $dayHeaders[] = $objDate->getDate();
    unset($objDate);
    return $dayHeaders;
  }

  // getLockedDaysForWeek - builds an array of locked days in week.
  static function getLockedDaysForWeek($start_date) {
    global $user;
    $lockedDays = array();
    $objDate = new DateAndTime(DB_DATEFORMAT, $start_date);
    for ($i = 0; $i < 7; $i++) {
      $lockedDays[] = $user->isDateLocked($objDate);
      $objDate->incDay();
    }
    unset($objDate);
    return $lockedDays;
  }

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
