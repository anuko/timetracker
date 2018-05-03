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
import('ttUserHelper');
import('ttRoleHelper');

// Access checks.
if (!(ttAccessAllowed('manage_basic_settings') || ttAccessAllowed('manage_advanced_settings'))) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$advanced_settings = $user->can('manage_advanced_settings');
if (!defined('CURRENCY_DEFAULT')) define('CURRENCY_DEFAULT', '$');

if ($request->isPost()) {
  $cl_group = trim($request->getParameter('group_name'));
  $cl_currency = trim($request->getParameter('currency'));
  if (!$cl_currency) $cl_currency = CURRENCY_DEFAULT;
  $cl_lang = $request->getParameter('lang');
  $cl_decimal_mark = $request->getParameter('decimal_mark');
  $cl_date_format = $request->getParameter('date_format');
  $cl_time_format = $request->getParameter('time_format');
  $cl_start_week = $request->getParameter('start_week');
  $cl_show_holidays = $request->getParameter('show_holidays');
  $cl_tracking_mode = $request->getParameter('tracking_mode');
  $cl_project_required = $request->getParameter('project_required');
  $cl_task_required = $request->getParameter('task_required');
  $cl_record_type = $request->getParameter('record_type');
  $cl_punch_mode = $request->getParameter('punch_mode');
  $cl_allow_overlap = $request->getParameter('allow_overlap');
  $cl_future_entries = $request->getParameter('future_entries');
  $cl_uncompleted_indicators = $request->getParameter('uncompleted_indicators');
  $cl_bcc_email = trim($request->getParameter('bcc_email'));
  $cl_allow_ip = trim($request->getParameter('allow_ip'));

  // Plugin checkboxes.
  $cl_charts = $request->getParameter('charts');
  $cl_clients = $request->getParameter('clients');
  $cl_client_required = $request->getParameter('client_required');
  $cl_invoices = $request->getParameter('invoices');
  $cl_paid_status = $request->getParameter('paid_status');
  $cl_custom_fields = $request->getParameter('custom_fields');
  $cl_expenses = $request->getParameter('expenses');
  $cl_tax_expenses = $request->getParameter('tax_expenses');
  $cl_notifications = $request->getParameter('notifications');
  $cl_locking = $request->getParameter('locking');
  $cl_quotas = $request->getParameter('quotas');
  $cl_week_view = $request->getParameter('week_view');
} else {
  $cl_group = $user->group;
  $cl_currency = ($user->currency == ''? CURRENCY_DEFAULT : $user->currency);
  $cl_lang = $user->lang;
  $cl_decimal_mark = $user->decimal_mark;
  $cl_date_format = $user->date_format;
  $cl_time_format = $user->time_format;
  $cl_start_week = $user->week_start;
  $cl_show_holidays = $user->show_holidays;
  $cl_tracking_mode = $user->tracking_mode;
  $cl_project_required = $user->project_required;
  $cl_task_required = $user->task_required;
  $cl_record_type = $user->record_type;
  $cl_punch_mode = $user->punch_mode;
  $cl_allow_overlap = $user->allow_overlap;
  $cl_future_entries = $user->future_entries;
  $cl_uncompleted_indicators = $user->uncompleted_indicators;
  $cl_bcc_email = $user->bcc_email;
  $cl_allow_ip = $user->allow_ip;

  // Which plugins do we have enabled?
  $plugins = explode(',', $user->plugins);
  $cl_charts = in_array('ch', $plugins);
  $cl_clients = in_array('cl', $plugins);
  $cl_client_required = in_array('cm', $plugins);
  $cl_invoices = in_array('iv', $plugins);
  $cl_paid_status = in_array('ps', $plugins);
  $cl_custom_fields = in_array('cf', $plugins);
  $cl_expenses = in_array('ex', $plugins);
  $cl_tax_expenses = in_array('et', $plugins);
  $cl_notifications = in_array('no', $plugins);
  $cl_locking = in_array('lk', $plugins);
  $cl_quotas = in_array('mq', $plugins);
  $cl_week_view = in_array('wv', $plugins);
}

$form = new Form('groupForm');
$form->addInput(array('type'=>'text','maxlength'=>'200','name'=>'group_name','value'=>$cl_group,'enable'=>$advanced_settings));
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

// Show holidays checkbox.
$form->addInput(array('type'=>'checkbox','name'=>'show_holidays','value'=>$cl_show_holidays));

// Prepare tracking mode choices.
$tracking_mode_options = array();
$tracking_mode_options[MODE_TIME] = $i18n->get('form.group_edit.mode_time');
$tracking_mode_options[MODE_PROJECTS] = $i18n->get('form.group_edit.mode_projects');
$tracking_mode_options[MODE_PROJECTS_AND_TASKS] = $i18n->get('form.group_edit.mode_projects_and_tasks');
$form->addInput(array('type'=>'combobox','name'=>'tracking_mode','style'=>'width: 150px;','data'=>$tracking_mode_options,'value'=>$cl_tracking_mode,'onchange'=>'handleTaskRequiredCheckbox()'));
$form->addInput(array('type'=>'checkbox','name'=>'project_required','value'=>$cl_project_required));
$form->addInput(array('type'=>'checkbox','name'=>'task_required','value'=>$cl_task_required));

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

// Add bcc email control.
if ($advanced_settings) {
  $form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'bcc_email','value'=>$cl_bcc_email));
  $form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'allow_ip','value'=>$cl_allow_ip));
}

// Plugin checkboxes.
$form->addInput(array('type'=>'checkbox','name'=>'charts','value'=>$cl_charts));
$form->addInput(array('type'=>'checkbox','name'=>'clients','value'=>$cl_clients,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'client_required','value'=>$cl_client_required));
$form->addInput(array('type'=>'checkbox','name'=>'invoices','value'=>$cl_invoices));
$form->addInput(array('type'=>'checkbox','name'=>'paid_status','value'=>$cl_paid_status));
$form->addInput(array('type'=>'checkbox','name'=>'custom_fields','value'=>$cl_custom_fields,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'expenses','value'=>$cl_expenses,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'tax_expenses','value'=>$cl_tax_expenses));
$form->addInput(array('type'=>'checkbox','name'=>'notifications','value'=>$cl_notifications,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'locking','value'=>$cl_locking,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'quotas','value'=>$cl_quotas,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'week_view','value'=>$cl_week_view,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
if ($user->can('delete_group')) $form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('button.delete')));

if ($request->isPost()) {

  if ($request->getParameter('btn_delete')) {
    // Delete button pressed, redirect.
    header('Location: group_delete.php?id='.$user->group_id);
    exit();
  }

  // Validate user input.
  if (!ttValidString($cl_group, true)) $err->add($i18n->get('error.field'), $i18n->get('label.group_name'));
  if (!ttValidString($cl_currency, true)) $err->add($i18n->get('error.field'), $i18n->get('label.currency'));
  if ($advanced_settings) {
    if (!ttValidEmail($cl_bcc_email, true)) $err->add($i18n->get('error.field'), $i18n->get('label.bcc'));
    if (!ttValidIP($cl_allow_ip, true)) $err->add($i18n->get('error.field'), $i18n->get('form.group_edit.allow_ip'));
  }
  // Finished validating user input.

  if ($err->no()) {
    // Prepare plugins string.
    if ($cl_charts)
      $plugins .= ',ch';
    if ($cl_clients)
      $plugins .= ',cl';
    if ($cl_client_required)
      $plugins .= ',cm';
    if ($cl_invoices)
      $plugins .= ',iv';
    if ($cl_paid_status)
      $plugins .= ',ps';
    if ($cl_custom_fields)
      $plugins .= ',cf';
    if ($cl_expenses)
      $plugins .= ',ex';
    if ($cl_tax_expenses)
      $plugins .= ',et';
    if ($cl_notifications)
      $plugins .= ',no';
    if ($cl_locking)
      $plugins .= ',lk';
    if ($cl_quotas)
      $plugins .= ',mq';
    if ($cl_week_view)
      $plugins .= ',wv';

    // Recycle week view plugin options as they are not configured on this page.
    $existing_plugins = explode(',', $user->plugins);
    if (in_array('wvn', $existing_plugins))
      $plugins .= ',wvn';
    if (in_array('wvl', $existing_plugins))
      $plugins .= ',wvl';
    if (in_array('wvns', $existing_plugins))
      $plugins .= ',wvns';

    $plugins = trim($plugins, ',');

    // Prepare config string.
    if ($cl_show_holidays)
      $config .= ',show_holidays';
    if ($cl_punch_mode)
      $config .= ',punch_mode';
    if ($cl_allow_overlap)
      $config .= ',allow_overlap';
    if ($cl_future_entries)
      $config .= ',future_entries';
    if ($cl_uncompleted_indicators)
      $config .= ',uncompleted_indicators';
    $config = trim($config, ',');

    if ($user->updateGroup(array(
      'name' => $cl_group,
      'currency' => $cl_currency,
      'lang' => $cl_lang,
      'decimal_mark' => $cl_decimal_mark,
      'date_format' => $cl_date_format,
      'time_format' => $cl_time_format,
      'week_start' => $cl_start_week,
      'tracking_mode' => $cl_tracking_mode,
      'project_required' => $cl_project_required,
      'task_required' => $cl_task_required,
      'record_type' => $cl_record_type,
      'uncompleted_indicators' => $cl_uncompleted_indicators,
      'bcc_email' => $cl_bcc_email,
      'allow_ip' => $cl_allow_ip,
      'plugins' => $plugins,
      'config' => $config))) {
      header('Location: time.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('auth_external', $auth->isPasswordExternal());
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="handleTaskRequiredCheckbox(); handlePluginCheckboxes();"');
$smarty->assign('title', $i18n->get('title.group'));
$smarty->assign('content_page_name', 'group_edit.tpl');
$smarty->display('index.tpl');
