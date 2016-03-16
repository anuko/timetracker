<script>
// We need a few arrays to populate project and task dropdowns.
// When client selection changes, the project dropdown must be re-populated with only relevant projects.
// When project selection changes, the task dropdown must be repopulated similarly.
// Format:
// project_ids[143] = "325,370,390,400";  // Comma-separated list of project ids for client.
// project_names[325] = "Time Tracker";   // Project name.
// task_ids[325] = "100,101,302,303,304"; // Comma-separated list ot task ids for project.
// task_names[100] = "Coding";            // Task name.

//Prepare an array of projects ids for clients.
project_ids = new Array();
{foreach $client_list as $client}
  project_ids[{$client.id}] = "{$client.projects}";
{/foreach}
// Prepare an array of project names.
project_names = new Array();
{foreach $project_list as $project}
  project_names[{$project.id}] = "{$project.name|escape:'javascript'}";
{/foreach}
// We'll use this array to populate project dropdown when client is not selected.
var idx = 0;
projects = new Array();
{foreach $project_list as $project}
  projects[idx] = new Array("{$project.id}", "{$project.name|escape:'javascript'}");
  idx++;
{/foreach}

// Prepare an array of task ids for projects.
task_ids = new Array();
{foreach $project_list as $project}
  task_ids[{$project.id}] = "{$project.tasks}";
{/foreach}
// Prepare an array of task names.
task_names = new Array();
{foreach $task_list as $task}
  task_names[{$task.id}] = "{$task.name|escape:'javascript'}";
{/foreach}

// Mandatory top options for project and task dropdowns.
empty_label_project = '{$i18n.dropdown.select|escape:'javascript'}';
empty_label_task = '{$i18n.dropdown.select|escape:'javascript'}';

// The populateDropdowns function populates the "project" and "task" dropdown controls
// with relevant values.
function fillDropdowns() {
  if(document.body.contains(document.timeRecordForm.client))
    fillProjectDropdown(document.timeRecordForm.client.value);

  fillTaskDropdown(document.timeRecordForm.project.value);
}

// The fillProjectDropdown function populates the project combo box with
// projects associated with a selected client (client id is passed here as id).    
function fillProjectDropdown(id) {
  var str_ids = project_ids[id];

  var dropdown = document.getElementById("project");
  // Determine previously selected item.
  var selected_item = dropdown.options[dropdown.selectedIndex].value;

  // Remove existing content.
  dropdown.length = 0;
  var project_reset = true;
  // Add mandatory top option.
  dropdown.options[0] = new Option(empty_label_project, '', true);

  // Populate project dropdown.
  if (!id) {
    // If we are here, client is not selected.
	var len = projects.length;
    for (var i = 0; i < len; i++) {
      dropdown.options[i+1] = new Option(projects[i][1], projects[i][0]);
      if (dropdown.options[i+1].value == selected_item)  {
        dropdown.options[i+1].selected = true;
        project_reset = false;
      }
    }
  } else if (str_ids) {
    var ids = new Array();
    ids = str_ids.split(",");
    var len = ids.length;

    for (var i = 0; i < len; i++) {
      var p_id = ids[i];
      dropdown.options[i+1] = new Option(project_names[p_id], p_id);
      if (dropdown.options[i+1].value == selected_item)  {
        dropdown.options[i+1].selected = true;
        project_reset = false;
      }
    }
  }

  // If project selection was reset - clear the tasks dropdown.
  if (project_reset) {
    dropdown = document.getElementById("task");
    dropdown.length = 0;
    dropdown.options[0] = new Option(empty_label_task, '', true);
  }
}

// The fillTaskDropdown function populates the task combo box with
// tasks associated with a selected project (project id is passed here as id).    
function fillTaskDropdown(id) {
  var str_ids = task_ids[id];

  var dropdown = document.getElementById("task");
  if (dropdown == null) return; // Nothing to do.
  
  // Determine previously selected item.
  var selected_item = dropdown.options[dropdown.selectedIndex].value;

  // Remove existing content.
  dropdown.length = 0;
  // Add mandatory top option.
  dropdown.options[0] = new Option(empty_label_task, '', true);

  // Populate the dropdown from the task_names array.
  if (str_ids) {
    var ids = new Array();
    ids = str_ids.split(",");
    var len = ids.length;

    var idx = 1;
    for (var i = 0; i < len; i++) {
      var t_id = ids[i];
      if (task_names[t_id]) {
        dropdown.options[idx] = new Option(task_names[t_id], t_id);
        idx++;
      }
    }

    // If a previously selected item is still in dropdown - select it.
	if (dropdown.options.length > 0) {
      for (var i = 0; i < dropdown.options.length; i++) {
        if (dropdown.options[i].value == selected_item) {
          dropdown.options[i].selected = true;
        }
      }
    }
  }
}

function get_date() {
  var date = new Date();
  return date.strftime("%Y-%m-%d");
}

function get_time() {
  var date = new Date();
  return date.strftime("%H:%M");
}
</script>

<style>
.not_billable td {
	color: #ff6666;
}
</style>

<p><span id="hour">00</span><span id="separator">:</span><span id="min">00</span>


<script>
var timerID = null;
var startDate = null;
var endDate = null;
var delta = null;
var separatorVisible = true;

function toggleSeparator() {
  document.getElementById('separator').style.visibility = separatorVisible ? 'hidden' : 'visible';
  separatorVisible = !separatorVisible;
}

function updateTimer() {
  if (startDate == null) startDate = new Date();
  endDate = new Date();
  delta = new Date(endDate - startDate);
  
  var hours = delta.getUTCHours();
  if (hours < 10) hours = '0'+hours;
  document.getElementById('hour').innerHTML = hours;

  var minutes = delta.getUTCMinutes();
  if (minutes <  10) minutes = '0'+minutes;
  document.getElementById('min').innerHTML = minutes;

  // Toggle visibility of separator for 100 ms.
  toggleSeparator();
  setTimeout('toggleSeparator()', 100);
}

function startTimer() {
  if (timerID) return;
  
  updateTimer();
  timerID = setInterval('updateTimer()', 1000);
}

function stopTimer() {
  clearInterval(timerID);
  timerID = null;
}
</script>

{if $uncompleted}
<script>
startDate = new Date();
startDate.setHours({substr($uncompleted['start'], 0, 2)});
startDate.setMinutes({substr($uncompleted['start'], 3, 2)});
startDate.setSeconds(0);
updateTimer();
startTimer();
</script>    
{/if}

<!--
<table cellspacing="3" cellpadding="0" border="0" width="100%">
<tr>
  <td align="center">
    {if $time_records}
      <table border='0' cellpadding='4' cellspacing='1' width="100%">
      {foreach $time_records as $record}
      <tr bgcolor="{cycle values="#ccccce,#f5f5f5"}" {if !$record.billable} class="not_billable" {/if}>
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <td valign='top'>{$record.project|escape:'html'}</td>
{/if}
        <td align='right' valign='top'>{if $record.duration == '0:00'}<font color="#ff0000">{/if}{$record.duration}{if $record.duration == '0:00'}</font>{/if}
        <td align='center'>{if $record.invoice_id}&nbsp;{else}<a href='time_edit.php?id={$record.id}'>{$i18n.label.edit}</a>{/if}</td>
      </tr>
      {/foreach}
	  </table>
	  <table border='0'>
      <tr>
        <td align='right'>{$i18n.label.day_total}:</td>
        <td>{$day_total}</td>
      </tr>
      </table>
    {/if}
  </td>
</tr>
</table>
-->

{$forms.timerRecordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table width = "100%">
  <tr>
  	<td valign="top">
    <table border="0">
{if in_array('cl', explode(',', $user->plugins))}
    <tr><td>{$i18n.label.client}:</td></tr>
    <tr><td>{$forms.timerRecordForm.client.control}</td></tr>
{/if}
{if in_array('iv', explode(',', $user->plugins))}
    <tr><td><label>{$forms.timerRecordForm.billable.control}{$i18n.form.time.billable}</label></td></tr>
{/if}
{if ($custom_fields && $custom_fields->fields[0])}
      <tr><td>{$custom_fields->fields[0]['label']|escape:'html'}:</td></tr>
      <tr><td>{$forms.timerRecordForm.cf_1.control}</td></tr>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <tr><td>{$i18n.label.project}:</td></tr>
    <tr><td>{$forms.timerRecordForm.project.control}</td></tr>
{/if}
{if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <tr><td>{$i18n.label.task}:</td></tr>
    <tr><td>{$forms.timerRecordForm.task.control}</td></tr>
{/if}
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" height="50" align="center">{$forms.timerRecordForm.btn_start.control} {$forms.timerRecordForm.btn_stop.control}</td>
  </tr>
  </table>
  </td>
</tr>
</table>
{$forms.timerRecordForm.close}

<table cellspacing="3" cellpadding="0" border="0" width="100%">
<tr>
  <td align="center">
    {if $time_records}
    <table border='0'>
      <tr>
        <td align='right'>{$i18n.label.day_total}:</td>
        <td>{$day_total}</td>
      </tr>
      <tr>
        <td align='right'>{$i18n.label.week_total}:</td>
        <td>{$week_total}</td>
      </tr>
    </table>
    {/if}
  </td>
</tr>
</table>