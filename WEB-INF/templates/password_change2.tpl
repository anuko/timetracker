{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.newPasswordForm.open}
<div class="page-hint">{$i18n.form.change_password.tip}</div>
<div class="small-screen-form-control-separator"></div>
<table class="centered-table">
    <tr class = "small-screen-label"><td><label for="password1">{$i18n.label.password} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="password1">{$i18n.label.password} (*):</label></td>
    <td class="td-with-input">{$forms.newPasswordForm.password1.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="password2">{$i18n.label.confirm_password} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="password2">{$i18n.label.confirm_password} (*):</label></td>
    <td class="td-with-input">{$forms.newPasswordForm.password2.control}</td>
  </tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr>
    <td colspan="2">{$forms.newPasswordForm.btn_save.control}</td>
  </tr>
</table>
{$forms.newPasswordForm.close}
