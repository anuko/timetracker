<?php

class MonthlyQuota {
    
    var $db;
    var $holidays;
    // Old style constructors are DEPRECATED in PHP 7.0, and will be removed in a future version. You should always use __construct() in new code.
    function __construct() {
        $this->db = getConnection();
        $i18n = $GLOBALS['I18N'];
        $this->holidays = $i18n->holidays;
    }
    
    public function update($year, $month, $quota) {
        $deleteSql = "DELETE FROM tt_monthly_quota WHERE year = $year AND month = $month";
        $this->db->exec($deleteSql);
        $insertSql = "INSERT INTO tt_monthly_quota (year, month, quota) values ($year, $month, $quota)";
        $affected = $this->db->exec($insertSql);
        return (!is_a($affected, 'PEAR_Error'));
    }
        
    public function get($year, $month) {
        
        if (is_null($month)){
            return $this->getMany($year);
        }
        
        return $this->getSingle($year, $month);
    }
    
    private function getSingle($year, $month) {
        
        $sql = "SELECT quota FROM tt_monthly_quota WHERE year = $year AND month = $month";
        $reader = $this->db->query($sql);
        if (is_a($reader, 'PEAR_Error')) {
            return false;
        }
        
        $row = $reader->fetchRow();
        
        // if we don't find a record, return calculated monthly quota
        if (is_null($row)){
            
            $holidaysWithYear = array();
            foreach ($this->holidays as $day) {
                $parts = explode("/", $day);
                $holiday = "$year-$parts[0]-$parts[1]";
                array_push($holidaysWithYear, $holiday);
            }
            
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            return $this->getWorkingDays("$year-$month-01", "$year-$month-$daysInMonth", $holidaysWithYear) * 8;
        }
        
        return $row["quota"];  
    }
    
    private function getMany($year){
        $sql = "SELECT year, month, quota FROM tt_monthly_quota WHERE year = $year";
        $result = array();
        $res = $this->db->query($sql);
        if (is_a($res, 'PEAR_Error')) {
            return false;
        }
        
        while ($val = $res->fetchRow()) {
            $result[$val["month"]] = $val["quota"];
            // $result[] = $val;
        }        
        
        return $result;
    }
    
    //The function returns the no. of business days between two dates and it skips the holidays
    private function getWorkingDays($startDate, $endDate, $holidays) {
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