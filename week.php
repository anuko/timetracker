<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('form.DefaultCellRenderer');
import('form.Table');
import('form.TextField');
import('ttUserHelper');
import('ttGroupHelper');
import('ttWeekViewHelper');
import('ttClientHelper');
import('ttTimeHelper');
import('ttDate');

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
if ($request->isPost()) {
  $userChanged = (bool)$request->getParameter('user_changed'); // Reused in multiple places below.
  if ($userChanged && !($user->can('track_time') && $user->isUserValid((int)$request->getParameter('user')))) {
    header('Location: access_denied.php'); // User changed, but no right or wrong user id.
    exit();
  }
}
// If we are passed in a date, make sure it is in correct format.
$date = $request->getParameter('date');
if ($date && !ttValidDbDateFormatDate($date)) {
  header('Location: access_denied.php');
  exit();
}
if ($request->isPost()) {
  // Validate that browser_today parameter is in correct format.
  $browser_today = $request->getParameter('browser_today');
  if ($browser_today && !ttValidDbDateFormatDate($browser_today)) {
    header('Location: access_denied.php');
    exit();
  }
}
// End of access checks.

// Determine user for whom we display this page.
if ($request->isPost() && $userChanged) {
  $user_id = (int)$request->getParameter('user');
  $user->setOnBehalfUser($user_id);
} else {
  $user_id = $user->getUser();
}

$group_id = $user->getGroup();

$showClient = $user->isPluginEnabled('cl');
$showBillable = $user->isPluginEnabled('iv');
$trackingMode = $user->getTrackingMode();
$showProject = MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode;
$showTask = MODE_PROJECTS_AND_TASKS == $trackingMode;
$taskRequired = false;
if ($showTask) $taskRequired = $user->getConfigOption('task_required');
$showWeekNote = $user->isOptionEnabled('week_note');
$showWeekNotes = $user->isOptionEnabled('week_notes');
$showWeekends = $user->isOptionEnabled('weekends');
$recordType = $user->getRecordType();
$showStart = TYPE_START_FINISH == $recordType || TYPE_ALL == $recordType;
$showFiles = $user->isPluginEnabled('at');
$showRecordCustomFields = $user->isOptionEnabled('record_custom_fields');

// Initialize and store date in session.
$cl_date = $request->getParameter('date', @$_SESSION['date']);
$selected_date = new ttDate($cl_date);
if(!$cl_date)
  $cl_date = $selected_date->toString();
$_SESSION['date'] = $cl_date;

// Determine selected week start and end dates.
$weekStartDay = $user->getWeekStart();
$t_arr = localtime($selected_date->getTimestamp());
$t_arr[5] = $t_arr[5] + 1900;
if ($t_arr[6] < $weekStartDay)
  $startWeekBias = $weekStartDay - 7;
else
  $startWeekBias = $weekStartDay;
$startDate = new ttDate();
$startDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+$startWeekBias,$t_arr[5]));
$endDate = new ttDate();
$endDate->setFromUnixTimestamp(mktime(0,0,0,$t_arr[4]+1,$t_arr[3]-$t_arr[6]+6+$startWeekBias,$t_arr[5]));
// The above is needed to set date range (timestring) in page title.

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields();
  $smarty->assign('custom_fields', $custom_fields);
}

// Use Monthly Quotas plugin, if applicable.
if ($user->isPluginEnabled('mq')){
  require_once('plugins/MonthlyQuota.class.php');
  $quota = new MonthlyQuota();
  $month_quota_minutes = $quota->getUserQuota($selected_date->year, $selected_date->month);
  $month_total = ttTimeHelper::getTimeForMonth($selected_date);
  $minutes_left = $month_quota_minutes - ttTimeHelper::toMinutes($month_total);

  $smarty->assign('month_total', $month_total);
  $smarty->assign('over_quota', $minutes_left < 0);
  $smarty->assign('quota_remaining', ttTimeHelper::toAbsDuration($minutes_left));
}

// Initialize variables.
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
$cl_note = $request->getParameter('comment', ($request->isPost() ? null : @$_SESSION['comment']));
$_SESSION['comment'] = $cl_note;

$timeCustomFields = array();
// If we have time custom fields - collect input.
if (isset($custom_fields) && $custom_fields->timeFields) {
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

// Get the data we need to display week view.
// Get column headers, which are day numbers in month.
$dayHeaders = ttWeekViewHelper::getDayHeadersForWeek($startDate->toString());
$lockedDays = ttWeekViewHelper::getLockedDaysForWeek($startDate->toString());
// If we are not showing weekends, reduce the above arrays to 5 days only.
$weekend_start_idx = $weekend_end_idx = 0;
if (!$showWeekends) {
  if (defined('WEEKEND_START_DAY')) {
    $weekend_start_idx = (7 + WEEKEND_START_DAY - $weekStartDay) % 7;
    $weekend_end_idx = (7 + WEEKEND_START_DAY + 1 - $weekStartDay) % 7;
  } else {
    $weekend_start_idx = 6 - $weekStartDay;
    $weekend_end_idx = (7 - $weekStartDay) % 7;
  }
  unset($dayHeaders[$weekend_start_idx]);
  unset($dayHeaders[$weekend_end_idx]);
  unset($lockedDays[$weekend_start_idx]);
  unset($lockedDays[$weekend_end_idx]);
}

// Get already existing records.
$records = ttWeekViewHelper::getRecordsForInterval($startDate->toString(), $endDate->toString(), $showFiles);
// Build data array for the table. Format is described in ttWeekViewHelper::getDataForWeekView function.
if ($records)
  $dataArray = ttWeekViewHelper::getDataForWeekView($records, $dayHeaders);
else
  $dataArray = ttWeekViewHelper::prePopulateFromPastWeeks($startDate->toString(), $dayHeaders);

// Build day totals (total durations for each day in week).
$dayTotals = ttWeekViewHelper::getDayTotals($dataArray, $dayHeaders);

// Define rendering class for a label field to the left of durations.
class LabelCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    global $user;
    $showNotes = $user->isOptionEnabled('week_notes');

    $this->setOptions(array('width'=>200,'valign'=>'middle'));

    // Special handling for a new week entry (row 0, or 0 and 1 if we show notes).
    if (0 == $row) {
      $this->setOptions(array('style'=>'text-align: center; font-weight: bold; vertical-align: top;'));
    } else if ($showNotes && (1 == $row)) {
      $this->setOptions(array('style'=>'text-align: right; vertical-align: top;'));
    } else if ($showNotes && (0 != $row % 2)) {
      $this->setOptions(array('style'=>'text-align: right;'));
    }
    // Special handling for not billable entries.
    $ignoreRow = $showNotes ? 1 : 0;
    if ($row > $ignoreRow) {
      $row_id = $table->getValueAtName($row,'row_id');
      $billable = ttWeekViewHelper::parseFromWeekViewRow($row_id, 'bl');
      if (!$billable) {
        if (($showNotes && (0 == $row % 2)) || !$showNotes) {
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
    $showNotes = $user->isOptionEnabled('week_notes');

    $field_name = $table->getValueAt($row,$column)['control_id']; // Our text field names (and ids) are like x_y (row_column).
    $field = new TextField($field_name);
    // Disable control if the date is locked.
    global $lockedDays;
    if ($lockedDays[$column])
      $field->setEnabled(false);
    $field->setFormName($table->getFormName());
    $field->setStyle('width: 60px;'); // TODO: need to style everything properly, eventually.
    // Provide visual separation for new entry row.
    $rowToSeparate = $showNotes ? 1 : 0;
    if ($rowToSeparate == $row) {
      $field->setStyle('width: 60px; margin-bottom: 40px');
    }
    if ($showNotes) {
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
    if (!$field->getValue() && TYPE_START_FINISH == $user->getRecordType()) {
        $field->setEnabled(false);
    }
    $this->setValue($field->getHtml());
    return $this->toString();
  }
}

// Elements of weekTimeForm.
$form = new Form('weekTimeForm');
$largeScreenCalendarRowSpan = 1; // Number of rows calendar spans on large screens.

if ($user->can('track_time')) {
  $rank = $user->getMaxRankForGroup($group_id);
  if ($user->can('track_own_time'))
    $options = array('status'=>ACTIVE,'max_rank'=>$rank,'include_self'=>true,'self_first'=>true);
  else
    $options = array('status'=>ACTIVE,'max_rank'=>$rank);
  $user_list = $user->getUsers($options);
  if (count($user_list) >= 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'document.weekTimeForm.user_changed.value=1;document.weekTimeForm.submit();',
      'name'=>'user',
      'value'=>$user_id,
      'data'=>$user_list,
      'datakeys'=>array('id','name')));
    $form->addInput(array('type'=>'hidden','name'=>'user_changed'));
    $largeScreenCalendarRowSpan += 2;
    $smarty->assign('user_dropdown', 1);
  }
}

// Create week_durations table.
$table = new Table('week_durations');
// $table->setCssClass('week_view_table'); // Currently not used. Fix this.
$table->setTableOptions(array('width'=>'100%','cellspacing'=>'1','cellpadding'=>'3','border'=>'0'));
$table->setRowOptions(array('class'=>'tableHeaderCentered'));
$table->setData($dataArray);
// Add columns to table.
$table->addColumn(new TableColumn('label', '', new LabelCellRenderer(), $dayTotals['label']));



for ($i = 0; $i < 7; $i++) {
  if ($showWeekends)
    $table->addColumn(new TableColumn($dayHeaders[$i], $dayHeaders[$i], new WeekViewCellRenderer(), $dayTotals[$dayHeaders[$i]]));
  else {
    if ($i <> $weekend_start_idx && $i <> $weekend_end_idx)
      $table->addColumn(new TableColumn($dayHeaders[$i], $dayHeaders[$i], new WeekViewCellRenderer(), $dayTotals[$dayHeaders[$i]]));
  }
}
$table->setInteractive(false);
$form->addInputElement($table);

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $trackingMode && $showClient) {
  $active_clients = ttGroupHelper::getActiveClients(true);
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillProjectDropdown(this.value);',
    'name'=>'client',
    'value'=>$cl_client,
    'data'=>$active_clients,
    'datakeys'=>array('id', 'name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));
  $largeScreenCalendarRowSpan += 2;
  // Note: in other modes the client list is filtered to relevant clients only. See below.
}

// Billable checkbox.
if ($showBillable) {
  $form->addInput(array('type'=>'checkbox','name'=>'billable','value'=>$cl_billable));
  $largeScreenCalendarRowSpan += 2;
}

// If we have time custom fields - add controls for them.
if (isset($custom_fields) && $custom_fields->timeFields) {
  foreach ($custom_fields->timeFields as $timeField) {
    $field_name = 'time_field_'.$timeField['id'];
    if ($timeField['type'] == CustomFields::TYPE_TEXT) {
      $form->addInput(array('type'=>'text','name'=>$field_name,'value'=>$timeCustomFields[$timeField['id']]['value']));
    } elseif ($timeField['type'] == CustomFields::TYPE_DROPDOWN) {
      $form->addInput(array('type'=>'combobox','name'=>$field_name,
      'data'=>CustomFields::getOptions($timeField['id']),
      'value'=>$timeCustomFields[$timeField['id']]['value'],
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
    }
    $largeScreenCalendarRowSpan += 2;
  }
}

// If we show project dropdown, add controls for project and client.
$project_list = $client_list = array();
if ($showProject) {
  // Dropdown for projects assigned to user.
  $project_list = $user->getAssignedProjects();
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillTaskDropdown(this.value);',
    'name'=>'project',
    'value'=>$cl_project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));
  $largeScreenCalendarRowSpan += 2;

  // Dropdown for clients if the clients plugin is enabled.
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
      'value'=>$cl_client,
      'data'=>$client_list,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
    $largeScreenCalendarRowSpan += 2;
  }
}

// Task dropdown.
$task_list = array();
if ($showTask) {
  $task_list = ttGroupHelper::getActiveTasks();
  $form->addInput(array('type'=>'combobox',
    'name'=>'task',
    'value'=>$cl_task,
    'data'=>$task_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));
  $largeScreenCalendarRowSpan += 2;
}

// Week note control.
if ($showWeekNote) {
  $form->addInput(array('type'=>'textarea','name'=>'comment','value'=>$cl_note));
  $largeScreenCalendarRowSpan += 2;
}

// Calendar.
$form->addInput(array('type'=>'calendar','name'=>'date','value'=>$cl_date));

// A hidden control for today's date from user's browser.
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'get_date()')); // User current date, which gets filled in on btn_submit click.

// Submit button.
$form->addInput(array('type'=>'submit','name'=>'btn_submit','onclick'=>'browser_today.value=get_date()','value'=>$i18n->get('button.submit')));

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
      if ($showClient && $user->isOptionEnabled('client_required') && !$cl_client)
        $err->add($i18n->get('error.client'));
      // Validate input in time custom fields.
      if (isset($custom_fields) && $custom_fields->timeFields) {
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
          if (!$showWeekNotes || (0 == $rowNumber % 2)) {
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
                if (isset($custom_fields) && $custom_fields->timeFields) {
                  foreach ($custom_fields->timeFields as $timeField) {
                    $field_name = 'time_field_'.$timeField['id'];
                    if ($timeField['type'] == CustomFields::TYPE_TEXT)
                      $record[$field_name] = $timeCustomFields[$timeField['id']]['value'];
                    else if ($timeField['type'] == CustomFields::TYPE_DROPDOWN)
                      $record[$field_name.'_option_id'] = $timeCustomFields[$timeField['id']]['value'];
                  }
                }
                $fields['row_id'] = ttWeekViewHelper::makeRowIdentifier($record).'_0';
                // Note: no need to check for a possible conflict with an already existing row
                // because we are doing an insert that does not affect already existing data.

                if ($showWeekNote) {
                  $fields['note'] = $request->getParameter('comment');
                }
              }
              $fields['day_header'] = $dayHeader;
              $fields['start_date'] = $startDate->toString(); // To be able to determine date for the entry using $dayHeader.
              $fields['duration'] = $postedDuration;
              $fields['browser_today'] = $request->getParameter('browser_today', null);
              if ($showWeekNotes) {
                // Take note value from the control below duration.
                $noteRowNumber = $rowNumber + 1;
                $note_control_id =  $noteRowNumber.'_'.$dayHeader;
                if ($request->getParameter($note_control_id)) {
                  $fields['note'] = $request->getParameter($note_control_id); // This overwrites week note.
                }
              }
              $result = ttWeekViewHelper::insertDurationFromWeekView($fields, $custom_fields, $err);
            } elseif ($postedDuration == null || 0 == ttTimeHelper::toMinutes($postedDuration)) {
              // Delete an already existing record here.
              $result = ttTimeHelper::delete($dataArray[$rowNumber][$dayHeader]['tt_log_id']);
            } else {
              $fields = array();
              $fields['tt_log_id'] = $dataArray[$rowNumber][$dayHeader]['tt_log_id'];
              $fields['duration'] = $postedDuration;
              $result = ttWeekViewHelper::modifyDurationFromWeekView($fields, $err);
            }
            if (!$result) break; // Break out of the loop in case of first error.

          } else if ($showWeekNotes) {
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
            if (!$result) break; // Break out of the loop on first error.
          }
        }
        if (!$result) break; // Break out of the loop on first error.
        $rowNumber++;
      }
      if ($result) {
        header('Location: week.php'); // Normal exit.
        exit();
      }
    }
  }
} // isPost

$week_total = ttTimeHelper::getTimeForWeek($selected_date);

$smarty->assign('large_screen_calendar_row_span', $largeScreenCalendarRowSpan);
$smarty->assign('selected_date', $selected_date);
$smarty->assign('week_total', $week_total);
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="fillDropdowns()"');
$smarty->assign('timestring', $startDate->toString($user->date_format).' - '.$endDate->toString($user->date_format));
$smarty->assign('time_records', $records);
$smarty->assign('show_record_custom_fields', $showRecordCustomFields);
$smarty->assign('show_navigation', !$user->isOptionEnabled('week_menu'));
$smarty->assign('show_client', $showClient);
$smarty->assign('show_billable', $showBillable);
$smarty->assign('show_project', $showProject);
$smarty->assign('show_task', $showTask);
$smarty->assign('task_required', $taskRequired);
$smarty->assign('show_week_note', $showWeekNote);
$smarty->assign('show_week_list', $user->isOptionEnabled('week_list'));
$smarty->assign('show_start', $showStart);
$smarty->assign('show_files', $showFiles);
$smarty->assign('title', $i18n->get('menu.week'));
$smarty->assign('content_page_name', 'week.tpl');
$smarty->display('index.tpl');
