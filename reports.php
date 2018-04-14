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
import('form.ActionForm');
import('DateAndTime');
import('ttTeamHelper');
import('Period');
import('ttProjectHelper');
import('ttFavReportHelper');
import('ttClientHelper');

// Access check.
if (!(ttAccessAllowed('view_own_reports') || ttAccessAllowed('view_reports') || ttAccessAllowed('view_all_reports'))) {
  header('Location: access_denied.php');
  exit();
}

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields($user->group_id);
  $smarty->assign('custom_fields', $custom_fields);
}

$form = new Form('reportForm');

// Get saved favorite reports for user.
$report_list = ttFavReportHelper::getReports($user->id);
$form->addInput(array('type'=>'combobox',
  'name'=>'favorite_report',
  'onchange'=>'document.reportForm.fav_report_changed.value=1;document.reportForm.submit();',
  'style'=>'width: 250px;',
  'data'=>$report_list,
  'datakeys'=>array('id','name'),
  'empty'=>array('-1'=>$i18n->get('dropdown.no'))));
$form->addInput(array('type'=>'hidden','name'=>'fav_report_changed'));
// Generate and Delete buttons.
$form->addInput(array('type'=>'submit','name'=>'btn_generate','value'=>$i18n->get('button.generate')));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete'),'onclick'=>"return confirm('".$i18n->get('form.reports.confirm_delete')."')"));

// Dropdown for clients if the clients plugin is enabled.
if ($user->isPluginEnabled('cl') && !$user->isClient()) {
  if ($user->can('view_reports') || $user->can('view_all_reports')) {
    $client_list = ttClientHelper::getClients(); // TODO: improve getClients for "view_reports"
                                                 // by filtering out not relevant clients.
  } else
    $client_list = ttClientHelper::getClientsForUser();
  $form->addInput(array('type'=>'combobox',
    'name'=>'client',
    'style'=>'width: 250px;',
    'data'=>$client_list,
    'datakeys'=>array('id', 'name'),
    'empty'=>array(''=>$i18n->get('dropdown.all'))));
}

// If we have a TYPE_DROPDOWN custom field - add control to select an option.
if ($custom_fields && $custom_fields->fields[0] && $custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN) {
    $form->addInput(array('type'=>'combobox','name'=>'option',
      'style'=>'width: 250px;',
      'value'=>$cl_cf_1,
      'data'=>$custom_fields->options,
      'empty'=>array(''=>$i18n->get('dropdown.all'))));
}

// Add controls for projects and tasks.
if ($user->can('view_reports') || $user->can('view_all_reports')) {
  $project_list = ttProjectHelper::getProjects(); // All active and inactive projects.
} elseif ($user->isClient()) {
  $project_list = ttProjectHelper::getProjectsForClient();
} else {
  $project_list = ttProjectHelper::getAssignedProjects($user->id);	
}
$form->addInput(array('type'=>'combobox',
  'onchange'=>'fillTaskDropdown(this.value);selectAssignedUsers(this.value);',
  'name'=>'project',
  'style'=>'width: 250px;',
  'data'=>$project_list,
  'datakeys'=>array('id','name'),
  'empty'=>array(''=>$i18n->get('dropdown.all'))));
if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  $task_list = ttTeamHelper::getActiveTasks($user->group_id);
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'style'=>'width: 250px;',
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.all'))));
}

// Add include records control.
$include_options = array('1'=>$i18n->get('form.reports.include_billable'),
  '2'=>$i18n->get('form.reports.include_not_billable'));
$form->addInput(array('type'=>'combobox',
  'name'=>'include_records',
  'style'=>'width: 250px;',
  'data'=>$include_options,
  'empty'=>array(''=>$i18n->get('dropdown.all'))));

// Add invoiced / not invoiced selector.
if ($user->can('manage_invoices')) {
  $invoice_options = array('1'=>$i18n->get('form.reports.include_invoiced'),
    '2'=>$i18n->get('form.reports.include_not_invoiced'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'invoice',
    'style'=>'width: 250px;',
    'data'=>$invoice_options,
    'empty'=>array(''=>$i18n->get('dropdown.all'))));
}

if ($user->can('manage_invoices') && $user->isPluginEnabled('ps')) {
  $form->addInput(array('type'=>'combobox',
   'name'=>'paid_status',
   'style'=>'width: 250px;',
   'data'=>array('1'=>$i18n->get('dropdown.paid'),'2'=>$i18n->get('dropdown.not_paid')),
   'empty'=>array(''=>$i18n->get('dropdown.all'))
 ));
}

$user_list = array();
if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) {
  // Prepare user and assigned projects arrays.
  if ($user->can('view_reports') || $user->can('view_all_reports')) {
    $max_rank = $user->rank-1;
    if ($user->can('view_all_reports')) $max_rank = 512;
    if ($user->can('view_own_reports'))
      $options = array('max_rank'=>$max_rank,'include_self'=>true);
    else
      $options = array('max_rank'=>$max_rank);
    $users = $user->getUsers($options); // Active and inactive users.
  }
  elseif ($user->isClient())
    $users = ttTeamHelper::getUsersForClient(); // Active and inactive users for clients.

  foreach ($users as $single_user) {
    $user_list[$single_user['id']] = $single_user['name'];
    $projects = ttProjectHelper::getAssignedProjects($single_user['id']);
    if ($projects) {
      foreach ($projects as $single_project) {
        $assigned_projects[$single_user['id']][] = $single_project['id'];
      }
    }
  }
  $row_count = ceil(count($user_list)/3);
  $form->addInput(array('type'=>'checkboxgroup',
    'name'=>'users',
    'data'=>$user_list,
    'layout'=>'V',
    'groupin'=>$row_count,
    'style'=>'width: 100%;'));
}

// Add control for time period.
$form->addInput(array('type'=>'combobox',
  'name'=>'period',
  'style'=>'width: 250px;',
  'data'=>array(INTERVAL_THIS_MONTH=>$i18n->get('dropdown.current_month'),
    INTERVAL_LAST_MONTH=>$i18n->get('dropdown.previous_month'),
    INTERVAL_THIS_WEEK=>$i18n->get('dropdown.current_week'),
    INTERVAL_LAST_WEEK=>$i18n->get('dropdown.previous_week'),
    INTERVAL_THIS_DAY=>$i18n->get('dropdown.current_day'),
    INTERVAL_LAST_DAY=>$i18n->get('dropdown.previous_day')),
  'empty'=>array(''=>$i18n->get('dropdown.select'))));
// Add controls for start and end dates.
$form->addInput(array('type'=>'datefield','maxlength'=>'20','name'=>'start_date'));
$form->addInput(array('type'=>'datefield','maxlength'=>'20','name'=>'end_date'));

// Add checkboxes for fields.
if ($user->isPluginEnabled('cl'))
  $form->addInput(array('type'=>'checkbox','name'=>'chclient'));
if (($user->can('manage_invoices') || $user->isClient()) && $user->isPluginEnabled('iv'))
  $form->addInput(array('type'=>'checkbox','name'=>'chinvoice'));
if ($user->can('manage_invoices') && $user->isPluginEnabled('ps'))
  $form->addInput(array('type'=>'checkbox','name'=>'chpaid'));
if ($user->can('view_reports') || $user->can('view_all_reports'))
  $form->addInput(array('type'=>'checkbox','name'=>'chip'));
if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
  $form->addInput(array('type'=>'checkbox','name'=>'chproject'));
if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
  $form->addInput(array('type'=>'checkbox','name'=>'chtask'));
if ((TYPE_START_FINISH == $user->record_type) || (TYPE_ALL == $user->record_type)) {
  $form->addInput(array('type'=>'checkbox','name'=>'chstart'));
  $form->addInput(array('type'=>'checkbox','name'=>'chfinish'));
}
$form->addInput(array('type'=>'checkbox','name'=>'chduration'));
$form->addInput(array('type'=>'checkbox','name'=>'chnote'));
$form->addInput(array('type'=>'checkbox','name'=>'chcost'));
// If we have a custom field - add a checkbox for it.
if ($custom_fields && $custom_fields->fields[0])
  $form->addInput(array('type'=>'checkbox','name'=>'chcf_1'));
// Add group by control.
$group_by_options['no_grouping'] = $i18n->get('form.reports.group_by_no');
$group_by_options['date'] = $i18n->get('form.reports.group_by_date');
if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient())
  $group_by_options['user'] = $i18n->get('form.reports.group_by_user');
if ($user->isPluginEnabled('cl') && !($user->isClient() && $user->client_id))
  $group_by_options['client'] = $i18n->get('form.reports.group_by_client');
if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
  $group_by_options['project'] = $i18n->get('form.reports.group_by_project');
if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
  $group_by_options['task'] = $i18n->get('form.reports.group_by_task');
if ($custom_fields && $custom_fields->fields[0] && $custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN) {
  $group_by_options['cf_1'] = $custom_fields->fields[0]['label'];
}
$form->addInput(array('type'=>'combobox','onchange'=>'handleCheckboxes();','name'=>'group_by','data'=>$group_by_options));
$form->addInput(array('type'=>'checkbox','name'=>'chtotalsonly'));

// Add text field for a new favorite report name.
$form->addInput(array('type'=>'text','name'=>'new_fav_report','maxlength'=>'30','style'=>'width: 250px;'));
// Save button.
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

$form->addInput(array('type'=>'submit','name'=>'btn_generate','value'=>$i18n->get('button.generate')));

// Create a bean (which is a mechanism to remember form values in session).
$bean = new ActionForm('reportBean', $form, $request);
// At this point form values are obtained from session if they are there.

if ($request->isGet() && !$bean->isSaved()) {
  // No previous form data were found in session. Use the following default values.
  $form->setValueByElement('users', array_keys($user_list));
  $period = new Period(INTERVAL_THIS_MONTH, new DateAndTime($user->date_format));
  $form->setValueByElement('start_date', $period->getStartDate());
  $form->setValueByElement('end_date', $period->getEndDate());
  $form->setValueByElement('chclient', '1');
  $form->setValueByElement('chinvoice', '0');
  $form->setValueByElement('chpaid', '0');
  $form->setValueByElement('chip', '0');
  $form->setValueByElement('chproject', '1');
  $form->setValueByElement('chstart', '1');
  $form->setValueByElement('chduration', '1');
  $form->setValueByElement('chcost', '0');
  $form->setValueByElement('chtask', '1');
  $form->setValueByElement('chfinish', '1');
  $form->setValueByElement('chnote', '1');
  $form->setValueByElement('chcf_1', '0');
  $form->setValueByElement('chtotalsonly', '0');
}

$form->setValueByElement('fav_report_changed','');

// Disable the Delete button when no favorite report is selected.
if (!$bean->getAttribute('favorite_report') || ($bean->getAttribute('favorite_report') == -1))
  $form->getElement('btn_delete')->setEnabled(false);

if ($request->isPost()) {
  if((!$bean->getAttribute('btn_generate') && ($request->getParameter('fav_report_changed')))) {
    // User changed favorite report. We need to load new values into the form.
    if ($bean->getAttribute('favorite_report')) {
      // This loads new favorite report options into the bean (into our form).
      ttFavReportHelper::loadReport($user->id, $bean);

      // If user selected no favorite report - mark all user checkboxes (most probable scenario).
      if ($bean->getAttribute('favorite_report') == -1)
        $form->setValueByElement('users', array_keys($user_list));

      // Save form data in session for future use.
      $bean->saveBean();
      header('Location: reports.php');
      exit();
    }
  } elseif ($bean->getAttribute('btn_save')) {
    // User clicked the Save button. We need to save form options as new favorite report.
    if (!ttValidString($bean->getAttribute('new_fav_report'))) $err->add($i18n->get('error.field'), $i18n->get('form.reports.save_as_favorite'));

    if ($err->no()) {
      $id = ttFavReportHelper::saveReport($user->id, $bean);
      if (!$id)
        $err->add($i18n->get('error.db'));
      if ($err->no()) {
        $bean->setAttribute('favorite_report', $id);
        $bean->saveBean();
        header('Location: reports.php');
        exit();
      }
    }
  } elseif($bean->getAttribute('btn_delete')) {
    // Delete button pressed. User wants to delete a favorite report.
    if ($bean->getAttribute('favorite_report')) {
      ttFavReportHelper::deleteReport($bean->getAttribute('favorite_report'));
      // Load default report.
      $bean->setAttribute('favorite_report','');
      $bean->setAttribute('new_fav_report', $report_list[0]['name']);
      ttFavReportHelper::loadReport($user->id, $bean);
      $form->setValueByElement('users', array_keys($user_list));
      $bean->saveBean();
      header('Location: reports.php');
      exit();
    }
  } else {
    // Generate button pressed. Check some values.
    if (!$bean->getAttribute('period')) {
      $start_date = new DateAndTime($user->date_format, $bean->getAttribute('start_date'));

      if ($start_date->isError() || !$bean->getAttribute('start_date'))
        $err->add($i18n->get('error.field'), $i18n->get('label.start_date'));

      $end_date = new DateAndTime($user->date_format, $bean->getAttribute('end_date'));
      if ($end_date->isError() || !$bean->getAttribute('end_date'))
        $err->add($i18n->get('error.field'), $i18n->get('label.end_date'));

      if ($start_date->compare($end_date) > 0)
        $err->add($i18n->get('error.interval'), $i18n->get('label.end_date'), $i18n->get('label.start_date'));
    }

    $bean->saveBean();

    if ($err->no()) {
      // Now we can go ahead and create a report.
      header('Location: report.php');
      exit();
    }
  }
} // isPost

$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('assigned_projects', $assigned_projects);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="handleCheckboxes()"');
$smarty->assign('title', $i18n->get('title.reports'));
$smarty->assign('content_page_name', 'reports.tpl');
$smarty->display('index.tpl');
