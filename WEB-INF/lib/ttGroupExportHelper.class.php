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
//
// Currently, it is work in progress.
// When done, it should handle export of organizations containing multiple groups.
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
  var $invoiceMap = array();
  var $logMap     = array();
  var $customFieldMap = array();
  var $customFieldOptionMap = array();

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

  // getGroupData obtains group attributes for export.
  function getGroupData() {
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
  function getUsers() {
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

  // getRoles - obtains all roles defined for group.
  function getRoles() {
    global $user;
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_roles where group_id = $this->group_id and org_id = $user->org_id";
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

  // getTasks - obtains all tasks defined for group.
  function getTasks() {
    global $user;
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_tasks where group_id = $this->group_id and org_id = $user->org_id";
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

  // getProjects - obtains all projects defined for group.
  function getProjects() {
    global $user;
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_projects where group_id = $this->group_id and org_id = $user->org_id";
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

  // getClients - obtains all clients defined for group.
  function getClients() {
    global $user;
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_clients where group_id = $this->group_id and org_id = $user->org_id";
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

  // writeData writes group data into file.
  function writeData() {

    // Write group info.
    $group = $this->getGroupData();
    $group_part = "<group name=\"".htmlentities($group['name'])."\"";
    $group_part .= " currency=\"".htmlentities($group['currency'])."\"";
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

    // Prepare user map.
    $users = $this->getUsers();
    foreach ($users as $key=>$user_item)
      $this->userMap[$user_item['id']] = $key + 1;

    // Prepare role map.
    $roles = $this->getRoles();
    foreach ($roles as $key=>$role_item)
      $this->roleMap[$role_item['id']] = $key + 1;

    // Prepare task map.
    $tasks = $this->getTasks();
    foreach ($tasks as $key=>$task_item)
      $this->taskMap[$task_item['id']] = $key + 1;

    // Prepare project map.
    $projects = $this->getProjects();
    foreach ($projects as $key=>$project_item)
      $this->projectMap[$project_item['id']] = $key + 1;

    // Prepare client map.
    $clients = $this->getClients();
    foreach ($clients as $key=>$client_item)
      $this->clientMap[$client_item['id']] = $key + 1;

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

    // Write roles.
    fwrite($this->file, $this->indentation."  <roles>\n");
    foreach ($roles as $role) {
      $role_part = $this->indentation.'    '."<role id=\"".$this->roleMap[$role['id']]."\"";
      $role_part .= " name=\"".htmlentities($role['name'])."\"";
      $role_part .= " description=\"".htmlentities($role['description'])."\"";
      $role_part .= " rank=\"".$role['rank']."\"";
      $role_part .= " rights=\"".htmlentities($role['rights'])."\"";
      $role_part .= " status=\"".$role['status']."\"";
      $role_part .= "></role>\n";
      fwrite($this->file, $role_part);
    }
    fwrite($this->file, $this->indentation."  </roles>\n");

    // Write tasks.
    fwrite($this->file, $this->indentation."  <tasks>\n");
    foreach ($tasks as $task) {
      $task_part = $this->indentation.'    '."<task id=\"".$this->taskMap[$task['id']]."\"";
      $task_part .= " name=\"".htmlentities($task['name'])."\"";
      $task_part .= " description=\"".htmlentities($task['description'])."\"";
      $task_part .= " status=\"".$task['status']."\"";
      $task_part .= "></task>\n";
      fwrite($this->file, $task_part);
    }
    fwrite($this->file, $this->indentation."  </tasks>\n");

    // Write projects.
    fwrite($this->file, $this->indentation."  <projects>\n");
    foreach ($projects as $project_item) {
      if($project_item['tasks']){
        $tasks = explode(',', $project_item['tasks']);
        $tasks_mapped = array();
        foreach ($tasks as $item)
          $tasks_mapped[] = $this->taskMap[$item];
        $tasks_str = implode(',', $tasks_mapped);
      }
      $project_part = $this->indentation.'    '."<project id=\"".$this->projectMap[$project_item['id']]."\"";
      $project_part .= " name=\"".htmlentities($project_item['name'])."\"";
      $project_part .= " description=\"".htmlentities($project_item['description'])."\"";
      $project_part .= " tasks=\"".$tasks_str."\"";
      $project_part .= " status=\"".$project_item['status']."\"";
      $project_part .= "></project>\n";
      fwrite($this->file, $project_part);
    }
    fwrite($this->file, $this->indentation."  </projects>\n");

    // Write clients.
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
      $client_part .= " name=\"".htmlentities($client_item['name'])."\"";
      $client_part .= " address=\"".htmlentities($client_item['address'])."\"";
      $client_part .= " tax=\"".$client_item['tax']."\"";
      $client_part .= " projects=\"".$projects_str."\"";
      $client_part .= " status=\"".$client_item['status']."\"";
      $client_part .= "></client>\n";
      fwrite($this->file, $client_part);
    }
    fwrite($this->file, $this->indentation."  </clients>\n");

    // Write users.
    fwrite($this->file, $this->indentation."  <users>\n");
    foreach ($users as $user_item) {
      $role_id = $user_item['rank'] == 512 ? 0 : $this->roleMap[$user_item['role_id']]; // Special role_id 0 (not null) for top manager.
      $user_part = $this->indentation.'    '."<user id=\"".$this->userMap[$user_item['id']]."\"";
      $user_part .= " name=\"".htmlentities($user_item['name'])."\"";
      $user_part .= " login=\"".htmlentities($user_item['login'])."\"";
      $user_part .= " password=\"".$user_item['password']."\"";
      $user_part .= " role_id=\"".$role_id."\"";
      $user_part .= " client_id=\"".$this->clientMap[$user_item['client_id']]."\"";
      $user_part .= " rate=\"".$user_item['rate']."\"";
      $user_part .= " email=\"".$user_item['email']."\"";
      $user_part .= " status=\"".$user_item['status']."\"";
      $user_part .= "></user>\n";
      fwrite($this->file, $user_part);
    }
    fwrite($this->file, $this->indentation."  </users>\n");

    // Write user to project binds.
    fwrite($this->file, $this->indentation."  <user_project_binds>\n");
    $user_binds = ttTeamHelper::getUserToProjectBinds($this->group_id);
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

    // Write invoices.
    fwrite($this->file, $this->indentation."  <invoices>\n");
    foreach ($invoices as $invoice_item) {
      $invoice_part = $this->indentation.'    '."<invoice id=\"".$this->invoiceMap[$invoice_item['id']]."\"";
      $invoice_part .= " name=\"".htmlentities($invoice_item['name'])."\"";
      $invoice_part .= " date=\"".$invoice_item['date']."\"";
      $invoice_part .= " client_id=\"".$this->clientMap[$invoice_item['client_id']]."\"";
      $invoice_part .= " status=\"".$invoice_item['status']."\"";
      $invoice_part .= "></invoice>\n";
      fwrite($this->file, $invoice_part);
    }
    fwrite($this->file, $this->indentation."  </invoices>\n");

    // Write time log entries and build logMap at the same time.
    fwrite($this->file, $this->indentation."  <log>\n");
    $key = 0;
    foreach ($users as $user_item) {
      $records = ttTimeHelper::getAllRecords($user_item['id']);
      foreach ($records as $record) {
        $key++;
        $this->logMap[$record['id']] = $key;
        $log_part = $this->indentation.'    '."<log_item id=\"$key\"";
        $log_part .= " user_id=\"".$this->userMap[$record['user_id']]."\"";
        $log_part .= " date=\"".$record['date']."\"";
        $log_part .= " start=\"".$record['start']."\"";
        $log_part .= " finish=\"".$record['finish']."\"";
        $log_part .= " duration=\"".($record['start']?"":$record['duration'])."\"";
        $log_part .= " client_id=\"".$this->clientMap[$record['client_id']]."\"";
        $log_part .= " project_id=\"".$this->projectMap[$record['project_id']]."\"";
        $log_part .= " task_id=\"".$this->taskMap[$record['task_id']]."\"";
        $log_part .= " invoice_id=\"".$this->invoiceMap[$record['invoice_id']]."\"";
        $log_part .= " comment=\"".htmlentities($record['comment'])."\"";
        $log_part .= " billable=\"".$record['billable']."\"";
        $log_part .= " paid=\"".$record['paid']."\"";
        $log_part .= " status=\"".$record['status']."\"";
        $log_part .= "></log_item>\n";
        fwrite($this->file, $log_part);
      }
    }
    fwrite($this->file, $this->indentation."  </log>\n");
    unset($records);

    // Write custom fields.
    fwrite($this->file, $this->indentation."  <custom_fields>\n");
    foreach ($custom_fields as $custom_field) {
      $custom_field_part = $this->indentation.'    '."<custom_field id=\"".$this->customFieldMap[$custom_field['id']]."\"";
      $custom_field_part .= " type=\"".$custom_field['type']."\"";
      $custom_field_part .= " label=\"".htmlentities($custom_field['label'])."\"";
      $custom_field_part .= " required=\"".$custom_field['required']."\"";
      $custom_field_part .= " status=\"".$custom_field['status']."\"";
      $custom_field_part .= "></custom_field>\n";
      fwrite($this->file, $custom_field_part);
    }
    fwrite($this->file, $this->indentation."  </custom_fields>\n");
    unset($custom_fields);

    // Call self recursively for all subgroups.
    foreach ($this->subgroups as $subgroup) {
      $subgroup_helper = new ttGroupExportHelper($subgroup['id'], $this->file, $this->indentation.'  ');
      $subgroup_helper->writeData();
    }

    fwrite($this->file, $this->indentation."</group>\n");
  }
}
