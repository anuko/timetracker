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

<style>
.not_billable td {
  color: #ff6666;
}
</style>

{$forms.weekTimeForm.open}
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
          <td>{$forms.weekTimeForm.user.control}</td>
        </tr>
{/if}
{if $show_client}
        <tr>
          <td align="right">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</td>
          <td>{$forms.weekTimeForm.client.control}</td>
        </tr>
{/if}
{if $show_billable}
        <tr>
          <td align="right">&nbsp;</td>
          <td><label>{$forms.weekTimeForm.billable.control}{$i18n.form.time.billable}</label></td>
        </tr>
{/if}
{if $custom_fields && $custom_fields->timeFields}
  {foreach $custom_fields->timeFields as $timeField}
    <tr>
      <td align="right">{$timeField['label']|escape}{if $timeField['required']} (*){/if}:</td>
      {assign var="control_name" value='time_field_'|cat:$timeField['id']}
      <td>{$forms.weekTimeForm.$control_name.control}</td>
    </tr>
  {/foreach}
{/if}
{if $show_project}
        <tr>
          <td align="right">{$i18n.label.project} (*):</td>
          <td>{$forms.weekTimeForm.project.control}</td>
        </tr>
{/if}
{if $show_task}
        <tr>
          <td align="right">{$i18n.label.task}{if $task_required} (*){/if}:</td>
          <td>{$forms.weekTimeForm.task.control}</td>
        </tr>
{/if}
{if $show_week_note}
        <tr>
          <td align="right">{$i18n.label.week_note}:</td>
          <td>{$forms.weekTimeForm.note.control}</td>
        </tr>
{/if}
      </table>
    </td>
    <td valign="top">
      <table>
        <tr><td>{$forms.weekTimeForm.date.control}</td></tr>
      </table>
    </td>
  </tr>
</table>
<table width="720">
  <tr valign="top">
    <td>{$forms.weekTimeForm.week_durations.control}</td>
  </tr>
</table>

<table>
  <tr>
    <td align="center" colspan="2">{$forms.weekTimeForm.btn_submit.control}</td>
  </tr>
  <tr><td>&nbsp;</td></tr>
</table>

{if $show_week_list}
<table width="720">
<tr>
  <td valign="top">
{if $time_records}
      <table border="0" cellpadding="3" cellspacing="1" width="100%">
      <tr>
        <td width="5%" class="tableHeader">{$i18n.label.date}</td>
  {if $show_client}
        <td width="20%" class="tableHeader">{$i18n.label.client}</td>
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
        <td class="tableHeader">{$i18n.label.note}</td>
  {if $show_files}
        <td></td>
  {/if}
        <td></td>
        <td></td>
      </tr>
  {foreach $time_records as $record}
      <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}" {if !$record.billable} class="not_billable" {/if}>
        <td valign="top">{$record.date}</td>
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
        <td valign="top">{if $record.comment}{$record.comment|escape}{else}&nbsp;{/if}</td>
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
  {/foreach}
    </table>
{/if}
  </td>
</tr>
</table>
{/if}

{if $time_records}
<table cellpadding="3" cellspacing="1" width="720">
  {if $show_week_list}
  <tr>
    <td align="left">{$i18n.label.week_total}: {$week_total}</td>
    <td></td>
  </tr>
  {/if}
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
{$forms.weekTimeForm.close}
