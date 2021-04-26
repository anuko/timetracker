{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<div class="page-hint">{$i18n.form.import.hint}</div>
{$forms.importForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="xmlfile">{$i18n.form.import.file}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="xmlfile">{$i18n.form.import.file}:</label></td>
    <td class="td-with-input">{$forms.importForm.xmlfile.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.importForm.btn_submit.control}</div>
{$forms.importForm.open}
