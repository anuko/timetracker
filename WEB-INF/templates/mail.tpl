{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.mailForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="receiver">{$i18n.form.mail.to} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="receiver">{$i18n.form.mail.to} (*):</label></td>
    <td class="td-with-input">{$forms.mailForm.receiver.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="cc">{$i18n.label.cc}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="cc">{$i18n.label.cc}:</label></td>
    <td class="td-with-input">{$forms.mailForm.cc.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="subject">{$i18n.label.subject} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="subject">{$i18n.label.subject} (*):</label></td>
    <td class="td-with-input">{$forms.mailForm.subject.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="comment">{$i18n.label.comment}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="comment">{$i18n.label.comment}:</label></td>
    <td class="td-with-input">{$forms.mailForm.comment.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.mailForm.btn_send.control}</div>
{$forms.mailForm.close}
