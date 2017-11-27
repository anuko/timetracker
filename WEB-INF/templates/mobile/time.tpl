{include file="time_script.tpl"}

<style>
.not_billable td {
  color: #ff6666;
}
</style>

<table cellspacing="3" cellpadding="0" border="0" width="100%">
  <tr>
    <td class="sectionHeaderNoBorder" align="right"><a href="time.php?date={$prev_date}">&lt;&lt;</a></td>
    <td class="sectionHeaderNoBorder" align="center">{$timestring}</td>
    <td class="sectionHeaderNoBorder" align="left"><a href="time.php?date={$next_date}">&gt;&gt;</a></td>
  </tr>
</table>

<table cellspacing="3" cellpadding="0" border="0" width="100%">
<tr>
  <td align="center">
    {if $time_records}
      <table class="mobile-table-details">
      {foreach $time_records as $record}
      <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}" {if !$record.billable} class="not_billable" {/if}>
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <td valign="top">{$record.project|escape}</td>
{/if}
        <td align="right" valign="top">{if ($record.duration == '0:00' && $record.start <> '')}<font color="#ff0000">{/if}{$record.duration}{if ($record.duration == '0:00' && $record.start <> '')}</font>{/if}</td>
        <td align="center">{if $record.invoice_id}&nbsp;{else}<a href="time_edit.php?id={$record.id}">{$i18n.label.edit}</a>{/if}</td>
      </tr>
      {/foreach}
    </table>
    <table border="0">
      <tr>
        <td align="right">{$i18n.label.day_total}:</td>
        <td>{$day_total}</td>
      </tr>
    </table>
    {/if}
  </td>
</tr>
</table>

{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table width = "100%">
  <tr>
    <td valign="top">
    <table border="0">
{if $user->isPluginEnabled('cl')}
    <tr><td>{$i18n.label.client}:</td></tr>
    <tr><td>{$forms.timeRecordForm.client.control}</td></tr>
{/if}
{if $user->isPluginEnabled('iv')}
    <tr><td><label>{$forms.timeRecordForm.billable.control}{$i18n.form.time.billable}</label></td></tr>
{/if}
{if ($custom_fields && $custom_fields->fields[0])}
      <tr><td>{$custom_fields->fields[0]['label']|escape}:</td></tr>
      <tr><td>{$forms.timeRecordForm.cf_1.control}</td></tr>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <tr><td>{$i18n.label.project}:</td></tr>
    <tr><td>{$forms.timeRecordForm.project.control}</td></tr>
{/if}
{if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <tr><td>{$i18n.label.task}:</td></tr>
    <tr><td>{$forms.timeRecordForm.task.control}</td></tr>
{/if}
{if (($smarty.const.TYPE_START_FINISH == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
    <tr><td>{$i18n.label.start}:</td></tr>
    <tr><td>{$forms.timeRecordForm.start.control}&nbsp;<input onclick="setNow('start');" type="button" value="{$i18n.button.now}"></td></tr>

    <tr><td>{$i18n.label.finish}:</td></tr>
    <tr><td>{$forms.timeRecordForm.finish.control}&nbsp;<input onclick="setNow('finish');" type="button" value="{$i18n.button.now}"></td></tr>
{/if}
{if (($smarty.const.TYPE_DURATION == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
    <tr><td>{$i18n.label.duration}:</td></tr>
    <tr><td>{$forms.timeRecordForm.duration.control}</td></tr>
{/if}

    <tr><td>{$i18n.label.note}:</td></tr>
    <tr><td>{$forms.timeRecordForm.note.control}</td></tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" height="50" align="center">{$forms.timeRecordForm.btn_submit.control}</td>
  </tr>
  </table>
  </td>
</tr>
</table>
{$forms.timeRecordForm.close}
