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

import('ttClientHelper');
import('DateAndTime');
import('Period');
import('ttTimeHelper');

require_once(dirname(__FILE__).'/../../plugins/CustomFields.class.php');

// Class ttReportHelper is used for help with reports.
class ttReportHelper {

  // getWhere prepares a WHERE clause for a report query.
  static function getWhere($options) {
    global $user;

    // Prepare dropdown parts.
    $dropdown_parts = '';
    if ($options['client_id'])
      $dropdown_parts .= ' and l.client_id = '.$options['client_id'];
    elseif ($user->isClient() && $user->client_id)
      $dropdown_parts .= ' and l.client_id = '.$user->client_id;
    if ($options['cf_1_option_id']) $dropdown_parts .= ' and l.id in(select log_id from tt_custom_field_log where status = 1 and option_id = '.$options['cf_1_option_id'].')';
    if ($options['project_id']) $dropdown_parts .= ' and l.project_id = '.$options['project_id'];
    if ($options['task_id']) $dropdown_parts .= ' and l.task_id = '.$options['task_id'];
    if ($options['billable']=='1') $dropdown_parts .= ' and l.billable = 1';
    if ($options['billable']=='2') $dropdown_parts .= ' and l.billable = 0';
    if ($options['invoice']=='1') $dropdown_parts .= ' and l.invoice_id is not NULL';
    if ($options['invoice']=='2') $dropdown_parts .= ' and l.invoice_id is NULL';
    if ($options['paid_status']=='1') $dropdown_parts .= ' and l.paid = 1';
    if ($options['paid_status']=='2') $dropdown_parts .= ' and l.paid = 0';

    // Prepare sql query part for user list.
    $userlist = $options['users'] ? $options['users'] : '-1';
    if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient())
      $user_list_part = " and l.user_id in ($userlist)";
    else
      $user_list_part = " and l.user_id = ".$user->id;
    $user_list_part .= " and l.group_id = ".$user->getActiveGroup();

    // Prepare sql query part for where.
    if ($options['period'])
      $period = new Period($options['period'], new DateAndTime($user->date_format));
    else {
      $period = new Period();
      $period->setPeriod(
        new DateAndTime($user->date_format, $options['period_start']),
        new DateAndTime($user->date_format, $options['period_end']));
    }
    $where = " where l.status = 1 and l.date >= '".$period->getStartDate(DB_DATEFORMAT)."' and l.date <= '".$period->getEndDate(DB_DATEFORMAT)."'".
      " $user_list_part $dropdown_parts";
    return $where;
  }

  // getExpenseWhere prepares WHERE clause for expenses query in a report.
  static function getExpenseWhere($options) {
    global $user;

    // Prepare dropdown parts.
    $dropdown_parts = '';
    if ($options['client_id'])
      $dropdown_parts .= ' and ei.client_id = '.$options['client_id'];
    elseif ($user->isClient() && $user->client_id)
      $dropdown_parts .= ' and ei.client_id = '.$user->client_id;
    if ($options['project_id']) $dropdown_parts .= ' and ei.project_id = '.$options['project_id'];
    if ($options['invoice']=='1') $dropdown_parts .= ' and ei.invoice_id is not NULL';
    if ($options['invoice']=='2') $dropdown_parts .= ' and ei.invoice_id is NULL';
    if ($options['paid_status']=='1') $dropdown_parts .= ' and ei.paid = 1';
    if ($options['paid_status']=='2') $dropdown_parts .= ' and ei.paid = 0';

    // Prepare sql query part for user list.
    $userlist = $options['users'] ? $options['users'] : '-1';
    if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient())
      $user_list_part = " and ei.user_id in ($userlist)";
    else
      $user_list_part = " and ei.user_id = ".$user->id;
    $user_list_part .= " and ei.group_id = ".$user->getActiveGroup();

    // Prepare sql query part for where.
    if ($options['period'])
      $period = new Period($options['period'], new DateAndTime($user->date_format));
    else {
      $period = new Period();
      $period->setPeriod(
        new DateAndTime($user->date_format, $options['period_start']),
        new DateAndTime($user->date_format, $options['period_end']));
    }
    $where = " where ei.status = 1 and ei.date >= '".$period->getStartDate(DB_DATEFORMAT)."' and ei.date <= '".$period->getEndDate(DB_DATEFORMAT)."'".
      " $user_list_part $dropdown_parts";
    return $where;
  }

  // getItems retrieves all items associated with a report.
  // It combines tt_log and tt_expense_items in one array for presentation in one table using mysql union all.
  // Expense items use the "note" field for item name.
  static function getItems($options) {
    global $user;
    $mdb2 = getConnection();

    // Determine these once as they are used in multiple places in this function.
    $canViewReports = $user->can('view_reports') || $user->can('view_all_reports');
    $isClient = $user->isClient();

    $group_by_option = $options['group_by'];
    $convertTo12Hour = ('%I:%M %p' == $user->time_format) && ($options['show_start'] || $options['show_end']);

    // Prepare a query for time items in tt_log table.
    $fields = array(); // An array of fields for database query.
    array_push($fields, 'l.id as id');
    array_push($fields, '1 as type'); // Type 1 is for tt_log entries.
    array_push($fields, 'l.date as date');
    if($canViewReports || $isClient)
      array_push($fields, 'u.name as user');
    // Add client name if it is selected.
    if ($options['show_client'] || 'client' == $group_by_option)
      array_push($fields, 'c.name as client');
    // Add project name if it is selected.
    if ($options['show_project'] || 'project' == $group_by_option)
      array_push($fields, 'p.name as project');
    // Add task name if it is selected.
    if ($options['show_task'] || 'task' == $group_by_option)
      array_push($fields, 't.name as task');
    // Add custom field.
    $include_cf_1 = $options['show_custom_field_1'] || 'cf_1' == $group_by_option;
    if ($include_cf_1) {
      $custom_fields = new CustomFields($user->group_id);
      $cf_1_type = $custom_fields->fields[0]['type'];
      if ($cf_1_type == CustomFields::TYPE_TEXT) {
        array_push($fields, 'cfl.value as cf_1');
      } elseif ($cf_1_type == CustomFields::TYPE_DROPDOWN) {
        array_push($fields, 'cfo.value as cf_1');
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
      if ($user->unit_totals_only)
        array_push($fields, "null as units");
      else
        array_push($fields, "if(l.billable = 0 or time_to_sec(l.duration)/60 < $user->first_unit_threshold, 0, ceil(time_to_sec(l.duration)/60/$user->minutes_in_unit)) as units");
    }
    // Add note.
    if ($options['show_note'])
      array_push($fields, 'l.comment as note');
    // Handle cost.
    $includeCost = $options['show_cost'];
    if ($includeCost) {
      if (MODE_TIME == $user->tracking_mode)
        array_push($fields, "cast(l.billable * coalesce(u.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2)) as cost");   // Use default user rate.
      else
        array_push($fields, "cast(l.billable * coalesce(upb.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2)) as cost"); // Use project rate for user.
      array_push($fields, "null as expense"); 
    }
    // Add paid status.
    if ($canViewReports && $options['show_paid'])
      array_push($fields, 'l.paid as paid');
    // Add IP address.
    if ($canViewReports && $options['show_ip']) {
      array_push($fields, 'l.created as created');
      array_push($fields, 'l.created_ip as created_ip');
      array_push($fields, 'l.modified as modified');
      array_push($fields, 'l.modified_ip as modified_ip');
    }
    // Add invoice name if it is selected.
    if (($canViewReports || $isClient) && $options['show_invoice'])
      array_push($fields, 'i.name as invoice');

    // Prepare sql query part for left joins.
    $left_joins = null;
    if ($options['show_client'] || 'client' == $group_by_option)
      $left_joins .= " left join tt_clients c on (c.id = l.client_id)";
    if (($canViewReports || $isClient) && $options['show_invoice'])
      $left_joins .= " left join tt_invoices i on (i.id = l.invoice_id and i.status = 1)";
    if ($canViewReports || $isClient || $user->isPluginEnabled('ex'))
       $left_joins .= " left join tt_users u on (u.id = l.user_id)";
    if ($options['show_project'] || 'project' == $group_by_option)
      $left_joins .= " left join tt_projects p on (p.id = l.project_id)";
    if ($options['show_task'] || 'task' == $group_by_option)
      $left_joins .= " left join tt_tasks t on (t.id = l.task_id)";
    if ($include_cf_1) {
      if ($cf_1_type == CustomFields::TYPE_TEXT)
        $left_joins .= " left join tt_custom_field_log cfl on (l.id = cfl.log_id and cfl.status = 1)";
      elseif ($cf_1_type == CustomFields::TYPE_DROPDOWN) {
        $left_joins .=  " left join tt_custom_field_log cfl on (l.id = cfl.log_id and cfl.status = 1)".
          " left join tt_custom_field_options cfo on (cfl.option_id = cfo.id)";
      }
    }
    if ($includeCost && MODE_TIME != $user->tracking_mode)
      $left_joins .= " left join tt_user_project_binds upb on (l.user_id = upb.user_id and l.project_id = upb.project_id)";

    $where = ttReportHelper::getWhere($options);

    // Construct sql query for tt_log items.
    $sql = "select ".join(', ', $fields)." from tt_log l $left_joins $where";
    // If we don't have expense items (such as when the Expenses plugin is desabled), the above is all sql we need,
    // with an exception of sorting part, that is added in the end.

    // However, when we have expenses, we need to do a union with a separate query for expense items from tt_expense_items table.
    if ($options['show_cost'] && $user->isPluginEnabled('ex')) { // if ex(penses) plugin is enabled

      $fields = array(); // An array of fields for database query.
      array_push($fields, 'ei.id');
      array_push($fields, '2 as type'); // Type 2 is for tt_expense_items entries.
      array_push($fields, 'ei.date');
      if($canViewReports || $isClient)
        array_push($fields, 'u.name as user');
      // Add client name if it is selected.
      if ($options['show_client'] || 'client' == $group_by_option)
        array_push($fields, 'c.name as client');
      // Add project name if it is selected.
      if ($options['show_project'] || 'project' == $group_by_option)
        array_push($fields, 'p.name as project');
      if ($options['show_task'] || 'task' == $group_by_option)
        array_push($fields, 'null'); // null for task name. We need to match column count for union.
      if ($options['show_custom_field_1'] || 'cf_1' == $group_by_option)
        array_push($fields, 'null'); // null for cf_1.
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
      // Add paid status.
      if ($canViewReports && $options['show_paid'])
        array_push($fields, 'ei.paid as paid');
      // Add IP address.
      if ($canViewReports && $options['show_ip']) {
        array_push($fields, 'ei.created as created');
        array_push($fields, 'ei.created_ip as created_ip');
        array_push($fields, 'ei.modified as modified');
        array_push($fields, 'ei.modified_ip as modified_ip');
      }
      // Add invoice name if it is selected.
      if (($canViewReports || $isClient) && $options['show_invoice'])
        array_push($fields, 'i.name as invoice');

      // Prepare sql query part for left joins.
      $left_joins = null;
      if ($canViewReports || $isClient)
        $left_joins .= " left join tt_users u on (u.id = ei.user_id)";
      if ($options['show_client'] || 'client' == $group_by_option)
        $left_joins .= " left join tt_clients c on (c.id = ei.client_id)";
      if ($options['show_project'] || 'project' == $group_by_option)
        $left_joins .= " left join tt_projects p on (p.id = ei.project_id)";
      if (($canViewReports || $isClient) && $options['show_invoice'])
        $left_joins .= " left join tt_invoices i on (i.id = ei.invoice_id and i.status = 1)";

      $where = ttReportHelper::getExpenseWhere($options);

      // Construct sql query for expense items.
      $sql_for_expense_items = "select ".join(', ', $fields)." from tt_expense_items ei $left_joins $where";

      // Construct a union.
      $sql = "($sql) union all ($sql_for_expense_items)";
    }

    // Determine sort part.
    $sort_part = ' order by ';
    if ($group_by_option == null || 'no_grouping' == $group_by_option || 'date' == $group_by_option)
      $sort_part .= 'date';
    else
      $sort_part .= $group_by_option.', date';
    if (($canViewReports || $isClient) && $options['users'] && 'user' != $group_by_option)
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
        if ('.' != $user->decimal_mark)
          $val['cost'] = str_replace('.', $user->decimal_mark, $val['cost']);
      }
      if (isset($val['expense'])) {
        if ('.' != $user->decimal_mark)
          $val['expense'] = str_replace('.', $user->decimal_mark, $val['expense']);
      }
      if ('no_grouping' != $group_by_option) {
        $val['grouped_by'] = $val[$group_by_option];
        if ('date' == $group_by_option) {
          // This is needed to get the date in user date format.
          $o_date = new DateAndTime(DB_DATEFORMAT, $val['grouped_by']);
          $val['grouped_by'] = $o_date->toString($user->date_format);
          unset($o_date);
        }
      }

      // This is needed to get the date in user date format.
      $o_date = new DateAndTime(DB_DATEFORMAT, $val['date']);
      $val['date'] = $o_date->toString($user->date_format);
      unset($o_date);

      $row = $val;
      $report_items[] = $row;
    }

    return $report_items;
  }

  // putInSession stores tt_log and tt_expense_items ids from a report in user session
  // as 2 comma-separated lists.
  static function putInSession($report_items) {
    unset($_SESSION['report_item_ids']);
    unset($_SESSION['report_item_expense_ids']);

    // Iterate through records and build 2 comma-separated lists.
    foreach($report_items as $item) {
      if ($item['type'] == 1)
        $report_item_ids .= ','.$item['id'];
      else if ($item['type'] == 2)
         $report_item_expense_ids .= ','.$item['id'];
    }
    $report_item_ids = trim($report_item_ids, ',');
    $report_item_expense_ids = trim($report_item_expense_ids, ',');

    // The lists are reqdy. Put them in session.
    if ($report_item_ids) $_SESSION['report_item_ids'] = $report_item_ids;
    if ($report_item_expense_ids) $_SESSION['report_item_expense_ids'] = $report_item_expense_ids;
  }

  // getFromSession obtains tt_log and tt_expense_items ids stored in user session.
  static function getFromSession() {
    $items = array();
    $report_item_ids = $_SESSION['report_item_ids'];
    if ($report_item_ids)
      $items['report_item_ids'] = explode(',', $report_item_ids);
    $report_item_expense_ids = $_SESSION['report_item_expense_ids'];
    if ($report_item_expense_ids)
      $items['report_item_expense_ids'] = explode(',', $report_item_expense_ids);
    return $items;
  }

  // getSubtotals calculates report items subtotals when a report is grouped by.
  // Without expenses, it's a simple select with group by.
  // With expenses, it becomes a select with group by from a combined set of records obtained with "union all".
  static function getSubtotals($options) {
    global $user;

    $group_by_option = $options['group_by'];
    if ('no_grouping' == $group_by_option) return null;

    $mdb2 = getConnection();

    // Start with sql to obtain subtotals for time items. This simple sql will be used when we have no expenses.

    // Determine group by field and a required join.
    switch ($group_by_option) {
      case 'date':
        $group_field = 'l.date';
        $group_join = '';
        break;
      case 'user':
        $group_field = 'u.name';
        $group_join = 'left join tt_users u on (l.user_id = u.id) ';
        break;
      case 'client':
        $group_field = 'c.name';
        $group_join = 'left join tt_clients c on (l.client_id = c.id) ';
        break;
      case 'project':
        $group_field = 'p.name';
        $group_join = 'left join tt_projects p on (l.project_id = p.id) ';
        break;
      case 'task':
        $group_field = 't.name';
        $group_join = 'left join tt_tasks t on (l.task_id = t.id) ';
        break;
      case 'cf_1':
        $group_field = 'cfo.value';
        $custom_fields = new CustomFields($user->group_id);
        if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
          $group_join = 'left join tt_custom_field_log cfl on (l.id = cfl.log_id and cfl.status = 1) left join tt_custom_field_options cfo on (cfl.value = cfo.id) ';
        elseif ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
          $group_join = 'left join tt_custom_field_log cfl on (l.id = cfl.log_id and cfl.status = 1) left join tt_custom_field_options cfo on (cfl.option_id = cfo.id) ';
        break;
    }

    $where = ttReportHelper::getWhere($options);
    if ($options['show_cost']) {
      if (MODE_TIME == $user->tracking_mode) {
        if ($group_by_option != 'user')
          $left_join = 'left join tt_users u on (l.user_id = u.id)';
        $sql = "select $group_field as group_field, sum(time_to_sec(l.duration)) as time";
        if ($options['show_work_units']) {
          if ($user->unit_totals_only)
            $sql .= ", if (sum(l.billable * time_to_sec(l.duration)/60) < $user->first_unit_threshold, 0, ceil(sum(l.billable * time_to_sec(l.duration)/60/$user->minutes_in_unit))) as units";
          else
            $sql .= ", sum(if(l.billable = 0 or time_to_sec(l.duration)/60 < $user->first_unit_threshold, 0, ceil(time_to_sec(l.duration)/60/$user->minutes_in_unit))) as units";
        }
        $sql .= ", sum(cast(l.billable * coalesce(u.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10, 2))) as cost,
          null as expenses from tt_log l
          $group_join $left_join $where group by $group_field";
      } else {
        // If we are including cost and tracking projects, our query (the same as above) needs to join the tt_user_project_binds table.
        $sql = "select $group_field as group_field, sum(time_to_sec(l.duration)) as time";
        if ($options['show_work_units']) {
          if ($user->unit_totals_only)
            $sql .= ", if (sum(l.billable * time_to_sec(l.duration)/60) < $user->first_unit_threshold, 0, ceil(sum(l.billable * time_to_sec(l.duration)/60/$user->minutes_in_unit))) as units";
          else
            $sql .= ", sum(if(l.billable = 0 or time_to_sec(l.duration)/60 < $user->first_unit_threshold, 0, ceil(time_to_sec(l.duration)/60/$user->minutes_in_unit))) as units";
        }
        $sql .= ", sum(cast(l.billable * coalesce(upb.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2))) as cost,
          null as expenses from tt_log l 
          $group_join
          left join tt_user_project_binds upb on (l.user_id = upb.user_id and l.project_id = upb.project_id) $where group by $group_field";
      }
    } else {
      $sql = "select $group_field as group_field, sum(time_to_sec(l.duration)) as time";
      if ($options['show_work_units']) {
        if ($user->unit_totals_only)
          $sql .= ", if (sum(l.billable * time_to_sec(l.duration)/60) < $user->first_unit_threshold, 0, ceil(sum(l.billable * time_to_sec(l.duration)/60/$user->minutes_in_unit))) as units";
        else
          $sql .= ", sum(if(l.billable = 0 or time_to_sec(l.duration)/60 < $user->first_unit_threshold, 0, ceil(time_to_sec(l.duration)/60/$user->minutes_in_unit))) as units";
      }
      $sql .= ", null as expenses from tt_log l 
        $group_join $where group by $group_field";
    }
    // By now we have sql for time items.

    // However, when we have expenses, we need to do a union with a separate query for expense items from tt_expense_items table.
    if ($options['show_cost'] && $user->isPluginEnabled('ex')) { // if ex(penses) plugin is enabled

      // Determine group by field and a required join.
      $group_join = null;
      $group_field = 'null';
      switch ($group_by_option) {
        case 'date':
          $group_field = 'ei.date';
          $group_join = '';
          break;
        case 'user':
          $group_field = 'u.name';
          $group_join = 'left join tt_users u on (ei.user_id = u.id) ';
          break;
        case 'client':
          $group_field = 'c.name';
          $group_join = 'left join tt_clients c on (ei.client_id = c.id) ';
          break;
        case 'project':
          $group_field = 'p.name';
          $group_join = 'left join tt_projects p on (ei.project_id = p.id) ';
          break;
      }

      $where = ttReportHelper::getExpenseWhere($options);
      $sql_for_expenses = "select $group_field as group_field, null as time";
      if ($options['show_work_units']) $sql_for_expenses .= ", null as units";
      $sql_for_expenses .= ", sum(ei.cost) as cost, sum(ei.cost) as expenses from tt_expense_items ei $group_join $where";
      // Add a "group by" clause if we are grouping.
      if ('null' != $group_field) $sql_for_expenses .= " group by $group_field";

      // Create a combined query.
      $combined = "select group_field, sum(time) as time";
      if ($options['show_work_units']) $combined .= ", sum(units) as units";
      $combined .= ", sum(cost) as cost, sum(expenses) as expenses from (($sql) union all ($sql_for_expenses)) t group by group_field";
      $sql = $combined;
    }

    // Execute query.
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) die($res->getMessage());

    while ($val = $res->fetchRow()) {
      if ('date' == $group_by_option) {
        // This is needed to get the date in user date format.
        $o_date = new DateAndTime(DB_DATEFORMAT, $val['group_field']);
        $val['group_field'] = $o_date->toString($user->date_format);
        unset($o_date);
      }
      $time = $val['time'] ? sec_to_time_fmt_hm($val['time']) : null;
      if ($options['show_cost']) {
        if ('.' != $user->decimal_mark) {
          $val['cost'] = str_replace('.', $user->decimal_mark, $val['cost']);
          $val['expenses'] = str_replace('.', $user->decimal_mark, $val['expenses']);
        }
        $subtotals[$val['group_field']] = array('name'=>$val['group_field'],'time'=>$time, 'units'=> $val['units'], 'cost'=>$val['cost'],'expenses'=>$val['expenses']);
      } else
        $subtotals[$val['group_field']] = array('name'=>$val['group_field'],'time'=>$time, 'units'=> $val['units']);
    }

    return $subtotals;
  }

  // getTotals calculates total hours and cost for all report items.
  static function getTotals($options)
  {
    global $user;

    $mdb2 = getConnection();

    $where = ttReportHelper::getWhere($options);

    // Prepare parts.
    $time_part = "sum(time_to_sec(l.duration)) as time";
    if ($options['show_work_units']) {
      $units_part = $user->unit_totals_only ? ", null as units" : ", sum(if(l.billable = 0 or time_to_sec(l.duration)/60 < $user->first_unit_threshold, 0, ceil(time_to_sec(l.duration)/60/$user->minutes_in_unit))) as units";
    }
    if ($options['show_cost']) {
      if (MODE_TIME == $user->tracking_mode)
        $cost_part = ", sum(cast(l.billable * coalesce(u.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2))) as cost, null as expenses";
      else
        $cost_part = ", sum(cast(l.billable * coalesce(upb.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10,2))) as cost, null as expenses";
    } else {
      $cost_part = ", null as cost, null as expenses";
    }
    if ($options['show_cost']) {
      if (MODE_TIME == $user->tracking_mode) {
        $left_joins = "left join tt_users u on (l.user_id = u.id)";
      } else {
        $left_joins = "left join tt_user_project_binds upb on (l.user_id = upb.user_id and l.project_id = upb.project_id)";
      }
    }
    // Prepare a query for time items.
    $sql = "select $time_part $units_part $cost_part from tt_log l $left_joins $where";

    // If we have expenses, query becomes a bit more complex.
    if ($options['show_cost'] && $user->isPluginEnabled('ex')) {
      $where = ttReportHelper::getExpenseWhere($options);
      $sql_for_expenses = "select null as time";
      if ($options['show_work_units']) $sql_for_expenses .= ", null as units";
      $sql_for_expenses .= ", sum(cost) as cost, sum(cost) as expenses from tt_expense_items ei $where";

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
    $total_time = $val['time'] ? sec_to_time_fmt_hm($val['time']) : null;
    if ($options['show_cost']) {
      $total_cost = $val['cost'];
      if (!$total_cost) $total_cost = '0.00';
      if ('.' != $user->decimal_mark)
        $total_cost = str_replace('.', $user->decimal_mark, $total_cost);
      $total_expenses = $val['expenses'];
      if (!$total_expenses) $total_expenses = '0.00';
      if ('.' != $user->decimal_mark)
        $total_expenses = str_replace('.', $user->decimal_mark, $total_expenses);
    }

    if ($options['period'])
      $period = new Period($options['period'], new DateAndTime($user->date_format));
    else {
      $period = new Period();
      $period->setPeriod(
        new DateAndTime($user->date_format, $options['period_start']),
        new DateAndTime($user->date_format, $options['period_end']));
    }

    $totals['start_date'] = $period->getStartDate();
    $totals['end_date'] = $period->getEndDate();
    $totals['time'] = $total_time;
    $totals['units'] = $val['units'];
    $totals['cost'] = $total_cost;
    $totals['expenses'] = $total_expenses;

    return $totals;
  }

  // The assignToInvoice assigns a set of records to a specific invoice.
  static function assignToInvoice($invoice_id, $time_log_ids, $expense_item_ids)
  {
    $mdb2 = getConnection();
    if ($time_log_ids) {
      $sql = "update tt_log set invoice_id = ".$mdb2->quote($invoice_id).
        " where id in(".join(', ', $time_log_ids).")";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
    if ($expense_item_ids) {
      $sql = "update tt_expense_items set invoice_id = ".$mdb2->quote($invoice_id).
        " where id in(".join(', ', $expense_item_ids).")";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
  }

  // The markPaid marks a set of records as either paid or unpaid.
  static function markPaid($time_log_ids, $expense_item_ids, $paid = true)
  {
    $mdb2 = getConnection();
    $paid_val = (int) $paid;
    if ($time_log_ids) {
      $sql = "update tt_log set paid = $paid_val where id in(".join(', ', $time_log_ids).")";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
    if ($expense_item_ids) {
      $sql = "update tt_expense_items set paid = $paid_val where id in(".join(', ', $expense_item_ids).")";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());
    }
  }

  // prepareReportBody - prepares an email body for report.
  static function prepareReportBody($bean, $options, $comment)
  {
    global $user;
    global $i18n;

    // Determine these once as they are used in multiple places in this function.
    $canViewReports = $user->can('view_reports') || $user->can('view_all_reports');
    $isClient = $user->isClient();

    $items = ttReportHelper::getItems($options);
    $group_by = $options['group_by'];
    if ($group_by && 'no_grouping' != $group_by)
      $subtotals = ttReportHelper::getSubtotals($options);
    $totals = ttReportHelper::getTotals($options);

    // Use custom fields plugin if it is enabled.
    if ($user->isPluginEnabled('cf'))
      $custom_fields = new CustomFields($user->group_id);

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

      // Determine group_by header.
      if ('cf_1' == $group_by)
        $group_by_header = htmlspecialchars($custom_fields->fields[0]['label']);
      else {
        $key = 'label.'.$group_by;
        $group_by_header = $i18n->get($key);
      }

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

// TODO: refactoring ongoing down from here...




      // Print totals.
      $body .= '<tr><td>&nbsp;</td></tr>';
      $body .= '<tr style="'.$rowSubtotal.'">';
      $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$i18n->get('label.total').'</td>';
      if ($bean->getAttribute('chduration')) {
        $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
        if ($totals['time'] <> '0:00') $body .= $totals['time'];
        $body .= '</td>';
      }
      if ($bean->getAttribute('chunits')) {
        $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
        $body .= $totals['units'];
        $body .= '</td>';
      }
      if ($bean->getAttribute('chcost')) {
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
      if ($bean->getAttribute('chclient'))
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.client').'</td>';
      if ($bean->getAttribute('chproject'))
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.project').'</td>';
      if ($bean->getAttribute('chtask'))
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.task').'</td>';
      if ($bean->getAttribute('chcf_1'))
        $body .= '<td style="'.$tableHeader.'">'.htmlspecialchars($custom_fields->fields[0]['label']).'</td>';
      if ($bean->getAttribute('chstart'))
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.start').'</td>';
      if ($bean->getAttribute('chfinish'))
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.finish').'</td>';
      if ($bean->getAttribute('chduration'))
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.duration').'</td>';
      if ($bean->getAttribute('chunits'))
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.work_units_short').'</td>';
      if ($bean->getAttribute('chnote'))
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.note').'</td>';
      if ($bean->getAttribute('chcost'))
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.cost').'</td>';
      if ($bean->getAttribute('chpaid'))
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.paid').'</td>';
      if ($bean->getAttribute('chip'))
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.ip').'</td>';
      if ($bean->getAttribute('chinvoice'))
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.invoice').'</td>';
      $body .= '</tr>';

      // Initialize variables to print subtotals.
      if ($items && 'no_grouping' != $group_by) {
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
              if ($canViewReports || $isClient) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'user' ? $subtotal_name : '').'</td>';
              if ($bean->getAttribute('chclient')) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'client' ? $subtotal_name : '').'</td>';
              if ($bean->getAttribute('chproject')) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'project' ? $subtotal_name : '').'</td>';
              if ($bean->getAttribute('chtask')) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'task' ? $subtotal_name : '').'</td>';
              if ($bean->getAttribute('chcf_1')) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'cf_1' ? $subtotal_name : '').'</td>';
              if ($bean->getAttribute('chstart')) $body .= '<td></td>';
              if ($bean->getAttribute('chfinish')) $body .= '<td></td>';
              if ($bean->getAttribute('chduration')) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['time'].'</td>';
              if ($bean->getAttribute('chunits')) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['units'].'</td>';
              if ($bean->getAttribute('chnote')) $body .= '<td></td>';
              if ($bean->getAttribute('chcost')) {
                $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
                $body .= ($canViewReports || $isClient) ? $subtotals[$prev_grouped_by]['cost'] : $subtotals[$prev_grouped_by]['expenses'];
                $body .= '</td>';
              }
              if ($bean->getAttribute('chpaid')) $body .= '<td></td>';
              if ($bean->getAttribute('chip')) $body .= '<td></td>';
              if ($bean->getAttribute('chinvoice')) $body .= '<td></td>';
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
          if ($bean->getAttribute('chclient'))
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['client']).'</td>';
          if ($bean->getAttribute('chproject'))
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['project']).'</td>';
          if ($bean->getAttribute('chtask'))
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['task']).'</td>';
          if ($bean->getAttribute('chcf_1'))
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['cf_1']).'</td>';
          if ($bean->getAttribute('chstart'))
            $body .= '<td nowrap style="'.$cellRightAligned.'">'.$record['start'].'</td>';
          if ($bean->getAttribute('chfinish'))
            $body .= '<td nowrap style="'.$cellRightAligned.'">'.$record['finish'].'</td>';
          if ($bean->getAttribute('chduration'))
            $body .= '<td style="'.$cellRightAligned.'">'.$record['duration'].'</td>';
          if ($bean->getAttribute('chunits'))
            $body .= '<td style="'.$cellRightAligned.'">'.$record['units'].'</td>';
          if ($bean->getAttribute('chnote'))
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['note']).'</td>';
          if ($bean->getAttribute('chcost'))
            $body .= '<td style="'.$cellRightAligned.'">'.$record['cost'].'</td>';
          if ($bean->getAttribute('chpaid')) {
            $body .= '<td style="'.$cellRightAligned.'">';
            $body .= $record['paid'] == 1 ? $i18n->get('label.yes') : $i18n->get('label.no');
            $body .= '</td>';
          }
          if ($bean->getAttribute('chip')) {
            $body .= '<td style="'.$cellRightAligned.'">';
            $body .= $record['modified'] ? $record['modified_ip'].' '.$record['modified'] : $record['created_ip'].' '.$record['created'];
            $body .= '</td>';
          }
          if ($bean->getAttribute('chinvoice'))
            $body .= '<td style="'.$cellRightAligned.'">'.htmlspecialchars($record['invoice']).'</td>';
          $body .= '</tr>';

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
        if ($canViewReports || $isClient) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'user' ? $subtotal_name : '').'</td>';
        if ($bean->getAttribute('chclient')) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'client' ? $subtotal_name : '').'</td>';
        if ($bean->getAttribute('chproject')) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'project' ? $subtotal_name : '').'</td>';
        if ($bean->getAttribute('chtask')) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'task' ? $subtotal_name : '').'</td>';
        if ($bean->getAttribute('chcf_1')) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'cf_1' ? $subtotal_name : '').'</td>';
        if ($bean->getAttribute('chstart')) $body .= '<td></td>';
        if ($bean->getAttribute('chfinish')) $body .= '<td></td>';
        if ($bean->getAttribute('chduration')) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$cur_grouped_by]['time'].'</td>';
        if ($bean->getAttribute('chunits')) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$cur_grouped_by]['units'].'</td>';
        if ($bean->getAttribute('chnote')) $body .= '<td></td>';
        if ($bean->getAttribute('chcost')) {
          $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
          $body .= ($canViewReports || $isClient) ? $subtotals[$cur_grouped_by]['cost'] : $subtotals[$cur_grouped_by]['expenses'];
          $body .= '</td>';
        }
        if ($bean->getAttribute('chpaid')) $body .= '<td></td>';
        if ($bean->getAttribute('chip')) $body .= '<td></td>';
        if ($bean->getAttribute('chinvoice')) $body .= '<td></td>';
        $body .= '</tr>';
      }

      // Print totals.
      $body .= '<tr><td>&nbsp;</td></tr>';
      $body .= '<tr style="'.$rowSubtotal.'">';
      $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$i18n->get('label.total').'</td>';
      if ($canViewReports || $isClient) $body .= '<td></td>';
      if ($bean->getAttribute('chclient')) $body .= '<td></td>';
      if ($bean->getAttribute('chproject')) $body .= '<td></td>';
      if ($bean->getAttribute('chtask')) $body .= '<td></td>';
      if ($bean->getAttribute('chcf_1')) $body .= '<td></td>';
      if ($bean->getAttribute('chstart')) $body .= '<td></td>';
      if ($bean->getAttribute('chfinish')) $body .= '<td></td>';
      if ($bean->getAttribute('chduration')) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$totals['time'].'</td>';
      if ($bean->getAttribute('chunits')) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$totals['units'].'</td>';
      if ($bean->getAttribute('chnote')) $body .= '<td></td>';
      if ($bean->getAttribute('chcost')) {
        $body .= '<td nowrap style="'.$cellRightAlignedSubtotal.'">'.htmlspecialchars($user->currency).' ';
        $body .= ($canViewReports || $isClient) ? $totals['cost'] : $totals['expenses'];
        $body .= '</td>';
      }
      if ($bean->getAttribute('chpaid')) $body .= '<td></td>';
      if ($bean->getAttribute('chip')) $body .= '<td></td>';
      if ($bean->getAttribute('chinvoice')) $body .= '<td></td>';
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
    $items = ttReportHelper::getItems($options);

    $condition = str_replace('count', '', $condition);
    $count_required = (int) trim(str_replace('>', '', $condition));

    if (count($items) > $count_required)
      return true; // Condition ok.

    return false;
  }

  // prepareFavReportBody - prepares an email body for a favorite report.
  static function prepareFavReportBody($options, $comment = null)
  {
    global $user;
    global $i18n;

    // Determine these once as they are used in multiple places in this function.
    $canViewReports = $user->can('view_reports') || $user->can('view_all_reports');
    $isClient = $user->isClient();

    $items = ttReportHelper::getItems($options);
    $group_by = $options['group_by'];
    if ($group_by && 'no_grouping' != $group_by)
      $subtotals = ttReportHelper::getSubtotals($options);
    $totals = ttReportHelper::getTotals($options);

    // Use custom fields plugin if it is enabled.
    if ($user->isPluginEnabled('cf'))
      $custom_fields = new CustomFields($user->group_id);

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

      // Determine group_by header.
      if ('cf_1' == $group_by)
        $group_by_header = htmlspecialchars($custom_fields->fields[0]['label']);
      else {
        $key = 'label.'.$group_by;
        $group_by_header = $i18n->get($key);
      }

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
      if ($options['show_client'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.client').'</td>';
      if ($options['show_project'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.project').'</td>';
      if ($options['show_task'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.task').'</td>';
      if ($options['show_custom_field_1'])
        $body .= '<td style="'.$tableHeader.'">'.htmlspecialchars($custom_fields->fields[0]['label']).'</td>';
      if ($options['show_start'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.start').'</td>';
      if ($options['show_end'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.finish').'</td>';
      if ($options['show_duration'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.duration').'</td>';
      if ($options['show_work_units'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.work_units_short').'</td>';
      if ($options['show_note'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.note').'</td>';
      if ($options['show_cost'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.cost').'</td>';
      if ($options['show_paid'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.paid').'</td>';
      if ($options['show_ip'])
        $body .= '<td style="'.$tableHeaderCentered.'" width="5%">'.$i18n->get('label.ip').'</td>';
      if ($options['show_invoice'])
        $body .= '<td style="'.$tableHeader.'">'.$i18n->get('label.invoice').'</td>';
      $body .= '</tr>';

      // Initialize variables to print subtotals.
      if ($items && 'no_grouping' != $group_by) {
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
              if ($canViewReports || $isClient) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'user' ? $subtotal_name : '').'</td>';
              if ($options['show_client']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'client' ? $subtotal_name : '').'</td>';
              if ($options['show_project']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'project' ? $subtotal_name : '').'</td>';
              if ($options['show_task']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'task' ? $subtotal_name : '').'</td>';
              if ($options['show_custom_field_1']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'cf_1' ? $subtotal_name : '').'</td>';
              if ($options['show_start']) $body .= '<td></td>';
              if ($options['show_end']) $body .= '<td></td>';
              if ($options['show_duration']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['time'].'</td>';
              if ($options['show_work_units']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$prev_grouped_by]['units'].'</td>';
              if ($options['show_note']) $body .= '<td></td>';
              if ($options['show_cost']) {
                $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
                $body .= ($canViewReports || $isClient) ? $subtotals[$prev_grouped_by]['cost'] : $subtotals[$prev_grouped_by]['expenses'];
                $body .= '</td>';
              }
              if ($options['show_paid']) $body .= '<td></td>';
              if ($options['show_ip']) $body .= '<td></td>';
              if ($options['show_invoice']) $body .= '<td></td>';
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
          if ($options['show_client'])
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['client']).'</td>';
          if ($options['show_project'])
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['project']).'</td>';
          if ($options['show_task'])
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['task']).'</td>';
          if ($options['show_custom_field_1'])
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['cf_1']).'</td>';
          if ($options['show_start'])
            $body .= '<td nowrap style="'.$cellRightAligned.'">'.$record['start'].'</td>';
          if ($options['show_end'])
            $body .= '<td nowrap style="'.$cellRightAligned.'">'.$record['finish'].'</td>';
          if ($options['show_duration'])
            $body .= '<td style="'.$cellRightAligned.'">'.$record['duration'].'</td>';
          if ($options['show_work_units'])
            $body .= '<td style="'.$cellRightAligned.'">'.$record['units'].'</td>';
          if ($options['show_note'])
            $body .= '<td style="'.$cellLeftAligned.'">'.htmlspecialchars($record['note']).'</td>';
          if ($options['show_cost'])
            $body .= '<td style="'.$cellRightAligned.'">'.$record['cost'].'</td>';
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
          $body .= '</tr>';

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
        if ($canViewReports || $isClient) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'user' ? $subtotal_name : '').'</td>';
        if ($options['show_client']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'client' ? $subtotal_name : '').'</td>';
        if ($options['show_project']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'project' ? $subtotal_name : '').'</td>';
        if ($options['show_task']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'task' ? $subtotal_name : '').'</td>';
        if ($options['show_custom_field_1']) $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.($group_by == 'cf_1' ? $subtotal_name : '').'</td>';
        if ($options['show_start']) $body .= '<td></td>';
        if ($options['show_end']) $body .= '<td></td>';
        if ($options['show_duration']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$cur_grouped_by]['time'].'</td>';
        if ($options['show_work_units']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$subtotals[$cur_grouped_by]['units'].'</td>';
        if ($options['show_note']) $body .= '<td></td>';
        if ($options['show_cost']) {
          $body .= '<td style="'.$cellRightAlignedSubtotal.'">';
          $body .= ($canViewReports || $isClient) ? $subtotals[$cur_grouped_by]['cost'] : $subtotals[$cur_grouped_by]['expenses'];
          $body .= '</td>';
        }
        if ($options['show_paid']) $body .= '<td></td>';
        if ($options['show_ip']) $body .= '<td></td>';
        if ($options['show_invoice']) $body .= '<td></td>';
        $body .= '</tr>';
      }

      // Print totals.
      $body .= '<tr><td>&nbsp;</td></tr>';
      $body .= '<tr style="'.$rowSubtotal.'">';
      $body .= '<td style="'.$cellLeftAlignedSubtotal.'">'.$i18n->get('label.total').'</td>';
      if ($canViewReports || $isClient) $body .= '<td></td>';
      if ($options['show_client']) $body .= '<td></td>';
      if ($options['show_project']) $body .= '<td></td>';
      if ($options['show_task']) $body .= '<td></td>';
      if ($options['show_custom_field_1']) $body .= '<td></td>';
      if ($options['show_start']) $body .= '<td></td>';
      if ($options['show_end']) $body .= '<td></td>';
      if ($options['show_duration']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$totals['time'].'</td>';
      if ($options['show_work_units']) $body .= '<td style="'.$cellRightAlignedSubtotal.'">'.$totals['units'].'</td>';
      if ($options['show_note']) $body .= '<td></td>';
      if ($options['show_cost']) {
        $body .= '<td nowrap style="'.$cellRightAlignedSubtotal.'">'.htmlspecialchars($user->currency).' ';
        $body .= ($canViewReports || $isClient) ? $totals['cost'] : $totals['expenses'];
        $body .= '</td>';
      }
      if ($options['show_paid']) $body .= '<td></td>';
      if ($options['show_ip']) $body .= '<td></td>';
      if ($options['show_invoice']) $body .= '<td></td>';
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

  // sendFavReport - sends a favorite report to a specified email, called from cron.php
  static function sendFavReport($options, $subject, $email, $cc) {
    // We are called from cron.php, we have no $bean in session.
    // cron.php sets global $user and $i18n objects to match our favorite report user.
    global $user;
    global $i18n;

    // Prepare report body.
    $body = ttReportHelper::prepareFavReportBody($options);

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
    $options['cf_1_option_id'] = $bean->getAttribute('option');
    $options['project_id'] = $bean->getAttribute('project');
    $options['task_id'] = $bean->getAttribute('task');
    $options['billable'] = $bean->getAttribute('include_records');
    $options['invoice'] = $bean->getAttribute('invoice');
    $options['paid_status'] = $bean->getAttribute('paid_status');
    if (is_array($bean->getAttribute('users'))) $options['users'] = join(',', $bean->getAttribute('users'));
    $options['period'] = $bean->getAttribute('period');
    $options['period_start'] = $bean->getAttribute('start_date');
    $options['period_end'] = $bean->getAttribute('end_date');
    $options['show_client'] = $bean->getAttribute('chclient');
    $options['show_invoice'] = $bean->getAttribute('chinvoice');
    $options['show_paid'] = $bean->getAttribute('chpaid');
    $options['show_ip'] = $bean->getAttribute('chip');
    $options['show_project'] = $bean->getAttribute('chproject');
    $options['show_start'] = $bean->getAttribute('chstart');
    $options['show_duration'] = $bean->getAttribute('chduration');
    $options['show_cost'] = $bean->getAttribute('chcost');
    $options['show_task'] = $bean->getAttribute('chtask');
    $options['show_end'] = $bean->getAttribute('chfinish');
    $options['show_note'] = $bean->getAttribute('chnote');
    $options['show_custom_field_1'] = $bean->getAttribute('chcf_1');
    $options['show_work_units'] = $bean->getAttribute('chunits');
    $options['show_totals_only'] = $bean->getAttribute('chtotalsonly');
    $options['group_by'] = $bean->getAttribute('group_by');
    return $options;
  }

  // verifyBean is a security function to make sure data in bean makes sense for a group.
  static function verifyBean($bean) {
    global $user;

    // Check users.
    $users_in_bean = $bean->getAttribute('users');
    if (is_array($users_in_bean)) {
      $users_in_group = ttTeamHelper::getUsers();
      foreach ($users_in_group as $user_in_group) {
        $valid_ids[] = $user_in_group['id'];
      }
      foreach ($users_in_bean as $user_in_bean) {
        if (!in_array($user_in_bean, $valid_ids)) {
          return false;
        }
      }
    }

    // TODO: add additional checks here. Perhaps do it before saving the bean for consistency.
    return true;
  }
}
