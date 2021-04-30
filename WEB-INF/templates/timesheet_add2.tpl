{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.timesheetForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="timesheet_name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="timesheet_name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.timesheetForm.timesheet_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $show_client}
  <tr class = "small-screen-label"><td><label for="client">{$i18n.label.client}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="client">{$i18n.label.client}:</label></td>
    <td class="td-with-input">{$forms.timesheetForm.client.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="project">{$i18n.label.project}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="project">{$i18n.label.project}:</label></td>
    <td class="td-with-input">{$forms.timesheetForm.project.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="start">{$i18n.label.start_date} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="start">{$i18n.label.start_date} (*):</label></td>
    <td class="td-with-input">{$forms.timesheetForm.start.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="finish">{$i18n.label.end_date} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="finish">{$i18n.label.end_date} (*):</label></td>
    <td class="td-with-input">{$forms.timesheetForm.finish.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="comment">{$i18n.label.comment}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="comment">{$i18n.label.comment}:</label></td>
    <td class="td-with-input">{$forms.timesheetForm.comment.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.timesheetForm.btn_add.control}</div>
{$forms.timesheetForm.close}
