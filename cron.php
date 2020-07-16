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

$sql = "select c.id, c.cron_spec, c.report_id, c.email, c.cc, c.subject, c.comment, c.report_condition from tt_cron c".
  " inner join tt_fav_reports fr on".
  " (c.report_id = fr.id and c.group_id = fr.group_id and c.org_id = fr.org_id)". // Report for a correct group.
  " inner join tt_users u on (u.id = fr.user_id and u.status = 1)". // Report for an active user.
  " where $now >= c.next and fr.status = 1". // Due now.
  " and c.status = 1 and c.report_id is not null and c.email is not null";
$res = $mdb2->query($sql);
if (is_a($res, 'PEAR_Error'))
  exit();

while ($val = $res->fetchRow()) {
  // We have jobs to execute in user language.

  // Get favorite report details.
  $options = ttFavReportHelper::getReportOptions($val['report_id']);
  if (!$options) continue; // Skip not found report.

  // Recycle global $user object, as user settings are specific for each report.
  $user = new ttUser(null, $options['user_id']);
  if (!$user->id) continue; // Skip not found user.

  // Avoid complications with impersonated users, possibly from subgroups.
  // Note: this may happen when cron.php is called by a browser who already impersonates.
  // This is not supposed to happen in automatic cron job.
  if ($user->behalf_id)
    continue; // Skip processing on behalf situations entirely.

  // TODO: write a new function ttFavReportHelper::adjustOptions that will use
  // a $user object recycled above. Put user handling below into it.
  // Also adjust remaining options for potentially changed user access rights and group properties.
  // For example, tracking mode may have changed, but fav report options are still old...
  // This needs to be fixed.
  $options = ttFavReportHelper::adjustOptions($options);

  // Skip users with disabled Notifications plugin.
  if (!$user->isPluginEnabled('no')) continue;

  // Recycle $i18n object because language is user-specific.
  $i18n->load($user->lang);

  // Check condition on a report.
  $condition_ok = true;
  if ($val['report_condition'])
    $condition_ok = ttReportHelper::checkFavReportCondition($options, $val['report_condition']);

  // Email report if condition is okay.
  if ($condition_ok) {
    if (ttReportHelper::sendFavReport($options, $val['subject'], $val['comment'], $val['email'], $val['cc']))
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
