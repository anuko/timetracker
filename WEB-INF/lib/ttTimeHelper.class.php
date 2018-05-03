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
    global $user;
    global $i18n;

    if (!$user->show_holidays) return false;

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
    if (strlen($value) == 0 || !isset($value)) return false;

    if ($value == '24:00' || $value == '2400') return true;

    if (preg_match('/^([0-1]{0,1}[0-9]|2[0-3]):?[0-5][0-9]$/', $value )) { // 0:00 - 23:59, 000 - 2359
      return true;
    }
    if (preg_match('/^([0-1]{0,1}[0-9]|2[0-4])h?$/', $value )) { // 0, 1 ... 24
      return true;
    }

    global $user;
    $localizedPattern = '/^([0-1]{0,1}[0-9]|2[0-3])?['.$user->decimal_mark.'][0-9]{1,4}h?$/';
    if (preg_match($localizedPattern, $value )) { // decimal values like 0.5, 1.25h, ... .. 23.9999h (or with comma)
      return true;
    }

    return false;
  }

  // postedDurationToMinutes - converts a value representing a duration
  // (usually enetered in a form by a user) to an integer number of minutes.
  //
  // Parameters:
  //   $duration - user entered duration string. Valid strings are:
  //               3 or 3h - means 3 hours. Note: h and m letters are not localized.
  //               0.25 or 0.25h or .25 or .25h - means a quarter of hour.
  //               0,25 or 0,25h or ,25 or ,25h - same as above for users with comma ad decimal mark.
  //               1:30 - means 1 hour 30 minutes.
  //               25m - means 25 minutes.
  //   $max - maximum number of minutes that is valid.
  //
  //   At the moment, we have 2 variations of duration types:
  //   1) A duration within a day, such as in a time entry.
  //   These are less or equal to 24*60 minutes.
  //
  //   2) A duration of a monthly quota, with max value of 31*24*60 minutes.
  //
  // This function is generic to be used for both types.
  //
  // Returns false if the value cannot be converted.
  static function postedDurationToMinutes($duration, $max = 1440) {
    // Handle empty value.
    if (!isset($duration) || strlen($duration) == 0)
      return null; // Value is not set. Caller decides whether it is valid or not.

    // Handle whole hours.
    if (preg_match('/^\d{1,3}h?$/', $duration )) { // 0 - 999, 0h - 999h
      $minutes = 60 * trim($duration, 'h');
      return $minutes > $max ? false : $minutes;
    }

    // Handle a normalized duration value.
    if (preg_match('/^\d{1,3}:[0-5][0-9]$/', $duration )) { // 0:00 - 999:59
      $time_array = explode(':', $duration);
      $minutes = (int)@$time_array[1] + ((int)@$time_array[0]) * 60;
      return $minutes > $max ? false : $minutes;
    }

    // Handle localized fractional hours.
    global $user;
    $localizedPattern = '/^(\d{1,3})?['.$user->decimal_mark.'][0-9]{1,4}h?$/';
    if (preg_match($localizedPattern, $duration )) { // decimal values like .5, 1.25h, ... .. 999.9999h (or with comma)
        if ($user->decimal_mark == ',')
          $duration = str_replace (',', '.', $duration);

        $minutes = (int)round(60 * floatval($duration));
        return $minutes > $max ? false : $minutes;
    }

    // Handle minutes. Some users enter durations like 10m (meaning 10 minutes).
    if (preg_match('/^\d{1,5}m$/', $duration )) { // 0m - 99999m
      $minutes = (int) trim($duration, 'm');
      return $minutes > $max ? false : $minutes;
    }

    // Everything else is not a valid duration.
    return false;
  }

  // minutesToDuration converts an integer number of minutes into duration string.
  // Formats returned HH:MM, HHH:MM, HH, or HHH.
  static function minutesToDuration($minutes, $abbreviate = false) {
    if ($minutes < 0) return false;

    $hours = (string) (int)($minutes / 60);
    $mins = (string) round(fmod($minutes, 60));
    if (strlen($mins) == 1)
      $mins = '0' . $mins;
    if ($abbreviate && $mins == '00')
      return $hours;

    return $hours.':'.$mins;
  }

  // toMinutes - converts a time string in format 00:00 to a number of minutes.
  static function toMinutes($value) {
    $time_a = explode(':', $value);
    return (int)@$time_a[1] + ((int)@$time_a[0]) * 60;
  }

  // toAbsDuration - converts a number of minutes to format 0:00
  // even if $minutes is negative.
  static function toAbsDuration($minutes, $abbreviate = false){
    $hours = (string)((int)abs($minutes / 60));
    $mins = (string) round(abs(fmod($minutes, 60)));
    if (strlen($mins) == 1)
      $mins = '0' . $mins;
    if ($abbreviate && $mins == '00')
      return $hours;

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
    global $user;
    $mdb2 = getConnection();

    $user_id = $fields['user_id'];
    $date = $fields['date'];
    $start = $fields['start'];
    $finish = $fields['finish'];
    $duration = $fields['duration'];
    if ($duration) {
      $minutes = ttTimeHelper::postedDurationToMinutes($duration);
      $duration = ttTimeHelper::minutesToDuration($minutes);
    }
    $client = $fields['client'];
    $project = $fields['project'];
    $task = $fields['task'];
    $invoice = $fields['invoice'];
    $note = $fields['note'];
    $billable = $fields['billable'];
    $paid = $fields['paid'];
    if (array_key_exists('status', $fields)) { // Key exists and may be NULL during migration of data.
      $status_f = ', status';
      $status_v = ', '.$mdb2->quote($fields['status']);
    }

    $start = ttTimeHelper::to24HourFormat($start);
    if ($finish) {
      $finish = ttTimeHelper::to24HourFormat($finish);
      if ('00:00' == $finish) $finish = '24:00';
    }

    $created_v = ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$mdb2->quote($user->id);

    if (!$billable) $billable = 0;
    if (!$paid) $paid = 0;

    if ($duration) {
      $sql = "insert into tt_log (user_id, date, duration, client_id, project_id, task_id, invoice_id, comment, billable, paid, created, created_ip, created_by $status_f) ".
        "values ($user_id, ".$mdb2->quote($date).", '$duration', ".$mdb2->quote($client).", ".$mdb2->quote($project).", ".$mdb2->quote($task).", ".$mdb2->quote($invoice).", ".$mdb2->quote($note).", $billable, $paid $created_v $status_v)";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    } else {
      $duration = ttTimeHelper::toDuration($start, $finish);
      if ($duration === false) $duration = 0;
      if (!$duration && ttTimeHelper::getUncompleted($user_id)) return false;

      $sql = "insert into tt_log (user_id, date, start, duration, client_id, project_id, task_id, invoice_id, comment, billable, paid, created, created_ip, created_by $status_f) ".
        "values ($user_id, ".$mdb2->quote($date).", '$start', '$duration', ".$mdb2->quote($client).", ".$mdb2->quote($project).", ".$mdb2->quote($task).", ".$mdb2->quote($invoice).", ".$mdb2->quote($note).", $billable, $paid $created_v $status_v)";
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
    global $user;
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
    if ($duration) {
      $minutes = ttTimeHelper::postedDurationToMinutes($duration);
      $duration = ttTimeHelper::minutesToDuration($minutes);
    }
    $note = $fields['note'];

    $billable_part = '';
    if ($user->isPluginEnabled('iv')) {
      $billable_part = $fields['billable'] ? ', billable = 1' : ', billable = 0';
    }
    $paid_part = '';
    if ($user->can('manage_invoices') && $user->isPluginEnabled('ps')) {
      $paid_part = $fields['paid'] ? ', paid = 1' : ', paid = 0';
    }
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);

    $start = ttTimeHelper::to24HourFormat($start);
    $finish = ttTimeHelper::to24HourFormat($finish);
    if ('00:00' == $finish) $finish = '24:00';
    
    if ($start) $duration = '';

    if ($duration) {
      $sql = "UPDATE tt_log set start = NULL, duration = '$duration', client_id = ".$mdb2->quote($client).", project_id = ".$mdb2->quote($project).", task_id = ".$mdb2->quote($task).", ".
        "comment = ".$mdb2->quote($note)."$billable_part $paid_part $modified_part, date = '$date' WHERE id = $id";
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
        "comment = ".$mdb2->quote($note)."$billable_part $paid_part $modified_part, date = '$date' WHERE id = $id";
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
    $sql = "select sum(time_to_sec(duration)) as sm from tt_log where user_id = $user_id and date >= '".$period->getStartDate(DB_DATEFORMAT)."' and date <= '".$period->getEndDate(DB_DATEFORMAT)."' and status = 1";
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
    $sql = "select sum(time_to_sec(duration)) as sm from tt_log where user_id = $user_id and date >= '".$period->getStartDate(DB_DATEFORMAT)."' and date <= '".$period->getEndDate(DB_DATEFORMAT)."' and status = 1";
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

    $sql = "select id, start from tt_log  
      where user_id = $user_id and start is not null and time_to_sec(duration) = 0 and status = 1";
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
    global $user;
    if ($user->allow_overlap) return false;

    $mdb2 = getConnection();

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

    $sql = "select l.id as id, TIME_FORMAT(l.start, $sql_time_format) as start,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), $sql_time_format) as finish,
      TIME_FORMAT(l.duration, '%k:%i') as duration,
      p.name as project_name, t.name as task_name, l.comment, l.client_id, l.project_id, l.task_id, l.invoice_id, l.billable, l.paid, l.date
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

    $sql = "select l.id, l.user_id, l.date, TIME_FORMAT(l.start, '%k:%i') as start,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), '%k:%i') as finish,
      TIME_FORMAT(l.duration, '%k:%i') as duration,
      l.client_id, l.project_id, l.task_id, l.invoice_id, l.comment, l.billable, l.paid, l.status
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

    $client_field = null;
    if ($user->isPluginEnabled('cl'))
      $client_field = ", c.name as client";

    $left_joins = " left join tt_projects p on (l.project_id = p.id)".
      " left join tt_tasks t on (l.task_id = t.id)";
    if ($user->isPluginEnabled('cl'))
      $left_joins .= " left join tt_clients c on (l.client_id = c.id)";

    $sql = "select l.id as id, TIME_FORMAT(l.start, $sql_time_format) as start,
      TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), $sql_time_format) as finish,
      TIME_FORMAT(l.duration, '%k:%i') as duration, p.name as project, t.name as task, l.comment, l.billable, l.invoice_id $client_field
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
