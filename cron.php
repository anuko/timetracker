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

/*
 * cron.php - this file is an entry point to execute scheduled jobs in Time Tracker.
 * It must be called externally (for example, from the system cron or task scheduler).
 * 
 * Internally, we store scheduled jobs in tt_cron table in db. The cron_spec field is in cron format.
 * Along with it, we store last and next timestamps for jobs, we use them as an execute condition.
 * 
 * Although cron_spec follows 5-field cron specification precisely, actual job timing depends on
 * how often cron.php is called. For example, an hourly ping will execute jobs no more than once
 * each hour, even if they are due more often. Configure whatever calls this file accordingly.
 */

require_once('initialize.php');
require_once(LIBRARY_DIR.'/tdcron/class.tdcron.php');
require_once(LIBRARY_DIR.'/tdcron/class.tdcron.entry.php');
import('ttFavReportHelper');
import('ttReportHelper');

$mdb2 = getConnection();
$now = time();

 $sql = "select c.id, c.cron_spec, c.report_id, c.email, c.cc, c.subject, c.report_condition from tt_cron c
   left join tt_fav_reports fr on (c.report_id = fr.id)
   where $now >= c.next and fr.status = 1
   and c.status = 1 and c.report_id is not null and c.email is not null";
$res = $mdb2->query($sql);
if (is_a($res, 'PEAR_Error'))
  exit();

while ($val = $res->fetchRow()) {
  // We have jobs to execute in user language.

  // Get favorite report details.
  $report = ttFavReportHelper::getReport($val['report_id']);
  if (!$report) continue; // Skip not found report.

  // Recycle global $user object, as user settings are specific for each report.
  $user = new ttUser(null, $report['user_id']);
  if (!$user->id) continue; // Skip not found user.
  // Recycle $i18n object because language is user-specific.
  $i18n->load($user->lang);

  // Check condition on a report.
  $condition_ok = true;
  if ($val['report_condition'])
    $condition_ok = ttReportHelper::checkFavReportCondition($report, $val['report_condition']);

  // Email report if condition is okay.
  if ($condition_ok) {
    if (ttReportHelper::sendFavReport($report, $val['subject'], $val['email'], $val['cc']))
      echo "Report ".$val['report_id']. " sent.<br>";
    else
      echo "Error while emailing report...<br>";
  }

  // Calculate next execution time.
  $next = tdCron::getNextOccurrence($val['cron_spec'], $now + 60); // +60 sec is here to get us correct $next when $now is close to existing "next".
                                                                   // This is because the accuracy of tdcron class appears to be 1 minute.

  // Update last and next values in tt_cron.
  $sql = "update tt_cron set last = $now, next = $next where id = ".$val['id'];
  $affected = $mdb2->exec($sql);
  if (is_a($affected, 'PEAR_Error')) continue;
}

echo "Done!";
