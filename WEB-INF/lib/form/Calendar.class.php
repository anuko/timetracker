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

import('form.FormElement');
import('DateAndTime');
import('ttTimeHelper');

class Calendar extends FormElement {
  var $weekStartDay = 0;   // Defaults to Sunday.
  var $highlight = 'time'; // Determines what type of active days to highlight ("time" or "expenses").
  var $monthNames = array('January','February','March','April','May','June','July','August','September','October','November','December');
  var $weekdayShortNames = array('Su','Mo','Tu','We','Th','Fr','Sa');

  // Constructor.
  function __construct($name) {
    $this->class = 'Calendar';
    $this->name = $name;
  }

  // Sets what we highlight (days with existing time or expense entries).
  function setHighlight($highlight) {
    if ($highlight && $highlight != 'time')
      $this->highlight = $highlight;
  }

  // Localizes Calendar control for user language.
  function localize() {
    global $user;
    global $i18n;
      
    $this->monthNames = $i18n->monthNames;
    $this->weekdayShortNames = $i18n->weekdayShortNames;
    $this->weekStartDay = $user->getWeekStart();
  }

  // Generates html code for Calendar control.
  function getHtml() {
    global $i18n; // Needed to print Today.

    $selectedDate = $this->value;
    if (!$selectedDate) $selectedDate = strftime(DB_DATEFORMAT);

    // Determine month and year for selected date.
    $selectedDateObject = new DateAndTime(DB_DATEFORMAT, $selectedDate);
    $selectedMonth = $selectedDateObject->getMonth();
    $selectedYear = $selectedDateObject->getYear();

    // Determine date for the 1st of next month for calendar navigation.
    $firstOfNextMonth2AM = mktime(2, 0, 0, $selectedMonth + 1, 1, $selectedYear); // 2 am on the 1st of next month.
    $firstOfNextMonth = strftime(DB_DATEFORMAT, $firstOfNextMonth2AM);

    // Determine date for the 1st of previous month.
    $firstOfPreviousMonth2AM = mktime(2, 0, 0, $selectedMonth - 1, 1, $selectedYear); // 2 am on the 1st of previous month.
    $firstOfPreviousMonth = strftime(DB_DATEFORMAT, $firstOfPreviousMonth2AM);

    // Print calendar header.
    $str .= "\n\n<!-- start of calendar -->\n";
    $str .= '<table cellpadding="0" cellspacing="0" border="0" width="100%">'."\n";
    $str .= '  <tr><td align="center">';
    $str .= '<div class="calendarHeader">';
    $str .= '<a href="?date='.$firstOfPreviousMonth.'" tabindex="-1">&lt;&lt;&lt;</a>  '.
      $this->monthNames[$selectedMonth-1].'&nbsp;'.$selectedYear.
      '  <a href="?date='.$firstOfNextMonth.'" tabindex="-1">&gt;&gt;&gt;</a></div></td></tr>'."\n";
    $str .= "</table>\n";

    // Print day headers.
    $str .= '<table border="0" cellpadding="1" cellspacing="1" width="100%">'."\n";
    $str .= '  <tr>';

    // TODO: refactoring ongoing down from here...

      // TODO: refactor this entire class, as $weekend_start and $weekend_end
      // are not what their names suggest (debug with non zero week start to see it).
      $weekend_start = 6 - $this->weekStartDay;      // Saturday by default.
      $weekend_end = (7 - $this->weekStartDay) % 7;  // Sunday by default.
      if (defined('WEEKEND_START_DAY')) {
      	$weekend_start = (7 + WEEKEND_START_DAY - $this->weekStartDay) % 7;
      	$weekend_end = (7 + WEEKEND_START_DAY + 1 - $this->weekStartDay) % 7;
      } 

      for ( $i=0; $i<7; $i++ ) {
        $weekdayNameIdx = ($i + $this->weekStartDay) % 7;
        if ($i==$weekend_start || $i==$weekend_end) {
          $str .= '<td class="calendarDayHeaderWeekend">'.$this->weekdayShortNames[$weekdayNameIdx].'</td>';
        } else {
          $str .= '<td class="calendarDayHeader">'.$this->weekdayShortNames[$weekdayNameIdx].'</td>';
        }
      }

      $str .= "</tr>\n";

      list($wkstart,$monthstart,$monthend,$start_date) = $this->_getWeekDayBefore( $selectedYear, $selectedMonth );

      $active_dates = $this->_getActiveDates($monthstart, $monthend);

      for ( $i = $wkstart; $i<=$monthend;  $i=mktime(0,0,0,$selectedMonth,$start_date+=7,$selectedYear) ) {
        $str .= "<TR>\n";
          for ( $j = 0; $j < 7; $j++ ) {
            $date = mktime(0,0,0,$selectedMonth,$start_date+$j,$selectedYear);
            if (($date >= $monthstart) && ($date <= $monthend)) {

            $stl_cell = "";
            $stl_link = "";

            // weekend
            if ($j==$weekend_start || $j==$weekend_end) {
              $stl_cell = ' class="calendarDayWeekend"';
              $stl_link = ' class="calendarLinkWeekend"';
            } else {
              $stl_cell = ' class="calendarDay"';
            }

            // holidays
            $date_to_check = ttTimeHelper::dateInDatabaseFormat($selectedYear, $selectedMonth, $start_date+$j);
            if (ttTimeHelper::isHoliday($date_to_check)) {
              $stl_cell = ' class="calendarDayHoliday"';
              $stl_link = ' class="calendarLinkHoliday"';
            }

            // selected day
            if ( $selectedDate == strftime(DB_DATEFORMAT, $date))
              $stl_cell = ' class="calendarDaySelected"';


            $str .= '<td'.$stl_cell.'>';

            // Entries exist.
            if($active_dates) {
              $day_total_minutes = ttTimeHelper::toMinutes(ttTimeHelper::getTimeForDay($date_to_check));
              global $user;
              $workday_minutes = $user->getWorkdayMinutes();

              //check for any entries in the day
              if( in_array(strftime(DB_DATEFORMAT, $date), $active_dates) ){
                //check if entries total to a complete work day
                if ($day_total_minutes >= $workday_minutes){
                  $stl_link = ' class="calendarLinkRecordsExist"';
                }
                else {
                  $stl_link = ' class="calendarLinkNonCompleteDay"';
                }
              }
            }

            $str .= "<a".$stl_link." href=\"?".$this->name."=".strftime(DB_DATEFORMAT, $date)."\" tabindex=\"-1\">".date("d",$date)."</a>";

            $str .= "</TD>";
          }
          else {
            $str .= "<TD>&nbsp;</TD>\n";
          }
        }
        $str .= "</TR>\n";
      }

      $str .= "<tr><td colspan=\"7\" align=\"center\"><a id=\"today_link\" href=\"?".$this->name."=".strftime(DB_DATEFORMAT)."\" tabindex=\"-1\">".$i18n->get('label.today')."</a></td></tr>\n";
      $str .= "</table>\n";

      $str .= "<input type=\"hidden\" name=\"$this->name\" value=\"$selectedDate\">\n";

      // Add script to adjust today link to match browser today, as PHP may run in a different timezone.
      $str .= "<script>\n";
      $str .= "function adjustToday() {\n";
      $str .= "  var browser_today = new Date();\n";
      $str .= "  document.getElementById('today_link').href = '?$this->name='+browser_today.strftime('".DB_DATEFORMAT."');\n";
      $str .= "}\n";
      $str .= "adjustToday();\n";
      $str .= "</script>\n";
      
      return $str;
    }

    function _getWeekDayBefore($year, $month) {
      $weekday = date ( "w", mktime ( 2, 0, 0, $month, 1 - $this->weekStartDay, $year ) );
      return array(
        mktime ( 0, 0, 0, $month, 1 - $weekday, $year ),
        mktime ( 0, 0, 0, $month, 1, $year ),
      mktime ( 0, 0, 0, $month + 1, 0, $year ),
      (1 - $weekday)
      );
    }

    // _getActiveDates returns an array of dates, for which entries exist for user.
    // Type of entries (time or expenses) is determined by $this->highlight value.
    function _getActiveDates($start, $end) {
      
      global $user;
      $user_id = $user->getUser();
      
      $table = ($this->highlight == 'expenses') ? 'tt_expense_items' : 'tt_log';
      
      $mdb2 = getConnection();

      $start_date = date("Y-m-d", $start);
      $end_date = date("Y-m-d", $end);
      $sql = "SELECT date FROM $table WHERE date >= '$start_date' AND date <= '$end_date' AND user_id = $user_id AND status = 1";
      $res = $mdb2->query($sql);
      if (!is_a($res, 'PEAR_Error')) {
        while ($row = $res->fetchRow()) {
          $out[] = date('Y-m-d', strtotime($row['date']));
        }
        return @$out;
      }
      else
        return false;
    }
}
