{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{include file="time_script.tpl"}

<div class="punch-timer"><span id="hour">00</span><span id="separator">:</span><span id="min">00</span></div>

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

{$forms.timeRecordForm.open}
<table class="centered-table">
{if $show_client}
  <tr class = "small-screen-label"><td><label for="client">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="client">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.client.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_billable}
  <tr>
    <td class = "large-screen-label">&nbsp;</td>
    <td><label class="checkbox-label">{$forms.timeRecordForm.billable.control}{$i18n.form.time.billable}</label></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if isset($custom_fields) && $custom_fields->timeFields}
  {foreach $custom_fields->timeFields as $timeField}
        {assign var="control_name" value='time_field_'|cat:$timeField['id']}
  <tr class = "small-screen-label"><td><label for="{$control_name}">{$timeField['label']|escape}{if $timeField['required']} (*){/if}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="{$control_name}">{$timeField['label']|escape}{if $timeField['required']} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.$control_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  {/foreach}
{/if}
{if $show_project}
  <tr class = "small-screen-label"><td><label for="project">{$i18n.label.project} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="project">{$i18n.label.project} (*):</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.project.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_task}
  <tr class = "small-screen-label"><td><label for="task">{$i18n.label.task}{if $task_required} (*){/if}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="task">{$i18n.label.task}{if $task_required} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.task.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
{if isset($forms.timeRecordForm.btn_start.control)}<div class="button-set">{$forms.timeRecordForm.btn_start.control}</div>{/if}
{if isset($forms.timeRecordForm.btn_stop.control)}<div class="button-set">{$forms.timeRecordForm.btn_stop.control}</div>{/if}
{if $time_records}
<div class="record-list">
<table class="x-scrollable-table">
  <tr>
  {if $show_client}
    <th>{$i18n.label.client}</th>
  {/if}
  {if $show_record_custom_fields && isset($custom_fields) && $custom_fields->timeFields}
    {foreach $custom_fields->timeFields as $timeField}
    <th>{$timeField['label']|escape}</th>
    {/foreach}
  {/if}
  {if $show_project}
    <th>{$i18n.label.project}</th>
  {/if}
  {if $show_task}
    <th>{$i18n.label.task}</th>
  {/if}
  {if $show_start}
    <th>{$i18n.label.start}</th>
    <th>{$i18n.label.finish}</th>
  {/if}
    <th>{$i18n.label.duration}</th>
  {if $show_note_column}
    <th>{$i18n.label.note}</th>
  {/if}
  {if $show_files}
    <th></th>
  {/if}
    <th></th>
    <th></th>
  </tr>
  {foreach $time_records as $record}
  <tr{if !$record.billable} class="not-billable"{/if}>
    {if $show_client}
    <td class="text-cell">{$record.client|escape}</td>
    {/if}
    {* record custom fileds *}
    {if $show_record_custom_fields && isset($custom_fields) && $custom_fields->timeFields}
      {foreach $custom_fields->timeFields as $timeField}
          {assign var="control_name" value='time_field_'|cat:$timeField['id']}
    <td class="text-cell">{$record.$control_name|escape}</td>
      {/foreach}
    {/if}
    {if $show_project}
     <td class="text-cell">{$record.project|escape}</td>
    {/if}
    {if $show_task}
    <td class="text-cell">{$record.task|escape}</td>
    {/if}
    {if $show_start}
    <td class="time-cell">{if $record.start}{$record.start}{else}&nbsp;{/if}</td>
    <td class="time-cell">{if $record.finish}{$record.finish}{else}&nbsp;{/if}</td>
    {/if}
    <td class="time-cell">{if ($record.duration == '0:00' && $record.start <> '')}<font color="#ff0000">{$i18n.form.time.uncompleted}</font>{else}{$record.duration}{/if}</td>
    {if $show_note_column}
    <td class="text-cell">{if $record.comment}{$record.comment|escape}{else}&nbsp;{/if}</td>
    {/if}
    {if $show_files}
      {if $record.has_files}
    <td><a href="time_files.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a></td>
      {else}
    <td><a href="time_files.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-file.png"></a></td>
      {/if}
    {/if}
    <td>
    {if $record.approved || $record.timesheet_id || $record.invoice_id}
      &nbsp;
    {else}
      <a href="time_edit.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a>
    {/if}
    </td>
    <td>
    {if $record.approved || $record.timesheet_id || $record.invoice_id}
      &nbsp;
    {else}
      <a href="time_delete.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a>
    {/if}
    </td>
  </tr>
    {if $show_note_row && $record.comment}
  <tr>
    <td class="note-header-cell">{$i18n.label.note}:</td>
    <td colspan="{$colspan}" class="text-cell">{$record.comment|escape}</td>
  </tr>
    {/if}
  {/foreach}
</table>
</div>
{/if}
{$forms.timeRecordForm.close}

<div class="day-totals">
<table class="centered-table">
  <tr>
    <td class="day-totals-col1">{$i18n.label.week_total}: {$week_total}</td>
    <td class="day-totals-col2">{$i18n.label.day_total}: {$day_total}</td>
  </tr>
</table>
</div>
