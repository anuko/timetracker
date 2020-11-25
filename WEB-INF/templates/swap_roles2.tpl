{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<div class="page-hint">{$i18n.form.swap.hint}</div>
{$forms.swapForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="swap_with">{$i18n.form.swap.swap_with}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="swap_with">{$i18n.form.swap.swap_with}:</label></td>
    <td class="td-with-input">{$forms.swapForm.swap_with.control}</td>
  </tr>
</table>
<div class="button-set">{$forms.swapForm.btn_submit.control} {$forms.swapForm.btn_cancel.control}</div>
{$forms.swapForm.close}
