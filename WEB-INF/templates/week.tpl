{include file="time_script.tpl"}

<style>
.not_billable td {
  color: #ff6666;
}
</style>

{$forms.weekTimeForm.open}
<table cellspacing="4" cellpadding="0" border="0">
  <tr>
    <td align="center" colspan=2">
      <a href="time.php?date={$selected_date->toString()}">{$i18n.label.day_view}</a>&nbsp;/&nbsp;<a href="week.php?date={$selected_date->toString()}">{$i18n.label.week_view}</a>
    </td>
  </tr>
  <tr>
    <td valign="top">
      <table>
{if $on_behalf_control}
        <tr>
          <td align="right">{$i18n.label.user}:</td>
          <td>{$forms.weekTimeForm.onBehalfUser.control}</td>
        </tr>
{/if}
{if $user->isPluginEnabled('cl')}
        <tr>
          <td align="right">{$i18n.label.client}{if $user->isPluginEnabled('cm')} (*){/if}:</td>
          <td>{$forms.weekTimeForm.client.control}</td>
        </tr>
{/if}
{if $user->isPluginEnabled('iv')}
        <tr>
          <td align="right">&nbsp;</td>
          <td><label>{$forms.weekTimeForm.billable.control}{$i18n.form.time.billable}</label></td>
        </tr>
{/if}
{if ($custom_fields && $custom_fields->fields[0])}
        <tr>
          <td align="right">{$custom_fields->fields[0]['label']|escape}{if $custom_fields->fields[0]['required']} (*){/if}:</td><td>{$forms.weekTimeForm.cf_1.control}</td>
        </tr>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr>
          <td align="right">{$i18n.label.project} (*):</td>
          <td>{$forms.weekTimeForm.project.control}</td>
        </tr>
{/if}
{if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr>
          <td align="right">{$i18n.label.task}:</td>
          <td>{$forms.weekTimeForm.task.control}</td>
        </tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.note}:</td>
          <td align="left">{$forms.weekTimeForm.note.control}</td>
        </tr>
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
<table>
  <tr>
    <td align="center" colspan="2">{$forms.weekTimeForm.btn_submit.control}</td>
  </tr>
</table>
{$forms.weekTimeForm.close}
