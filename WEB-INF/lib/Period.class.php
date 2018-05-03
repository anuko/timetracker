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

define('INTERVAL_THIS_DAY', 1);
define('INTERVAL_THIS_WEEK', 2);
define('INTERVAL_THIS_MONTH', 3);
define('INTERVAL_THIS_YEAR', 4);
define('INTERVAL_ALL_TIME', 5);
define('INTERVAL_LAST_WEEK', 6);
define('INTERVAL_LAST_MONTH', 7);
define('INTERVAL_LAST_DAY', 8);

/*
// Definitions for refactored code. TODO: uncomment when done.
define('INTERVAL_ALL_TIME', 0);
define('INTERVAL_CURRENT_YEAR', 10);
define('INTERVAL_PREVIOUS_YEAR', 14);
define('INTERVAL_SELECTED_YEAR', 18);
define('INTERVAL_CURRENT_MONTH', 20);
define('INTERVAL_PREVIOUS_MONTH', 24);
define('INTERVAL_SELECTED_MONTH', 28);
define('INTERVAL_CURRENT_WEEK', 30);
define('INTERVAL_PREVIOUS_WEEK', 34);
define('INTERVAL_SELECTED_WEEK', 38);
define('INTERVAL_CURRENT_DAY', 40);
define('INTERVAL_PREVIOUS_DAY', 44);
define('INTERVAL_SELECTED_DAY', 48);
*/

// TODO: Refactoring is needed for this class. Probably by refactoring DateAndTime first, as Period is
// basically a collection of 2 DateAndTime instances.
//
// Second problem is that "today" is (most likely?) server today, so reports may give incorrect dates
// for browser users in different time zones. Verify and fix this.
class Period {
  var $startDate; // DateAndTime object.
  var $endDate;   // DateAndTime object.

  function __construct($period_type = 0, $date_point = null) {

    global $user;

    if (!$date_point || !($date_point instanceof DateAndTime))
      $date_point = new DateAndTime(); // Represents current date. TODO: verify this is needed, as this is server time, not browser today.

    // TODO: refactoring ongoing down from here. Make code nicer, etc.
    $weekStartDay = $user->week_start;

		$this->startDate = new DateAndTime();
		$this->startDate->setFormat($date_point->getFormat());
		$this->endDate = new DateAndTime();
		$this->endDate->setFormat($date_point->getFormat());
		$t_arr = localtime($date_point->getTimestamp());
		$t_arr[5] = $t_arr[5] + 1900;

		if ($t_arr[6] < $weekStartDay) {
		  $startWeekBias = $weekStartDay - 7;
		} else {
		  $startWeekBias = $weekStartDay;
		}

		switch ($period_type) {
			case INTERVAL_THIS_DAY:
                            $this->startDate->setTimestamp($date_point->getTimestamp());
                            $this->endDate->setTimestamp($date_point->getTimestamp());
                        break;

                        case INTERVAL_LAST_DAY:
                            $this->startDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-1,$t_arr[5]));
                            $this->endDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-1,$t_arr[5]));
                        break;

			case INTERVAL_THIS_WEEK:
			  $this->startDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+$startWeekBias,$t_arr[5]));
				$this->endDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+6+$startWeekBias,$t_arr[5]));
			break;
			case INTERVAL_LAST_WEEK:
				$this->startDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]-7+$startWeekBias,$t_arr[5]));
				$this->endDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]-1+$startWeekBias,$t_arr[5]));
			break;
			case INTERVAL_THIS_MONTH:
				$this->startDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,1,$t_arr[5]));
				$this->endDate->setTimestamp(mktime(0,0,0,$t_arr[4]+2,0,$t_arr[5]));
			break;
			case INTERVAL_LAST_MONTH:
				$this->startDate->setTimestamp(mktime(0,0,0,$t_arr[4],1,$t_arr[5]));
				$this->endDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,0,$t_arr[5]));
			break;

			case INTERVAL_THIS_YEAR:
				$this->startDate->setTimestamp(mktime(0, 0, 0, 1, 1, $t_arr[5]));
				$this->endDate->setTimestamp(mktime(0, 0, 0, 12, 31, $t_arr[5]));
			break;
		}
	}

	function setPeriod($b_date, $e_date) {
		$this->startDate = $b_date;
		$this->endDate = $e_date;
	}

	// return date string
	function getStartDate($format="") {
		return $this->startDate->toString($format);
	}

	// return date string
	function getEndDate($format="") {
		return $this->endDate->toString($format);
	}
}
