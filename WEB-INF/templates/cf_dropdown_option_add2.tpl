{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.optionAddForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.optionAddForm.name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
</table>
<div class="button-set">{$forms.optionAddForm.btn_add.control}</div>
{$forms.optionAddForm.close}
