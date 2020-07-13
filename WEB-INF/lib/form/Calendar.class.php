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
    global $user;

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
    $html .= "\n\n<!-- start of calendar -->\n";
    $html .= '<table cellpadding="0" cellspacing="0" border="0" width="100%">'."\n";
    $html .= '  <tr><td align="center">';
    $html .= '<div class="calendarHeader">';
    $html .= '<a href="?date='.$firstOfPreviousMonth.'" tabindex="-1">&lt;&lt;&lt;</a>  '.
      $this->monthNames[$selectedMonth-1].'&nbsp;'.$selectedYear.
      '  <a href="?date='.$firstOfNextMonth.'" tabindex="-1">&gt;&gt;&gt;</a></div></td></tr>'."\n";
    $html .= "</table>\n";

    // Start printing calendar table.
    $html .= '<table border="0" cellpadding="1" cellspacing="1" width="100%">'."\n";

    // Determine column indexes in calendar table for weekend start and end days.
    if (defined('WEEKEND_START_DAY')) {
      $weekend_start_idx = (7 + WEEKEND_START_DAY - $this->weekStartDay) % 7;
      $weekend_end_idx = (7 + WEEKEND_START_DAY + 1 - $this->weekStartDay) % 7;
    } else {
      $weekend_start_idx = 6 - $this->weekStartDay;
      $weekend_end_idx = (7 - $this->weekStartDay) % 7;
    }

    // Print day headers.
    $html .= '  <tr>';
    for ($i = 0; $i < 7; $i++) {
      $weekdayNameIdx = ($i + $this->weekStartDay) % 7;
      if ($i == $weekend_start_idx || $i == $weekend_end_idx) {
        $html .= '<td class="calendarDayHeaderWeekend">'.$this->weekdayShortNames[$weekdayNameIdx].'</td>';
      } else {
        $html .= '<td class="calendarDayHeader">'.$this->weekdayShortNames[$weekdayNameIdx].'</td>';
      }
    }
    $html .= "</tr>\n";

    // Determine timestamps for iteration.
    $firstDayOfSelectedMonth0am = mktime(0, 0, 0, $selectedMonth, 1, $selectedYear);
    $lastDayOfSelectedMonth0am = mktime( 0, 0, 0, $selectedMonth + 1, 0, $selectedYear);
    // Determine index of the 1st day of month in calendar table, which depends on user weekStartDay.
    $firstDayOfSelectedMonthIdx = date("w", mktime ( 2, 0, 0, $selectedMonth, 1 - $this->weekStartDay, $selectedYear));
    // Determine a timestamp when 1st display week starts by shifting back.
    $firstWeekStart0am = $firstDayOfSelectedMonth0am - 86400 * $firstDayOfSelectedMonthIdx;
    // Determine start day index, (0 or negative when we display empty days in a previous month).
    $startDayIdx = 1 - $firstDayOfSelectedMonthIdx;

    // Determine active dates where entries exist for user.
    $active_dates = $this->getActiveDates($firstDayOfSelectedMonth0am, $lastDayOfSelectedMonth0am);

    $handleHolidays = $user->getHolidays() != null;
    $handleNotCompleteDays = $user->isOptionEnabled('time_not_complete_days');
    $workday_minutes = $user->getWorkdayMinutes();

    // Print calendar cells one week row at a time.
    for ($timestamp = $firstWeekStart0am; $timestamp <= $lastDayOfSelectedMonth0am; $timestamp = mktime(0, 0, 0, $selectedMonth, $startDayIdx += 7, $selectedYear)) {
      $html .= "  <tr>";
      // Iterate through week days.
      for ($j = 0; $j < 7; $j++) {
        $cellDate0am = mktime(0, 0, 0, $selectedMonth, $startDayIdx + $j, $selectedYear);
        if ($cellDate0am >= $firstDayOfSelectedMonth0am && $cellDate0am <= $lastDayOfSelectedMonth0am) {
          $cell_style = "";
          $link_style = "";

          // Handle weekends.
          if ($j == $weekend_start_idx || $j == $weekend_end_idx) {
            $cell_style = ' class="calendarDayWeekend"';
            $link_style = ' class="calendarLinkWeekend"';
          } else
            $cell_style = ' class="calendarDay"';

          // Handle holidays.
          $date_to_check = ttTimeHelper::dateInDatabaseFormat($selectedYear, $selectedMonth, $startDayIdx+$j);
          if ($handleHolidays && ttTimeHelper::isHoliday($date_to_check)) {
            $cell_style = ' class="calendarDayHoliday"';
            $link_style = ' class="calendarLinkHoliday"';
          }

          // Handle selected day.
          if ($selectedDate == strftime(DB_DATEFORMAT, $cellDate0am))
            $cell_style = ' class="calendarDaySelected"';

          $html .= '<td'.$cell_style.'>';
          // Handle days with existing entries.
          if ($active_dates) {
            // Entries exist.
            if (in_array(strftime(DB_DATEFORMAT, $cellDate0am), $active_dates)) {
              if ($handleNotCompleteDays && $this->highlight == 'time') {
                $day_total_minutes = ttTimeHelper::toMinutes(ttTimeHelper::getTimeForDay($date_to_check));
                if ($day_total_minutes >= $workday_minutes)
                  $link_style = ' class="calendarLinkRecordsExist"';
                else
                  $link_style = ' class="calendarLinkNonCompleteDay"';
              }
              else
                $link_style = ' class="calendarLinkRecordsExist"';
            }
          }
          $html .= "<a".$link_style." href=\"?".$this->name."=".strftime(DB_DATEFORMAT, $cellDate0am)."\" tabindex=\"-1\">".date("d",$cellDate0am)."</a>";
          $html .= "</td>";
        } else {
          $html .= "<td>&nbsp;</td>";
        }
      }
      $html .= "</tr>\n";
    }

    // Finished printing calendar table.

    // Print Today link.
    $html .= "  <tr><td colspan=\"7\" align=\"center\"><a id=\"today_link\" href=\"?".$this->name."=".strftime(DB_DATEFORMAT)."\" tabindex=\"-1\">".$i18n->get('label.today')."</a></td></tr>\n";
    $html .= "</table>\n";

    // Add a hidden control for selected date.
    $html .= "<input type=\"hidden\" name=\"$this->name\" value=\"$selectedDate\">\n";

    // Add script to adjust today link to match browser today, as PHP may run in a different timezone.
    $html .= "<script>\n";
    $html .= "function adjustToday() {\n";
    $html .= "  var browser_today = new Date();\n";
    $html .= "  document.getElementById('today_link').href = '?$this->name='+browser_today.strftime('".DB_DATEFORMAT."');\n";
    $html .= "}\n";
    $html .= "adjustToday();\n";
    $html .= "</script>\n";

    $html .= "<!-- end of calendar -->\n\n";
    return $html;
  }

  // getActiveDates returns an array of dates, for which entries exist for user.
  // Type of entries (time or expenses) is determined by $this->highlight value.
  function getActiveDates($start, $end) {
      
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
