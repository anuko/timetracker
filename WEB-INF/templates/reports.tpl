<script>
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


// empty_label is the mandatory top option in the tasks dropdown.
empty_label = '{$i18n.dropdown.all|escape:'javascript'}';

// inArray - determines whether needle is in haystack array.
function inArray(needle, haystack) {
  var length = haystack.length;
  for(var i = 0; i < length; i++) {
    if(haystack[i] == needle) return true;
  }
  return false;
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

// handleCheckboxes - unmarks and disables the "Totals only" checkbox when
// "no grouping" is selected in the associated dropdown.
// In future we need to improve this function and hide not relevant elements completely.
function handleCheckboxes() {
  var totalsOnlyCheckbox = document.getElementById("chtotalsonly");
  if ("no_grouping" == document.getElementById("group_by").value) {
    // Unmark and disable the "Totals only" checkbox.
    totalsOnlyCheckbox.checked = false;
    totalsOnlyCheckbox.disabled = true;
  } else
    totalsOnlyCheckbox.disabled = false;
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
{if (($user->isPluginEnabled('cl') && !($user->isClient() && $user->client_id)) || ($custom_fields && $custom_fields->fields[0] && $custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN))}
        <tr>
  {if $user->isPluginEnabled('cl') && !($user->isClient() && $user->client_id)}<td><b>{$i18n.label.client}</b></td>{else}<td>&nbsp;</td>{/if}
          <td>&nbsp;</td>
  {if ($custom_fields && $custom_fields->fields[0] && $custom_fields->fields[0]['type'] == CustomFields::TYPE_DROPDOWN)}<td><b>{$i18n.label.option}</b></td>{else}<td>&nbsp;</td>{/if}
        </tr>
        <tr>
          <td>{$forms.reportForm.client.control}</td>
          <td>&nbsp;</td>
          <td>{$forms.reportForm.option.control}</td>
        </tr>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr>
          <td><b>{$i18n.label.project}</b></td>
          <td>&nbsp;</td>
  {if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
          <td><b>{$i18n.label.task}</b></td>
  {/if}
        </tr>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr>
          <td>{$forms.reportForm.project.control}</td>
          <td>&nbsp;</td>
  {if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
          <td>{$forms.reportForm.task.control}</td>
  {/if}
        </tr>
{/if}
{if $user->isPluginEnabled('iv')}
        <tr>
          <td><b>{$i18n.form.time.billable}</b></td>
          <td>&nbsp;</td>
  {if $user->can('manage_invoices')}
          <td><b>{$i18n.label.invoice}</b></td>
  {/if}
        </tr>
        <tr valign="top">
          <td>{$forms.reportForm.include_records.control}</td>
          <td>&nbsp;</td>
  {if $user->can('manage_invoices')}
          <td>{$forms.reportForm.invoice.control}</td>
        </tr>
  {/if}
{/if}
{if ($user->can('manage_invoices') && $user->isPluginEnabled('ps'))}
        <tr>
          <td><b>{$i18n.label.paid_status}</b></td>
        </tr>
        <tr>
          <td>{$forms.reportForm.paid_status.control}</td>
        </tr>
{/if}
{if $user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()}
        <tr>
          <td colspan="3"><b>{$i18n.label.users}</b></td>
        </tr>
        <tr>
          <td colspan="3">{$forms.reportForm.users.control}</td>
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
{if $user->can('view_reports') || $user->can('view_all_reports') || $user->isPluginEnabled('cl') || $user->isPluginEnabled('iv') || $user->isPluginEnabled('ps')}
              <tr>
  {if $user->isPluginEnabled('cl')}
                <td width="25%"><label>{$forms.reportForm.chclient.control}&nbsp;{$i18n.label.client}</label></td>
  {/if}
  {if ($user->can('manage_invoices') || $user->isClient()) && $user->isPluginEnabled('iv')}
                <td width="25%"><label>{$forms.reportForm.chinvoice.control}&nbsp;{$i18n.label.invoice}</label></td>
  {/if}
  {if ($user->can('manage_invoices') && $user->isPluginEnabled('ps'))}
                <td width="25%"><label>{$forms.reportForm.chpaid.control}&nbsp;{$i18n.label.paid}</label></td>
  {/if}
  {if $user->can('view_reports') || $user->can('view_all_reports')}
                <td width="25%"><label>{$forms.reportForm.chip.control}&nbsp;{$i18n.label.ip}</label></td>
  {/if}
              </tr>
{/if}
              <tr>
                <td width="25%">{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}<label>{$forms.reportForm.chproject.control}&nbsp;{$i18n.label.project}</label>{/if}</td>
                <td width="25%">{if (($smarty.const.TYPE_START_FINISH == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}<label>{$forms.reportForm.chstart.control}&nbsp;{$i18n.label.start}</label>{/if}</td>
                <td width="25%"><label>{$forms.reportForm.chduration.control}&nbsp;{$i18n.label.duration}</label></td>
{if ($user->can('manage_invoices') || $user->isClient()) || $user->isPluginEnabled('ex')}
                  <td width="25%"><label>{$forms.reportForm.chcost.control}&nbsp;{$i18n.label.cost}</label></td>
{else}
                  <td></td>
{/if}
              </tr>
              <tr>
                <td>{if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}<label>{$forms.reportForm.chtask.control}&nbsp;{$i18n.label.task}</label>{/if}</td>
                <td>{if (($smarty.const.TYPE_START_FINISH == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}<label>{$forms.reportForm.chfinish.control}&nbsp;{$i18n.label.finish}</label>{/if}</td>
                <td><label>{$forms.reportForm.chnote.control}&nbsp;{$i18n.label.note}</label></td>
{if ($custom_fields && $custom_fields->fields[0])}
                <td><label>{$forms.reportForm.chcf_1.control}&nbsp;{$custom_fields->fields[0]['label']|escape}</label></td>
{else}
                <td></td>
{/if}
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td><b>{$i18n.form.reports.group_by}</b></td>
        </tr>
        <tr valign="top">
          <td>{$forms.reportForm.group_by.control} <label>{$forms.reportForm.chtotalsonly.control} {$i18n.form.reports.totals_only}</label></td>
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
