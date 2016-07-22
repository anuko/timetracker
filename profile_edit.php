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

// Access check.
if (!ttAccessCheck(right_data_entry|right_view_reports)) {
  header('Location: access_denied.php');
  exit();
}

if (!defined('CURRENCY_DEFAULT')) define('CURRENCY_DEFAULT', '$');
$can_change_login = $user->canManageTeam();

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_login = trim($request->getParameter('login'));
  if (!$auth->isPasswordExternal()) {
    $cl_password1 = $request->getParameter('password1');
    $cl_password2 = $request->getParameter('password2');
  }
  $cl_email = trim($request->getParameter('email'));

  if ($user->canManageTeam()) {
    $cl_team = trim($request->getParameter('team_name'));
    $cl_address = trim($request->getParameter('address'));
    $cl_currency = trim($request->getParameter('currency'));
    if (!$cl_currency) $cl_currency = CURRENCY_DEFAULT;
    $cl_lang = $request->getParameter('lang');
    $cl_decimal_mark = $request->getParameter('decimal_mark');
    $cl_custom_format_date = $request->getParameter('format_date');
    $cl_custom_format_time = $request->getParameter('format_time');
    $cl_start_week = $request->getParameter('start_week');
    $cl_tracking_mode = $request->getParameter('tracking_mode');
    $cl_record_type = $request->getParameter('record_type');
    $cl_charts = $request->getParameter('charts');
    $cl_clients = $request->getParameter('clients');
    $cl_client_required = $request->getParameter('client_required');
    $cl_invoices = $request->getParameter('invoices');
    $cl_custom_fields = $request->getParameter('custom_fields');
    $cl_expenses = $request->getParameter('expenses');
    $cl_tax_expenses = $request->getParameter('tax_expenses');
    $cl_notifications = $request->getParameter('notifications');
    $cl_locking = $request->getParameter('locking');
    $cl_quotas = $request->getParameter('quotas');
  }
} else {
  $cl_name = $user->name;
  $cl_login = $user->login;
  $cl_email = $user->email;
  if ($user->canManageTeam()) {
    $cl_team = $user->team;
    $cl_address = $user->address;
    $cl_currency = ($user->currency == ''? CURRENCY_DEFAULT : $user->currency);
    $cl_lang = $user->lang;
    $cl_decimal_mark = $user->decimal_mark;
    $cl_custom_format_date = $user->date_format;
    $cl_custom_format_time = $user->time_format;
    $cl_start_week = $user->week_start;
    $cl_tracking_mode = $user->tracking_mode;
    $cl_record_type = $user->record_type;

    // Which plugins do we have enabled?
    $plugins = explode(',', $user->plugins);
    $cl_charts = in_array('ch', $plugins);
    $cl_clients = in_array('cl', $plugins);
    $cl_client_required = in_array('cm', $plugins);
    $cl_invoices = in_array('iv', $plugins);
    $cl_custom_fields = in_array('cf', $plugins);    
    $cl_expenses = in_array('ex', $plugins);
    $cl_tax_expenses = in_array('et', $plugins);
    $cl_notifications = in_array('no', $plugins);
    $cl_locking = in_array('lk', $plugins);
    $cl_quotas = in_array('mq', $plugins);
  }
}

$form = new Form('profileForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>$cl_name));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'login','value'=>$cl_login,'enable'=>$can_change_login));
if (!$auth->isPasswordExternal()) {
  $form->addInput(array('type'=>'text','maxlength'=>'30','name'=>'password1','aspassword'=>true,'value'=>$cl_password1));
  $form->addInput(array('type'=>'text','maxlength'=>'30','name'=>'password2','aspassword'=>true,'value'=>$cl_password2));
}
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'email','value'=>$cl_email,'enable'=>$can_change_login));
if ($user->canManageTeam()) {
  $form->addInput(array('type'=>'text','maxlength'=>'200','name'=>'team_name','value'=>$cl_team));
  $form->addInput(array('type'=>'textarea','name'=>'address','maxlength'=>'255','style'=>'width: 350px;','cols'=>'55','rows'=>'4','value'=>$cl_address));
  $form->addInput(array('type'=>'text','maxlength'=>'7','name'=>'currency','value'=>$cl_currency));
  $DECIMAL_MARK_OPTIONS = array(array('id'=>'.','name'=>'.'),array('id'=>',','name'=>','));
  $form->addInput(array('type'=>'combobox','name'=>'decimal_mark','style'=>'width: 150px','data'=>$DECIMAL_MARK_OPTIONS,'datakeys'=>array('id','name'),'value'=>$cl_decimal_mark,
    'onchange'=>'adjustDecimalPreview()'));
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
  $form->addInput(array('type'=>'combobox','name'=>'lang','style'=>'width: 150px','data'=>$longname_lang,'datakeys'=>array('id','name'),'value'=>$cl_lang));
  $DATE_FORMAT_OPTIONS = array(
    array('id'=>'%Y-%m-%d','name'=>'Y-m-d'),
    array('id'=>'%m/%d/%Y','name'=>'m/d/Y'),
    array('id'=>'%d.%m.%Y','name'=>'d.m.Y'),
    array('id'=>'%d.%m.%Y %a','name'=>'d.m.Y a'));
  $form->addInput(array('type'=>'combobox','name'=>'format_date','style'=>'width: 150px;','data'=>$DATE_FORMAT_OPTIONS,'datakeys'=>array('id','name'),'value'=>$cl_custom_format_date,
    'onchange'=>'MakeFormatPreview(&quot;date_format_preview&quot;, this);'));
  $TIME_FORMAT_OPTIONS = array(
    array('id'=>'%H:%M','name'=>$i18n->getKey('form.profile.24_hours')),
    array('id'=>'%I:%M %p','name'=>$i18n->getKey('form.profile.12_hours')));
  $form->addInput(array('type'=>'combobox','name'=>'format_time','style'=>'width: 150px;','data'=>$TIME_FORMAT_OPTIONS,'datakeys'=>array('id','name'),'value'=>$cl_custom_format_time,
    'onchange'=>'MakeFormatPreview(&quot;time_format_preview&quot;, this);'));

  // Prepare week start choices.
  $week_start_options = array();
  foreach ($i18n->weekdayNames as $id => $week_dn) {
    $week_start_options[] = array('id' => $id, 'name' => $week_dn);
  }
  $form->addInput(array('type'=>'combobox','name'=>'start_week','style'=>'width: 150px;','data'=>$week_start_options,'datakeys'=>array('id','name'),'value'=>$cl_start_week));

  // Prepare tracking mode choices.
  $tracking_mode_options = array();
  $tracking_mode_options[MODE_TIME] = $i18n->getKey('form.profile.mode_time');
  $tracking_mode_options[MODE_PROJECTS] = $i18n->getKey('form.profile.mode_projects');
  $tracking_mode_options[MODE_PROJECTS_AND_TASKS] = $i18n->getKey('form.profile.mode_projects_and_tasks');
  $form->addInput(array('type'=>'combobox','name'=>'tracking_mode','style'=>'width: 150px;','data'=>$tracking_mode_options,'value'=>$cl_tracking_mode));

  // Prepare record type choices.
  $record_type_options = array();
  $record_type_options[TYPE_ALL] = $i18n->getKey('form.profile.type_all');
  $record_type_options[TYPE_START_FINISH] = $i18n->getKey('form.profile.type_start_finish');
  $record_type_options[TYPE_DURATION] = $i18n->getKey('form.profile.type_duration');
  $form->addInput(array('type'=>'combobox','name'=>'record_type','style'=>'width: 150px;','data'=>$record_type_options,'value'=>$cl_record_type));

  $form->addInput(array('type'=>'checkbox','name'=>'charts','data'=>1,'value'=>$cl_charts));
  $form->addInput(array('type'=>'checkbox','name'=>'clients','data'=>1,'value'=>$cl_clients,'onchange'=>'handlePluginCheckboxes()'));
  $form->addInput(array('type'=>'checkbox','name'=>'client_required','data'=>1,'value'=>$cl_client_required));

  $form->addInput(array('type'=>'checkbox','name'=>'invoices','data'=>1,'value'=>$cl_invoices));
  $form->addInput(array('type'=>'checkbox','name'=>'custom_fields','data'=>1,'value'=>$cl_custom_fields,'onchange'=>'handlePluginCheckboxes()'));
  $form->addInput(array('type'=>'checkbox','name'=>'expenses','data'=>1,'value'=>$cl_expenses,'onchange'=>'handlePluginCheckboxes()'));
  $form->addInput(array('type'=>'checkbox','name'=>'tax_expenses','data'=>1,'value'=>$cl_tax_expenses));
  $form->addInput(array('type'=>'checkbox','name'=>'notifications','data'=>1,'value'=>$cl_notifications,'onchange'=>'handlePluginCheckboxes()'));
  $form->addInput(array('type'=>'checkbox','name'=>'locking','data'=>1,'value'=>$cl_locking,'onchange'=>'handlePluginCheckboxes()'));
  $form->addInput(array('type'=>'checkbox','name'=>'quotas','data'=>1,'value'=>$cl_quotas,'onchange'=>'handlePluginCheckboxes()'));
}
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->getKey('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.person_name'));
  if ($can_change_login) {
    if (!ttValidString($cl_login)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.login'));

    // New login must be unique.
    if ($cl_login != $user->login && ttUserHelper::getUserByLogin($cl_login))
      $err->add($i18n->getKey('error.user_exists'));
  }
  if (!$auth->isPasswordExternal() && ($cl_password1 || $cl_password2)) {
    if (!ttValidString($cl_password1)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.password'));
    if (!ttValidString($cl_password2)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.confirm_password'));
    if ($cl_password1 !== $cl_password2)
      $err->add($i18n->getKey('error.not_equal'), $i18n->getKey('label.password'), $i18n->getKey('label.confirm_password'));
  }
  if (!ttValidEmail($cl_email, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.email'));
  if ($user->canManageTeam()) {
    if (!ttValidString($cl_team, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.team_name'));
    if (!ttValidString($cl_address, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.address'));
    if (!ttValidString($cl_currency, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.currency'));
  }
  // Finished validating user input.

  if ($err->no()) {
    $update_result = true;
    if ($user->canManageTeam()) {

      // Prepare plugins string.
      if ($cl_charts)
        $plugins .= ',ch';
      if ($cl_clients)
        $plugins .= ',cl';
      if ($cl_client_required)
        $plugins .= ',cm';
      if ($cl_invoices)
        $plugins .= ',iv';
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
      $plugins = trim($plugins, ',');

      $update_result = ttTeamHelper::update($user->team_id, array(
        'name' => $cl_team,
        'address' => $cl_address,
        'currency' => $cl_currency,
        'lang' => $cl_lang,
        'decimal_mark' => $cl_decimal_mark,
        'date_format' => $cl_custom_format_date,
        'time_format' => $cl_custom_format_time,
        'week_start' => $cl_start_week,
        'tracking_mode' => $cl_tracking_mode,
        'record_type' => $cl_record_type,
        'plugins' => $plugins));
    }
    if ($update_result) {
      $update_result = ttUserHelper::update($user->id, array(
        'name' => $cl_name,
        'login' => $cl_login,
        'password' => $cl_password1,
        'email' => $cl_email,
        'status' => ACTIVE));
    }
    if ($update_result) {
      header('Location: time.php');
      exit();
    } else
      $err->add($i18n->getKey('error.db'));
  }
} // isPost

$smarty->assign('auth_external', $auth->isPasswordExternal());
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="handlePluginCheckboxes()"');
$smarty->assign('title', $i18n->getKey('title.profile'));
$smarty->assign('content_page_name', 'profile_edit.tpl');
$smarty->display('index.tpl');
