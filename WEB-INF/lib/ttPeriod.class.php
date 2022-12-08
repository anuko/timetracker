<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

define('INTERVAL_THIS_DAY', 1);
define('INTERVAL_THIS_WEEK', 2);
define('INTERVAL_THIS_MONTH', 3);
define('INTERVAL_THIS_YEAR', 4);
define('INTERVAL_ALL_TIME', 5);
define('INTERVAL_PREVIOUS_WEEK', 6);
define('INTERVAL_PREVIOUS_MONTH', 7);
define('INTERVAL_PREVIOUS_DAY', 8);

class ttPeriod {
  var $startDate; // ttDate object.
  var $endDate;   // ttDate object.


  function __construct($ttDateInstance, $period_type = INTERVAL_THIS_MONTH) {

    global $user;
    $weekStartDay = $user->getWeekStart();

    $t_arr = localtime($ttDateInstance->getTimestamp());
    $t_arr[5] = $t_arr[5] + 1900;
    $startWeekBias = ($t_arr[6] < $weekStartDay) ? $weekStartDay - 7 : $weekStartDay;

    $this->startDate = new ttDate();
    $this->endDate = new ttDate();

    switch ($period_type) {
      case INTERVAL_THIS_DAY:
        $this->startDate->setFromUnixTimestamp($ttDateInstance->getTimestamp());
        $this->endDate->setFromUnixTimestamp($ttDateInstance->getTimestamp());
        break;

      case INTERVAL_PREVIOUS_DAY:
        $this->startDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-1,$t_arr[5]));
        $this->endDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-1,$t_arr[5]));
        break;

      case INTERVAL_THIS_WEEK:
        $this->startDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+$startWeekBias,$t_arr[5]));
        $this->endDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+6+$startWeekBias,$t_arr[5]));
        break;

      case INTERVAL_PREVIOUS_WEEK:
        $this->startDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]-7+$startWeekBias,$t_arr[5]));
        $this->endDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]-1+$startWeekBias,$t_arr[5]));
        break;

      case INTERVAL_THIS_MONTH:
	$this->startDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,1,$t_arr[5]));
	$this->endDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+2,0,$t_arr[5]));
	break;

      case INTERVAL_PREVIOUS_MONTH:
        $this->startDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4],1,$t_arr[5]));
        $this->endDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,0,$t_arr[5]));
        break;

      case INTERVAL_THIS_YEAR:
	$this->startDate->setFromUnixTimestamp(mktime(0,0,0,1,1,$t_arr[5]));
	$this->endDate->setFromUnixTimestamp(mktime(0,0,0,12,31,$t_arr[5]));
	break;
      }
    }

  // Sets period to designated start and and dates.
  function setPeriod($start_date, $end_date) {
    $this->startDate = $start_date;
    $this->endDate = $end_date;
  }

  // Returns start date in specified format.
  function getStartDate($format = null) {
    return $this->startDate->toString($format);
  }


  // Returns end date in specified format.
  function getEndDate($format = null) {
    return $this->endDate->toString($format);
  }
}