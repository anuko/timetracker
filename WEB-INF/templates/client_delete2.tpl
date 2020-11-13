{$forms.clientDeleteForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td>{$i18n.form.client.client_to_delete}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.form.client.client_to_delete}:</td>
    <td class="text-cell"><div class="section-header">{$client_to_delete|escape}</div></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.form.client.client_entries}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.form.client.client_entries}:</td>
    <td>{$forms.clientDeleteForm.delete_client_entries.control}</td>
  </tr>
</table>
<div class="button-set">{$forms.clientDeleteForm.btn_delete.control}&nbsp;{$forms.clientDeleteForm.btn_cancel.control}</div>
{$forms.clientDeleteForm.close}
