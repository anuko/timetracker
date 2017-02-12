{$forms.predefinedExpenseForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.predefinedExpenseForm.name.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.cost} (*):</td>
          <td>{$forms.predefinedExpenseForm.cost.control} {$user->currency|escape}</td>
        </tr>
        <tr>
          <td height="40"></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.predefinedExpenseForm.btn_submit.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.predefinedExpenseForm.close}
