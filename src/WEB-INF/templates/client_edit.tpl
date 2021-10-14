{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.clientForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="name">{$i18n.label.client_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="name">{$i18n.label.client_name} (*):</label></td>
    <td class="td-with-input">{$forms.clientForm.name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="address">{$i18n.label.client_address}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="address">{$i18n.label.client_address}:</label></td>
    <td class="td-with-input">{$forms.clientForm.address.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="tax">{$i18n.label.tax}, %:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="tax">{$i18n.label.tax}, %:</label></td>
    <td class="td-with-input">{$forms.clientForm.tax.control}&nbsp;(0{$user->getDecimalMark()}00)</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="status">{$i18n.label.status}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="status">{$i18n.label.status}:</label></td>
    <td class="td-with-input">{$forms.clientForm.status.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $show_projects}
  <tr><td><div class="form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.label.projects}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.projects}:</td>
    <td class="td-with-checkboxes">{$forms.clientForm.projects.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
</table>
<div class="button-set">{$forms.clientForm.btn_save.control} {$forms.clientForm.btn_copy.control}</div>
{$forms.clientForm.close}
