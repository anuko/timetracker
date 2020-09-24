{$forms.groupForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td>{$i18n.label.group_name} (*):</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.group_name} (*):</td>
    <td class="td-with-input">{$forms.groupForm.group_name.control} <a href="https://www.anuko.com/lp/tt_37.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.label.currency}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.currency}:</td>
    <td class="td-with-input">{$forms.groupForm.currency.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.label.language}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.language}:</td>
    <td class="td-with-input">{$forms.groupForm.lang.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.label.manager_name} (*):</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.manager_name} (*):</td>
    <td class="td-with-input">{$forms.groupForm.manager_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.label.manager_login} (*):</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.manager_login} (*):</td>
    <td class="td-with-input">{$forms.groupForm.manager_login.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.label.password} (*):</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.password} (*):</td>
    <td class="td-with-input">{$forms.groupForm.password1.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.label.confirm_password} (*):</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.confirm_password} (*):</td>
    <td class="td-with-input">{$forms.groupForm.password2.control}</td>
  </tr>
  <tr class = "small-screen-label"><td>{$i18n.label.email}{if isTrue('EMAIL_REQUIRED')} (*){/if}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.email}{if isTrue('EMAIL_REQUIRED')} (*){/if}:</td>
    <td class="td-with-input">{$forms.groupForm.manager_email.control}</td>
  </tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
  <tr>
    <td colspan="2">{$forms.groupForm.btn_submit.control}</td>
  </tr>
</table>
{$forms.groupForm.close}
