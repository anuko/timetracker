<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('I18n');

// ttDate class is used to represent a date in Time Tracker.
// It is a planned replacement for DateAndTime class, which is problematic with php8.1.
class ttDate {

  var $year;          // year
  var $month;         // month
  var $day;           // day of month
  var $dayOfWeek;     // day of week
  var $unixTimestamp; // unix timestamp of our date

  var $isValid = false;

  // Additional property, used for efficiency when we only need a date in DB_DATEFORMAT.
  var $dateInDbDateFormat = null; // When initialized, this is our date in DB_DATEFORMAT.


  // Constructor.
  function __construct($dateString = null) {
    if (ttValidDbDateFormatDate($dateString)) {
      $this->dateInDbDateFormat = $dateString;
      $this->isValid = true;
    } else {
      $today = date_create();
      $this->dateInDbDateFormat = date_format($today, 'Y-m-d');
      $this->isValid = true;
    }

    $this->unixTimestamp = strtotime($this->dateInDbDateFormat);
    $this->year = date('Y', $this->unixTimestamp);
    $this->month = date('m', $this->unixTimestamp);
    $this->day = date('d', $this->unixTimestamp);
    $this->dayOfWeek = date('w', $this->unixTimestamp);
  }


  // isValid determines if we have a properly initialized ttDate object.
  function isValid() {
      return $this->isValid;
  }


  // Returns unix timestamp.
  function getTimestamp() {
    return $this->unixTimestamp;
  }


  // Resets the object properties from a passed in unix timestamp.
  function setFromUnixTimestamp($unixTimestamp) {
    $this->unixTimestamp = $unixTimestamp;

    $this->year = date('Y', $this->unixTimestamp);
    $this->month = date('m', $this->unixTimestamp);
    $this->day = date('d', $this->unixTimestamp);
    $this->dayOfWeek = date('w', $this->unixTimestamp);

    $this->dateInDbDateFormat = $this->year.'-'.$this->month.'-'.$this->day;
  }


  // toString returns a date in specified format.
  function toString($format = null) {
    if (!$this->isValid) return null;

    if ($format == null || $format == DB_DATEFORMAT)
      return $this->dateInDbDateFormat;
    else {
      return $this->formatDate($format);
    }
  }


  // formatDate returns a date string in specified format.
  function formatDate($format) {
    global $i18n;

    $formattedDate = $format; // Start with unmodified format string.

    // Replace all found elements with data.
    $formattedDate = str_replace('%Y', $this->year, $formattedDate);
    $formattedDate = str_replace('%m', $this->month, $formattedDate);
    $formattedDate = str_replace('%d', $this->day, $formattedDate);
    // Replace locale-dependent days of week.
    $formattedDate = str_replace('%a', mb_substr($i18n->getWeekDayName($this->dayOfWeek), 0, 3, 'utf-8'), $formattedDate);
    return $formattedDate;
  }


  function before(/*ttDate*/ $obj) {
    if ($this->getTimestamp() < $obj->getTimestamp()) return true;
    return false;
  }


  function after(/*ttDate*/ $obj) {
    if ($this->getTimestamp() > $obj->getTimestamp()) return true;
    return false;
  }
}
