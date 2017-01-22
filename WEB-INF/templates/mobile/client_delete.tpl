{$forms.clientDeleteForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="0" cellpadding="2" border="0">
        <tr>
          <td>{$i18n.form.client.client_to_delete}:</td>
          <th>{$client_to_delete|escape}</th>
        </tr>
        <tr>
          <td>{$i18n.form.client.client_entries}:</td>
          <td>{$forms.clientDeleteForm.delete_client_entries.control}</td>
        </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">{$forms.clientDeleteForm.btn_delete.control}&nbsp;</td>
          <td align="left">&nbsp;{$forms.clientDeleteForm.btn_cancel.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.clientDeleteForm.close}
