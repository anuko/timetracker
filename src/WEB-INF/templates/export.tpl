{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<div class="page-hint">{$i18n.form.export.hint}</div>

{$forms.exportForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="compression">{$i18n.form.export.compression}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="compression">{$i18n.form.export.compression}:</label></td>
    <td class="td-with-input">{$forms.exportForm.compression.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.exportForm.btn_submit.control}</div>
{$forms.exportForm.close}
