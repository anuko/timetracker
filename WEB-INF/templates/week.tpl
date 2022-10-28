{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{include file="time_script.tpl"}

<script>
// This is here because fillDropdowns() in time_script.tpl uses a different form name.
// Perhaps a better fix would be to provide form name as paramater to fillDropdowns()?
// TODO: try to fix it properly.
//
// The fillDropdowns function populates the "project" and "task" dropdown controls
// with relevant values.
function fillDropdowns() {
  if(document.body.contains(document.weekTimeForm.client))
    fillProjectDropdown(document.weekTimeForm.client.value);

  fillTaskDropdown(document.weekTimeForm.project.value);
}
</script>

{if $show_navigation}
<div class="optional-nav">
  <a href="time.php?date={$selected_date->toString()}">{$i18n.label.day_view}</a>&nbsp;/&nbsp;<a href="week.php?date={$selected_date->toString()}">{$i18n.label.week_view}</a>
</div>
{/if}

{$forms.weekTimeForm.open}
<div class="small-screen-calendar">{$forms.weekTimeForm.date.control}</div>
<table class="centered-table">
  <tr><td></td><td></td><td rowspan="{$large_screen_calendar_row_span}"><div class="large-screen-calendar">{$forms.weekTimeForm.date.control}</div></td></tr>
{if isset($user_dropdown)}
  <tr class = "small-screen-label"><td><label for="user">{$i18n.label.user}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="user">{$i18n.label.user}:</label></td>
    <td class="td-with-input">{$forms.weekTimeForm.user.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_client}
  <tr class = "small-screen-label"><td><label for="client">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="client">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.weekTimeForm.client.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_billable}
  <tr>
    <td class = "large-screen-label">&nbsp;</td>
    <td><label class="checkbox-label">{$forms.weekTimeForm.billable.control}{$i18n.form.time.billable}</label></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if isset($custom_fields) && $custom_fields->timeFields}
  {foreach $custom_fields->timeFields as $timeField}
    {assign var="control_name" value='time_field_'|cat:$timeField['id']}
  <tr class = "small-screen-label"><td><label for="{$control_name}">{$timeField['label']|escape}{if $timeField['required']} (*){/if}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="{$control_name}">{$timeField['label']|escape}{if $timeField['required']} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.weekTimeForm.$control_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  {/foreach}
{/if}
{if $show_project}
  <tr class = "small-screen-label"><td><label for="project">{$i18n.label.project} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="project">{$i18n.label.project} (*):</label></td>
    <td class="td-with-input">{$forms.weekTimeForm.project.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_task}
  <tr class = "small-screen-label"><td><label for="task">{$i18n.label.task}{if $task_required} (*){/if}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="task">{$i18n.label.task}{if $task_required} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.weekTimeForm.task.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_week_note}
  <tr class = "small-screen-label"><td><label for="comment">{$i18n.label.week_note}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="comment">{$i18n.label.week_note}:</label></td>
    <td class="td-with-input">{$forms.weekTimeForm.comment.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
</table>
<div class="form-control-separator"></div>
<table class="x-scrollable-table">
  <tr>
    <td>{$forms.weekTimeForm.week_durations.control}</td>
  </tr>
</table>
<div class="button-set">{$forms.weekTimeForm.btn_submit.control}</div>
{$forms.weekTimeForm.close}

{if $show_week_list}
<div class="form-control-separator"></div>
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.date}</th>
  {if $show_record_custom_fields && isset($custom_fields) && $custom_fields->timeFields}
    {foreach $custom_fields->timeFields as $timeField}
    <th>{$timeField['label']|escape}</th>
    {/foreach}
  {/if}
  {if $show_client}
    <th>{$i18n.label.client}</th>
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
    <th>{$i18n.label.note}</th>
  {if $show_files}
    <th></th>
  {/if}
    <th></th>
    <th></th>
  </tr>
  {foreach $time_records as $record}
  <tr {if !$record.billable}class="not-billable"{/if}>
    <td class="date-cell">{$record.date}</td>
    {* record custom fields *}
    {if $show_record_custom_fields && isset($custom_fields) && $custom_fields->timeFields}
      {foreach $custom_fields->timeFields as $timeField}
          {assign var="control_name" value='time_field_'|cat:$timeField['id']}
    <td class="text-cell">{$record.$control_name|escape}</td>
      {/foreach}
    {/if}
    {if $show_client}
    <td class="text-cell">{$record.client|escape}</td>
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
    <td class="text-cell">{if $record.comment}{$record.comment|escape}{else}&nbsp;{/if}</td>
    {if $show_files}
      {if $record.has_files}
    <td><a href="time_files.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a></td>
      {else}
    <td><a href="time_files.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-file.png"></a></td>
      {/if}
    {/if}
    <td>
    {if (isset($record.approved) && $record.approved) || (isset($record.timesheet_id) && $record.timesheet_id) || (isset($record.invoice_id) && $record.invoice_id)}
      &nbsp;
    {else}
      <a href="time_edit.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a>
    {/if}
    </td>
    <td>
    {if (isset($record.approved) && $record.approved) || (isset($record.timesheet_id) && $record.timesheet_id) || (isset($record.invoice_id) && $record.invoice_id)}
      &nbsp;
    {else}
      <a href="time_delete.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a>
    {/if}
    </td>
  </tr>
  {/foreach}
</table>
{/if}
{if $time_records}
<div class="day-totals">
<table class="centered-table">
  <tr>
    <td class="day-totals-col1">{$i18n.label.week_total}: {$week_total}</td>
    <td class="day-totals-col2"></td>
  </tr>
  {if $user->isPluginEnabled('mq')}
  <tr>
    <td class="day-totals-col1">{$i18n.label.month_total}: {$month_total}</td>
    {if $over_quota}
    <td class="day-totals-col2">{$i18n.form.time.over_quota}: <span class="over-quota">{$quota_remaining}</span></td>
    {else}
    <td class="day-totals-col2">{$i18n.form.time.remaining_quota}: <span class="remaining-quota">{$quota_remaining}</span></td>
    {/if}
  </tr>
  {/if}
</table>
</div>
{/if}
