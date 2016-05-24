<?php

require_once('initialize.php');
require_once('plugins/MonthlyQuota.class.php');
import('form.Form');

// Access check.
if (!ttAccessCheck(right_manage_team)) {
  header('Location: access_denied.php');
  exit();
}

$form = new Form('monthlyQuotaForm');
// months are zero indexed
$months = $i18n->monthNames;
$years = array();
for ($i=1990; $i < 2040; $i++) { 
  array_push($years, array('id'=>$i, 'name'=>$i));
}

$year = $request->getParameter("year");
if (!$year or !ttValidInteger($year)){
  $year = date("Y");
}else {
  $year = intval($year);
}

$quota = new MonthlyQuota();

if ($request->isPost()){
  $postedYear = $request->getParameter("years");
  $year = intval($postedYear);
  $res = false;
  for ($i=0; $i < count($months); $i++){
    $res = $quota->update($postedYear, $i+1, $request->getParameter($months[$i]));
  }
  if ($res){
    header('Location: profile_edit.php');
    exit();
  } else
      $err->add($i18n->getKey('error.db'));
}

// returns months where January is month 1, not 0
$monthsData = $quota->get($year);

$form->addInput(array('type'=>'combobox', 'name'=>'years', 'data'=>$years, 'datakeys'=>array('id', 'name'), 'value'=>$year, 'onchange'=>'yearChange(this.value);'));
for ($i=0; $i < count($months); $i++) { 
  $value = "";
  if (array_key_exists($i+1, $monthsData)){
    $value = $monthsData[$i+1];
  }
  $name = $months[$i];
  $form->addInput(array('type'=>'text', 'name'=>$name, 'maxlength'=>3, 'value'=> $value, 'style'=>'width:50px'));
}
$smarty->assign('months', $months);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('content_page_name', 'cf_monthly_quota.tpl');
$smarty->display('index.tpl');
