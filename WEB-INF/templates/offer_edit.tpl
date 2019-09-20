{$forms.offerForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.offer} (*):</td>
          <td>{$forms.offerForm.offer_name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.description}:</td>
          <td>{$forms.offerForm.description.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.details}:</td>
          <td>{$forms.offerForm.details.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.currency}:</td>
          <td>{$forms.offerForm.currency.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.budget} (*):</td>
          <td>{$forms.offerForm.budget.control}</td>
        </tr>
        <tr>
          <td></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.offerForm.btn_save.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.offerForm.close}
