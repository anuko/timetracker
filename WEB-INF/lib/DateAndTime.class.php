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

/**
 * Parse a time/date generated with strftime().
 *
 * This function is the same as the original one defined by PHP (Linux/Unix only),
 *  but now you can use it on Windows too.
 *  Limitation : Only this format can be parsed %S, %M, %H, %d, %m, %Y
 *
 * @author Lionel SAURON
 * @version 1.0
 * @public
 *
 * @param $sDate(string)    The string to parse (e.g. returned from strftime()).
 * @param $sFormat(string)  The format used in date  (e.g. the same as used in strftime()).
 * @return (array)          Returns an array with the <code>$sDate</code> parsed, or <code>false</code> on error.
 */

function my_strptime($sDate, $sFormat)
{
    $aResult = array
    (
        'tm_sec'   => 0,
        'tm_min'   => 0,
        'tm_hour'  => 0,
        'tm_mday'  => 1,
        'tm_mon'   => 0,
        'tm_year'  => 0,
        'tm_wday'  => 0,
        'tm_yday'  => 0,
        'unparsed' => $sDate,
    );

    while($sFormat != "")
    {
        // ===== Search a %x element, Check the static string before the %x =====
        $nIdxFound = strpos($sFormat, '%');
        if($nIdxFound === false)
        {

            // There is no more format. Check the last static string.
            $aResult['unparsed'] = ($sFormat == $sDate) ? "" : $sDate;
            break;
        }

        $sFormatBefore = mb_substr($sFormat, 0, $nIdxFound);
        $sDateBefore   = mb_substr($sDate,   0, $nIdxFound);

        if($sFormatBefore != $sDateBefore) break;

        // ===== Read the value of the %x found =====
        $sFormat = mb_substr($sFormat, $nIdxFound);
        $sDate   = mb_substr($sDate,   $nIdxFound);

        $aResult['unparsed'] = $sDate;

        $sFormatCurrent = mb_substr($sFormat, 0, 2);
        $sFormatAfter   = mb_substr($sFormat, 2);

        $nValue = -1;
        $sDateAfter = "";
        switch($sFormatCurrent)
        {
            case '%S': // Seconds after the minute (0-59)

                sscanf($sDate, "%2d%[^\\n]", $nValue, $sDateAfter);

                if(($nValue < 0) || ($nValue > 59)) return false;

                $aResult['tm_sec']  = $nValue;
                break;

            // ----------
            case '%M': // Minutes after the hour (0-59)
                sscanf($sDate, "%2d%[^\\n]", $nValue, $sDateAfter);

                if(($nValue < 0) || ($nValue > 59)) return false;

                $aResult['tm_min']  = $nValue;
                break;

            // ----------
            case '%H': // Hour since midnight (0-23)
                sscanf($sDate, "%2d%[^\\n]", $nValue, $sDateAfter);

                if(($nValue < 0) || ($nValue > 23)) return false;

                $aResult['tm_hour']  = $nValue;
                break;

            // ----------
            case '%d': // Day of the month (1-31)
                sscanf($sDate, "%2d%[^\\n]", $nValue, $sDateAfter);

                if(($nValue < 1) || ($nValue > 31)) return false;

                $aResult['tm_mday']  = $nValue;
                break;

            // ----------
            case '%m': // Months since January (0-11)
                sscanf($sDate, "%2d%[^\\n]", $nValue, $sDateAfter);

                if(($nValue < 1) || ($nValue > 12)) return false;

                $aResult['tm_mon']  = ($nValue - 1);
                break;

            // ----------
            case '%Y': // Years since 1900
                sscanf($sDate, "%4d%[^\\n]", $nValue, $sDateAfter);

                if($nValue < 1900) return false;

                $aResult['tm_year']  = ($nValue - 1900);
                break;

            // ----------
            default:
              //sscanf($sDate, "%s%[^\\n]", $skip, $sDateAfter);
              preg_match('/^(.+)(\s|$)/uU', $sDate, $matches);
              if (isset($matches[1])) {
                $sDateAfter = mb_substr($sDate, mb_strlen($matches[1]));
              } else {
                $sDateAfter = '';
              }
              //break 2; // Break Switch and while
              break;
        }

        // ===== Next please =====
        $sFormat = $sFormatAfter;
        $sDate   = $sDateAfter;

        $aResult['unparsed'] = $sDate;

    } // END while($sFormat != "")


    // ===== Create the other value of the result array =====
    $nParsedDateTimestamp = mktime($aResult['tm_hour'], $aResult['tm_min'], $aResult['tm_sec'],
                            $aResult['tm_mon'] + 1, $aResult['tm_mday'], $aResult['tm_year'] + 1900);

    // Before PHP 5.1 return -1 when error
    if(($nParsedDateTimestamp === false)
    ||($nParsedDateTimestamp === -1)) return false;

    $aResult['tm_wday'] = (int) strftime("%w", $nParsedDateTimestamp); // Days since Sunday (0-6)
    $aResult['tm_yday'] = (strftime("%j", $nParsedDateTimestamp) - 1); // Days since January 1 (0-365)

    return $aResult;
} // END of function

class DateAndTime {
  var $mHour = 0;
  var $mMinute = 0;
  var $mSecond = 0;
  var $mMonth;
  var $mDay;   // day of week
  var $mDate;  // day of month
  var $mYear;
  var $mIntrFormat = "%d.%m.%Y %H:%M:%S"; //29.02.2004 16:21:42 internal format date
  var $mLocalFormat;
  var $mParseResult = 0;
  var $mAutoComplete = true;

  /**
   * Constructor
   *
   * @param String $format
   * @param String $strfDateTime
   * @return DateAndTime
   */
  function __construct($format="",$strfDateTime="") {
    $this->mLocalFormat = ($format ? $format : $this->mIntrFormat);
    $d = ($strfDateTime ? $strfDateTime : $this->do_strftime($this->mLocalFormat));
    $this->parseVal($d);
  }

  function setFormat($format) {
    $this->mLocalFormat = $format;
  }

  function getFormat() {
    return $this->mLocalFormat;
  }

  //01 to 31
  function getDate() { return $this->mDate; }

  //0 (for Sunday) through 6 (for Saturday)
  function getDay() { return $this->mDay; }

  //01 through 12
  function getMonth() { return $this->mMonth; }

  //1999 or 2003
  function getYear() { return $this->mYear; }

  function setDate($value) { $this->mDate = $value; }
  function setMonth($value) { $this->mMonth = $value; }
  function setYear($value) { $this->mYear = $value; }

  function setTimestamp($ts) {
    $this->mDate = date("d",$ts);
    $this->mDay = date("w",$ts);
    $this->mMonth = date("m",$ts);
    $this->mYear = date("Y",$ts);
    $this->mHour = date("H",$ts);
    $this->mMinute = date("i",$ts);
    $this->mSecond = date("s",$ts);
  }

  /**
   * Return UNIX timestamp
   */
  function getTimestamp() {
    return @mktime($this->mHour, $this->mMinute, $this->mSecond, $this->mMonth, $this->mDate, $this->mYear);
  }

  function compare($datetime) {
    $ts1 = $this->getTimestamp();
    $ts2 = $datetime->getTimestamp();
    if ($ts1<$ts2) return -1;
    if ($ts1==$ts2) return 0;
    if ($ts1>$ts2) return 1;
  }

  function toString($format="") {
    if ($this->mParseResult==0) {
      if ($format) {
        return $this->do_strftime($format, $this->getTimestamp());
      } else {
        return $this->do_strftime($this->mLocalFormat, $this->getTimestamp());
      }
    } else {
      if ($format) {
        return $this->do_strftime($format);
      } else {
        return $this->do_strftime($this->mLocalFormat);
      }
    }
  }

  function parseVal($szDate, $format="") {
    $useformat = ($format ? $format : $this->mLocalFormat);
    $res = my_strptime($szDate, $useformat);
    if ($res !== false) {
      $this->mDate = $res['tm_mday'];
      $this->mDay = $res['tm_wday'];
      $this->mMonth = $res['tm_mon'] + 1; // tm_mon - Months since January (0-11)
      $this->mYear = 1900 + $res['tm_year']; // tm_year - Years since 1900
      $this->mHour = $res['tm_hour'];
      $this->mMinute = $res['tm_min'];
      $this->mSecond = $res['tm_sec'];
      $this->mParseResult = 0;
    } elseif ($this->mAutoComplete) {
      $this->setTimestamp(time());
      $this->mParseResult = 1;
    }
  }

  function isError() {
    if ($this->mParseResult != 0) return true;
    return false;
  }

  function before(/*DateAndTime*/ $obj) {
    if ($this->getTimestamp() < $obj->getTimestamp()) return true;
    return false;
  }

  function after(/*DateAndTime*/ $obj) {
    if ($this->getTimestamp() > $obj->getTimestamp()) return true;
    return false;
  }

  function equals(/*DateAndTime*/ $obj) {
    if ($this->getTimestamp() == $obj->getTimestamp()) return true;
    return false;
  }

  function decDay(/*int*/$days=1) {
    $this->setTimestamp(@mktime($this->mHour, $this->mMinute, $this->mSecond, $this->mMonth, $this->mDate - $days, $this->mYear));
  }

  function incDay(/*int*/$days=1) {
    $this->setTimestamp(@mktime($this->mHour, $this->mMinute, $this->mSecond, $this->mMonth, $this->mDate + $days, $this->mYear));
  }

  /**
   * @param $format string Datetime format string
   * @return string Preprocessed string with all locale-depended format
   *                characters replaced by localized i18n strings.
   */
  function preprocessFormatString($format) {
    global $i18n;

    // replace locale-dependent strings
    $format = str_replace('%a', mb_substr($i18n->getWeekDayName($this->mDay), 0, 3, 'utf-8'), $format);
    $format = str_replace('%A', $i18n->getWeekDayName($this->mDay), $format);
    $abbrev_month = mb_substr($i18n->monthNames[$this->mMonth], 0, 3, 'utf-8');
    $format = str_replace('%b', $abbrev_month, $format);
    $format = str_replace('%h', $abbrev_month, $format);
    $format = str_replace('%z', date('O'), $format);
    $format = str_replace('%Z', date('O'), $format); // format as 'O' for consistency with JS strftime
    if (strpos($format, '%c') !== false) {
      $format = str_replace('%c', $this->preprocessFormatString('%a %d %b %Y %T %Z'), $format);
    }
    return $format;
  }

  function do_strftime($format, $timestamp = null)
  {
    if (!is_null($timestamp)) {
      return strftime($this->preprocessFormatString($format), $timestamp);
    } else {
      return strftime($this->preprocessFormatString($format));
    }
  }
}
