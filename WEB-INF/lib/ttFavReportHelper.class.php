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

import('ttTeamHelper');

// Class ttFavReportHelper is used to help with favorite report related tasks.
class ttFavReportHelper {

  // getReports - returns an array of favorite reports for user.
  static function getReports($user_id) {
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_fav_reports where user_id = $user_id and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
      	$result[] = $val;
      }
      return mu_sort($result, 'name');
    }
    return false;
  }

  // getReport - returns a report identified by its id.
  static function getReport($id) {
    $mdb2 = getConnection();

    $sql = "select * from tt_fav_reports where id = $id and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }

  // getReportByName - returns a report identified by its name.
  static function getReportByName($user_id, $report_name) {
    $mdb2 = getConnection();

    $sql = "select * from tt_fav_reports where user_id = $user_id and status = 1 and name = ".$mdb2->quote($report_name);
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }

  // insertReport - stores reports settings in database.
  static function insertReport($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "insert into tt_fav_reports".
      " (name, user_id, group_id, org_id, client_id, cf_1_option_id, project_id, task_id,".
      " billable, invoice, paid_status, users, period, period_start, period_end,".
      " show_client, show_invoice, show_paid, show_ip,".
      " show_project, show_start, show_duration, show_cost,".
      " show_task, show_end, show_note, show_custom_field_1, show_work_units,".
      " group_by1, group_by2, group_by3, show_totals_only)".
      " values(".
      $mdb2->quote($fields['name']).", ".$fields['user_id'].", $group_id, $org_id, ".
      $mdb2->quote($fields['client']).", ".$mdb2->quote($fields['option']).", ".
      $mdb2->quote($fields['project']).", ".$mdb2->quote($fields['task']).", ".
      $mdb2->quote($fields['billable']).", ".$mdb2->quote($fields['invoice']).", ".
      $mdb2->quote($fields['paid_status']).", ".
      $mdb2->quote($fields['users']).", ".$mdb2->quote($fields['period']).", ".
      $mdb2->quote($fields['from']).", ".$mdb2->quote($fields['to']).", ".
      $fields['chclient'].", ".$fields['chinvoice'].", ".$fields['chpaid'].", ".$fields['chip'].", ".
      $fields['chproject'].", ".$fields['chstart'].", ".$fields['chduration'].", ".$fields['chcost'].", ".
      $fields['chtask'].", ".$fields['chfinish'].", ".$fields['chnote'].", ".$fields['chcf_1'].", ".$fields['chunits'].", ".
      $mdb2->quote($fields['group_by1']).", ".$mdb2->quote($fields['group_by2']).", ".
      $mdb2->quote($fields['group_by3']).", ".$fields['chtotalsonly'].")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $sql = "select last_insert_id() as last_id";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error'))
      return false;

    $val = $res->fetchRow();
    return $val['last_id'];
  }

  // updateReport - updates report options in the database.
  function updateReport($fields) {
    $mdb2 = getConnection();
    $sql = "update tt_fav_reports set ".
      "name = ".$mdb2->quote($fields['name']).", ".
      "client_id = ".$mdb2->quote($fields['client']).", ".
      "cf_1_option_id = ".$mdb2->quote($fields['option']).", ".
      "project_id = ".$mdb2->quote($fields['project']).", ".
      "task_id = ".$mdb2->quote($fields['task']).", ".
      "billable = ".$mdb2->quote($fields['billable']).", ".
      "invoice = ".$mdb2->quote($fields['invoice']).", ".
      "paid_status = ".$mdb2->quote($fields['paid_status']).", ".
      "users = ".$mdb2->quote($fields['users']).", ".
      "period = ".$mdb2->quote($fields['period']).", ".
      "period_start = ".$mdb2->quote($fields['from']).", ".
      "period_end = ".$mdb2->quote($fields['to']).", ".
      "show_client = ".$fields['chclient'].", ".
      "show_invoice = ".$fields['chinvoice'].", ".
      "show_paid = ".$fields['chpaid'].", ".
      "show_ip = ".$fields['chip'].", ".
      "show_project = ".$fields['chproject'].", ".
      "show_start = ".$fields['chstart'].", ".
      "show_duration = ".$fields['chduration'].", ".
      "show_cost = ".$fields['chcost'].", ".
      "show_task = ".$fields['chtask'].", ".
      "show_end = ".$fields['chfinish'].", ".
      "show_note = ".$fields['chnote'].", ".
      "show_custom_field_1 = ".$fields['chcf_1'].", ".
      "show_work_units = ".$fields['chunits'].", ".
      "group_by1 = ".$mdb2->quote($fields['group_by1']).", ".
      "group_by2 = ".$mdb2->quote($fields['group_by2']).", ".
      "group_by3 = ".$mdb2->quote($fields['group_by3']).", ".
      "show_totals_only = ".$fields['chtotalsonly'].
      " where id = ".$fields['id'];
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return $fields['id'];
  }

  // saveReport - saves report options in the database.
  static function saveReport($user_id, $bean) {
    global $user;

    //  Set default value of 0 for not set checkboxes (in bean).
    //  Later in this function we use it to construct $fields array to update database.
    if (!$bean->getAttribute('chclient')) $bean->setAttribute('chclient', 0);
    if (!$bean->getAttribute('chinvoice')) $bean->setAttribute('chinvoice', 0);
    if (!$bean->getAttribute('chpaid')) $bean->setAttribute('chpaid', 0);
    if (!$bean->getAttribute('chip')) $bean->setAttribute('chip', 0);
    if (!$bean->getAttribute('chproject')) $bean->setAttribute('chproject', 0);
    if (!$bean->getAttribute('chstart')) $bean->setAttribute('chstart', 0);
    if (!$bean->getAttribute('chduration')) $bean->setAttribute('chduration', 0);
    if (!$bean->getAttribute('chcost')) $bean->setAttribute('chcost', 0);
    if (!$bean->getAttribute('chtask')) $bean->setAttribute('chtask', 0);
    if (!$bean->getAttribute('chfinish')) $bean->setAttribute('chfinish', 0);
    if (!$bean->getAttribute('chnote')) $bean->setAttribute('chnote', 0);
    if (!$bean->getAttribute('chcf_1')) $bean->setAttribute('chcf_1', 0);
    if (!$bean->getAttribute('chunits')) $bean->setAttribute('chunits', 0);
    if (!$bean->getAttribute('chtotalsonly')) $bean->setAttribute('chtotalsonly', 0);

    $users_in_bean = $bean->getAttribute('users');
    if ($users_in_bean && is_array($users_in_bean)) {
      $users = join(',', $users_in_bean);
    }
    if ($bean->getAttribute('start_date')) {
      $dt = new DateAndTime($user->date_format, $bean->getAttribute('start_date'));
      $from = $dt->toString(DB_DATEFORMAT);
    }
    if ($bean->getAttribute('end_date')) {
      $dt = new DateAndTime($user->date_format, $bean->getAttribute('end_date'));
      $to = $dt->toString(DB_DATEFORMAT);
    }

    $fields = array(
      'name'=>$bean->getAttribute('new_fav_report'),
      'client'=>$bean->getAttribute('client'),
      'option'=>$bean->getAttribute('option'),
      'project'=>$bean->getAttribute('project'),
      'task'=>$bean->getAttribute('task'),
      'billable'=>$bean->getAttribute('include_records'),
      'invoice'=>$bean->getAttribute('invoice'),
      'paid_status'=>$bean->getAttribute('paid_status'),
      'users'=>$users,
      'period'=>$bean->getAttribute('period'),
      'from'=>$from,
      'to'=>$to,
      'chclient'=>$bean->getAttribute('chclient'),
      'chinvoice'=>$bean->getAttribute('chinvoice'),
      'chpaid'=>$bean->getAttribute('chpaid'),
      'chip'=>$bean->getAttribute('chip'),
      'chproject'=>$bean->getAttribute('chproject'),
      'chstart'=>$bean->getAttribute('chstart'),
      'chduration'=>$bean->getAttribute('chduration'),
      'chcost'=>$bean->getAttribute('chcost'),
      'chtask'=>$bean->getAttribute('chtask'),
      'chfinish'=>$bean->getAttribute('chfinish'),
      'chnote'=>$bean->getAttribute('chnote'),
      'chcf_1'=>$bean->getAttribute('chcf_1'),
      'chunits'=>$bean->getAttribute('chunits'),
      'group_by1'=>$bean->getAttribute('group_by1'),
      'group_by2'=>$bean->getAttribute('group_by2'),
      'group_by3'=>$bean->getAttribute('group_by3'),
      'chtotalsonly'=>$bean->getAttribute('chtotalsonly'));

    $id = false;
    $report = ttFavReportHelper::getReportByName($user_id, $fields['name']);
    if ($report) {
      $fields['id'] = $report['id'];
      $id = ttFavReportHelper::updateReport($fields);
    } else {
      $fields['user_id'] = $user_id;
      $id = ttFavReportHelper::insertReport($fields);
    }

    return $id;
  }

  // deleteReport - deletes a favorite report.
  static function deleteReport($id) {
    $mdb2 = getConnection();

    $sql = "delete from tt_fav_reports where id = $id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // loadReport - loads report options from database into a bean.
  static function loadReport($user_id, &$bean) {
    global $user;

    $val = ttFavReportHelper::getReport($bean->getAttribute('favorite_report'));
    if ($val) {
      $bean->setAttribute('client', $val['client_id']);
      $bean->setAttribute('option', $val['cf_1_option_id']);
      $bean->setAttribute('project', $val['project_id']);
      $bean->setAttribute('task', $val['task_id']);
      $bean->setAttribute('include_records', $val['billable']);
      $bean->setAttribute('invoice', $val['invoice']);
      $bean->setAttribute('paid_status', $val['paid_status']);
      $bean->setAttribute('users', explode(',', $val['users']));
      $bean->setAttribute('period', $val['period']);
      if ($val['period_start']) {
        $dt = new DateAndTime(DB_DATEFORMAT, $val['period_start']);
        $bean->setAttribute('start_date', $dt->toString($user->date_format));
      }
      if ($val['period_end']) {
        $dt = new DateAndTime(DB_DATEFORMAT, $val['period_end']);
        $bean->setAttribute('end_date', $dt->toString($user->date_format));
      }
      $bean->setAttribute('chclient', $val['show_client']);
      $bean->setAttribute('chinvoice', $val['show_invoice']);
      $bean->setAttribute('chpaid', $val['show_paid']);
      $bean->setAttribute('chip', $val['show_ip']);
      $bean->setAttribute('chproject', $val['show_project']);
      $bean->setAttribute('chstart', $val['show_start']);
      $bean->setAttribute('chduration', $val['show_duration']);
      $bean->setAttribute('chcost', $val['show_cost']);
      $bean->setAttribute('chtask', $val['show_task']);
      $bean->setAttribute('chfinish', $val['show_end']);
      $bean->setAttribute('chnote', $val['show_note']);
      $bean->setAttribute('chcf_1', $val['show_custom_field_1']);
      $bean->setAttribute('chunits', $val['show_work_units']);
      $bean->setAttribute('group_by1', $val['group_by1']);
      $bean->setAttribute('group_by2', $val['group_by2']);
      $bean->setAttribute('group_by3', $val['group_by3']);
      $bean->setAttribute('chtotalsonly', $val['show_totals_only']);
      $bean->setAttribute('new_fav_report', $val['name']);
    } else {
      $attrs = $bean->getAttributes();
      $attrs = array_merge($attrs, array(
        'client'=>'',
        'option'=>'',
        'project'=>'',
        'task'=>'',
        'include_records'=>'',
        'invoice'=>'',
        'users'=>$user_id,
        'period'=>'',
        'chclient'=>'1',
        'chinvoice'=>'',
        'chproject'=>'1',
        'chstart'=>'1',
        'chduration'=>'1',
        'chcost'=>'',
        'chtask'=>'1',
        'chfinish'=>'1',
        'chnote'=>'1',
        'chcf_1'=>'',
        'chunits'=>'',
        'group_by1'=>'',
        'group_by2'=>'',
        'group_by3'=>'',
        'chtotalsonly'=>'',
        'new_fav_report'=>''));
      $bean->setAttributes($attrs);
    }
  }

  // getReportOptions - returns an array of fav report options from database data.
  // Note: this function is a part of refactoring to simplify maintenance of report
  // generating functions, as we currently have 2 sets: normal reporting (from bean),
  // and fav report emailing (from db fields). Using options obtained from either db or bean
  // shall allow us to use only one set of functions.
  static function getReportOptions($id) {

    // Start with getting the fields from the database.
    $db_fields = ttFavReportHelper::getReport($id);
    if (!$db_fields) return false;

    // Prepare an array of report options.
    $options = $db_fields; // For now, use db field names as options.
    // Drop things we don't need in reports.
    unset($options['id']);
    unset($options['report_spec']); // Currently not used.
    unset($options['status']);

    // Note: special handling for NULL users field is done in cron.php

    // $options now is a subset of db fields from tt_fav_reports table.
    return $options;
  }

  // adjustOptions takes and array or report options and adjusts them for current user
  // (and group) settings. This is needed in situations when a fav report is stored in db
  // long ago, but user or group attributes are now changed, so we have to adjust.
  static function adjustOptions($options) {
    global $user;

    // Check and optionally adjust users.
    // Special handling of the NULL $options['users'] field (this used to mean "all users").
    if (!$options['users']) {
      if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) {
        if ($user->can('view_reports') || $user->can('view_all_reports')) {
          $max_rank = $user->rank-1;
          if ($user->can('view_all_reports')) $max_rank = 512;
          if ($user->can('view_own_reports'))
            $user_options = array('max_rank'=>$max_rank,'include_self'=>true);
          else
            $user_options = array('max_rank'=>$max_rank);
          $users = $user->getUsers($user_options); // Active and inactive users.
        } elseif ($user->isClient()) {
          $users = ttTeamHelper::getUsersForClient(); // Active and inactive users for clients.
        }
        foreach ($users as $single_user) {
          $user_ids[] = $single_user['id'];
        }
        $options['users'] = implode(',', $user_ids);
      }
    } else {
      $users_to_adjust = explode(',', $options['users']); // Users to adjust.
      if ($user->isClient()) {
        $users = ttTeamHelper::getUsersForClient(); // Active and inactive users for clients.
        foreach ($users as $single_user) {
          $user_ids[] = $single_user['id'];
        }
        foreach ($users_to_adjust as $user_to_adjust) {
          if (in_array($user_to_adjust['id'], $user_ids)) {
            $adjusted_user_ids[] = $user_to_adjust['id'];
          }
        }
        $options['users'] = implode(',', $adjusted_user_ids);
      }
      // TODO: add checking the existing user list for potentially changed access rights for user.
    }

    return $options;
  }
}
