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
import('form.TextField');
import('ttUserHelper');
import('ttTeamHelper');
import('ttWeekViewHelper');
import('ttClientHelper');
import('ttTimeHelper');
import('DateAndTime');

// Access checks.
if (!(ttAccessAllowed('track_own_time') || ttAccessAllowed('track_time'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('wv')) {
  header('Location: feature_disabled.php');
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
// End of access checks.

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
  $custom_fields = new CustomFields($user->group_id);
  $smarty->assign('custom_fields', $custom_fields);
}

// Use Monthly Quotas plugin, if applicable.
if ($user->isPluginEnabled('mq')){
  require_once('plugins/MonthlyQuota.class.php');
  $quota = new MonthlyQuota();
  $month_quota = $quota->get($selected_date->mYear, $selected_date->mMonth);
  $month_total = ttTimeHelper::getTimeForMonth($user->getActiveUser(), $selected_date);
  $minutes_left = round(60*$month_quota) - ttTimeHelper::toMinutes($month_total);

  $smarty->assign('month_total', $month_total);
  $smarty->assign('over_quota', $minutes_left < 0);
  $smarty->assign('quota_remaining', ttTimeHelper::toAbsDuration($minutes_left));
}

// Initialize variables.
// Custom field.
$cl_cf_1 = trim($request->getParameter('cf_1', ($request->isPost() ? null : @$_SESSION['cf_1'])));
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
$cl_client = $request->getParameter('client', ($request->isPost() ? null : @$_SESSION['client']));
$_SESSION['client'] = $cl_client;
$cl_project = $request->getParameter('project', ($request->isPost() ? null : @$_SESSION['project']));
$_SESSION['project'] = $cl_project;
$cl_task = $request->getParameter('task', ($request->isPost() ? null : @$_SESSION['task']));
$_SESSION['task'] = $cl_task;
$cl_note = $request->getParameter('note', ($request->isPost() ? null : @$_SESSION['note']));
$_SESSION['note'] = $cl_note;

// Get the data we need to display week view.
// Get column headers, which are day numbers in month.
$dayHeaders = ttWeekViewHelper::getDayHeadersForWeek($startDate->toString(DB_DATEFORMAT));
$lockedDays = ttWeekViewHelper::getLockedDaysForWeek($startDate->toString(DB_DATEFORMAT));
// Get already existing records.
$records = ttWeekViewHelper::getRecordsForInterval($user->getActiveUser(), $startDate->toString(DB_DATEFORMAT), $endDate->toString(DB_DATEFORMAT));
// Build data array for the table. Format is described in ttWeekViewHelper::getDataForWeekView function.
if ($records)
  $dataArray = ttWeekViewHelper::getDataForWeekView($records, $dayHeaders);
else
  $dataArray = ttWeekViewHelper::prePopulateFromPastWeeks($startDate->toString(DB_DATEFORMAT), $dayHeaders);

// Build day totals (total durations for each day in week).
$dayTotals = ttWeekViewHelper::getDayTotals($dataArray, $dayHeaders);

// Define rendering class for a label field to the left of durations.
class LabelCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    global $user;

    $this->setOptions(array('width'=>200,'valign'=>'middle'));

    // Special handling for a new week entry (row 0, or 0 and 1 if we show notes).
    if (0 == $row) {
      $this->setOptions(array('style'=>'text-align: center; font-weight: bold; vertical-align: top;'));
    } else if ($user->isPluginEnabled('wvns') && (1 == $row)) {
      $this->setOptions(array('style'=>'text-align: right; vertical-align: top;'));
    } else if ($user->isPluginEnabled('wvns') && (0 != $row % 2)) {
      $this->setOptions(array('style'=>'text-align: right;'));
    }
    // Special handling for not billable entries.
    $ignoreRow = $user->isPluginEnabled('wvns') ? 1 : 0; 
    if ($row > $ignoreRow) {
      $row_id = $table->getValueAtName($row,'row_id');
      $billable = ttWeekViewHelper::parseFromWeekViewRow($row_id, 'bl');
      if (!$billable) {
        if (($user->isPluginEnabled('wvns') && (0 == $row % 2)) || !$user->isPluginEnabled('wvns')) {
          $this->setOptions(array('style'=>'color: red;')); // TODO: style it properly in CSS.
        }
      }
    }
    $this->setValue(htmlspecialchars($value)); // This escapes HTML for output.
    return $this->toString();
  }
}

// Define rendering class for a single cell for a time or a comment entry in week view table.
class WeekViewCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    global $user;

    $field_name = $table->getValueAt($row,$column)['control_id']; // Our text field names (and ids) are like x_y (row_column).
    $field = new TextField($field_name);
    // Disable control if the date is locked.
    global $lockedDays;
    if ($lockedDays[$column-1])
      $field->setEnabled(false);
    $field->setFormName($table->getFormName());
    $field->setStyle('width: 60px;'); // TODO: need to style everything properly, eventually.
    // Provide visual separation for new entry row.
    $rowToSeparate = $user->isPluginEnabled('wvns') ? 1 : 0;
    if ($rowToSeparate == $row) {
      $field->setStyle('width: 60px; margin-bottom: 40px');
    }
    if ($user->isPluginEnabled('wvns')) {
      if (0 == $row % 2) {
        $field->setValue($table->getValueAt($row,$column)['duration']); // Duration for even rows.
      } else {
        $field->setValue($table->getValueAt($row,$column)['note']);     // Comment for odd rows.
        $field->setTitle($table->getValueAt($row,$column)['note']);     // Tooltip to help view the entire comment.
      }
    } else {
      $field->setValue($table->getValueAt($row,$column)['duration']);
      // $field->setTitle($table->getValueAt($row,$column)['note']); // Tooltip to see comment. TODO - value not available.
    }
    // Disable control when time entry mode is TYPE_START_FINISH and there is no value in control
    // because we can't supply start and finish times in week view - there are no fields for them.
    if (!$field->getValue() && TYPE_START_FINISH == $user->record_type) {
        $field->setEnabled(false);
    }
    $this->setValue($field->getHtml());
    return $this->toString();
  }
}

// Elements of weekTimeForm.
$form = new Form('weekTimeForm');

if ($user->can('track_time')) {
  if ($user->can('track_own_time'))
    $options = array('status'=>ACTIVE,'max_rank'=>$user->rank-1,'include_self'=>true,'self_first'=>true);
  else
    $options = array('status'=>ACTIVE,'max_rank'=>$user->rank-1);
  $user_list = $user->getUsers($options);
  if (count($user_list) >= 1) {
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
$table = new Table('week_durations', 'week_view_table');
$table->setTableOptions(array('width'=>'100%','cellspacing'=>'1','cellpadding'=>'3','border'=>'0'));
$table->setRowOptions(array('class'=>'tableHeaderCentered'));
$table->setData($dataArray);
// Add columns to table.
$table->addColumn(new TableColumn('label', '', new LabelCellRenderer(), $dayTotals['label']));
for ($i = 0; $i < 7; $i++) {
  $table->addColumn(new TableColumn($dayHeaders[$i], $dayHeaders[$i], new WeekViewCellRenderer(), $dayTotals[$dayHeaders[$i]]));
}
$table->setInteractive(false);
$form->addInputElement($table);

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $user->tracking_mode && $user->isPluginEnabled('cl')) {
  $active_clients = ttTeamHelper::getActiveClients($user->group_id, true);
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
    'empty'=>array(''=>$i18n->get('dropdown.select'))));

  // Dropdown for clients if the clients plugin is enabled.
  if ($user->isPluginEnabled('cl')) {
    $active_clients = ttTeamHelper::getActiveClients($user->group_id, true);
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

if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  $task_list = ttTeamHelper::getActiveTasks($user->group_id);
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'style'=>'width: 250px;',
    'value'=>$cl_task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));
}
if (!defined('NOTE_INPUT_HEIGHT'))
  define('NOTE_INPUT_HEIGHT', 40);
$form->addInput(array('type'=>'textarea','name'=>'note','style'=>'width: 250px; height:'.NOTE_INPUT_HEIGHT.'px;','value'=>$cl_note));

// Add other controls.
$form->addInput(array('type'=>'calendar','name'=>'date','value'=>$cl_date)); // calendar
if ($user->isPluginEnabled('iv'))
  $form->addInput(array('type'=>'checkbox','name'=>'billable','value'=>$cl_billable));
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'get_date()')); // User current date, which gets filled in on btn_submit click.
$form->addInput(array('type'=>'submit','name'=>'btn_submit','onclick'=>'browser_today.value=get_date()','value'=>$i18n->get('button.submit')));

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
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
  }
}

// Submit.
if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {
    // Validate user input for row 0.
    // Determine if a new entry was posted.
    $newEntryPosted = false;
    foreach($dayHeaders as $dayHeader) {
      $control_id = '0_'.$dayHeader;
      if ($request->getParameter($control_id)) {
        $newEntryPosted = true;
        break;
      }
    }
    if ($newEntryPosted) {
      if ($user->isPluginEnabled('cl') && $user->isPluginEnabled('cm') && !$cl_client)
        $err->add($i18n->get('error.client'));
      if ($custom_fields) {
        if (!ttValidString($cl_cf_1, !$custom_fields->fields[0]['required'])) $err->add($i18n->get('error.field'), $custom_fields->fields[0]['label']);
      }
      if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
        if (!$cl_project) $err->add($i18n->get('error.project'));
      }
      if (MODE_PROJECTS_AND_TASKS == $user->tracking_mode && $user->task_required) {
        if (!$cl_task) $err->add($i18n->get('error.task'));
      }
    }
    // Finished validating user input for row 0.

    // Process the table of values.
    if ($err->no()) {

      // Obtain values. Iterate through posted parameters one by one,
      // see if value changed, apply one change at a time until we see an error.
      $result = true;
      $rowNumber = 0;
      // Iterate through existing rows.
      foreach ($dataArray as $row) {
        // Iterate through days.
        foreach ($dayHeaders as $key => $dayHeader) {
          // Do not process locked days.
          if ($lockedDays[$key]) continue;
          // Make control id for the cell.
          $control_id = $rowNumber.'_'.$dayHeader;

          // Handle durations and comments in separate blocks of code.
          if (!$user->isPluginEnabled('wvns') || (0 == $rowNumber % 2)) {
            // Handle durations row here.

            // Obtain existing and posted durations.
            $postedDuration = $request->getParameter($control_id);
            $existingDuration = $dataArray[$rowNumber][$dayHeader]['duration'];
            // If posted value is not null, check and normalize it.
            if ($postedDuration) {
              if (false === ttTimeHelper::postedDurationToMinutes($postedDuration)) {
                $err->add($i18n->get('error.field'), $i18n->get('label.duration'));
                $result = false; break; // Break out. Stop any further processing.
              } else {
                $minutes = ttTimeHelper::postedDurationToMinutes($postedDuration);
                $postedDuration = ttTimeHelper::minutesToDuration($minutes);
              }
            }
            // Do not process if value has not changed.
            if ($postedDuration == $existingDuration)
              continue;
            // Posted value is different.
            if ($existingDuration == null) {
              // Skip inserting 0 duration values.
              if (0 == ttTimeHelper::toMinutes($postedDuration))
                continue;
              // Insert a new record.
              $fields = array();
              $fields['row_id'] = $dataArray[$rowNumber]['row_id'];
              if (!$fields['row_id']) {
                // Special handling for row 0, a new entry. Need to construct new row_id.
                $record = array();
                $record['client_id'] = $cl_client;
                $record['billable'] = $cl_billable ? '1' : '0';
                $record['project_id'] = $cl_project;
                $record['task_id'] = $cl_task;
                $record['cf_1_value'] = $cl_cf_1;
                $fields['row_id'] = ttWeekViewHelper::makeRowIdentifier($record).'_0';
                // Note: no need to check for a possible conflict with an already existing row
                // because we are doing an insert that does not affect already existing data.

                if ($user->isPluginEnabled('wvn')) {
                  $fields['note'] = $request->getParameter('note');
                }
              }
              $fields['day_header'] = $dayHeader;
              $fields['start_date'] = $startDate->toString(DB_DATEFORMAT); // To be able to determine date for the entry using $dayHeader.
              $fields['duration'] = $postedDuration;
              $fields['browser_today'] = $request->getParameter('browser_today', null);
              if ($user->isPluginEnabled('wvns')) {
                // Take note value from the control below duration.
                $noteRowNumber = $rowNumber + 1;
                $note_control_id =  $noteRowNumber.'_'.$dayHeader;
                $fields['note'] = $request->getParameter($note_control_id);
              }
              $result = ttWeekViewHelper::insertDurationFromWeekView($fields, $custom_fields, $err);
            } elseif ($postedDuration == null || 0 == ttTimeHelper::toMinutes($postedDuration)) {
              // Delete an already existing record here.
              $result = ttTimeHelper::delete($dataArray[$rowNumber][$dayHeader]['tt_log_id'], $user->getActiveUser());
            } else {
              $fields = array();
              $fields['tt_log_id'] = $dataArray[$rowNumber][$dayHeader]['tt_log_id'];
              $fields['duration'] = $postedDuration;
              $result = ttWeekViewHelper::modifyDurationFromWeekView($fields, $err);
            }
            if (!$result) break; // Break out of the loop in case of first error.

          } else if ($user->isPluginEnabled('wvns')) {
            // Handle commments row here.

            // Obtain existing and posted comments.
            $postedComment = $request->getParameter($control_id);
            $existingComment = $dataArray[$rowNumber][$dayHeader]['note'];
            // If posted value is not null, check it.
            if ($postedComment && !ttValidString($postedComment, true)) {
              $err->add($i18n->get('error.field'), $i18n->get('label.note'));
              $result = false; break; // Break out. Stop any further processing.
            }
            // Do not process if value has not changed.
            if ($postedComment == $existingComment)
              continue;

            // Posted value is different.
            // TODO: handle new entries separately in the durations block above.

            // Here, only update the comment on an already existing record.
            $fields = array();
            $fields['tt_log_id'] = $dataArray[$rowNumber][$dayHeader]['tt_log_id'];
            if ($fields['tt_log_id']) {
              $fields['comment'] = $postedComment;
              $result = ttWeekViewHelper::modifyCommentFromWeekView($fields);
            }
            if (!$result) break; // Break out of the loop in case of first error.
          }
        }
        if (!$result) break; // Break out of the loop in case of first error.
        $rowNumber++;
      }
      if ($result) {
        header('Location: week.php'); // Normal exit.
        exit();
      }
    }
  }
  elseif ($request->getParameter('onBehalfUser')) {
    if($user->can('track_time')) {
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
$smarty->assign('time_records', $records);

$smarty->assign('title', $i18n->get('title.time'));
$smarty->assign('content_page_name', 'week.tpl');
$smarty->display('index.tpl');
