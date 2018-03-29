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
      $custom_fields = new CustomFields($user->group_id);
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
      order by l.date, p.name, t.name, l.start, l.id";
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

  // getDataForWeekView - builds an array to render a table of durations and comments for a week view.
  // In a week view we want one row representing the same attributes to have 7 values for each day of week.
  // We identify similar records by a combination of client, billable, project, task, and custom field values.
  // This will allow us to extend the feature when more custom fields are added.
  //
  // "cl:546,bl:1,pr:23456,ts:27464,cf_1:example text"
  // The above means client 546, billable, project 23456, task 27464, custom field text "example text".
  //
  // "cl:546,bl:0,pr:23456,ts:27464,cf_1:7623"
  // The above means client 546, not billable, project 23456, task 27464, custom field option id 7623.
  //
  // Daily comments are implemented as alternate rows following week durations.
  // For example: row_0 - new entry durations, row_1 - new entry daily comments,
  //              row_2 - existing entry durations, row_3 - existing entry comments, etc.
  //
  // Description of $dataArray format that the function returns.
  // $dataArray = array(
  //   array( // Row 0. This is a special, one-off row for a new week entry with empty values.
  //     'row_id' => null, // Row identifier. Null for a new entry.
  //     'label' => 'New entry:', // Human readable label for the row describing what this time entry is for.
  //     'day_0' => array('control_id' => '0_day_0', 'tt_log_id' => null, 'duration' => null), // control_id is row_id plus day header for column.
  //     'day_1' => array('control_id' => '0_day_1', 'tt_log_id' => null, 'duration' => null),
  //     'day_2' => array('control_id' => '0_day_2', 'tt_log_id' => null, 'duration' => null),
  //     'day_3' => array('control_id' => '0_day_3', 'tt_log_id' => null, 'duration' => null),
  //     'day_4' => array('control_id' => '0_day_4', 'tt_log_id' => null, 'duration' => null),
  //     'day_5' => array('control_id' => '0_day_5', 'tt_log_id' => null, 'duration' => null),
  //     'day_6' => array('control_id' => '0_day_6', 'tt_log_id' => null, 'duration' => null)
  //   ),
  //
  //   array( // Row 1. This row represents daily comments for a new entry in row above (row 0).
  //     'row_id' => null,
  //     'label' => 'Notes:',
  //     'day_0' => array('control_id' => '1_day_0', 'tt_log_id' => null, 'note' => null),
  //     'day_1' => array('control_id' => '1_day_1', 'tt_log_id' => null, 'note' => null),
  //     'day_2' => array('control_id' => '1_day_2', 'tt_log_id' => null, 'note' => null),
  //     'day_3' => array('control_id' => '1_day_3', 'tt_log_id' => null, 'note' => null),
  //     'day_4' => array('control_id' => '1_day_4', 'tt_log_id' => null, 'note' => null),
  //     'day_5' => array('control_id' => '1_day_5', 'tt_log_id' => null, 'note' => null),
  //     'day_6' => array('control_id' => '1_day_6', 'tt_log_id' => null, 'note' => null)
  //   ),
  //
  //   array( // Row 2.
  //     'row_id' => 'cl:546,bl:1,pr:23456,ts:27464,cf_1:7623_0',
  //     'label' => 'Anuko - Time Tracker - Coding - Option 2',
  //     'day_0' => array('control_id' => '2_day_0', 'tt_log_id' => 12345, 'duration' => '00:00'),
  //     'day_1' => array('control_id' => '2_day_1', 'tt_log_id' => 12346, 'duration' => '01:00'),
  //     'day_2' => array('control_id' => '2_day_2', 'tt_log_id' => 12347, 'duration' => '02:00'),
  //     'day_3' => array('control_id' => '2_day_3', 'tt_log_id' => null, 'duration' => null),
  //     'day_4' => array('control_id' => '2_day_4', 'tt_log_id' => 12348, 'duration' => '04:00'),
  //     'day_5' => array('control_id' => '2_day_5', 'tt_log_id' => 12349, 'duration' => '04:00'),
  //     'day_6' => array('control_id' => '2_day_6', 'tt_log_id' => null, 'duration' => null)
  //   ),
  //   array( // Row 3.
  //     'row_id' => 'cl:546,bl:1,pr:23456,ts:27464,cf_1:7623_0_notes',
  //     'label' => 'Notes:',
  //     'day_0' => array('control_id' => '3_day_0', 'tt_log_id' => 12345, 'note' => 'Comment one'),
  //     'day_1' => array('control_id' => '3_day_1', 'tt_log_id' => 12346, 'note' => 'Comment two'),
  //     'day_2' => array('control_id' => '3_day_2', 'tt_log_id' => 12347, 'note' => 'Comment three'),
  //     'day_3' => array('control_id' => '3_day_3', 'tt_log_id' => null, 'note' => null),
  //     'day_4' => array('control_id' => '3_day_4', 'tt_log_id' => 12348, 'note' => 'Comment four'),
  //     'day_5' => array('control_id' => '3_day_5', 'tt_log_id' => 12349, 'note' => 'Comment five'),
  //     'day_6' => array('control_id' => '3_day_6', 'tt_log_id' => null, 'note' => null)
  //   )
  // );
  static function getDataForWeekView($records, $dayHeaders) {
    global $user;
    global $i18n;

    $dataArray = array();

    // Construct the first row for a brand new entry.
    $dataArray[] = array('row_id' => null,'label' => $i18n->get('form.week.new_entry').':'); // Insert row.
    // Insert empty cells with proper control ids.
    for ($i = 0; $i < 7; $i++) {
      $control_id = '0_'. $dayHeaders[$i];
      $dataArray[0][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'duration' => null);
    }
    if ($user->isPluginEnabled('wvns')) {
      // Construct the second row for daily comments for a brand new entry.
      $dataArray[] = array('row_id' => null,'label' => $i18n->get('label.notes').':'); // Insert row.
      // Insert empty cells with proper control ids.
      for ($i = 0; $i < 7; $i++) {
        $control_id = '1_'. $dayHeaders[$i];
        $dataArray[1][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'note' => null);
      }
    }

    // Iterate through records and build $dataArray cell by cell.
    foreach ($records as $record) {
      // Create row id without suffix.
      $row_id_no_suffix = ttWeekViewHelper::makeRowIdentifier($record);
      // Handle potential multiple records with the same attributes by using a numerical suffix.
      $suffix = 0;
      $row_id = $row_id_no_suffix.'_'.$suffix;
      $day_header = substr($record['date'], 8); // Day number in month.
      while (ttWeekViewHelper::cellExists($row_id, $day_header, $dataArray)) {
        $suffix++;
        $row_id = $row_id_no_suffix.'_'.$suffix;
      }
      // Find row.
      $pos = ttWeekViewHelper::findRow($row_id, $dataArray);
      if ($pos < 0) {
        // Insert row for durations.
        $dataArray[] = array('row_id' => $row_id,'label' => ttWeekViewHelper::makeRowLabel($record));
        $pos = ttWeekViewHelper::findRow($row_id, $dataArray);
        // Insert empty cells with proper control ids.
        for ($i = 0; $i < 7; $i++) {
          $control_id = $pos.'_'. $dayHeaders[$i];
          $dataArray[$pos][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'duration' => null);
        }
        // Insert row for comments.
        if ($user->isPluginEnabled('wvns')) {
          $dataArray[] = array('row_id' => $row_id.'_notes','label' => $i18n->get('label.notes').':');
          $pos++;
          // Insert empty cells with proper control ids.
          for ($i = 0; $i < 7; $i++) {
            $control_id = $pos.'_'. $dayHeaders[$i];
            $dataArray[$pos][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'note' => null);
          }
          $pos--;
        }
      }
      // Insert actual cell data from $record (one cell only).
      $dataArray[$pos][$day_header] = array('control_id' => $pos.'_'. $day_header, 'tt_log_id' => $record['id'],'duration' => $record['duration']);
      // Insert existing comment from $record into the comment cell.
      if ($user->isPluginEnabled('wvns')) {
        $pos++;
        $dataArray[$pos][$day_header] = array('control_id' => $pos.'_'. $day_header, 'tt_log_id' => $record['id'],'note' => $record['comment']);
      }
    }
    return $dataArray;
  }

  // prePopulateFromPastWeeks - is a complementary function to getDataForWeekView.
  // It builds an "empty" $dataArray with only labels present. Labels are taken from
  // the most recent active past week, up to 5 weeks back from now.
  // This is a data entry acceleration feature to help users quickly populate their
  // regular entry list for a new week, even after a long vacation.
  static function prePopulateFromPastWeeks($startDate, $dayHeaders) {
    global $user;
    global $i18n;

    // First, determine past week start and end dates.
    $objDate = new DateAndTime(DB_DATEFORMAT, $startDate);
    $objDate->decDay(7);
    $pastWeekStartDate = $objDate->toString(DB_DATEFORMAT);
    $objDate->incDay(6);
    $pastWeekEndDate = $objDate->toString(DB_DATEFORMAT);
    unset($objDate);

    // Obtain past week(s) records.
    $records = ttWeekViewHelper::getRecordsForInterval($user->getActiveUser(), $pastWeekStartDate, $pastWeekEndDate);
    // Handle potential situation of no records by re-trying for up to 4 more previous weeks (after a long vacation, etc.).
    if (!$records) {
      for ($i = 0; $i < 4; $i++) {
        $objDate = new DateAndTime(DB_DATEFORMAT, $pastWeekStartDate);
        $objDate->decDay(7);
        $pastWeekStartDate = $objDate->toString(DB_DATEFORMAT);
        $objDate->incDay(6);
        $pastWeekEndDate = $objDate->toString(DB_DATEFORMAT);
        unset($objDate);

        $records = ttWeekViewHelper::getRecordsForInterval($user->getActiveUser(), $pastWeekStartDate, $pastWeekEndDate);
        // Break out of the loop if we found something.
        if ($records) break;
      }
    }

    // Construct the first row for a brand new entry.
    $dataArray[] = array('row_id' => null,'label' => $i18n->get('form.week.new_entry').':'); // Insert row.
    // Insert empty cells with proper control ids.
    for ($i = 0; $i < 7; $i++) {
      $control_id = '0_'. $dayHeaders[$i];
      $dataArray[0][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'duration' => null);
    }
    // Construct the second row for daily comments for a brand new entry.
    $dataArray[] = array('row_id' => null,'label' => $i18n->get('label.notes').':'); // Insert row.
    // Insert empty cells with proper control ids.
    for ($i = 0; $i < 7; $i++) {
      $control_id = '1_'. $dayHeaders[$i];
      $dataArray[1][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'note' => null);
    }

    // Iterate through records and build an "empty" $dataArray.
    foreach ($records as $record) {
      // Create row id with 0 suffix. In prepopulated view, we only need one row for similar records.
      $row_id = ttWeekViewHelper::makeRowIdentifier($record).'_0';
      // Find row.
      $pos = ttWeekViewHelper::findRow($row_id, $dataArray);
      if ($pos < 0) {
        // Insert row for durations.
        $dataArray[] = array('row_id' => $row_id,'label' => ttWeekViewHelper::makeRowLabel($record));
        $pos = ttWeekViewHelper::findRow($row_id, $dataArray);
        // Insert empty cells with proper control ids.
        for ($i = 0; $i < 7; $i++) {
          $control_id = $pos.'_'. $dayHeaders[$i];
          $dataArray[$pos][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'duration' => null);
        }
        // Insert row for comments.
        $dataArray[] = array('row_id' => $row_id.'_notes','label' => $i18n->get('label.notes').':');
        $pos++;
        // Insert empty cells with proper control ids.
        for ($i = 0; $i < 7; $i++) {
          $control_id = $pos.'_'. $dayHeaders[$i];
          $dataArray[$pos][$dayHeaders[$i]] = array('control_id' => $control_id, 'tt_log_id' => null,'note' => null);
        }
        $pos--;
      }
    }

    return $dataArray;
  }

  // cellExists is a helper function for getDataForWeekView() to see if a cell with a given label
  // and a day header already exists.
  static function cellExists($row_id, $day_header, $dataArray) {
    foreach($dataArray as $row) {
      if ($row['row_id'] == $row_id && !empty($row[$day_header]['duration']))
        return true;
    }
    return false;
  }

  // findRow returns an existing row position in $dataArray, -1 otherwise.
  static function findRow($row_id, $dataArray) {
    $pos = 0; // Row position in array.
    foreach($dataArray as $row) {
      if ($row['row_id'] == $row_id)
        return $pos;
      $pos++; // Increment for search.
    }
    return -1; // Row not found.
  }

  // getDayTotals calculates total durations for each day from the existing data in $dataArray.
  static function getDayTotals($dataArray, $dayHeaders) {
    $dayTotals = array();

    // Insert label.
    global $i18n;
    $dayTotals['label'] = $i18n->get('label.day_total').':';

    foreach ($dataArray as $row) {
      foreach($dayHeaders as $dayHeader) {
        if (array_key_exists($dayHeader, $row)) {
          $minutes = ttTimeHelper::toMinutes($row[$dayHeader]['duration']);
          $dayTotals[$dayHeader] += $minutes;
        }
      }
    }
    // Convert minutes to hh:mm for display.
    foreach($dayHeaders as $dayHeader) {
      $dayTotals[$dayHeader] = ttTimeHelper::toAbsDuration($dayTotals[$dayHeader]);
    }
    return $dayTotals;
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

  // makeRowIdentifier - builds a string identifying a row for a week view from a single record properties.
  //                     Note that the return value is without a suffix.
  // For example:
  // "cl:546,bl:0,pr:23456,ts:27464,cf_1:example text"
  // "cl:546,bl:1,pr:23456,ts:27464,cf_1:7623"
  static function makeRowIdentifier($record) {
    global $user;
    // Start with client.
    if ($user->isPluginEnabled('cl'))
      $row_identifier = $record['client_id'] ? 'cl:'.$record['client_id'] : '';
    // Add billable flag.
    if (!empty($row_identifier)) $row_identifier .= ',';
    $row_identifier .= 'bl:'.$record['billable'];
    // Add project.
    $row_identifier .= $record['project_id'] ? ',pr:'.$record['project_id'] : '';
    // Add task.
    $row_identifier .= $record['task_id'] ? ',ts:'.$record['task_id'] : '';
    // Add custom field 1.
    if ($user->isPluginEnabled('cf')) {
      if ($record['cf_1_id'])
        $row_identifier .= ',cf_1:'.$record['cf_1_id'];
      else if ($record['cf_1_value'])
        $row_identifier .= ',cf_1:'.$record['cf_1_value'];
    }

    return $row_identifier;
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

  // dateFromDayHeader calculates date from start date and day header in week view.
  static function dateFromDayHeader($start_date, $day_header) {
    $objDate = new DateAndTime(DB_DATEFORMAT, $start_date);
    $currentDayHeader = (string) $objDate->getDate(); // It returns an int on first call.
    if (strlen($currentDayHeader) == 1)               // Which is an implementation detail of DateAndTime class.
      $currentDayHeader = '0'.$currentDayHeader;      // Add a 0 for single digit day.
    $i = 1;
    while ($currentDayHeader != $day_header && $i < 7) {
      // Iterate through remaining days to find a match.
      $objDate->incDay();
      $currentDayHeader = $objDate->getDate(); // After incDay it returns a string with leading 0, when necessary.
      $i++;
    }
    return $objDate->toString(DB_DATEFORMAT);
  }

  // insertDurationFromWeekView - inserts a new record in log tables from a week view post.
  static function insertDurationFromWeekView($fields, $custom_fields, $err) {
    global $i18n;
    global $user;

    // Determine date for a new entry.
    $entry_date = ttWeekViewHelper::dateFromDayHeader($fields['start_date'], $fields['day_header']);
    $objEntryDate = new DateAndTime(DB_DATEFORMAT, $entry_date);

    // Prohibit creating entries in future.
    if (!$user->future_entries && $fields['browser_today']) {
      $objBrowserToday = new DateAndTime(DB_DATEFORMAT, $fields['browser_today']);
      if ($objEntryDate->after($objBrowserToday)) {
        $err->add($i18n->get('error.future_date'));
        return false;
      }
    }

    // Prepare an array of fields for regular insert function.
    $fields4insert = array();
    $fields4insert['user_id'] = $user->getActiveUser();
    $fields4insert['date'] = $entry_date;
    $fields4insert['duration'] = $fields['duration'];
    $fields4insert['client'] = ttWeekViewHelper::parseFromWeekViewRow($fields['row_id'], 'cl');
    $fields4insert['billable'] = ttWeekViewHelper::parseFromWeekViewRow($fields['row_id'], 'bl');
    $fields4insert['project'] = ttWeekViewHelper::parseFromWeekViewRow($fields['row_id'], 'pr');
    $fields4insert['task'] = ttWeekViewHelper::parseFromWeekViewRow($fields['row_id'], 'ts');
    $fields4insert['note'] = $fields['note'];

    // Try to insert a record.
    $id = ttTimeHelper::insert($fields4insert);
    if (!$id) return false; // Something failed.

    // Insert custom field if we have it.
    $result = true;
    $cf_1 = ttWeekViewHelper::parseFromWeekViewRow($fields['row_id'], 'cf_1');
    if ($custom_fields && $cf_1) {
      if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
        $result = $custom_fields->insert($id, $custom_fields->fields[0]['id'], null, $cf_1);
      elseif ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
        $result = $custom_fields->insert($id, $custom_fields->fields[0]['id'], $cf_1, null);
    }

    return $result;
  }

  // modifyDurationFromWeekView - modifies a duration of an existing record from a week view post.
  static function modifyDurationFromWeekView($fields, $err) {
    global $i18n;
    global $user;

    // Possible errors: 1) Overlap if the existing record has start time. 2) Going beyond 24 hour boundary.
    if (!ttWeekViewHelper::canModify($fields['tt_log_id'], $fields['duration'], $err))
      return false;

    $mdb2 = getConnection();
    $duration = $fields['duration'];
    $tt_log_id = $fields['tt_log_id'];
    $user_id = $user->getActiveUser();
    $sql = "update tt_log set duration = '$duration' where id = $tt_log_id and user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // canModify - determines if an  already existing tt_log record
  // can be modified with a new user-provided duration.
  static function canModify($tt_log_id, $new_duration, $err) {
    global $i18n;
    $mdb2 = getConnection();

    // Determine if we have start time in record, as further checking does not makes sense otherwise.
    $sql = "select user_id, date, start, duration from tt_log  where id = $tt_log_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        $err->add($i18n->get('error.db')); // This is not expected.
        return false;
      }
      $val = $res->fetchRow();
      $oldDuration = $val['duration'];
      if (!$val['start'])
        return true; // There is no start time in the record, therefore safe to modify.
    }

    // We do have start time.
    // Quick test if new duration is less then already existing.
    $newMinutes = ttTimeHelper::toMinutes($new_duration);
    $oldMinutes = ttTimeHelper::toMinutes($oldDuration);
    if ($newMinutes < $oldMinutes)
      return true; // Safe to modify.

    // Does the new duration put the record beyond 24:00 boundary?
    $startMinutes = ttTimeHelper::toMinutes($val['start']);
    $newEndMinutes = $startMinutes + $newMinutes;
    if ($newEndMinutes > 1440) {
      // Invalid duration, as new duration puts the record beyond current day.
      $err->add($i18n->get('error.field'), $i18n->get('label.duration'));
      return false;
    }

    // Does the new duration causes the record to overlap with others?
    $user_id = $val['user_id'];
    $date = $val['date'];
    $startMinutes = ttTimeHelper::toMinutes($val['start']);
    $start = ttTimeHelper::toAbsDuration($startMinutes);
    $finish = ttTimeHelper::toAbsDuration($newEndMinutes);
    if (ttTimeHelper::overlaps($user_id, $date, $start, $finish, $tt_log_id)) {
      $err->add($i18n->get('error.overlap'));
      return false;
    }

    return true; // There are no conflicts, safe to modify.
  }

  // modifyCommentFromWeekView - modifies a comment in an existing record from a week view post.
  static function modifyCommentFromWeekView($fields) {
    global $user;

    $mdb2 = getConnection();
    $tt_log_id = $fields['tt_log_id'];
    $comment = $fields['comment'];
    $user_id = $user->getActiveUser();
    $sql = "update tt_log set comment = ".$mdb2->quote($fields['comment'])." where id = $tt_log_id and user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }
}
