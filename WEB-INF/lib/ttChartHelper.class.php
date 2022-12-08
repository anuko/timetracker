<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('ttPeriod');
import('ttTimeHelper');
import('ttFavReportHelper');
import('ttReportHelper');

// Definitions for chart types.
define('CHART_PROJECTS', 1);
define('CHART_TASKS', 2);
define('CHART_CLIENTS', 3);

// Class ttChartHelper is a helper class for charts.
class ttChartHelper {

  // getTotals - returns total times by project, task, or client for a given user in a specified period.
  static function getTotals($user_id, $chart_type, $selected_date, $interval_type) {

    global $user;
    $user_id = (int) $user_id; // Cast to int just in case for sql injections.
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $period = null;
    switch ($interval_type) {
      case INTERVAL_THIS_DAY:
        $period = new ttPeriod(new ttDate($selected_date), INTERVAL_THIS_DAY);
        break;
 
      case INTERVAL_THIS_WEEK:
        $period = new ttPeriod(new ttDate($selected_date), INTERVAL_THIS_WEEK);
        break;

      case INTERVAL_THIS_MONTH:
        $period = new ttPeriod(new ttDate($selected_date), INTERVAL_THIS_MONTH);
        break;

      case INTERVAL_PREVIOUS_MONTH:
        $period = new ttPeriod(new ttDate($selected_date), INTERVAL_PREVIOUS_MONTH);
        break;

      case INTERVAL_THIS_YEAR:
        $period = new ttPeriod(new ttDate($selected_date), INTERVAL_THIS_YEAR);
        break;
    }

    $result = array();
    $mdb2 = getConnection();

    $userIdPart = '';
    if ($user_id > 0) {
      // -1 here means "all users in group" both active and inactive.
      // Therefore, we will not be using user id.
      $userIdPart = "and l.user_id = $user_id";
    }

    $q_period = '';
    if ($period != null) {
      $q_period = "and date >= '".$period->getStartDate(DB_DATEFORMAT)."' and date <= '".$period->getEndDate(DB_DATEFORMAT)."'";
    }
    if (CHART_PROJECTS == $chart_type) {
      // Data for projects.
      $sql = "select p.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_projects p on (p.id = l.project_id)
        where l.status = 1 $userIdPart and l.group_id = $group_id and l.org_id = $org_id $q_period group by l.project_id";
    } elseif (CHART_TASKS == $chart_type) {
      // Data for tasks.
      $sql = "select t.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_tasks t on (t.id = l.task_id)
        where l.status = 1 $userIdPart and l.group_id = $group_id and l.org_id = $org_id $q_period group by l.task_id";
    } elseif (CHART_CLIENTS == $chart_type) {
      // Data for clients.
      $sql = "select c.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_clients c on (c.id = l.client_id)
        where l.status = 1 $userIdPart and l.group_id = $group_id and l.org_id = $org_id $q_period group by l.client_id";
    }

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        if ($val['time'] > 0) // Only positive totals make sense in pie charts. Skip negatives entirely.
          $result[] = array('name'=>$val['name'],'time'=>$val['time']); // name - entity name, time - total for entity in seconds.
      }
    }

    // Get total time. We'll need it to calculate percentages (for labels to the right of diagram).
    $total = 0;
    foreach ($result as $one_val) {
      $total += $one_val['time'];
    }
    // Add a string representation of time + percentage to names. Example: "Time Tracker (1:15 - 6%)".
    foreach ($result as &$one_val) {
      $percent = round(100*$one_val['time']/$total).'%';
      $one_val['name'] .= ' ('.ttTimeHelper::minutesToDuration($one_val['time'] / 60).' - '.$percent.')';
    }

    // Note: the remaining code here is needed to display labels on the side of the diagram.
    // We print labels ourselves (not using libchart.php) because quality of libchart labels is not good.

    // Note: Optimize this sorting and reversing.
    $result = mu_sort($result, 'time');
    $result = array_reverse($result); // This is to assign correct colors to labels.

    // Add color to array items. This is used in labels on the side of a chart.
    $colors = array(
      array(2, 78, 0),
      array(148, 170, 36),
      array(233, 191, 49),
      array(240, 127, 41),
      array(243, 63, 34),
      array(190, 71, 47),
      array(135, 81, 60),
      array(128, 78, 162),
      array(121, 75, 255),
      array(142, 165, 250),
      array(162, 254, 239),
      array(137, 240, 166),
      array(104, 221, 71),
      array(98, 174, 35),
      array(93, 129, 1)
    );
    for ($i = 0; $i < count($result); $i++) {
      $color = $colors[$i%count($colors)];
      $result[$i]['color_html'] = sprintf('#%02x%02x%02x', $color[0], $color[1], $color[2]);
    }

    return $result;
  }


  // getTotals - returns total times by project, task, or client for a selected fav report.
  static function getTotalsForFavReport($fav_report_id, $chart_type) {

    global $user;

    // Use custom fields plugin if it is enabled.
    if ($user->isPluginEnabled('cf')) {
      require_once('plugins/CustomFields.class.php');
      $custom_fields = new CustomFields();
    }

    $result = array();
    $mdb2 = getConnection();

    // Get favorite report details.
    $options = ttFavReportHelper::getReportOptions($fav_report_id);
    if (!$options)
      return $result;  // Return empty array if something went wrong.

    $options = ttFavReportHelper::adjustOptions($options);

    // Obtain the where clause for fav report.
    $where = ttReportHelper::getWhere($options);

    // Build sql query according to selected chart type.
    if (CHART_PROJECTS == $chart_type) {
      // Data for projects.
      $sql = "select p.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_projects p on (p.id = l.project_id)
        $where group by l.project_id";
    } elseif (CHART_TASKS == $chart_type) {
      // Data for tasks.
      $sql = "select t.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_tasks t on (t.id = l.task_id)
        $where group by l.task_id";
    } elseif (CHART_CLIENTS == $chart_type) {
      // Data for clients.
      $sql = "select c.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_clients c on (c.id = l.client_id)
        $where group by l.client_id";
    }

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        if ($val['time'] > 0) // Only positive totals make sense in pie charts. Skip negatives entirely.
          $result[] = array('name'=>$val['name'],'time'=>$val['time']); // name - entity name, time - total for entity in seconds.
      }
    }

    // Get total time. We'll need it to calculate percentages (for labels to the right of diagram).
    $total = 0;
    foreach ($result as $one_val) {
      $total += $one_val['time'];
    }
    // Add a string representation of time + percentage to names. Example: "Time Tracker (1:15 - 6%)".
    foreach ($result as &$one_val) {
      $percent = round(100*$one_val['time']/$total).'%';
      $one_val['name'] .= ' ('.ttTimeHelper::minutesToDuration($one_val['time'] / 60).' - '.$percent.')';
    }

    // Note: the remaining code here is needed to display labels on the side of the diagram.
    // We print labels ourselves (not using libchart.php) because quality of libchart labels is not good.

    // Note: Optimize this sorting and reversing.
    $result = mu_sort($result, 'time');
    $result = array_reverse($result); // This is to assign correct colors to labels.

    // Add color to array items. This is used in labels on the side of a chart.
    $colors = array(
      array(2, 78, 0),
      array(148, 170, 36),
      array(233, 191, 49),
      array(240, 127, 41),
      array(243, 63, 34),
      array(190, 71, 47),
      array(135, 81, 60),
      array(128, 78, 162),
      array(121, 75, 255),
      array(142, 165, 250),
      array(162, 254, 239),
      array(137, 240, 166),
      array(104, 221, 71),
      array(98, 174, 35),
      array(93, 129, 1)
    );
    for ($i = 0; $i < count($result); $i++) {
      $color = $colors[$i%count($colors)];
      $result[$i]['color_html'] = sprintf('#%02x%02x%02x', $color[0], $color[1], $color[2]);
    }

    return $result;
  }


  // adjustType - adjust chart type to something that is available for a group.
  static function adjustType($requested_type) {
    global $user;
    $tracking_mode = $user->getTrackingMode();
    $client_option = $user->isPluginEnabled('cl');

    // We have 3 possible options for chart type: projects, tasks, or clients.
    // Deal with each one individually.

    if ($requested_type == CHART_PROJECTS) {
      if ($tracking_mode == MODE_PROJECTS || $tracking_mode == MODE_PROJECTS_AND_TASKS)
        return CHART_PROJECTS;
      else if ($client_option)
        return CHART_CLIENTS;
    }

    if ($requested_type == CHART_TASKS) {
      if ($tracking_mode == MODE_PROJECTS_AND_TASKS)
        return CHART_TASKS;
      if ($tracking_mode == MODE_PROJECTS)
        return CHART_PROJECTS;
      else if ($client_option)
        return CHART_CLIENTS;
    }

    if ($requested_type == CHART_CLIENTS) {
      if ($client_option)
        return CHART_CLIENTS;
      else if ($tracking_mode == MODE_PROJECTS || ($tracking_mode == MODE_PROJECTS_AND_TASKS))
        return CHART_PROJECTS;
    }

    return  CHART_PROJECTS;
  }
}
