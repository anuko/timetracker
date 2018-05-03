{$forms.profileForm.open}

<table cellspacing="4" cellpadding="7" border="0">
    <tr>
      <td>
        <table cellspacing="1" cellpadding="2" border="0">
          <tr>
            <td align="right" nowrap>{$i18n.label.person_name} (*):</td>
            <td>{$forms.profileForm.name.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.login} (*):</td>
            <td>{$forms.profileForm.login.control}</td>
          </tr>
{if !$auth_external}
          <tr>
            <td align="right" nowrap>{$i18n.label.password} (*):</td>
            <td>{$forms.profileForm.password1.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.confirm_password} (*):</td>
            <td>{$forms.profileForm.password2.control}</td>
          </tr>
{/if}
          <tr>
            <td align="right" nowrap>{$i18n.label.email}:</td>
            <td>{$forms.profileForm.email.control}</td>
          </tr>
          <tr>
            <td></td>
            <td>{$i18n.label.required_fields}</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" height="50" align="center">{$forms.profileForm.btn_save.control}</td>
          </tr>
        </table>
      </td>
    </tr>
</table>
{$forms.profileForm.close}
