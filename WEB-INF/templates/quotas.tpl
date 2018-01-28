<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr><td valign="top">{$i18n.form.quota.hint}</td></tr>
</table>

{$forms.monthlyQuotasForm.open}
<div style="padding: 0 0 10 0">
  <table border="0" class="divider">
    <tr>
      <td align="center">
        <table>
          <tr>
            <td>{$i18n.form.quota.workday_hours}:</td>
            <td>{$forms.monthlyQuotasForm.workdayHours.control}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
<table>
  <tr>
    <td>{$i18n.form.quota.year}:</td>
    <td>{$forms.monthlyQuotasForm.year.control}</td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td colspan="2">
      <table>
        <tr>
          <td class="tableHeaderCentered">{$i18n.form.quota.month}</td>
          <td class="tableHeaderCentered">{$i18n.form.quota.quota}</td>
        </tr>
{foreach $months as $month}
        <tr>
          <td>{$month}:</td>
          <td>{$forms.monthlyQuotasForm.$month.control}</td>
        </tr>
{/foreach}
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2" style="text-align:center;"><input type="submit" name="btn_submit" value="{$i18n.button.save}"></td></tr>
      </table>
    </td>
  </tr>
</table>
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
