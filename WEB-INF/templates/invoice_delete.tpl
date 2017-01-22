{$forms.invoiceDeleteForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="0" cellpadding="2" border="0">
        <tr>
          <td>{$i18n.form.invoice.invoice_to_delete}:</td>
          <th>{$invoice_to_delete|escape:'html'}</th>
        </tr>
        <tr>
          <td>{$i18n.form.invoice.invoice_entries}:</td>
          <td>{$forms.invoiceDeleteForm.delete_invoice_entries.control}</td>
        </tr>
        <tr><td colspan="2" align="center">&nbsp;</td></tr>
        <tr>
          <td align="right">{$forms.invoiceDeleteForm.btn_delete.control}&nbsp;</td>
          <td align="left">&nbsp;{$forms.invoiceDeleteForm.btn_cancel.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.invoiceDeleteForm.close}
