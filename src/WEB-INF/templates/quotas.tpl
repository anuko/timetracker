{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<div class="page-hint">{$i18n.form.quota.hint}</div>
{$forms.monthlyQuotasForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="workdayHours">{$i18n.form.quota.workday_hours}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="workdayHours">{$i18n.form.quota.workday_hours}:</label></td>
    <td class="td-with-input">{$forms.monthlyQuotasForm.workdayHours.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="year">{$i18n.form.quota.year}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="year">{$i18n.form.quota.year}:</label></td>
    <td class="td-with-input">{$forms.monthlyQuotasForm.year.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="form-control-separator"></div>
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.form.quota.month}</th>
    <th>{$i18n.label.quota}</th>
  </tr>
{foreach $months as $month}
  <tr>
    <td class="label-cell">{$month}:</td>
    <td>{$forms.monthlyQuotasForm.$month.control}</td>
  </tr>
{/foreach}
</table>
<div class="button-set"><input type="submit" name="btn_submit" value="{$i18n.button.save}"</div>
{$forms.monthlyQuotasForm.close}

<script>
function yearChange(value){
  var url = window.location.href;

  if (url.indexOf('?') > 0){
    var parameter = url.substring(url.indexOf('?') + 1, url.length);
    url = url.replace(parameter, 'year=' + value);
  } else {
    url = '?year=' + value;
  }

  window.location = url;
}
</script>
