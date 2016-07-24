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

// MontlyQuota class implements handling of work hour quotas.
class MonthlyQuota {

  var $db;       // Database connection.
  var $team_id;  // Team id.

  // Old style constructors are DEPRECATED in PHP 7.0, and will be removed in a future version. You should always use __construct() in new code.
  function __construct() {
    $this->db = getConnection();
    global $user;
    $this->team_id = $user->team_id;
  }

  // update - deletes a quota, then inserts a new one.
  public function update($year, $month, $quota) {
    $teamId = $this->team_id;
    $deleteSql = "DELETE FROM tt_monthly_quotas WHERE year = $year AND month = $month AND team_id = $teamId";
    $this->db->exec($deleteSql);
    if ($quota){
      $insertSql = "INSERT INTO tt_monthly_quotas (team_id, year, month, quota) values ($teamId, $year, $month, $quota)";
      $affected = $this->db->exec($insertSql);
      return (!is_a($affected, 'PEAR_Error'));
    }
    return true;
  }

  // get - obtains either a single month quota or an array of quotas for an entire year.
  public function get($year, $month) {
    if (is_null($month)){
      return $this->getMany($year);
    }
    return $this->getSingle($year, $month);
  }

  // getSingle - obtains a quota for a single month.
  private function getSingle($year, $month) {
    $teamId = $this->team_id;
    $sql = "SELECT quota FROM tt_monthly_quotas WHERE year = $year AND month = $month AND team_id = $teamId";
    $reader = $this->db->query($sql);
    if (is_a($reader, 'PEAR_Error')) {
      return false;
    }

    $row = $reader->fetchRow();
    if ($row)
      return $row['quota'];

    // If we did not find a record, return a calculated monthly quota.
    $numWorkdays = $this->getNumWorkdays($month, $year);
    global $user;
    return $numWorkdays * $user->workday_hours;
  }

  // getMany - returns an array of quotas for a given year for team.
  private function getMany($year){
    $teamId = $this->team_id;
    $sql = "SELECT month, quota FROM tt_monthly_quotas WHERE year = $year AND team_id = $teamId";
    $result = array();
    $res = $this->db->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      return false;
    }

    while ($val = $res->fetchRow()) {
      $result[$val['month']] = $val['quota'];
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
}
