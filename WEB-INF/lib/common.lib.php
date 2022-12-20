<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// import() function loads a class.
function import($class_name) {
  $libs = array(
    dirname($_SERVER["SCRIPT_FILENAME"]),
    LIBRARY_DIR
  );

	    $pos = strpos($class_name, ".");
        if (!($pos === false)) {
            $peaces = explode(".", $class_name);
            $p = "";
            for ($i=0; $i<count($peaces)-1; $i++) {
                $p = $p . "/" . $peaces[$i];
            }
			$libs = array_merge(array(LIBRARY_DIR . $p),$libs);
            $class_name = $peaces[count($peaces)-1];
        }

		$filename = $class_name . '.class.php';

		foreach($libs as $lib) {
			$inc_filename = $lib . '/' . $filename;
			if (file_exists($inc_filename)) {
					require_once($inc_filename);
					return $class_name;
			}
		}

		print '<br><b>load_class: error loading file "'.$filename.'"</b>';
		die();
}

	// The mu_sort function is used to sort a multi-dimensional array.
	// It looks like the code example is taken from the PHP manual http://ca2.php.net/manual/en/function.sort.php
	function mu_sort($array, $key_sort) {
		$n = 0;
		if (!is_array($array) || count($array)==0)
			return array();

		$key_sorta = explode(",", $key_sort);
		$keys = array_keys($array[0]);

		for($m=0; $m < count($key_sorta); $m++) {
			$nkeys[$m] = trim($key_sorta[$m]);
		}
		$n += count($key_sorta);

		for($i=0; $i < count($keys); $i++) {
			if(!in_array($keys[$i], $key_sorta)) {
				$nkeys[$n] = $keys[$i];
				$n += "1";
			}
		}

		for($u=0;$u<count($array); $u++) {
			$arr = $array[$u];
			for($s=0; $s<count($nkeys); $s++) {
				$k = $nkeys[$s];
				$output[$u][$k] = $array[$u][$k];
			}
		}
		sort($output);
		return $output;
	}

	/**
	 * return float type
	 *
	 * @param unknown $value
	 * @return unknown
	 */
	function toFloat($value) {
		if (isset($value) && (strlen($value) > 0)) {
			$value = str_replace(",",".",$value);
			return floatval($value);
		}
		return null;
	}

	function &getConnection() {
        if (!isset($GLOBALS["_MDB2_CONNECTION"])) {

        	require_once('MDB2.php');

        	$mdb2 = MDB2::connect(DSN);
			if (is_a($mdb2, 'PEAR_Error')) {
    			die($mdb2->getMessage());
			}

			$mdb2->setFetchMode(MDB2_FETCHMODE_ASSOC);
			
   			$GLOBALS["_MDB2_CONNECTION"] = $mdb2;
    	}
      	return $GLOBALS["_MDB2_CONNECTION"];
	}


// time_to_decimal converts a time string such as 1:15 to its decimal representation such as 1.25 or 1,25.
function time_to_decimal($val) {
  global $user;
  $parts = explode(':', $val); // parts[0] is hours, parts[1] is minutes.

  $minutePercent = round($parts[1]*100/60); // Integer value (0-98) of percent of minutes portion in the hour.
  if($minutePercent < 10) $minutePercent = '0'.$minutePercent; // Pad small values with a 0 to always have 2 digits.

  $decimalTime = $parts[0].$user->decimal_mark.$minutePercent; // Construct decimal representation of time value.

  return $decimalTime;
}

// check_extension checks whether a required PHP extension is loaded and dies if not so.
function check_extension($ext)
{
  if (!extension_loaded($ext))
    die("PHP extension '{$ext}' is required but is not loaded. Read Time Tracker Install Guide for help.");
}

// isTrue is a helper function to return correct false for older config.php values defined as a string 'false'.
function isTrue($val)
{
  return (defined($val) && constant($val) === true);
}

// ttValidString is used to check user input to validate a string.
function ttValidString($val, $emptyValid = false)
{
  if (is_null($val)) {
    return $emptyValid ? true : false;
  }

  $val = trim($val);
  if (strlen($val) == 0 && !$emptyValid)
    return false;

  // String must not be XSS evil (to insert JavaScript).
  if (stristr($val, '<script>') || stristr($val, '<script '))
    return false;

  return true;    
}

// ttValidCss is used to check user input for custom css.
function ttValidCss($val)
{
  $val = trim($val);
  if (strlen($val) == 0)
    return true;

  // String must not contain any tags.
  if (stristr($val, '<'))
    return false;

  // Security note: the above may not be enough.
  // Currently it is unclear how vulnerable we are assuming custom css is available only to a logged on user
  // (one custom css per group).
  // However, if abuse occurs or when the issue is better understood, we may have to rewrite this function,
  // perhaps by specifying what exactly we allow to style.
  return true;
}

// ttValidTranslation is used to check user input for custom translation.
function ttValidTranslation($val)
{
  $val = trim($val);
  if (strlen($val) == 0)
    return true;

  // Validate lines.
  $lines = preg_split("/\r\n|\n|\r/", $val);
  for ($i = 0; $i < count($lines); $i++) {
    if (!ttValidTranslationLine($lines[$i]))
      return false;
  }

  return true;
}

// ttValidTranslationLine is used to check an individual line in custom translation.
function ttValidTranslationLine($val)
{
  $val = trim($val);
  if (strlen($val) == 0)
    return false; // Empty line is not valid.

  $parts = explode('=', $val);
  if (count($parts) != 2) {
    // We need exactly 2 parts.
    return false;
  }

  $key = trim($parts[0]);
  global $i18n;
  if (!$i18n->keyExists($key)) {
    // Key does not exist.
    return false;
  }

  return true;
}

// ttValidTemplateText is used to check template-based user input.
// When templates are used, required input parts must be filled by user.
// We identify these parts by 3 "stop sign" emojis (aka "octagonal sign" U+1F6D1).
function ttValidTemplateText($val)
{
  $valid = strpos($val, '🛑🛑🛑') === false; // no 3 "stop sign" emojis in a row.
  return $valid;
}

// ttValidEmail is used to check user input to validate an email string.
function ttValidEmail($val, $emptyValid = false)
{
  $val = trim($val);
  if (strlen($val) == 0)
    return ($emptyValid ? true : false);
  	
  // String must not be XSS evil (to insert JavaScript).
  if (stristr($val, '<script>') || stristr($val, '<script '))
    return false;
    
  // Validate a single email address. TODO: improve for compliancy with RFC.
  if (!preg_match("/^[_a-zA-Z\d\'-\.]+@([_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+)$/", $val))
    return false;
  
  return true;    
}

// ttValidEmailList is used to check user input to validate an email string.
function ttValidEmailList($val, $emptyValid = false)
{
  $val = trim($val);
  if (strlen($val) == 0)
    return ($emptyValid ? true : false);
  	
  // String must not be XSS evil (to insert JavaScript).
  if (stristr($val, '<script>') || stristr($val, '<script '))
    return false;
    
  // Validates a list of email addresses separated by a comma with optional spaces.
  if (!preg_match("/^[_a-zA-Z\d\'-\.]+@([_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+)(,\s*[_a-zA-Z\d\'-\.]+@([_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+))*$/", $val))
    return false;
    
  return true;
}

// ttValidFloat is used to check user input to validate a float value.
function ttValidFloat($val, $emptyValid = false)
{
  $val = trim($val);
  if (strlen($val) == 0)
    return ($emptyValid ? true : false);
    
  global $user;
  $decimal = $user->getDecimalMark();
	
  if (!preg_match('/^-?[0-9'.$decimal.']+$/', $val))
    return false;
    
  return true;    
}

// ttValidStatus is used to check user input to validate a status value.
function ttValidStatus($val)
{
  if (null == $val)
    return true;

  if (!ttValidInteger($val))
    return false;

  $intVal = (int) $val; // Cast to int for comparisons below to work.
  if ($intVal != ACTIVE && $intVal != INACTIVE)
    return false;

  return true;
}

// ttValidDate is used to check user input to validate a date.
function ttValidDate($val)
{
  if (is_null($val))
    return false;

  $val = trim($val);
  if (strlen($val) == 0)
    return false;

  global $user;
  $dateFormat = $user->getDateFormat();

  switch ($dateFormat) {
    case '%Y-%m-%d':
      if (preg_match('/^\d\d\d\d-\d\d-\d\d$/', $val)) {
        // Validate a string in format 'YYYY-MM-DD'.
        $date_parts = explode('-', $val);
        return checkdate($date_parts[1], $date_parts[2], $date_parts[0]);
      }
      break;
    case '%m/%d/%Y':
      if (preg_match('/^\d\d\/\d\d\/\d\d\d\d$/', $val)) {
        // Validate a string in format 'MM/DD/YYYY'.
        $date_parts = explode('/', $val);
        return checkdate($date_parts[0], $date_parts[1], $date_parts[2]);
      }
      break;
    case '%d-%m-%Y':
      if (preg_match('/^\d\d\-\d\d\-\d\d\d\d$/', $val)) {
        // Validate a string in format 'DD-MM-YYYY'.
        $date_parts = explode('-', $val);
        return checkdate($date_parts[1], $date_parts[0], $date_parts[2]);
      }
      break;
    case '%d.%m.%Y':
      if (preg_match('/^\d\d\.\d\d\.\d\d\d\d$/', $val)) {
        // Validate a string in format 'DD.MM.YYYY'.
        $date_parts = explode('.', $val);
        return checkdate($date_parts[1], $date_parts[0], $date_parts[2]);
      }
      break;
    case '%d.%m.%Y %a':
      if (preg_match('/^\d\d\.\d\d\.\d\d\d\d .+$/', $val)) {
        // Validate a string in format 'DD.MM.YYYY whatever'.
        $date_parts = explode('.', $val);
        $date_parts[2] = substr($date_parts[2], 0, 4); // Ignore localized day of week.
        return checkdate($date_parts[1], $date_parts[0], $date_parts[2]);
      }
      break; 
    
  }
  return false;
}

// ttValidDbDateFormatDate is used to check user input to validate a date in DB_DATEFORMAT.
function ttValidDbDateFormatDate($val)
{
  if (is_null($val) || strlen($val) == 0)
    return false;

  // This should validate a string in format 'YYYY-MM-DD'.
  if (!preg_match('/^\d\d\d\d-\d\d-\d\d$/', $val))
    return false;

  $date_parts = explode('-', $val);
  return checkdate($date_parts[1], $date_parts[2], $date_parts[0]);
}

// ttValidTime is used to check user input for time post.
function ttValidTime($val)
{
  if (is_null($val) || strlen($val) == 0)
    return false;

  // This should validate a time string in 24 hour format hh:mm.
  if (!preg_match('/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/', $val))
    return false;

  return true;
}

// ttValidInteger is used to check user input to validate an integer.
function ttValidInteger($val, $emptyValid = false)
{
  $val = trim($val);
  if (strlen($val) == 0)
    return ($emptyValid ? true : false);
    
  if (!preg_match('/^[0-9]+$/', $val))
    return false;

  return true;
}

// ttValidCronSpec is used to check user input to validate cron specification.
function ttValidCronSpec($val)
{
  // This code is adapted from http://stackoverflow.com/questions/235504/validating-crontab-entries-w-php
  $numbers= array(
     'min'=>'[0-5]?\d',
     'hour'=>'[01]?\d|2[0-3]',
     'day'=>'0?[1-9]|[12]\d|3[01]',
     'month'=>'[1-9]|1[012]',
     'dow'=>'[0-7]'
  );

  foreach($numbers as $field=>$number) {
    $range= "($number)(-($number)(\/\d+)?)?";
    $field_re[$field]= "\*(\/\d+)?|$range(,$range)*";
  }

  $field_re['month'].='|jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec';
  $field_re['dow'].='|mon|tue|wed|thu|fri|sat|sun';

  $fields_re= '('.join(')\s+(', $field_re).')';

  /*
  $replacements= '@reboot|@yearly|@annually|@monthly|@weekly|@daily|@midnight|@hourly';

  $regexp = '^\s*('.
                '$'.
                '|#'.
                '|\w+\s*='.
                "|$fields_re\s+\S".
                "|($replacements)\s+\S".
            ')';
   */
  // The above block from the link did not work for me.

  // But this works.
  $regexp = '/^'.$fields_re.'$/';
	
  if (!preg_match($regexp, $val))
    return false;

  return true;
}

// ttValidCondition is used to check user input to validate a notification condition.
function ttValidCondition($val, $emptyValid = true)
{
  $val = trim($val);
  if (strlen($val) == 0)
    return ($emptyValid ? true : false);

  // String must not be XSS evil (to insert JavaScript).
  if (stristr($val, '<script>') || stristr($val, '<script '))
    return false;

  if (!preg_match("/^count\s?(=|[<>]=?|<>)\s?\d+$/", $val) &&
      !preg_match("/^hours\s?(=|[<>]=?|<>)\s?\d+$/", $val))
    return false;

  return true;
}

// ttValidIP is used to check user input to validate a comma-separated
// list of IP subnet "prefixes", for example 192.168.0 (note: no .* in the end).
// We keep regexp checks here simple - they are not precise.
// For example, IPv4-mapped IPv6 addresses will fail. This may need to be fixed.
function ttValidIP($val, $emptyValid = false)
{
  $val = trim($val);
  if (strlen($val) == 0 && $emptyValid)
    return true;

  $subnets = explode(',', $val);
  foreach ($subnets as $subnet) {
    $ipv4 = preg_match('/^\d\d?\d?(\.\d\d?\d?){0,3}\.?$/', $subnet); // Not precise check.
    $ipv6 = preg_match('/^([0-9a-fA-F]{4})(:[0-9a-fA-F]{4}){0,7}$/', $subnet); // Not precise check.
    if (!$ipv4 && !$ipv6)
      return false;
  }
  return true;
}

// ttValidHolidays is used to check user input to validate holidays spec.
// To keep things simple, the format is a comma-separated list of dates:
// ****-01-01,****-12-31,2019-04-20
// The above means Jan 1 and Dec 31 are holidays in all years, while Apr 20 is only in 2019.
function ttValidHolidays($val)
{
  $val = trim($val);
  if (strlen($val) == 0) return true;

  $dates = explode(',', $val);
  foreach ($dates as $date) {
    if (!preg_match('/^[\d*]{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/', $date))
      return false;
  }
  return true;
}

// ttValidPasswordComplexity is used to check user input for password complexity field.
function ttValidPasswordComplexity($complexityExample)
{
  // Password complexity example may contain a-z, A-Z, 0-9, #, and *.
  if (!preg_match('/^[a-zA-Z0-9#*]*$/', $complexityExample))
    return false;

  return true;
}

// ttCheckPasswordComplexity checks password complexity.
function ttCheckPasswordComplexity($password)
{
  global $user;
  $complexity = $user->getPasswordComplexity();
  if (empty($complexity))
    return true;

  // Password complexity must be enforced.
  if (strlen($password) < strlen($complexity))
    return false; // Password is too short.

  $numDigitsRequired = preg_match_all( "/[0-9]/", $complexity);
  $numDigitsSupplied = preg_match_all( "/[0-9]/", $password);
  if ($numDigitsSupplied < $numDigitsRequired)
    return false; // Number of digits in password is less than required number in complexity example.

  $numCapitalsRequired = preg_match_all( "/[A-Z]/", $complexity);
  $numCapitalsSupplied = preg_match_all( "/[A-Z]/", $password);
  if ($numCapitalsSupplied < $numCapitalsRequired)
    return false; // Number of capitals A-Z in password is less than required number in complexity example.

  $numLowercaseRequired = preg_match_all( "/[a-z]/", $complexity);
  $numLowercaseSupplied = preg_match_all( "/[a-z]/", $password);
  if ($numLowercaseSupplied < $numLowercaseRequired)
    return false; // Number of lowercase letter a-z in password is less than required number in complexity example.

  // Finally check the number of "all other" characters that are not alphanumeric. This includes utf-8 characters.
  $numNotAlphanumericRequired = preg_match_all( "/[#]/", $complexity);
  $passwordRemainder = preg_replace("/[a-zA-Z0-9]/", "", $password);
  $numNotAlphanumericSupplied = mb_strlen($passwordRemainder);
  if ($numNotAlphanumericSupplied < $numNotAlphanumericRequired)
    return false;

  return true;
}


// ttAccessAllowed checks whether user is allowed access to a particular page.
// It is used as an initial check on all publicly available pages
// (except login.php, register.php, and others where we don't have to check).
function ttAccessAllowed($required_right)
{
  global $auth;
  global $user;

  // Redirect to login page if user is not authenticated.
  if (!$auth->isAuthenticated()) {
    header('Location: login.php');
    exit();
  }

  // Protection against cross site request forgery.
  if (!ttMitigateCSRF())
    return false;

  // Check IP restriction, if set.
  if ($user->allow_ip && !$user->can('override_allow_ip')) {
    $access_allowed = false;
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $allowed_ip_array = explode(',', $user->allow_ip);
    foreach ($allowed_ip_array as $allowed_ip) {
      $len = strlen($allowed_ip);
      if (substr($user_ip, 0, $len) === $allowed_ip) { // startsWith check.
         $access_allowed = true;
         break;
      }
    }
    if (!$access_allowed) return false;
  }

  // Check if user has the right.
  if (in_array($required_right, $user->rights)) {
    import('ttUserHelper');
    ttUserHelper::updateLastAccess();
    return true;
  }

  return false;
}

// ttMitigateCSRF verifies request headers in an attempt to block cross site request forgery.
function ttMitigateCSRF() {
  // No need to do anything for get requests.
  global $request;
  if ($request->isGet())
    return true;

  $origin = $_SERVER['HTTP_ORIGIN'];
  if ($origin) {
    $pos = strpos($origin, '//');
    $origin = substr($origin, $pos+2); // Strip protocol.
  }
  if (!$origin) {
    // Try using referer.
    $origin = $_SERVER['HTTP_REFERER'];
    if ($origin) {
      $pos = strpos($origin, '//');
      $origin = substr($origin, $pos+2); // Strip protocol.
      $pos = strpos($origin, '/');
      $origin = substr($origin, 0, $pos); // Leave host only.
    }
  }
  $target = defined('HTTP_TARGET') ? HTTP_TARGET : $_SERVER['HTTP_HOST'];
  if (strcmp($origin, $target)) {
    error_log("Potential cross site request forgery. Origin: '$origin' does not match target: '$target'.");
    return false; // Origin and target do not match.
  }

  return true;
}

// ttStartsWith function checks if a string starts with a given substring.
function ttStartsWith($string, $startString)
{
  if (is_null($string))
    return false;

  $len = strlen($startString);
  return (substr($string, 0, $len) === $startString);
}

// ttEndsWith function checks if a string ends with a given substring.
function ttEndsWith($string, $endString)
{
  $len = strlen($endString);
  if ($len == 0) return true;
  return (substr($string, -$len) === $endString);
}

// ttContains function checks if a string contains a given substring.
function ttContains($string, $part)
{
  // Note: in php8 we can use str_contanins.
  if (strpos($string, $part) !== false)
    return true;

  return false;
}

// ttDateToUserFormat converts a date from database format to user format.
function ttDateToUserFormat($date)
{
  global $user;
  $o_date = new ttDate($date);
  return $o_date->toString($user->date_format);
}

// ttRandomString generates a random alphanumeric string.
function ttRandomString($length = 32) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

// ttNeutralizeForCsv neutralizes user input for export to CSV files
// by removing =, +, -, and @ characters from the beginning of cell values.
// This mitigates a risk of CSV injection, see https://owasp.org/www-community/attacks/CSV_Injection
// Additionally, it replaces each quote character with a double quote.
function ttNeutralizeForCsv($val) {
  $result = ltrim($val, '=+-@');
  return str_replace('"', '""', $result);
}
