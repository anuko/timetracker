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
import('form.Form');
import('ttConfigHelper');

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('wu')) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

$config = new ttConfigHelper($user->getConfig());

if ($request->isPost()) {
  $cl_minutes_in_unit = $request->getParameter('minutes_in_unit');
  $cl_1st_unit_threshold = $request->getParameter('1st_unit_threshold');
  $cl_totals_only = $request->getParameter('totals_only');
} else {
  $cl_minutes_in_unit = $user->getConfigInt('minutes_in_unit', 15);
  $cl_1st_unit_threshold = $user->getConfigInt('1st_unit_threshold', 0);
  $cl_totals_only = $user->getConfigOption('unit_totals_only');
}

$form = new Form('workUnitsForm');
$form->addInput(array('type'=>'text', 'name'=>'minutes_in_unit', 'value'=>$cl_minutes_in_unit, 'style'=>'width:40px'));
$form->addInput(array('type'=>'text', 'name'=>'1st_unit_threshold', 'value'=>$cl_1st_unit_threshold, 'style'=>'width:40px'));
$form->addInput(array('type'=>'checkbox','name'=>'totals_only','value'=>$cl_totals_only));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()){
  // Validate user input.
  if (!ttValidInteger($cl_minutes_in_unit) || $cl_minutes_in_unit == 0) $err->add($i18n->get('error.field'), $i18n->get('form.work_units.minutes_in_unit'));
  if (!ttValidInteger($cl_1st_unit_threshold, true) ||($cl_minutes_in_unit && $cl_1st_unit_threshold > $cl_minutes_in_unit)) $err->add($i18n->get('error.field'), $i18n->get('form.work_units.1st_unit_threshold'));
  // Finished validating user input.

  if ($err->no()) {
    $config->setIntValue('minutes_in_unit', $cl_minutes_in_unit);
    $config->setIntValue('1st_unit_threshold', $cl_1st_unit_threshold);
    $config->setDefinedValue('unit_totals_only', $cl_totals_only);
    if (!$user->updateGroup(array('config' => $config->getConfig()))) {
      $err->add($i18n->get('error.db'));
    }
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.work_units'));
$smarty->assign('content_page_name', 'work_units.tpl');
$smarty->display('index.tpl');
