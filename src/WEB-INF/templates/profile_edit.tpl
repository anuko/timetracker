{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.profileForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="name">{$i18n.label.person_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="name">{$i18n.label.person_name} (*):</label></td>
    <td class="td-with-input">{$forms.profileForm.name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="login">{$i18n.label.login} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="login">{$i18n.label.login} (*):</label></td>
    <td class="td-with-input">{$forms.profileForm.login.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if !$auth_external}
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="password1">{$i18n.label.password}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="password1">{$i18n.label.password}:</label></td>
    <td class="td-with-input">{$forms.profileForm.password1.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="password2">{$i18n.label.confirm_password}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="password2">{$i18n.label.confirm_password}:</label></td>
    <td class="td-with-input">{$forms.profileForm.password2.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="email">{$i18n.label.email}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="email">{$i18n.label.email}:</label></td>
    <td class="td-with-input">{$forms.profileForm.email.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.profileForm.btn_save.control}</div>
{$forms.profileForm.close}
