{include file="time_script.tpl"}

{* Conditional include of confirmSave handler. *}
{if $confirm_save}
<script>
var original_date = "{$entry_date}";

function confirmSave() {
  var date_on_save = document.getElementById("date").value;
  if (original_date != date_on_save) {
    return confirm("{$i18n.warn.confirm_save}");
  }
}
</script>
{/if}

{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table width = "100%">
  <tr>
    <td valign="top">
    <table border="0">
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
{if $show_paid_status}
    <tr>
      <td align="right">&nbsp;</td>
      <td><label>{$forms.timeRecordForm.paid.control}{$i18n.label.paid}</label></td>
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
      <td>{$forms.timeRecordForm.duration.control}&nbsp;{if $user->decimal_mark == ','}{str_replace('.', ',', $i18n.form.time.duration_format)}{else}{$i18n.form.time.duration_format}{/if}</td>
    </tr>
{/if}
    <tr>
      <td align="right">{$i18n.label.date}:</td>
      <td>{$forms.timeRecordForm.date.control}</td>
    </tr>
{if $template_dropdown}
    <tr>
      <td align="right">{$i18n.label.template}:</td>
      <td>{$forms.timeRecordForm.template.control}</td>
    </tr>
{/if}
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
