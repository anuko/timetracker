<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('ttGroupHelper');

// Class ttFavReportHelper is used to help with favorite report related tasks.
class ttFavReportHelper {

  // getReports - returns an array of favorite reports for user.
  static function getReports() {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    $sql = "select * from tt_fav_reports".
      " where user_id = $user_id and group_id = $group_id and org_id = $org_id and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
      	$result[] = $val;
      }
      return mu_sort($result, 'name');
    }
    return false;
  }

  // get - returns a report identified by its id for user.
  static function get($id) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select * from tt_fav_reports".
      " where id = $id and user_id = $user_id and group_id = $group_id and org_id = $org_id and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if ($val = $res->fetchRow()) {
        return $val;
      }
    }
    return false;
  }

  // getReport - returns a report identified by its id.
  // TODO: get rid of this function by encapsulating all cron related tasks in its own class.
  // Because cron works for all orgs and we want this class to always work in context of
  // a logged on user, for better security.
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
  static function getReportByName($report_name) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_fav_reports".
      " where user_id = $user_id and group_id = $group_id and org_id = $org_id and status = 1 and name = ".$mdb2->quote($report_name);
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

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "insert into tt_fav_reports".
      " (name, user_id, group_id, org_id, report_spec, client_id, project_id, task_id,".
      " billable, approved, invoice, timesheet, paid_status, users, period, period_start,".
      " period_end, show_client, show_invoice, show_paid, show_ip,".
      " show_project, show_timesheet, show_start, show_duration, show_cost,".
      " show_task, show_end, show_note, show_approved, show_work_units,".
      " group_by1, group_by2, group_by3, show_totals_only)".
      " values(".
      $mdb2->quote($fields['name']).", $user_id, $group_id, $org_id, ".
      $mdb2->quote($fields['report_spec']).", ".
      $mdb2->quote($fields['client']).", ".
      $mdb2->quote($fields['project']).", ".$mdb2->quote($fields['task']).", ".
      $mdb2->quote($fields['billable']).", ".$mdb2->quote($fields['approved']).", ".
      $mdb2->quote($fields['invoice']).", ".$mdb2->quote($fields['timesheet']).", ".
      $mdb2->quote($fields['paid_status']).", ".
      $mdb2->quote($fields['users']).", ".$mdb2->quote($fields['period']).", ".
      $mdb2->quote($fields['from']).", ".$mdb2->quote($fields['to']).", ".
      $fields['chclient'].", ".$fields['chinvoice'].", ".$fields['chpaid'].", ".$fields['chip'].", ".
      $fields['chproject'].", ".$fields['chtimesheet'].", ".$fields['chstart'].", ".$fields['chduration'].", ".$fields['chcost'].", ".
      $fields['chtask'].", ".$fields['chfinish'].", ".$fields['chnote'].", ".$fields['chapproved'].", ".$fields['chunits'].", ".
      $mdb2->quote($fields['group_by1']).", ".$mdb2->quote($fields['group_by2']).", ".
      $mdb2->quote($fields['group_by3']).", ".$fields['chtotalsonly'].")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_fav_reports', 'id');
    return $last_id;
  }

  // updateReport - updates report options in the database.
  static function updateReport($fields) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "update tt_fav_reports set ".
      "name = ".$mdb2->quote($fields['name']).", ".
      "report_spec = ".$mdb2->quote($fields['report_spec']).", ".
      "client_id = ".$mdb2->quote($fields['client']).", ".
      "project_id = ".$mdb2->quote($fields['project']).", ".
      "task_id = ".$mdb2->quote($fields['task']).", ".
      "billable = ".$mdb2->quote($fields['billable']).", ".
      "approved = ".$mdb2->quote($fields['approved']).", ".
      "invoice = ".$mdb2->quote($fields['invoice']).", ".
      "timesheet = ".$mdb2->quote($fields['timesheet']).", ".
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
      "show_timesheet = ".$fields['chtimesheet'].", ".
      "show_start = ".$fields['chstart'].", ".
      "show_duration = ".$fields['chduration'].", ".
      "show_cost = ".$fields['chcost'].", ".
      "show_task = ".$fields['chtask'].", ".
      "show_end = ".$fields['chfinish'].", ".
      "show_note = ".$fields['chnote'].", ".
      "show_approved = ".$fields['chapproved'].", ".
      "show_work_units = ".$fields['chunits'].", ".
      "group_by1 = ".$mdb2->quote($fields['group_by1']).", ".
      "group_by2 = ".$mdb2->quote($fields['group_by2']).", ".
      "group_by3 = ".$mdb2->quote($fields['group_by3']).", ".
      "show_totals_only = ".$fields['chtotalsonly'].
      " where id = ".$fields['id']." and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return $fields['id'];
  }

  // saveReport - saves report options in the database.
  static function saveReport($bean) {
    global $user;

    //  Set default value of 0 for not set checkboxes (in bean).
    //  Later in this function we use it to construct $fields array to update database.
    if (!$bean->getAttribute('chclient')) $bean->setAttribute('chclient', 0);
    if (!$bean->getAttribute('chstart')) $bean->setAttribute('chstart', 0);
    if (!$bean->getAttribute('chfinish')) $bean->setAttribute('chfinish', 0);
    if (!$bean->getAttribute('chduration')) $bean->setAttribute('chduration', 0);
 
    if (!$bean->getAttribute('chproject')) $bean->setAttribute('chproject', 0);
    if (!$bean->getAttribute('chtask')) $bean->setAttribute('chtask', 0);
    if (!$bean->getAttribute('chnote')) $bean->setAttribute('chnote', 0);
    if (!$bean->getAttribute('chcost')) $bean->setAttribute('chcost', 0);

    if (!$bean->getAttribute('chtimesheet')) $bean->setAttribute('chtimesheet', 0);
    if (!$bean->getAttribute('chip')) $bean->setAttribute('chip', 0);
    if (!$bean->getAttribute('chapproved')) $bean->setAttribute('chapproved', 0);
    if (!$bean->getAttribute('chpaid')) $bean->setAttribute('chpaid', 0);

    if (!$bean->getAttribute('chunits')) $bean->setAttribute('chunits', 0);
    if (!$bean->getAttribute('chinvoice')) $bean->setAttribute('chinvoice', 0);

    if (!$bean->getAttribute('chtotalsonly')) $bean->setAttribute('chtotalsonly', 0);

    $active_users_in_bean = $bean->getAttribute('users_active');
    if ($active_users_in_bean && is_array($active_users_in_bean)) {
      $users = join(',', $active_users_in_bean);
    }
    $inactive_users_in_bean = $bean->getAttribute('users_inactive');
    if ($inactive_users_in_bean && is_array($inactive_users_in_bean)) {
      if ($users) $users .= ',';
      $users .= join(',', $inactive_users_in_bean);
    }

    if ($bean->getAttribute('start_date')) {
      $dt = new DateAndTime($user->getDateFormat(), $bean->getAttribute('start_date'));
      $from = $dt->toString(DB_DATEFORMAT);
    }
    if ($bean->getAttribute('end_date')) {
      $dt = new DateAndTime($user->getDateFormat(), $bean->getAttribute('end_date'));
      $to = $dt->toString(DB_DATEFORMAT);
    }

    $fields = array(
      'name'=>$bean->getAttribute('new_fav_report'),
      'report_spec'=>ttFavReportHelper::makeReportSpec($bean),
      'client'=>$bean->getAttribute('client'),
      'option'=>$bean->getAttribute('option'),
      'project'=>$bean->getAttribute('project'),
      'task'=>$bean->getAttribute('task'),
      'billable'=>$bean->getAttribute('include_records'),
      'approved'=>$bean->getAttribute('approved'),
      'paid_status'=>$bean->getAttribute('paid_status'),
      'invoice'=>$bean->getAttribute('invoice'),
      'timesheet'=>$bean->getAttribute('timesheet'),
      'users'=>$users,
      'period'=>$bean->getAttribute('period'),
      'from'=>$from,
      'to'=>$to,
      'chclient'=>$bean->getAttribute('chclient'),
      'chstart'=>$bean->getAttribute('chstart'),
      'chfinish'=>$bean->getAttribute('chfinish'),
      'chduration'=>$bean->getAttribute('chduration'),
      'chproject'=>$bean->getAttribute('chproject'),
      'chtask'=>$bean->getAttribute('chtask'),
      'chnote'=>$bean->getAttribute('chnote'),
      'chcost'=>$bean->getAttribute('chcost'),
      'chtimesheet'=>$bean->getAttribute('chtimesheet'),
      'chip'=>$bean->getAttribute('chip'),
      'chapproved'=>$bean->getAttribute('chapproved'),
      'chpaid'=>$bean->getAttribute('chpaid'),
      'chunits'=>$bean->getAttribute('chunits'),
      'chinvoice'=>$bean->getAttribute('chinvoice'),
      'group_by1'=>$bean->getAttribute('group_by1'),
      'group_by2'=>$bean->getAttribute('group_by2'),
      'group_by3'=>$bean->getAttribute('group_by3'),
      'chtotalsonly'=>$bean->getAttribute('chtotalsonly'));

    $id = false;
    $report = ttFavReportHelper::getReportByName($fields['name']);
    if ($report) {
      $fields['id'] = $report['id'];
      $id = ttFavReportHelper::updateReport($fields);
    } else {
      $id = ttFavReportHelper::insertReport($fields);
    }

    return $id;
  }

  // deleteReport - deletes a favorite report.
  static function deleteReport($id) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "delete from tt_cron".
      " where report_id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $sql = "delete from tt_fav_reports".
      " where id = $id and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // loadReport - loads report options from database into a bean.
  static function loadReport(&$bean) {
    global $user;
    // Custom fields.
    if ($user->isPluginEnabled('cf')) {
      global $custom_fields;
      if (!$custom_fields) $custom_fields = new CustomFields();
    }
    $user_id = $user->getUser();

    $val = ttFavReportHelper::get($bean->getAttribute('favorite_report'));
    if ($val) {
      // Custom field settings.
      if ($val['report_spec']) {
        $report_spec = $val['report_spec'];
        // Time custom field settings.
        if ($custom_fields && $custom_fields->timeFields) {
          foreach ($custom_fields->timeFields as $timeField) {
            $field_name = 'time_field_'.$timeField['id'];
            $checkbox_field_name = 'show_'.$field_name;
            $field_value = ttFavReportHelper::getFieldSettingFromReportSpec($field_name, $report_spec);
            $bean->setAttribute($field_name, $field_value);
            $checkbox_value = ttFavReportHelper::getFieldSettingFromReportSpec($checkbox_field_name, $report_spec);
            $bean->setAttribute($checkbox_field_name, $checkbox_value);
          }
        }
        // User custom field settings.
        if ($custom_fields && $custom_fields->userFields) {
          foreach ($custom_fields->userFields as $userField) {
            $field_name = 'user_field_'.$userField['id'];
            $checkbox_field_name = 'show_'.$field_name;
            $field_value = ttFavReportHelper::getFieldSettingFromReportSpec($field_name, $report_spec);
            $bean->setAttribute($field_name, $field_value);
            $checkbox_value = ttFavReportHelper::getFieldSettingFromReportSpec($checkbox_field_name, $report_spec);
            $bean->setAttribute($checkbox_field_name, $checkbox_value);
          }
        }
      }

      $bean->setAttribute('client', $val['client_id']);
      $bean->setAttribute('project', $val['project_id']);
      $bean->setAttribute('task', $val['task_id']);
      $bean->setAttribute('include_records', $val['billable']);
      $bean->setAttribute('approved', $val['approved']);
      $bean->setAttribute('invoice', $val['invoice']);
      $bean->setAttribute('paid_status', $val['paid_status']);
      $bean->setAttribute('timesheet', $val['timesheet']);
      $bean->setAttribute('users_active', explode(',', $val['users']));
      $bean->setAttribute('users_inactive', explode(',', $val['users']));
      $bean->setAttribute('period', $val['period']);
      if ($val['period_start']) {
        $dt = new DateAndTime(DB_DATEFORMAT, $val['period_start']);
        $bean->setAttribute('start_date', $dt->toString($user->getDateFormat()));
      }
      if ($val['period_end']) {
        $dt = new DateAndTime(DB_DATEFORMAT, $val['period_end']);
        $bean->setAttribute('end_date', $dt->toString($user->getDateFormat()));
      }
      $bean->setAttribute('chclient', $val['show_client']);
      $bean->setAttribute('chinvoice', $val['show_invoice']);
      $bean->setAttribute('chpaid', $val['show_paid']);
      $bean->setAttribute('chip', $val['show_ip']);
      $bean->setAttribute('chproject', $val['show_project']);
      $bean->setAttribute('chtimesheet', $val['show_timesheet']);
      $bean->setAttribute('chstart', $val['show_start']);
      $bean->setAttribute('chduration', $val['show_duration']);
      $bean->setAttribute('chcost', $val['show_cost']);
      $bean->setAttribute('chtask', $val['show_task']);
      $bean->setAttribute('chfinish', $val['show_end']);
      $bean->setAttribute('chnote', $val['show_note']);
      $bean->setAttribute('chapproved', $val['show_approved']);
      $bean->setAttribute('chunits', $val['show_work_units']);
      $bean->setAttribute('group_by1', $val['group_by1']);
      $bean->setAttribute('group_by2', $val['group_by2']);
      $bean->setAttribute('group_by3', $val['group_by3']);
      $bean->setAttribute('chtotalsonly', $val['show_totals_only']);
      $bean->setAttribute('new_fav_report', $val['name']);
    } else {
      $attrs = $bean->getAttributes();
      $attrs = array_merge($attrs, array(
        'client' => null,
        'project'=> null,
        'task' => null,
        'include_records' => null,
        'approved' => null,
        'paid_status' => null,
        'invoice' => null,
        'timesheet' => null,
        'users' => $user_id,
        'period' => null,
        'chclient' => '1',
        'chstart' => '1',
        'chfinish' => '1',
        'chduration' => '1',
        'chproject' => '1',
        'chtask' => '1',
        'chnote' => '1',
        'chcost' => null,
        'chtimesheet' => null,
        'chip' => null,
        'chapproved' => null,
        'chpaid' => null,
        'chunits' => null,
        'chinvoice' => null,
        'chfiles' => '1',
        'group_by1' => null,
        'group_by2' => null,
        'group_by3' => null,
        'chtotalsonly' => null,
        'new_fav_report' => null));
      // Time custom fields.
      if ($custom_fields && $custom_fields->timeFields) {
        foreach ($custom_fields->timeFields as $timeField) {
          $field_name = 'time_field_'.$timeField['id'];
          $checkbox_field_name = 'show_'.$field_name;
          $custom_field_attrs[$field_name] = null;
          $custom_field_attrs[$checkbox_field_name] = null;
        }
      }
      // User custom fields.
      if ($custom_fields && $custom_fields->userFields) {
        foreach ($custom_fields->userFields as $userField) {
          $field_name = 'user_field_'.$userField['id'];
          $checkbox_field_name = 'show_'.$field_name;
          $custom_field_attrs[$field_name] = null;
          $custom_field_attrs[$checkbox_field_name] = null;
        }
      }
      if (is_array($custom_field_attrs))
        $attrs = array_merge($attrs, $custom_field_attrs);
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
    unset($options['status']);

    // Note: special handling for NULL users field is done in cron.php

    // $options now is a subset of db fields from tt_fav_reports table.
    return $options;
  }

  // adjustOptions takes an array or report options and adjusts them for current user
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
          $users = ttGroupHelper::getUsersForClient(); // Active and inactive users for clients.
        }
        foreach ($users as $single_user) {
          $user_ids[] = $single_user['id'];
        }
        $options['users'] = implode(',', $user_ids);
      }
    } else {
      $users_to_adjust = explode(',', $options['users']); // Users to adjust.
      if ($user->isClient()) {
        $users = ttGroupHelper::getUsersForClient(); // Active and inactive users for clients.
        foreach ($users as $single_user) {
          $user_ids[] = $single_user['id'];
        }
        foreach ($users_to_adjust as $user_to_adjust) {
          if (in_array($user_to_adjust, $user_ids)) {
            $adjusted_user_ids[] = $user_to_adjust;
          }
        }
        $options['users'] = implode(',', $adjusted_user_ids);
      }
      // TODO: add checking the existing user list for potentially changed access rights for user.
    }

    if ($user->isPluginEnabled('ap') && $user->isClient() && !$user->can('view_client_unapproved'))
      $options['approved'] = 1; // Restrict clients to approved records only.

    // Prepare custom field options.
    if ($user->isPluginEnabled('cf') && $options['report_spec']) {
      $custom_fields = new CustomFields();
      $report_spec = $options['report_spec'];
      // Time fields.
      if ($custom_fields && $custom_fields->timeFields) {
        foreach ($custom_fields->timeFields as $timeField) {
          $field_name = 'time_field_'.$timeField['id'];
          $checkbox_field_name = 'show_'.$field_name;
          $field_value = ttFavReportHelper::getFieldSettingFromReportSpec($field_name, $report_spec);
          $options[$field_name] = $field_value;
          $checkbox_value = ttFavReportHelper::getFieldSettingFromReportSpec($checkbox_field_name, $report_spec);
          $options[$checkbox_field_name] = $checkbox_value;
        }
      }
      // User fields.
      if ($custom_fields && $custom_fields->userFields) {
        foreach ($custom_fields->userFields as $userField) {
          $field_name = 'user_field_'.$userField['id'];
          $checkbox_field_name = 'show_'.$field_name;
          $field_value = ttFavReportHelper::getFieldSettingFromReportSpec($field_name, $report_spec);
          $options[$field_name] = $field_value;
          $checkbox_value = ttFavReportHelper::getFieldSettingFromReportSpec($checkbox_field_name, $report_spec);
          $options[$checkbox_field_name] = $checkbox_value;
        }
      }
      // TODO: add project fields here.
    }

    // Adjust period_start and period_end to user date format.
    if ($options['period_start'])
      $options['period_start'] = ttDateToUserFormat($options['period_start']);
    if ($options['period_end'])
      $options['period_end'] = ttDateToUserFormat($options['period_end']);

    return $options;
  }

  // makeReportSpec - prepares a value for report_spec field.
  //
  // Currently, only custom field settings go there.
  // Format:
  // time_field_25:117,show_time_field_25:1,time_field_28:qwerty,show_time_field_28:0
  static function makeReportSpec($bean) {
    global $user;

    if ($user->isPluginEnabled('cf')) {
      global $custom_fields;
      if (!$custom_fields) $custom_fields = new CustomFields();
    }

    // Add time custom field settings.
    if ($custom_fields && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        $field_value = str_replace(',','&#44',$bean->getAttribute($field_name)); 
        $checkbox_field_name = 'show_'.$field_name;
        $checkbox_field_value = (int) $bean->getAttribute($checkbox_field_name);
        if ($field_value) $reportSpecArray[] = $field_name.':'.$field_value;
        if ($checkbox_field_value) $reportSpecArray[] = $checkbox_field_name.':1';
      }
    }

    // Add user custom field settings.
    if ($custom_fields && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $field_value = str_replace(',','&#44',$bean->getAttribute($field_name));
        $checkbox_field_name = 'show_'.$field_name;
        $checkbox_field_value = (int) $bean->getAttribute($checkbox_field_name);
        if ($field_value) $reportSpecArray[] = $field_name.':'.$field_value;
        if ($checkbox_field_value) $reportSpecArray[] = $checkbox_field_name.':1';
      }
    }

    $reportSpec = null;
    if (is_array($reportSpecArray))
      $reportSpec = implode(',', $reportSpecArray);
    return $reportSpec;
  }

  // getFieldSettingFromReportSpec - obtains custom field setting from report_spec string.
  // See makeReportSpec above.
  //
  // $fieldKey is something like "time_field_26", "show_time_field_26", or
  // "user_field_765", "show_user_field_765".
  static function getFieldSettingFromReportSpec($fieldKey, $report_spec) {
    $reportSpecArray = explode(',', $report_spec);
    foreach ($reportSpecArray as $fieldSetting) {
      if (ttStartsWith($fieldSetting, $fieldKey.':')) {
        $value = substr($fieldSetting, strlen($fieldKey)+1);
        $value = str_replace('&#44',',',$value); // Restore commas.
        return $value;
      }
    }
    return null; // Not found.
  }
}
