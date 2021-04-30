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
  <tr class = "small-screen-label"><td><label for="comment">{$i18n.label.comment}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="comment">{$i18n.label.comment}:</label></td>
    <td class="td-with-input">{$forms.timesheetForm.comment.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="status">{$i18n.label.status}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="status">{$i18n.label.status}:</label></td>
    <td class="td-with-input">{$forms.timesheetForm.status.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.timesheetForm.btn_save.control} {if $can_delete}{$forms.timesheetForm.btn_delete.control}{/if}</div>
{$forms.timesheetForm.close}
