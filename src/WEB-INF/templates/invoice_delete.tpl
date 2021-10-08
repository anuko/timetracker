{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function confirm_deleting_entries() {
    var dropdown = document.getElementById("delete_invoice_entries");
    if (1 == dropdown.value) {
      // User selected deleting values. Ask to confirm.
      return confirm("{$i18n.form.invoice.confirm_deleting_entries}");
    }
    return true;
  }
</script>

{$forms.invoiceDeleteForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td>{$i18n.form.invoice.invoice_to_delete}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.form.invoice.invoice_to_delete}:</label></td>
    <th>{$invoice_to_delete|escape}</th>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="delete_invoice_entries">{$i18n.form.invoice.invoice_entries}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="delete_invoice_entries">{$i18n.form.invoice.invoice_entries}:</label></td>
    <td class="td-with-input">{$forms.invoiceDeleteForm.delete_invoice_entries.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_49.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_49.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.invoiceDeleteForm.btn_delete.control} {$forms.invoiceDeleteForm.btn_cancel.control}</div>
{$forms.invoiceDeleteForm.close}
