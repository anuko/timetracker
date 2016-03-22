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

// Note: This script uses Lichart PHP library and requires GD 2.0.1 or later.

require_once('initialize.php');
import('form.Form');
import('DateAndTime');
import('ttChartHelper');
import('ttSysConfig');
import('PieChartEx');
import('ttUserHelper');
import('ttTeamHelper');

// Access check.
if (!ttAccessCheck(right_view_charts)) {
  header('Location: access_denied.php');
  exit();
}

// Initialize and store date in session.
$cl_date = $request->getParameter('date', @$_SESSION['date']);
if(!$cl_date) {
  $now = new DateAndTime(DB_DATEFORMAT);
  $cl_date = $now->toString(DB_DATEFORMAT);
}
$_SESSION['date'] = $cl_date;

// Initialize chart interval.
$cl_interval = $_SESSION['chart_interval'];
if (!$cl_interval) {
  $sc = new ttSysConfig($user->id);
  $cl_interval = $sc->getValue(SYSC_CHART_INTERVAL);
}
if (!$cl_interval) $cl_interval = INTERVAL_THIS_MONTH;
$_SESSION['chart_interval'] = $cl_interval;

// Initialize chart type.
$cl_type = $_SESSION['chart_type'];
if (!$cl_type) {
  $sc = new ttSysConfig($user->id);
  $cl_type = $sc->getValue(SYSC_CHART_TYPE);
}
if (MODE_TIME == $user->tracking_mode) {
  if (in_array('cl', explode(',', $user->plugins)))
    $cl_type = CHART_CLIENTS;
} else {
  if ($cl_type == CHART_CLIENTS) {
    if (!in_array('cl', explode(',', $user->plugins)))
      $cl_type = CHART_PROJECTS;	
  } else if ($cl_type == CHART_TASKS) {
    if (MODE_PROJECTS_AND_TASKS != $user->tracking_mode)
      $cl_type = CHART_PROJECTS;
  }
}
if (!$cl_type) $cl_type = CHART_PROJECTS;
$_SESSION['chart_type'] = $cl_type;

// Who do we draw charts for?
$on_behalf_id = $request->getParameter('onBehalfUser', (isset($_SESSION['behalf_id'])? $_SESSION['behalf_id'] : $user->id));

if ($request->getMethod( )== 'POST') {
  // If chart interval changed - save it.
  $cl_interval = $request->getParameter('interval');
  if ($cl_interval) {
    // Save in the session
    $_SESSION['chart_interval'] = $cl_interval;
    // and permanently.
    $sc = new ttSysConfig($user->id);
    $sc->setValue(SYSC_CHART_INTERVAL, $cl_interval);
  }
  // If chart type changed - save it.
  $cl_type = $request->getParameter('type');
  if ($cl_type) {
    // Save in the session
    $_SESSION['chart_type'] = $cl_type;
    // and permanently.
    $sc = new ttSysConfig($user->id);
    $sc->setValue(SYSC_CHART_TYPE, $cl_type);
  }
  // If user has changed - set behalf_id accordingly in the session.
  if ($request->getParameter('onBehalfUser')) {
    if($user->canManageTeam()) {
      unset($_SESSION['behalf_id']);
      unset($_SESSION['behalf_name']);

      if($on_behalf_id != $user->id) {
        $_SESSION['behalf_id'] = $on_behalf_id;
        $_SESSION['behalf_name'] = ttUserHelper::getUserName($on_behalf_id);
      }
      header('Location: charts.php');
      exit();
    }
  }
} // isPost

// Elements of chartForm.
$chart_form = new Form('chartForm');

// User dropdown. Changes the user "on behalf" of whom we are working. 
if ($user->canManageTeam()) {
  $user_list = ttTeamHelper::getActiveUsers(array('putSelfFirst'=>true));
  if (count($user_list) > 1) {
    $chart_form->addInput(array('type'=>'combobox',
      'onchange'=>'this.form.submit();',
      'name'=>'onBehalfUser',
      'value'=>$on_behalf_id,
      'data'=>$user_list,
      'datakeys'=>array('id','name'),
    ));
    $smarty->assign('on_behalf_control', 1);
  }
}

// Chart interval options.
$intervals = array();
$intervals[INTERVAL_THIS_DAY] = $i18n->getKey('dropdown.this_day');
$intervals[INTERVAL_THIS_WEEK] = $i18n->getKey('dropdown.this_week');
$intervals[INTERVAL_THIS_MONTH] = $i18n->getKey('dropdown.this_month');
$intervals[INTERVAL_THIS_YEAR] = $i18n->getKey('dropdown.this_year');
$intervals[INTERVAL_ALL_TIME] = $i18n->getKey('dropdown.all_time');

// Chart interval dropdown.
$chart_form->addInput(array('type' => 'combobox',
  'onchange' => 'if(this.form) this.form.submit();',
  'name' => 'interval',
  'value' => $cl_interval,
  'data' => $intervals
));

// Chart type options.
$chart_selector = (MODE_PROJECTS_AND_TASKS == $user->tracking_mode
  || in_array('cl', explode(',', $user->plugins)));
if ($chart_selector) {
  $types = array();
  if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
    $types[CHART_PROJECTS] = $i18n->getKey('dropdown.projects');
  if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
    $types[CHART_TASKS] = $i18n->getKey('dropdown.tasks');
  if (in_array('cl', explode(',', $user->plugins)))
    $types[CHART_CLIENTS] = $i18n->getKey('dropdown.clients');

  // Add chart type dropdown.
  $chart_form->addInput(array('type' => 'combobox',
    'onchange' => 'if(this.form) this.form.submit();',
    'name' => 'type',
    'value' => $cl_type,
    'data' => $types
  ));
}

// Calendar.
$chart_form->addInput(array('type'=>'calendar','name'=>'date','value'=>$cl_date)); // calendar

// Get data for our chart.
$totals = ttChartHelper::getTotals($on_behalf_id, $cl_type, $cl_date, $cl_interval);
$smarty->assign('totals', $totals);

// Prepare chart for drawing.
/*
 * We use libchart.php library to draw chart images. It can draw chart labels, too (embed in the image).
 * But quality of such auto-scaled text is not good. Therefore, we only use libchart to draw a pie-chart picture with
 * auto-calculated percentage markers around it. We print labels (to the side of the picture) ourselves,
 * using the same colors libchart is using. For labels printout, the $totals array (which is used for picture points)
 * is also passed to charts.tpl Smarty template.
 *
 * To make all of the above possible with only one database call to obtain $totals we have to print the chart image
 * to a file here (see code below). Once the image is available as a .png file, the charts.tpl can render it.
 *
 * PieChartEx class is a little extension to libchart-provided PieChart class. It allows us to print the chart
 * without title, logo, and labels.
 */
$chart = new PieChartEx(300, 300);
$data_set = new XYDataSet();
foreach($totals as $total) {
  $data_set->addPoint(new Point( $total['name'], $total['time']));
}
$chart->setDataSet($data_set); 

// Prepare a file name.
$img_dir = TEMPLATE_DIR.'_c/'; // Directory.
$file_name = uniqid('chart_').'.png'; // Short file name. Unique ID here is to avoid problems with browser caching.
$img_ref = 'WEB-INF/templates_c/'.$file_name; // Image reference for html.
$file_name = $img_dir.$file_name; // Full file name. 

// Clean up the file system from older images.
$img_files = glob($img_dir.'chart_*.png');
foreach($img_files as $file) {
  // If the create time of file is older than 1 minute, delete it.
  if (filemtime($file) < (time() - 60)) {
    unlink($file);
  }
}

// Write chart image to file system.
$chart->renderEx(array('fileName'=>$file_name,'hideLogo'=>true,'hideTitle'=>true,'hideLabel'=>true));
// At this point libchart usage is complete and we have chart image on disk.

$smarty->assign('img_file_name', $img_ref);
$smarty->assign('chart_selector', $chart_selector);
$smarty->assign('forms', array($chart_form->getName() => $chart_form->toArray()));
$smarty->assign('title', $i18n->getKey('title.charts'));
$smarty->assign('content_page_name', 'charts.tpl');
$smarty->display('index.tpl');
