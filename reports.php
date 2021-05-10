<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('form.ActionForm');
import('DateAndTime');
import('ttGroupHelper');
import('Period');
import('ttProjectHelper');
import('ttFavReportHelper');
import('ttClientHelper');
import('ttReportHelper');

// Access check.
if (!(ttAccessAllowed('view_own_reports') || ttAccessAllowed('view_reports') || ttAccessAllowed('view_all_reports') || ttAccessAllowed('view_client_reports'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->exists()) {
  header('Location: access_denied.php'); // No users in subgroup.
  exit();
}
// End of access checks.

$trackingMode = $user->getTrackingMode();

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields();
  $smarty->assign('custom_fields', $custom_fields);
}

$form = new Form('reportForm');

// Get saved favorite reports for user.
$report_list = ttFavReportHelper::getReports();
$form->addInput(array('type'=>'combobox',
  'name'=>'favorite_report',
  'onchange'=>'this.form.fav_report_changed.value=1;this.form.submit();',
  'data'=>$report_list,
  'datakeys'=>array('id','name'),
  'empty'=>array('-1'=>$i18n->get('dropdown.no'))));
$form->addInput(array('type'=>'hidden','name'=>'fav_report_changed'));
// Generate and Delete buttons.
$form->addInput(array('type'=>'submit','name'=>'btn_generate','value'=>$i18n->get('button.generate')));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete'),'onclick'=>"return confirm('".$i18n->get('form.reports.confirm_delete')."')"));

// Dropdown for clients if the clients plugin is enabled.
$showClient = $user->isPluginEnabled('cl') && !$user->isClient();
$client_list = array();
if ($showClient) {
  if ($user->can('view_reports') || $user->can('view_all_reports')) {
    $client_list = ttClientHelper::getClients(); // TODO: improve getClients for "view_reports"
                                                 // by filtering out not relevant clients.
  } else
    $client_list = ttClientHelper::getClientsForUser();
  if (count($client_list) == 0) $showClient = false;
}
if ($showClient) {
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillProjectDropdown(this.value);',
    'name'=>'client',
    'data'=>$client_list,
    'datakeys'=>array('id', 'name'),
    'empty'=>array(''=>$i18n->get('dropdown.all'))));
}

// Add project dropdown.
$showProject = MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode;
$project_list = array();
if ($showProject) {
  if ($user->can('view_reports') || $user->can('view_all_reports')) {
    $project_list = ttProjectHelper::getProjects(); // All active and inactive projects.
  } elseif ($user->isClient()) {
    $project_list = ttProjectHelper::getProjectsForClient();
  } else {
    $project_list = ttProjectHelper::getAssignedProjects($user->getUser());
  }
  if (count($project_list) == 0) $showProject = false;
}
if ($showProject) {
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillTaskDropdown(this.value);selectAssignedUsers(this.value);',
    'name'=>'project',
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.all'))));
}

// Add task dropdown.
$showTask = MODE_PROJECTS_AND_TASKS == $trackingMode;
$task_list = array();
if ($showTask) {
  $task_list = ttGroupHelper::getActiveTasks();
  if (count($task_list) == 0) $showTask = false;
}
if ($showTask) {
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.all'))));
}

// Add billable dropdown.
$showBillable = $user->isPluginEnabled('iv');
if ($showBillable) {
  $include_options = array('1'=>$i18n->get('form.reports.include_billable'),
    '2'=>$i18n->get('form.reports.include_not_billable'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'include_records', // TODO: how about a better name here?
    'data'=>$include_options,
    'empty'=>array(''=>$i18n->get('dropdown.all'))));
}

// Add invoiced / not invoiced selector.
$showInvoiceDropdown = $user->isPluginEnabled('iv') && $user->can('manage_invoices');
if ($showInvoiceDropdown) {
  $invoice_options = array('1'=>$i18n->get('form.reports.include_invoiced'),
    '2'=>$i18n->get('form.reports.include_not_invoiced'));
  $form->addInput(array('type'=>'combobox',
    'name'=>'invoice',
    'data'=>$invoice_options,
    'empty'=>array(''=>$i18n->get('dropdown.all'))));
}
$showInvoiceCheckbox = $user->isPluginEnabled('iv') && ($user->can('manage_invoices') || $user->isClient());

// Add paid status selector.
$showPaidStatus = $user->isPluginEnabled('ps') && $user->can('manage_invoices');
if ($showPaidStatus) {
  $form->addInput(array('type'=>'combobox',
   'name'=>'paid_status',
   'data'=>array('1'=>$i18n->get('dropdown.paid'),'2'=>$i18n->get('dropdown.not_paid')),
   'empty'=>array(''=>$i18n->get('dropdown.all'))
 ));
}

// Add approved / not approved selector.
$showApproved = $user->isPluginEnabled('ap') &&
  ($user->can('view_own_reports') || $user->can('view_reports') ||
   $user->can('view_all_reports') || ($user->can('view_client_reports') && $user->can('view_client_unapproved')));
if ($showApproved) {
  $form->addInput(array('type'=>'combobox',
   'name'=>'approved',
   'data'=>array('1'=>$i18n->get('dropdown.approved'),'2'=>$i18n->get('dropdown.not_approved')),
   'empty'=>array(''=>$i18n->get('dropdown.all'))
  ));
}

// Add timesheet assignment selector.
$showTimesheetDropdown = $user->isPluginEnabled('ts');
if ($showTimesheetDropdown) {
  $form->addInput(array('type'=>'combobox',
   'name'=>'timesheet',
   'data'=>array(TIMESHEET_NOT_ASSIGNED=>$i18n->get('form.reports.include_not_assigned'),
     TIMESHEET_ASSIGNED=>$i18n->get('form.reports.include_assigned'),
     TIMESHEET_PENDING=>$i18n->get('form.reports.include_pending'),
     TIMESHEET_APPROVED=>$i18n->get('dropdown.approved'),
     TIMESHEET_NOT_APPROVED=>$i18n->get('dropdown.not_approved')),
   'empty'=>array(''=>$i18n->get('dropdown.all'))
  ));
}
$showTimesheetCheckbox = $user->isPluginEnabled('ts');

// Add user table.
$showUsers = $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient();
$user_list = $user_list_active = $user_list_inactive = array();
if ($showUsers) {
  // Prepare user and assigned projects arrays.
  if ($user->can('view_reports') || $user->can('view_all_reports')) {
    $rank = $user->getMaxRankForGroup($user->getGroup());
    if ($user->can('view_all_reports')) $max_rank = MAX_RANK;
    if ($user->can('view_own_reports')) {
      $options_active = array('max_rank'=>$max_rank,'include_self'=>true,'status'=>ACTIVE);
      $options_inactive = array('max_rank'=>$max_rank,'include_self'=>true,'status'=>INACTIVE);
    } else {
      $options_active = array('max_rank'=>$max_rank,'status'=>ACTIVE);
      $options_inactive = array('max_rank'=>$max_rank,'status'=>INACTIVE);
    }
    $active_users = $user->getUsers($options_active);
    $inactive_users = $user->getUsers($options_inactive);
  }
  elseif ($user->isClient()) {
    $options_active = array('status'=>ACTIVE);
    $options_inactive = array('status'=>INACTIVE);
    $active_users = ttGroupHelper::getUsersForClient($options_active);
    $inactive_users = ttGroupHelper::getUsersForClient($options_inactive);
  }

  foreach ($active_users as $single_user) {
    $user_list_active[$single_user['id']] = $single_user['name'];
    $projects = ttProjectHelper::getAssignedProjects($single_user['id']);
    if ($projects) {
      foreach ($projects as $single_project) {
        $assigned_projects[$single_user['id']][] = $single_project['id'];
      }
    }
  }
  $row_count = is_array($user_list_active) ? ceil(count($user_list_active)/3) : 1;
  $form->addInput(array('type'=>'checkboxgroup',
    'name'=>'users_active',
    'data'=>$user_list_active,
    'layout'=>'V',
    'groupin'=>$row_count));

  foreach ($inactive_users as $single_user) {
    $user_list_inactive[$single_user['id']] = $single_user['name'];
    $projects = ttProjectHelper::getAssignedProjects($single_user['id']);
    if ($projects) {
      foreach ($projects as $single_project) {
        $assigned_projects[$single_user['id']][] = $single_project['id'];
      }
    }
  }
  $row_count = ceil(count($user_list_inactive)/3);
  $form->addInput(array('type'=>'checkboxgroup',
    'name'=>'users_inactive',
    'data'=>$user_list_inactive,
    'layout'=>'V',
    'groupin'=>$row_count));
}

// Add control for time period.
$form->addInput(array('type'=>'combobox',
  'name'=>'period',
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

// Add checkboxes for "Show fields" block.
if ($showClient)
  $form->addInput(array('type'=>'checkbox','name'=>'chclient'));
if ($showProject)
  $form->addInput(array('type'=>'checkbox','name'=>'chproject'));
if ($showTask)
  $form->addInput(array('type'=>'checkbox','name'=>'chtask'));
if ($showInvoiceCheckbox)
  $form->addInput(array('type'=>'checkbox','name'=>'chinvoice'));
if ($showPaidStatus)
  $form->addInput(array('type'=>'checkbox','name'=>'chpaid'));
$showIP = $user->can('view_reports') || $user->can('view_all_reports');
if ($showIP)
  $form->addInput(array('type'=>'checkbox','name'=>'chip'));
$recordType = $user->getRecordType();
$showStart = TYPE_START_FINISH == $recordType || TYPE_ALL == $recordType;
$showFinish = $showStart;
if ($showStart)
  $form->addInput(array('type'=>'checkbox','name'=>'chstart'));
if ($showFinish)
  $form->addInput(array('type'=>'checkbox','name'=>'chfinish'));
$form->addInput(array('type'=>'checkbox','name'=>'chduration'));
$form->addInput(array('type'=>'checkbox','name'=>'chnote'));
$form->addInput(array('type'=>'checkbox','name'=>'chcost'));
$showWorkUnits = $user->isPluginEnabled('wu');
if ($showWorkUnits)
  $form->addInput(array('type'=>'checkbox','name'=>'chunits'));
if ($showTimesheetCheckbox)
  $form->addInput(array('type'=>'checkbox','name'=>'chtimesheet'));
if ($showApproved)
  $form->addInput(array('type'=>'checkbox','name'=>'chapproved'));
$showFiles = $user->isPluginEnabled('at');
if ($showFiles)
  $form->addInput(array('type'=>'checkbox','name'=>'chfiles'));

// Add a hidden control for timesheet_user_id (who to generate a timesheet for).
if ($showTimesheetCheckbox)
  $form->addInput(array('type'=>'hidden','name'=>'timesheet_user_id'));

// If we have time custom fields - add controls for them.
if (isset($custom_fields) && $custom_fields->timeFields) {
  foreach ($custom_fields->timeFields as $timeField) {
    $field_name = 'time_field_'.$timeField['id'];
    $checkbox_field_name = 'show_'.$field_name;
    if ($timeField['type'] == CustomFields::TYPE_TEXT) {
      $form->addInput(array('type'=>'text','name'=>$field_name));
    } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
      $form->addInput(array('type'=>'combobox','name'=>$field_name,
      'data'=>CustomFields::getOptions($timeField['id']),
      'empty'=>array(''=>$i18n->get('dropdown.all'))));
    }
    // Also add a checkbox (to print the field or not).
    $form->addInput(array('type'=>'checkbox','name'=>$checkbox_field_name));
  }
}

// If we have user custom fields - add controls for them.
if (isset($custom_fields) && $custom_fields->userFields) {
  foreach ($custom_fields->userFields as $userField) {
    $field_name = 'user_field_'.$userField['id'];
    $checkbox_field_name = 'show_'.$field_name;
    if ($userField['type'] == CustomFields::TYPE_TEXT) {
      $form->addInput(array('type'=>'text','name'=>$field_name,));
    } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
      $form->addInput(array('type'=>'combobox','name'=>$field_name,
      'data'=>CustomFields::getOptions($userField['id']),
      'empty'=>array(''=>$i18n->get('dropdown.all'))));
    }
    // Also add a checkbox (to print the field or not).
    $form->addInput(array('type'=>'checkbox','name'=>$checkbox_field_name));
  }
}

// Add group by control.
$group_by_options['no_grouping'] = $i18n->get('form.reports.group_by_no');
$group_by_options['date'] = $i18n->get('form.reports.group_by_date');
if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient())
  $group_by_options['user'] = $i18n->get('form.reports.group_by_user');
if ($user->isPluginEnabled('cl') && !($user->isClient() && $user->client_id))
  $group_by_options['client'] = $i18n->get('form.reports.group_by_client');
if (MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode)
  $group_by_options['project'] = $i18n->get('form.reports.group_by_project');
if (MODE_PROJECTS_AND_TASKS == $trackingMode)
  $group_by_options['task'] = $i18n->get('form.reports.group_by_task');
// If we have time custom fields - add group by options for them.
if (isset($custom_fields) && $custom_fields->timeFields) {
  foreach ($custom_fields->timeFields as $timeField) {
    $field_name = 'time_field_'.$timeField['id'];
    $group_by_options[$field_name] = $timeField['label'];
  }
}
// If we have user custom fields - add group by options for them.
if (isset($custom_fields) && $custom_fields->userFields) {
  foreach ($custom_fields->userFields as $userField) {
    $field_name = 'user_field_'.$userField['id'];
    $group_by_options[$field_name] = $userField['label'];
  }
}
$group_by_options_size = sizeof($group_by_options);
$form->addInput(array('type'=>'combobox','onchange'=>'handleCheckboxes();','name'=>'group_by1','data'=>$group_by_options));
if ($group_by_options_size > 2) $form->addInput(array('type'=>'combobox','onchange'=>'handleCheckboxes();','name'=>'group_by2','data'=>$group_by_options));
if ($group_by_options_size > 3) $form->addInput(array('type'=>'combobox','onchange'=>'handleCheckboxes();','name'=>'group_by3','data'=>$group_by_options));
$form->addInput(array('type'=>'checkbox','name'=>'chtotalsonly'));

// Add text field for a new favorite report name.
$form->addInput(array('type'=>'text','name'=>'new_fav_report','maxlength'=>'30'));
// Save button.
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

$form->addInput(array('type'=>'submit','name'=>'btn_generate','value'=>$i18n->get('button.generate')));

// Create a bean (which is a mechanism to remember form values in session).
$bean = new ActionForm('reportBean', $form, $request);
// At this point form values are obtained from session if they are there.

if ($request->isGet() && !$bean->isSaved()) {
  // No previous form data were found in session. Use the following default values.
  $form->setValueByElement('users_active', array_keys((array)$user_list_active));
  $period = new Period(INTERVAL_THIS_MONTH, new DateAndTime($user->getDateFormat()));
  $form->setValueByElement('start_date', $period->getStartDate());
  $form->setValueByElement('end_date', $period->getEndDate());

  $form->setValueByElement('chclient', '1');
  $form->setValueByElement('chstart', '1');
  $form->setValueByElement('chfinish', '1');
  $form->setValueByElement('chduration', '1');

  $form->setValueByElement('chproject', '1');
  $form->setValueByElement('chtask', '1');
  $form->setValueByElement('chnote', '1');
  $form->setValueByElement('chcost', '0');

  $form->setValueByElement('chtimesheet', '0');
  $form->setValueByElement('chip', '0');
  $form->setValueByElement('chapproved', '0');
  $form->setValueByElement('chpaid', '0');

  $form->setValueByElement('chunits', '0');
  $form->setValueByElement('chinvoice', '0');
  $form->setValueByElement('chfiles', '1');

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
      ttFavReportHelper::loadReport($bean);

      // If user selected no favorite report - mark all user checkboxes (most probable scenario).
      if ($bean->getAttribute('favorite_report') == -1) {
        $form->setValueByElement('users_active', array_keys($user_list_active));
        $form->setValueByElement('users_inactive', false);
      }

      // Save form data in session for future use.
      $bean->saveBean();
      header('Location: reports.php');
      exit();
    }
  } elseif ($bean->getAttribute('btn_save')) {
    // User clicked the Save button. We need to save form options as new favorite report.
    if (!ttValidString($bean->getAttribute('new_fav_report'))) $err->add($i18n->get('error.field'), $i18n->get('form.reports.save_as_favorite'));

    if ($err->no()) {
      $id = ttFavReportHelper::saveReport($bean);
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
      ttFavReportHelper::loadReport($bean);
      $form->setValueByElement('users', array_keys($user_list));
      $bean->saveBean();
      header('Location: reports.php');
      exit();
    }
  } else {
    // Generate button pressed. Check some values.
    if (!$bean->getAttribute('period')) {
      $start_date = new DateAndTime($user->getDateFormat(), $bean->getAttribute('start_date'));

      if ($start_date->isError() || !$bean->getAttribute('start_date'))
        $err->add($i18n->get('error.field'), $i18n->get('label.start_date'));

      $end_date = new DateAndTime($user->getDateFormat(), $bean->getAttribute('end_date'));
      if ($end_date->isError() || !$bean->getAttribute('end_date'))
        $err->add($i18n->get('error.field'), $i18n->get('label.end_date'));

      if ($start_date->compare($end_date) > 0)
        $err->add($i18n->get('error.interval'), $i18n->get('label.end_date'), $i18n->get('label.start_date'));
    }
    $group_by1 = $bean->getAttribute('group_by1');
    $group_by2 = $bean->getAttribute('group_by2');
    $group_by3 = $bean->getAttribute('group_by3');
    if (($group_by3 != null && $group_by3 != 'no_grouping') && ($group_by3 == $group_by1 || $group_by3 == $group_by2))
      $err->add($i18n->get('error.field'), $i18n->get('form.reports.group_by'));
    if (($group_by2 != null && $group_by2 != 'no_grouping') && ($group_by2 == $group_by1 || $group_by3 == $group_by2))
      $err->add($i18n->get('error.field'), $i18n->get('form.reports.group_by'));
    // Check remaining values.
    if (!ttReportHelper::verifyBean($bean)) $err->add($i18n->get('error.sys'));

    if ($err->no()) {
      $bean->saveBean();
      // Now we can go ahead and create a report.
      header('Location: report.php');
      exit();
    }
  }
} // isPost

$smarty->assign('client_list', $client_list);
$smarty->assign('show_client', $showClient);
$smarty->assign('show_project', $showProject);
$smarty->assign('show_task', $showTask);
$smarty->assign('show_billable', $showBillable);
$smarty->assign('show_approved', $showApproved);
$smarty->assign('show_invoice_dropdown', $showInvoiceDropdown);
$smarty->assign('show_invoice_checkbox', $showInvoiceCheckbox);
$smarty->assign('show_paid_status', $showPaidStatus);
$smarty->assign('show_timesheet_dropdown', $showTimesheetDropdown);
$smarty->assign('show_timesheet_checkbox', $showTimesheetCheckbox);
$smarty->assign('show_active_users', $showUsers && $active_users);
$smarty->assign('show_inactive_users', $showUsers && $inactive_users);
$smarty->assign('show_start', $showStart);
$smarty->assign('show_finish', $showFinish);
$smarty->assign('show_work_units', $showWorkUnits);
$smarty->assign('show_ip', $showIP);
$smarty->assign('show_files', $showFiles);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('assigned_projects', $assigned_projects);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="handleCheckboxes();fillDropdowns()"');
$smarty->assign('title', $i18n->get('title.reports'));
$smarty->assign('content_page_name', 'reports.tpl');
$smarty->display('index.tpl');
