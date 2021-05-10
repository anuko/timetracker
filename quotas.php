<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

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
  $workdayMinutes = ttTimeHelper::postedDurationToMinutes($request->getParameter('workdayHours'));
  if (false === $workdayMinutes || $workdayMinutes <= 0 )
    $err->add($i18n->get('error.field'), $i18n->get('form.quota.workday_hours'));

  for ($i = 0; $i < count($months); $i++){
    $val = $request->getParameter($months[$i]);
    $monthMinutes = ttTimeHelper::postedDurationToMinutes($val, 44640/*24*60*31*/);
    if (false === $monthMinutes || $monthMinutes < 0)
      $err->add($i18n->get('error.field'), $months[$i]);
  }
  // Finished validating user input.

  if ($err->no()) {

    // Handle workday hours.
    $workday_minutes = ttTimeHelper::postedDurationToMinutes($request->getParameter('workdayHours'));
    if ($workday_minutes != $user->getWorkdayMinutes()) {
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
$workdayHours = ttTimeHelper::toAbsDuration($user->getWorkdayMinutes(), true);

$form = new Form('monthlyQuotasForm');
$form->addInput(array('type'=>'text','class'=>'quota-field','name'=>'workdayHours','value'=>$workdayHours));
$form->addInput(array('type'=>'combobox','class'=>'dropdown-field-short','name'=>'year','data'=>$years,'datakeys'=>array('id','name'),'value'=>$selectedYear,'onchange'=>'yearChange(this.value);'));
for ($i=0; $i < count($months); $i++) { 
  $value = "";
  if (array_key_exists($i+1, $monthsData)){
    $value = $monthsData[$i+1];
    $value = ttTimeHelper::toAbsDuration($value, true);
  }
  $name = $months[$i];
  $form->addInput(array('type'=>'text','class'=>'quota-field','name'=>$name,'maxlength'=>6,'value'=> $value));
}

$smarty->assign('months', $months);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.monthly_quotas'));
$smarty->assign('content_page_name', 'quotas.tpl');
$smarty->display('index.tpl');
