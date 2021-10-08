<?php

	/**
	 * tinyCronEntry is part of tdCron. Its a class to parse Cron-Expressions like "1-45 1,2,3 1-30/5 January,February Mon,Tue"
	 * and convert it to an easily useable format.
	 *
	 * The parser is quite powerful and understands pretty much everything you will ever find in a Cron-Expression.
	 *
	 * A Cron-Expression consists of 5 segments:
	 *
	 * <pre>
	 *  .---------------- minute (0 - 59)
	 *  |   .------------- hour (0 - 23)
	 *  |   |   .---------- day of month (1 - 31)
	 *  |   |   |   .------- month (1 - 12)
	 *  |   |   |   |  .----- day of week (0 - 6)
	 *  |   |   |   |  |
	 *  *   *   *   *  *
	 * </pre>
	 *
	 * Each segment can contain values, ranges and intervals. A range is always written as "value1-value2" and
	 * intervals as "value1/value2".
	 *
	 * Of course each segment can contain multiple values seperated by commas.
	 *
	 * Some valid examples:
	 *
	 * <pre>
	 * 1,2,3,4,5
	 * 1-5
	 * 10-20/*
	 * Jan,Feb,Oct
	 * Monday-Friday
	 * 1-10,15,20,40-50/2
	 * </pre>
	 *
	 * The current version of the parser understands all weekdays and month names in german and english!
	 *
	 * Usually you won't need to call this class directly.
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
	 * @package	tinyCron
	 * @subpackage	tinyCronEntry
	 * @copyright	Copyright (c) 2010, Christian Land / tagdocs.de
	 * @version	v0.0.1 beta
	 */

	class tdCronEntry {

		/**
		 * The parsed cron-expression.
		 * @var mixed
		 */
		static private $cron		= array();

		/**
		 * Ranges.
		 * @var mixed
		 */
		static private $ranges		= array(
							IDX_MINUTE		=> array( 'min'	=> 0,
											  'max'	=> 59	),	// Minutes
							IDX_HOUR		=> array( 'min'	=> 0,
											  'max'	=> 23	),	// Hours
							IDX_DAY			=> array( 'min'	=> 1,
											  'max'	=> 31	),	// Days
							IDX_MONTH		=> array( 'min'	=> 1,
											  'max'	=> 12	),	// Months
							IDX_WEEKDAY		=> array( 'min'	=> 0,
											  'max'	=> 7	)	// Weekdays
						);

		/**
		 * Named intervals.
		 * @var mixed
		 */
		static private $intervals	= array(
							'@yearly'	=> '0 0 1 1 *',
							'@annualy'	=> '0 0 1 1 *',
							'@monthly'	=> '0 0 1 * *',
							'@weekly'	=> '0 0 * * 0',
							'@midnight'	=> '0 0 * * *',
							'@daily'	=> '0 0 * * *',
							'@hourly'	=> '0 * * * *'
							);


		/**
		 * Possible keywords for months/weekdays.
		 * @var mixed
		 */
		static private $keywords	= array(
							IDX_MONTH	=> array(
										'/(january|januar|jan)/i'			=> 1,
										'/(february|februar|feb)/i'			=> 2,
										'/(march|maerz|märz|mar|mae|mär)/i'		=> 3,
										'/(april|apr)/i'				=> 4,
										'/(may|mai)/i'					=> 5,
										'/(june|juni|jun)/i'				=> 6,
										'/(july|juli|jul)/i'				=> 7,
										'/(august|aug)/i'				=> 8,
										'/(september|sep)/i'				=> 9,
										'/(october|oktober|okt|oct)/i'			=> 10,
										'/(november|nov)/i'				=> 11,
										'/(december|dezember|dec|dez)/i'		=> 12
										),
							IDX_WEEKDAY	=> array(
										'/(sunday|sonntag|sun|son|su|so)/i'		=> 0,
										'/(monday|montag|mon|mo)/i'			=> 1,
										'/(tuesday|dienstag|die|tue|tu|di)/i'		=> 2,
										'/(wednesdays|mittwoch|mit|wed|we|mi)/i'	=> 3,
										'/(thursday|donnerstag|don|thu|th|do)/i'	=> 4,
										'/(friday|freitag|fre|fri|fr)/i'		=> 5,
										'/(saturday|samstag|sam|sat|sa)/i'		=> 6
										)
							);

		/**
		 * parseExpression() analyses crontab-expressions like "* * 1,2,3 * mon,tue" and returns an array
		 * containing all values. If it can't be parsed, an exception is thrown.
		 *
		 * @access		public
		 * @param		string		$expression	The cron-expression to parse.
		 * @return		mixed
		 */

		static public function parse($expression) {

			// Convert named expressions if neccessary

			if (substr($expression,0,1) == '@') {

				$expression	= strtr($expression, self::$intervals);

				if (substr($expression,0,1) == '@') {

					// Oops... unknown named interval!?!!
					throw new Exception('Unknown named interval ['.$expression.']', 10000);

				}

			}

			// Next basic check... do we have 5 segments?

			$cron	= explode(' ',$expression);

			if (count($cron) <> 5) {

				// No... we haven't...
				throw new Exception('Wrong number of segments in expression. Expected: 5, Found: '.count($cron), 10001);

			} else {

				// Yup, 5 segments... lets see if we can work with them

				foreach ($cron as $idx=>$segment) {

					try {

						$dummy[$idx]	= self::expandSegment($idx, $segment);

					} catch (Exception $e) {

						throw $e;

					}

				}

			}

			return $dummy;

		}

		/**
		 * expandSegment() analyses a single segment
		 *
		 * @access		public
		 * @param		void
		 * @return		void
		 */

		static private function expandSegment($idx, $segment) {

			// Store original segment for later use

			$osegment	= $segment;

			// Replace months/weekdays like "January", "February", etc. with numbers

	                if (isset(self::$keywords[$idx])) {

	                	$segment	= preg_replace(
	                					array_keys(self::$keywords[$idx]),
	                					array_values(self::$keywords[$idx]),
	                					$segment
	                					);

			}

			// Replace wildcards

			if (substr($segment,0,1) == '*') {

				$segment	= preg_replace('/^\*(\/\d+)?$/i',
								self::$ranges[$idx]['min'].'-'.self::$ranges[$idx]['max'].'$1',
								$segment);

			}

			// Make sure that nothing unparsed is left :)

			$dummy		= preg_replace('/[0-9\-\/\,]/','',$segment);

			if (!empty($dummy)) {

				// Ohoh.... thats not good :-)
				throw new Exception('Failed to parse segment: '.$osegment, 10002);

			}

			// At this point our string should be OK - lets convert it to an array

			$result		= array();
			$atoms		= explode(',',$segment);

			foreach ($atoms as $curatom) {

				$result	= array_merge($result, self::parseAtom($curatom));

			}

			// Get rid of duplicates and sort the array

			$result		= array_unique($result);
			sort($result);

			// Check for invalid values

			if ($idx == IDX_WEEKDAY) {

				if (end($result) == 7) {

					if (reset($result) <> 0) {
						array_unshift($result, 0);
					}

					array_pop($result);

				}

			}

			foreach ($result as $key=>$value) {

				if (($value < self::$ranges[$idx]['min']) || ($value > self::$ranges[$idx]['max'])) {
					throw new Exception('Failed to parse segment, invalid value ['.$value.']: '.$osegment, 10003);
				}

			}

			return $result;

		}

		/**
		 * parseAtom() analyses a single segment
		 *
		 * @access		public
		 * @param		string		$atom		The segment to parse
		 * @return		array
		 */

		static private function parseAtom($atom) {

			$expanded	= array();

			if (preg_match('/^(\d+)-(\d+)(\/(\d+))?/i', $atom, $matches)) {

				$low	= $matches[1];
				$high	= $matches[2];

				if ($low > $high) {
					list($low,$high)	= array($high,$low);
				}

				$step	= isset($matches[4]) ? $matches[4] : 1;

				for($i = $low; $i <= $high; $i += $step) {
					$expanded[]	= (int)$i;
				}

			} else {

				$expanded[]	= (int)$atom;

			}

			$expanded2	= array_unique($expanded);

			return $expanded;

		}

	}