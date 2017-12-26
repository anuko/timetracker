{include file="time_script.tpl"}

<style>
.not_billable td {
  color: #ff6666;
}
</style>

{$forms.weekTimeForm.open}
<table cellspacing="4" cellpadding="0" border="0">
{if defined(WEEK_VIEW_DEBUG)}
  <tr>
    <td align="center" colspan=2">
      <a href="time.php?date={$selected_date->toString()}">{$i18n.label.day_view}</a>&nbsp;/&nbsp;<a href="week.php?date={$selected_date->toString()}">{$i18n.label.week_view}</a>
    </td>
  </tr>
{/if}
  <tr>
    <td valign="top">
      <table>
{if $on_behalf_control}
        <tr>
          <td align="right">{$i18n.label.user}:</td>
          <td>{$forms.weekTimeForm.onBehalfUser.control}</td>
        </tr>
{/if}
      </table>
    </td>
    <td valign="top">
      <table>
        <tr><td>{$forms.weekTimeForm.date.control}</td></tr>
      </table>
    </td>
  </tr>
</table>
<table width="720">
  <tr valign="top">
    <td>{$forms.weekTimeForm.week_durations.control}</td>
  </tr>
</table>
<!--
<table>
  <tr>
    <td align="center" colspan="2">{$forms.weekTimeForm.btn_submit.control}</td>
  </tr>
</table>
-->
{$forms.weekTimeForm.close}
