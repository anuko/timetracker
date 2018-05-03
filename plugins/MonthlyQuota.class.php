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

import('ttTimeHelper');

// MontlyQuota class implements handling of work hour quotas.
class MonthlyQuota {

  var $db;       // Database connection.
  var $group_id; // Group id.

  function __construct() {
    $this->db = getConnection();
    global $user;
    $this->group_id = $user->group_id;
  }

  // update - deletes a quota, then inserts a new one.
  public function update($year, $month, $minutes) {
    $group_id = $this->group_id;
    $deleteSql = "DELETE FROM tt_monthly_quotas WHERE year = $year AND month = $month AND group_id = $group_id";
    $this->db->exec($deleteSql);
    if ($minutes){
      $insertSql = "INSERT INTO tt_monthly_quotas (group_id, year, month, minutes) values ($group_id, $year, $month, $minutes)";
      $affected = $this->db->exec($insertSql);
      return (!is_a($affected, 'PEAR_Error'));
    }
    return true;
  }

  // get - obtains either a single month quota or an array of quotas for an entire year.
  // Month starts with 1 for January, not 0.
  public function get($year, $month = null) {
    if (is_null($month)){
      return $this->getMany($year);
    }
    return $this->getSingle($year, $month);
  }

  // getSingle - obtains a quota for a single month.
  private function getSingle($year, $month) {
    $group_id = $this->group_id;
    $sql = "SELECT minutes FROM tt_monthly_quotas WHERE year = $year AND month = $month AND group_id = $group_id";
    $reader = $this->db->query($sql);
    if (is_a($reader, 'PEAR_Error')) {
      return false;
    }

    $row = $reader->fetchRow();
    if ($row)
      return $row['minutes'];

    // If we did not find a record, return a calculated monthly quota.
    $numWorkdays = $this->getNumWorkdays($month, $year);
    global $user;
    return $numWorkdays * $user->workday_minutes;
  }

  // getMany - returns an array of quotas for a given year for group.
  private function getMany($year){
    $group_id = $this->group_id;
    $sql = "SELECT month, minutes FROM tt_monthly_quotas WHERE year = $year AND group_id = $group_id";
    $result = array();
    $res = $this->db->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      return false;
    }

    while ($val = $res->fetchRow()) {
      $result[$val['month']] = $val['minutes'];
    }

    return $result;
  }

  // getNumWorkdays returns a number of work days in a given month.
  private function getNumWorkdays($month, $year) {

    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); // Number of calendar days in month.

    $workdaysInMonth = 0;
    // Iterate through the entire month.
    for ($i = 1; $i <= $daysInMonth; $i++) {
      $date = "$year-$month-$i";
      if (!ttTimeHelper::isWeekend($date) && !ttTimeHelper::isHoliday($date)) {
        $workdaysInMonth++;
      }
    }
    return $workdaysInMonth;
  }

  // isValidQuota validates a localized value as an hours quota string (in hours and minutes).
  public function isValidQuota($value) {

    if (strlen($value) == 0 || !isset($value)) return true;

    if (preg_match('/^[0-9]{1,3}h?$/', $value )) { // 000 - 999
      return true;
    }

    if (preg_match('/^[0-9]{1,3}:[0-5][0-9]$/', $value )) { // 000:00 - 999:59
      return true;
    }

    global $user;
    $localizedPattern = '/^([0-9]{1,3})?['.$user->decimal_mark.'][0-9]{1,4}h?$/';
    if (preg_match($localizedPattern, $value )) { // decimal values like 000.5, 999.25h, ... .. 999.9999h (or with comma)
      return true;
    }

    return false;
  }

  // quotaToFloat converts a valid quota value to a float.
  public function quotaToFloat($value) {

    if (preg_match('/^[0-9]{1,3}h?$/', $value )) { // 000 - 999
      return (float) $value;
    }

    if (preg_match('/^[0-9]{1,3}:[0-5][0-9]$/', $value )) { // 000:00 - 999:59
      $minutes = ttTimeHelper::toMinutes($value);
      return ($minutes / 60.0);
    }

    global $user;
    $localizedPattern = '/^([0-9]{1,3})?['.$user->decimal_mark.'][0-9]{1,4}h?$/';
    if (preg_match($localizedPattern, $value )) { // decimal values like 000.5, 999.25h, ... .. 999.9999h (or with comma)
      // Strip optional h in the end.
      $value = trim($value, 'h');
      if ($user->decimal_mark == ',')
        $value = str_replace(',', '.', $value);
      return (float) $value;
    }

    return null;
  }
}
