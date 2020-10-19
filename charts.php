<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Note: This script uses Lichart PHP library and requires GD 2.0.1 or later.

require_once('initialize.php');
import('form.Form');
import('DateAndTime');
import('ttChartHelper');
import('ttUserConfig');
import('PieChartEx');
import('ttUserHelper');
import('ttTeamHelper');

// Access checks.
if (!(ttAccessAllowed('view_own_charts') || ttAccessAllowed('view_charts'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('ch')) {
  header('Location: feature_disabled.php');
  exit();
}
if (!$user->exists()) {
  header('Location: access_denied.php'); // Nobody to display a chart for.
  exit();
}
if ($user->behalf_id && (!$user->can('view_charts') || !$user->checkBehalfId())) {
  header('Location: access_denied.php'); // Trying on behalf, but no right or wrong user.
  exit();
}
if (!$user->behalf_id && !$user->can('view_own_charts') && !$user->adjustBehalfId()) {
  header('Location: access_denied.php'); // Trying as self, but no right for self, and noone to view on behalf.
  exit();
}
if ($request->isPost() && $request->getParameter('user')) {
  if (!$user->isUserValid($request->getParameter('user'))) {
    header('Location: access_denied.php'); // Wrong user id on post.
    exit();
  }
}
// End of access checks.

// Determine user for which we display this page.
$userChanged = $request->getParameter('user_changed');
if ($request->isPost() && $userChanged) {
  $user_id = $request->getParameter('user');
  $user->setOnBehalfUser($user_id);
} else {
  $user_id = $user->getUser();
}

$uc = new ttUserConfig();
$tracking_mode = $user->getTrackingMode();

// Initialize and store date in session.
$cl_date = $request->getParameter('date', @$_SESSION['date']);
if(!$cl_date) {
  $now = new DateAndTime(DB_DATEFORMAT);
  $cl_date = $now->toString(DB_DATEFORMAT);
}
$_SESSION['date'] = $cl_date;

if ($request->isPost()) {
  $cl_interval = $request->getParameter('interval');
  if (!$cl_interval) $cl_interval = INTERVAL_THIS_MONTH;
  $_SESSION['chart_interval'] = $cl_interval;
  $uc->setValue(SYSC_CHART_INTERVAL, $cl_interval);

  $cl_type = $request->getParameter('type');
  if (!$cl_type) $cl_type = ttChartHelper::adjustType($cl_type);
  $_SESSION['chart_type'] = $cl_type;
  $uc->setValue(SYSC_CHART_TYPE, $cl_type);
} else {
  // Initialize chart interval.
  $cl_interval = $_SESSION['chart_interval'];
  if (!$cl_interval) $cl_interval = $uc->getValue(SYSC_CHART_INTERVAL);
  if (!$cl_interval) $cl_interval = INTERVAL_THIS_MONTH;
  $_SESSION['chart_interval'] = $cl_interval;

  // Initialize chart type.
  $cl_type = $_SESSION['chart_type'];
  if (!$cl_type) $cl_type = $uc->getValue(SYSC_CHART_TYPE);
  $cl_type = ttChartHelper::adjustType($cl_type);
  $_SESSION['chart_type'] = $cl_type;
}

// Elements of chartForm.
$chart_form = new Form('chartForm');
$largeScreenCalendarRowSpan = 1; // Number of rows calendar spans on large screens.

// User dropdown. Changes the user "on behalf" of whom we are working.
if ($user->can('view_charts')) {
  $rank = $user->getMaxRankForGroup($user->getGroup());
  if ($user->can('view_own_charts'))
    $options = array('status'=>ACTIVE,'max_rank'=>$rank,'include_self'=>true,'self_first'=>true);
  else
    $options = array('status'=>ACTIVE,'max_rank'=>$rank);
  $user_list = $user->getUsers($options);
  if (count($user_list) >= 1) {
    $chart_form->addInput(array('type'=>'combobox',
      'onchange'=>'this.form.user_changed.value=1;this.form.submit();',
      'name'=>'user',
      'value'=>$user_id,
      'data'=>$user_list,
      'datakeys'=>array('id','name'),
    ));
    $chart_form->addInput(array('type'=>'hidden','name'=>'user_changed'));
    $largeScreenCalendarRowSpan += 2;
    $smarty->assign('user_dropdown', 1);
  }
}

// Chart interval options.
$intervals = array();
$intervals[INTERVAL_THIS_DAY] = $i18n->get('dropdown.selected_day');
$intervals[INTERVAL_THIS_WEEK] = $i18n->get('dropdown.selected_week');
$intervals[INTERVAL_THIS_MONTH] = $i18n->get('dropdown.selected_month');
$intervals[INTERVAL_THIS_YEAR] = $i18n->get('dropdown.selected_year');
$intervals[INTERVAL_ALL_TIME] = $i18n->get('dropdown.all_time');

// Chart interval dropdown.
$chart_form->addInput(array('type' => 'combobox',
  'onchange' => 'this.form.submit();',
  'name' => 'interval',
  'value' => $cl_interval,
  'data' => $intervals
));
$largeScreenCalendarRowSpan += 2;

// Chart type options.
$chart_selector = (MODE_PROJECTS_AND_TASKS == $tracking_mode || $user->isPluginEnabled('cl'));
if ($chart_selector) {
  $types = array();
  if (MODE_PROJECTS == $tracking_mode || MODE_PROJECTS_AND_TASKS == $tracking_mode)
    $types[CHART_PROJECTS] = $i18n->get('dropdown.projects');
  if (MODE_PROJECTS_AND_TASKS == $tracking_mode)
    $types[CHART_TASKS] = $i18n->get('dropdown.tasks');
  if ($user->isPluginEnabled('cl'))
    $types[CHART_CLIENTS] = $i18n->get('dropdown.clients');

  // Add chart type dropdown.
  $chart_form->addInput(array('type' => 'combobox',
    'onchange' => 'this.form.submit();',
    'name' => 'type',
    'value' => $cl_type,
    'data' => $types
  ));
  $largeScreenCalendarRowSpan += 2;
}

// Calendar.
$chart_form->addInput(array('type'=>'calendar','name'=>'date','value'=>$cl_date)); // calendar

// Get data for our chart.
$totals = ttChartHelper::getTotals($user_id, $cl_type, $cl_date, $cl_interval);
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
if (is_array($img_files)) {
  foreach($img_files as $file) {
    // If file creation time is older than 1 minute, delete it.
    if (filemtime($file) < (time() - 60)) {
      unlink($file);
    }
  }
}

// Write chart image to file system.
$chart->renderEx(array('fileName'=>$file_name,'hideLogo'=>true,'hideTitle'=>true,'hideLabel'=>true));
// At this point libchart usage is complete and we have chart image on disk.

$smarty->assign('large_screen_calendar_row_span', $largeScreenCalendarRowSpan);
$smarty->assign('img_file_name', $img_ref);
$smarty->assign('chart_selector', $chart_selector);
$smarty->assign('onload', 'onLoad="adjustTodayLinks()"');
$smarty->assign('forms', array($chart_form->getName() => $chart_form->toArray()));
$smarty->assign('title', $i18n->get('title.charts'));
$smarty->assign('content_page_name', 'charts2.tpl');
$smarty->display('index2.tpl');
