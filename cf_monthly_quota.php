<?php

require_once('initialize.php');
require_once('plugins/MonthlyQuota.class.php');
import('form.Form');
import('WEB-INF/lib/ttTeamHelper');

// Access check.
if (!ttAccessCheck(right_manage_team)) {
  header('Location: access_denied.php');
  exit();
}

// fallback values
$yearStart = 2015;
$yearEnd = 2030;

if (defined('MONTHLY_QUOTA_YEAR_START')){
  $yearStart = (int)MONTHLY_QUOTA_YEAR_START;
}
if (defined('MONTHLY_QUOTA_YEAR_END')){
  $yearEnd = (int)MONTHLY_QUOTA_YEAR_END;
}

// create values for dropdown
$years = array();
for ($i=$yearStart; $i <= $yearEnd; $i++) {
  array_push($years, array('id'=>$i, 'name'=>$i));
}

// get selected year from url parameters
$selectedYear = $request->getParameter("year");
if (!$selectedYear or !ttValidInteger($selectedYear)){
  $selectedYear = date("Y");
} else {
  $selectedYear = intval($selectedYear);
}

// months are zero indexed
$months = $i18n->monthNames;

$quota = new MonthlyQuota();

if ($request->isPost()){
  $res = false;
  // if user pressed save fpr monthly quotas
  if ($_POST["quotas"]){
    $postedYear = $request->getParameter("years");
    $selectedYear = intval($postedYear);
    for ($i=0; $i < count($months); $i++){
      $res = $quota->update($postedYear, $i+1, $request->getParameter($months[$i]));
    }
  }
  // if user saved required working hours for a day
  if ($_POST["dailyHours"]){
    $hours = $request->getParameter("dailyWorkingHours");
    $teamDetails = ttTeamHelper::getTeamDetails($quota->usersTeamId);
    $res = ttTeamHelper::update($quota->usersTeamId, array('name'=>$teamDetails['team_name'], 
                                                           'workday_hours'=>$hours));
  }
  if ($res) {
    header('Location: profile_edit.php');
    exit();
  } else {
    $err->add($i18n->getKey('error.db'));
  }
}

// returns months where January is month 1, not 0
$monthsData = $quota->get($selectedYear);

$form = new Form('monthlyQuotaForm');

$form->addInput(array('type'=>'combobox', 'name'=>'years', 'data'=>$years, 'datakeys'=>array('id', 'name'), 'value'=>$selectedYear, 'onchange'=>'yearChange(this.value);'));
for ($i=0; $i < count($months); $i++) { 
  $value = "";
  if (array_key_exists($i+1, $monthsData)){
    $value = $monthsData[$i+1];
  }
  $name = $months[$i];
  $form->addInput(array('type'=>'text', 'name'=>$name, 'maxlength'=>3, 'value'=> $value, 'style'=>'width:50px'));
}
$form->addInput(array('type'=>'text', 'name'=>'dailyWorkingHours', 'value'=>$quota->getDailyWorkingHours(), 'style'=>'width:50px'));
$smarty->assign('months', $months);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->getKey('title.monthly_quotas'));
$smarty->assign('content_page_name', 'cf_monthly_quota.tpl');
$smarty->display('index.tpl');
