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

class MonthlyQuota {
    
    var $db;       // Database connection.
    var $holidays; // Array of holidays from localization file.
    var $team_id;  // Team id.

    // Old style constructors are DEPRECATED in PHP 7.0, and will be removed in a future version. You should always use __construct() in new code.
    function __construct() {
        $this->db = getConnection();
        $i18n = $GLOBALS['I18N'];
        $this->holidays = $i18n->holidays;
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

    // get - obains either a single month quota or an array of quotas for an entire year.
    public function get($year, $month) {
        if (is_null($month)){
            return $this->getMany($year);
        }
        return $this->getSingle($year, $month);
    }

    // getWorkdayHours - obtains workday_hours value for a team from the database.
    public function getWorkdayHours(){
        $teamId = $this->team_id;
        $sql = "SELECT workday_hours FROM tt_teams where id = $teamId";
        $reader = $this->db->query($sql);
        if (is_a($reader, 'PEAR_Error')) {
            return false;
        }

        $row = $reader->fetchRow();
        return $row['workday_hours'];
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
        $holidaysWithYear = array();
        foreach ($this->holidays as $day) {
            $parts = explode("/", $day);
            $holiday = "$year-$parts[0]-$parts[1]";
            array_push($holidaysWithYear, $holiday);
        }
    
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        return $this->getWorkingDays("$year-$month-01", "$year-$month-$daysInMonth", $holidaysWithYear) * $this->getWorkdayHours();
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
    
    // The function returns the number of business days between two dates skipping holidays.
    private function getWorkingDays($startDate, $endDate, $holidays) {
        // TODO: this function needs a fix, as it assumes Sat + Sun weekends, 
        // and will not work properly for other week types (ex. Arabic weeks).

        // do strtotime calculations just once
        $endDate = strtotime($endDate);
        $startDate = strtotime($startDate);

        //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
        //We add one to inlude both dates in the interval.
        $days = ($endDate - $startDate) / 86400 + 1;

        $noOfFullWeeks = floor($days / 7);
        $noOfRemainingDays = fmod($days, 7);

        //It will return 1 if it's Monday,.. ,7 for Sunday
        $firstDayofWeek = date("N", $startDate);
        $lastDayofWeek = date("N", $endDate);

        //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
        //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
        if ($firstDayofWeek <= $lastDayofWeek) {
            if ($firstDayofWeek <= 6 && 6 <= $lastDayofWeek) {
                $noOfRemainingDays--;                
            }
            
            if ($firstDayofWeek <= 7 && 7 <= $lastDayofWeek) {
                $noOfRemainingDays--;
            }
        }
        else {
            // (edit by Tokes to fix an edge case where the start day was a Sunday
            // and the end day was NOT a Saturday)

            // the day of the week for start is later than the day of the week for end
            if ($firstDayofWeek == 7) {
                // if the start date is a Sunday, then we definitely subtract 1 day
                $noOfRemainingDays--;

                if ($lastDayofWeek == 6) {
                    // if the end date is a Saturday, then we subtract another day
                    $noOfRemainingDays--;
                }
            }
            else {
                // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
                // so we skip an entire weekend and subtract 2 days
                $noOfRemainingDays -= 2;
            }
        }

        //T he no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
        // ---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
        $workingDays = $noOfFullWeeks * 5;
        if ($noOfRemainingDays > 0 ) {
            $workingDays += $noOfRemainingDays;
        }

        // We subtract the holidays
        foreach($holidays as $holiday){
            $timeStamp = strtotime($holiday);
            // If the holiday doesn't fall in weekend
            // TODO: add handling for countries where they move non working day to first working day if holiday is on weekends
            if ($startDate <= $timeStamp && $timeStamp <= $endDate && date("N", $timeStamp) != 6 && date("N", $timeStamp ) != 7)
                $workingDays--;
        }

        return $workingDays;
    }
}
