<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttUserHelper');
import('ttRoleHelper');
import('ttConfigHelper');

// Access checks.
// There are 4 distinct situations:
//   1) Editing home group in get or post.
//   2) Editing a subgroup in get or post.
// We'll check access separately as it is about different right checks.
if ($request->isGet()) {
  $group_id = $request->getParameter('id') ? (int)$request->getParameter('id') : $user->getGroup();
} else {
  $group_id = $request->getParameter('group') ? (int)$request->getParameter('group') : $user->getGroup();
}
$home_group = $user->group_id == $group_id;
if ($home_group) {
  // Editing home group.
  if (!ttAccessAllowed('manage_basic_settings')) {
    header('Location: access_denied.php'); // Not allowed to edit home group settings.
    exit();
  }
} else {
  // Editing a subgroup.
  if (!ttAccessAllowed('manage_subgroups')) {
    header('Location: access_denied.php'); // No right to manage subgroups.
    exit();
  }
  if (!$user->isSubgroupValid($group_id)) {
    header('Location: access_denied.php'); // Wrong subgroup.
    exit();
  }
}
// End of access checks.

// Set on behalf group accordingly.
$groupChanged = $request->getParameter('group_changed');
if ($request->isPost() && $groupChanged) {
 $user->setOnBehalfGroup($group_id);
}

$groups = $user->getGroupsForDropdown();
$group = ttGroupHelper::getGroupAttrs($group_id);
$config = $user->getConfigHelper();

if (!defined('CURRENCY_DEFAULT')) define('CURRENCY_DEFAULT', '$');

if ($request->isPost() && !$groupChanged) {
  $cl_currency = trim($request->getParameter('currency'));
  if (!$cl_currency) $cl_currency = CURRENCY_DEFAULT;
  $cl_lang = $request->getParameter('lang');
  $cl_decimal_mark = $request->getParameter('decimal_mark');
  $cl_date_format = $request->getParameter('date_format');
  $cl_time_format = $request->getParameter('time_format');
  $cl_start_week = $request->getParameter('start_week');
  $cl_holidays = trim($request->getParameter('holidays'));
  $cl_tracking_mode = $request->getParameter('tracking_mode');
  $cl_project_required = $request->getParameter('project_required');
  $cl_record_type = $request->getParameter('record_type');
  $cl_punch_mode = $request->getParameter('punch_mode');
  $cl_allow_overlap = $request->getParameter('allow_overlap');
  $cl_future_entries = $request->getParameter('future_entries');
  $cl_uncompleted_indicators = $request->getParameter('uncompleted_indicators');
  $cl_confirm_save = $request->getParameter('confirm_save');
} else {
  $cl_currency = ($group['currency'] == '' ? CURRENCY_DEFAULT : $group['currency']);
  $cl_lang = $group['lang'];
  $cl_decimal_mark = $group['decimal_mark'];
  $cl_date_format = $group['date_format'];
  $cl_time_format = $group['time_format'];
  $cl_start_week = $group['week_start'];
  $cl_holidays = $group['holidays'];
  $cl_tracking_mode = $group['tracking_mode'];
  $cl_project_required = $group['project_required'];
  $cl_record_type = $group['record_type'];
  $cl_punch_mode = $config->getDefinedValue('punch_mode');
  $cl_allow_overlap = $config->getDefinedValue('allow_overlap');
  $cl_future_entries = $config->getDefinedValue('future_entries');
  $cl_uncompleted_indicators = $config->getDefinedValue('uncompleted_indicators');
  $cl_confirm_save = $config->getDefinedValue('confirm_save');
}

$form = new Form('groupForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$group_id));
if (count($groups) > 1) {
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'document.groupForm.group_changed.value=1;document.groupForm.submit();',
    'name'=>'group',
    'style'=>'width: 250px;',
    'value'=>$group_id,
    'data'=>$groups,
    'datakeys'=>array('id','name')));
  $form->addInput(array('type'=>'hidden','name'=>'group_changed'));
  $smarty->assign('group_dropdown', 1);
}
$form->addInput(array('type'=>'text','maxlength'=>'7','name'=>'currency','value'=>$cl_currency));

// Prepare an array of available languages.
$lang_files = I18n::getLangFileList();
foreach ($lang_files as $lfile) {
  $content = file(RESOURCE_DIR."/".$lfile);
  $lname = '';
  foreach ($content as $line) {
    if (strstr($line, 'i18n_language')) {
      $a = explode('=', $line);
      $lname = trim(str_replace(';','',str_replace("'","",$a[1])));
      break;
    }
  }
  unset($content);
  $longname_lang[] = array('id'=>I18n::getLangFromFilename($lfile),'name'=>$lname);
}
$longname_lang = mu_sort($longname_lang, 'name');
$form->addInput(array('type'=>'combobox','name'=>'lang','style'=>'width: 200px','data'=>$longname_lang,'datakeys'=>array('id','name'),'value'=>$cl_lang));

$DECIMAL_MARK_OPTIONS = array(array('id'=>'.','name'=>'.'),array('id'=>',','name'=>','));
$form->addInput(array('type'=>'combobox','name'=>'decimal_mark','style'=>'width: 150px','data'=>$DECIMAL_MARK_OPTIONS,'datakeys'=>array('id','name'),'value'=>$cl_decimal_mark,
  'onchange'=>'adjustDecimalPreview()'));

$DATE_FORMAT_OPTIONS = array(
  array('id'=>'%Y-%m-%d','name'=>'Y-m-d'),
  array('id'=>'%m/%d/%Y','name'=>'m/d/Y'),
  array('id'=>'%d-%m-%Y','name'=>'d-m-Y'),
  array('id'=>'%d.%m.%Y','name'=>'d.m.Y'),
  array('id'=>'%d.%m.%Y %a','name'=>'d.m.Y a'));
$form->addInput(array('type'=>'combobox','name'=>'date_format','style'=>'width: 150px;','data'=>$DATE_FORMAT_OPTIONS,'datakeys'=>array('id','name'),'value'=>$cl_date_format,
  'onchange'=>'MakeFormatPreview(&quot;date_format_preview&quot;, this);'));
$TIME_FORMAT_OPTIONS = array(
  array('id'=>'%H:%M','name'=>$i18n->get('form.group_edit.24_hours')),
  array('id'=>'%I:%M %p','name'=>$i18n->get('form.group_edit.12_hours')));
$form->addInput(array('type'=>'combobox','name'=>'time_format','style'=>'width: 150px;','data'=>$TIME_FORMAT_OPTIONS,'datakeys'=>array('id','name'),'value'=>$cl_time_format,
  'onchange'=>'MakeFormatPreview(&quot;time_format_preview&quot;, this);'));

// Prepare week start choices.
$week_start_options = array();
foreach ($i18n->weekdayNames as $id => $week_dn) {
  $week_start_options[] = array('id' => $id, 'name' => $week_dn);
}
$form->addInput(array('type'=>'combobox','name'=>'start_week','style'=>'width: 150px;','data'=>$week_start_options,'datakeys'=>array('id','name'),'value'=>$cl_start_week));

// Show holidays control.
$form->addInput(array('type'=>'text','name'=>'holidays','value'=>$cl_holidays));

// Prepare tracking mode choices.
$tracking_mode_options = array();
$tracking_mode_options[MODE_TIME] = $i18n->get('form.group_edit.mode_time');
$tracking_mode_options[MODE_PROJECTS] = $i18n->get('form.group_edit.mode_projects');
$tracking_mode_options[MODE_PROJECTS_AND_TASKS] = $i18n->get('form.group_edit.mode_projects_and_tasks');
$form->addInput(array('type'=>'combobox','name'=>'tracking_mode','style'=>'width: 150px;','data'=>$tracking_mode_options,'value'=>$cl_tracking_mode));
$form->addInput(array('type'=>'checkbox','name'=>'project_required','value'=>$cl_project_required));

// Prepare record type choices.
$record_type_options = array();
$record_type_options[TYPE_ALL] = $i18n->get('form.group_edit.type_all');
$record_type_options[TYPE_START_FINISH] = $i18n->get('form.group_edit.type_start_finish');
$record_type_options[TYPE_DURATION] = $i18n->get('form.group_edit.type_duration');
$form->addInput(array('type'=>'combobox','name'=>'record_type','style'=>'width: 150px;','data'=>$record_type_options,'value'=>$cl_record_type));

// Punch mode checkbox.
$form->addInput(array('type'=>'checkbox','name'=>'punch_mode','value'=>$cl_punch_mode));

// Allow overlap checkbox.
$form->addInput(array('type'=>'checkbox','name'=>'allow_overlap','value'=>$cl_allow_overlap));

// Future entries checkbox.
$form->addInput(array('type'=>'checkbox','name'=>'future_entries','value'=>$cl_future_entries));

// Uncompleted indicators checkbox.
$form->addInput(array('type'=>'checkbox','name'=>'uncompleted_indicators','value'=>$cl_uncompleted_indicators));

// Confirm save checkbox.
$form->addInput(array('type'=>'checkbox','name'=>'confirm_save','value'=>$cl_confirm_save));

$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
if ($user->can('delete_group')) $form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('button.delete')));

$form->setValueByElement('group_changed','');

if ($request->isPost()) {

  if ($request->getParameter('btn_delete')) {
    // Delete button pressed, redirect.
    header('Location: group_delete.php?id='.$group_id);
    exit();
  }

  if ($request->getParameter('btn_save')) {
    // Validate user input.
    if (!ttValidString($cl_currency, true)) $err->add($i18n->get('error.field'), $i18n->get('label.currency'));
    if (!ttValidHolidays($cl_holidays)) $err->add($i18n->get('error.field'), $i18n->get('form.group_edit.holidays'));
    // Finished validating user input.

    if ($err->no()) {
      // Update config.
      $config->setDefinedValue('punch_mode', $cl_punch_mode);
      $config->setDefinedValue('allow_overlap', $cl_allow_overlap);
      $config->setDefinedValue('future_entries', $cl_future_entries);
      $config->setDefinedValue('uncompleted_indicators', $cl_uncompleted_indicators);
      $config->setDefinedValue('confirm_save', $cl_confirm_save);

      if ($user->updateGroup(array(
        'group_id' => $group_id,
        'currency' => $cl_currency,
        'lang' => $cl_lang,
        'decimal_mark' => $cl_decimal_mark,
        'date_format' => $cl_date_format,
        'time_format' => $cl_time_format,
        'week_start' => $cl_start_week,
        'holidays' => $cl_holidays,
        'tracking_mode' => $cl_tracking_mode,
        'project_required' => $cl_project_required,
        'record_type' => $cl_record_type,
        'uncompleted_indicators' => $cl_uncompleted_indicators,
        'config' => $config->getConfig()))) {
        header('Location: success.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    }
  }
} // isPost

$smarty->assign('group_dropdown', count($groups) > 1);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="handlePluginCheckboxes();"');
$smarty->assign('title', $i18n->get('title.edit_group'));
$smarty->assign('content_page_name', 'group_edit.tpl');
$smarty->display('index.tpl');
