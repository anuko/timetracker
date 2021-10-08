<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('ttUserHelper');
import('ttFileHelper');

// Class ttTimesheetHelper is used to help with project related tasks.
class ttTimesheetHelper {

  // The getTimesheetByName looks up a project by name.
  static function getTimesheetByName($name) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_timesheets".
      " where group_id = $group_id and org_id = $org_id and user_id = $user_id and name = ".$mdb2->quote($name).
      " and status is not null";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val && $val['id'])
        return $val;
    }
    return false;
  }

  // createTimesheet function creates a new timesheet.
  static function createTimesheet($fields)
  {
    // Create a new timesheet entry.
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $client_id = $fields['client_id'];
    $project_id = $fields['project_id'];
    $name = $fields['name'];
    $comment = $fields['comment'];

    $start_date = new DateAndTime($user->date_format, $fields['start_date']);
    $start = $start_date->toString(DB_DATEFORMAT);

    $end_date = new DateAndTime($user->date_format, $fields['end_date']);
    $end = $end_date->toString(DB_DATEFORMAT);

    $created_part = ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$user->id;

    $sql = "insert into tt_timesheets (user_id, group_id, org_id, client_id, project_id, name, comment,".
      " start_date, end_date, created, created_ip, created_by)".
      " values ($user_id, $group_id, $org_id, ".$mdb2->quote($client_id).", ".$mdb2->quote($project_id).", ".$mdb2->quote($name).
      ", ".$mdb2->quote($comment).", ".$mdb2->quote($start).", ".$mdb2->quote($end).$created_part.")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_timesheets', 'id');

    // Associate tt_log items with timesheet.
    $client_id = $project_id = null;
    if (isset($fields['client'])) $client_id = (int) $fields['client_id'];
    if (isset($fields['project_id'])) $project_id = (int) $fields['project_id'];
    // sql parts.
    $client_part = $project_part = '';
    if ($client_id) $client_part = " and client_id = $client_id";
    if ($project_id) $project_part = " and project_id = $project_id";

    $sql = "update tt_log set timesheet_id = $last_id".
      " where status = 1 $client_part $project_part and timesheet_id is null".
      " and date >= ".$mdb2->quote($start)." and date <= ".$mdb2->quote($end).
      " and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return $last_id;
  }

  // The getActiveTimesheets obtains active timesheets for a user.
  static function getActiveTimesheets()
  {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $filePart = $fileJoin = '';
    if ($user->isPluginEnabled('at')) {
      $filePart = ', if(Sub1.entity_id is null, 0, 1) as has_files';
      $fileJoin =  " left join (select distinct entity_id from tt_files".
      " where entity_type = 'timesheet' and group_id = $group_id and org_id = $org_id and status = 1) Sub1".
      " on (ts.id = Sub1.entity_id)";
    }

    $result = array();
    $sql = "select ts.id, ts.name, ts.client_id, c.name as client_name,".
      " ts.submit_status, ts.approve_status $filePart from tt_timesheets ts".
      " left join tt_clients c on (c.id = ts.client_id) $fileJoin".
      " where ts.status = 1 and ts.group_id = $group_id and ts.org_id = $org_id and ts.user_id = $user_id".
      " order by ts.name";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getInactiveTimesheets obtains inactive timesheets for a user.
  static function getInactiveTimesheets()
  {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $filePart = $fileJoin = '';
    if ($user->isPluginEnabled('at')) {
      $filePart = ', if(Sub1.entity_id is null, 0, 1) as has_files';
      $fileJoin =  " left join (select distinct entity_id from tt_files".
      " where entity_type = 'timesheet' and group_id = $group_id and org_id = $org_id and status = 1) Sub1".
      " on (ts.id = Sub1.entity_id)";
    }

    $result = array();
    $sql = "select ts.id, ts.name, ts.client_id, c.name as client_name,".
      " ts.submit_status, ts.approve_status $filePart from tt_timesheets ts".
      " left join tt_clients c on (c.id = ts.client_id) $fileJoin".
      " where ts.status = 0 and ts.group_id = $group_id and ts.org_id = $org_id and ts.user_id = $user_id".
      " order by ts.name";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getTimesheet - obtains timesheet data from the database.
  static function getTimesheet($timesheet_id) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select ts.*, u.name as user_name, c.name as client_name,".
      " p.name as project_name from tt_timesheets ts".
      " left join tt_users u on (ts.user_id = u.id)".
      " left join tt_clients c on (ts.client_id = c.id)".
      " left join tt_projects p on (ts.project_id = p.id)".
      " where ts.id = $timesheet_id and ts.user_id = $user_id and ts.group_id = $group_id and ts.org_id = $org_id and ts.status is not null";
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

    // Delete associated files.
    if ($user->isPluginEnabled('at')) {
      import('ttFileHelper');
      global $err;
      $fileHelper = new ttFileHelper($err);
      if (!$fileHelper->deleteEntityFiles($timesheet_id, 'timesheet'))
        return false;
    }

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Handle tt_log records.
    $sql = "update tt_log set timesheet_id = null".
      " where timesheet_id = $timesheet_id and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

    // Delete timesheet.
    $sql = "update tt_timesheets set status = null".$modified_part.
      " where id = $timesheet_id and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // update function - updates the timesheet in database.
  static function update($fields) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $timesheet_id = $fields['id']; // Timesheet we are updating.
    $name = $fields['name']; // Timesheet name.
    $comment = $fields['comment'];
    $status = $fields['status']; // Timesheet status.

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

    $sql = "update tt_timesheets set name = ".$mdb2->quote($name).
      ", comment = ".$mdb2->quote($comment).$modified_part.
      ", status = ".$mdb2->quote($status).
      " where id = $timesheet_id and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // getReportOptions prepares $options array to be used with ttReportHelper
  // to obtain items for timesheet view.
  static function getReportOptions($timesheet) {
    global $user;
    $group_by_client = $user->isPluginEnabled('cl') && !$timesheet['client_id'];
    $trackingMode = $user->getTrackingMode();
    $group_by_project = MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode;

    $options['timesheet_id'] = $timesheet['id'];
    $options['group_by1'] = 'date';
    if ($group_by_client || $group_by_project) {
      $options['group_by2'] = $group_by_client ? 'client' : 'project';
    }
    if ($options['group_by2'] && $options['group_by2'] != 'project' && $group_by_project) {
      $options['group_by3'] = 'project';
    }
    return $options;
  }

  // getApprovers obtains a list of users who can approve a timesheet for a given user
  // and also have an email to receive a notification about it.
  static function getApprovers() {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $approvers = array();
    $rank = ttUserHelper::getUserRank($user_id);
    $sql = "select u.id, u.name, u.email".
      " from tt_users u".
      " left join tt_roles r on (r.id = u.role_id)".
      " where u.status = 1 and u.email is not null and u.group_id = $group_id and u.org_id = $org_id".
      " and (r.rank > $rank and r.rights like '%approve_timesheets%')";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $approvers[] = $val;
      }
    }
    return $approvers;
  }

  // getApprover obtains approver properties such as name and email.
  static function getApprover($user_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $rank = ttUserHelper::getUserRank($user->getUser());
    $sql = "select u.name, u.email".
      " from tt_users u".
      " left join tt_roles r on (r.id = u.role_id)".
      " where u.id = $user_id and u.status = 1 and u.email is not null and u.group_id = $group_id and u.org_id = $org_id".
      " and (r.rank > $rank and r.rights like '%approve_timesheets%')";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }

  // markSubmitted marks a timesheet as submitted.
  static function markSubmitted($fields) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

    $timesheet_id = $fields['timesheet_id'];
    $sql = "update tt_timesheets set submit_status = 1".$modified_part.
      " where id = $timesheet_id and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // sendSubmitEmail sends a notification to an approver about a timesheet submit.
  static function sendSubmitEmail($fields) {
    global $i18n;
    global $user;

    // Send email to a selected approver.
    if (!$fields['approver_id']) return true; // No approver, nothing to do.

    $approver = ttTimesheetHelper::getApprover($fields['approver_id']);
    if (!$approver) return false; // Invalid approver id.

    $fields['to'] = $approver['email'];
    $fields['subject'] = $i18n->get('form.timesheet_view.submit_subject');
    $fields['body'] = sprintf($i18n->get('form.timesheet_view.submit_body'), $user->getName());

    return ttTimesheetHelper::sendEmail($fields);
  }

  // sendApprovedEmail sends a notification to user about a timesheet approval.
  static function sendApprovedEmail($fields) {
    global $i18n;
    global $user;

    // Obtain user email.
    $user_details = $user->getUserDetails($fields['user_id']);
    $email = $user_details['email'];
    if (!$email) return true; // No email to send to, nothing to do.

    $fields['to'] = $email;
    $fields['subject'] = $i18n->get('form.timesheet_view.approve_subject');
    $fields['body'] = sprintf($i18n->get('form.timesheet_view.approve_body'), htmlspecialchars($fields['name']), htmlspecialchars($fields['comment']));

    return ttTimesheetHelper::sendEmail($fields);
  }

  // sendDisapprovedEmail sends a notification to user about a timesheet disapproval.
  static function sendDisapprovedEmail($fields) {
    global $i18n;
    global $user;

    // Obtain user email.
    $user_details = $user->getUserDetails($fields['user_id']);
    $email = $user_details['email'];
    if (!$email) return true; // No email to send to, nothing to do.

    $fields['to'] = $email;
    $fields['subject'] = $i18n->get('form.timesheet_view.disapprove_subject');
    $fields['body'] = sprintf($i18n->get('form.timesheet_view.disapprove_body'), htmlspecialchars($fields['name']), htmlspecialchars($fields['comment']));

    return ttTimesheetHelper::sendEmail($fields);
  }

  // sendEmail is a generic finction that sends a timesheet related email.
  // TODO: perhaps make it even more generic for the entire application.
  static function sendEmail($fields, $html = true) {
    global $i18n;
    global $user;

    // Send email.
    import('mail.Mailer');
    $mailer = new Mailer();
    $mailer->setCharSet(CHARSET);
    if ($html)
      $mailer->setContentType('text/html');
    $mailer->setSender(SENDER);
    $mailer->setReceiver($fields['to']);
    if (!empty($user->bcc_email))
      $mailer->setReceiverBCC($user->bcc_email);
    $mailer->setMailMode(MAIL_MODE);
    if (!$mailer->send($fields['subject'], $fields['body']))
      return false;

    return true;
  }

  // markApproved marks a timesheet as approved.
  static function markApproved($fields) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $timesheet_id = $fields['timesheet_id'];
    $comment = $fields['comment'];

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

    $sql = "update tt_timesheets set approve_status = 1, approve_comment = ".$mdb2->quote($comment).$modified_part.
      " where id = $timesheet_id and submit_status = 1 and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // markDisapproved marks a timesheet as not approved.
  static function markDisapproved($fields) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $timesheet_id = $fields['timesheet_id'];
    $comment = $fields['comment'];

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

    $sql = "update tt_timesheets set approve_status = 0, approve_comment = ".$mdb2->quote($comment).$modified_part.
      " where id = $timesheet_id and submit_status = 1 and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // The timesheetItemsExist determines whether tt_log records exist in the specified period
  // for inclusion in a new timesheet.
  static function timesheetItemsExist($fields) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $client_id = $project_id = null;
    if (isset($fields['client_id'])) $client_id = (int) $fields['client_id'];
    if (isset($fields['project_id'])) $project_id = (int) $fields['project_id'];

    $start_date = new DateAndTime($user->date_format, $fields['start_date']);
    $start = $start_date->toString(DB_DATEFORMAT);

    $end_date = new DateAndTime($user->date_format, $fields['end_date']);
    $end = $end_date->toString(DB_DATEFORMAT);

    // sql parts.
    $client_part = $project_part = '';
    if ($client_id) $client_part = " and client_id = $client_id";
    if ($project_id) $project_part = " and project_id = $project_id";

    $sql = "select count(*) as num from tt_log".
      " where status = 1 $client_part $project_part and timesheet_id is null".
      " and date >= ".$mdb2->quote($start)." and date <= ".$mdb2->quote($end).
      " and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['num']) {
        return true;
      }
    }

    return false;
  }

  // The overlaps function determines if a new timesheet overlaps with
  // an already existing timesheet.
  static function overlaps($fields) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $client_id = $project_id = null;
    if (isset($fields['client_id'])) $client_id = (int) $fields['client_id'];
    if (isset($fields['project_id'])) $project_id = (int) $fields['project_id'];

    $start_date = new DateAndTime($user->date_format, $fields['start_date']);
    $start = $start_date->toString(DB_DATEFORMAT);
    $quoted_start = $mdb2->quote($start);

    $end_date = new DateAndTime($user->date_format, $fields['end_date']);
    $end = $end_date->toString(DB_DATEFORMAT);
    $quoted_end = $mdb2->quote($end);

    // sql parts.
    $client_part = $project_part = '';
    if ($client_id) $client_part = " and client_id = $client_id";
    if ($project_id) $project_part = " and project_id = $project_id";

    $sql = "select id from tt_timesheets".
      " where status is not null $client_part $project_part".
      " and (($quoted_start >= start_date and $quoted_start <= end_date)".
      "   or ($quoted_end >= start_date and $quoted_end <= end_date))".
      " and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if (isset($val['id']) && $val['id']) {
        return true;
      }
    }
    return false;
  }

  // The getMatchingTimesheets function retrieves a timesheet that "matches"
  // a report for an option to assign report items to it.
  //
  // Condition: report range is fully enclosed in an existing timesheet with
  // matching client_id and project_id and null approved_status.
  static function getMatchingTimesheets($options) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Check users.
    if (isset($options['users'])) {
      $comma_separated = $options['users'];
      $users = explode(',', $comma_separated);
      if (count($users) > 1 || $users[0] != $user->getUser())
        return false;
    }

    // No timesheets for expenses.
    if ($options['show_cost'] && $user->isPluginEnabled('ex')) return false;
    
    // Parts for client and project.
    if ($options['client_id']) $client_part = ' and (client_id is null or client_id = '.(int)$options['client_id'].')';
    if ($options['project_id']) $project_part = ' and (project_id is null or project_id = '.(int)$options['project_id'].')';

    // Determine start and end dates.
    $dateFormat = $user->getDateFormat();
    if ($options['period'])
      $period = new Period($options['period'], new DateAndTime($dateFormat));
    else {
      $period = new Period();
      $period->setPeriod(
        new DateAndTime($dateFormat, $options['period_start']),
        new DateAndTime($dateFormat, $options['period_end']));
    }
    $start = $period->getStartDate(DB_DATEFORMAT);
    $end = $period->getEndDate(DB_DATEFORMAT);

    $result = false;
    $sql = "select id, name from tt_timesheets".
      " where ".$mdb2->quote($start)." >= start_date and ".$mdb2->quote($end)." <= end_date".
      "$client_part $project_part".
      " and user_id = $user_id and group_id = $group_id and org_id = $org_id".
      " and approve_status is null and status is not null";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }
}
