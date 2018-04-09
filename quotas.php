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

require_once('initialize.php');
require_once('plugins/MonthlyQuota.class.php');
import('form.Form');
import('ttTimeHelper');

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('mq')) {
  header('Location: feature_disabled.php');
  exit();
}

// Start and end fallback values for the Year dropdown.
$yearStart = 2015;
$yearEnd = 2030;

// If values are defined in config - use them.
if (defined('MONTHLY_QUOTA_YEAR_START')){
  $yearStart = (int)MONTHLY_QUOTA_YEAR_START;
}
if (defined('MONTHLY_QUOTA_YEAR_END')){
  $yearEnd = (int)MONTHLY_QUOTA_YEAR_END;
}

// Create values for the Year dropdown.
$years = array();
for ($i = $yearStart; $i <= $yearEnd; $i++) {
  array_push($years, array('id'=>$i,'name'=>$i));
}

// Get selected year from url parameter.
$selectedYear = $request->getParameter('year');
if (!$selectedYear or !ttValidInteger($selectedYear)){
  $selectedYear = date('Y');
} else {
  $selectedYear = (int) $selectedYear;
}

// Months are zero indexed.
$months = $i18n->monthNames;

$quota = new MonthlyQuota();

if ($request->isPost()){
  // Validate user input.
  if (false === ttTimeHelper::postedDurationToMinutes($request->getParameter('workdayHours')))
    $err->add($i18n->get('error.field'), $i18n->get('form.quota.workday_hours'));

  for ($i = 0; $i < count($months); $i++){
    $val = $request->getParameter($months[$i]);
    if (false === ttTimeHelper::postedDurationToMinutes($val, 44640/*24*60*31*/))
      $err->add($i18n->get('error.field'), $months[$i]);
  }
  // Finished validating user input.

  if ($err->no()) {

    // Handle workday hours.
    $workday_minutes = ttTimeHelper::postedDurationToMinutes($request->getParameter('workdayHours'));
    if ($workday_minutes != $user->workday_minutes) {
      if (!$user->updateGroup(array('workday_minutes'=>$workday_minutes)))
        $err->add($i18n->get('error.db'));
    }

    // Handle monthly quotas for a selected year.
    $selectedYear = (int) $request->getParameter('year');
    for ($i = 0; $i < count($months); $i++){
      $quota_in_minutes = ttTimeHelper::postedDurationToMinutes($request->getParameter($months[$i]), 44640/*24*60*31*/);
      if (!$quota->update($selectedYear, $i+1, $quota_in_minutes))
        $err->add($i18n->get('error.db'));
    }

    if ($err->no()) {
      // Redisplay the form.
      header('Location: quotas.php?year='.$selectedYear);
      exit();
    }
  }
}

// Get monthly quotas for the entire year.
$monthsData = $quota->get($selectedYear);
$workdayHours = ttTimeHelper::toAbsDuration($user->workday_minutes, true);

$form = new Form('monthlyQuotasForm');
$form->addInput(array('type'=>'text', 'name'=>'workdayHours', 'value'=>$workdayHours, 'style'=>'width:60px'));
$form->addInput(array('type'=>'combobox','name'=>'year','data'=>$years,'datakeys'=>array('id','name'),'value'=>$selectedYear,'onchange'=>'yearChange(this.value);'));
for ($i=0; $i < count($months); $i++) { 
  $value = "";
  if (array_key_exists($i+1, $monthsData)){
    $value = $monthsData[$i+1];
    $value = ttTimeHelper::toAbsDuration($value, true);
  }
  $name = $months[$i];
  $form->addInput(array('type'=>'text','name'=>$name,'maxlength'=>6,'value'=> $value,'style'=>'width:70px'));
}

$smarty->assign('months', $months);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.monthly_quotas'));
$smarty->assign('content_page_name', 'quotas.tpl');
$smarty->display('index.tpl');
