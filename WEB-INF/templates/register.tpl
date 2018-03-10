{$forms.profileForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right" nowrap>{$i18n.label.team_name}:</td>
          <td>{$forms.profileForm.team_name.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.currency}:</td>
          <td>{$forms.profileForm.currency.control}</td>
        </tr>
        <tr>
           <td align="right" nowrap>{$i18n.label.language}:</td>
           <td>{$forms.profileForm.lang.control}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td align="right" nowrap>{$i18n.label.manager_name} (*):</td>
          <td>{$forms.profileForm.manager_name.control}</td>
        </tr>
        <tr>
          <td align="right" nowrap>{$i18n.label.manager_login} (*):</td>
          <td>{$forms.profileForm.manager_login.control}</td>
        </tr>
        <tr>
          <td align="right" nowrap>{$i18n.label.password} (*):</td>
          <td>{$forms.profileForm.password1.control}</td>
        </tr>
        <tr>
          <td align="right" nowrap>{$i18n.label.confirm_password} (*):</td>
          <td>{$forms.profileForm.password2.control}</td>
        </tr>
        <tr>
          <td align="right" nowrap>{$i18n.label.email}:</td>
          <td>{$forms.profileForm.manager_email.control}</td>
        </tr>
        <tr>
          <td></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
          <td colspan="2" height="50" align="center">{$forms.profileForm.btn_submit.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.profileForm.close}
