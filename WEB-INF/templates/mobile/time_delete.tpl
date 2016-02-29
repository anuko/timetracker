{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table border='0' cellpadding='3' cellspacing='1' width="100%">
  <tr>
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td class="tableHeader" align="center">{$i18n.label.project}</td>
{/if}
    <td class="tableHeader" align="center">{$i18n.label.duration}</td>
	<td class="tableHeader" align="center">{$i18n.label.note}</td>
  </tr>
  <tr bgcolor="{cycle values="#f5f5f5,#ccccce"}">
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td>{$time_rec.project_name|escape:'html'}</td>
{/if}
    <td align="right">{if $time_rec.duration<>'0:00'}{$time_rec.duration}{else}<font color="#ff0000">{$i18n.form.time.uncompleted}</font>{/if}</td>
    <td>{if $time_rec.comment}{$time_rec.comment|escape:'html'}{else}&nbsp;{/if}</td>
  </tr>
  </table>
  <table width="100%">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">{$forms.timeRecordForm.delete_button.control}&nbsp;&nbsp;{$forms.timeRecordForm.cancel_button.control}</td>
  </tr>
  </table>
  </td>
</tr>
</table>
{$forms.timeRecordForm.close}