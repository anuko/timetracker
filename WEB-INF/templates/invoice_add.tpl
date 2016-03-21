{$forms.invoiceForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.form.invoice.number} (*):</td>
          <td>{$forms.invoiceForm.number.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.date} (*):</td>
          <td>{$forms.invoiceForm.date.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.client} (*):</td>
          <td>{$forms.invoiceForm.client.control}</td>
        </tr>
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr>
          <td align="right">{$i18n.label.project}:</td>
          <td>{$forms.invoiceForm.project.control}</td>
        </tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.start_date} (*):</td>
          <td>{$forms.invoiceForm.start.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.end_date} (*):</td>
          <td>{$forms.invoiceForm.finish.control}</td>
        </tr>
        <tr>
          <td height="40"></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.invoiceForm.btn_submit.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.invoiceForm.close}

<script>
// Set the date field to browser today in user date format.
var dateField = document.getElementById("date");
if (dateField && !dateField.value) {
  var today = new Date();
  dateField.value = today.strftime("{$user->date_format}");
}
</script>
