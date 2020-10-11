{$forms.timeRecordForm.open}
<table class="centered-table">
  <tr>
{if $show_project}
    <th>{$i18n.label.project}</th>
{/if}
{if $show_task}
    <th>{$i18n.label.task}</th>
{/if}
{if $show_start}
    <th>{$i18n.label.start}</td>
    <th>{$i18n.label.finish}</th>
{/if}
{if $show_duration}
    <th>{$i18n.label.duration}</th>
{/if}
    <th>{$i18n.label.note}</th>
  </tr>
  <tr>
{if $show_project}
    <td class="text-cell">{$time_rec.project_name|escape}</td>
{/if}
{if $show_task}
    <td class="text-cell">{$time_rec.task_name|escape}</td>
{/if}
{if $show_start}
    <td class="time-cell">{if $time_rec.start}{$time_rec.start}{else}&nbsp;{/if}</td>
    <td class="time-cell">{if $time_rec.finish<>$time_rec.start}{$time_rec.finish}{else}&nbsp;{/if}</td>
{/if}
{if $show_duration}
    <td class="time-cell">{if ($time_rec.duration == '0:00' && $time_rec.start <> '')}<font color="#ff0000">{$i18n.form.time.uncompleted}</font>{else}{$time_rec.duration}{/if}</td>
{/if}
    <td class="text-cell">{if $time_rec.comment}{$time_rec.comment|escape}{else}&nbsp;{/if}</td>
  </tr>
</table>
<div class="button-set">{$forms.timeRecordForm.delete_button.control}&nbsp;{$forms.timeRecordForm.cancel_button.control}</div>
{$forms.timeRecordForm.close}
