{if $show_hint}
<div class="page-hint">{$i18n.label.ldap_hint}</div>
{/if}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="login">{$i18n.label.login}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="login">{$i18n.label.login}:</label></td>
    <td class="td-with-input">{$forms.loginForm.login.control}<span id="ldapDefaultDomain">@{$Auth_ldap_params.default_domain}</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="password">{$i18n.label.password}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="password">{$i18n.label.password}:</label></td>
    <td class="td-with-input">{$forms.loginForm.password.control}</td>
  </tr>
  <tr>
    <td colspan="2"><a href ="password_reset.php">{$i18n.form.login.forgot_password}</a></td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
  <tr>
    <td colspan="2">{$forms.loginForm.btn_login.control}</td>
  </tr>
</table>
