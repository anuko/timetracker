<script>
// We need a few arrays to populate project and task dropdowns.
// When client selection changes, the project dropdown must be re-populated with only relevant projects.
// When project selection changes, the task dropdown must be repopulated similarly.
// Format:
// project_ids[143] = "325,370,390,400";  // Comma-separated list of project ids for client.
// project_names[325] = "Time Tracker";   // Project name.
// task_ids[325] = "100,101,302,303,304"; // Comma-separated list ot task ids for project.
// task_names[100] = "Coding";            // Task name.

// Prepare an array of project ids for clients.
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

// The fillDropdowns function populates the "project" and "task" dropdown controls
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
        if (dropdown.options[i].value == selected_item)  {
          dropdown.options[i].selected = true;
        }
      }
    }
  }
}

// The formDisable function disables some fields depending on what we have in other fields.
function formDisable(formField) {
  var formFieldValue = eval("document.timeRecordForm." + formField + ".value");
  var formFieldName = eval("document.timeRecordForm." + formField + ".name");
  var x;

  if (((formFieldValue != "") && (formFieldName == "start")) || ((formFieldValue != "") && (formFieldName == "finish"))) {
    x = eval("document.timeRecordForm.duration");
    x.value = "";
    x.disabled = true;
    x.style.background = "#e9e9e9";
  }

  if (((formFieldValue == "") && (formFieldName == "start") && (document.timeRecordForm.finish.value == "")) || ((formFieldValue == "") && (formFieldName == "finish") && (document.timeRecordForm.start.value == ""))) {
    x = eval("document.timeRecordForm.duration");
    x.value = "";
    x.disabled = false;
    x.style.background = "white";
  }

  if ((formFieldValue != "") && (formFieldName == "duration")) {
    x = eval("document.timeRecordForm.start");
    x.value = "";
    x.disabled = true;
    x.style.background = "#e9e9e9";
    x = eval("document.timeRecordForm.finish");
    x.value = "";
    x.disabled = true;
    x.style.background = "#e9e9e9";
  }

  if ((formFieldValue == "") && (formFieldName == "duration")) {
    x = eval("document.timeRecordForm.start");
    x.disabled = false;
    x.style.background = "white";
    x = eval("document.timeRecordForm.finish");
    x.disabled = false;
    x.style.background = "white";
  }
}

// The setNow function fills a given field with current time.
function setNow(formField) {
  var x = eval("document.timeRecordForm.start");
  x.disabled = false;
  x.style.background = "white";
  x = eval("document.timeRecordForm.finish");
  x.disabled = false;
  x.style.background = "white";
  var today = new Date();
  var time_format = '{$user->time_format}';
  var obj = eval("document.timeRecordForm." + formField);
  obj.value = today.strftime(time_format);
  formDisable(formField);
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

{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="0" border="0">
  <tr>
    <td valign="top">
      <table>
{if $on_behalf_control}
        <tr>
          <td align="right">{$i18n.label.user}:</td>
          <td>{$forms.timeRecordForm.onBehalfUser.control}</td>
        </tr>
{/if}
{if $user->isPluginEnabled('cl')}
        <tr>
          <td align="right">{$i18n.label.client}{if $user->isPluginEnabled('cm')} (*){/if}:</td>
          <td>{$forms.timeRecordForm.client.control}</td>
        </tr>
{/if}
{if $user->isPluginEnabled('iv')}
        <tr>
          <td align="right">&nbsp;</td>
          <td><label>{$forms.timeRecordForm.billable.control}{$i18n.form.time.billable}</label></td>
        </tr>
{/if}
{if ($custom_fields && $custom_fields->fields[0])}
        <tr>
          <td align="right">{$custom_fields->fields[0]['label']|escape}{if $custom_fields->fields[0]['required']} (*){/if}:</td><td>{$forms.timeRecordForm.cf_1.control}</td>
        </tr>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr>
          <td align="right">{$i18n.label.project} (*):</td>
          <td>{$forms.timeRecordForm.project.control}</td>
        </tr>
{/if}
{if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr>
          <td align="right">{$i18n.label.task}:</td>
          <td>{$forms.timeRecordForm.task.control}</td>
        </tr>
{/if}
{if (($smarty.const.TYPE_START_FINISH == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
        <tr>
          <td align="right">{$i18n.label.start}:</td>
          <td>{$forms.timeRecordForm.start.control}&nbsp;<input onclick="setNow('start');" type="button" tabindex="-1" value="{$i18n.button.now}"></td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.finish}:</td>
          <td>{$forms.timeRecordForm.finish.control}&nbsp;<input onclick="setNow('finish');" type="button" tabindex="-1" value="{$i18n.button.now}"></td>
        </tr>
{/if}
{if (($smarty.const.TYPE_DURATION == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
        <tr>
          <td align="right">{$i18n.label.duration}:</td>
          <td>{$forms.timeRecordForm.duration.control}&nbsp;{$i18n.form.time.duration_format}</td>
        </tr>
{/if}
      </table>
    </td>
    <td valign="top">
      <table>
        <tr><td>{$forms.timeRecordForm.date.control}</td></tr>
      </table>
    </td>
  </tr>
</table>

<table>
  <tr>
    <td align="right">{$i18n.label.note}:</td>
    <td align="left">{$forms.timeRecordForm.note.control}</td>
  </tr>
  <tr>
    <td align="center" colspan="2">{$forms.timeRecordForm.btn_submit.control}</td>
  </tr>
</table>

<table width="720">
<tr>
  <td valign="top">
{if $time_records}
      <table border="0" cellpadding="3" cellspacing="1" width="100%">
      <tr>
  {if $user->isPluginEnabled('cl')}
        <td width="20%" class="tableHeader">{$i18n.label.client}</td>
  {/if}
  {if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <td class="tableHeader">{$i18n.label.project}</td>
  {/if}
  {if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <td class="tableHeader">{$i18n.label.task}</td>
  {/if}
  {if (($smarty.const.TYPE_START_FINISH == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
        <td width="5%" class="tableHeader" align="right">{$i18n.label.start}</td>
        <td width="5%" class="tableHeader" align="right">{$i18n.label.finish}</td>
  {/if}
        <td width="5%" class="tableHeader">{$i18n.label.duration}</td>
        <td class="tableHeader">{$i18n.label.note}</td>
        <td width="5%" class="tableHeader">{$i18n.label.edit}</td>
      </tr>
  {foreach $time_records as $record}
      <tr bgcolor="{cycle values="#f5f5f5,#ccccce"}" {if !$record.billable} class="not_billable" {/if}>
    {if $user->isPluginEnabled('cl')}
        <td valign="top">{$record.client|escape}</td>
    {/if}
    {if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <td valign="top">{$record.project|escape}</td>
    {/if}
    {if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <td valign="top">{$record.task|escape}</td>
    {/if}
    {if (($smarty.const.TYPE_START_FINISH == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
        <td nowrap align="right" valign="top">{if $record.start}{$record.start}{else}&nbsp;{/if}</td>
        <td nowrap align="right" valign="top">{if $record.finish}{$record.finish}{else}&nbsp;{/if}</td>
    {/if}
        <td align="right" valign="top">{if ($record.duration == '0:00' && $record.start <> '')}<font color="#ff0000">{$i18n.form.time.uncompleted}</font>{else}{$record.duration}{/if}</td>
        <td valign="top">{if $record.comment}{$record.comment|escape}{else}&nbsp;{/if}</td>
        <td valign="top" align="center">
    {if $record.invoice_id}
          &nbsp;
    {else}
          <a href="time_edit.php?id={$record.id}">{$i18n.label.edit}</a>
      {if ($record.duration == '0:00' && $record.start <> '')}
          <input type="hidden" name="record_id" value="{$record.id}">
          <input type="hidden" name="browser_date" value="">
          <input type="hidden" name="browser_time" value="">
          <input type="submit" id="btn_stop" name="btn_stop" onclick="browser_date.value=get_date();browser_time.value=get_time()" value="{$i18n.button.stop}">
      {/if}
    {/if}
        </td>
      </tr>
  {/foreach}
    </table>
{/if}
  </td>
</tr>
</table>
{if $time_records}
<table cellpadding="3" cellspacing="1" width="720">
  <tr>
    <td align="left">{$i18n.label.week_total}: {$week_total}</td>
    <td align="right">{$i18n.label.day_total}: {$day_total}</td>
  </tr>
  {if $user->isPluginEnabled('mq')}
  <tr>
    <td align="left">{$i18n.label.month_total}: {$month_total}</td>
    {if $over_quota}
    <td align="right">{$i18n.form.time.over_quota}: <span style="color: green;">{$quota_remaining}</span></td>
    {else}
    <td align="right">{$i18n.form.time.remaining_quota}: <span style="color: red;">{$quota_remaining}</span></td>
    {/if}
  </tr>
  {/if}
</table>
{/if}
{$forms.timeRecordForm.close}
