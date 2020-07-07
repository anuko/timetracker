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

// ttGroupExportHelper - this class is used to write data for a single group
// to a file. When group contains other groups, it reuses itself recursively.
class ttGroupExportHelper {

  var $group_id = null;     // Group we are exporting.
  var $file     = null;     // File to write to.
  var $indentation = null;  // A string consisting of a number of spaces.
  var $subgroups = array(); // Immediate subgroups.

  // The following arrays are maps between entity ids in the file versus the database.
  // We write to the file sequentially (1,2,3...) while in the database the entities have different ids.
  var $userMap    = array();
  var $roleMap    = array();
  var $taskMap    = array();
  var $projectMap = array();
  var $clientMap  = array();
  var $timesheetMap = array();
  var $invoiceMap = array();
  var $logMap     = array();
  var $customFieldMap = array();
  var $customFieldOptionMap = array();
  var $favReportMap = array();

  // Constructor.
  function __construct($group_id, $file, $indentation) {
    global $user;

    $this->group_id = $group_id;
    $this->file = $file;
    $this->indentation = $indentation;

    // Build a list of subgroups.
    $mdb2 = getConnection();
    $sql =  "select id from tt_groups".
            " where status = 1 and parent_id = $this->group_id and org_id = $user->org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $this->subgroups[] = $val;
      }
    }
  }

  // getGroupAttrs obtains group attributes for export.
  private function getGroupAttrs() {
    global $user;
    $mdb2 = getConnection();

    $sql =  "select * from tt_groups".
            " where status = 1 and id = $this->group_id and org_id = $user->org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
    }
    return $val;
  }

  // The getUsers obtains all users in group for the purpose of export.
  private function getUsers() {
    global $user;
    $mdb2 = getConnection();
    $sql = "select u.*, r.rank from tt_users u left join tt_roles r on (u.role_id = r.id)".
      " where u.group_id = $this->group_id and u.org_id = $user->org_id order by upper(u.name)"; // Note: deleted users are included.
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getRecordsFromTable - obtains all fields from a given table for a group.
  function getRecordsFromTable($table_name) {
    global $user;
    $mdb2 = getConnection();

    $sql = "select * from $table_name where group_id = $this->group_id and org_id = $user->org_id";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getRecordsChunkFromTable - obtains a subset of records from a given table for a group.
  // It is a workaround for out of memory condition when a table such as tt_log becomes too large
  // and we can no longer use the getRecordsFromTable.
  function getRecordsChunkFromTable($table_name, $limit, $offset) {
    global $user;
    $mdb2 = getConnection();

    $sql = "select * from $table_name where group_id = $this->group_id and org_id = $user->org_id order by id limit $limit offset $offset";
    $res = $mdb2->query($sql);
    $result = false;
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // writeData writes group data into file.
  function writeData() {

    // Write group info.
    $group = $this->getGroupAttrs();
    $group_part = "<group group_key=\"".htmlspecialchars($group['group_key'])."\"";
    $group_part .= " name=\"".htmlspecialchars($group['name'])."\"";
    $group_part .= " description=\"".htmlspecialchars($group['description'])."\"";
    $group_part .= " currency=\"".htmlspecialchars($group['currency'])."\"";
    $group_part .= " decimal_mark=\"".$group['decimal_mark']."\"";
    $group_part .= " lang=\"".$group['lang']."\"";
    $group_part .= " date_format=\"".$group['date_format']."\"";
    $group_part .= " time_format=\"".$group['time_format']."\"";
    $group_part .= " week_start=\"".$group['week_start']."\"";
    $group_part .= " tracking_mode=\"".$group['tracking_mode']."\"";
    $group_part .= " project_required=\"".$group['project_required']."\"";
    $group_part .= " task_required=\"".$group['task_required']."\"";
    $group_part .= " record_type=\"".$group['record_type']."\"";
    $group_part .= " bcc_email=\"".$group['bcc_email']."\"";
    $group_part .= " allow_ip=\"".$group['allow_ip']."\"";
    $group_part .= " password_complexity=\"".$group['password_complexity']."\"";
    $group_part .= " plugins=\"".$group['plugins']."\"";
    $group_part .= " lock_spec=\"".$group['lock_spec']."\"";
    $group_part .= " workday_minutes=\"".$group['workday_minutes']."\"";
    $group_part .= " custom_logo=\"".$group['custom_logo']."\"";
    $group_part .= " config=\"".$group['config']."\"";
    $group_part .= ">\n";

    // Write group info.
    fwrite($this->file, $this->indentation.$group_part);
    unset($group);
    unset($group_part);

    // Prepare user map.
    $users = $this->getUsers();
    foreach ($users as $key=>$user_item)
      $this->userMap[$user_item['id']] = $key + 1;

    // Prepare role map.
    $roles = $this->getRecordsFromTable('tt_roles');
    foreach ($roles as $key=>$role_item)
      $this->roleMap[$role_item['id']] = $key + 1;

    // Prepare task map.
    $tasks = $this->getRecordsFromTable('tt_tasks');
    foreach ($tasks as $key=>$task_item)
      $this->taskMap[$task_item['id']] = $key + 1;

    // Prepare project map.
    $projects = $this->getRecordsFromTable('tt_projects');
    foreach ($projects as $key=>$project_item)
      $this->projectMap[$project_item['id']] = $key + 1;

    // Prepare client map.
    $clients = $this->getRecordsFromTable('tt_clients');
    foreach ($clients as $key=>$client_item)
      $this->clientMap[$client_item['id']] = $key + 1;

    // Prepare timesheet map.
    $timesheets = $this->getRecordsFromTable('tt_timesheets');
    foreach ($timesheets as $key=>$timesheet_item)
      $this->timesheetMap[$timesheet_item['id']] = $key + 1;

    // Prepare invoice map.
    $invoices = ttTeamHelper::getAllInvoices();
    foreach ($invoices as $key=>$invoice_item)
      $this->invoiceMap[$invoice_item['id']] = $key + 1;

    // Prepare custom fields map.
    $custom_fields = ttTeamHelper::getAllCustomFields($this->group_id);
    foreach ($custom_fields as $key=>$custom_field)
      $this->customFieldMap[$custom_field['id']] = $key + 1;

    // Prepare custom field options map.
    $custom_field_options = ttTeamHelper::getAllCustomFieldOptions($this->group_id);
    foreach ($custom_field_options as $key=>$option)
      $this->customFieldOptionMap[$option['id']] = $key + 1;

    // Prepare favorite report map.
    $fav_reports = $this->getRecordsFromTable('tt_fav_reports');
    foreach ($fav_reports as $key=>$fav_report)
      $this->favReportMap[$fav_report['id']] = $key + 1;

    // Write roles.
    fwrite($this->file, $this->indentation."  <roles>\n");
    foreach ($roles as $role) {
      $role_part = $this->indentation.'    '."<role id=\"".$this->roleMap[$role['id']]."\"";
      $role_part .= " name=\"".htmlspecialchars($role['name'])."\"";
      $role_part .= " description=\"".htmlspecialchars($role['description'])."\"";
      $role_part .= " rank=\"".$role['rank']."\"";
      $role_part .= " rights=\"".htmlspecialchars($role['rights'])."\"";
      $role_part .= " status=\"".$role['status']."\"";
      $role_part .= "></role>\n";
      fwrite($this->file, $role_part);
    }
    fwrite($this->file, $this->indentation."  </roles>\n");
    unset($roles);
    unset($role_part);

    // Write tasks.
    if (count($tasks) > 0) {
      fwrite($this->file, $this->indentation."  <tasks>\n");
      foreach ($tasks as $task) {
        $task_part = $this->indentation.'    '."<task id=\"".$this->taskMap[$task['id']]."\"";
        $task_part .= " name=\"".htmlspecialchars($task['name'])."\"";
        $task_part .= " description=\"".htmlspecialchars($task['description'])."\"";
        $task_part .= " status=\"".$task['status']."\"";
        $task_part .= "></task>\n";
        fwrite($this->file, $task_part);
      }
      fwrite($this->file, $this->indentation."  </tasks>\n");
      unset($tasks);
      unset($task_part);
    }

    // Write projects.
    if (count($projects) > 0) {
      fwrite($this->file, $this->indentation."  <projects>\n");
      foreach ($projects as $project_item) {
        $tasks_str = null;
        if($project_item['tasks']){
          $tasks = explode(',', $project_item['tasks']);
          $tasks_mapped = array();
          foreach ($tasks as $item)
            $tasks_mapped[] = $this->taskMap[$item];
          $tasks_str = implode(',', $tasks_mapped);
        }
        $project_part = $this->indentation.'    '."<project id=\"".$this->projectMap[$project_item['id']]."\"";
        $project_part .= " name=\"".htmlspecialchars($project_item['name'])."\"";
        $project_part .= " description=\"".htmlspecialchars($project_item['description'])."\"";
        $project_part .= " tasks=\"".$tasks_str."\"";
        $project_part .= " status=\"".$project_item['status']."\"";
        $project_part .= "></project>\n";
        fwrite($this->file, $project_part);
      }
      fwrite($this->file, $this->indentation."  </projects>\n");
      unset($projects);
      unset($project_part);
    }

    // Write clients.
    if (count($clients) > 0) {
      fwrite($this->file, $this->indentation."  <clients>\n");
      foreach ($clients as $client_item) {
        if($client_item['projects']){
          $projects_db = explode(',', $client_item['projects']);
          $projects_mapped = array();
          foreach ($projects_db as $item)
            $projects_mapped[] = $this->projectMap[$item];
          $projects_str = implode(',', $projects_mapped);
        }
        $client_part = $this->indentation.'    '."<client id=\"".$this->clientMap[$client_item['id']]."\"";
        $client_part .= " name=\"".htmlspecialchars($client_item['name'])."\"";
        $client_part .= " address=\"".htmlspecialchars($client_item['address'])."\"";
        $client_part .= " tax=\"".$client_item['tax']."\"";
        $client_part .= " projects=\"".$projects_str."\"";
        $client_part .= " status=\"".$client_item['status']."\"";
        $client_part .= "></client>\n";
        fwrite($this->file, $client_part);
      }
      fwrite($this->file, $this->indentation."  </clients>\n");
      unset($clients);
      unset($client_part);
    }

    // Write users.
    if (count($users) > 0) {
      fwrite($this->file, $this->indentation."  <users>\n");
      foreach ($users as $user_item) {
        $role_id = $user_item['rank'] == 512 ? 0 : $this->roleMap[$user_item['role_id']]; // Special role_id 0 (not null) for top manager.
        $user_part = $this->indentation.'    '."<user id=\"".$this->userMap[$user_item['id']]."\"";
        $user_part .= " name=\"".htmlspecialchars($user_item['name'])."\"";
        $user_part .= " login=\"".htmlspecialchars($user_item['login'])."\"";
        $user_part .= " password=\"".$user_item['password']."\"";
        $user_part .= " role_id=\"".$role_id."\"";
        $user_part .= " client_id=\"".$this->clientMap[$user_item['client_id']]."\"";
        $user_part .= " rate=\"".$user_item['rate']."\"";
        $user_part .= " quota_percent=\"".$user_item['quota_percent']."\"";
        $user_part .= " email=\"".$user_item['email']."\"";
        $user_part .= " status=\"".$user_item['status']."\"";
        $user_part .= "></user>\n";
        fwrite($this->file, $user_part);
      }
      fwrite($this->file, $this->indentation."  </users>\n");
      unset($users);
      unset($user_part);
    }

    // Write user to project binds.
    $user_binds = ttTeamHelper::getUserToProjectBinds($this->group_id);
    if (count($user_binds) > 0) {
      fwrite($this->file, $this->indentation."  <user_project_binds>\n");
      foreach ($user_binds as $bind) {
        $user_id = $this->userMap[$bind['user_id']];
        $project_id = $this->projectMap[$bind['project_id']];
        $bind_part = $this->indentation.'    '."<user_project_bind user_id=\"".$user_id."\"";
        $bind_part .= " project_id=\"".$project_id."\"";
        $bind_part .= " rate=\"".$bind['rate']."\"";
        $bind_part .= " status=\"".$bind['status']."\"";
        $bind_part .= "></user_project_bind>\n";
        fwrite($this->file, $bind_part);
      }
      fwrite($this->file, $this->indentation."  </user_project_binds>\n");
      unset($user_binds);
      unset($bind_part);
    }

    // Write timesheets.
    if (count($timesheets) > 0) {
      fwrite($this->file, $this->indentation."  <timesheets>\n");
      foreach ($timesheets as $timesheet_item) {
        $timesheet_part = $this->indentation.'    '."<timesheet id=\"".$this->timesheetMap[$timesheet_item['id']]."\"";
        $timesheet_part .= " user_id=\"".$this->userMap[$timesheet_item['user_id']]."\"";
        $timesheet_part .= " client_id=\"".$this->clientMap[$timesheet_item['client_id']]."\"";
        $timesheet_part .= " project_id=\"".$this->projectMap[$timesheet_item['project_id']]."\"";
        $timesheet_part .= " name=\"".htmlspecialchars($timesheet_item['name'])."\"";
        $timesheet_part .= " comment=\"".htmlspecialchars($timesheet_item['comment'])."\"";
        $timesheet_part .= " start_date=\"".$timesheet_item['start_date']."\"";
        $timesheet_part .= " end_date=\"".$timesheet_item['end_date']."\"";
        $timesheet_part .= " submit_status=\"".$timesheet_item['submit_status']."\"";
        $timesheet_part .= " approve_status=\"".$timesheet_item['approve_status']."\"";
        $timesheet_part .= " approve_comment=\"".htmlspecialchars($timesheet_item['approve_comment'])."\"";
        $timesheet_part .= " status=\"".$timesheet_item['status']."\"";
        $timesheet_part .= "></timesheet>\n";
        fwrite($this->file, $timesheet_part);
      }
      fwrite($this->file, $this->indentation."  </timesheets>\n");
      unset($timesheets);
      unset($timesheet_part);
    }

    // Write invoices.
    if (count($invoices) > 0) {
      fwrite($this->file, $this->indentation."  <invoices>\n");
      foreach ($invoices as $invoice_item) {
        $invoice_part = $this->indentation.'    '."<invoice id=\"".$this->invoiceMap[$invoice_item['id']]."\"";
        $invoice_part .= " name=\"".htmlspecialchars($invoice_item['name'])."\"";
        $invoice_part .= " date=\"".$invoice_item['date']."\"";
        $invoice_part .= " client_id=\"".$this->clientMap[$invoice_item['client_id']]."\"";
        $invoice_part .= " status=\"".$invoice_item['status']."\"";
        $invoice_part .= "></invoice>\n";
        fwrite($this->file, $invoice_part);
      }
      fwrite($this->file, $this->indentation."  </invoices>\n");
      unset($invoices);
      unset($invoice_part);
    }

    // Write time log entries and build logMap at the same time.
    // We use getRecordsChunkFromTable here to avoid out of memory condition for large tables.
    fwrite($this->file, $this->indentation."  <log>\n");
    $offset = 0;
    $limit = 5000;
    $key = 0;
    while ($records = $this->getRecordsChunkFromTable('tt_log', $limit, $offset)) {
      foreach ($records as $record) {
        $key++;
        $this->logMap[$record['id']] = $key;
        $log_part = $this->indentation.'    '."<log_item id=\"$key\"";
        $log_part .= " user_id=\"".$this->userMap[$record['user_id']]."\"";
        $log_part .= " date=\"".$record['date']."\"";
        $log_part .= " start=\"".$record['start']."\"";
        $log_part .= " duration=\"".$record['duration']."\"";
        $log_part .= " client_id=\"".$this->clientMap[$record['client_id']]."\"";
        $log_part .= " project_id=\"".$this->projectMap[$record['project_id']]."\"";
        $log_part .= " task_id=\"".$this->taskMap[$record['task_id']]."\"";
        $log_part .= " timesheet_id=\"".$this->timesheetMap[$record['timesheet_id']]."\"";
        $log_part .= " invoice_id=\"".$this->invoiceMap[$record['invoice_id']]."\"";
        $log_part .= " comment=\"".$this->encodeLineBreaks($record['comment'])."\"";
        $log_part .= " billable=\"".$record['billable']."\"";
        $log_part .= " approved=\"".$record['approved']."\"";
        $log_part .= " paid=\"".$record['paid']."\"";
        $log_part .= " status=\"".$record['status']."\"";
        $log_part .= "></log_item>\n";
        fwrite($this->file, $log_part);
      }
      unset($records);
      unset($log_part);
      $offset += $limit;
     }
    fwrite($this->file, $this->indentation."  </log>\n");

    // Write custom fields.
    if (count($custom_fields) > 0) {
      fwrite($this->file, $this->indentation."  <custom_fields>\n");
      foreach ($custom_fields as $custom_field) {
        $custom_field_part = $this->indentation.'    '."<custom_field id=\"".$this->customFieldMap[$custom_field['id']]."\"";
        $custom_field_part .= " entity_type=\"".$custom_field['entity_type']."\"";
        $custom_field_part .= " type=\"".$custom_field['type']."\"";
        $custom_field_part .= " label=\"".htmlspecialchars($custom_field['label'])."\"";
        $custom_field_part .= " required=\"".$custom_field['required']."\"";
        $custom_field_part .= " status=\"".$custom_field['status']."\"";
        $custom_field_part .= "></custom_field>\n";
        fwrite($this->file, $custom_field_part);
      }
      fwrite($this->file, $this->indentation."  </custom_fields>\n");
      unset($custom_fields);
      unset($custom_field_part);
    }

    // Write custom field options.
    if (count($custom_field_options) > 0) {
      fwrite($this->file, $this->indentation."  <custom_field_options>\n");
      foreach ($custom_field_options as $option) {
        $custom_field_option_part = $this->indentation.'    '."<custom_field_option id=\"".$this->customFieldOptionMap[$option['id']]."\"";
        $custom_field_option_part .= " field_id=\"".$this->customFieldMap[$option['field_id']]."\"";
        $custom_field_option_part .= " value=\"".htmlspecialchars($option['value'])."\"";
        $custom_field_option_part .= "></custom_field_option>\n";
        fwrite($this->file, $custom_field_option_part);
      }
      fwrite($this->file, $this->indentation."  </custom_field_options>\n");
      unset($custom_field_options);
      unset($custom_field_option_part);
    }

    // Write custom field log.
    // We use getRecordsChunkFromTable here to avoid out of memory condition for large tables.
    fwrite($this->file, $this->indentation."  <custom_field_log>\n");
    $offset = 0;
    while ($custom_field_log = $this->getRecordsChunkFromTable('tt_custom_field_log', $limit, $offset)) {
      foreach ($custom_field_log as $entry) {
        $custom_field_log_part = $this->indentation.'    '."<custom_field_log_entry log_id=\"".$this->logMap[$entry['log_id']]."\"";
        $custom_field_log_part .= " field_id=\"".$this->customFieldMap[$entry['field_id']]."\"";
        $custom_field_log_part .= " option_id=\"".$this->customFieldOptionMap[$entry['option_id']]."\"";
        $custom_field_log_part .= " value=\"".htmlspecialchars($entry['value'])."\"";
        $custom_field_log_part .= " status=\"".$entry['status']."\"";
        $custom_field_log_part .= "></custom_field_log_entry>\n";
        fwrite($this->file, $custom_field_log_part);
      }
      unset($custom_field_log);
      unset($custom_field_log_part);
      $offset += $limit;
     }
    fwrite($this->file, $this->indentation."  </custom_field_log>\n");

    // Write expense items.
    // We use getRecordsChunkFromTable here to avoid out of memory condition for large tables.
    fwrite($this->file, $this->indentation."  <expense_items>\n");
    $offset = 0;
    while ($expense_items = $this->getRecordsChunkFromTable('tt_expense_items', $limit, $offset)) {
      foreach ($expense_items as $expense_item) {
        $expense_item_part = $this->indentation.'    '."<expense_item date=\"".$expense_item['date']."\"";
        $expense_item_part .= " user_id=\"".$this->userMap[$expense_item['user_id']]."\"";
        $expense_item_part .= " client_id=\"".$this->clientMap[$expense_item['client_id']]."\"";
        $expense_item_part .= " project_id=\"".$this->projectMap[$expense_item['project_id']]."\"";
        $expense_item_part .= " name=\"".$this->encodeLineBreaks($expense_item['name'])."\"";
        $expense_item_part .= " cost=\"".$expense_item['cost']."\"";
        $expense_item_part .= " invoice_id=\"".$this->invoiceMap[$expense_item['invoice_id']]."\"";
        $expense_item_part .= " approved=\"".$expense_item['approved']."\"";
        $expense_item_part .= " paid=\"".$expense_item['paid']."\"";
        $expense_item_part .= " status=\"".$expense_item['status']."\"";
        $expense_item_part .= "></expense_item>\n";
        fwrite($this->file, $expense_item_part);
      }
      unset($expense_items);
      unset($expense_item_part);
      $offset += $limit;
     }
    fwrite($this->file, $this->indentation."  </expense_items>\n");

    // Write predefined expenses.
    $predefined_expenses = $this->getRecordsFromTable('tt_predefined_expenses');
    if (count($predefined_expenses) > 0) {
      fwrite($this->file, $this->indentation."  <predefined_expenses>\n");
      foreach ($predefined_expenses as $predefined_expense) {
        $predefined_expense_part = $this->indentation.'    '."<predefined_expense name=\"".htmlspecialchars($predefined_expense['name'])."\"";
        $predefined_expense_part .= " cost=\"".$predefined_expense['cost']."\"";
        $predefined_expense_part .= "></predefined_expense>\n";
        fwrite($this->file, $predefined_expense_part);
      }
      fwrite($this->file, $this->indentation."  </predefined_expenses>\n");
      unset($predefined_expenses);
      unset($predefined_expense_part);
    }

    // Write templates.
    $templates = $this->getRecordsFromTable('tt_templates');
    if (count($templates) > 0) {
      fwrite($this->file, $this->indentation."  <templates>\n");
      foreach ($templates as $template) {
        $template_part = $this->indentation.'    '."<template name=\"".htmlspecialchars($template['name'])."\"";
        $template_part .= " description=\"".htmlspecialchars($template['description'])."\"";
        $template_part .= " content=\"".$this->encodeLineBreaks($template['content'])."\"";
        $template_part .= " status=\"".$template['status']."\"";
        $template_part .= "></template>\n";
        fwrite($this->file, $template_part);
      }
      fwrite($this->file, $this->indentation."  </templates>\n");
      unset($templates);
      unset($template_part);
    }

    // Write monthly quotas.
    $quotas = ttTeamHelper::getMonthlyQuotas($this->group_id);
    if (count($quotas) > 0) {
      fwrite($this->file, $this->indentation."  <monthly_quotas>\n");
      foreach ($quotas as $quota) {
        $quota_part = $this->indentation.'    '."<monthly_quota year=\"".$quota['year']."\"";
        $quota_part .= " month=\"".$quota['month']."\"";
        $quota_part .= " minutes=\"".$quota['minutes']."\"";
        $quota_part .= "></monthly_quota>\n";
        fwrite($this->file, $quota_part);
      }
      fwrite($this->file, $this->indentation."  </monthly_quotas>\n");
      unset($quotas);
      unset($quota_part);
    }

    // Write fav reports.
    if (count($fav_reports) > 0) {
      fwrite($this->file, $this->indentation."  <fav_reports>\n");
      foreach ($fav_reports as $fav_report) {
        $user_list = '';
        if (strlen($fav_report['users']) > 0) {
          $arr = explode(',', $fav_report['users']);
          foreach ($arr as $k=>$v) {
            if (array_key_exists($arr[$k], $this->userMap))
              $user_list .= (strlen($user_list) == 0? '' : ',').$this->userMap[$v];
          }
        }
        $fav_report_part = $this->indentation.'    '."<fav_report id=\"".$this->favReportMap[$fav_report['id']]."\"";
        $fav_report_part .= " name=\"".htmlspecialchars($fav_report['name'])."\"";
        $fav_report_part .= " user_id=\"".$this->userMap[$fav_report['user_id']]."\"";
        $fav_report_part .= " report_spec=\"".$this->remapReportSpec($fav_report['report_spec'])."\"";
        $fav_report_part .= " client_id=\"".$this->clientMap[$fav_report['client_id']]."\"";
        $fav_report_part .= " project_id=\"".$this->projectMap[$fav_report['project_id']]."\"";
        $fav_report_part .= " task_id=\"".$this->taskMap[$fav_report['task_id']]."\"";
        $fav_report_part .= " billable=\"".$fav_report['billable']."\"";
        $fav_report_part .= " approved=\"".$fav_report['approved']."\"";
        $fav_report_part .= " invoice=\"".$fav_report['invoice']."\"";
        $fav_report_part .= " timesheet=\"".$fav_report['timesheet']."\"";
        $fav_report_part .= " paid_status=\"".$fav_report['paid_status']."\"";
        $fav_report_part .= " users=\"".$user_list."\"";
        $fav_report_part .= " period=\"".$fav_report['period']."\"";
        $fav_report_part .= " period_start=\"".$fav_report['period_start']."\"";
        $fav_report_part .= " period_end=\"".$fav_report['period_end']."\"";
        $fav_report_part .= " show_client=\"".$fav_report['show_client']."\"";
        $fav_report_part .= " show_invoice=\"".$fav_report['show_invoice']."\"";
        $fav_report_part .= " show_paid=\"".$fav_report['show_paid']."\"";
        $fav_report_part .= " show_ip=\"".$fav_report['show_ip']."\"";
        $fav_report_part .= " show_project=\"".$fav_report['show_project']."\"";
        $fav_report_part .= " show_timesheet=\"".$fav_report['show_timesheet']."\"";
        $fav_report_part .= " show_start=\"".$fav_report['show_start']."\"";
        $fav_report_part .= " show_duration=\"".$fav_report['show_duration']."\"";
        $fav_report_part .= " show_cost=\"".$fav_report['show_cost']."\"";
        $fav_report_part .= " show_task=\"".$fav_report['show_task']."\"";
        $fav_report_part .= " show_end=\"".$fav_report['show_end']."\"";
        $fav_report_part .= " show_note=\"".$fav_report['show_note']."\"";
        $fav_report_part .= " show_approved=\"".$fav_report['show_approved']."\"";
        $fav_report_part .= " show_totals_only=\"".$fav_report['show_totals_only']."\"";
        $fav_report_part .= " show_work_units=\"".$fav_report['show_work_units']."\"";
        $fav_report_part .= " group_by1=\"".$fav_report['group_by1']."\"";
        $fav_report_part .= " group_by2=\"".$fav_report['group_by2']."\"";
        $fav_report_part .= " group_by3=\"".$fav_report['group_by3']."\"";
        $fav_report_part .= "></fav_report>\n";
        fwrite($this->file, $fav_report_part);
      }
      fwrite($this->file, $this->indentation."  </fav_reports>\n");
      unset($fav_reports);
      unset($fav_report_part);
    }

    // Write notifications.
    $notifications = $this->getRecordsFromTable('tt_cron');
    if (count($notifications) > 0) {
      fwrite($this->file, $this->indentation."  <notifications>\n");
      foreach ($notifications as $notification) {
        $notification_part = $this->indentation.'    '."<notification cron_spec=\"".$notification['cron_spec']."\"";
        $notification_part .= " last=\"".$notification['last']."\"";
        $notification_part .= " next=\"".$notification['next']."\"";
        $notification_part .= " report_id=\"".$this->favReportMap[$notification['report_id']]."\"";
        $notification_part .= " email=\"".htmlspecialchars($notification['email'])."\"";
        $notification_part .= " cc=\"".htmlspecialchars($notification['cc'])."\"";
        $notification_part .= " subject=\"".htmlspecialchars($notification['subject'])."\"";
        $notification_part .= " report_condition=\"".htmlspecialchars($notification['report_condition'])."\"";
        $notification_part .= " status=\"".$notification['status']."\"";
        $notification_part .= "></notification>\n";
        fwrite($this->file, $notification_part);
      }
      fwrite($this->file, $this->indentation."  </notifications>\n");
      unset($notifications);
      unset($notification_part);
    }

    // Write user config parameters.
    $user_params = $this->getRecordsFromTable('tt_config');
    if (count($user_params) > 0) {
      fwrite($this->file, $this->indentation."  <user_params>\n");
      foreach ($user_params as $user_param) {
        $user_param_part = $this->indentation.'    '."<user_param user_id=\"".$this->userMap[$user_param['user_id']]."\"";
        $user_param_part .= " param_name=\"".htmlspecialchars($user_param['param_name'])."\"";
        $user_param_part .= " param_value=\"".htmlspecialchars($user_param['param_value'])."\"";
        $user_param_part .= "></user_param>\n";
        fwrite($this->file, $user_param_part);
      }
      fwrite($this->file, $this->indentation."  </user_params>\n");
      unset($user_params);
      unset($user_param_part);
    }

    // We are mostly done with writing this group data, destroy all maps.
    unset($this->roleMap);
    unset($this->userMap);
    unset($this->taskMap);
    unset($this->projectMap);
    unset($this->clientMap);
    unset($this->invoiceMap);
    unset($this->logMap);
    unset($this->customFieldMap);
    unset($this->customFieldOptionMap);

    // Call self recursively for all subgroups.
    foreach ($this->subgroups as $subgroup) {
      $subgroup_helper = new ttGroupExportHelper($subgroup['id'], $this->file, $this->indentation.'  ');
      $subgroup_helper->writeData();
    }
    unset($this->subgroups);

    fwrite($this->file, $this->indentation."</group>\n");
  }

  // encodeLineBreaks encodes line breaks with an escape sequence.
  // We do this, because our strings are attribute values inside XML tags.
  //
  // If we don't, we lose line breaks after importing data because
  // XML parser converts line breaks into a single white character.
  //
  // TODO: investigate whether we need to encode \t, etc.
  private function encodeLineBreaks($source) {
    $result = htmlspecialchars($source);
    $result = str_replace ("\n", '&#10;', $result);
    $result = str_replace ("\r", '&#13;', $result);
    return $result;
  }

  // isDropdownCustomField is a helper function for remapReportSpecPart.
  // It deteremines if a custom field is of dropdown type.
  private function isDropdownCustomField($field_id) {
    global $user;
    $mdb2 = getConnection();

    $sql = "select type from tt_custom_fields where group_id = $this->group_id and org_id = $user->org_id and id = $field_id";
    $res = $mdb2->query($sql);
    $isDropdown = false;
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $isDropdown = $val['type'] == 2; // TYPE_DROPDOWN, see CustomFields.class.php.
        break;
      }
    }
    return $isDropdown;
  }

  // remapReportSpecPart is a helper function remapReportSpec below.
  // It remaps a single report spec part.
  private function remapReportSpecPart($report_spec_part, $prefix) {
    // Strip prefix.
    $remainder = substr($report_spec_part, strlen($prefix));
    // Find colon, which separates field id from its value.
    $pos = strpos($remainder, ':');
    $field_id = substr($remainder, 0, $pos);
    $field_value = substr($remainder, $pos + 1);
    $mapped_field_id = $this->customFieldMap[$field_id];

    // Do we need to map option id?
    if (!ttStartsWith($prefix, 'show_') && $this->isDropdownCustomField($field_id)) {
      $mapped_field_value = $this->customFieldOptionMap[$field_value];
    } else {
      $mapped_field_value = $field_value;
    }

    $mappedPart = $prefix.$mapped_field_id.':'.$mapped_field_value;
    return $mappedPart;
  }

  // remapReportSpec takes the source report spec as a parameter.
  // It remaps it with new custom field and option ids so that it can be used for import.
  private function remapReportSpec($report_spec) {
    $remappedSpec = null;
    $report_spec_parts = explode(',', $report_spec);
    foreach ($report_spec_parts as $report_spec_part) {
      if (ttStartsWith($report_spec_part, 'time_field_')) {
        $remappedSpec .= ','.$this->remapReportSpecPart($report_spec_part, 'time_field_');
      } elseif (ttStartsWith($report_spec_part, 'show_time_field_')) {
        $remappedSpec .= ','.$this->remapReportSpecPart($report_spec_part, 'show_time_field_');
      } elseif (ttStartsWith($report_spec_part, 'user_field_')) {
        $remappedSpec .= ','.$this->remapReportSpecPart($report_spec_part, 'user_field_');
      } elseif (ttStartsWith($report_spec_part, 'show_user_field_')) {
        $remappedSpec .= ','.$this->remapReportSpecPart($report_spec_part, 'show_user_field_');
      } else {
        // Use the part as is.
        $remappedSpec .= ','.$report_spec_part;
      }
    }
    // Trim comma from the beginning.
    $remappedSpec = ltrim($remappedSpec, ',');
    return $remappedSpec;
  }
}
