{include file="time_script.tpl"}

<style>
.not_billable td {
  color: #ff6666;
}
</style>

{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="0" border="0">
{if $show_navigation}
  <tr>
    <td align="center" colspan=2">
      <a href="time.php?date={$selected_date->toString()}">{$i18n.label.day_view}</a>&nbsp;/&nbsp;<a href="week.php?date={$selected_date->toString()}">{$i18n.label.week_view}</a>
    </td>
  </tr>
{/if}
  <tr>
    <td valign="top">
      <table>
{if $user_dropdown}
        <tr>
          <td align="right">{$i18n.label.user}:</td>
          <td>{$forms.timeRecordForm.user.control}</td>
        </tr>
{/if}
{if $show_client}
        <tr>
          <td align="right">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</td>
          <td>{$forms.timeRecordForm.client.control}</td>
        </tr>
{/if}
{if $show_billable}
        <tr>
          <td align="right">&nbsp;</td>
          <td><label>{$forms.timeRecordForm.billable.control}{$i18n.form.time.billable}</label></td>
        </tr>
{/if}
{if $custom_fields && $custom_fields->timeFields}
  {foreach $custom_fields->timeFields as $timeField}
        <tr>
          <td align="right">{$timeField['label']|escape}{if $timeField['required']} (*){/if}:</td>
          {assign var="control_name" value='time_field_'|cat:$timeField['id']}
          <td>{$forms.timeRecordForm.$control_name.control}</td>
        </tr>
  {/foreach}
{/if}
{if $show_project}
        <tr>
          <td align="right">{$i18n.label.project} (*):</td>
          <td>{$forms.timeRecordForm.project.control}</td>
        </tr>
{/if}
{if $show_task}
        <tr>
          <td align="right">{$i18n.label.task}{if $task_required} (*){/if}:</td>
          <td>{$forms.timeRecordForm.task.control}</td>
        </tr>
{/if}
{if $show_start}
        <tr>
          <td align="right">{$i18n.label.start}:</td>
          <td>{$forms.timeRecordForm.start.control}&nbsp;<input onclick="setNow('start');" type="button" tabindex="-1" value="{$i18n.button.now}"></td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.finish}:</td>
          <td>{$forms.timeRecordForm.finish.control}&nbsp;<input onclick="setNow('finish');" type="button" tabindex="-1" value="{$i18n.button.now}"></td>
        </tr>
{/if}
{if $show_duration}
        <tr>
          <td align="right">{$i18n.label.duration}:</td>
          <td>{$forms.timeRecordForm.duration.control}&nbsp;{if $user->getDecimalMark() == ','}{str_replace('.', ',', $i18n.form.time.duration_format)}{else}{$i18n.form.time.duration_format}{/if}</td>
        </tr>
{/if}
{if $show_files}
        <tr>
          <td align="right">{$i18n.label.file}:</td>
          <td>{$forms.timeRecordForm.newfile.control}</td>
        </tr>
{/if}
{if $template_dropdown}
        <tr>
          <td align="right">{$i18n.label.template}:</td>
          <td>{$forms.timeRecordForm.template.control}</td>
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
  {if $show_client}
          <td class="tableHeader">{$i18n.label.client}</td>
  {/if}
  {if $show_project}
          <td class="tableHeader">{$i18n.label.project}</td>
  {/if}
  {if $show_task}
          <td class="tableHeader">{$i18n.label.task}</td>
  {/if}
  {if $show_start}
          <td width="5%" class="tableHeader" align="right">{$i18n.label.start}</td>
          <td width="5%" class="tableHeader" align="right">{$i18n.label.finish}</td>
  {/if}
          <td width="5%" class="tableHeader">{$i18n.label.duration}</td>
  {if $show_note_column}
          <td class="tableHeader">{$i18n.label.note}</td>
  {/if}
  {if $show_files}
          <td></td>
  {/if}
          <td></td>
          <td></td>
        </tr>
  {foreach $time_records as $record}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}" {if !$record.billable} class="not_billable" {/if}>
    {if $show_client}
          <td valign="top">{$record.client|escape}</td>
    {/if}
    {if $show_project}
          <td valign="top">{$record.project|escape}</td>
    {/if}
    {if $show_task}
          <td valign="top">{$record.task|escape}</td>
    {/if}
    {if $show_start}
          <td nowrap align="right" valign="top">{if $record.start}{$record.start}{else}&nbsp;{/if}</td>
          <td nowrap align="right" valign="top">{if $record.finish}{$record.finish}{else}&nbsp;{/if}</td>
    {/if}
          <td align="right" valign="top">{if ($record.duration == '0:00' && $record.start <> '')}<font color="#ff0000">{$i18n.form.time.uncompleted}</font>{else}{$record.duration}{/if}</td>
    {if $show_note_column}
          <td valign="top">{if $record.comment}{$record.comment|escape}{else}&nbsp;{/if}</td>
    {/if}
    {if $show_files}
      {if $record.has_files}
          <td valign="top" align="center"><a href="time_files.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon_files.png"></a></td>
      {else}
          <td valign="top" align="center"><a href="time_files.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon_file.png"></a></td>
      {/if}
    {/if}
          <td valign="top" align="center">
    {if $record.approved || $record.timesheet_id || $record.invoice_id}
          &nbsp;
    {else}
            <a href="time_edit.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon_edit.png"></a>
      {if ($record.duration == '0:00' && $record.start <> '')}
            <input type="hidden" name="record_id" value="{$record.id}">
            <input type="hidden" name="browser_date" value="">
            <input type="hidden" name="browser_time" value="">
            <input type="submit" id="btn_stop" name="btn_stop" onclick="browser_date.value=get_date();browser_time.value=get_time()" value="{$i18n.button.stop}">
      {/if}
    {/if}
          </td>
          <td valign="top" align="center">
    {if $record.approved || $record.timesheet_id || $record.invoice_id}
            &nbsp;
    {else}
            <a href="time_delete.php?id={$record.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon_delete.png"></a>
    {/if}
          </td>
        </tr>
    {if $show_note_row && $record.comment}
        <tr>
          <td align="right" valign="top">{$i18n.label.note}:</td>
          <td colspan="{$colspan}" align="left" valign="top">{$record.comment|escape}</td>
        </tr>
    {/if}
  {/foreach}
      </table>
{/if}
    </td>
  </tr>
</table>

<table cellpadding="3" cellspacing="1" width="720">
  <tr>
    <td align="left">{$i18n.label.week_total}: {$week_total}</td>
    <td align="right">{$i18n.label.day_total}: {$day_total}</td>
  </tr>
  {if $user->isPluginEnabled('mq')}
  <tr>
    <td align="left">{$i18n.label.month_total}: {$month_total}</td>
    {if $over_balance}
    <td align="right">{$i18n.form.time.over_balance}: <span style="color: green;">{$balance_remaining}</span></td>
    {else}
    <td align="right">{$i18n.form.time.remaining_balance}: <span style="color: red;">{$balance_remaining}</span></td>
    {/if}
  </tr>
  <tr>
    <td align="left">{$i18n.label.quota}: {$month_quota}</td>
    {if $over_quota}
    <td align="right">{$i18n.form.time.over_quota}: <span style="color: green;">{$quota_remaining}</span></td>
    {else}
    <td align="right">{$i18n.form.time.remaining_quota}: <span style="color: red;">{$quota_remaining}</span></td>
    {/if}
  </tr>
  {/if}
</table>

{$forms.timeRecordForm.close}
