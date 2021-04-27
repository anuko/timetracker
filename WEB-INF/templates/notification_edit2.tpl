{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}


{$forms.notificationForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="fav_report">{$i18n.label.fav_report} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="fav_report">{$i18n.label.fav_report} (*):</label></td>
    <td class="td-with-input">{$forms.notificationForm.fav_report.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="cron_spec">{$i18n.label.schedule} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="cron_spec">{$i18n.label.schedule} (*):</label></td>
    <td class="td-with-input">{$forms.notificationForm.cron_spec.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_6.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_6.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="email">{$i18n.label.email} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="email">{$i18n.label.email} (*):</label></td>
    <td class="td-with-input">{$forms.notificationForm.email.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="cc">{$i18n.label.cc}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="cc">{$i18n.label.cc}:</label></td>
    <td class="td-with-input">{$forms.notificationForm.cc.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="subject">{$i18n.label.subject}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="subject">{$i18n.label.subject}:</label></td>
    <td class="td-with-input">{$forms.notificationForm.subject.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="comment">{$i18n.label.comment}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="comment">{$i18n.label.comment}:</label></td>
    <td class="td-with-input">{$forms.notificationForm.comment.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="report_condition">{$i18n.label.condition}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="report_condition">{$i18n.label.condition}:</label></td>
    <td class="td-with-input">{$forms.notificationForm.report_condition.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_9.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_9.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.notificationForm.btn_submit.control}</div>
{$forms.notificationForm.close}
