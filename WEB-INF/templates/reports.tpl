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

{$forms.reportForm.open}
<div style="padding: 0 0 10 0;">
  <table border="0" class="divider">
    <tr>
      <td>
        <table cellspacing="1" cellpadding="3" border="0">
          <tr>
            <td>{$i18n.label.fav_report}:</td><td>{$forms.reportForm.favorite_report.control}</td>
            <td>{$forms.reportForm.btn_generate.control}&nbsp;{$forms.reportForm.btn_delete.control}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>

<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td valign="top" colspan="2" align="center">
      <table border="0" cellpadding="3">
        <tr>
          <td valign="top">
            <table border="0" cellpadding="3">
{if $show_client}
              <tr><td><b>{$i18n.label.client}</b></td></tr>
              <tr><td>{$forms.reportForm.client.control}</td></tr>
{/if}
{if $show_project}
              <tr><td><b>{$i18n.label.project}</b></td></tr>
              <tr><td>{$forms.reportForm.project.control}</td></tr>
{/if}
{if $show_billable}
              <tr><td><b>{$i18n.form.time.billable}</b></td></tr>
              <tr><td>{$forms.reportForm.include_records.control}</td></tr>
{/if}
{if $show_paid_status}
              <tr><td><b>{$i18n.label.paid_status}</b></td></tr>
              <tr><td>{$forms.reportForm.paid_status.control}</td></tr>
{/if}
            </table>
          </td>
          <td></td>
          <td valign="top">
            <table border="0" cellpadding="3">
{if $show_cf_1_dropdown}
              <tr><td><b>{$i18n.label.option}</b></td></tr>
              <tr><td>{$forms.reportForm.option.control}</td></tr>
{/if}
{if $show_task}
              <tr><td><b>{$i18n.label.task}</b></td></tr>
              <tr><td>{$forms.reportForm.task.control}</td></tr>
{/if}
{if $show_approved}
              <tr><td><b>{$i18n.label.approved}</b></td></tr>
              <tr><td>{$forms.reportForm.approved.control}</td></tr>
{/if}
{if $show_invoice_dropdown}
              <tr><td><b>{$i18n.label.invoice}</b></td></tr>
              <tr><td>{$forms.reportForm.invoice.control}</td></tr>
{/if}
{if $show_timesheet_dropdown}
              <tr><td><b>{$i18n.label.timesheet}</b></td></tr>
              <tr><td>{$forms.reportForm.timesheet.control}</td></tr>
{/if}
            </table>
          </td>
        </tr>
{if $show_active_users}
        <tr>
          <td colspan="3"><b>{$i18n.form.users.active_users}</b></td>
        </tr>
        <tr>
          <td colspan="3">{$forms.reportForm.users_active.control}</td>
        </tr>
{/if}
{if $show_inactive_users}
        <tr>
          <td colspan="3"><b>{$i18n.form.users.inactive_users}</b></td>
        </tr>
        <tr>
          <td colspan="3">{$forms.reportForm.users_inactive.control}</td>
        </tr>
{/if}
        <tr>
          <td><b>{$i18n.form.reports.select_period}</b></td>
          <td>&nbsp;</td>
          <td><b>{$i18n.form.reports.set_period}</b></td>
        </tr>
        <tr valign="top">
          <td>{$forms.reportForm.period.control}</td>
          <td align="right">{$i18n.label.start_date}:</td>
          <td>{$forms.reportForm.start_date.control}</td>
        </tr>
        <tr>
          <td></td>
          <td align="right">{$i18n.label.end_date}:</td>
          <td>{$forms.reportForm.end_date.control}</td>
        </tr>
        <tr><td colspan="3"><b>{$i18n.form.reports.show_fields}</b></td></tr>
        <tr>
          <td colspan="3">
            <table border="0" width="100%">
              <tr>
                <td width="25%" valign="top">
                  <table border="0" cellpadding="3">
{if $show_client}
                    <tr><td><label>{$forms.reportForm.chclient.control}&nbsp;{$i18n.label.client}</label></td></tr>
{/if}
{if $show_project}
                    <tr><td><label>{$forms.reportForm.chproject.control}&nbsp;{$i18n.label.project}</label></td></tr>
{/if}
{if $show_timesheet_checkbox}
                    <tr><td><label>{$forms.reportForm.chtimesheet.control}&nbsp;{$i18n.label.timesheet}</label></td></tr>
{/if}
{if $show_cf_1_checkbox}
                    <tr><td><label>{$forms.reportForm.chcf_1.control}&nbsp;{$custom_fields->fields[0]['label']|escape}</label></td></tr>
{/if}
                  </table>
                </td>
                <td width="25%" valign="top">
                  <table border="0" cellpadding="3">
{if $show_start}
                    <tr><td><label>{$forms.reportForm.chstart.control}&nbsp;{$i18n.label.start}</label></td></tr>
{/if}
{if $show_task}
                    <tr><td><label>{$forms.reportForm.chtask.control}&nbsp;{$i18n.label.task}</label></td></tr>
{/if}
{if $show_ip}
                    <tr><td><label>{$forms.reportForm.chip.control}&nbsp;{$i18n.label.ip}</label></td></tr>
{/if}
{if $show_work_units}
                    <tr><td><label>{$forms.reportForm.chunits.control}&nbsp;{$i18n.label.work_units}</label></td></tr>
{/if}
                  </table>
                </td>
                <td width="25%" valign="top">
                  <table border="0" cellpadding="3">
{if $show_finish}
                    <tr><td><label>{$forms.reportForm.chfinish.control}&nbsp;{$i18n.label.finish}</label></td></tr>
{/if}
                    <tr><td><label>{$forms.reportForm.chnote.control}&nbsp;{$i18n.label.note}</label></td></tr>
{if $show_approved}
                    <tr><td><label>{$forms.reportForm.chapproved.control}&nbsp;{$i18n.label.approved}</label></td></tr>
{/if}
{if $show_invoice_checkbox}
                    <tr><td><label>{$forms.reportForm.chinvoice.control}&nbsp;{$i18n.label.invoice}</label></td></tr>
{/if}
                  </table>
                </td>
                <td width="25%" valign="top">
                  <table border="0" cellpadding="3">
                    <tr><td><label>{$forms.reportForm.chduration.control}&nbsp;{$i18n.label.duration}</label></td></tr>
                    <tr><td><label>{$forms.reportForm.chcost.control}&nbsp;{$i18n.label.cost}</label></td></tr>
{if $show_paid_status}
                    <tr><td><label>{$forms.reportForm.chpaid.control}&nbsp;{$i18n.label.paid}</label></td></tr>
{/if}
{if $show_files}
                    <tr><td><label>{$forms.reportForm.chfiles.control}&nbsp;{$i18n.label.files}</label></td></tr>
{/if}
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr><td><b>{$i18n.form.reports.group_by}</b></td></tr>
        <tr valign="top">
          <td>{$forms.reportForm.group_by1.control}</td>
          <td>{$forms.reportForm.group_by2.control}</td>
          <td>{$forms.reportForm.group_by3.control}</td>
        </tr>
        <tr>
            <td><span id="totals_only_label"><label>{$forms.reportForm.chtotalsonly.control} {$i18n.label.totals_only}</label></span></td>
        </tr>
      </table>

<div style="padding: 10 0 10 0;">
  <table border="0" class="divider">
    <tr>
      <td align="center">
        <table cellspacing="1" cellpadding="3" border="0">
          <tr>
            <td>{$i18n.form.reports.save_as_favorite}:</td><td>{$forms.reportForm.new_fav_report.control}</td>
            <td>{$forms.reportForm.btn_save.control}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>

      <table border="0" cellpadding="3" width="100%">
        <tr><td colspan="3" height="50" align="center">{$forms.reportForm.btn_generate.control}</td></tr>
      </table>
    </td>
  </tr>
</table>
{$forms.reportForm.close}
