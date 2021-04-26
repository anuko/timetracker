{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.invoiceForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="number">{$i18n.form.invoice.number} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="number">{$i18n.form.invoice.number} (*):</label></td>
    <td class="td-with-input">{$forms.invoiceForm.number.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="date">{$i18n.label.date}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="date">{$i18n.label.date}:</label></td>
    <td class="td-with-input">{$forms.invoiceForm.date.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="client">{$i18n.label.client}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="client">{$i18n.label.client}:</label></td>
    <td class="td-with-input">{$forms.invoiceForm.client.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if isset($show_project) && $show_project}
  <tr class = "small-screen-label"><td><label for="project">{$i18n.label.project}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="project">{$i18n.label.project}:</label></td>
    <td class="td-with-input">{$forms.invoiceForm.project.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="start">{$i18n.label.start_date} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="start">{$i18n.label.start_date} (*):</label></td>
    <td class="td-with-input">{$forms.invoiceForm.start.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="finish">{$i18n.label.end_date} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="finish">{$i18n.label.end_date} (*):</label></td>
    <td class="td-with-input">{$forms.invoiceForm.finish.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.invoiceForm.btn_submit.control}</div>
{$forms.invoiceForm.close}

<script>
// Set the date field to browser today in user date format.
var dateField = document.getElementById("date");
if (dateField && !dateField.value) {
  var today = new Date();
  dateField.value = today.strftime("{$user->date_format}");
}
</script>
