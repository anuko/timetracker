{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.groupAdvancedForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="group_name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="group_name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.groupAdvancedForm.group_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="description">{$i18n.label.description}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="description">{$i18n.label.description}:</label></td>
    <td class="td-with-input">{$forms.groupAdvancedForm.description.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="bcc_email">{$i18n.label.bcc}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="bcc_email">{$i18n.label.bcc}:</label></td>
    <td class="td-with-input">{$forms.groupAdvancedForm.bcc_email.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_10.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_10.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="allow_ip">{$i18n.form.group_edit.allow_ip}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="allow_ip">{$i18n.form.group_edit.allow_ip}:</label></td>
    <td class="td-with-input">{$forms.groupAdvancedForm.allow_ip.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_21.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_21.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.groupAdvancedForm.btn_save.control}</div>
{$forms.groupAdvancedForm.close}
