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

import('DateAndTime');

// The ttTimeHelper is a class to help with time-related values.
class ttTimeHelper {

  // isWeekend determines if $date falls on weekend.
  static function isWeekend($date) {
    $weekDay = date('w', strtotime($date));
    return ($weekDay == WEEKEND_START_DAY || $weekDay == (WEEKEND_START_DAY + 1) % 7);
  }

  // isHoliday determines if $date falls on a holiday.
  static function isHoliday($date) {
    global $i18n;
    // $date is expected as string in DB_DATEFORMAT.
    $month = date('m', strtotime($date));
    $day = date('d', strtotime($date));
    if (in_array($month.'/'.$day, $i18n->holidays))
      return true;

    return false;
  }

  // isValidTime validates a value as a time string.
  static function isValidTime($value) {
    if (strlen($value)==0 || !isset($value)) return false;

    // 24 hour patterns.
    if ($value == '24:00' || $value == '2400') return true;

    if (preg_match('/^([0-1]{0,1}[0-9]|[2][0-3]):?[0-5][0-9]$/', $value )) { // 0:00 - 23:59, 000 - 2359
      return true;
    }
    if (preg_match('/^([0-1]{0,1}[0-9]|[2][0-4])$/', $value )) { // 0 - 24
      return true;
    }

    // 12 hour patterns
    if (preg_match('/^[1-9]\s?(am|AM|pm|PM)$/', $value)) { // 1 - 9 am
      return true;
    }
    if (preg_match('/^(0[1-9]|1[0-2])\s?(am|AM|pm|PM)$/', $value)) { // 01 - 12 am
      return true;
    }
    if (preg_match('/^[1-9]:?[0-5][0-9]\s?(am|AM|pm|PM)$/', $value)) { // 1:00 - 9:59 am, 100 - 959 am
      return true;
    }
    if (preg_match('/^(0[1-9]|1[0-2]):?[0-5][0-9]\s?(am|AM|pm|PM)$/', $value)) { // 01:00 - 12:59 am, 0100 - 1259 am
      return true;
    }

    return false;
  }

  // isValidDuration validates a value as a time duration string (in hours and minutes).
  static function isValidDuration($value) {
    if (strlen($value)==0 || !isset($value)) return false;

    if ($value == '24:00' || $value == '2400') return true;

    if (preg_match('/^([0-1]{0,1}[0-9]|2[0-3]):?[0-5][0-9]$/', $value )) { // 0:00 - 23:59, 000 - 2359
      if ('00:00' == ttTimeHelper::normalizeDuration($value))
        return false;
      return true;
    }
    if (preg_match('/^([0-1]{0,1}[0-9]|2[0-4])h?$/', $value )) { // 0, 1 ... 24
      if ('00:00' == ttTimeHelper::normalizeDuration($value))
        return false;
      return true;
    }
    if (preg_match('/^([0-1]{0,1}[0-9]|2[0-3])?[.][0-9]{1,4}h?$/', $value )) { // decimal values like 0.5, 1.25h, ... .. 23.9999h
      if ('00:00' == ttTimeHelper::normalizeDuration($value))
        return false;
      return true;
    }

    return false;
  }

  // normalizeDuration - converts a valid time duration string to format 00:00.
  static function normalizeDuration($value) {
    $time_value = $value;

    // If we have a decimal format - convert to time format 00:00.
    if((strpos($time_value, '.') !== false) || (strpos($time_value, 'h') !== false)) {
      $val = floatval($time_value);
      $mins = round($val * 60);
      $hours = (string)((int)($mins / 60));
      $mins = (string)($mins % 60);
      if (strlen($hours) == 1)
        $hours = '0'.$hours;
      if (strlen($mins) == 1)
        $mins = '0' . $mins;
      return $hours.':'.$mins;
    }

    $time_a = explode(':', $time_value);
    $res = '';

    // 0-99
    if ((strlen($time_value) >= 1) && (strlen($time_value) <= 2) && !isset($time_a[1])) {
      $hours = $time_a[0];
      if (strlen($hours) == 1)
        $hours = '0'.$hours;
       return $hours.':00';
    }

    // 000-2359 (2400)
    if ((strlen($time_value) >= 3) && (strlen($time_value) <= 4) && !isset($time_a[1])) {
      if (strlen($time_value)==3) $time_value = '0'.$time_value;
      $hours = substr($time_value,0,2);
      if (strlen($hours) == 1)
        $hours = '0'.$hours;
      return $hours.':'.substr($time_value,2,2);
    }

    // 0:00-23:59 (24:00)
    if ((strlen($time_value) >= 4) && (strlen($time_value) <= 5) && isset($time_a[1])) {
      $hours = $time_a[0];
      if (strlen($hours) == 1)
        $hours = '0'.$hours;
      return $hours.':'.$time_a[1];
    }

    return $res;
  }

  // toMinutes - converts a time string in format 00:00 to a number of minutes.
  static function toMinutes($value) {
    $time_a = explode(':', $value);
    return (int)@$time_a[1] + ((int)@$time_a[0]) * 60;
  }

  // toAbsDuration - converts a number of minutes to format 00:00
  // even if $minutes is negative.
  static function toAbsDuration($minutes){
    $hours = (string)((int)abs($minutes / 60));
    $mins = (string)(abs($minutes % 60));
    if (strlen($hours) == 1)
      $hours = '0'.$hours;
    if (strlen($mins) == 1)
      $mins = '0' . $mins;
    return $hours.':'.$mins;
  }

  // toDuration - calculates duration between start and finish times in 00:00 format.
  static function toDuration($start, $finish) {
    $duration_minutes = ttTimeHelper::toMinutes($finish) - ttTimeHelper::toMinutes($start);
    if ($duration_minutes <= 0) return false;

    return ttTimeHelper::toAbsDuration($duration_minutes);
  }

  // The to12HourFormat function converts a 24-hour time value (such as 15:23) to 12 hour format (03:23 PM).
  static function to12HourFormat($value) {
    if ('24:00' == $value) return '12:00 AM';

    $time_a = explode(':', $value);
    if ($time_a[0] > 12)
      $res = (string)((int)$time_a[0] - 12).':'.$time_a[1].' PM';
    elseif ($time_a[0] == 12)
      $res = $value.' PM';
    elseif ($time_a[0] == 0)
      $res = '12:'.$time_a[1].' AM';
    else
      $res = $value.' AM';
    return $res;
  }

  // The to24HourFormat function attempts to convert a string value (human readable notation of time of day)
  // to a 24-hour time format HH:MM.
  static function to24HourFormat($value) {
    $res = null;

    // Algorithm: use regular expressions to find a matching pattern, starting with most popular patterns first.
    $tmp_val = trim($value);

    // 24 hour patterns.
    if (preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $tmp_val)) { // 00:00 - 23:59
      // We already have a 24-hour format. Just return it.
      $res = $tmp_val;
      return $res;
    }
    if (preg_match('/^[0-9]:[0-5][0-9]$/', $tmp_val)) { // 0:00 - 9:59
      // This is a 24-hour format without a leading zero. Add 0 and return.
      $res = '0'.$tmp_val;
      return $res;
    }
    if (preg_match('/^[0-9]$/', $tmp_val)) { // 0 - 9
      // Single digit. Assuming hour number.
      $res = '0'.$tmp_val.':00';
      return $res;
    }
    if (preg_match('/^([01][0-9]|2[0-4])$/', $tmp_val)) { // 00 - 24
      // Two digit hour number.
      $res = $tmp_val.':00';
      return $res;
    }
    if (preg_match('/^[0-9][0-5][0-9]$/', $tmp_val)) { // 000 - 959
      // Missing colon. We'll assume the first digit is the hour, the rest is minutes.
      $tmp_arr = str_split($tmp_val);
      $res = '0'.$tmp_arr[0].':'.$tmp_arr[1].$tmp_arr[2];
      return $res;
    }
    if (preg_match('/^([01][0-9]|2[0-3])[0-5][0-9]$/', $tmp_val)) { // 0000 - 2359
      // Missing colon. We'll assume the first 2 digits are the hour, the rest is minutes.
      $tmp_arr = str_split($tmp_val);
      $res = $tmp_arr[0].$tmp_arr[1].':'.$tmp_arr[2].$tmp_arr[3];
      return $res;
    }
    // Special handling for midnight.
    if ($tmp_val == '24:00' || $tmp_val == '2400')
      return '24:00';

    // 12 hour AM patterns.
    if (preg_match('/.(am|AM)$/', $tmp_val)) {

      // The $value ends in am or AM. Strip it.
      $tmp_val = rtrim(substr($tmp_val, 0, -2));

      // Special case to handle 12, 12:MM, and 12MM AM.
      if (preg_match('/^12:?([0-5][0-9])?$/', $tmp_val))
        $tmp_val = '00'.substr($tmp_val, 2);

      // We are ready to convert AM time.
      if (preg_match('/^(0[0-9]|1[0-1]):[0-5][0-9]$/', $tmp_val)) { // 00:00 - 11:59
        // We already have a 24-hour format. Just return it.
        $res = $tmp_val;
        return $res;
      }
      if (preg_match('/^[1-9]:[0-5][0-9]$/', $tmp_val)) { // 1:00 - 9:59
        // This is a 24-hour format without a leading zero. Add 0 and return.
        $res = '0'.$tmp_val;
        return $res;
      }
      if (preg_match('/^[1-9]$/', $tmp_val)) { // 1 - 9
        // Single digit. Assuming hour number.
        $res = '0'.$tmp_val.':00';
        return $res;
      }
      if (preg_match('/^(0[0-9]|1[0-1])$/', $tmp_val)) { // 00 - 11
        // Two digit hour number.
        $res = $tmp_val.':00';
        return $res;
      }
      if (preg_match('/^[1-9][0-5][0-9]$/', $tmp_val)) { // 100 - 959
        // Missing colon. Assume the first digit is the hour, the rest is minutes.
        $tmp_arr = str_split($tmp_val);
        $res = '0'.$tmp_arr[0].':'.$tmp_arr[1].$tmp_arr[2];
        return $res;
      }
      if (preg_match('/^(0[0-9]|1[0-1])[0-5][0-9]$/', $tmp_val)) { // 0000 - 1159
        // Missing colon. We'll assume the first 2 digits are the hour, the rest is minutes.
        $tmp_arr = str_split($tmp_val);
        $res = $tmp_arr[0].$tmp_arr[1].':'.$tmp_arr[2].$tmp_arr[3];
        return $res;
      }
    } // AM cases handling.

    // 12 hour PM patterns.
    if (preg_match('/.(pm|PM)$/', $tmp_val)) {

      // The $value ends in pm or PM. Strip it.
      $tmp_val = rtrim(substr($tmp_val, 0, -2));

      if (preg_match('/^[1-9]$/', $tmp_val)) { // 1 - 9
        // Single digit. Assuming hour number.
        $hour = (string)(12 + (int)$tmp_val);
        $res = $hour.':00';
        return $res;
      }
      if (preg_match('/^((0[1-9])|(1[0-2]))$/', $tmp_val)) { // 01 - 12
        // Double digit hour.
        if ('12' != $tmp_val)
          $tmp_val = (string)(12 + (int)$tmp_val);
        $res = $tmp_val.':00';
        return $res;
      }
      if (preg_match('/^[1-9][0-5][0-9]$/', $tmp_val)) { // 100 - 959
        // Missing colon. We'll assume the first digit is the hour, the rest is minutes.
        $tmp_arr = str_split($tmp_val);
        $hour = (string)(12 + (int)$tmp_arr[0]);
        $res = $hour.':'.$tmp_arr[1].$tmp_arr[2];
        return $res;
      }
      if (preg_match('/^(0[1-9]|1[0-2])[0-5][0-9]$/', $tmp_val)) { // 0100 - 1259
        // Missing colon. We'll assume the first 2 digits are the hour, the rest is minutes.
        $hour = substr($tmp_val, 0, -2);
        $min = substr($tmp_val, 2);
        if ('12' != $hour)
          $hour = (string)(12 + (int)$hour);
        $res = $hour.':'.$min;
        return $res;
      }
      if (preg_match('/^[1-9]:[0-5][0-9]$/', $tmp_val)) { // 1:00 - 9:59
        $hour = substr($tmp_val, 0, -3);
        $min = substr($tmp_val, 2);
        $hour = (string)(12 + (int)$hour);
        $res = $hour.':'.$min;
        return $res;
      }
      if (preg_match('/^(0[1-9]|1[0-2]):[0-5][0-9]$/', $tmp_val)) { // 01:00 - 12:59
        $hour = substr($tmp_val, 0, -3);
        $min = substr($tmp_val, 3);
        if ('12' != $hour)
          $hour = (string)(12 + (int)$hour);
        $res = $hour.':'.$min;
        return $res;
      }
    } // PM cases handling.

    return $res;
  }

  // isValidInterval - checks if finish time is greater than start time.
  static function isValidInterval($start, $finish) {
    $start = ttTimeHelper::to24HourFormat($start);
    $finish = ttTimeHelper::to24HourFormat($finish);
    if ('00:00' == $finish) $finish = '24:00';

    $minutesStart = ttTimeHelper::toMinutes($start);
    $minutesFinish = ttTimeHelper::toMinutes($finish);
    if ($minutesFinish > $minutesStart)
      return true;

    return false;
  }

  // insert - inserts a time record into log table. Does not deal with custom fields.
  static function insert($fields)
  {
    $mdb2 = getConnection();

    $timestamp = isset($fields['timestamp']) ? $fields['timestamp'] : '';
    $user_id = $fields['user_id'];
    $date = $fields['date'];
    $start = $fields['start'];
    $finish = $fields['finish'];
    $duration = $fields['duration'];
    $client = $fields['client'];
    $project = $fields['project'];
    $task = $fields['task'];
    $invoice = $fields['invoice'];
    $note = $fields['note'];
    $billable = $fields['billable'];
    if (array_key_exists('status', $fields)) { // Key exists and may be NULL during migration of data.
      $status_f = ', status';
      $status_v = ', '.$mdb2->quote($fields['status']);
    }

    $start = ttTimeHelper::to24HourFormat($start);
    if ($finish) {
      $finish = ttTimeHelper::to24HourFormat($finish);
      if ('00:00' == $finish) $finish = '24:00';
    }
    $duration = ttTimeHelper::normalizeDuration($duration);

    if (!$timestamp) {
      $timestamp = date('YmdHis'); //yyyymmddhhmmss
      // TODO: this timestamp could be illegal if we hit inside DST switch deadzone, such as '2016-03-13 02:30:00'
      // Anything between 2am and 3am on DST introduction date will not work if we run on a system with DST on.
      // We need to address this properly to avoid potential complications.
    }

    if (!$billable) $billable = 0;

    if ($duration) {
      $sql = "insert into tt_log (timestamp, user_id, date, duration, client_id, project_id, task_id, invoice_id, comment, billable $status_f) ".
        "values ('$timestamp', $user_id, ".$mdb2->quote($date).", '$duration', ".$mdb2->quote($client).", ".$mdb2->quote($project).", ".$mdb2->quote($task).", ".$mdb2->quote($invoice).", ".$mdb2->quote($note).", $billable $status_v)";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    } else {
      $duration = ttTimeHelper::toDuration($start, $finish);
      if ($duration === false) $duration = 0;
      if (!$duration && ttTimeHelper::getUncompleted($user_id)) return false;

      $sql = "insert into tt_log (timestamp, user_id, date, start, duration, client_id, project_id, task_id, invoice_id, comment, billable $status_f) ".
        "values ('$timestamp', $user_id, ".$mdb2->quote($date).", '$start', '$duration', ".$mdb2->quote($client).", ".$mdb2->quote($project).", ".$mdb2->quote($task).", ".$mdb2->quote($invoice).", ".$mdb2->quote($note).", $billable $status_v)";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }

    $id = $mdb2->lastInsertID('tt_log', 'id');
    return $id;
  }

  // update - updates a record in log table. Does not update its custom fields.
  static function update($fields)
  {
    $mdb2 = getConnection();

    $id = $fields['id'];
    $date = $fields['date'];
    $user_id = $fields['user_id'];
    $client = $fields['client'];
    $project = $fields['project'];
    $task = $fields['task'];
    $start = $fields['start'];
    $finish = $fields['finish'];
    $duration = $fields['duration'];
    $note = $fields['note'];
    $billable = $fields['billable'];

    $start = ttTimeHelper::to24HourFormat($start);
    $finish = ttTimeHelper::to24HourFormat($finish);
    if ('00:00' == $finish) $finish = '24:00';
    $duration = ttTimeHelper::normalizeDuration($duration);

    if (!$billable) $billable = 0;
    if ($start) $duration = '';

    if ($duration) {
      $sql = "UPDATE tt_log set start = NULL, duration = '$duration', client_id = ".$mdb2->quote($client).", project_id = ".$mdb2->quote($project).", task_id = ".$mdb2->quote($task).", ".
        "comment = ".$mdb2->quote($note).", billable = $billable, date = '$date' WHERE id = $id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    } else {
      $duration = ttTimeHelper::toDuration($start, $finish);
      if ($duration === false)
        $duration = 0;
      $uncompleted = ttTimeHelper::getUncompleted($user_id);
      if (!$duration && $uncompleted && ($uncompleted['id'] != $id))
        return false;

      $sql = "UPDATE tt_log SET start = '$start', duration = '$duration', client_id = ".$mdb2->quote($client).", project_id = ".$mdb2->quote($project).", task_id = ".$mdb2->quote($task).", ".
        "comment = ".$mdb2->quote($note).", billable = $billable, date = '$date' WHERE id = $id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }
    return true;
  }

  // delete - deletes a record from tt_log table and its associated custom field values.
  static function delete($id, $user_id) {
    $mdb2 = getConnection();

    $sql = "update tt_log set status = NULL where id = $id and user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $sql = "update tt_custom_field_log set status = NULL where log_id = $id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // getTimeForDay - gets total time for a user for a specific date.
  static function getTimeForDay($user_id, $date) {
    $mdb2 = getConnection();

    if ($date instanceof DateAndTime){
      $date = $date->toString(DB_DATEFORMAT);
    }

    $sql = "select sum(time_to_sec(duration)) as sm from tt_log where user_id = $user_id and date = '$date' and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return sec_to_time_fmt_hm($val['sm']);
    }
    return false;
  }

  // getTimeForWeek - gets total time for a user for a given week.
  static function getTimeForWeek($user_id, $date) {
    import('Period');
    $mdb2 = getConnection();

    $period = new Period(INTERVAL_THIS_WEEK, $date);
    $sql = "select sum(time_to_sec(duration)) as sm from tt_log where user_id = $user_id and date >= '".$period->getBeginDate(DB_DATEFORMAT)."' and date <= '".$period->getEndDate(DB_DATEFORMAT)."' and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return sec_to_time_fmt_hm($val['sm']);
    }
    return 0;
  }

  // getTimeForMonth - gets total time for a user for a given month.
  static function getTimeForMonth($user_id, $date){
    import('Period');
    $mdb2 = getConnection();

    $period = new Period(INTERVAL_THIS_MONTH, $date);
    $sql = "select sum(time_to_sec(duration)) as sm from tt_log where user_id = $user_id and date >= '".$period->getBeginDate(DB_DATEFORMAT)."' and date <= '".$period->getEndDate(DB_DATEFORMAT)."' and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return sec_to_time_fmt_hm($val['sm']);
    }
    return 0;
  }

  // getUncompleted - retrieves an uncompleted record for user, if one exists.
  static function getUncompleted($user_id) {
    $mdb2 = getConnection();

    $sql = "SELECT tl.id, tl.start 
            FROM tt_log tl
            left join tt_tasks ts on ts.id = tl.task_id
            where tl.start is not null
            AND tl.user_id = $user_id
            and time_to_sec(tl.duration) = 0 
            and tl.status = 1 
            and ts.allow_zero_duration <> 1";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  } 

  // getPotentiallyUncompleted gets recrods that would go to status uncompleted if
  // tasks allow_zeor_duration flag would change to false
  static function getPotentiallyUncompleted($task_id){
      $mdb2 = getConnection();
      $sql = "SELECT tl.id
              FROM tt_log tl
              LEFT JOIN tt_tasks ts on ts.id = tl.task_id
              WHERE time_to_sec(tl.duration) = 0
              AND tl.status = 1
              and ts.id = $task_id";

      $res = $mdb2->query($sql);

      if (!is_a($res, 'PEAR_Error')) {
        while ($val = $res->fetchRow()) {
          $result[] = $val;
        }
      } else return false;

      return $result;
  }

  // overlaps - determines if a record overlaps with an already existing record.
  //
  // Parameters:
  //   $user_id - user id for whom to determine overlap
  //   $date - date
  //   $start - new record start time
  //   $finish - new record finish time, may be null
  //   $record_id - optional record id we may be editing, excluded from overlap set
  static function overlaps($user_id, $date, $start, $finish, $record_id = null) {
    // Do not bother checking if we allow overlaps.
    if (defined('ALLOW_OVERLAP') && ALLOW_OVERLAP == true)
      return false;

    $mdb2 = getConnection();

    if ($date instanceof DateAndTime){
      $date = $date->toString(DB_DATEFORMAT);
    }

    $start = ttTimeHelper::to24HourFormat($start);
    if ($finish) {
      $finish = ttTimeHelper::to24HourFormat($finish);
      if ('00:00' == $finish) $finish = '24:00';
    }
    // Handle these 3 overlap situations:
    // - start time in existing record
    // - end time in existing record
    // - record fully encloses existing record
    $sql = "select id from tt_log  
      where user_id = $user_id and date = ".$mdb2->quote($date)."
      and start is not null and duration is not null and status = 1 and (
      (cast(".$mdb2->quote($start)." as time) >= start and cast(".$mdb2->quote($start)." as time) < addtime(start, duration))";
    if ($finish) {
      $sql .= " or (cast(".$mdb2->quote($finish)." as time) <= addtime(start, duration) and cast(".$mdb2->quote($finish)." as time) > start)
      or (cast(".$mdb2->quote($start)." as time) < start and cast(".$mdb2->quote($finish)." as time) > addtime(start, duration))";
    }
    $sql .= ")";
    if ($record_id) {
      $sql .= " and id <> $record_id";
    }
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }

  // getRecord - retrieves a time record identified by its id.
  static function getRecord($id, $user_id) {
    global $user;
    $sql_time_format = "'%k:%i'"; //  24 hour format.
    if ('%I:%M %p' == $user->time_format)
      $sql_time_format = "'%h:%i %p'"; // 12 hour format for MySQL TIME_FORMAT function.

    $mdb2 = getConnection();

    $sql = "select l.id as id, l.timestamp as timestamp, TIME_FORMAT(l.start, $sql_time_format) as start,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), $sql_time_format) as finish,
      TIME_FORMAT(l.duration, '%k:%i') as duration, t.allow_zero_duration,
      p.name as project_name, t.name as task_name, l.comment, l.client_id, l.project_id, l.task_id, l.invoice_id, l.billable, l.date
      from tt_log l
      left join tt_projects p on (p.id = l.project_id)
      left join tt_tasks t on (t.id = l.task_id)
      where l.id = $id and l.user_id = $user_id and l.status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }

  // getAllRecords - returns all time records for a certain user.
  static function getAllRecords($user_id) {
    $result = array();

    $mdb2 = getConnection();

    $sql = "select l.id, l.timestamp, l.user_id, l.date, TIME_FORMAT(l.start, '%k:%i') as start,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), '%k:%i') as finish,
      TIME_FORMAT(l.duration, '%k:%i') as duration,
      l.client_id, l.project_id, l.task_id, l.invoice_id, l.comment, l.billable, l.status
      from tt_log l where l.user_id = $user_id order by l.id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    } else return false;

    return $result;
  }

  // getRecords - returns time records for a user for a given date.
  static function getRecords($user_id, $date) {
    global $user;
    $sql_time_format = "'%k:%i'"; //  24 hour format.
    if ('%I:%M %p' == $user->time_format)
      $sql_time_format = "'%h:%i %p'"; // 12 hour format for MySQL TIME_FORMAT function.

    $result = array();
    $mdb2 = getConnection();

    if ($date instanceof DateAndTime){
      $date = $date->toString(DB_DATEFORMAT);
    }
    
    $client_field = null;
    if ($user->isPluginEnabled('cl'))
      $client_field = ", c.name as client";

    $left_joins = " left join tt_projects p on (l.project_id = p.id)".
      " left join tt_tasks t on (l.task_id = t.id)";

    if ($user->isPluginEnabled('cl'))
      $left_joins .= " left join tt_clients c on (l.client_id = c.id)";

    $sql = "select l.id as id, TIME_FORMAT(l.start, $sql_time_format) as start,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), $sql_time_format) as finish,
      TIME_FORMAT(l.duration, '%k:%i') as duration, p.name as project, t.name as task, l.comment, l.billable, l.invoice_id, t.allow_zero_duration 
      $client_field
      from tt_log l
      $left_joins
      where l.date = '$date' and l.user_id = $user_id and l.status = 1
      order by l.start, l.id";
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
}
