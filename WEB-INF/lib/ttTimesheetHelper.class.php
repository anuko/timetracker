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

import('ttUserHelper');
import('ttGroupHelper');

// Class ttTimesheetHelper is used to help with project related tasks.
class ttTimesheetHelper {

  // The getTimesheetByName looks up a project by name.
  static function getTimesheetByName($name, $user_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_timesheets".
      " where group_id = $group_id and org_id = $org_id and user_id = $user_id and name = ".$mdb2->quote($name).
      " and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val && $val['id'])
        return $val;
    }
    return false;
  }

  // insert function inserts a new timesheet into database.
  static function insert($fields)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $user_id = $fields['user_id'];
    $client_id = $fields['client_id'];
    $name = $fields['name'];
    $submitter_comment = $fields['comment'];

    $sql = "insert into tt_timesheets (user_id, group_id, org_id, client_id, name, submitter_comment)".
      " values ($user_id, $group_id, $org_id, ".$mdb2->quote($client_id).", ".$mdb2->quote($name).", ".$mdb2->quote($submitter_comment).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_timesheets', 'id');

    // TODO: Associate report items with new timesheet.

    return $last_id;
  }

  // The getActiveTimesheets obtains active timesheets for a user.
  static function getActiveTimesheets($user_id)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // $addPaidStatus = $user->isPluginEnabled('ps');
    $result = array();

    if ($user->isClient())
      $client_part = "and ts.client_id = $user->client_id";

    $sql = "select ts.id, ts.name, ts.client_id, c.name as client_name, ts.submit_status, ts.approval_status from tt_timesheets ts".
      " left join tt_clients c on (c.id = ts.client_id)".
      " where ts.status = 1 and ts.group_id = $group_id and ts.org_id = $org_id and ts.user_id = $user_id".
      " $client_part order by ts.name";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      $dt = new DateAndTime(DB_DATEFORMAT);
      while ($val = $res->fetchRow()) {
        //if ($addPaidStatus)
        //  $val['paid'] = ttTimesheetHelper::isPaid($val['id']);
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getInactiveTimesheets obtains inactive timesheets for a user.
  static function getInactiveTimesheets($user_id)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // $addPaidStatus = $user->isPluginEnabled('ps');
    $result = array();

    if ($user->isClient())
      $client_part = "and ts.client_id = $user->client_id";

    $sql = "select ts.id, ts.name, ts.client_id, c.name as client_name, ts.submit_status, ts.approval_status from tt_timesheets ts".
      " left join tt_clients c on (c.id = ts.client_id)".
      " where ts.status = 0 and ts.group_id = $group_id and ts.org_id = $org_id and ts.user_id = $user_id".
      " $client_part order by ts.name";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      $dt = new DateAndTime(DB_DATEFORMAT);
      while ($val = $res->fetchRow()) {
        //if ($addPaidStatus)
        //  $val['paid'] = ttTimesheetHelper::isPaid($val['id']);
        $result[] = $val;
      }
    }
    return $result;
  }

  // getTimesheet - obtains timesheet data from the database.
  static function getTimesheet($timesheet_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    if ($user->isClient()) $client_part = "and client_id = $user->client_id";

    $sql = "select * from tt_timesheets".
      " where id = $timesheet_id and group_id = $group_id and org_id = $org_id $client_part and status is not null";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if ($val = $res->fetchRow())
        return $val;
    }
    return false;
  }

  // delete - deletes timesheet from the database.
  static function delete($timesheet_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Handle time records.
    $sql = "update tt_log set timesheet_id = null".
      " where timesheet_id = $timesheet_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Handle expense items.
    $sql = "update tt_expense_items set timesheet_id = null".
      " where timesheet_id = $timesheet_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Delete timesheet.
    $sql = "update tt_timesheets set status = null".
      " where id = $timesheet_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // update function - updates the timesheet in database.
  static function update($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $timesheet_id = $fields['id']; // Timesheet we are updating.
    $name = $fields['name']; // Timesheet name.
    $submitter_comment = $fields['submitter_comment'];
    $status = $fields['status']; // Project status.

    $sql = "update tt_timesheets set name = ".$mdb2->quote($name).", submitter_comment = ".$mdb2->quote($submitter_comment).
      ", status = ".$mdb2->quote($status).
      " where id = $timesheet_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
}
