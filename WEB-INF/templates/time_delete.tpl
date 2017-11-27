{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="7" border="0" width="720">
<tr>
  <td>
  <table border='0' cellpadding='3' cellspacing='1' width="100%">
  <tr>
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td class="tableHeader" align="center">{$i18n.label.project}</td>
{/if}
{if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td class="tableHeader" align="center">{$i18n.label.task}</td>
{/if}
{if (($smarty.const.TYPE_START_FINISH == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
    <td class="tableHeader" align="center">{$i18n.label.start}</td>
    <td class="tableHeader" align="center">{$i18n.label.finish}</td>
{/if}
{if (($smarty.const.TYPE_DURATION == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
    <td class="tableHeader" align="center">{$i18n.label.duration}</td>
{/if}
    <td class="tableHeader" align="center">{$i18n.label.note}</td>
  </tr>
  <tr>
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td>{$time_rec.project_name|escape}</td>
{/if}
{if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td>{$time_rec.task_name|escape}</td>
{/if}
{if (($smarty.const.TYPE_START_FINISH == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
    <td align="right">{if $time_rec.start}{$time_rec.start}{else}&nbsp;{/if}</td>
    <td align="right">{if $time_rec.finish<>$time_rec.start}{$time_rec.finish}{else}&nbsp;{/if}</td>
{/if}
{if (($smarty.const.TYPE_DURATION == $user->record_type) || ($smarty.const.TYPE_ALL == $user->record_type))}
    <td align="right">{if ($time_rec.duration == '0:00' && $time_rec.start <> '')}<font color="#ff0000">{$i18n.form.time.uncompleted}</font>{else}{$time_rec.duration}{/if}</td>
{/if}
    <td>{if $time_rec.comment}{$time_rec.comment|escape}{else}&nbsp;{/if}</td>
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
