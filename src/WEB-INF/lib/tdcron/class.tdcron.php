<?php

	define('IDX_MINUTE',			0);
	define('IDX_HOUR',			1);
	define('IDX_DAY',			2);
	define('IDX_MONTH',			3);
	define('IDX_WEEKDAY',			4);
	define('IDX_YEAR',			5);

	/*
	 * tdCron v0.0.1 beta - CRON-Parser for PHP
	 *
	 * Copyright (c) 2010 Christian Land / tagdocs.de
	 *
	 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
	 * associated documentation files (the "Software"), to deal in the Software without restriction,
	 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
	 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
	 * subject to the following conditions:
	 *
	 * The above copyright notice and this permission notice shall be included in all copies or substantial
	 * portions of the Software.
	 *
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
	 * LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN
	 * NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
	 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
	 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	 *
	 * @author	Christian Land <devel@tagdocs.de>
	 * @package	tdCron
	 * @copyright	Copyright (c) 2010, Christian Land / tagdocs.de
	 * @version	v0.0.1 beta
	 */
	class tdCron {

		/**
		 * Parsed cron-expressions cache.
		 * @var mixed
		 */
		static private $pcron = array();

		/**
		 * getNextOccurrence() uses a cron-expression to calculate the time and date at which a cronjob
		 * should be executed the next time. If a reference-time is passed, the next time and date
		 * after that time is calculated.
		 *
		 * @access	public
		 * @param	string		$expression	cron-expression to use
		 * @param	int		$timestamp	optional reference-time
		 * @return	int
		 */
		static public function getNextOccurrence($expression, $timestamp = null) {

			try {

				// Convert timestamp to array

				$next		= self::getTimestamp($timestamp);

				// Calculate date/time

				$next_time	= self::calculateDateTime($expression, $next);

			} catch (Exception $e) {

				throw $e;

			}

			// return calculated time

			return $next_time;

		}

		/**
		 * getLastOccurrence() does pretty much the same as getNextOccurrence(). The only difference
		 * is, that it doesn't calculate the next but the last time a cronjob should have been executed.
		 *
		 * @access	public
		 * @param	string		$expression	cron-expression to use
		 * @param	int		$timestamp	optional reference-time
		 * @return	int
		 */

		static public function getLastOccurrence($expression, $timestamp = null) {

			try {

				// Convert timestamp to array

				$last		= self::getTimestamp($timestamp);

				// Calculate date/time

				$last_time	= self::calculateDateTime($expression, $last, false);

			} catch (Exception $e) {

				throw $e;

			}

			// return calculated time

			return $last_time;

		}

		/**
		 * calculateDateTime() is the function where all the magic happens :-)
		 *
		 * It calculates the time and date at which the next/last call of a cronjob is/was due.
		 *
		 * @access	private
		 * @param	mixed		$value		cron-expression
		 * @param	mixed		$rtime		reference-time
		 * @param	bool		$next		true = nextOccurence, false = lastOccurence
		 * @return	int
		 */

		static private function calculateDateTime($expression, $rtime, $next = true) {

			// Initialize vars
 
			$calc_date	= true;

			// Parse cron-expression (if neccessary)

			$cron		= self::getExpression($expression, !$next);

			// OK, lets see if the day/month/weekday of the reference-date exist in our
			// $cron-array.

			if (!in_array($rtime[IDX_DAY], $cron[IDX_DAY]) ||
			    !in_array($rtime[IDX_MONTH], $cron[IDX_MONTH]) ||
			    !in_array($rtime[IDX_WEEKDAY], $cron[IDX_WEEKDAY])) {

				// OK, things are easy. The day/month/weekday of the reference time
				// can't be found in the $cron-array. This means that no matter what
				// happens, we WILL end up at at a different date than that of our
				// reference-time. And in this case, the lastOccurrence will ALWAYS
				// happen at the latest possible time of the day and the nextOccurrence
				// at the earliest possible time.
				//
				// In both cases, the time can be found in the first elements of the
				// hour/minute cron-arrays.

				$rtime[IDX_HOUR]	= reset($cron[IDX_HOUR]);
				$rtime[IDX_MINUTE]	= reset($cron[IDX_MINUTE]);

			} else {

				// OK, things are getting a little bit more complicated...
 
				$nhour		= self::findValue($rtime[IDX_HOUR], $cron[IDX_HOUR], $next);

				// Meh. Such a cruel world. Something has gone awry. Lets see HOW awry it went.

				if ($nhour === false) { // Fix as per http://www.phpclasses.org/discuss/package/6699/thread/3/

					// Ah, the hour-part went wrong. Thats easy. Wrong hour means that no
					// matter what we do we'll end up at a different date. Thus we can use
					// some simple operations to make things look pretty ;-)
					//
					// As alreasy mentioned before -> different date means earliest/latest
					// time:

					$rtime[IDX_HOUR]	= reset($cron[IDX_HOUR]);
					$rtime[IDX_MINUTE]	= reset($cron[IDX_MINUTE]);

					// Now all we have to do is add/subtract a day to get a new reference time
					// to use later to find the right date. The following line probably looks
					// a little odd but thats the easiest way of adding/substracting a day without
					// screwing up the date. Just trust me on that one ;-)

					$rtime			= explode(',', strftime('%M,%H,%d,%m,%w,%Y', mktime($rtime[IDX_HOUR], $rtime[IDX_MINUTE], 0, $rtime[IDX_MONTH], $rtime[IDX_DAY], $rtime[IDX_YEAR]) + ((($next) ? 1 : -1) * 86400)));

				} else {

					// OK, there is a higher/lower hour available. Check the minutes-part.

					$nminute	= self::findValue($rtime[IDX_MINUTE], $cron[IDX_MINUTE], $next);

					if ($nminute === false) {

						// No matching minute-value found... lets see what happens if we substract/add an hour

						$nhour		= self::findValue($rtime[IDX_HOUR] + (($next) ? 1 : -1), $cron[IDX_HOUR], $next);

						if ($nhour === false) {

							// No more hours available... add/substract a day... you know what happens ;-)

							$nminute	= reset($cron[IDX_MINUTE]);
							$nhour		= reset($cron[IDX_HOUR]);

							$rtime		= explode(',', strftime('%M,%H,%d,%m,%w,%Y', mktime($nhour, $nminute, 0, $rtime[IDX_MONTH], $rtime[IDX_DAY], $rtime[IDX_YEAR]) + ((($next) ? 1 : -1) * 86400)));

						} else {

							// OK, there was another hour. Set the right minutes-value

							$rtime[IDX_HOUR]	= $nhour;
							$rtime[IDX_MINUTE]	= (($next) ? reset($cron[IDX_MINUTE]) : end($cron[IDX_MINUTE]));

							$calc_date	= false;

						}

					} else {

						// OK, there is a matching minute... reset minutes if hour has changed

						if ($nhour <> $rtime[IDX_HOUR]) {
							$nminute		= reset($cron[IDX_MINUTE]);
						}

						// Set time
 
						$rtime[IDX_HOUR]	= $nhour;
						$rtime[IDX_MINUTE]	= $nminute;
 
						$calc_date	= false;

					}

				}

			}

			// If we have to calculate the date... we'll do so

			if ($calc_date) {

				if (in_array($rtime[IDX_DAY], $cron[IDX_DAY]) &&
				    in_array($rtime[IDX_MONTH], $cron[IDX_MONTH]) &&
				    in_array($rtime[IDX_WEEKDAY], $cron[IDX_WEEKDAY])) {

					return mktime($rtime[1], $rtime[0], 0, $rtime[3], $rtime[2], $rtime[5]);

				} else {

					// OK, some searching necessary...

					$cdate	= mktime(0, 0, 0, $rtime[IDX_MONTH], $rtime[IDX_DAY], $rtime[IDX_YEAR]);

					// OK, these three nested loops are responsible for finding the date...
					//
					// The class has 2 limitations/bugs right now:
					//
					//	-> it doesn't work for dates in 2036 or later!
					//	-> it will most likely fail if you search for a Feburary, 29th with a given weekday
					//	   (this does happen because the class only searches in the next/last 10 years! And
					//	   while it usually takes less than 10 years for a "normal" date to iterate through
					//	   all weekdays, it can take 20+ years for Feb, 29th to iterate through all weekdays!

					for ($nyear = $rtime[IDX_YEAR];(($next) ? ($nyear <= $rtime[IDX_YEAR] + 10) : ($nyear >= $rtime[IDX_YEAR] -10));$nyear = $nyear + (($next) ? 1 : -1)) {

						foreach ($cron[IDX_MONTH] as $nmonth) {

							foreach ($cron[IDX_DAY] as $nday) {

								if (checkdate($nmonth,$nday,$nyear)) {

									$ndate	= mktime(0,0,1,$nmonth,$nday,$nyear);

									if (($next) ? ($ndate >= $cdate) : ($ndate <= $cdate)) {

										$dow	= date('w',$ndate);

										// The date is "OK" - lets see if the weekday matches, too...

										if (in_array($dow,$cron[IDX_WEEKDAY])) {

											// WIN! :-) We found a valid date...

											$rtime			= explode(',', strftime('%M,%H,%d,%m,%w,%Y', mktime($rtime[IDX_HOUR], $rtime[IDX_MINUTE], 0, $nmonth, $nday, $nyear)));

											return mktime($rtime[1], $rtime[0], 0, $rtime[3], $rtime[2], $rtime[5]);

										}

									}

								}

							}

						}

					}

				}

				throw new Exception('Failed to find date, No matching date found in a 10 years range!', 10004);

			}

			return mktime($rtime[1], $rtime[0], 0, $rtime[3], $rtime[2], $rtime[5]);

		}

		/**
		 * getTimestamp() converts an unix-timestamp to an array. The returned array contains the following values:
		 *
		 *	[0]	-> minute
		 *	[1]	-> hour
		 *	[2]	-> day
		 *	[3]	-> month
		 *	[4]	-> weekday
		 *	[5]	-> year
		 *
		 * The array is used by various functions.
		 *
		 * @access	private
		 * @param	int		$timestamp	If none is given, the current time is used
		 * @return	mixed
		 */

		static private function getTimestamp($timestamp = null) {

			if (is_null($timestamp)) {
				$arr	= explode(',', strftime('%M,%H,%d,%m,%w,%Y', time()));
			} else {
				$arr	= explode(',', strftime('%M,%H,%d,%m,%w,%Y', $timestamp));
			}

			// Remove leading zeros (or we'll get in trouble ;-)

			foreach ($arr as $key=>$value) {
				$arr[$key]	= (int)ltrim($value,'0');
			}

			return $arr;

		}

		/**
		 * findValue() checks if the given value exists in an array. If it does not exist, the next
		 * higher/lower value is returned (depending on $next). If no higher/lower value exists,
		 * false is returned.
		 *
		 * @access	public
		 * @param	int		$value
		 * @param	mixed		$data
		 * @param	bool		$next
		 * @return	mixed
		 */

		static private function findValue($value, $data, $next = true) {

			if (in_array($value, $data)) {

				return (int)$value;

			} else {

				if (($next) ? ($value <= end($data)) : ($value >= end($data))) {

					foreach ($data as $curval) {

						if (($next) ? ($value <= (int)$curval) : ($curval <= $value)) {

							return (int)$curval;

						}

					}

				}

			}

			return false;

		}

		/**
		 * getExpression() returns a parsed cron-expression. Parsed cron-expressions are cached to reduce
		 * unneccessary calls of the parser.
		 *
		 * @access	public
		 * @param	string		$value
		 * @param	bool		$reverse
		 * @return	mixed
		 */

		 static private function getExpression($expression, $reverse=false) {

			// First of all we cleanup the expression and remove all duplicate tabs/spaces/etc.
			// For example "*              * *    * *" would be converted to "* * * * *", etc.

			$expression	= preg_replace('/(\s+)/', ' ', strtolower(trim($expression)));

			// Lets see if we've already parsed that expression

 			if (!isset(self::$pcron[$expression])) {

				// Nope - parse it!

				try {

					self::$pcron[$expression]		= tdCronEntry::parse($expression);
					self::$pcron['reverse'][$expression]	= self::arrayReverse(self::$pcron[$expression]);

				} catch (Exception $e) {

					throw $e;

				}

			}

			return ($reverse ? self::$pcron['reverse'][$expression] : self::$pcron[$expression]);

		}

		/**
		 * arrayReverse() reverses all sub-arrays of our cron array. The reversed values are used for calculations
		 * that are run when getLastOccurence() is called.
		 *
		 * @access	public
		 * @param	mixed		$cron
		 * @return	mixed
		 */

 		static private function arrayReverse($cron) {

			foreach ($cron as $key=>$value) {

				$cron[$key]	= array_reverse($value);

			}

			return $cron;

		}

	}