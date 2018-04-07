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

// Report all errors except E_NOTICE and E_STRICT.
// Ignoring E_STRICT is here because PEAR 1.9.4 that we use is not E_STRICT compliant.
if (!defined('E_STRICT')) define('E_STRICT', 2048);
// if (!defined('E_DEPRECATED')) define('E_DEPRECATED', 8192);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT); // & ~E_DEPRECATED);
// E_ALL tends to change as PHP evloves, therefore we use & here instead of exclusive OR (^).

// Disable displaying errors on screen.
ini_set('display_errors', 'Off');

// require_once('init_auth.php');
define("APP_DIR", dirname(__FILE__));
define("LIBRARY_DIR", APP_DIR."/WEB-INF/lib");
define("TEMPLATE_DIR", APP_DIR."/WEB-INF/templates");
// Date format for database and URI parameters.
define('DB_DATEFORMAT', '%Y-%m-%d');

require_once(LIBRARY_DIR.'/common.lib.php');

// Require the configuration file with application settings.
if (!file_exists(APP_DIR."/WEB-INF/config.php")) die ("WEB-INF/config.php file does not exist.");
require_once("WEB-INF/config.php");
// Check whether DSN is defined.
if (!defined("DSN")) {
  die ("DSN value is not defined. Check your config.php file.");
}

// Depending on DSN, require either mysqli or mysql extensions.
if (strrpos(DSN, 'mysqli://', -strlen(DSN)) !== FALSE) {
  check_extension('mysqli'); // DSN starts with mysqli:// - require mysqli extension.
}
if (strrpos(DSN, 'mysql://', -strlen(DSN)) !== FALSE) {
  check_extension('mysql');  // DSN starts with mysql:// - require mysql extension.
}

// Require other extensions.
check_extension('mbstring');

// If auth params are not defined (in config.php) - initialize with an empty array.
if (!isset($GLOBALS['AUTH_MODULE_PARAMS']) || !is_array($GLOBALS['AUTH_MODULE_PARAMS']))
  $GLOBALS['AUTH_MODULE_PARAMS'] = array();

// Smarty initialization.
import('smarty.Smarty');
$smarty = new Smarty;
$smarty->use_sub_dirs = false;
$smarty->template_dir = TEMPLATE_DIR;
$smarty->compile_dir  = TEMPLATE_DIR.'_c';

// Note: these 3 settings below used to be in .htaccess file. Moved them here to eliminate "error 500" problems
// with some shared hostings that do not have AllowOverride Options or AllowOverride All in their apache configurations.
// Change http cache expiration time to 1 minute.
session_cache_expire(1);

$phpsessid_ttl = defined('PHPSESSID_TTL') ? PHPSESSID_TTL : 60*60*24;
// Set lifetime for garbage collection.
ini_set('session.gc_maxlifetime', $phpsessid_ttl);
// Set PHP session path, if defined to avoid garbage collection interference from other scripts.
if (defined('PHP_SESSION_PATH')) {
  ini_set('session.save_path', PHP_SESSION_PATH);
  ini_set('session.gc_probability', 1);
}

// Set session cookie lifetime.
session_set_cookie_params($phpsessid_ttl);
if (isset($_COOKIE['tt_PHPSESSID'])) {
  // Extend PHP session cookie lifetime by PHPSESSID_TTL (if defined, otherwise 24 hours) 
  // so that users don't have to re-login during this period from now. 
  setcookie('tt_PHPSESSID', $_COOKIE['tt_PHPSESSID'],  time() + $phpsessid_ttl, '/');
}

// Start or resume PHP session.
session_name('tt_PHPSESSID'); // "tt_" prefix is to avoid sharing session with other PHP apps that do not name session.
@session_start();

// Authorization.
import('Auth');
$auth = Auth::factory(AUTH_MODULE, $GLOBALS['AUTH_MODULE_PARAMS']);

// Some defines we'll need.
//
define('RESOURCE_DIR', APP_DIR.'/WEB-INF/resources');
define('COOKIE_EXPIRE', 60*60*24*30); // Cookies expire in 30 days.

// Status values for projects, users, etc.
define('ACTIVE', 1);
define('INACTIVE', 0);
// define('DELETED', -1); // DELETED items should have a NULL status. This allows us to have duplicate NULL status entries with existing indexes.

// Definitions for tracking mode types.
define('MODE_TIME', 0); // Tracking time only. There are no projects or tasks.
define('MODE_PROJECTS', 1); // Tracking time per projects. There are no tasks.
define('MODE_PROJECTS_AND_TASKS', 2); // Tracking time for projects and tasks.

// Definitions of types for time records.
define('TYPE_ALL', 0); // Time record can be specified with either duration or start and finish times.
define('TYPE_START_FINISH', 1); // Time record has start and finish times.
define('TYPE_DURATION', 2); // Time record has only duration, no start and finish times.

define('CHARSET', 'utf-8');

date_default_timezone_set(@date_default_timezone_get());

// Strip auto-inserted extra slashes when magic_quotes ON for PHP versions prior to 5.4.0.
if (get_magic_quotes_gpc())
  magic_quotes_off();

// Initialize global objects that are needed for the application.
import('html.HttpRequest');
$request = new ttHttpRequest();

import('form.ActionErrors');
$err = new ActionErrors(); // Error messages for user.
$msg = new ActionErrors(); // Notification messages (not errrors) for user.

// Create an instance of ttUser class. This gets us most of user details.
import('ttUser');
$user = new ttUser(null, $auth->getUserId());
if ($user->custom_logo) {
  $smarty->assign('custom_logo', 'images/'.$user->group_id.'.png');
  $smarty->assign('mobile_custom_logo', '../images/'.$user->group_id.'.png');
}
$smarty->assign('user', $user);

// Localization.
import('I18n');
$i18n = new I18n();

// Determine the language to use.
$lang = $user->lang;
if (!$lang) {
  if (defined('LANG_DEFAULT'))
    $lang = LANG_DEFAULT;

  // If we still do not have the language get it from the browser.
  if (!$lang) {
    $lang = $i18n->getBrowserLanguage();

    // Finally - English is the default.
    if (!$lang) {
      $lang = 'en';
    }
  }
}

// Load i18n file.
$i18n->load($lang);

// Assign things for smarty to use in template files.
$smarty->assign('i18n', $i18n->keys);
$smarty->assign('err', $err);
$smarty->assign('msg', $msg);

// TODO: move this code out of here to the files that use it.

// We use js/strftime.js to print dates in JavaScript (in DateField controls).
// One of our date formats (%d.%m.%Y %a) prints a localized short weekday name (%a).
// The init_js_date_locale function iniitializes Date.ext.locales array in js/strftime.js for our language
// so that we could print localized short weekday names.
//
// JavaScript usage (see http://hacks.bluesmoon.info/strftime/localisation.html).
//
// var d = new Date();
// d.locale = "fr";           // Remember to initialize locale.
// d.strftime("%d.%m.%Y %a"); // This will output a localized %a as in "31.05.2013 Ven"

// Initialize date locale for JavaScript.
init_js_date_locale();

function init_js_date_locale()
{
  global $i18n, $smarty;
  $lang = $i18n->lang;

  $days = $i18n->weekdayNames;
  $short_day_names = array();
  foreach($days as $k => $v) {
    $short_day_names[$k] = mb_substr($v, 0, 3, 'utf-8');
  }

  /*
  $months = $i18n->monthNames;
  $short_month_names = array();
  foreach ($months as $k => $v) {
    $short_month_names[$k] = mb_substr($v, 0, 3, 'utf-8');
  }
  $js = "Date.ext.locales['$lang'] = {
      a: ['" . join("', '", $short_day_names) . "'],
      A: ['" . join("', '", $days) . "'],
      b: ['" . join("', '", $short_month_names) . "'],
      B: ['" . join("', '", $months) . "'],
      c: '%a %d %b %Y %T %Z',
      p: ['', ''],
      P: ['', ''],
      x: '%Y-%m-%d',
      X: '%T'
    };"; */
  // We use %a in one of date formats. Therefore, simplified code here (instead of the above block).
  // %p is also used on the Profile page in 12-hour time format example. Note that %p is not localized.
  $js = "Date.ext.locales['$lang'] = {
      a: ['" . join("', '", $short_day_names) . "'],
      p: ['AM', 'PM']
    };";
  $smarty->assign('js_date_locale', $js);
}
