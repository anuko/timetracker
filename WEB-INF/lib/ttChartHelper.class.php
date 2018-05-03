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

import('Period');

// Definitions for chart types.
define('CHART_PROJECTS', 1);
define('CHART_TASKS', 2);
define('CHART_CLIENTS', 3);

// Class ttChartHelper is a helper class for charts.
class ttChartHelper {

  // getTotals - returns total times by project or task for a given user in a specified period.
  static function getTotals($user_id, $chart_type, $selected_date, $interval_type) {

    $period = null;
    switch ($interval_type) {
      case INTERVAL_THIS_DAY:
        $period = new Period(INTERVAL_THIS_DAY, new DateAndTime(DB_DATEFORMAT, $selected_date));
        break;
 
      case INTERVAL_THIS_WEEK:
        $period = new Period(INTERVAL_THIS_WEEK, new DateAndTime(DB_DATEFORMAT, $selected_date));
        break;

      case INTERVAL_THIS_MONTH:
        $period = new Period(INTERVAL_THIS_MONTH, new DateAndTime(DB_DATEFORMAT, $selected_date));
        break;

      case INTERVAL_THIS_YEAR:
        $period = new Period(INTERVAL_THIS_YEAR, new DateAndTime(DB_DATEFORMAT, $selected_date));
        break;
    }

    $result = array();
    $mdb2 = getConnection();

    $q_period = '';
    if ($period != null) {
      $q_period = " and date >= '".$period->getStartDate(DB_DATEFORMAT)."' and date <= '".$period->getEndDate(DB_DATEFORMAT)."'";
    }
    if (CHART_PROJECTS == $chart_type) {
      // Data for projects.
      $sql = "select p.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_projects p on (p.id = l.project_id)
        where l.status = 1 and l.duration > 0 and l.user_id = $user_id $q_period group by l.project_id";
    } elseif (CHART_TASKS == $chart_type) {
      // Data for tasks.
      $sql = "select t.name as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_tasks t on (t.id = l.task_id)
        where l.status = 1 and l.duration > 0 and l.user_id = $user_id $q_period group by l.task_id";
    } elseif (CHART_CLIENTS == $chart_type) {
      // Data for clients.
      $sql = "select coalesce(c.name, 'NULL') as name, sum(time_to_sec(l.duration)) as time from tt_log l
        left join tt_clients c on (c.id = l.client_id)
        where l.status = 1 and l.duration > 0 and l.user_id = $user_id $q_period group by l.client_id";
    }

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = array('name'=>$val['name'],'time'=>$val['time']); // name  - project name, time - total for project in seconds.
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
      $one_val['name'] .= ' ('.sec_to_time_fmt_hm($one_val['time']).' - '.$percent.')';
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
}
