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

class Period {
  var $startDate;
  var $endDate;

  function __construct($period_type = 0, $date_point = null) {

    global $user;

    if (!$date_point || !($date_point instanceof DateAndTime))
      $date_point = new DateAndTime();

    // TODO: refactoring ongoing down from here. Make code nicer, etc.
    $weekStartDay = $user->week_start;

		$date_begin = new DateAndTime();
		$date_begin->setFormat($date_point->getFormat());
		$date_end = new DateAndTime();
		$date_end->setFormat($date_point->getFormat());
		$t_arr = localtime($date_point->getTimestamp());
		$t_arr[5] = $t_arr[5] + 1900;

		if ($t_arr[6] < $weekStartDay) {
		  $startWeekBias = $weekStartDay - 7;
		} else {
		  $startWeekBias = $weekStartDay;
		}

		switch ($period_type) {
			case INTERVAL_THIS_DAY:
				$date_begin->setTimestamp($date_point->getTimestamp());
				$date_end->setTimestamp($date_point->getTimestamp());
			break;
			case INTERVAL_THIS_WEEK:
			  $date_begin->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+$startWeekBias,$t_arr[5]));
				$date_end->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+6+$startWeekBias,$t_arr[5]));
			break;
			case INTERVAL_LAST_WEEK:
				$date_begin->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]-7+$startWeekBias,$t_arr[5]));
				$date_end->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]-1+$startWeekBias,$t_arr[5]));
			break;
			case INTERVAL_THIS_MONTH:
				$date_begin->setTimestamp(mktime(0,0,0,$t_arr[4]+1,1,$t_arr[5]));
				$date_end->setTimestamp(mktime(0,0,0,$t_arr[4]+2,0,$t_arr[5]));
			break;
			case INTERVAL_LAST_MONTH:
				$date_begin->setTimestamp(mktime(0,0,0,$t_arr[4],1,$t_arr[5]));
				$date_end->setTimestamp(mktime(0,0,0,$t_arr[4]+1,0,$t_arr[5]));
			break;

			case INTERVAL_THIS_YEAR:
				$date_begin->setTimestamp(mktime(0, 0, 0, 1, 1, $t_arr[5]));
				$date_end->setTimestamp(mktime(0, 0, 0, 12, 31, $t_arr[5]));
			break;
		}
		$this->startDate	= &$date_begin;
		$this->endDate		= &$date_end;
	}

	/**
	 * Return all days by period
	 *
	 * @return array
	 */
	function getAllDays() {
		$ret_array = array();
		if ($this->startDate->before($this->endDate)) {
			$d = $this->getBegin();
			while ($d->before($this->getEnd())) {
				array_push($ret_array, $d);
				$d = $d->nextDate();
			}
			array_push($ret_array, $d);
		} else {
			array_push($ret_array, $this->startDate);
		}
  		return $ret_array;
	}

	function setPeriod($b_date, $e_date) {
		$this->startDate = $b_date;
		$this->endDate = $e_date;
	}

	// return date object
	function getBegin() {
		return $this->startDate;
	}

	// return date object
	function getEnd() {
		return $this->endDate;
	}

	// return date string
	function getBeginDate($format="") {
		return $this->startDate->toString($format);
	}

	// return date string
	function getEndDate($format="") {
		return $this->endDate->toString($format);
	}

	function getArray($format="") {
		$result = array();
		$d = $this->getBegin();
		while ($d->before($this->getEnd())) {
			$result[] = $d->toString($format);
			$d = $d->nextDate();
		}
		return $result;
	}
}
