{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

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
<table class="centered-table">
  <tr>
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
{if $show_paid_status}
  <tr>
    <td class = "large-screen-label">&nbsp;</td>
    <td><label class="checkbox-label">{$forms.timeRecordForm.paid.control}{$i18n.label.paid}</label></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $custom_fields && $custom_fields->timeFields}
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
  <tr class = "small-screen-label"><td><label for="date">{$i18n.label.date} (*):</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="date">{$i18n.label.date} (*):</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.date.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $template_dropdown}
  <tr class = "small-screen-label"><td><label for="template">{$i18n.label.template}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="template">{$i18n.label.template}:</label></td>
    <td class="td-with-input">{$forms.timeRecordForm.template.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="note">{$i18n.label.note}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="note">{$i18n.label.note}:</label></td>
    <td>{$forms.timeRecordForm.note.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.timeRecordForm.btn_save.control} {$forms.timeRecordForm.btn_copy.control} {$forms.timeRecordForm.btn_delete.control}</div>
{$forms.timeRecordForm.close}
