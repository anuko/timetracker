{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.projectForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="project_name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="project_name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.projectForm.project_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="description">{$i18n.label.description}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="description">{$i18n.label.description}:</label></td>
    <td class="td-with-input">{$forms.projectForm.description.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="status">{$i18n.label.status}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="status">{$i18n.label.status}:</label></td>
    <td class="td-with-input">{$forms.projectForm.status.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $show_users}
  <tr><td><div class="form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.label.users}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.users}:</td>
    <td class="td-with-checkboxes">{$forms.projectForm.users.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_tasks}
  <tr><td><div class="form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.label.tasks}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.tasks}:</td>
    <td class="td-with-checkboxes">{$forms.projectForm.tasks.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
</table>
<div class="button-set">{$forms.projectForm.btn_save.control} {$forms.projectForm.btn_copy.control}</div>
{$forms.projectForm.close}
