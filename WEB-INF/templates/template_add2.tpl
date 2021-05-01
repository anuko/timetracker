{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.templateForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.templateForm.name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="description">{$i18n.label.description}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="description">{$i18n.label.description}:</label></td>
    <td class="td-with-input">{$forms.templateForm.description.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="content">{$i18n.label.template} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="content">{$i18n.label.template} (*):</label></td>
    <td class="td-with-input">{$forms.templateForm.content.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $show_projects}
  <tr><td><div class="form-control-separator"></div></id></tr>
  <tr class = "small-screen-label"><td><label for="projects">{$i18n.label.projects}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="projects">{$i18n.label.projects}:</label></td>
    <td class="td-with-input">{$forms.templateForm.projects.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.templateForm.btn_add.control}</div>
{$forms.templateForm.close}
