<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('ttClientHelper');
import('DateAndTime');
import('Period');
import('ttTimeHelper');
import('ttConfigHelper');

require_once(dirname(__FILE__).'/../../plugins/CustomFields.class.php');

// Definitions of types for timesheet dropdown.
define('TIMESHEET_ALL', 0); // Include all records.
define('TIMESHEET_NOT_ASSIGNED', 1); // Include records not assigned to timesheets.
define('TIMESHEET_ASSIGNED', 2); // Include records assigned to timesheets.
define('TIMESHEET_PENDING', 3); // Include records in submitted timesheets that are pending manager approval.
define('TIMESHEET_APPROVED', 4); // Include records in approved timesheets.
define('TIMESHEET_NOT_APPROVED', 5); // Include records in disapproved timesheets.

// Class ttReportHelper is used for help with reports.
class ttReportHelper {

  // getWhere prepares a WHERE clause for a report query.
  static function getWhere($options) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    if ($user->isPluginEnabled('cf')) {
      global $custom_fields;
      if (!$custom_fields) $custom_fields = new CustomFields();
    }

    // A shortcut for timesheets.
    if (isset($options['timesheet_id']) && $options['timesheet_id']) {
      $where = " where l.timesheet_id = ".$options['timesheet_id']." and l.group_id = $group_id and l.org_id = $org_id";
      return $where;
    }

    // Prepare dropdown parts.
    $dropdown_parts = '';
    if ($options['client_id'])
      $dropdown_parts .= ' and l.client_id = '.$options['client_id'];
    elseif ($user->isClient() && $user->client_id)
      $dropdown_parts .= ' and l.client_id = '.$user->client_id;
    if ($options['project_id']) $dropdown_parts .= ' and l.project_id = '.$options['project_id'];
    if ($options['task_id']) $dropdown_parts .= ' and l.task_id = '.$options['task_id'];
    if ($options['billable']=='1') $dropdown_parts .= ' and l.billable = 1';
    if ($options['billable']=='2') $dropdown_parts .= ' and l.billable = 0';
    if ($options['invoice']=='1') $dropdown_parts .= ' and l.invoice_id is not null';
    if ($options['invoice']=='2') $dropdown_parts .= ' and l.invoice_id is null';
    if ($options['timesheet']==TIMESHEET_NOT_ASSIGNED) $dropdown_parts .= ' and l.timesheet_id is null';
    if ($options['timesheet']==TIMESHEET_ASSIGNED) $dropdown_parts .= ' and l.timesheet_id is not null';
    if ($options['approved']=='1') $dropdown_parts .= ' and l.approved = 1';
    if ($options['approved']=='2') $dropdown_parts .= ' and l.approved = 0';
    if ($options['paid_status']=='1') $dropdown_parts .= ' and l.paid = 1';
    if ($options['paid_status']=='2') $dropdown_parts .= ' and l.paid = 0';

    // Add time custom fields.
    if (isset($custom_fields) && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        $field_value = $options[$field_name];
        if ($timeField['type'] == CustomFields::TYPE_DROPDOWN && $field_value) {
          $cfoTable = 'cfo'.$timeField['id'];
          $dropdown_parts .= " and $cfoTable.id = $field_value";
        }
      }
    }

    // Prepare part for text custom fields using LIKE operator.
    $cf_text_parts = null;
    if (isset($custom_fields) && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        $field_value = $options[$field_name];
        if ($timeField['type'] == CustomFields::TYPE_TEXT && $field_value) {
          $cflTableName = 'cfl'.$timeField['id'];
          $cf_text_parts .= " and $cflTableName.value like ".$mdb2->quote("%$field_value%");
        }
      }
    }

    // Add user custom fields.
    if (isset($custom_fields) && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $field_value = $options[$field_name];
        if ($userField['type'] == CustomFields::TYPE_DROPDOWN && $field_value) {
          $cfoTable = 'cfo'.$userField['id'];
          $dropdown_parts .= " and $cfoTable.id = $field_value";
        }
      }
    }

    // Continue preparing part for text custom fields using LIKE operator.
    if (isset($custom_fields) && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $field_value = $options[$field_name];
        if ($userField['type'] == CustomFields::TYPE_TEXT && $field_value) {
          $ecfTableName = 'ecf'.$userField['id'];
          $cf_text_parts .= " and $ecfTableName.value like ".$mdb2->quote("%$field_value%");
        }
      }
    }

    // Prepare sql query part for user list.
    $userlist = $options['users'] ? $options['users'] : '-1';
    if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient())
      $user_list_part = " and l.user_id in ($userlist)";
    else
      $user_list_part = " and l.user_id = ".$user->getUser();
    $user_list_part .= " and l.group_id = $group_id and l.org_id = $org_id";

    // Prepare sql query part for where.
    $dateFormat = $user->getDateFormat();
    if ($options['period'])
      $period = new Period($options['period'], new DateAndTime($dateFormat));
    else {
      $period = new Period();
      $period->setPeriod(
        new DateAndTime($dateFormat, $options['period_start']),
        new DateAndTime($dateFormat, $options['period_end']));
    }
    $where = " where l.status = 1 and l.date >= '".$period->getStartDate(DB_DATEFORMAT)."' and l.date <= '".$period->getEndDate(DB_DATEFORMAT)."'".
      " $user_list_part $dropdown_parts $cf_text_parts";
    return $where;
  }

  // getExpenseWhere prepares WHERE clause for expenses query in a report.
  static function getExpenseWhere($options) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    if ($user->isPluginEnabled('cf')) {
      global $custom_fields;
      if (!isset($custom_fields)) $custom_fields = new CustomFields();
    }

    // Prepare dropdown parts.
    $dropdown_parts = '';
    if ($options['client_id'])
      $dropdown_parts .= ' and ei.client_id = '.$options['client_id'];
    elseif ($user->isClient() && $user->client_id)
      $dropdown_parts .= ' and ei.client_id = '.$user->client_id;
    if ($options['project_id']) $dropdown_parts .= ' and ei.project_id = '.$options['project_id'];
    if ($options['invoice']=='1') $dropdown_parts .= ' and ei.invoice_id is not null';
    if ($options['invoice']=='2') $dropdown_parts .= ' and ei.invoice_id is null';
    if (isset($options['timesheet']) && ($options['timesheet']!=TIMESHEET_ALL && $options['timesheet']!=TIMESHEET_NOT_ASSIGNED)) {
        $dropdown_parts .= ' and 0 = 1'; // Expense items do not have a timesheet_id.
    }
    if ($options['approved']=='1') $dropdown_parts .= ' and ei.approved = 1';
    if ($options['approved']=='2') $dropdown_parts .= ' and ei.approved = 0';
    if ($options['paid_status']=='1') $dropdown_parts .= ' and ei.paid = 1';
    if ($options['paid_status']=='2') $dropdown_parts .= ' and ei.paid = 0';

    // Not adding conditions for time custom fields by design because expenses are not associated with them.
    // Whether or not this is proper, we'll know eventually if users complain.
    // This means that filtering by time custom fields applies only to time items, not expenses.

    // Add user custom fields.
    if (isset($custom_fields) && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $field_value = $options[$field_name];
        if ($userField['type'] == CustomFields::TYPE_DROPDOWN && $field_value) {
          $cfoTable = 'cfo'.$userField['id'];
          $dropdown_parts .= " and $cfoTable.id = $field_value";
        }
      }
    }

    // Prepare part for text custom fields using LIKE operator.
    $cf_text_parts = null;
    if (isset($custom_fields) && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $field_value = $options[$field_name];
        if ($userField['type'] == CustomFields::TYPE_TEXT && $field_value) {
          $ecfTableName = 'ecf'.$userField['id'];
          $cf_text_parts .= " and $ecfTableName.value like ".$mdb2->quote("%$field_value%");
        }
      }
    }

    // Prepare sql query part for user list.
    $userlist = $options['users'] ? $options['users'] : '-1';
    if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient())
      $user_list_part = " and ei.user_id in ($userlist)";
    else
      $user_list_part = " and ei.user_id = ".$user->getUser();
    $user_list_part .= " and ei.group_id = $group_id and ei.org_id = $org_id";

    // Prepare sql query part for where.
    $dateFormat = $user->getDateFormat();
    if ($options['period'])
      $period = new Period($options['period'], new DateAndTime($dateFormat));
    else {
      $period = new Period();
      $period->setPeriod(
        new DateAndTime($dateFormat, $options['period_start']),
        new DateAndTime($dateFormat, $options['period_end']));
    }
    $where = " where ei.status = 1 and ei.date >= '".$period->getStartDate(DB_DATEFORMAT)."' and ei.date <= '".$period->getEndDate(DB_DATEFORMAT)."'".
      " $user_list_part $dropdown_parts $cf_text_parts";
    return $where;
  }

  // getItems retrieves all items associated with a report.
  // It combines tt_log and tt_expense_items in one array for presentation in one table using mysql union all.
  // Expense items use the "note" field for item name.
  static function getItems($options) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Determine these once as they are used in multiple places in this function.
    $canViewReports = $user->can('view_reports') || $user->can('view_all_reports');
    $isClient = $user->isClient();

    if ($user->isPluginEnabled('cf')) {
      global $custom_fields;
      if (!$custom_fields) $custom_fields = new CustomFields();
    }

    $grouping = ttReportHelper::grouping($options);
    $grouping_by_date = $grouping_by_client = $grouping_by_project = $grouping_by_task = $grouping_by_user = false;
    if ($grouping) {
      $grouping_by_date = ttReportHelper::groupingBy('date', $options);
      $grouping_by_client = ttReportHelper::groupingBy('client', $options);
      $grouping_by_project = ttReportHelper::groupingBy('project', $options);
      $grouping_by_task = ttReportHelper::groupingBy('task', $options);
      $grouping_by_user = ttReportHelper::groupingBy('user', $options);
    }
    $convertTo12Hour = ('%I:%M %p' == $user->getTimeFormat()) && ($options['show_start'] || $options['show_end']);
    $trackingMode = $user->getTrackingMode();
    $decimalMark = $user->getDecimalMark();

    // Prepare a query for time items in tt_log table.
    $fields = array(); // An array of fields for database query.
    array_push($fields, 'l.id');
    array_push($fields, 'l.user_id');
    array_push($fields, '1 as type'); // Type 1 is for tt_log entries.
    array_push($fields, 'l.date');
    if($canViewReports || $isClient)
      array_push($fields, 'u.name as user');
    // Add user custom fields.
    if (isset($custom_fields) && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $checkbox_field_name = 'show_'.$field_name;
        if ($options[$checkbox_field_name] || ttReportHelper::groupingBy($field_name, $options)) {
          if ($userField['type'] == CustomFields::TYPE_TEXT) {
            $ecfTableName = 'ecf'.$userField['id'];
            array_push($fields, "$ecfTableName.value as $field_name");
          } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
            $cfoTableName = 'cfo'.$userField['id'];
            array_push($fields, "$cfoTableName.value as $field_name");
          }
        }
      }
    }
    // Add client name if it is selected.
    if ($options['show_client'] || $grouping_by_client)
      array_push($fields, 'c.name as client');
    // Add project name if it is selected.
    if ($options['show_project'] || $grouping_by_project)
      array_push($fields, 'p.name as project');
    // Add task name if it is selected.
    if ($options['show_task'] || $grouping_by_task)
      array_push($fields, 't.name as task');
    // Add time custom fields.
    if (isset($custom_fields) && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        $checkbox_field_name = 'show_'.$field_name;
        if ($options[$checkbox_field_name] || ttReportHelper::groupingBy($field_name, $options)) {
          if ($timeField['type'] == CustomFields::TYPE_TEXT) {
            $cflTable = 'cfl'.$timeField['id'];
            array_push($fields, "$cflTable.value as $field_name");
          } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
            $cfoTable = 'cfo'.$timeField['id'];
            array_push($fields, "$cfoTable.value as $field_name");
          }
        }
      }
    }
    // Add start time.
    if ($options['show_start']) {
      array_push($fields, "l.start as unformatted_start");
      array_push($fields, "TIME_FORMAT(l.start, '%k:%i') as start");
    }
    // Add finish time.
    if ($options['show_end'])
      array_push($fields, "TIME_FORMAT(sec_to_time(time_to_sec(l.start) + time_to_sec(l.duration)), '%k:%i') as finish");
    // Add duration.
    if ($options['show_duration'])
      array_push($fields, "TIME_FORMAT(l.duration, '%k:%i') as duration");
    // Add work units.
    if ($options['show_work_units']) {
      if ($user->getConfigOption('unit_totals_only'))
        array_push($fields, "null as units");
      else {
        $firstUnitThreshold = $user->getConfigInt('1st_unit_threshold', 0);
        $minutesInUnit = $user->getConfigInt('minutes_in_unit', 15);
        array_push($fields, "if(l.billable = 0 or time_to_sec(l.duration)/60 < $firstUnitThreshold, 0, ceil(time_to_sec(l.duration)/60/$minutesInUnit)) as units");
      }
    }
    // Add note.
    if ($options['show_note'])
      array_push($fields, 'l.comment as note');
    // Handle cost.
    $includeCost = $options['show_cost'];
    if ($includeCost) {
      if (MODE_TIME == $trackingMode)
        array_push($fields, "cast(l.billable * coalesce(u.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2)) as cost");   // Use default user rate.
      else
        array_push($fields, "cast(l.billable * coalesce(upb.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2)) as cost"); // Use project rate for user.
      array_push($fields, "null as expense"); 
    }
    // Add the fields used to determine if we show an edit icon for record.
    array_push($fields, 'l.approved');
    array_push($fields, 'l.timesheet_id');
    array_push($fields, 'l.invoice_id');
    // Add paid status.
    if ($canViewReports && $options['show_paid'])
      array_push($fields, 'l.paid');
    // Add IP address.
    if ($canViewReports && $options['show_ip']) {
      array_push($fields, 'l.created');
      array_push($fields, 'l.created_ip');
      array_push($fields, 'l.modified');
      array_push($fields, 'l.modified_ip');
    }
    // Add invoice name if it is selected.
    if (($canViewReports || $isClient) && $options['show_invoice'])
      array_push($fields, 'i.name as invoice');
    // Add timesheet name if it is selected.
    if ($options['show_timesheet'])
      array_push($fields, 'ts.name as timesheet_name');
    // Add has_files.
    if ($options['show_files'])
      array_push($fields, 'if(Sub1.entity_id is null, 0, 1) as has_files');

    // Prepare sql query part for left joins.
    $left_joins = null;
    // Left joins for custom fields.
    // 1 join is required for each text field, 2 joins for each dropdown.
    if (isset($custom_fields) && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $checkbox_field_name = 'show_'.$field_name;
        $entity_type = CustomFields::ENTITY_USER;
        if ($options[$field_name] || $options[$checkbox_field_name] || ttReportHelper::groupingBy($field_name, $options)) {
          $ecfTable = 'ecf'.$userField['id'];
          if ($userField['type'] == CustomFields::TYPE_TEXT) {
            // Add one join for each text field.
            $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = l.user_id and $ecfTable.field_id = ".$userField['id'].")";
          } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
            $cfoTable = 'cfo'.$userField['id'];
            // Add two joins for each dropdown field.
            $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = l.user_id and $ecfTable.field_id = ".$userField['id'].")";
            $left_joins .= " left join tt_custom_field_options $cfoTable on ($cfoTable.field_id = $ecfTable.field_id and $cfoTable.id = $ecfTable.option_id)";
          }
        }
      }
    }
    if ($options['show_client'] || $grouping_by_client)
      $left_joins .= " left join tt_clients c on (c.id = l.client_id)";
    if (($canViewReports || $isClient) && $options['show_invoice'])
      $left_joins .= " left join tt_invoices i on (i.id = l.invoice_id and i.status = 1)";
    if ($canViewReports || $isClient || $user->isPluginEnabled('ex'))
       $left_joins .= " left join tt_users u on (u.id = l.user_id)";
    if ($options['show_project'] || $grouping_by_project)
      $left_joins .= " left join tt_projects p on (p.id = l.project_id)";
    if ($options['show_task'] || $grouping_by_task)
      $left_joins .= " left join tt_tasks t on (t.id = l.task_id)";
    // Left joins for time custom fields.
    if (isset($custom_fields) && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        $checkbox_field_name = 'show_'.$field_name;
        if ($options[$field_name] || $options[$checkbox_field_name] || ttReportHelper::groupingBy($field_name, $options)) {
          $cflTable = 'cfl'.$timeField['id'];
          if ($timeField['type'] == CustomFields::TYPE_TEXT) {
            // Add one join for each text field.
            $left_joins .= " left join tt_custom_field_log $cflTable on ($cflTable.log_id = l.id and $cflTable.status = 1 and $cflTable.field_id = ".$timeField['id'].')';
          } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
            $cfoTable = 'cfo'.$timeField['id'];
            // Add two joins for each dropdown field.
            $left_joins .= " left join tt_custom_field_log $cflTable on ($cflTable.log_id = l.id and $cflTable.status = 1 and $cflTable.field_id = ".$timeField['id'].')';
            $left_joins .= " left join tt_custom_field_options $cfoTable on ($cfoTable.field_id = $cflTable.field_id and $cfoTable.id = $cflTable.option_id)";
          }
        }
      }
    }
    if ($includeCost && MODE_TIME != $trackingMode)
      $left_joins .= " left join tt_user_project_binds upb on (l.user_id = upb.user_id and l.project_id = upb.project_id)";
    if ($options['show_files']) {
      $left_joins .= " left join (select distinct entity_id from tt_files".
        " where entity_type = 'time' and group_id = $group_id and org_id = $org_id and status = 1) Sub1".
        " on (l.id = Sub1.entity_id)";
    }

    // Prepare sql query part for inner joins.
    $inner_joins = null;
    if ($user->isPluginEnabled('ts')) {
      $timesheet_option = $options['timesheet'];
      if ($timesheet_option == TIMESHEET_PENDING)
        $inner_joins .= " inner join tt_timesheets ts on (l.timesheet_id = ts.id and ts.submit_status = 1 and ts.approve_status is null)";
      else if ($timesheet_option == TIMESHEET_APPROVED)
        $inner_joins .= " inner join tt_timesheets ts on (l.timesheet_id = ts.id and ts.approve_status = 1)";
      else if ($timesheet_option == TIMESHEET_NOT_APPROVED)
        $inner_joins .= " inner join tt_timesheets ts on (l.timesheet_id = ts.id and ts.approve_status = 0)";
      else if ($options['show_timesheet'])
        $inner_joins .= " left join tt_timesheets ts on (l.timesheet_id = ts.id)"; // Left join for timesheet nme.
    }

    $where = ttReportHelper::getWhere($options);

    // Construct sql query for tt_log items.
    $sql = "select ".join(', ', $fields)." from tt_log l $left_joins $inner_joins $where";
    // If we don't have expense items (such as when the Expenses plugin is disabled), the above is all sql we need,
    // with an exception of sorting part, that is added in the end.

    // However, when we have expenses, we need to do a union with a separate query for expense items from tt_expense_items table.
    if ($options['show_cost'] && $user->isPluginEnabled('ex')) { // if ex(penses) plugin is enabled

      $fields = array(); // An array of fields for database query.
      array_push($fields, 'ei.id');
      array_push($fields, 'ei.user_id');
      array_push($fields, '2 as type'); // Type 2 is for tt_expense_items entries.
      array_push($fields, 'ei.date');
      if($canViewReports || $isClient)
        array_push($fields, 'u.name as user');
      // Add user custom fields.
      if (isset($custom_fields) && $custom_fields->userFields) {
        foreach ($custom_fields->userFields as $userField) {
          $field_name = 'user_field_'.$userField['id'];
          $checkbox_field_name = 'show_'.$field_name;
          if ($options[$checkbox_field_name] || ttReportHelper::groupingBy($field_name, $options)) {
            if ($userField['type'] == CustomFields::TYPE_TEXT) {
              $ecfTableName = 'ecf'.$userField['id'];
              array_push($fields, "$ecfTableName.value as $field_name");
            } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
              $cfoTableName = 'cfo'.$userField['id'];
              array_push($fields, "$cfoTableName.value as $field_name");
            }
          }
        }
      }
      // Add client name if it is selected.
      if ($options['show_client'] || $grouping_by_client)
        array_push($fields, 'c.name as client');
      // Add project name if it is selected.
      if ($options['show_project'] || $grouping_by_project)
        array_push($fields, 'p.name as project');
      if ($options['show_task'] || $grouping_by_task)
        array_push($fields, 'null'); // null for task name. We need to match column count for union.
      // Add null values for time custom fields.
      if (isset($custom_fields) && $custom_fields->timeFields) {
        foreach ($custom_fields->timeFields as $timeField) {
          $field_name = 'time_field_'.$timeField['id'];
          $checkbox_field_name = 'show_'.$field_name;
          if ($options[$checkbox_field_name] || ttReportHelper::groupingBy($field_name, $options)) {
            array_push($fields, "null as $field_name"); // null for each time custom field.
          }
        }
      }
      if ($options['show_start']) {
        array_push($fields, 'null'); // null for unformatted_start.
        array_push($fields, 'null'); // null for start.
      }
      if ($options['show_end'])
        array_push($fields, 'null'); // null for finish.
      if ($options['show_duration'])
        array_push($fields, 'null'); // null for duration.
      if ($options['show_work_units'])
        array_push($fields, 'null as units'); // null for work units.
      // Use the note field to print item name.
      if ($options['show_note'])
        array_push($fields, 'ei.name as note');
      array_push($fields, 'ei.cost as cost');
      array_push($fields, 'ei.cost as expense');
      // Add the fields used to determine if we show an edit icon for record.
      array_push($fields, 'ei.approved');
      array_push($fields, 'null as timesheet_id');
      array_push($fields, 'ei.invoice_id');
      // Add paid status.
      if ($canViewReports && $options['show_paid'])
        array_push($fields, 'ei.paid');
      // Add IP address.
      if ($canViewReports && $options['show_ip']) {
        array_push($fields, 'ei.created');
        array_push($fields, 'ei.created_ip');
        array_push($fields, 'ei.modified');
        array_push($fields, 'ei.modified_ip');
      }
      // Add invoice name if it is selected.
      if (($canViewReports || $isClient) && $options['show_invoice'])
        array_push($fields, 'i.name as invoice');
      if ($options['show_timesheet'])
        array_push($fields, 'null as timesheet_name');
      // Add has_files.
      if ($options['show_files'])
        array_push($fields, 'if(Sub1.entity_id is null, 0, 1) as has_files');

      // Prepare sql query part for left joins.
      $left_joins = null;
      // Left joins for user custom fields.
      if (isset($custom_fields) && $custom_fields->userFields) {
        foreach ($custom_fields->userFields as $userField) {
          $field_name = 'user_field_'.$userField['id'];
          $checkbox_field_name = 'show_'.$field_name;
          $entity_type = CustomFields::ENTITY_USER;
          if ($options[$field_name] || $options[$checkbox_field_name] || ttReportHelper::groupingBy($field_name, $options)) {
            $ecfTable = 'ecf'.$userField['id'];
            if ($userField['type'] == CustomFields::TYPE_TEXT) {
              // Add one join for each text field.
              $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = ei.user_id and $ecfTable.field_id = ".$userField['id'].")";
            } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
              $cfoTable = 'cfo'.$userField['id'];
              // Add two joins for each dropdown field.
              $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = ei.user_id and $ecfTable.field_id = ".$userField['id'].")";
              $left_joins .= " left join tt_custom_field_options $cfoTable on ($cfoTable.field_id = $ecfTable.field_id and $cfoTable.id = $ecfTable.option_id)";
            }
          }
        }
      }
      if ($canViewReports || $isClient)
        $left_joins .= " left join tt_users u on (u.id = ei.user_id)";
      if ($options['show_client'] || $grouping_by_client)
        $left_joins .= " left join tt_clients c on (c.id = ei.client_id)";
      if ($options['show_project'] || $grouping_by_project)
        $left_joins .= " left join tt_projects p on (p.id = ei.project_id)";
      if (($canViewReports || $isClient) && $options['show_invoice'])
        $left_joins .= " left join tt_invoices i on (i.id = ei.invoice_id and i.status = 1)";
      if ($options['show_files']) {
        $left_joins .= " left join (select distinct entity_id from tt_files".
          " where entity_type = 'expense' and group_id = $group_id and org_id = $org_id and status = 1) Sub1".
          " on (ei.id = Sub1.entity_id)";
      }

      $where = ttReportHelper::getExpenseWhere($options);

      // Construct sql query for expense items.
      $sql_for_expense_items = "select ".join(', ', $fields)." from tt_expense_items ei $left_joins $where";

      // Construct a union.
      $sql = "($sql) union all ($sql_for_expense_items)";
    }

    // Determine sort part.
    $sort_part = ' order by ';
    if ($grouping) {
      $sort_part2 = '';
      $sort_part2 .= ($options['group_by1'] != null && $options['group_by1'] != 'no_grouping') ? ', '.$options['group_by1'] : '';
      $sort_part2 .= ($options['group_by2'] != null && $options['group_by2'] != 'no_grouping') ? ', '.$options['group_by2'] : '';
      $sort_part2 .= ($options['group_by3'] != null && $options['group_by3'] != 'no_grouping') ? ', '.$options['group_by3'] : '';
      if (!$grouping_by_date) $sort_part2 .= ', date';
      $sort_part .= ltrim($sort_part2, ', '); // Remove leading comma and space.
    } else {
      $sort_part .= 'date';
    }
    if (($canViewReports || $isClient) && $options['users'] && !$grouping_by_user)
      $sort_part .= ', user, type';
    if ($options['show_start'])
      $sort_part .= ', unformatted_start';
    $sort_part .= ', id';

    $sql .= $sort_part;
    // By now we are ready with sql.

    // Obtain items for report.
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) die($res->getMessage());

    while ($val = $res->fetchRow()) {
      if ($convertTo12Hour) {
        if($val['start'] != '')
          $val['start'] = ttTimeHelper::to12HourFormat($val['start']);
        if($val['finish'] != '')
          $val['finish'] = ttTimeHelper::to12HourFormat($val['finish']);
      }
      if (isset($val['cost'])) {
        if ('.' != $decimalMark)
          $val['cost'] = str_replace('.', $decimalMark, $val['cost']);
      }
      if (isset($val['expense'])) {
        if ('.' != $decimalMark)
          $val['expense'] = str_replace('.', $decimalMark, $val['expense']);
      }

      if ($grouping) $val['grouped_by'] = ttReportHelper::makeGroupByKey($options, $val);
      $val['date'] = ttDateToUserFormat($val['date']);

      $report_items[] = $val;
    }

    return $report_items;
  }

  // putInSession stores tt_log and tt_expense_items ids from a report in user session
  // as 2 comma-separated lists.
  static function putInSession($report_items) {
    unset($_SESSION['report_item_ids']);
    unset($_SESSION['report_item_expense_ids']);

    if (is_array($report_items)) {
      // Iterate through records and build 2 comma-separated lists.
      $report_item_ids = '';
      $report_item_expense_ids = '';
      foreach($report_items as $item) {
        if ($item['type'] == 1)
          $report_item_ids .= ','.$item['id'];
        else if ($item['type'] == 2)
          $report_item_expense_ids .= ','.$item['id'];
      }
      $report_item_ids = trim($report_item_ids, ',');
      $report_item_expense_ids = trim($report_item_expense_ids, ',');

      // The lists are ready. Put them in session.
      if ($report_item_ids) $_SESSION['report_item_ids'] = $report_item_ids;
      if ($report_item_expense_ids) $_SESSION['report_item_expense_ids'] = $report_item_expense_ids;
    }
  }

  // getFromSession obtains tt_log and tt_expense_items ids stored in user session.
  static function getFromSession() {
    $items = array();
    $report_item_ids = @$_SESSION['report_item_ids'];
    if ($report_item_ids)
      $items['report_item_ids'] = explode(',', $report_item_ids);
    $report_item_expense_ids = @$_SESSION['report_item_expense_ids'];
    if ($report_item_expense_ids)
      $items['report_item_expense_ids'] = explode(',', $report_item_expense_ids);
    return $items;
  }

  // getSubtotals calculates report items subtotals when a report is grouped by.
  // Without expenses, it's a simple select with group by.
  // With expenses, it becomes a select with group by from a combined set of records obtained with "union all".
  // getSubtotals uses helper functions such as makeConcatPart and others to get parts to assemble an sql query from.
  // Query may become quite complex depending on $options, whether custom fields are used, etc.
  // This is the reason for having individual functions for parts (to keep getSubtotals easier to manage).
  static function getSubtotals($options) {
    global $user;
    $mdb2 = getConnection();

    $concat_part = ttReportHelper::makeConcatPart($options);
    $group_by_fields_part = ttReportHelper::makeGroupByFieldsPart($options);
    $work_unit_part = ttReportHelper::makeWorkUnitPart($options);
    $join_part = ttReportHelper::makeJoinPart($options);
    $cost_part = ttReportHelper::makeCostPart($options);
    $where = ttReportHelper::getWhere($options);
    $group_by_part = ttReportHelper::makeGroupByPart($options);

    $parts = $concat_part.$group_by_fields_part.", sum(time_to_sec(l.duration)) as time, null as expenses".$work_unit_part.$cost_part;
    $sql = "select $parts from tt_log l $join_part $where $group_by_part";
    // By now we have sql for time items.

    // However, when we have expenses, we need to do a union with a separate query for expense items from tt_expense_items table.
    if (isset($options['show_cost']) && $options['show_cost'] && $user->isPluginEnabled('ex')) { // if ex(penses) plugin is enabled

      $concat_part = ttReportHelper::makeConcatExpensesPart($options);
      $group_by_fields_part = ttReportHelper::makeGroupByFieldsExpensesPart($options);
      $join_part = ttReportHelper::makeJoinExpensesPart($options);
      $where = ttReportHelper::getExpenseWhere($options);
      $group_by_expenses_part = ttReportHelper::makeGroupByExpensesPart($options);
      $parts = $concat_part.$group_by_fields_part.", null as time";
      if ($options['show_work_units']) $parts .= ", null as units";
      $parts .= ", sum(ei.cost) as cost, sum(ei.cost) as expenses";
      $sql_for_expenses = "select $parts from tt_expense_items ei $join_part $where $group_by_expenses_part";

      // Create a combined query.
      $fields = ttReportHelper::makeCombinedSelectPart($options);
      $combined = "select $fields, sum(time) as time";
      if ($options['show_work_units']) $combined .= ", sum(units) as units";
      $combined .= ", sum(cost) as cost, sum(expenses) as expenses from (($sql) union all ($sql_for_expenses)) t group by $fields";
      $sql = $combined;
    }

    // Execute query.
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) die($res->getMessage());
    while ($val = $res->fetchRow()) {
      $time = ttTimeHelper::minutesToDuration($val['time'] / 60);
      $rowLabel = ttReportHelper::makeGroupByLabel($val['group_field'], $options);
      if (isset($options['show_cost']) && $options['show_cost']) {
        $decimalMark = $user->getDecimalMark();
        if ('.' != $decimalMark) {
          $val['cost'] = str_replace('.', $decimalMark, $val['cost']);
          $val['expenses'] = str_replace('.', $decimalMark, $val['expenses']);
        }
        $subtotals[$val['group_field']] = array('name'=>$rowLabel,
          'user'=>isset($val['user']) ? $val['user'] : null,
          'project'=>isset($val['project']) ? $val['project'] : null,
          'task'=>isset($val['task']) ? $val['task'] : null,
          'client'=>isset($val['client']) ? $val['client'] : null,
          'time'=>$time,
          'units'=>isset($val['units']) ? $val['units'] : null,
          'cost'=>$val['cost'],
          'expenses'=>$val['expenses']);
      } else {
        $subtotals[$val['group_field']] = array('name'=>$rowLabel,
          'user'=>isset($val['user']) ? $val['user'] : null,
          'project'=>isset($val['project']) ? $val['project'] : null,
          'task'=>isset($val['task']) ? $val['task'] : null,
          'client'=>isset($val['client']) ? $val['client'] : null,
          'time'=>$time,
          'units'=>isset($val['units']) ? $val['units'] : null);
      }
    }

    return $subtotals;
  }

  // getTotals calculates total hours and cost for all report items.
  static function getTotals($options)
  {
    global $user;
    $mdb2 = getConnection();

    if ($user->isPluginEnabled('cf')) {
      global $custom_fields;
      if (!isset($custom_fields)) $custom_fields = new CustomFields();
    }

    $trackingMode = $user->getTrackingMode();
    $decimalMark = $user->getDecimalMark();
    $where = ttReportHelper::getWhere($options);

    // Prepare parts.
    $time_part = $units_part = $cost_part = '';
    $time_part = "sum(time_to_sec(l.duration)) as time";
    if (isset($options['show_work_units']) && $options['show_work_units']) {
      $unitTotalsOnly = $user->getConfigOption('unit_totals_only');
      $firstUnitThreshold = $user->getConfigInt('1st_unit_threshold', 0);
      $minutesInUnit = $user->getConfigInt('minutes_in_unit', 15);
      $units_part = $unitTotalsOnly ? ", null as units" : ", sum(if(l.billable = 0 or time_to_sec(l.duration)/60 < $firstUnitThreshold, 0, ceil(time_to_sec(l.duration)/60/$minutesInUnit))) as units";
    }
    if (isset($options['show_cost']) && $options['show_cost']) {
      if (MODE_TIME == $trackingMode)
        $cost_part = ", sum(cast(l.billable * coalesce(u.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2))) as cost, null as expenses";
      else
        $cost_part = ", sum(cast(l.billable * coalesce(upb.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2))) as cost, null as expenses";
    } else {
      $cost_part = ", null as cost, null as expenses";
    }

    // Prepare left joins.
    $left_joins = null;
    // Left joins for custom fields.
    if (isset($custom_fields) && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        $field_value = $options[$field_name];
        if ($field_value) {
          $cflTable = 'cfl'.$timeField['id'];
          if ($timeField['type'] == CustomFields::TYPE_TEXT) {
            // Add one join for each text field.
            $left_joins .= " left join tt_custom_field_log $cflTable on ($cflTable.log_id = l.id and $cflTable.status = 1)";
          } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
            $cfoTable = 'cfo'.$timeField['id'];
            // Add two joins for each dropdown field.
            $left_joins .= " left join tt_custom_field_log $cflTable on ($cflTable.log_id = l.id and $cflTable.status = 1)";
            $left_joins .= " left join tt_custom_field_options $cfoTable on ($cfoTable.field_id = $cflTable.field_id and $cfoTable.id = $cflTable.option_id)";
          }
        }
      }
    }
    if (isset($custom_fields) && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $field_value = $options[$field_name];
        $entity_type = CustomFields::ENTITY_USER;
        if ($field_value) {
          // We need to add left joins when input is not null.
          $ecfTable = 'ecf'.$userField['id'];
          if ($userField['type'] == CustomFields::TYPE_TEXT) {
            // Add one join for each text field.
            $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = l.user_id and $ecfTable.field_id = ".$userField['id'].")";
          } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
            $cfoTable = 'cfo'.$userField['id'];
            // Add two joins for each dropdown field.
            $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = l.user_id and $ecfTable.field_id = ".$userField['id'].")";
            $left_joins .= " left join tt_custom_field_options $cfoTable on ($cfoTable.field_id = $ecfTable.field_id and $cfoTable.id = $ecfTable.option_id)";
          }
        }
      }
    }
    if (isset($options['show_cost']) && $options['show_cost']) {
      if (MODE_TIME == $trackingMode) {
        $left_joins .= " left join tt_users u on (l.user_id = u.id)";
      } else {
        $left_joins .= " left join tt_user_project_binds upb on (l.user_id = upb.user_id and l.project_id = upb.project_id)";
      }
    }
    // Prepare sql query part for inner joins.
    $inner_joins = null;
    if ($user->isPluginEnabled('ts') && isset($options['timesheet']) && $options['timesheet']) {
      $timesheet_option = $options['timesheet'];
      if ($timesheet_option == TIMESHEET_PENDING)
        $inner_joins .= " inner join tt_timesheets ts on (l.timesheet_id = ts.id and ts.submit_status = 1 and ts.approve_status is null)";
      else if ($timesheet_option == TIMESHEET_APPROVED)
        $inner_joins .= " inner join tt_timesheets ts on (l.timesheet_id = ts.id and ts.approve_status = 1)";
      else if ($timesheet_option == TIMESHEET_NOT_APPROVED)
        $inner_joins .= " inner join tt_timesheets ts on (l.timesheet_id = ts.id and ts.approve_status = 0)";
    }
    // Prepare a query for time items.
    $sql = "select $time_part $units_part $cost_part from tt_log l $left_joins $inner_joins $where";

    // If we have expenses, query becomes a bit more complex.
    if (isset($options['show_cost']) && $options['show_cost'] && $user->isPluginEnabled('ex')) {
      $where = ttReportHelper::getExpenseWhere($options);
      $sql_for_expenses = "select null as time";
      if ($options['show_work_units']) $sql_for_expenses .= ", null as units";

      // Prepate left joins.
      $left_joins = null;
      // Left joins for custom fields.
      if (isset($custom_fields) && $custom_fields->userFields) {
        foreach ($custom_fields->userFields as $userField) {
          $field_name = 'user_field_'.$userField['id'];
          $field_value = $options[$field_name];
          $entity_type = CustomFields::ENTITY_USER;
          if ($field_value) {
            // We need to add left joins when input is not null.
            $ecfTable = 'ecf'.$userField['id'];
            if ($userField['type'] == CustomFields::TYPE_TEXT) {
              // Add one join for each text field.
              $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = ei.user_id and $ecfTable.field_id = ".$userField['id'].")";
            } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
              $cfoTable = 'cfo'.$userField['id'];
              // Add two joins for each dropdown field.
              $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = ei.user_id and $ecfTable.field_id = ".$userField['id'].")";
              $left_joins .= " left join tt_custom_field_options $cfoTable on ($cfoTable.field_id = $ecfTable.field_id and $cfoTable.id = $ecfTable.option_id)";
            }
          }
        }
      }

      $sql_for_expenses .= ", sum(cost) as cost, sum(cost) as expenses from tt_expense_items ei $left_joins $where";

      // Create a combined query.
      $combined = "select sum(time) as time";
      if ($options['show_work_units']) $combined .= ", sum(units) as units";
      $combined .= ", sum(cost) as cost, sum(expenses) as expenses from (($sql) union all ($sql_for_expenses)) t";
      $sql = $combined;
    }

    // Execute query.
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) die($res->getMessage());

    $val = $res->fetchRow();
    $total_time = ttTimeHelper::minutesToDuration($val['time'] / 60);
    $total_cost = $total_expenses = null;
    if (isset($options['show_cost']) && $options['show_cost']) {
      $total_cost = $val['cost'];
      if (!$total_cost) $total_cost = '0.00';
      if ('.' != $decimalMark)
        $total_cost = str_replace('.', $decimalMark, $total_cost);
      $total_expenses = $val['expenses'];
      if (!$total_expenses) $total_expenses = '0.00';
      if ('.' != $decimalMark)
        $total_expenses = str_replace('.', $decimalMark, $total_expenses);
    }

    $dateFormat = $user->getDateFormat();
    if (isset($options['period']) && $options['period'])
      $period = new Period($options['period'], new DateAndTime($dateFormat));
    else {
      $period = new Period();
      if (isset($options['period_start']) && isset($options['period_end']))
        $period->setPeriod(
          new DateAndTime($dateFormat, $options['period_start']),
          new DateAndTime($dateFormat, $options['period_end']));
    }

    $totals['start_date'] = $period->getStartDate();
    $totals['end_date'] = $period->getEndDate();
    $totals['time'] = $total_time;
    $totals['minutes'] = $val['time'] / 60;
    $totals['units'] = isset($val['units']) ? $val['units'] : null;
    $totals['cost'] = $total_cost;
    $totals['expenses'] = $total_expenses;

    return $totals;
  }

  // The assignToInvoice assigns a set of records to a specific invoice.
  static function assignToInvoice($invoice_id, $time_log_ids, $expense_item_ids) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    if ($time_log_ids) {
      $sql = "update tt_log set invoice_id = ".$mdb2->quote($invoice_id).
        " where id in(".join(', ', $time_log_ids).") and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
    if ($expense_item_ids) {
      $sql = "update tt_expense_items set invoice_id = ".$mdb2->quote($invoice_id).
        " where id in(".join(', ', $expense_item_ids).") and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
  }

  // The assignToTimesheet assigns a set of tt_log records to a specific timesheet.
  static function assignToTimesheet($timesheet_id, $time_log_ids) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    if ($time_log_ids) {
      // Use inner join as a protection mechanism not to do anything with "acted upon" timesheets.
      // Allow oprations only with pending timesheets.
      if ($timesheet_id) {
        // Assigning a timesheet to records.
        $inner_join = " inner join tt_timesheets ts on (ts.id = $timesheet_id".
          " and ts.user_id = $user_id and ts.approve_status is null". // Timesheet to assign to is pending.
          // Part below: existing timesheet either not exists or is also pending.
          " and (l.timesheet_id is null or (l.timesheet_id = ts.id and ts.approve_status is null)))";
      } else {
        $inner_join = " inner join tt_timesheets ts on (ts.id = l.timesheet_id".
          " and ts.user_id = $user_id and ts.approve_status is null)"; // Do not deassign from acted-upon timesheets.
      }

      $sql = "update tt_log l $inner_join".
        " set l.timesheet_id = ".$mdb2->quote($timesheet_id).
        " where l.id in(".join(', ', $time_log_ids).") and l.user_id = $user_id and l.group_id = $group_id and l.org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
  }

  // The markApproved marks a set of records as either approved or unapproved.
  static function markApproved($time_log_ids, $expense_item_ids, $approved = true) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $approved_val = (int) $approved;
    if ($time_log_ids) {
      $sql = "update tt_log set approved = $approved_val".
        " where id in(".join(', ', $time_log_ids).") and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
    if ($expense_item_ids) {
      $sql = "update tt_expense_items set approved = $approved_val".
        " where id in(".join(', ', $expense_item_ids).") and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
  }

  // The markPaid marks a set of records as either paid or unpaid.
  static function markPaid($time_log_ids, $expense_item_ids, $paid = true) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $paid_val = (int) $paid;
    if ($time_log_ids) {
      $sql = "update tt_log set paid = $paid_val".
        " where id in(".join(', ', $time_log_ids).") and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
    if ($expense_item_ids) {
      $sql = "update tt_expense_items set paid = $paid_val".
        " where id in(".join(', ', $expense_item_ids).") and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
  }

  // prepareReportBody - prepares an email body for report.
  static function prepareReportBody($options, $comment = null)
  {
    global $user;
    global $i18n;

    // Determine these once as they are used in multiple places in this function.
    $canViewReports = $user->can('view_reports') || $user->can('view_all_reports');
    $isClient = $user->isClient();

    $config = new ttConfigHelper($user->getConfig());
    $show_note_column = $options['show_note'] && !$config->getDefinedValue('report_note_on_separate_row');
    $show_note_row = $options['show_note'] && $config->getDefinedValue('report_note_on_separate_row');

    $items = ttReportHelper::getItems($options);
    $grouping = ttReportHelper::grouping($options);
    if ($grouping)
      $subtotals = ttReportHelper::getSubtotals($options);
    $totals = ttReportHelper::getTotals($options);

    // Use custom fields plugin if it is enabled.
    if ($user->isPluginEnabled('cf'))
      $custom_fields = new CustomFields();

    // Define some styles to use in email.
    $style_title = 'text-align: center; font-size: 15pt; font-family: Arial, Helvetica, sans-serif;';
    $tableHeader = 'font-weight: bold; background-color: #a6ccf7; text-align: left;';
    $tableHeaderCentered = 'font-weight: bold; background-color: #a6ccf7; text-align: center;';
    $rowItem = 'background-color: #ffffff;';
    $rowItemAlt = 'background-color: #f5f5f5;';
    $rowSubtotal = 'background-color: #e0e0e0;';
    $cellLeftAligned = 'text-align: left; vertical-align: top;';
    $cellRightAligned = 'text-align: right; vertical-align: top;';
    $cellLeftAlignedSubtotal = 'font-weight: bold; text-align: left; vertical-align: top;';
    $cellRightAlignedSubtotal = 'font-weight: bold; text-align: right; vertical-align: top;';

    // Determine column span for note field.
    $colspan = 1;
    if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) $colspan++;
    // User custom fields.
    if ($custom_fields && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $checkbox_control_name = 'show_'.$field_name;
        if ($options[$checkbox_control_name]) $colspan++;
      }
    }
    if ($options['show_client']) $colspan++;
    if ($options['show_project']) $colspan++;
    if ($options['show_task']) $colspan++;
    // Time custom fields.
    if ($custom_fields && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        $checkbox_control_name = 'show_'.$field_name;
        if ($options[$checkbox_control_name]) $colspan++;
      }
    }
    if ($options['show_start']) $colspan++;
    if ($options['show_end']) $colspan++;
    if ($options['show_duration']) $colspan++;
    if ($options['show_work_units']) $colspan++;
    if ($options['show_cost']) $colspan++;
    if ($options['show_approved']) $colspan++;
    if ($options['show_paid']) $colspan++;
    if ($options['show_ip']) $colspan++;
    if ($options['show_invoice']) $colspan++;
    if ($options['show_timesheet']) $colspan++;

    // Start creating email body.
    $body = '<html>';
    $body .= '<head><meta http-equiv="content-type" content="text/html; charset='.CHARSET.'"></head>';
    $body .= '<body>';

    // Output title.
    $body .= '<p style="'.$style_title.'">'.$i18n->get('form.mail.report_subject').': '.$totals['start_date'].' - '.$totals['end_date'].'</p>';

    // Output comment.
    if ($comment) $body .= '<p>'.htmlspecialchars($comment).'</p>';

    if ($options['show_totals_only']) {
      // Totals only report. Output subtotals.
      $group_by_header = ttReportHelper::makeGroupByHeader($options);

      $body .= '<table border="0" cellpadding="4" cellspacing="0" width="100%">';
      $body .= '<tr>';
      $body .= '<td style="'.$tableHeader.'">'.$group_by_header.'</td>';
      if ($options['show_duration'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.duration').'</td>';
      if ($options['show_work_units'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.work_units_short').'</td>';
      if ($options['show_cost'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.cost').'</td>';
      $body .= '</tr>';
      foreach($subtotals as $subtotal) {
        $body .= '<tr style="'.$rowSubtotal.'">';
        $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($subtotal['name'] ? htmlspecialchars($subtotal['name']) : '&nbsp;').'</td>';
        if ($options['show_duration']) {
          $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
          if ($subtotal['time'] <> '0:00') $body .= $subtotal['time'];
          $body .= '</td>';
        }
        if ($options['show_work_units']) {
          $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
          $body .= $subtotal['units'];
          $body .= '</td>';
        }
        if ($options['show_cost']) {
          $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
          $body .= ($canViewReports || $isClient) ? $subtotal['cost'] : $subtotal['expenses'];
          $body .= '</td>';
        }
        $body .= '</tr>';
      }

      // Print totals.
      $body .= '<tr><td>&nbsp;</td></tr>';
      $body .= '<tr style="'.$rowSubtotal.'">';
      $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$i18n->get('label.total').'</td>';
      if ($options['show_duration']) {
        $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
        if ($totals['time'] <> '0:00') $body .= $totals['time'];
        $body .= '</td>';
      }
      if ($options['show_work_units']) {
        $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
        $body .= $totals['units'];
        $body .= '</td>';
      }
      if ($options['show_cost']) {
        $body .= '<td nowrap style="'.$cellRightAlignedSubtotal.'">'.htmlspecialchars($user->currency).' ';
        $body .= ($canViewReports || $isClient) ? $totals['cost'] : $totals['expenses'];
        $body .= '</td>';
      }
      $body .= '</tr>';

      $body .= '</table>';
    } else {
      // Regular report.

      // Print table header.
      $body .= '<table border="0" cellpadding="4" cellspacing="0" width="100%">';
      $body .= '<tr>';
      $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.date').'</td>';
      if ($canViewReports || $isClient)
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.user').'</td>';
      // User custom fields.
      if ($custom_fields && $custom_fields->userFields) {
        foreach ($custom_fields->userFields as $userField) {
          $field_name = 'user_field_'.$userField['id'];
          $checkbox_control_name = 'show_'.$field_name;
          if ($options[$checkbox_control_name]) $body .= '<td style="'.$tableHeader.'">'.htmlspecialchars($userField['label']).'</td>';
        }
      }
      if ($options['show_client'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.client').'</td>';
      if ($options['show_project'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.project').'</td>';
      if ($options['show_task'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.task').'</td>';
      // Time custom fields.
      if ($custom_fields && $custom_fields->timeFields) {
        foreach ($custom_fields->timeFields as $timeField) {
          $field_name = 'time_field_'.$timeField['id'];
          $checkbox_control_name = 'show_'.$field_name;
          if ($options[$checkbox_control_name]) $body .= '<td style="'.$tableHeader.'">'.htmlspecialchars($timeField['label']).'</td>';
        }
      }
      if ($options['show_start'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.start').'</td>';
      if ($options['show_end'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.finish').'</td>';
      if ($options['show_duration'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.duration').'</td>';
      if ($options['show_work_units'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.work_units_short').'</td>';
      if ($show_note_column)
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.note').'</td>';
      if ($options['show_cost'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.cost').'</td>';
      if ($options['show_approved'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.approved').'</td>';
      if ($options['show_paid'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.paid').'</td>';
      if ($options['show_ip'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.ip').'</td>';
      if ($options['show_invoice'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.invoice').'</td>';
      if ($options['show_timesheet'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.timesheet').'</td>';
      $body .= '</tr>';

      // Initialize variables to print subtotals.
      if ($items && $grouping) {
        $print_subtotals = true;
        $first_pass = true;
        $prev_grouped_by = '';
        $cur_grouped_by = '';
      }
      // Initialize variables to alternate color of rows for different dates.
      $prev_date = '';
      $cur_date = '';
      $row_style = $rowItem;

      // Print report items.
      if (is_array($items)) {
        foreach ($items as $record) {
          $cur_date = $record['date'];
          // Print a subtotal row after a block of grouped items.
          if ($print_subtotals) {
            $cur_grouped_by = $record['grouped_by'];
            if ($cur_grouped_by != $prev_grouped_by && !$first_pass) {
              $body .= '<tr style="'.$rowSubtotal.'">';
              $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$i18n->get('label.subtotal').'</td>';
              $subtotal_name = htmlspecialchars($subtotals[$prev_grouped_by]['name']);
              if ($canViewReports || $isClient) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['user'].'</td>';
              // User custom fields.
              if ($custom_fields && $custom_fields->userFields) {
                foreach ($custom_fields->userFields as $userField) {
                  $field_name = 'user_field_'.$userField['id'];
                  $checkbox_control_name = 'show_'.$field_name;
                  if ($options[$checkbox_control_name]) $body .= '<td></td>';
                }
              }
              if ($options['show_client']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['client'].'</td>';
              if ($options['show_project']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['project'].'</td>';
              if ($options['show_task']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['task'].'</td>';
              // Time custom fields.
              if ($custom_fields && $custom_fields->timeFields) {
                foreach ($custom_fields->timeFields as $timeField) {
                  $field_name = 'time_field_'.$timeField['id'];
                  $checkbox_control_name = 'show_'.$field_name;
                  if ($options[$checkbox_control_name]) $body .= '<td></td>';
                }
              }
              if ($options['show_start']) $body .= '<td></td>';
              if ($options['show_end']) $body .= '<td></td>';
              if ($options['show_duration']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['time'].'</td>';
              if ($options['show_work_units']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['units'].'</td>';
              if ($show_note_column) $body .= '<td></td>';
              if ($options['show_cost']) {
                $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
                $body .= ($canViewReports || $isClient) ? $subtotals[$prev_grouped_by]['cost'] : $subtotals[$prev_grouped_by]['expenses'];
                $body .= '</td>';
              }
              if ($options['show_approved']) $body .= '<td></td>';
              if ($options['show_paid']) $body .= '<td></td>';
              if ($options['show_ip']) $body .= '<td></td>';
              if ($options['show_invoice']) $body .= '<td></td>';
              if ($options['show_timesheet']) $body .= '<td></td>';
              $body .= '</tr>';
              $body .= '<tr><td>&nbsp;</td></tr>';
            }
            $first_pass = false;
          }

          // Print a regular row.
          if ($cur_date != $prev_date)
            $row_style = ($row_style == $rowItem) ? $rowItemAlt : $rowItem;
          $body .= '<tr style="'.$row_style.'">';
          $body .= '<td style="'.$cellLeftAligned.'">'.$record['date'].'</td>';
          if ($canViewReports || $isClient)
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['user']).'</td>';
          // User custom fields.
          if ($custom_fields && $custom_fields->userFields) {
            foreach ($custom_fields->userFields as $userField) {
              $field_name = 'user_field_'.$userField['id'];
              $checkbox_control_name = 'show_'.$field_name;
              if ($options[$checkbox_control_name]) $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record[$field_name]).'</td>';
            }
          }
          if ($options['show_client'])
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['client']).'</td>';
          if ($options['show_project'])
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['project']).'</td>';
          if ($options['show_task'])
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['task']).'</td>';
          // Time custom fields.
          if ($custom_fields && $custom_fields->timeFields) {
            foreach ($custom_fields->timeFields as $timeField) {
              $field_name = 'time_field_'.$timeField['id'];
              $checkbox_control_name = 'show_'.$field_name;
              if ($options[$checkbox_control_name]) $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record[$field_name]).'</td>';
            }
          }
          if ($options['show_start'])
            $body .= '<td nowrap style="'.$cellRightAligned.'">'.$record['start'].'</td>';
          if ($options['show_end'])
            $body .= '<td nowrap style="'.$cellRightAligned.'">'.$record['finish'].'</td>';
          if ($options['show_duration'])
            $body .= '<td style="'.$cellRightAligned.'">'.$record['duration'].'</td>';
          if ($options['show_work_units'])
            $body .= '<td style="'.$cellRightAligned.'">'.$record['units'].'</td>';
          if ($show_note_column)
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['note']).'</td>';
          if ($options['show_cost'])
            $body .= '<td style="'.$cellRightAligned.'">'.$record['cost'].'</td>';
          if ($options['show_approved']) {
            $body .= '<td style="'.$cellRightAligned.'">';
            $body .= $record['approved'] == 1 ? $i18n->get('label.yes') : $i18n->get('label.no');
            $body .= '</td>';
          }
          if ($options['show_paid']) {
            $body .= '<td style="'.$cellRightAligned.'">';
            $body .= $record['paid'] == 1 ? $i18n->get('label.yes') : $i18n->get('label.no');
            $body .= '</td>';
          }
          if ($options['show_ip']) {
            $body .= '<td style="'.$cellRightAligned.'">';
            $body .= $record['modified'] ? $record['modified_ip'].' '.$record['modified'] : $record['created_ip'].' '.$record['created'];
            $body .= '</td>';
          }
          if ($options['show_invoice'])
            $body .= '<td style="'.$cellRightAligned.'">'.htmlspecialchars($record['invoice']).'</td>';
          if ($options['show_timesheet'])
            $body .= '<td style="'.$cellRightAligned.'">'.htmlspecialchars($record['timesheet']).'</td>';
          $body .= '</tr>';
          if ($show_note_row && $record['note']) {
            $body .= '<tr style="'.$row_style.'">';
            $body .= '<td style="'.$cellRightAligned.'">'.$i18n->get('label.note').':</td>';
            $body .= '<td colspan="'.$colspan.'">'.$record['note'].'</td>';
            $body .= '</tr>';
          }
          $prev_date = $record['date'];
          if ($print_subtotals)
            $prev_grouped_by = $record['grouped_by'];
        }
      }

      // Print a terminating subtotal.
      if ($print_subtotals) {
        $body .= '<tr style="'.$rowSubtotal.'">';
        $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$i18n->get('label.subtotal').'</td>';
        $subtotal_name = htmlspecialchars($subtotals[$cur_grouped_by]['name']);
        if ($canViewReports || $isClient) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['user'].'</td>';
        // User custom fields.
        if ($custom_fields && $custom_fields->userFields) {
          foreach ($custom_fields->userFields as $userField) {
            $field_name = 'user_field_'.$userField['id'];
            $checkbox_control_name = 'show_'.$field_name;
            if ($options[$checkbox_control_name]) $body .= '<td></td>';
          }
        }
        if ($options['show_client']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['client'].'</td>';
        if ($options['show_project']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['project'].'</td>';
        if ($options['show_task']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['task'].'</td>';
        // Time custom fields.
        if ($custom_fields && $custom_fields->timeFields) {
          foreach ($custom_fields->timeFields as $timeField) {
            $field_name = 'time_field_'.$timeField['id'];
            $checkbox_control_name = 'show_'.$field_name;
            if ($options[$checkbox_control_name]) $body .= '<td></td>';
          }
        }
        if ($options['show_start']) $body .= '<td></td>';
        if ($options['show_end']) $body .= '<td></td>';
        if ($options['show_duration']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$cur_grouped_by]['time'].'</td>';
        if ($options['show_work_units']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$cur_grouped_by]['units'].'</td>';
        if ($show_note_column) $body .= '<td></td>';
        if ($options['show_cost']) {
          $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
          $body .= ($canViewReports || $isClient) ? $subtotals[$cur_grouped_by]['cost'] : $subtotals[$cur_grouped_by]['expenses'];
          $body .= '</td>';
        }
        if ($options['show_approved']) $body .= '<td></td>';
        if ($options['show_paid']) $body .= '<td></td>';
        if ($options['show_ip']) $body .= '<td></td>';
        if ($options['show_invoice']) $body .= '<td></td>';
        if ($options['show_timesheet']) $body .= '<td></td>';
        $body .= '</tr>';
      }

      // Print totals.
      $body .= '<tr><td>&nbsp;</td></tr>';
      $body .= '<tr style="'.$rowSubtotal.'">';
      $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$i18n->get('label.total').'</td>';
      if ($canViewReports || $isClient) $body .= '<td></td>';
      // User custom fields.
      if ($custom_fields && $custom_fields->userFields) {
        foreach ($custom_fields->userFields as $userField) {
          $field_name = 'user_field_'.$userField['id'];
          $checkbox_control_name = 'show_'.$field_name;
          if ($options[$checkbox_control_name]) $body .= '<td></td>';
        }
      }
      if ($options['show_client']) $body .= '<td></td>';
      if ($options['show_project']) $body .= '<td></td>';
      if ($options['show_task']) $body .= '<td></td>';
      // Time custom fields.
      if ($custom_fields && $custom_fields->timeFields) {
        foreach ($custom_fields->timeFields as $timeField) {
          $field_name = 'time_field_'.$timeField['id'];
          $checkbox_control_name = 'show_'.$field_name;
          if ($options[$checkbox_control_name]) $body .= '<td></td>';
        }
      }
      if ($options['show_start']) $body .= '<td></td>';
      if ($options['show_end']) $body .= '<td></td>';
      if ($options['show_duration']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$totals['time'].'</td>';
      if ($options['show_work_units']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$totals['units'].'</td>';
      if ($show_note_column) $body .= '<td></td>';
      if ($options['show_cost']) {
        $body .= '<td nowrap style="'.$cellRightAlignedSubtotal.'">'.htmlspecialchars($user->currency).' ';
        $body .= ($canViewReports || $isClient) ? $totals['cost'] : $totals['expenses'];
        $body .= '</td>';
      }
      if ($options['show_approved']) $body .= '<td></td>';
      if ($options['show_paid']) $body .= '<td></td>';
      if ($options['show_ip']) $body .= '<td></td>';
      if ($options['show_invoice']) $body .= '<td></td>';
      if ($options['show_timesheet']) $body .= '<td></td>';
      $body .= '</tr>';

      $body .= '</table>';
    }

    // Output footer.
    if (!defined('REPORT_FOOTER') || !(REPORT_FOOTER == false))
      $body .= '<p style="text-align: center;">'.$i18n->get('form.mail.footer').'</p>';

    // Finish creating email body.
    $body .= '</body></html>';

    return $body;
  }

  // checkFavReportCondition - checks whether it is okay to send fav report.
  static function checkFavReportCondition($options, $condition)
  {
    $actual_value = 0;
    $condition = trim($condition);
    if (ttStartsWith($condition, "count")) {
      $items = ttReportHelper::getItems($options);
      $actual_value = count($items);
      $condition = trim(str_replace('count', '', $condition));
    } else if (ttStartsWith($condition, "hours")) {
      $totals = ttReportHelper::getTotals($options);
      $actual_value = (int)($totals['minutes'] / 60);
      $condition = trim(str_replace('hours', '', $condition));
    } else {
      echo "Invalid condition: " . $condition . "\n";
      return false;
    }

    $greater_or_equal = ttStartsWith($condition, '>=');
    if ($greater_or_equal) $condition = trim(str_replace('>=', '', $condition));

    $less_or_equal = ttStartsWith($condition, '<=');
    if ($less_or_equal) $condition = trim(str_replace('<=', '', $condition));

    $not_equal = ttStartsWith($condition, '<>');
    if ($not_equal) $condition = trim(str_replace('<>', '', $condition));

    $greater = ttStartsWith($condition, '>');
    if ($greater) $condition = trim(str_replace('>', '', $condition));

    $less = ttStartsWith($condition, '<');
    if ($less) $condition = trim(str_replace('<', '', $condition));

    $equal = ttStartsWith($condition, '=');
    if ($equal) $condition = trim(str_replace('=', '', $condition));

    $required_value = (int) $condition;

    if ($greater && $actual_value > $required_value) return true;
    if ($greater_or_equal && $actual_value >= $required_value) return true;
    if ($less && $actual_value < $required_value) return true;
    if ($less_or_equal && $actual_value <= $required_value) return true;
    if ($equal && $actual_value == $required_value) return true;
    if ($not_equal && $actual_value <> $required_value) return true;

    return false;
  }

  // sendFavReport - sends a favorite report to a specified email, called from cron.php
  static function sendFavReport($options, $subject, $comment, $email, $cc) {
    // We are called from cron.php, we have no $bean in session.
    // cron.php sets global $user and $i18n objects to match our favorite report user.
    global $user;
    global $i18n;

    // Prepare report body.
    $body = ttReportHelper::prepareReportBody($options, $comment);

    import('mail.Mailer');
    $mailer = new Mailer();
    $mailer->setCharSet(CHARSET);
    $mailer->setContentType('text/html');
    $mailer->setSender(SENDER);
    if (!empty($cc))
      $mailer->setReceiverCC($cc);
    if (!empty($user->bcc_email))
      $mailer->setReceiverBCC($user->bcc_email);
    $mailer->setReceiver($email);
    $mailer->setMailMode(MAIL_MODE);
    if (empty($subject)) $subject = $options['name'];
    if (!$mailer->send($subject, $body))
      return false;

    return true;
  }

  // getReportOptions - returns an array of report options constructed from session bean.
  //
  // Note: similarly to ttFavReportHelper::getReportOptions, this function is a part of
  // refactoring to simplify maintenance of report generating functions, as we currently
  // have 2 sets: normal reporting (from bean), and fav report emailing (from db fields).
  // Using options obtained from either db or bean shall allow us to use only one set of functions.
  static function getReportOptions($bean) {
    global $user;

    // Prepare an array of report options.
    $options = array();

    // Construct one by one.
    $options['name'] = null; // No name required.
    $options['user_id'] = $user->id; // Not sure if we need user_id here. Fav reports use it to recycle $user object in cron.php.
    $options['client_id'] = $bean->getAttribute('client');
    $options['project_id'] = $bean->getAttribute('project');
    $options['task_id'] = $bean->getAttribute('task');
    $options['billable'] = $bean->getAttribute('include_records');
    $options['invoice'] = $bean->getAttribute('invoice');
    $options['paid_status'] = $bean->getAttribute('paid_status');
    $options['approved'] = $bean->getAttribute('approved');
    if ($user->isPluginEnabled('ap') && $user->isClient() && !$user->can('view_client_unapproved'))
      $options['approved'] = 1; // Restrict clients to approved records only.
    $options['timesheet'] = $bean->getAttribute('timesheet');

    $active_users_in_bean = $bean->getAttribute('users_active');
    if ($active_users_in_bean && is_array($active_users_in_bean)) {
      $users = join(',', $active_users_in_bean);
    }
    $inactive_users_in_bean = $bean->getAttribute('users_inactive');
    if ($inactive_users_in_bean && is_array($inactive_users_in_bean)) {
      if ($users) $users .= ',';
      $users .= join(',', $inactive_users_in_bean);
    }
    if ($users) $options['users'] = $users;

    $options['period'] = $bean->getAttribute('period');
    $options['period_start'] = $bean->getAttribute('start_date');
    $options['period_end'] = $bean->getAttribute('end_date');
    $options['show_client'] = $bean->getAttribute('chclient');
    $options['show_invoice'] = $bean->getAttribute('chinvoice');
    $options['show_approved'] = $bean->getAttribute('chapproved');
    $options['show_paid'] = $bean->getAttribute('chpaid');
    $options['show_ip'] = $bean->getAttribute('chip');
    $options['show_project'] = $bean->getAttribute('chproject');
    $options['show_start'] = $bean->getAttribute('chstart');
    $options['show_duration'] = $bean->getAttribute('chduration');
    $options['show_cost'] = $bean->getAttribute('chcost');
    $options['show_task'] = $bean->getAttribute('chtask');
    $options['show_end'] = $bean->getAttribute('chfinish');
    $options['show_note'] = $bean->getAttribute('chnote');
    $options['show_work_units'] = $bean->getAttribute('chunits');
    $options['show_timesheet'] = $bean->getAttribute('chtimesheet');
    $options['show_files'] = $bean->getAttribute('chfiles');

    // Prepare custom field options.
    if ($user->isPluginEnabled('cf')) {
      global $custom_fields;
      if (!$custom_fields) $custom_fields = new CustomFields();

      // Time fields.
      if ($custom_fields->timeFields) {
        foreach ($custom_fields->timeFields as $timeField) {
          $control_name = 'time_field_'.$timeField['id'];
          $checkbox_control_name = 'show_'.$control_name;
          $options[$control_name] =  $bean->getAttribute($control_name);
          $options[$checkbox_control_name] =  $bean->getAttribute($checkbox_control_name);
        }
      }

      // User fields.
      if ($custom_fields->userFields) {
        foreach ($custom_fields->userFields as $userField) {
          $control_name = 'user_field_'.$userField['id'];
          $checkbox_control_name = 'show_'.$control_name;
          $options[$control_name] =  $bean->getAttribute($control_name);
          $options[$checkbox_control_name] =  $bean->getAttribute($checkbox_control_name);
        }
      }

      // TODO: add project fields here.
    }

    $options['group_by1'] = $bean->getAttribute('group_by1');
    $options['group_by2'] = $bean->getAttribute('group_by2');
    $options['group_by3'] = $bean->getAttribute('group_by3');
    $options['show_totals_only'] = $bean->getAttribute('chtotalsonly');
    return $options;
  }

  // verifyBean is a security function to make sure data in bean makes sense for a group.
  static function verifyBean($bean) {
    global $user;

    // Check users.
    $active_users_in_bean = (array) $bean->getAttribute('users_active');
    $inactive_users_in_bean = (array) $bean->getAttribute('users_inactive');
    if (is_array($active_users_in_bean) || is_array($inactive_users_in_bean)) {
      $users_in_group = ttGroupHelper::getUsers();
      foreach ($users_in_group as $user_in_group) {
        $valid_ids[] = $user_in_group['id'];
      }
      foreach ($active_users_in_bean as $user_in_bean) {
        if (!in_array($user_in_bean, $valid_ids)) {
          return false;
        }
      }
      foreach ($inactive_users_in_bean as $user_in_bean) {
        if (!in_array($user_in_bean, $valid_ids)) {
          return false;
        }
      }
    }

    // TODO: add additional checks here. Perhaps do it before saving the bean for consistency.
    return true;
  }

  // makeGroupByKey builds a combined group by key from group_by1, group_by2 and group_by3 values
  // (passed in $options) and a row of data ($row obtained from a db query).
  static function makeGroupByKey($options, $row) {
    $group_by_key = '';
    if ($options['group_by1'] != null && $options['group_by1'] != 'no_grouping') {
      // We have group_by1.
      $group_by1 = $options['group_by1'];
      $group_by1_value = $row[$group_by1];
      //if ($group_by1 == 'date') $group_by1_value = ttDateToUserFormat($group_by1_value);
      if (empty($group_by1_value)) $group_by1_value = 'Null'; // To match what comes out of makeConcatPart.
      $group_by_key .= ' - '.$group_by1_value;
    }
    if ($options['group_by2'] != null && $options['group_by2'] != 'no_grouping') {
      // We have group_by2.
      $group_by2 = $options['group_by2'];
      $group_by2_value = $row[$group_by2];
      //if ($group_by2 == 'date') $group_by2_value = ttDateToUserFormat($group_by2_value);
      if (empty($group_by2_value)) $group_by2_value = 'Null'; // To match what comes out of makeConcatPart.
      $group_by_key .= ' - '.$group_by2_value;
    }
    if ($options['group_by3'] != null && $options['group_by3'] != 'no_grouping') {
      // We have group_by3.
      $group_by3 = $options['group_by3'];
      $group_by3_value = $row[$group_by3];
      //if ($group_by3 == 'date') $group_by3_value = ttDateToUserFormat($group_by3_value);
      if (empty($group_by3_value)) $group_by3_value = 'Null'; // To match what comes out of makeConcatPart.
      $group_by_key .= ' - '.$group_by3_value;
    }
    $group_by_key = trim($group_by_key, ' -');
    return $group_by_key;
  }

  // makeSingleDropdownGroupByPart is a helper function for makeGroupByPart.
  // It prepates a group by part corresponding to a single dropdown control.
  static function makeSingleDropdownGroupByPart($dropdown_value, $options) {
    if ($dropdown_value == null || $dropdown_value == 'no_grouping')
      return null;
    if ('date' == $dropdown_value)
      return (', l.date');
    if ('user' == $dropdown_value)
      return (', u.name');
    if ('client' == $dropdown_value)
      return (', c.name');
    if ('project' == $dropdown_value)
      return (', p.name');
    if ('task' == $dropdown_value)
      return (', t.name');
    if (ttReportHelper::groupingBy($dropdown_value, $options))
      return (", $dropdown_value");
  }

  // makeGroupByPart builds a combined group by part for sql query for time items using group_by1,
  // group_by2, and group_by3 values passed in $options.
  static function makeGroupByPart($options) {
    if (!ttReportHelper::grouping($options)) return null;

    $group_by_parts = '';
    if (isset($options['group_by1']))
      $group_by_parts .= ttReportHelper::makeSingleDropdownGroupByPart($options['group_by1'], $options);
    if (isset($options['group_by2']))
      $group_by_parts .= ttReportHelper::makeSingleDropdownGroupByPart($options['group_by2'], $options);
    if (isset($options['group_by3']))
      $group_by_parts .= ttReportHelper::makeSingleDropdownGroupByPart($options['group_by3'], $options);
    // Remove garbage from the beginning.
    $group_by_parts = ltrim($group_by_parts, ', ');
    $group_by_part = "group by $group_by_parts";
    return $group_by_part;
  }

  // makeSingleDropdownGroupByExpensesPart is a helper function for makeGroupByExpensesPart.
  // It prepates a group by part corresponding to a single dropdown control.
  static function makeSingleDropdownGroupByExpensesPart($dropdown_value, $options) {
    if ($dropdown_value == null || $dropdown_value == 'no_grouping')
      return null;
    if ('date' == $dropdown_value)
      return (', ei.date');
    if ('user' == $dropdown_value)
      return (', u.name');
    if ('client' == $dropdown_value)
      return (', c.name');
    if ('project' == $dropdown_value)
      return (', p.name');
    if (ttReportHelper::groupingBy($dropdown_value, $options))
      return (", $dropdown_value");
  }

  // makeGroupByExpensesPart builds a combined group by part for sql query for expense items using
  // group_by1, group_by2, and group_by3 values passed in $options.
  static function makeGroupByExpensesPart($options) {
    if (!ttReportHelper::grouping($options)) return null;

    $group_by_parts = '';
    $group_by_parts .= ttReportHelper::makeSingleDropdownGroupByExpensesPart($options['group_by1'], $options);
    $group_by_parts .= ttReportHelper::makeSingleDropdownGroupByExpensesPart($options['group_by2'], $options);
    $group_by_parts .= ttReportHelper::makeSingleDropdownGroupByExpensesPart($options['group_by3'], $options);
    // Remove garbage from the beginning.
    $group_by_parts = ltrim($group_by_parts, ', ');
    $group_by_part = "group by $group_by_parts";
    return $group_by_part;
  }

  // makeSingleDropdownConcatPart is a helper function for makeConcatPart.
  // It make a concatenation part for getSubtotals query for time items
  // corresponding to a single dropdown control.
  static function makeSingleDropdownConcatPart($dropdown_value, $options) {
    if ($dropdown_value == null || $dropdown_value == 'no_grouping')
      return null;
    if ('date' == $dropdown_value)
      return (", ' - ', l.date");
    if ('user' == $dropdown_value)
      return (", ' - ', u.name");
    if ('client' == $dropdown_value)
      return (", ' - ', coalesce(c.name, 'Null')");
    if ('project' == $dropdown_value)
      return (", ' - ', coalesce(p.name, 'Null')");
    if ('task' == $dropdown_value)
      return (", ' - ', coalesce(t.name, 'Null')");
    if (ttReportHelper::groupingBy($dropdown_value, $options)) {
      return ttReportHelper::makeSingleDropdownConcatCustomFieldPart($dropdown_value);
    }
  }

  // makeSingleDropdownConcatCustomFieldPart is a helper function for makeSingleDropdownConcatPart.
  // It prepares the part when a custom field is selected.
  static function makeSingleDropdownConcatCustomFieldPart($dropdown_value) {
    global $custom_fields;

    // Iterate through user custom fields.
    if ($custom_fields && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        if ($dropdown_value == $field_name) {
          if ($userField['type'] == CustomFields::TYPE_TEXT) {
            return (", ' - ', coalesce(ecf".$userField['id'].".value, 'Null')");
          } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
            return (", ' - ', coalesce(cfo".$userField['id'].".value, 'Null')");
          }
        }
      }
    }
    // Iterate through time custom fields.
    if ($custom_fields && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        if ($dropdown_value == $field_name) {
          if ($timeField['type'] == CustomFields::TYPE_TEXT) {
            return (", ' - ', coalesce(cfl".$timeField['id'].".value, 'Null')");
          } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
            return (", ' - ', coalesce(cfo".$timeField['id'].".value, 'Null')");
          }
        }
      }
    }
    return null;
  }

  // makeSingleDropdownConcatCustomFieldExpensesPart is a helper function for makeSingleDropdownConcatExpensesPart.
  // It prepares the part when a custom field is selected.
  static function makeSingleDropdownConcatCustomFieldExpensesPart($dropdown_value) {
    global $custom_fields;

    // Iterate through user custom fields.
    if ($custom_fields && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        if ($dropdown_value == $field_name) {
          if ($userField['type'] == CustomFields::TYPE_TEXT) {
            return (", ' - ', coalesce(ecf".$userField['id'].".value, 'Null')");
          } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
            return (", ' - ', coalesce(cfo".$userField['id'].".value, 'Null')");
          }
        }
      }
    }
    // Iterate through time custom fields.
    if ($custom_fields && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        if ($dropdown_value == $field_name) {
          if ($timeField['type'] == CustomFields::TYPE_TEXT) {
            return (", ' - ', 'Null'");
          } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
            return (", ' - ', 'Null'");
          }
        }
      }
    }
    return null;
  }

  // makeSingleDropdownGroupByFieldPart is a helper function for makeGroupByFieldsPart.
  // It make a fields part for getSubtotals query for time items
  // corresponding to a single group by dropdown control.
  static function makeSingleDropdownGroupByFieldPart($dropdown_value, $options) {
    if ($dropdown_value == null || $dropdown_value == 'no_grouping')
      return null;
    if ('user' == $dropdown_value)
      return (', u.name as user');
    if ('client' == $dropdown_value)
      return (', c.name as client');
    if ('project' == $dropdown_value)
      return (', p.name as project');
    if ('task' == $dropdown_value)
      return (', t.name as task');
    if (ttReportHelper::groupingBy($dropdown_value, $options)) {
      return ttReportHelper::makeSingleDropdownGroupByCustomFieldPart($dropdown_value);
    }
  }

  // makeSingleDropdownGroupByCustomFieldPart is a helper function for makeGroupByFieldsPart.
  // It prepares the part when a custom field is selected.
  static function makeSingleDropdownGroupByCustomFieldPart($dropdown_value) {
    global $custom_fields;

    // Iterate through user custom fields.
    if ($custom_fields && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        if ($dropdown_value == $field_name) {
          if ($userField['type'] == CustomFields::TYPE_TEXT) {
            return (", ecf".$userField['id'].".value as $field_name");
          } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
            return (", cfo".$userField['id'].".value as $field_name");
          }
        }
      }
    }
    // Iterate through time custom fields.
    if ($custom_fields && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        if ($dropdown_value == $field_name) {
          if ($timeField['type'] == CustomFields::TYPE_TEXT) {
            return (", cfl".$timeField['id'].".value as $field_name");
          } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
            return (", cfo".$timeField['id'].".value as $field_name");
          }
        }
      }
    }
    return null;
  }

  // makeSingleDropdownGroupByCustomFieldExpensesPart is a helper function for makeGroupByFieldsPart.
  // It prepares the part when a custom field is selected.
  static function makeSingleDropdownGroupByCustomFieldExpensesPart($dropdown_value) {
    global $custom_fields;

    // Iterate through user custom fields.
    if ($custom_fields && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        if ($dropdown_value == $field_name) {
          if ($userField['type'] == CustomFields::TYPE_TEXT) {
            return (", ecf".$userField['id'].".value as $field_name");
          } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
            return (", cfo".$userField['id'].".value as $field_name");
          }
        }
      }
    }
    // Iterate through time custom fields.
    if ($custom_fields && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        if ($dropdown_value == $field_name) {
          return (", null as $field_name");
        }
      }
    }
    return null;
  }

  // makeGroupByFieldsPart builds a list of fields for sql query for time items using group_by1,
  // group_by2, and group_by3 values passed in $options.
  static function makeGroupByFieldsPart($options) {
    if (!ttReportHelper::grouping($options)) return null;

    $group_by_fields_parts = '';
    if (isset($options['group_by1']))
      $group_by_fields_parts .= ttReportHelper::makeSingleDropdownGroupByFieldPart($options['group_by1'], $options);
    if (isset($options['group_by2']))
      $group_by_fields_parts .= ttReportHelper::makeSingleDropdownGroupByFieldPart($options['group_by2'], $options);
    if (isset($options['group_by3']))
      $group_by_fields_parts .= ttReportHelper::makeSingleDropdownGroupByFieldPart($options['group_by3'], $options);
    return $group_by_fields_parts;
  }

  // makeGroupByFieldsExpensesPart builds a list of fields for sql query for expense items using group_by1,
  // group_by2, and group_by3 values passed in $options.
  static function makeGroupByFieldsExpensesPart($options) {
    if (!ttReportHelper::grouping($options)) return null;

    $group_by_fields_parts = '';
    if (isset($options['group_by1']))
      $group_by_fields_parts .= ttReportHelper::makeSingleDropdownGroupByFieldExpensesPart($options['group_by1'], $options);
    if (isset($options['group_by2']))
      $group_by_fields_parts .= ttReportHelper::makeSingleDropdownGroupByFieldExpensesPart($options['group_by2'], $options);
    if (isset($options['group_by3']))
      $group_by_fields_parts .= ttReportHelper::makeSingleDropdownGroupByFieldExpensesPart($options['group_by3'], $options);
    return $group_by_fields_parts;
  }

  // makeConcatPart builds a concatenation part for getSubtotals query (for time items).
  static function makeConcatPart($options) {
    if (!ttReportHelper::grouping($options)) return null;

    $concat_part = '';
    if (isset($options['group_by1']))
      $concat_part .= ttReportHelper::makeSingleDropdownConcatPart($options['group_by1'], $options);
    if (isset($options['group_by2']))
      $concat_part .= ttReportHelper::makeSingleDropdownConcatPart($options['group_by2'], $options);
    if (isset($options['group_by3']))
      $concat_part .= ttReportHelper::makeSingleDropdownConcatPart($options['group_by3'], $options);
    // Remove garbage from the beginning.
    if (ttStartsWith($concat_part, ", ' - ', "))
      $concat_part = substr($concat_part, 9);
    $concat_part = "concat($concat_part) as group_field";
    return $concat_part;
  }

  // makeSingleDropdownConcatExpensesPart is a helper function for makeConcatExpensesPart.
  // It make a concatenation part for getSubtotals query for expense items
  // corresponding to a single dropdown control.
  static function makeSingleDropdownConcatExpensesPart($dropdown_value, $options) {
    if ($dropdown_value == null || $dropdown_value == 'no_grouping')
      return null;
    if ('date' == $dropdown_value)
      return (", ' - ', ei.date");
    if ('user' == $dropdown_value)
      return (", ' - ', u.name");
    if ('client' == $dropdown_value)
      return (", ' - ', coalesce(c.name, 'Null')");
    if ('project' == $dropdown_value)
      return (", ' - ', coalesce(p.name, 'Null')");
    if ('task' == $dropdown_value)
      return (", ' - ', 'Null'");
    if (ttReportHelper::groupingBy($dropdown_value, $options)) {
      return ttReportHelper::makeSingleDropdownConcatCustomFieldExpensesPart($dropdown_value);
    }
  }

  // makeConcatPart builds a concatenation part for getSubtotals query (for expense items).
  static function makeConcatExpensesPart($options) {
    if (!ttReportHelper::grouping($options)) return null;

    $concat_part = '';
    $concat_part .= ttReportHelper::makeSingleDropdownConcatExpensesPart($options['group_by1'], $options);
    $concat_part .= ttReportHelper::makeSingleDropdownConcatExpensesPart($options['group_by2'], $options);
    $concat_part .= ttReportHelper::makeSingleDropdownConcatExpensesPart($options['group_by3'], $options);
    // Remove garbage from the beginning.
    if (ttStartsWith($concat_part, ", ' - ', "))
      $concat_part = substr($concat_part, 9);
    $concat_part = "concat($concat_part) as group_field";
    return $concat_part;
  }

  // makeSingleDropdownGroupByFieldExpensesPart is a helper function for makeGroupByFieldsExpensesPart.
  // It make a fields part for getSubtotals query for expense items
  // corresponding to a single group by dropdown control.
  static function makeSingleDropdownGroupByFieldExpensesPart($dropdown_value, $options) {
    if ($dropdown_value == null || $dropdown_value == 'no_grouping')
      return null;
    if ('user' == $dropdown_value)
      return (', u.name as user');
    if ('client' == $dropdown_value)
      return (', c.name as client');
    if ('project' == $dropdown_value)
      return (', p.name as project');
    if ('task' == $dropdown_value)
      return (', null as task');
    if (ttReportHelper::groupingBy($dropdown_value, $options)) {
      return ttReportHelper::makeSingleDropdownGroupByCustomFieldExpensesPart($dropdown_value);
    }
  }

  // makeCombinedSelectPart builds a list of fields for a combined select on a union for getSubtotals.
  // This is used when we include expenses.
  static function makeCombinedSelectPart($options) {
    $group_by1 = $options['group_by1'];
    $group_by2 = $options['group_by2'];
    $group_by3 = $options['group_by3'];

    $fields = "group_field";

    switch ($group_by1) {
      case 'user':
        $fields .= ', user';
        break;
      case 'client':
        $fields_part .= ', client';
        break;
      case 'project':
        $fields .= ', project';
        break;
      case 'task':
        $fields .= ', task';
        break;
    }
    switch ($group_by2) {
      case 'user':
        $fields .= ', user';
        break;
      case 'client':
        $fields_part .= ', client';
        break;
      case 'project':
        $fields .= ', project';
        break;
      case 'task':
        $fields .= ', task';
        break;
    }
    switch ($group_by3) {
      case 'user':
        $fields .= ', user';
        break;
      case 'client':
        $fields_part .= ', client';
        break;
      case 'project':
        $fields .= ', project';
        break;
      case 'task':
        $fields .= ', task';
        break;
    }
    return $fields;
  }

  // makeJoinPart builds a left join part for getSubtotals query (for time items).
  static function makeJoinPart($options) {
    global $user;

    if ($user->isPluginEnabled('cf')) {
      global $custom_fields;
      if (!isset($custom_fields)) $custom_fields = new CustomFields();
    }

    $trackingMode = $user->getTrackingMode();
    $left_joins = null;
    if (ttReportHelper::groupingBy('user', $options) || MODE_TIME == $trackingMode) {
      $left_joins .= ' left join tt_users u on (l.user_id = u.id)';
    }
    if (ttReportHelper::groupingBy('client', $options)) {
      $left_joins .= ' left join tt_clients c on (l.client_id = c.id)';
    }
    if (ttReportHelper::groupingBy('project', $options)) {
      $left_joins .= ' left join tt_projects p on (l.project_id = p.id)';
    }
    if (ttReportHelper::groupingBy('task', $options)) {
      $left_joins .= ' left join tt_tasks t on (l.task_id = t.id)';
    }
    if (isset($options['show_cost']) && $options['show_cost'] && $trackingMode != MODE_TIME) {
      $left_joins .= ' left join tt_user_project_binds upb on (l.user_id = upb.user_id and l.project_id = upb.project_id)';
    }
    // Left joins for time custom fields.
    if (isset($custom_fields) && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        $field_value = $options[$field_name];
        if ($field_value || ttReportHelper::groupingBy($field_name, $options)) {
          $cflTable = 'cfl'.$timeField['id'];
          if ($timeField['type'] == CustomFields::TYPE_TEXT) {
            // Add one join for each text field.
            $left_joins .= " left join tt_custom_field_log $cflTable on ($cflTable.log_id = l.id and $cflTable.status = 1 and $cflTable.field_id = ".$timeField['id'].")";
          } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
            $cfoTable = 'cfo'.$timeField['id'];
            // Add two joins for each dropdown field.
            $left_joins .= " left join tt_custom_field_log $cflTable on ($cflTable.log_id = l.id and $cflTable.status = 1 and $cflTable.field_id = ".$timeField['id'].")";
            $left_joins .= " left join tt_custom_field_options $cfoTable on ($cfoTable.field_id = $cflTable.field_id and $cfoTable.id = $cflTable.option_id)";
          }
        }
      }
    }
    // Left joins for user custom fields.
    if (isset($custom_fields) && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $field_value = $options[$field_name];
        $entity_type = CustomFields::ENTITY_USER;
        if ($field_value || ttReportHelper::groupingBy($field_name, $options)) {
          // We need to add left joins when input is not null.
          $ecfTable = 'ecf'.$userField['id'];
          if ($userField['type'] == CustomFields::TYPE_TEXT) {
            // Add one join for each text field.
            $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = l.user_id and $ecfTable.field_id = ".$userField['id'].")";
          } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
            $cfoTable = 'cfo'.$userField['id'];
            // Add two joins for each dropdown field.
            $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = l.user_id and $ecfTable.field_id = ".$userField['id'].")";
            $left_joins .= " left join tt_custom_field_options $cfoTable on ($cfoTable.field_id = $ecfTable.field_id and $cfoTable.id = $ecfTable.option_id)";
          }
        }
      }
    }

    // Prepare inner joins.
    $inner_joins = null;
    if ($user->isPluginEnabled('ts') && isset($options['timesheet']) && $options['timesheet']) {
      $timesheet_option = $options['timesheet'];
      if ($timesheet_option == TIMESHEET_PENDING)
        $inner_joins .= " inner join tt_timesheets ts on (l.timesheet_id = ts.id and ts.submit_status = 1 and ts.approve_status is null)";
      else if ($timesheet_option == TIMESHEET_APPROVED)
        $inner_joins .= " inner join tt_timesheets ts on (l.timesheet_id = ts.id and ts.approve_status = 1)";
      else if ($timesheet_option == TIMESHEET_NOT_APPROVED)
        $inner_joins .= " inner join tt_timesheets ts on (l.timesheet_id = ts.id and ts.approve_status = 0)";
    }

    $join_part = $left_joins.$inner_joins;
    return $join_part;
  }

  // makeWorkUnitPart builds an sql part for work units for time items.
  static function makeWorkUnitPart($options) {
    global $user;

    $work_unit_part = '';
    if (isset($options['show_work_units']) && $options['show_work_units']) {
      $unitTotalsOnly = $user->getConfigOption('unit_totals_only');
      $firstUnitThreshold = $user->getConfigInt('1st_unit_threshold', 0);
      $minutesInUnit = $user->getConfigInt('minutes_in_unit', 15);
      if ($unitTotalsOnly)
        $work_unit_part = ", if (sum(l.billable * time_to_sec(l.duration)/60) < $firstUnitThreshold, 0, ceil(sum(l.billable * time_to_sec(l.duration)/60/$minutesInUnit))) as units";
      else
        $work_unit_part = ", sum(if(l.billable = 0 or time_to_sec(l.duration)/60 < $firstUnitThreshold, 0, ceil(time_to_sec(l.duration)/60/$minutesInUnit))) as units";
    }
    return $work_unit_part;
  }

  // makeCostPart builds a cost part for time items.
  static function makeCostPart($options) {
    global $user;

    $cost_part = '';
    if (isset($options['show_cost']) && $options['show_cost']) {
      if (MODE_TIME == $user->getTrackingMode())
        $cost_part = ", sum(cast(l.billable * coalesce(u.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10, 2))) as cost";
      else
        $cost_part .= ", sum(cast(l.billable * coalesce(upb.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2))) as cost";
    }
    return $cost_part;
  }

  // makeJoinExpensesPart builds a left join part for getSubtotals query for expense items.
  static function makeJoinExpensesPart($options) {
    global $user;

    if ($user->isPluginEnabled('cf')) {
      global $custom_fields;
      if (!$custom_fields) $custom_fields = new CustomFields();
    }

    $left_joins = null;
    if (ttReportHelper::groupingBy('user', $options)) {
      $left_joins .= ' left join tt_users u on (ei.user_id = u.id)';
    }
    if (ttReportHelper::groupingBy('client', $options)) {
      $left_joins .= ' left join tt_clients c on (ei.client_id = c.id)';
    }
    if (ttReportHelper::groupingBy('project', $options)) {
      $left_joins .= ' left join tt_projects p on (ei.project_id = p.id)';
    }
    // Not adding left joins for time custom fiels by design.
    // Left joins for user custom fields.
    if (isset($custom_fields) && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        $field_value = $options[$field_name];
        $entity_type = CustomFields::ENTITY_USER;
        if ($field_value || ttReportHelper::groupingBy($field_name, $options)) {
          // We need to add left joins when input is not null.
          $ecfTable = 'ecf'.$userField['id'];
          if ($userField['type'] == CustomFields::TYPE_TEXT) {
            // Add one join for each text field.
            $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = ei.user_id and $ecfTable.field_id = ".$userField['id'].")";
          } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
            $cfoTable = 'cfo'.$userField['id'];
            // Add two joins for each dropdown field.
            $left_joins .= " left join tt_entity_custom_fields $ecfTable on ($ecfTable.entity_type = $entity_type and $ecfTable.entity_id = ei.user_id and $ecfTable.field_id = ".$userField['id'].")";
            $left_joins .= " left join tt_custom_field_options $cfoTable on ($cfoTable.field_id = $ecfTable.field_id and $cfoTable.id = $ecfTable.option_id)";
          }
        }
      }
    }

    return $left_joins;
  }

  // grouping determines if we are grouping the report by either group_by1,
  // group_by2, or group_by3 values passed in $options.
  static function grouping($options) {
    $grouping = ($options['group_by1'] != null && $options['group_by1'] != 'no_grouping') ||
      ($options['group_by2'] != null && $options['group_by2'] != 'no_grouping') ||
      ($options['group_by3'] != null && $options['group_by3'] != 'no_grouping');
    return $grouping;
  }

  // groupingBy determines if we are grouping a report by a value of $what
  // ('date', 'user', 'project', etc.) by checking group_by1, group_by2,
  // and group_by3 values passed in $options.
  static function groupingBy($what, $options) {
    $grouping_by1 = isset($options['group_by1']) && $options['group_by1'] == $what;
    $grouping_by2 = isset($options['group_by2']) && $options['group_by2'] == $what;
    $grouping_by3 = isset($options['group_by3']) && $options['group_by3'] == $what;
    $grouping = $grouping_by1 || $grouping_by2 || $grouping_by3;
    return $grouping;
  }

  // makeGroupByHeaderdPart is a helper function for makeGroupByHeader.
  // It obtains a part of the header associated with a single group by dropdown.
  static function makeGroupByHeaderPart($dropdown_value) {
    global $i18n;
    global $custom_fields;

    // First, try to get a label from a translation file, which is the most likely scenario
    // such as grouping by date, user, project, or task.
    if (!ttStartsWith($dropdown_value, 'time_field_') && !ttStartsWith($dropdown_value, 'user_field_')) {
      $key = 'label.'.$dropdown_value;
      $part = $i18n->get($key);
      if ($part) return $part;
    }

    // If label is not found in translation file, we may be grouping by a custom field.
    // Obtain custom field label if so.

    // Process time custom fields.
    if ($custom_fields && $custom_fields->timeFields) {
      foreach ($custom_fields->timeFields as $timeField) {
        $field_name = 'time_field_'.$timeField['id'];
        if ($dropdown_value == $field_name) {
          return $timeField['label'];
        }
      }
    }
    // Process user custom fields.
    if ($custom_fields && $custom_fields->userFields) {
      foreach ($custom_fields->userFields as $userField) {
        $field_name = 'user_field_'.$userField['id'];
        if ($dropdown_value == $field_name) {
          return $userField['label'];
        }
      }
    }

    // Return null if nothing is found.
    return null;
  }

  // makeGroupByHeader builds a column header for a totals-only report
  // or a timesheet using group_by1, group_by2, and group_by3 values passed in $options.
  static function makeGroupByHeader($options) {
    $no_grouping = ($options['group_by1'] == null || $options['group_by1'] == 'no_grouping') &&
      ($options['group_by2'] == null || $options['group_by2'] == 'no_grouping') &&
      ($options['group_by3'] == null || $options['group_by3'] == 'no_grouping');
    if ($no_grouping) return null;

    $group_by_header = '';
    if (isset($options['group_by1']) && $options['group_by1'] != 'no_grouping') {
      // We have group_by1.
      $group_by1 = $options['group_by1'];
      $group_by_header .= ' - '.ttReportHelper::makeGroupByHeaderPart($group_by1);
    }
    if (isset($options['group_by2']) && $options['group_by2'] != 'no_grouping') {
      // We have group_by2.
      $group_by2 = $options['group_by2'];
      $group_by_header .= ' - '.ttReportHelper::makeGroupByHeaderPart($group_by2);
    }
    if (isset($options['group_by3']) && $options['group_by3'] != 'no_grouping') {
      // We have group_by3.
      $group_by3 = $options['group_by3'];
      $group_by_header .= ' - '.ttReportHelper::makeGroupByHeaderPart($group_by3);
    }
    $group_by_header = ltrim($group_by_header, ' -');
    return $group_by_header;
  }

  // makeGroupByXmlTag creates an xml tag for a totals only report using group_by1,
  // group_by2, and group_by3 values passed in $options.
  static function makeGroupByXmlTag($options) {
    $tag = '';
    if ($options['group_by1'] != null && $options['group_by1'] != 'no_grouping') {
      // We have group_by1.
      $tag .= '_'.$options['group_by1'];
    }
    if ($options['group_by2'] != null && $options['group_by2'] != 'no_grouping') {
      // We have group_by2.
      $tag .= '_'.$options['group_by2'];
    }
    if ($options['group_by3'] != null && $options['group_by3'] != 'no_grouping') {
      // We have group_by3.
      $tag .= '_'.$options['group_by3'];
    }
    $tag = ltrim($tag, '_');
    return $tag;
  }

  // makeGroupByLabel builds a label for one row in a "Totals only" report of grouped by items.
  // It does one thing: if we are grouping by date, the date format is converted for user.
  static function makeGroupByLabel($key, $options) {
    if (!ttReportHelper::groupingBy('date', $options))
      return $key; // No need to format.

    global $user;
    if ($user->getDateFormat() == DB_DATEFORMAT)
      return $key; // No need to format.

    $label = $key;
    if (preg_match('/\d\d\d\d-\d\d-\d\d/', $key, $matches)) {
      // Replace the first found match of a date in DB_DATEFORMAT.
      // This is not entirely clean but better than nothing for a label in a row.
      $userDate = ttDateToUserFormat($matches[0]);
      $label = str_replace($matches[0], $userDate, $key);
    }
    return $label;
  }
}
