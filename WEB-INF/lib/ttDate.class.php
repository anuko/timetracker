<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('I18n');

// ttDate class is used to represent a date in Time Tracker.
class ttDate {

  var $year;          // year
  var $month;         // month
  var $day;           // day of month
  var $dayOfWeek;     // day of week
  var $unixTimestamp; // unix timestamp of our date

  // Additional property, used for efficiency when we only need a date in DB_DATEFORMAT.
  var $dateInDbDateFormat = null; // When initialized, this is our date in DB_DATEFORMAT.


  // Constructor.
  function __construct($dateString = null, $dateFormat = null) {

    $dateInDbDateFormat = null;

    if (!is_null($dateFormat)) {
      // Depending on passed in format, prepare $dateInDbDateFormat.
      switch ($dateFormat) {
        case '%Y-%m-%d':
          if (preg_match('/^\d\d\d\d-\d\d-\d\d$/', $dateString)) {
            $date_parts = explode('-', $dateString);
            if (checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
              // $dateString is valid as per specified format. Create $dateInDbDateFormat.
              $dateInDbDateFormat = $dateString;
            }
          }
          break;

        case '%m/%d/%Y':
          if (preg_match('/^\d\d\/\d\d\/\d\d\d\d$/', $dateString)) {
            $date_parts = explode('/', $dateString);
            if (checkdate($date_parts[0], $date_parts[1], $date_parts[2])) {
              // $dateString is valid as per specified format. Create $dateInDbDateFormat.
              $dateInDbDateFormat = $date_parts[2].'-'.$date_parts[0].'-'.$date_parts[1];
            }
          }
          break;

        case '%d-%m-%Y':
          if (preg_match('/^\d\d\-\d\d\-\d\d\d\d$/', $dateString)) {
            $date_parts = explode('-', $dateString);
            if (checkdate($date_parts[1], $date_parts[0], $date_parts[2])) {
              // $dateString is valid as per specified format. Create $dateInDbDateFormat.
              $dateInDbDateFormat = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
            }
          }
          break;

        case '%d.%m.%Y':
          if (preg_match('/^\d\d\.\d\d\.\d\d\d\d$/', $dateString)) {
            $date_parts = explode('.', $dateString);
            if (checkdate($date_parts[1], $date_parts[0], $date_parts[2])) {
              // $dateString is valid as per specified format. Create $dateInDbDateFormat.
              $dateInDbDateFormat = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
            }
          }
          break;

        case '%d.%m.%Y %a':
          if (preg_match('/^\d\d\.\d\d\.\d\d\d\d .+$/', $dateString)) {
            $date_parts = explode('.', $dateString);
            $date_parts[2] = substr($date_parts[2], 0, 4); // Ignore localized day of week.
            if (checkdate($date_parts[1], $date_parts[0], $date_parts[2])) {
              // $dateString is valid as per specified format. Create $dateInDbDateFormat.
              $dateInDbDateFormat = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
            }
          }
          break;
      }
    } else {
     $dateInDbDateFormat = $dateString;
    }

    if (ttValidDbDateFormatDate($dateInDbDateFormat)) {
      $this->dateInDbDateFormat = $dateInDbDateFormat;
    } else {
      $today = date_create();
      $this->dateInDbDateFormat = date_format($today, 'Y-m-d');
    }

    $this->unixTimestamp = strtotime($this->dateInDbDateFormat);
    $this->year = date('Y', $this->unixTimestamp);
    $this->month = date('m', $this->unixTimestamp);
    $this->day = date('d', $this->unixTimestamp);
    $this->dayOfWeek = date('w', $this->unixTimestamp);
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


  function compare(/*ttDate*/ $obj) {
    $ts1 = $this->getTimestamp();
    $ts2 = $obj->getTimestamp();
    if ($ts1 < $ts2) return -1;
    if ($ts1 == $ts2) return 0;
    if ($ts1 > $ts2) return 1;
  }


  // Getters.
  function getYear() { return $this->year; }
  function getMonth() { return $this->month; }
  function getDay() { return $this->day; }
  function getDayOfWeek() { return $this->dayOfWeek; }


  // incrementDay increments our date by a number of days.
  function incrementDay(/*int*/ $days = 1) {
    $this->setFromUnixTimestamp(@mktime(0, 0, 0, $this->month, $this->day + $days, $this->year));
  }


  // decrementDay decrements our date by a number of days.
  function decrementDay(/*int*/ $days = 1) {
    $this->setFromUnixTimestamp(@mktime(0, 0, 0, $this->month, $this->day - $days, $this->year));
  }


  // A static function to obtain a date in DB_DATEFORMAT from a Unix timestamp.
  static function dateFromUnixTimestamp($unixTimestamp = null) {
    if ($unixTimestamp == null) {
      $today = date_create();
      return date_format($today, 'Y-m-d');
    }

    $year = date('Y', $unixTimestamp);
    $month = date('m', $unixTimestamp);
    $day = date('d', $unixTimestamp);
    $dateInDbFormat = $year.'-'.$month.'-'.$day;
    return $dateInDbFormat;
  }
}
