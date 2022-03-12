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
// | https://www.anuko.com/time-tracker/credits.htm
// +----------------------------------------------------------------------+

import('ttRoleHelper');

// ttCronJobHelper class will be used to execute scheduled jobs in Time Tracker.
//
// This is work in progress, NOT FINISHED.
//
// Current complication is with global $user object and a difficulty to achieve
// separation between user-specific tasks that utilize $user object and
// cron jobs, that must work for ALL users. Specifically, report body building
// heavily relies on $user.
//
// An instance will be created in cron.php by an external call to it.
// Then the exec method is called to execute all jobs that are due.
class ttCronJobHelper {

  var $reports = array(); // A list of reports to email.

  // Constructor. Constructs a list of reports to send.
  function __construct() {
    $mdb2 = getConnection();
    $now = time();

    // Note: review security implications each time this query is revised.
    // Because:
    //   1) There is no logged on user to reduce scope.
    //   2) Query may be executed by anonymous http get (of cron.php).
    //
    // Therefore, in query make sure we obtain only relevant info.
    $sql = "select c.id, c.cron_spec, c.report_id, c.email, c.cc, c.subject, c.report_condition from tt_cron c".
      " inner join tt_fav_reports fr on".
      " (c.report_id = fr.id and c.group_id = fr.group_id and c.org_id = fr.org_id)". // Report for a correct group.
      " inner join tt_users u on (u.id = fr.user_id and u.status = 1)". // Report for an active user.
      " where $now >= c.next and fr.status = 1". // Due now.
      " and c.status = 1 and c.report_id is not null and c.email is not null";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return;
    while ($val = $res->fetchRow()) {
      $this->reports[] = $val;
    }
  }

  // exec - processes reports one at a time by sending each out.
  function exec() {
    foreach ($this->reports as $report) {
      // Get favorite report details.
      $options = $this->getReportOptions($report['report_id']);
      if (!$options) continue; // Skip not found report.

      // Recycle global $user object, as user settings are specific for each report.
      unset($user);
      $user = new ttUser(null, $options['user_id']);
      if (!$user->id) continue; // Skip not found user.

      // Avoid complications with impersonated users, possibly from subgroups.
      // Note: this may happen when cron.php is called by a browser who already impersonates.
      // This is not supposed to happen in automatic cron job.
      if ($user->behalf_id)
        continue; // Skip processing on behalf situations entirely.

      // TODO: coding ongoing here. Not finished. Add other processing when ready.

    }
  }

  // getReportOptions - returns an array of fav report options from database data.
  private function getReportOptions($id) {
    $mdb2 = getConnection();

    $sql = "select * from tt_fav_reports where id = $id and status = 1";
    $res = $mdb2->query($sql);
    if (is_a(res, 'PEAR_Error')) return false;

    $val = $res->fetchRow();
    if (!$val) return false;

    // Drop things we don't need.
    unset($val['id']);
    unset($val['status']);

    return $val;
  }
}
