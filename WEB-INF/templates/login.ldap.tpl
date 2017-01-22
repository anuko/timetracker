<table border="0">
  {if $show_hint}
  <tr>
    <td colspan="2" align="center">{$i18n.label.ldap_hint}</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  {/if}
  <tr>
    <td{if !$i18n.language.rtl} align="right"{/if}>{$i18n.label.login}:</td>
    <td>{$forms.loginForm.login.control} <font color="#777777">@{$Auth_ldap_params.default_domain}</font></td>
  </tr>
  <tr>
    <td{if !$i18n.language.rtl} align="right"{/if}>{$i18n.label.password}:</td>
    <td>{$forms.loginForm.password.control}</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" height="50">{$forms.loginForm.btn_login.control}</td>
  </tr>
</table>
  