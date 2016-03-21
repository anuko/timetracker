{$forms.newPasswordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
{if $result_message}
      <table cellspacing="4" cellpadding="7" border="0" width="100%">
        <tr><td align="center"><font color="red"><b>{$result_message}</b></font></td></tr>
      </table>
{else}
      <table>
        <tr>
          <td colspan="4" height="40">{$i18n.form.change_password.tip}</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.password} (*):</td>
          <td colspan="3">{$forms.newPasswordForm.password1.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.confirm_password} (*):</td>
          <td colspan="3">{$forms.newPasswordForm.password2.control}</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3" align="center">{$forms.newPasswordForm.btn_save.control}</td>
        </tr>
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.newPasswordForm.close}
