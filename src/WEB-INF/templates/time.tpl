{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{include file="time_script.tpl"}

{if $show_navigation}
<div class="optional-nav">
  <a href="time.php?date={$selected_date->toString()}">{$i18n.label.day_view}</a>
  {if $user->isPluginEnabled('pu')}&nbsp;/&nbsp;<a href="puncher.php">{$i18n.label.puncher}{/if}</a>
  {if $user->isPluginEnabled('wv')}&nbsp;/&nbsp;<a href="week.php?date={$selected_date->toString()}">{$i18n.label.week_view}{/if}</a>
</div>
{/if}

{$forms.timeRecordForm.open}
<div class="small-screen-calendar">{$forms.timeRecordForm.date.control}</div>
<table class="centered-table">
  <tr><td></td><td></td><td rowspan="{$large_screen_calendar_row_span}"><div class="large-screen-calendar">{$forms.timeRecordForm.date.control}</div></td></tr>
{if $user_dropdown}
  <tr class = "small-screen-label"><td><label for="user">{$i18n.label.user}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="user">{$i18n.label.user}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.user.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
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
{if $show_start}
  <tr class = "small-screen-label"><td><label for="start">{$i18n.label.start}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="start">{$i18n.label.start}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.start.control} <img src="img/icon-now.png" onclick="setNow('start');" title="{$i18n.button.now}" alt="{$i18n.button.now}"></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="finish">{$i18n.label.finish}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="finish">{$i18n.label.finish}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.finish.control}<img src="img/icon-now.png" onclick="setNow('finish');" title="{$i18n.button.now}" alt="{$i18n.button.now}"></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_duration}
  <tr class = "small-screen-label"><td><label for="duration">{$i18n.label.duration}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="duration">{$i18n.label.duration}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.duration.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_files}
  <tr class = "small-screen-label"><td><label for="newfile">{$i18n.label.file}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="newfile">{$i18n.label.file}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.newfile.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if (isset($template_dropdown) && $template_dropdown)}
  <tr class = "small-screen-label"><td><label for="template">{$i18n.label.template}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="template">{$i18n.label.template}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.template.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="note">{$i18n.label.note}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="note">{$i18n.label.note}:</label></td>
    <td colspan="2">{$forms.timeRecordForm.note.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="3">{$forms.timeRecordForm.btn_submit.control}</td>
</table>

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
      {if ($record.duration == '0:00' && $record.start <> '')}
        <input type="hidden" name="record_id" value="{$record.id}">
        <input type="hidden" name="browser_date" value="">
        <input type="hidden" name="browser_time" value="">
        <input type="submit" id="btn_stop" name="btn_stop" onclick="browser_date.value=get_date();browser_time.value=get_time()" value="{$i18n.button.stop}">
      {/if}
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
{if $user->isPluginEnabled('mq')}
  <tr>
    <td class="day-totals-col1">{$i18n.label.month_total}: {$month_total}</td>
    {if $over_balance}
    <td class="day-totals-col2">{$i18n.form.time.over_balance}: <span class="over-quota-balance">{$balance_remaining}</span></td>
    {else}
    <td class="day-totals-col2">{$i18n.form.time.remaining_balance}: <span class="remaining-quota-balance">{$balance_remaining}</span></td>
    {/if}
  </tr>
  <tr>
    <td class="day-totals-col1">{$i18n.label.quota}: {$month_quota}</td>
    {if $over_quota}
    <td class="day-totals-col2">{$i18n.form.time.over_quota}: <span class="over-quota">{$quota_remaining}</span></td>
    {else}
    <td class="day-totals-col2">{$i18n.form.time.remaining_quota}: <span class="remaining-quota">{$quota_remaining}</span></td>
    {/if}
  </tr>
{/if}
</table>
</div>
