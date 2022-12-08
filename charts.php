<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Note: This script uses Lichart PHP library and requires GD 2.0.1 or later.

require_once('initialize.php');
import('form.Form');
import('ttDate');
import('ttChartHelper');
import('ttUserConfig');
import('PieChartEx');
import('ttUserHelper');
import('ttTeamHelper');
import('ttFavReportHelper');

define('ALL_USERS_OPTION_ID', -1); // An identifier for "all users" seclection in User dropdown.

// Access checks.
if (!(ttAccessAllowed('view_own_charts') || ttAccessAllowed('view_charts') || ttAccessAllowed('view_all_charts'))) {
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
if ($user->behalf_id && (!($user->can('view_charts') || $user->can('view_all_charts')) || !$user->checkBehalfId())) {
  header('Location: access_denied.php'); // Trying on behalf, but no right or wrong user.
  exit();
}
if (!$user->behalf_id && !$user->can('view_own_charts') && !$user->adjustBehalfId()) {
  header('Location: access_denied.php'); // Trying as self, but no right for self, and noone to view on behalf.
  exit();
}
$userDropdownSelectionId = (int) $request->getParameter('user'); // Resused below access checks.
if ($request->isPost() && $request->getParameter('user')) {
  if ($userDropdownSelectionId == constant('ALL_USERS_OPTION_ID') && !ttAccessAllowed('view_all_charts')) {
    header('Location: access_denied.php'); // All users option is only for users with view_all_charts access right.
    exit();
  }
  if ($userDropdownSelectionId != constant('ALL_USERS_OPTION_ID') && !$user->isUserValid($userDropdownSelectionId)) {
    header('Location: access_denied.php'); // Wrong user id on post.
    exit();
  }
}
$date = $request->getParameter('date');
if ($date && !ttValidDbDateFormatDate($date)) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Determine user for whom we display this page.
$userChanged = (int) $request->getParameter('user_changed');
if ($request->isPost() && $userChanged ) {
  if ($userDropdownSelectionId != constant('ALL_USERS_OPTION_ID')) {
    $user->setOnBehalfUser($userDropdownSelectionId);
  }
}
if ($request->isGet()) {
  $userDropdownSelectionId = $user->getUser();
  // Note that this may change to ALL_USERS_OPTION_ID below from session.
}

$uc = new ttUserConfig();
$tracking_mode = $user->getTrackingMode();

// Initialize and store date in session.
$cl_date = $request->getParameter('date', @$_SESSION['date']);
if(!$cl_date) {
  $now = new ttDate();
  $cl_date = $now->toString();
}
$_SESSION['date'] = $cl_date;

if ($request->isPost()) {
  $cl_fav_report = (int)$request->getParameter('favorite_report');
  if (!$cl_fav_report) $cl_fav_report = -1;
  $_SESSION['fav_report'] = $cl_fav_report;

  $cl_type = (int)$request->getParameter('type');
  if (!$cl_type) $cl_type = ttChartHelper::adjustType($cl_type);
  $_SESSION['chart_type'] = $cl_type;
  $uc->setValue(SYSC_CHART_TYPE, $cl_type);

  // Remember all users selection in session.
  $_SESSION['chart_all_users'] = $userDropdownSelectionId == constant('ALL_USERS_OPTION_ID') ? true : false;

  $cl_interval = (int)$request->getParameter('interval');
  if (!$cl_interval) $cl_interval = INTERVAL_THIS_MONTH;
  $_SESSION['chart_interval'] = $cl_interval;
  $uc->setValue(SYSC_CHART_INTERVAL, $cl_interval);
} else {
  // Initialize fav report selector.
  $cl_fav_report = @$_SESSION['fav_report'];
  if (!$cl_fav_report) $cl_fav_report = -1;
  $_SESSION['fav_report'] = $cl_fav_report;

  // Initialize chart type.
  $cl_type = @$_SESSION['chart_type'];
  if (!$cl_type) $cl_type = $uc->getValue(SYSC_CHART_TYPE);
  $cl_type = ttChartHelper::adjustType($cl_type);
  $_SESSION['chart_type'] = $cl_type;

  // Set user selection to all users, if necessary.
  $allUsersSetInSession = @$_SESSION['chart_all_users'];
  if ($allUsersSetInSession)
    $userDropdownSelectionId = constant('ALL_USERS_OPTION_ID');

  // Initialize chart interval.
  $cl_interval = @$_SESSION['chart_interval'];
  if (!$cl_interval) $cl_interval = $uc->getValue(SYSC_CHART_INTERVAL);
  if (!$cl_interval) $cl_interval = INTERVAL_THIS_MONTH;
  $_SESSION['chart_interval'] = $cl_interval;
}

// Elements of chartForm.
$chart_form = new Form('chartForm');
$largeScreenCalendarRowSpan = 1; // Number of rows calendar spans on large screens.

// Fav report control.
$report_list = ttFavReportHelper::getReports();
$chart_form->addInput(array('type'=>'combobox',
  'name'=>'favorite_report',
  'onchange'=>'handleFavReportSelection();this.form.submit();',
  'data'=>$report_list,
  'value' => $cl_fav_report,
  'datakeys'=>array('id','name'),
  'empty'=>array('-1'=>$i18n->get('dropdown.no'))));
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

// User dropdown. Changes the user "on behalf" of whom we are working.
if ($user->can('view_charts') || $user->can('view_all_charts')) {
  $rank = $user->getMaxRankForGroup($user->getGroup());
  if ($user->can('view_own_charts'))
    $options = array('status'=>ACTIVE,'max_rank'=>$rank,'include_self'=>true,'self_first'=>true);
  else
    $options = array('status'=>ACTIVE,'max_rank'=>$rank);
  $user_list = $user->getUsers($options);
  // Add the --- all --- option to dropdown.
  if ($user->can('view_all_charts')) {
      $user_list[] = array('id'=>'-1','group_id'=>$user->getGroup(), 'name'=>$i18n->get('dropdown.all'), 'rights'=>'');
  }
  if (count($user_list) >= 1) {
    $chart_form->addInput(array('type'=>'combobox',
      'onchange'=>'this.form.user_changed.value=1;this.form.submit();',
      'name'=>'user',
      'value'=>$userDropdownSelectionId,
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
$intervals[INTERVAL_PREVIOUS_MONTH] = $i18n->get('dropdown.previous_month');
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

// Calendar.
$chart_form->addInput(array('type'=>'calendar','name'=>'date','value'=>$cl_date)); // calendar

// Get data for our chart.
if ($cl_fav_report == -1)
  $totals = ttChartHelper::getTotals($userDropdownSelectionId, $cl_type, $cl_date, $cl_interval);
else
  $totals = ttChartHelper::getTotalsForFavReport($cl_fav_report, $cl_type);
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
$smarty->assign('onload', 'onLoad="adjustTodayLinks();handleFavReportSelection();"');
$smarty->assign('forms', array($chart_form->getName() => $chart_form->toArray()));
$smarty->assign('title', $i18n->get('title.charts'));
$smarty->assign('content_page_name', 'charts.tpl');
$smarty->display('index.tpl');
