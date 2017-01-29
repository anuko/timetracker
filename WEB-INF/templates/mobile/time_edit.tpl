{include file="time_script.tpl"}

{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table width="100%">
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
    <tr><td>{$i18n.label.date}:</td></tr>
    <tr><td>{$forms.timeRecordForm.date.control}</td></tr>
    <tr><td>{$i18n.label.note}:</td></tr>
    <tr><td>{$forms.timeRecordForm.note.control}</td></tr>
    <tr><td align="center">{$forms.timeRecordForm.btn_save.control}&nbsp;{$forms.timeRecordForm.btn_delete.control}</td></tr>
    </table>
    </td>
    </tr>
  </table>
  </td>
  </tr>
</table>
{$forms.timeRecordForm.close}
