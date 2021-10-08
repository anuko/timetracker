{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
// We need a few arrays to populate project dropdown.
// When client selection changes, the project dropdown must be re-populated with only relevant projects.
// Format:
// project_ids[143] = "325,370,390,400";  // Comma-separated list of project ids for client.
// project_names[325] = "Time Tracker";   // Project name.

// Prepare an array of project ids for clients.
var project_ids = new Array();
{foreach $client_list as $client}
  project_ids[{$client.id}] = "{$client.projects}";
{/foreach}
// Prepare an array of project names.
var project_names = new Array();
{foreach $project_list as $project}
  project_names[{$project.id}] = "{$project.name|escape:'javascript'}";
{/foreach}
// We'll use this array to populate project dropdown when client is not selected.
var idx = 0;
var projects = new Array();
{foreach $project_list as $project}
  projects[idx] = new Array("{$project.id}", "{$project.name|escape:'javascript'}");
  idx++;
{/foreach}

// We need a couple of array-like objects, one for associated task ids, another for task names.
// For performance, and because associated arrays are frowned upon in JavaScript, we'll use a simple object
// with properties for project tasks. Format:

// obj_tasks.p325 = "100,101,302,303,304"; // Tasks ids for project 325 are "100,101,302,303,304".
// obj_tasks.p408 = "100,302";  // Tasks ids for project 408 are "100,302".

// Create an object for task ids.
obj_tasks = {};
var project_prefix = "p"; // Prefix for project property.
var project_property;

// Populate obj_tasks with task ids for each relevant project.
{foreach $project_list as $project}
  project_property = project_prefix + {$project.id};
  obj_tasks[project_property] = "{$project.tasks}";
{/foreach}

// Prepare an array of task names.
// Format: task_names[0] = Array(100, 'Coding'), task_names[1] = Array(302, 'Debugging'), etc...
// First element = task_id, second element = task name.
task_names = new Array();
var idx = 0;
{foreach $task_list as $task}
  task_names[idx] = new Array({$task.id}, "{$task.name|escape:'javascript'}");
  idx++;
{/foreach}

// empty_label is the mandatory top option in dropdowns.
empty_label = '{$i18n.dropdown.all|escape:'javascript'}';

// inArray - determines whether needle is in haystack array.
function inArray(needle, haystack) {
  var length = haystack.length;
  for(var i = 0; i < length; i++) {
    if(haystack[i] == needle) return true;
  }
  return false;
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
  dropdown.options[0] = new Option(empty_label, '', true);

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
    dropdown.options[0] = new Option(empty_label, '', true);
  }
}


// The fillTaskDropdown function populates the task combo box with
// tasks associated with a selected project_id.
function fillTaskDropdown(project_id) {
  var str_task_ids;
  // Get a string of comma-separated task ids.
  if (project_id) {
    var property = "p" + project_id;
    str_task_ids = obj_tasks[property];
  }
  if (str_task_ids) {
    var task_ids = new Array(); // Array of task ids.
    task_ids = str_task_ids.split(",");
  }

  var dropdown = document.getElementById("task");
  // Determine previously selected item.
  var selected_item = dropdown.options[dropdown.selectedIndex].value;

  // Remove existing content.
  dropdown.length = 0;
  // Add mandatory top option.
  dropdown.options[0] = new Option(empty_label, '', true);

  // Populate the dropdown with associated tasks.
  len = task_names.length;
  var dropdown_idx = 0;
  for (var i = 0; i < len; i++) {
    if (!project_id) {
      // No project is selected. Fill in all tasks.
      dropdown.options[dropdown_idx+1] = new Option(task_names[i][1], task_names[i][0]);
      dropdown_idx++;
    } else if (str_task_ids) {
      // Project is selected and has associated tasks. Fill them in.
      if (inArray(task_names[i][0], task_ids)) {
        dropdown.options[dropdown_idx+1] = new Option(task_names[i][1], task_names[i][0]);
        dropdown_idx++;
      }
    }
  }

  // If a previously selected item is still in dropdown - select it.
  if (dropdown.options.length > 0) {
    for (var i = 0; i < dropdown.options.length; i++) {
      if (dropdown.options[i].value == selected_item)  {
        dropdown.options[i].selected = true;
      }
    }
  }
}

// The fillDropdowns function populates the "project" and "task" dropdown controls
// with relevant values.
function fillDropdowns() {
  if(document.body.contains(document.reportForm.client))
    fillProjectDropdown(document.reportForm.client.value);

  fillTaskDropdown(document.reportForm.project.value);
}

// Build JavaScript array for assigned projects out of passed in PHP array.
var assigned_projects = new Array();
{if $assigned_projects}
  {foreach $assigned_projects as $user_id => $projects}
    assigned_projects[{$user_id}] = new Array();
    {if $projects}
      {foreach $projects as $idx => $project_id}
        assigned_projects[{$user_id}][{$idx}] = {$project_id};
      {/foreach}
    {/if}
  {/foreach}
{/if}

// selectAssignedUsers is called when a project is changed in project dropdown.
// It selects users on the form who are assigned to this project.
function selectAssignedUsers(project_id) {
  var user_id;
  var len;

  for (var i = 0; i < document.reportForm.elements.length; i++) {
    if ((document.reportForm.elements[i].type == 'checkbox') && (document.reportForm.elements[i].name == 'users[]')) {
      user_id = document.reportForm.elements[i].value;
      if (project_id)
        document.reportForm.elements[i].checked = false;
      else
        document.reportForm.elements[i].checked = true;

      if(assigned_projects[user_id] != undefined)
        len = assigned_projects[user_id].length;
      else
        len = 0;

      if (project_id != '')
        for (var j = 0; j < len; j++) {
          if (project_id == assigned_projects[user_id][j]) {
            document.reportForm.elements[i].checked = true;
            break;
          }
        }
    }
  }
}

// handleCheckboxes - unmarks and hides the "Totals only" checkbox when
// "no grouping" is selected in the associated group by dropdowns.
function handleCheckboxes() {
  var totalsOnlyCheckbox = document.getElementById("chtotalsonly");
  var totalsOnlyLabel = document.getElementById("totals_only_label");
  var groupBy1 = document.getElementById("group_by1");
  var groupBy2 = document.getElementById("group_by2");
  var groupBy3 = document.getElementById("group_by3");
  var grouping = false;
  if ((groupBy1 != null && "no_grouping" != groupBy1.value) ||
      (groupBy2 != null && "no_grouping" != groupBy2.value) ||
      (groupBy3 != null && "no_grouping" != groupBy3.value)) {
    grouping = true;
  }
  if (grouping) {
    // Show the "Totals only" checkbox.
    totalsOnlyCheckbox.style.visibility = "visible";
    totalsOnlyLabel.style.visibility = "visible";
  } else {
    // Unmark and hide the "Totals only" checkbox.
    totalsOnlyCheckbox.checked = false;
    totalsOnlyCheckbox.style.visibility = "hidden";
    totalsOnlyLabel.style.visibility = "hidden";
  }
}
</script>

{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.reportForm.open}
<table class="centered-table">
  <tr><td class="text-cell">{$i18n.label.fav_report}:</td></tr>
  <tr><td class="td-with-input">{$forms.reportForm.favorite_report.control}</td></tr>
  <tr><td class="td-with-horizontally-centered-input">{$forms.reportForm.btn_generate.control}&nbsp;{$forms.reportForm.btn_delete.control}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="form-control-separator"></div>
<table class="centered-table">
  <tr><td colspan="2"><div class="section-header">{$i18n.form.reports.select_period}</div></td></tr>
  <tr class = "small-screen-label"><td><label for="period">{$i18n.form.reports.select_period}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="period">{$i18n.form.reports.select_period}:</label></td>
    <td class="td-with-input">{$forms.reportForm.period.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2"><div class="section-header">{$i18n.form.reports.set_period}</div></td></tr>
  <tr class = "small-screen-label"><td><label for="start_date">{$i18n.label.start_date}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="start_date">{$i18n.label.start_date}:</label></td>
    <td class="td-with-input">{$forms.reportForm.start_date.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="end_date">{$i18n.label.end_date}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="end_date">{$i18n.label.end_date}:</label></td>
    <td class="td-with-input">{$forms.reportForm.end_date.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="form-control-separator"></div>
{if $show_active_users}
<div class="section-header">{if $show_inactive_users}{$i18n.label.active_users}{else}{$i18n.label.users}{/if}</div>
<table class="x-scrollable-table">
  <tr><td class="td-with-input">{$forms.reportForm.users_active.control}</td></tr>
</table>
<div class="form-control-separator"></div>
{/if}
{if $show_inactive_users}
<div class="section-header">{$i18n.label.inactive_users}</div>
<table class="x-scrollable-table">
  <tr><td class="td-with-input">{$forms.reportForm.users_inactive.control}</td></tr>
</table>
<div class="form-control-separator"></div>
{/if}
<table class="centered-table">
{if $show_client}
  <tr class = "small-screen-label"><td><label for="client">{$i18n.label.client}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="client">{$i18n.label.client}:</label></td>
    <td class="td-with-input">{$forms.reportForm.client.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_billable}
  <tr class = "small-screen-label"><td><label for="include_records">{$i18n.form.time.billable}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="include_records">{$i18n.form.time.billable}:</label></td>
    <td class="td-with-input">{$forms.reportForm.include_records.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_invoice_dropdown}
  <tr class = "small-screen-label"><td><label for="invoice">{$i18n.label.invoice}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="invoice">{$i18n.label.invoice}:</label></td>
    <td class="td-with-input">{$forms.reportForm.invoice.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_paid_status}
  <tr class = "small-screen-label"><td><label for="paid_status">{$i18n.label.paid_status}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="paid_status">{$i18n.label.paid_status}:</label></td>
    <td class="td-with-input">{$forms.reportForm.paid_status.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_project}
  <tr class = "small-screen-label"><td><label for="project">{$i18n.label.project}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="project">{$i18n.label.project}:</label></td>
    <td class="td-with-input">{$forms.reportForm.project.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_task}
  <tr class = "small-screen-label"><td><label for="task">{$i18n.label.task}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="task">{$i18n.label.task}:</label></td>
    <td class="td-with-input">{$forms.reportForm.task.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_approved}
  <tr class = "small-screen-label"><td><label for="approved">{$i18n.label.approved}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="approved">{$i18n.label.approved}:</label></td>
    <td class="td-with-input">{$forms.reportForm.approved.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_timesheet_dropdown}
  <tr class = "small-screen-label"><td><label for="timesheet">{$i18n.label.timesheet}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="timesheet">{$i18n.label.timesheet}:</label></td>
    <td class="td-with-input">{$forms.reportForm.timesheet.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
</table>
<div class="form-control-separator"></div>
<table class="centered-table">
  <tr><td colspan="2"><div class="section-header">{$i18n.form.reports.show_fields}</div></td></tr>
{if $show_client}
  <tr class = "small-screen-label"><td><label for="chclient">{$i18n.label.client}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chclient">{$i18n.label.client}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chclient.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_project}
  <tr class = "small-screen-label"><td><label for="chproject">{$i18n.label.project}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chproject">{$i18n.label.project}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chproject.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_task}
  <tr class = "small-screen-label"><td><label for="chtask">{$i18n.label.task}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chtask">{$i18n.label.task}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chtask.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_start}
  <tr class = "small-screen-label"><td><label for="chstart">{$i18n.label.start}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chstart">{$i18n.label.start}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chstart.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_finish}
  <tr class = "small-screen-label"><td><label for="chfinish">{$i18n.label.finish}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chfinish">{$i18n.label.finish}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chfinish.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="chduration">{$i18n.label.duration}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chduration">{$i18n.label.duration}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chduration.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="chnote">{$i18n.label.note}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chnote">{$i18n.label.note}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chnote.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $show_work_units}
  <tr class = "small-screen-label"><td><label for="chunits">{$i18n.label.work_units}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chunits">{$i18n.label.work_units}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chunits.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="chcost">{$i18n.label.cost}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chcost">{$i18n.label.cost}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chcost.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $show_approved}
  <tr class = "small-screen-label"><td><label for="chapproved">{$i18n.label.approved}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chapproved">{$i18n.label.approved}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chapproved.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_paid_status}
  <tr class = "small-screen-label"><td><label for="chpaid">{$i18n.label.paid}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chpaid">{$i18n.label.paid}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chpaid.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_ip}
  <tr class = "small-screen-label"><td><label for="chip">{$i18n.label.ip}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chip">{$i18n.label.ip}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chip.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_invoice_checkbox}
  <tr class = "small-screen-label"><td><label for="chinvoice">{$i18n.label.invoice}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chinvoice">{$i18n.label.invoice}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chinvoice.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_timesheet_checkbox}
  <tr class = "small-screen-label"><td><label for="chtimesheet">{$i18n.label.timesheet}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chtimesheet">{$i18n.label.timesheet}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chtimesheet.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_files}
  <tr class = "small-screen-label"><td><label for="chfiles">{$i18n.label.files}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="chfiles">{$i18n.label.files}:</label></td>
    <td class="td-with-input">{$forms.reportForm.chfiles.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
</table>
<div class="form-control-separator"></div>
<table class="centered-table">
{if isset($custom_fields) && $custom_fields->timeFields}
  <tr><td colspan="2"><div class="section-header">{$i18n.form.reports.time_fields}</div></td></tr>
  {foreach $custom_fields->timeFields as $timeField}
    {assign var="control_name" value='time_field_'|cat:$timeField['id']}
    {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
  <tr class = "small-screen-label"><td><label for="{$control_name}">{$timeField['label']|escape}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="{$control_name}">{$timeField['label']|escape}:</label></td>
    {assign var="control_name" value='time_field_'|cat:$timeField['id']}
    {assign var="checkbox_control_name" value='show_time_field_'|cat:$timeField['id']}
    <td class="td-with-input">{$forms.reportForm.$control_name.control} {$forms.reportForm.$checkbox_control_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  {/foreach}
{/if}
{if isset($custom_fields) && $custom_fields->userFields}
  <tr><td colspan="2"><div class="section-header">{$i18n.form.reports.user_fields}</div></td></tr>
  {foreach $custom_fields->userFields as $userField}
    {assign var="control_name" value='user_field_'|cat:$userField['id']}
    {assign var="checkbox_control_name" value='show_user_field_'|cat:$userField['id']}
  <tr class = "small-screen-label"><td><label for="{$control_name}">{$userField['label']|escape}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="{$control_name}">{$userField['label']|escape}:</label></td>
    <td class="td-with-input">{$forms.reportForm.$control_name.control} {$forms.reportForm.$checkbox_control_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  {/foreach}
{/if}
</table>
<div class="form-control-separator"></div>
<table class="centered-table">
  <tr><td><div class="section-header">{$i18n.form.reports.group_by}</div></td></tr>
  <tr><td class="td-with-input">{$forms.reportForm.group_by1.control}</td></tr>
  <tr><td class="td-with-input">{$forms.reportForm.group_by2.control}</td></tr>
  <tr><td class="td-with-input">{$forms.reportForm.group_by3.control}</td></tr>
  <tr><td class="td-with-input"><span id="totals_only_label"><label>{$forms.reportForm.chtotalsonly.control} {$i18n.label.totals_only}</label></span></td></tr>
</table>
<div class="form-control-separator"></div>
<table class="centered-table">
  <tr><td class="text-cell"><label for="new_fav_report">{$i18n.form.reports.save_as_favorite}:</label></td></tr>
  <tr><td class="td-with-input">{$forms.reportForm.new_fav_report.control} {$forms.reportForm.btn_save.control}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.reportForm.btn_generate.control}</div>
{$forms.reportForm.close}
