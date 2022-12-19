<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('ttConfigHelper');
import('form.Form');

// Access checks.
if (!ttAccessAllowed('manage_basic_settings')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$config = $user->getConfigHelper();

if ($request->isPost()) {
  $cl_time_note_on_separate_row = (bool)$request->getParameter('time_note_on_separate_row');
  $cl_time_not_complete_days = (bool)$request->getParameter('time_not_complete_days');
  $cl_record_custom_fields = (bool)$request->getParameter('record_custom_fields');
  $cl_report_note_on_separate_row = (bool)$request->getParameter('report_note_on_separate_row');
  $cl_report_inactive_projects = (bool)($request->getParameter('report_inactive_projects'));
  $cl_report_cost_per_hour = (bool)$request->getParameter('report_cost_per_hour');
  $cl_custom_css = trim($request->getParameter('custom_css'));
  $cl_custom_translation = trim($request->getParameter('custom_translation'));
} else {
  $cl_time_note_on_separate_row = $config->getDefinedValue('time_note_on_separate_row');
  $cl_time_not_complete_days = $config->getDefinedValue('time_not_complete_days');
  $cl_record_custom_fields = $config->getDefinedValue('record_custom_fields');
  $cl_report_note_on_separate_row = $config->getDefinedValue('report_note_on_separate_row');
  $cl_report_inactive_projects = $config->getDefinedValue('report_inactive_projects');
  $cl_report_cost_per_hour = $config->getDefinedValue('report_cost_per_hour');
  $cl_custom_css = $user->getCustomCss();
  $cl_custom_translation = $user->getCustomTranslation();
}

$form = new Form('displayOptionsForm');

// Time page.
// $form->addInput(array('type'=>'checkbox','name'=>'time_client','value'=>$cl_time_client));
// $form->addInput(array('type'=>'checkbox','name'=>'time_project','value'=>$cl_time_project));
// $form->addInput(array('type'=>'checkbox','name'=>'time_task','value'=>$cl_time_task));
// $form->addInput(array('type'=>'checkbox','name'=>'time_start','value'=>$cl_time_start));
// $form->addInput(array('type'=>'checkbox','name'=>'time_finish','value'=>$cl_time_finish));
// $form->addInput(array('type'=>'checkbox','name'=>'time_duration','value'=>$cl_time_duration));
// $form->addInput(array('type'=>'checkbox','name'=>'time_note','value'=>$cl_time_note));
$form->addInput(array('type'=>'checkbox','name'=>'time_note_on_separate_row','value'=>$cl_time_note_on_separate_row));
$form->addInput(array('type'=>'checkbox','name'=>'time_not_complete_days','value'=>$cl_time_not_complete_days));
$form->addInput(array('type'=>'checkbox','name'=>'record_custom_fields','value'=>$cl_record_custom_fields));
// TODO: consider adding other fields (timesheet, work_units, invoice, approved, cost, paid)?

// Reports.
$form->addInput(array('type'=>'checkbox','name'=>'report_note_on_separate_row','value'=>$cl_report_note_on_separate_row));
$form->addInput(array('type'=>'checkbox','name'=>'report_inactive_projects','value'=>$cl_report_inactive_projects));
$form->addInput(array('type'=>'checkbox','name'=>'report_cost_per_hour','value'=>$cl_report_cost_per_hour));
// TODO: add PDF break controller here.

$form->addInput(array('type'=>'textarea','name'=>'custom_css','value'=>$cl_custom_css));
$form->addInput(array('type'=>'textarea','name'=>'custom_translation','value'=>$cl_custom_translation));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()){
  // Validate user input.
  if (!ttValidCss($cl_custom_css)) $err->add($i18n->get('error.field'), $i18n->get('form.display_options.custom_css'));
  if (!ttValidTranslation($cl_custom_translation)) $err->add($i18n->get('error.field'), $i18n->get('form.display_options.custom_translation'));
  // Finished validating user input.

  if ($err->no()) {
    // Update config.
    $config->setDefinedValue('time_note_on_separate_row', $cl_time_note_on_separate_row);
    $config->setDefinedValue('time_not_complete_days', $cl_time_not_complete_days);
    $config->setDefinedValue('record_custom_fields', $cl_record_custom_fields);
    $config->setDefinedValue('report_note_on_separate_row', $cl_report_note_on_separate_row);
    $config->setDefinedValue('report_inactive_projects', $cl_report_inactive_projects);
    $config->setDefinedValue('report_cost_per_hour', $cl_report_cost_per_hour);
    if ($user->updateGroup(array(
      'config' => $config->getConfig(),
      'custom_css' => $cl_custom_css,
      'custom_translation' => $cl_custom_translation))) {
      header('Location: success.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.display_options'));
$smarty->assign('content_page_name', 'display_options.tpl');
$smarty->display('index.tpl');
