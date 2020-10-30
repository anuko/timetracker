{$forms.groupForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="group_name">{$i18n.label.group_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="group_name">{$i18n.label.group_name} (*):</label></td>
    <td class="td-with-input">{$forms.groupForm.group_name.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_37.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_37.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="currency">{$i18n.label.currency}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="currency">{$i18n.label.currency}:</label></td>
    <td class="td-with-input">{$forms.groupForm.currency.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="lang">{$i18n.label.language}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="lang">{$i18n.label.language}:</label></td>
    <td class="td-with-input">{$forms.groupForm.lang.control}</td>
  </tr>
    <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="manager_name">{$i18n.label.manager_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="manager_name">{$i18n.label.manager_name} (*):</label></td>
    <td class="td-with-input">{$forms.groupForm.manager_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="manager_login">{$i18n.label.manager_login} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="manager_login">{$i18n.label.manager_login} (*):</label></td>
    <td class="td-with-input">{$forms.groupForm.manager_login.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="password1">{$i18n.label.password} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="password1">{$i18n.label.password} (*):</label></td>
    <td class="td-with-input">{$forms.groupForm.password1.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="password2">{$i18n.label.confirm_password} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="password2">{$i18n.label.confirm_password} (*):</label></td>
    <td class="td-with-input">{$forms.groupForm.password2.control}</td>
  </tr>
  <tr class = "small-screen-label"><td><label for="manager_email">{$i18n.label.email}{if isTrue('EMAIL_REQUIRED')} (*){/if}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="manager_email">{$i18n.label.email}{if isTrue('EMAIL_REQUIRED')} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.groupForm.manager_email.control}</td>
  </tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
  <tr>
    <td colspan="2">{$forms.groupForm.btn_submit.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
</table>
{$forms.groupForm.close}