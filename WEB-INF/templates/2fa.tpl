{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
function get_date() {
  var date = new Date();
  return date.strftime("%Y-%m-%d");
}
</script>

{$forms.2faForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="login">{$i18n.form.2fa.2fa_code}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="login">{$i18n.form.2fa.2fa_code}:</label></td>
    <td class="td-with-input">{$forms.2faForm.2fa_code.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr>
    <td colspan="2">{$forms.2faForm.btn_login.control}</td>
  </tr>
</table>
{$forms.2faForm.close}

