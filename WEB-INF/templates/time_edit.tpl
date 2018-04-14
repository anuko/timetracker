{include file="time_script.tpl"}

{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table width = "100%">
  <tr>
    <td valign="top">
    <table border="0">
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
{if ($user->can('manage_invoices') && $user->isPluginEnabled('ps'))}
    <tr>
      <td align="right">&nbsp;</td>
      <td><label>{$forms.timeRecordForm.paid.control}{$i18n.label.paid}</label></td>
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
      <td align="right">{$i18n.label.task}{if $user->task_required} (*){/if}:</td>
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
      <td>{$forms.timeRecordForm.duration.control}&nbsp;{if $user->decimal_mark == ','}{str_replace('.', ',', $i18n.form.time.duration_format)}{else}{$i18n.form.time.duration_format}{/if}</td>
    </tr>
{/if}
    <tr>
      <td align="right">{$i18n.label.date}:</td>
      <td>{$forms.timeRecordForm.date.control}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.label.note}:</td>
      <td>{$forms.timeRecordForm.note.control}</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td align="left">{$forms.timeRecordForm.btn_save.control} {$forms.timeRecordForm.btn_copy.control} {$forms.timeRecordForm.btn_delete.control}</td>
    </tr>
    </table>
    </td>
    </tr>
  </table>
  </td>
  </tr>
</table>
{$forms.timeRecordForm.close}
