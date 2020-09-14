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

require_once('../initialize.php');
import('form.Form');
import('ttUserHelper');
import('ttGroupHelper');
import('ttClientHelper');
import('ttConfigHelper');
import('ttTimeHelper');
import('DateAndTime');

// Access checks.
if (!ttAccessAllowed('track_own_time')) {
  header('Location: access_denied.php');
  exit();
}
if ($user->behalf_id && (!$user->can('track_time') || !$user->checkBehalfId())) {
  header('Location: access_denied.php'); // Trying on behalf, but no right or wrong user.
  exit();
}
if (!$user->behalf_id && !$user->can('track_own_time') && !$user->adjustBehalfId()) {
  header('Location: access_denied.php'); // Trying as self, but no right for self, and noone to work on behalf.
  exit();
}
if ($request->isPost()) {
  $userChanged = $request->getParameter('user_changed'); // Reused in multiple places below.
  if ($userChanged && !($user->can('track_time') && $user->isUserValid($request->getParameter('user')))) {
    header('Location: access_denied.php'); // User changed, but no right or wrong user id.
    exit();
  }
}
// End of access checks.

// Determine user for whom we display this page.
if ($request->isPost() && $userChanged) {
  $user_id = $request->getParameter('user');
  $user->setOnBehalfUser($user_id);
} else {
  $user_id = $user->getUser();
}

$group_id = $user->getGroup();
$config = new ttConfigHelper($user->getConfig());

$showClient = $user->isPluginEnabled('cl');
$showBillable = $user->isPluginEnabled('iv');
$trackingMode = $user->getTrackingMode();
$showProject = MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode;
$showTask = MODE_PROJECTS_AND_TASKS == $trackingMode;
if ($showTask) $taskRequired = $config->getDefinedValue('task_required');
$recordType = $user->getRecordType();
$showStart = TYPE_START_FINISH == $recordType || TYPE_ALL == $recordType;
$showDuration = TYPE_DURATION == $recordType || TYPE_ALL == $recordType;

// Initialize and store date in session.
$cl_date = $request->getParameter('date', @$_SESSION['date']);
$selected_date = new DateAndTime(DB_DATEFORMAT, $cl_date);
if($selected_date->isError())
  $selected_date = new DateAndTime(DB_DATEFORMAT);
if(!$cl_date)
  $cl_date = $selected_date->toString(DB_DATEFORMAT);
$_SESSION['date'] = $cl_date;

// Determine previous and next dates for simple navigation.
$prev_date = date('Y-m-d', strtotime('-1 day', strtotime($cl_date)));
$next_date = date('Y-m-d', strtotime('+1 day', strtotime($cl_date)));

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('../plugins/CustomFields.class.php');
  $custom_fields = new CustomFields();
  $smarty->assign('custom_fields', $custom_fields);
}

// Initialize variables.
$cl_start = trim($request->getParameter('start'));
$cl_finish = trim($request->getParameter('finish'));
$cl_duration = trim($request->getParameter('duration'));
$cl_note = trim($request->getParameter('note'));
$cl_billable = 1;
if ($showBillable) {
  if ($request->isPost()) {
    $cl_billable = $request->getParameter('billable');
    $_SESSION['billable'] = (int) $cl_billable;
  } else 
    if (isset($_SESSION['billable']))
      $cl_billable = $_SESSION['billable'];
}
$cl_client = $request->getParameter('client', ($request->isPost() ? null : @$_SESSION['client']));
$_SESSION['client'] = $cl_client;
$cl_project = $request->getParameter('project', ($request->isPost() ? null : @$_SESSION['project']));
$_SESSION['project'] = $cl_project;
$cl_task = $request->getParameter('task', ($request->isPost() ? null : @$_SESSION['task']));
$_SESSION['task'] = $cl_task;

// Handle time custom fields.
$timeCustomFields = array();
if ($custom_fields && $custom_fields->timeFields) {
  foreach ($custom_fields->timeFields as $timeField) {
    $control_name = 'time_field_'.$timeField['id'];
    $cl_control_name = $request->getParameter($control_name, ($request->isPost() ? null : @$_SESSION[$control_name]));
    $_SESSION[$control_name] = $cl_control_name;
    $timeCustomFields[$timeField['id']] = array('field_id' => $timeField['id'],
      'control_name' => $control_name,
      'label' => $timeField['label'],
      'type' => $timeField['type'],
      'required' => $timeField['required'],
      'value' => trim($cl_control_name));
  }
}

// Elements of timeRecordForm.
$form = new Form('timeRecordForm');

// Dropdown for user and a hidden control to indicate user change.
if ($user->can('track_time')) {
  $rank = $user->getMaxRankForGroup($group_id);
  if ($user->can('track_own_time'))
    $options = array('status'=>ACTIVE,'max_rank'=>$rank,'include_self'=>true,'self_first'=>true);
  else
    $options = array('status'=>ACTIVE,'max_rank'=>$rank);
  $user_list = $user->getUsers($options);
  if (count($user_list) >= 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'document.timeRecordForm.user_changed.value=1;document.timeRecordForm.submit();',
      'name'=>'user',
      'style'=>'width: 250px;',
      'value'=>$user_id,
      'data'=>$user_list,
      'datakeys'=>array('id','name')));
    $form->addInput(array('type'=>'hidden','name'=>'user_changed'));
    $smarty->assign('user_dropdown', 1);
  }
}

// Dropdown for clients in MODE_TIME. Use all active clients.
// Note: for other tracking modes the control is added further below.
if (MODE_TIME == $trackingMode && $showClient) {
    $active_clients = ttGroupHelper::getActiveClients(true);
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'value'=>$cl_client,
      'data'=>$active_clients,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
  // Note: in other modes the client list is filtered to relevant clients only. See below.
}

// Billable checkbox.
if ($showBillable)
  $form->addInput(array('type'=>'checkbox','name'=>'billable','value'=>$cl_billable));

// If we have time custom fields - add controls for them.
if ($custom_fields && $custom_fields->timeFields) {
  foreach ($custom_fields->timeFields as $timeField) {
    $field_name = 'time_field_'.$timeField['id'];
    if ($timeField['type'] == CustomFields::TYPE_TEXT) {
      $form->addInput(array('type'=>'text','name'=>$field_name,'style'=>'width: 250px;','value'=>$timeCustomFields[$timeField['id']]['value']));
    } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
      $form->addInput(array('type'=>'combobox','name'=>$field_name,
      'style'=>'width: 250px;',
      'data'=>CustomFields::getOptions($timeField['id']),
      'value'=>$timeCustomFields[$timeField['id']]['value'],
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
    }
  }
}

// If we show project dropdown, add controls for project and client.
if ($showProject) {
  // Dropdown for projects assigned to user.
  $options['include_templates'] = $user->isPluginEnabled('tp') && $config->getDefinedValue('bind_templates_with_projects');
  $project_list = $user->getAssignedProjects($options);
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillTaskDropdown(this.value);fillTemplateDropdown(this.value);prepopulateNote();',
    'name'=>'project',
    'style'=>'width: 250px;',
    'value'=>$cl_project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));

  // Client dropdown.
  if ($showClient) {
    $active_clients = ttGroupHelper::getActiveClients(true);
    // We need an array of assigned project ids to do some trimming. 
    foreach($project_list as $project)
      $projects_assigned_to_user[] = $project['id'];

    // Build a client list out of active clients. Use only clients that are relevant to user.
    // Also trim their associated project list to only assigned projects (to user).
    foreach($active_clients as $client) {
      $projects_assigned_to_client = explode(',', $client['projects']);
      if (is_array($projects_assigned_to_client) && is_array($projects_assigned_to_user))
        $intersection = array_intersect($projects_assigned_to_client, $projects_assigned_to_user);
      if ($intersection) {
        $client['projects'] = implode(',', $intersection);
        $client_list[] = $client;
      }
    }
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'value'=>$cl_client,
      'data'=>$client_list,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
  }
}

// Task dropdown.
if ($showTask) {
  $task_list = ttGroupHelper::getActiveTasks();
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'style'=>'width: 250px;',
    'value'=>$cl_task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));
}

// Start and finish controls.
if ($showStart) {
  $form->addInput(array('type'=>'text','name'=>'start','value'=>$cl_start,'onchange'=>"formDisable('start');"));
  $form->addInput(array('type'=>'text','name'=>'finish','value'=>$cl_finish,'onchange'=>"formDisable('finish');"));
  if ($user->punch_mode && !$user->canOverridePunchMode()) {
    // Make the start and finish fields read-only.
    $form->getElement('start')->setEnabled(false);
    $form->getElement('finish')->setEnabled(false);
  }
}

// Duration control.
if ($showDuration)
  $form->addInput(array('type'=>'text','name'=>'duration','value'=>$cl_duration,'onchange'=>"formDisable('duration');"));

// If we have templates, add a dropdown to select one.
if ($user->isPluginEnabled('tp')){
  $template_list = ttGroupHelper::getActiveTemplates();
  if (count($template_list) >= 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillNote(this.value);',
      'name'=>'template',
      'style'=>'width: 250px;',
      'data'=>$template_list,
      'datakeys'=>array('id','name'),
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
    $smarty->assign('template_dropdown', 1);
    $smarty->assign('bind_templates_with_projects', $config->getDefinedValue('bind_templates_with_projects'));
    $smarty->assign('prepopulate_note', $config->getDefinedValue('prepopulate_note'));
    $smarty->assign('template_list', $template_list);
  }
}

// Note control.
$form->addInput(array('type'=>'textarea','name'=>'note','style'=>'width: 250px; height: 60px;','value'=>$cl_note));

// A hidden control for today's date from user's browser.
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_submit click.

// Submit button.
$form->addInput(array('type'=>'submit','name'=>'btn_submit','onclick'=>'browser_today.value=get_date()','value'=>$i18n->get('button.submit')));

if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {
    // Submit button clicked.
    // Validate user input.
    if ($showClient && $user->isOptionEnabled('client_required') && !$cl_client)
      $err->add($i18n->get('error.client'));
    // Validate input in time custom fields.
    if ($custom_fields && $custom_fields->timeFields) {
      foreach ($timeCustomFields as $timeField) {
        // Validation is the same for text and dropdown fields.
        if (!ttValidString($timeField['value'], !$timeField['required'])) $err->add($i18n->get('error.field'), htmlspecialchars($timeField['label']));
      }
    }
    if ($showProject) {
      if (!$cl_project) $err->add($i18n->get('error.project'));
    }
    if ($showTask && $taskRequired) {
      if (!$cl_task) $err->add($i18n->get('error.task'));
    }
    if (strlen($cl_duration) == 0) {
      if ($cl_start || $cl_finish) {
        if (!ttTimeHelper::isValidTime($cl_start))
          $err->add($i18n->get('error.field'), $i18n->get('label.start'));
        if ($cl_finish) {
          if (!ttTimeHelper::isValidTime($cl_finish))
            $err->add($i18n->get('error.field'), $i18n->get('label.finish'));
          if (!ttTimeHelper::isValidInterval($cl_start, $cl_finish))
            $err->add($i18n->get('error.interval'), $i18n->get('label.finish'), $i18n->get('label.start'));
        }
      } else {
        if ($showStart) {
          $err->add($i18n->get('error.empty'), $i18n->get('label.start'));
          $err->add($i18n->get('error.empty'), $i18n->get('label.finish'));
        }
        if ($showDuration)
          $err->add($i18n->get('error.empty'), $i18n->get('label.duration'));
      }
    } else {
      if (false === ttTimeHelper::postedDurationToMinutes($cl_duration))
        $err->add($i18n->get('error.field'), $i18n->get('label.duration'));
    }
    if (!ttValidString($cl_note, true)) $err->add($i18n->get('error.field'), $i18n->get('label.note'));
    if ($user->isPluginEnabled('tp') && !ttValidTemplateText($cl_note)) {
      $err->add($i18n->get('error.field'), $i18n->get('label.note'));
    }
    if (!ttTimeHelper::canAdd()) $err->add($i18n->get('error.expired'));
    // Finished validating user input.

    // Prohibit creating entries in future.
    if (!$user->isOptionEnabled('future_entries')) {
      $browser_today = new DateAndTime(DB_DATEFORMAT, $request->getParameter('browser_today', null));
      if ($selected_date->after($browser_today))
        $err->add($i18n->get('error.future_date'));
    }

    // Prohibit creating entries in locked range.
    if ($user->isDateLocked($selected_date))
      $err->add($i18n->get('error.range_locked'));

    // Prohibit creating another uncompleted record.
    if ($err->no()) {
      if (($not_completed_rec = ttTimeHelper::getUncompleted($user_id)) && (($cl_finish == '') && ($cl_duration == '')))
        $err->add($i18n->get('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->get('error.goto_uncompleted')."</a>");
    }

    // Prohibit creating an overlapping record.
    if ($err->no()) {
      if (ttTimeHelper::overlaps($user_id, $cl_date, $cl_start, $cl_finish))
        $err->add($i18n->get('error.overlap'));
    }

    if ($err->no()) {
      $id = ttTimeHelper::insert(array(
        'date' => $cl_date,
        'client' => $cl_client,
        'project' => $cl_project,
        'task' => $cl_task,
        'start' => $cl_start,
        'finish' => $cl_finish,
        'duration' => $cl_duration,
        'note' => $cl_note,
        'billable' => $cl_billable));

      // Insert time custom fields if we have them.
      $result = true;
      if ($id && $custom_fields && $custom_fields->timeFields) {
        $result = $custom_fields->insertTimeFields($id, $timeCustomFields);
      }

      if ($id && $result) {
        header('Location: time.php');
        exit();
      }
      $err->add($i18n->get('error.db'));
    }
  }
} // isPost

$smarty->assign('next_date', $next_date);
$smarty->assign('prev_date', $prev_date);
$smarty->assign('day_total', ttTimeHelper::getTimeForDay($cl_date));
$smarty->assign('week_total', ttTimeHelper::getTimeForWeek($selected_date));
$smarty->assign('time_records', ttTimeHelper::getRecords($cl_date));
$smarty->assign('show_client', $showClient);
$smarty->assign('show_billable', $showBillable);
$smarty->assign('show_project', $showProject);
$smarty->assign('show_task', $showTask);
$smarty->assign('task_required', $taskRequired);
$smarty->assign('show_start', $showStart);
$smarty->assign('show_duration', $showDuration);
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns();prepopulateNote();"');
$smarty->assign('timestring', $selected_date->toString($user->getDateFormat()));
$smarty->assign('title', $i18n->get('title.time'));
$smarty->assign('content_page_name', 'mobile/time.tpl');
$smarty->display('mobile/index.tpl');
