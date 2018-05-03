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

class Calendar extends FormElement {
  var $holidays = array();
  var $showHolidays = true;
  var $weekStartDay = 0;
  
    var $mHeader = "padding: 5px; font-size: 8pt; color: #333333; background-color: #d9d9d9;";
    var $mDayCell = "padding: 5px; border: 1px solid silver; font-size: 8pt; color: #333333; background-color: #ffffff;";
    var $mDaySelected = "padding: 5px; border: 1px solid silver; font-size: 8pt; color: #666666; background-color: #a6ccf7;";
    var $mDayWeekend = "padding: 5px; border: 1px solid silver; font-size: 8pt; color: #666666; background-color: #f7f7f7;";
    var $mDayHoliday = "padding: 5px; border: 1px solid silver; font-size: 8pt; color: #666666; background-color: #f7f7f7;";
    var $mDayHeader = "padding: 5px; border: 1px solid white; font-size: 8pt; color: #333333;";
    var $mDayHeaderWeekend = "padding: 5px; border: 1px solid white; font-size: 8pt; color: #999999;";

    var $controlName = "";
    var $highlight = "time"; // Determines what type of active days to highlight ("time" or "expenses"). 

    function __construct($name) {
      $this->class = 'Calendar';
      $this->controlName = $name; // TODO: why controlName? Other classes have "name".
      $this->mMonthNames = array('January','February','March','April','May','June','July','August','September','October','November','December');
      $this->mWeekDayShortNames = array('Su','Mo','Tu','We','Th','Fr','Sa');
    }

    function setHighlight($highlight) {
    	if ($highlight && $highlight != 'time')
    	  $this->highlight = $highlight;
    }

    function localize() {
      global $user;
      global $i18n;
      
      $this->mMonthNames = $i18n->monthNames;
      $this->mWeekDayShortNames = $i18n->weekdayShortNames;
      if (is_array($i18n->holidays)) {
        foreach ($i18n->holidays as $fday) {
          $date_a = explode("/",$fday); // format mm/dd
          $this->holidays[] = mktime(0,0,0, $date_a[0], $date_a[1], date("Y"));// + 7200;
        }
      }
      $this->weekStartDay = $user->week_start;
    }

    function setStyle($style) { $this->style = $style; }
    function setCellStyle($style) { $this->mCellStyle = $style; }
    function setACellStyle($style) { $this->mACellStyle = $style; }
    function setLinkStyle($style) { $this->mLinkStyle = $style; }

    function setShowHolidays($value) {
      $this->showHolidays = $value;
    }

    /**
     * @return void
     * @param date
     * @desc Enter description here...
     */
    function toString($date="") {
      global $i18n;
    	
      $indate = $this->value;
      if (!$indate) $indate = strftime(DB_DATEFORMAT);

      //current year and month
      if ( strlen ( $indate ) > 0 ) {
        $indateObj = new DateAndTime(DB_DATEFORMAT, $indate);
        $thismonth = $indateObj->getMonth();
        $thisyear = $indateObj->getYear();
      } else {
        $thismonth = date("m");
        $thisyear = date("Y");
      }

      // next date, month, year
      $next = mktime ( 2, 0, 0, $thismonth + 1, 1, $thisyear );
      $nextyear = date ( "Y", $next );
      $nextmonth = date ( "m", $next );
      $nextdate = strftime (DB_DATEFORMAT, $next );

      // prev date, month, year
      $prev = mktime ( 2, 0, 0, $thismonth - 1, 1, $thisyear );
      $prevyear = date ( "Y", $prev );
      $prevmonth = date ( "m", $prev );
      $prevdate = strftime(DB_DATEFORMAT, $prev );

      $str = $this->_genStyles();

      $str .= '<table cellpadding="0" cellspacing="0" border="0" width="100%">
          <tr><td align="center"><div class="CalendarHeader">'.
          //'<a href="?date='.$prevyear.'">&lt;&lt;</a> '.
          '<a href="?date='.$prevdate.'" tabindex="-1">&lt;&lt;&lt;</a>  '.
          $this->mMonthNames[$thismonth-1].'&nbsp;'.$thisyear.
          '  <a href="?date='.$nextdate.'" tabindex="-1">&gt;&gt;&gt;</a>'.
          //' <a href="?date='.$nextyear.'">&gt;&gt;</a>'.
          '</div></td></tr>
          </table>';

      $str .= '<center>
          <table border="0" cellpadding="1" cellspacing="1" width="100%">
          <tr>';

      $str .= "<tr>";

      $weekend_start = 6 - $this->weekStartDay;      // Saturday by default.
      $weekend_end = (7 - $this->weekStartDay) % 7;  // Sunday by default.
      if (defined('WEEKEND_START_DAY')) {
      	$weekend_start = (7 + WEEKEND_START_DAY - $this->weekStartDay) % 7;
      	$weekend_end = (7 + WEEKEND_START_DAY + 1 - $this->weekStartDay) % 7;
      } 

      for ( $i=0; $i<7; $i++ ) {
        $weekdayNameIdx = ($i + $this->weekStartDay) % 7;
        if ($i==$weekend_start || $i==$weekend_end) {
          $str .= '<td class="CalendarDayHeaderWeekend">'.$this->mWeekDayShortNames[$weekdayNameIdx].'</td>';
        } else {
          $str .= '<td class="CalendarDayHeader">'.$this->mWeekDayShortNames[$weekdayNameIdx].'</td>';
        }
      }

      $str .= "</tr>\n";

      list($wkstart,$monthstart,$monthend,$start_date) = $this->_getWeekDayBefore( $thisyear, $thismonth );

      $active_dates = $this->_getActiveDates($monthstart, $monthend);

      for ( $i = $wkstart; $i<=$monthend;  $i=mktime(0,0,0,$thismonth,$start_date+=7,$thisyear) ) {
        $str .= "<TR>\n";
          for ( $j = 0; $j < 7; $j++ ) {
            $date = mktime(0,0,0,$thismonth,$start_date+$j,$thisyear);
            if (($date >= $monthstart) && ($date <= $monthend)) {

            $stl_cell = "";
            $stl_link = "";

            // weekend
            if ($j==$weekend_start || $j==$weekend_end) {
              $stl_cell = ' class="CalendarDayWeekend"';
              $stl_link = ' class="CalendarLinkWeekend"';
            } else {
              $stl_cell = ' class="CalendarDay"';
            }

              // holidays
              //if ($this->showHolidays) {
              global $user;
              if ($user->show_holidays) {
              foreach ($this->holidays as $day) {
                if($day == $date) {
                  $stl_cell = ' class="CalendarDayHoliday"';
                  $stl_link = ' class="CalendarLinkHoliday"';
                }
              }
            }

            // selected day
            if ( $indate == strftime(DB_DATEFORMAT, $date))
              $stl_cell = ' class="CalendarDaySelected"';


            $str .= '<td'.$stl_cell.'>';

            // Entries exist.
            if($active_dates) {
              if( in_array(strftime(DB_DATEFORMAT, $date), $active_dates) )
                $stl_link = ' class="CalendarLinkRecordsExist"';
            }

            $str .= "<a".$stl_link." href=\"?".$this->controlName."=".strftime(DB_DATEFORMAT, $date)."\" tabindex=\"-1\">".date("d",$date)."</a>";

            $str .= "</TD>";
          }
          else {
            $str .= "<TD>&nbsp;</TD>\n";
          }
        }
        $str .= "</TR>\n";
      }

      $str .= "<tr><td colspan=\"7\" align=\"center\"><a id=\"today_link\" href=\"?".$this->controlName."=".strftime(DB_DATEFORMAT)."\" tabindex=\"-1\">".$i18n->get('label.today')."</a></td></tr>\n";
      $str .= "</table>\n";

      $str .= "<input type=\"hidden\" name=\"$this->controlName\" value=\"$indate\">\n";

      // Add script to adjust today link to match browser today, as PHP may run in a different timezone.
      $str .= "<script>\n";
      $str .= "function adjustToday() {\n";
      $str .= "  var browser_today = new Date();\n";
      $str .= "  document.getElementById('today_link').href = '?$this->controlName='+browser_today.strftime('".DB_DATEFORMAT."');\n";
      $str .= "}\n";
      $str .= "adjustToday();\n";
      $str .= "</script>\n";
      
      return $str;
    }

    function getHtml() {
        return $this->toString();
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

    function _genStyles() {
      $str = "<style>\n";
      $str .= ".CalendarHeader {". $this->mHeader ."}\n";
      $str .= ".CalendarDay {". $this->mDayCell  ."}\n";
      $str .= ".CalendarDaySelected {". $this->mDaySelected  ."}\n";
      $str .= ".CalendarDayWeekend {". $this->mDayWeekend ."}\n";
      $str .= ".CalendarDayHoliday {". $this->mDayHoliday ."}\n";
      $str .= ".CalendarDayHeader {". $this->mDayHeader ."}\n";
      $str .= ".CalendarDayHeaderWeekend {". $this->mDayHeaderWeekend ."}\n";
      
      $str .= ".CalendarLinkWeekend {color: #999999;}\n";
      $str .= ".CalendarLinkHoliday {color: #999999;}\n";
      $str .= ".CalendarLinkRecordsExist {color: #FF0000;}\n";
        $str .= "</style>\n";
        return $str;
    }
    
    // _getActiveDates returns an array of dates, for which entries exist for user.
    // Type of entries (time or expenses) is determined by $this->highlight value.
    function _getActiveDates($start, $end) {
      
      global $user;
      $user_id = $user->getActiveUser();
      
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
