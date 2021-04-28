{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.predefinedExpenseForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.predefinedExpenseForm.name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="cost">{$i18n.label.cost} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="cost">{$i18n.label.cost} (*):</label></td>
    <td class="td-with-input">{$forms.predefinedExpenseForm.cost.control} {$user->getCurrency()|escape}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
</table>
<div class="button-set">{$forms.predefinedExpenseForm.btn_add.control}</div>
{$forms.predefinedExpenseForm.close}
