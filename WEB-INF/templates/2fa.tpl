{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<div class="page-hint">{$i18n.form.2fa.hint}</div>
{$forms.twoFactorAuthForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="login">{$i18n.label.login}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="login">{$i18n.label.login}:</label></td>
    <td class="td-with-input">{$forms.twoFactorAuthForm.login.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="password">{$i18n.label.password}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="password">{$i18n.label.password}:</label></td>
    <td class="td-with-input">{$forms.twoFactorAuthForm.password.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="auth_code">{$i18n.form.2fa.2fa_code}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="auth_code">{$i18n.form.2fa.2fa_code}:</label></td>
    <td class="td-with-input">{$forms.twoFactorAuthForm.auth_code.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr>
    <td colspan="2">{$forms.twoFactorAuthForm.btn_login.control}</td>
  </tr>
</table>
{$forms.twoFactorAuthForm.close}

