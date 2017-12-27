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
import('form.DefaultCellRenderer');
import('form.Table');
import('ttUserHelper');
import('ttTeamHelper');
import('ttClientHelper');
import('ttTimeHelper');
import('DateAndTime');

// Access check.
if (!ttAccessCheck(right_data_entry)) {
  header('Location: access_denied.php');
  exit();
}

// Initialize and store date in session.
$cl_date = $request->getParameter('date', @$_SESSION['date']);
$selected_date = new DateAndTime(DB_DATEFORMAT, $cl_date);
if($selected_date->isError())
  $selected_date = new DateAndTime(DB_DATEFORMAT);
if(!$cl_date)
  $cl_date = $selected_date->toString(DB_DATEFORMAT);
$_SESSION['date'] = $cl_date;

// Determine selected week start and end dates.
$weekStartDay = $user->week_start;
$t_arr = localtime($selected_date->getTimestamp());
$t_arr[5] = $t_arr[5] + 1900;
if ($t_arr[6] < $weekStartDay)
  $startWeekBias = $weekStartDay - 7;
else
  $startWeekBias = $weekStartDay;
$startDate = new DateAndTime();
$startDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+$startWeekBias,$t_arr[5]));
$endDate = new DateAndTime();
$endDate->setTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+6+$startWeekBias,$t_arr[5]));
// The above is needed to set date range (timestring) in page title.

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields($user->team_id);
  $smarty->assign('custom_fields', $custom_fields);
}

// TODO: how is this plugin supposed to work for week view?
if ($user->isPluginEnabled('mq')){
  require_once('plugins/MonthlyQuota.class.php');
  $quota = new MonthlyQuota();
  $month_quota = $quota->get($selected_date->mYear, $selected_date->mMonth);
  $month_total = ttTimeHelper::getTimeForMonth($user->getActiveUser(), $selected_date);
  $minutes_left = ttTimeHelper::toMinutes($month_quota) - ttTimeHelper::toMinutes($month_total);

  $smarty->assign('month_total', $month_total);
  $smarty->assign('over_quota', $minutes_left < 0);
  $smarty->assign('quota_remaining', ttTimeHelper::toAbsDuration($minutes_left));
}

// Initialize variables.
// Custom field.
$cl_cf_1 = trim($request->getParameter('cf_1', ($request->getMethod()=='POST'? null : @$_SESSION['cf_1'])));
$_SESSION['cf_1'] = $cl_cf_1;
$cl_billable = 1;
if ($user->isPluginEnabled('iv')) {
  if ($request->isPost()) {
    $cl_billable = $request->getParameter('billable');
    $_SESSION['billable'] = (int) $cl_billable;
  } else
    if (isset($_SESSION['billable']))
      $cl_billable = $_SESSION['billable'];
}
$on_behalf_id = $request->getParameter('onBehalfUser', (isset($_SESSION['behalf_id'])? $_SESSION['behalf_id'] : $user->id));
$cl_client = $request->getParameter('client', ($request->getMethod()=='POST'? null : @$_SESSION['client']));
$_SESSION['client'] = $cl_client;
$cl_project = $request->getParameter('project', ($request->getMethod()=='POST'? null : @$_SESSION['project']));
$_SESSION['project'] = $cl_project;
$cl_task = $request->getParameter('task', ($request->getMethod()=='POST'? null : @$_SESSION['task']));
$_SESSION['task'] = $cl_task;

// Get the data we need to display week view.
// Get column headers, which are day numbers in month.
$dayHeaders = ttTimeHelper::getDayHeadersForWeek($startDate->toString(DB_DATEFORMAT));
// Build data array for the table. Format is described in the function..
$dataArray = ttTimeHelper::getDataForWeekView($user->getActiveUser(), $startDate->toString(DB_DATEFORMAT), $endDate->toString(DB_DATEFORMAT), $dayHeaders);
// Build day totals (total durations for each day in week).
$dayTotals = ttTimeHelper::getDayTotals($dataArray, $dayHeaders);

// TODO: refactoring ongoing down from here.

// 1) Start coding modification of existing records.
// 2) Then adding new records for existing rows.
// 3) Then add code and UI for adding a new row.

// Actually this is work in progress at this point, even documenting the array, as we still miss control IDs, and
// editing entries is not yet implemented. When this is done, we will have to re-document the above.

// Define rendering class for a label field to the left of durations.
class LabelCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    $this->setOptions(array('width'=>200,'valign'=>'middle'));
    $this->setValue(htmlspecialchars($value)); // This escapes HTML for output.
    return $this->toString();
  }
}

// Define rendering class for a single cell for time entry in week view table.
class TimeCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    $field_name = $table->getValueAt($row,$column)['control_id']; // Our text field names (and ids) are like x_y (row_column).
    $field = new TextField($field_name);
    $field->setFormName($table->getFormName());
    $field->setSize(2);
    $field->setValue($table->getValueAt($row,$column)['duration']);
    $this->setValue($field->getHtml());
    return $this->toString();
  }
}

// Elements of weekTimeForm.
$form = new Form('weekTimeForm');

if ($user->canManageTeam()) {
  $user_list = ttTeamHelper::getActiveUsers(array('putSelfFirst'=>true));
  if (count($user_list) > 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'this.form.submit();',
      'name'=>'onBehalfUser',
      'style'=>'width: 250px;',
      'value'=>$on_behalf_id,
      'data'=>$user_list,
      'datakeys'=>array('id','name')));
    $smarty->assign('on_behalf_control', 1);
  }
}

// Create week_durations table.
$table = new Table('week_durations');
// $table->setIAScript('markModified'); // TODO: write a script to mark table or particular cells as modified.
$table->setTableOptions(array('width'=>'100%','cellspacing'=>'1','cellpadding'=>'3','border'=>'0'));
$table->setRowOptions(array('class'=>'tableHeaderCentered'));
$table->setData($dataArray);
// Add columns to table.
$table->addColumn(new TableColumn('label', '', new LabelCellRenderer(), $dayTotals['label']));
for ($i = 0; $i < 7; $i++) {
  $table->addColumn(new TableColumn($dayHeaders[$i], $dayHeaders[$i], new TimeCellRenderer(), $dayTotals[$dayHeaders[$i]]));
}
$table->setInteractive(false);
$form->addInputElement($table);

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $user->tracking_mode && $user->isPluginEnabled('cl')) {
  $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillProjectDropdown(this.value);',
    'name'=>'client',
    'style'=>'width: 250px;',
    'value'=>$cl_client,
    'data'=>$active_clients,
    'datakeys'=>array('id', 'name'),
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
  // Note: in other modes the client list is filtered to relevant clients only. See below.
}

if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  // Dropdown for projects assigned to user.
  $project_list = $user->getAssignedProjects();
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillTaskDropdown(this.value);',
    'name'=>'project',
    'style'=>'width: 250px;',
    'value'=>$cl_project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))));

  // Dropdown for clients if the clients plugin is enabled.
  if ($user->isPluginEnabled('cl')) {
    $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
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
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
  }
}

if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  $task_list = ttTeamHelper::getActiveTasks($user->team_id);
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'style'=>'width: 250px;',
    'value'=>$cl_task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
}

// Add other controls.
if ((TYPE_START_FINISH == $user->record_type) || (TYPE_ALL == $user->record_type)) {
  $form->addInput(array('type'=>'text','name'=>'start','value'=>$cl_start,'onchange'=>"formDisable('start');"));
  $form->addInput(array('type'=>'text','name'=>'finish','value'=>$cl_finish,'onchange'=>"formDisable('finish');"));
  if (!$user->canManageTeam() && defined('READONLY_START_FINISH') && isTrue(READONLY_START_FINISH)) {
    // Make the start and finish fields read-only.
    $form->getElement('start')->setEnabled(false);
    $form->getElement('finish')->setEnabled(false);
  }
}
if ((TYPE_DURATION == $user->record_type) || (TYPE_ALL == $user->record_type))
  $form->addInput(array('type'=>'text','name'=>'duration','value'=>$cl_duration,'onchange'=>"formDisable('duration');"));
if (!defined('NOTE_INPUT_HEIGHT'))
	define('NOTE_INPUT_HEIGHT', 40);
$form->addInput(array('type'=>'textarea','name'=>'note','style'=>'width: 600px; height:'.NOTE_INPUT_HEIGHT.'px;','value'=>$cl_note));
$form->addInput(array('type'=>'calendar','name'=>'date','value'=>$cl_date)); // calendar
if ($user->isPluginEnabled('iv'))
  $form->addInput(array('type'=>'checkbox','name'=>'billable','value'=>$cl_billable));
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_submit click.
$form->addInput(array('type'=>'submit','name'=>'btn_submit','onclick'=>'browser_today.value=get_date()','value'=>$i18n->getKey('button.submit')));

// If we have custom fields - add controls for them.
if ($custom_fields && $custom_fields->fields[0]) {
  // Only one custom field is supported at this time.
  if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT) {
    $form->addInput(array('type'=>'text','name'=>'cf_1','value'=>$cl_cf_1));
  } elseif ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN) {
    $form->addInput(array('type'=>'combobox','name'=>'cf_1',
      'style'=>'width: 250px;',
      'value'=>$cl_cf_1,
      'data'=>$custom_fields->options,
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
  }
}

// Submit.
if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {

    // Validate user input.
    if ($user->isPluginEnabled('cl') && $user->isPluginEnabled('cm') && !$cl_client)
      $err->add($i18n->getKey('error.client'));
    if ($custom_fields) {
      if (!ttValidString($cl_cf_1, !$custom_fields->fields[0]['required'])) $err->add($i18n->getKey('error.field'), $custom_fields->fields[0]['label']);
    }
    if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
      if (!$cl_project) $err->add($i18n->getKey('error.project'));
    }
    if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode && $user->task_required) {
      if (!$cl_task) $err->add($i18n->getKey('error.task'));
    }
    if (strlen($cl_duration) == 0) {
      if ($cl_start || $cl_finish) {
        if (!ttTimeHelper::isValidTime($cl_start))
          $err->add($i18n->getKey('error.field'), $i18n->getKey('label.start'));
        if ($cl_finish) {
          if (!ttTimeHelper::isValidTime($cl_finish))
            $err->add($i18n->getKey('error.field'), $i18n->getKey('label.finish'));
          if (!ttTimeHelper::isValidInterval($cl_start, $cl_finish))
            $err->add($i18n->getKey('error.interval'), $i18n->getKey('label.finish'), $i18n->getKey('label.start'));
        }
      } else {
        if ((TYPE_START_FINISH == $user->record_type) || (TYPE_ALL == $user->record_type)) {
          $err->add($i18n->getKey('error.empty'), $i18n->getKey('label.start'));
          $err->add($i18n->getKey('error.empty'), $i18n->getKey('label.finish'));
        }
        if ((TYPE_DURATION == $user->record_type) || (TYPE_ALL == $user->record_type))
          $err->add($i18n->getKey('error.empty'), $i18n->getKey('label.duration'));
      }
    } else {
      if (!ttTimeHelper::isValidDuration($cl_duration))
        $err->add($i18n->getKey('error.field'), $i18n->getKey('label.duration'));
    }
    if (!ttValidString($cl_note, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.note'));
    // Finished validating user input.

    // Prohibit creating entries in future.
    if (defined('FUTURE_ENTRIES') && !isTrue(FUTURE_ENTRIES)) {
      $browser_today = new DateAndTime(DB_DATEFORMAT, $request->getParameter('browser_today', null));
      if ($selected_date->after($browser_today))
        $err->add($i18n->getKey('error.future_date'));
    }

    // Prohibit creating entries in locked range.
    if ($user->isDateLocked($selected_date))
      $err->add($i18n->getKey('error.range_locked'));

    // Prohibit creating another uncompleted record.
    if ($err->no()) {
      if (($not_completed_rec = ttTimeHelper::getUncompleted($user->getActiveUser())) && (($cl_finish == '') && ($cl_duration == '')))
        $err->add($i18n->getKey('error.uncompleted_exists')." <a href = 'time_edit.php?id=".$not_completed_rec['id']."'>".$i18n->getKey('error.goto_uncompleted')."</a>");
    }

    // Prohibit creating an overlapping record.
    if ($err->no()) {
      if (ttTimeHelper::overlaps($user->getActiveUser(), $cl_date, $cl_start, $cl_finish))
        $err->add($i18n->getKey('error.overlap'));
    }

    // Insert record.
    if ($err->no()) {
      $id = ttTimeHelper::insert(array(
        'date' => $cl_date,
        'user_id' => $user->getActiveUser(),
        'client' => $cl_client,
        'project' => $cl_project,
        'task' => $cl_task,
        'start' => $cl_start,
        'finish' => $cl_finish,
        'duration' => $cl_duration,
        'note' => $cl_note,
        'billable' => $cl_billable));

      // Insert a custom field if we have it.
      $result = true;
      if ($id && $custom_fields && $cl_cf_1) {
        if ($custom_fields->fields[0]['type'] == CustomFields::TYPE_TEXT)
          $result = $custom_fields->insert($id, $custom_fields->fields[0]['id'], null, $cl_cf_1);
        elseif ($custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)
          $result = $custom_fields->insert($id, $custom_fields->fields[0]['id'], $cl_cf_1, null);
      }
      if ($id && $result) {
        header('Location: time.php');
        exit();
      }
      $err->add($i18n->getKey('error.db'));
    }
  } elseif ($request->getParameter('btn_stop')) {
    // Stop button pressed to finish an uncompleted record.
    $record_id = $request->getParameter('record_id');
    $record = ttTimeHelper::getRecord($record_id, $user->getActiveUser());
    $browser_date = $request->getParameter('browser_date');
    $browser_time = $request->getParameter('browser_time');

    // Can we complete this record?
    if ($record['date'] == $browser_date                                // closing today's record
      && ttTimeHelper::isValidInterval($record['start'], $browser_time) // finish time is greater than start time
      && !ttTimeHelper::overlaps($user->getActiveUser(), $browser_date, $record['start'], $browser_time)) { // no overlap
      $res = ttTimeHelper::update(array(
          'id'=>$record['id'],
          'date'=>$record['date'],
          'user_id'=>$user->getActiveUser(),
          'client'=>$record['client_id'],
          'project'=>$record['project_id'],
          'task'=>$record['task_id'],
          'start'=>$record['start'],
          'finish'=>$browser_time,
          'note'=>$record['comment'],
          'billable'=>$record['billable']));
      if (!$res)
        $err->add($i18n->getKey('error.db'));
    } else {
      // Cannot complete, redirect for manual edit.
      header('Location: time_edit.php?id='.$record_id);
      exit();
    }
  }
  elseif ($request->getParameter('onBehalfUser')) {
    if($user->canManageTeam()) {
      unset($_SESSION['behalf_id']);
      unset($_SESSION['behalf_name']);

      if($on_behalf_id != $user->id) {
        $_SESSION['behalf_id'] = $on_behalf_id;
        $_SESSION['behalf_name'] = ttUserHelper::getUserName($on_behalf_id);
      }
      header('Location: week.php');
      exit();
    }
  }
} // isPost

$week_total = ttTimeHelper::getTimeForWeek($user->getActiveUser(), $selected_date);

$smarty->assign('selected_date', $selected_date);
$smarty->assign('week_total', $week_total);

$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('timestring', $startDate->toString($user->date_format).' - '.$endDate->toString($user->date_format));

$smarty->assign('title', $i18n->getKey('title.time'));
$smarty->assign('content_page_name', 'week.tpl');
$smarty->display('index.tpl');
