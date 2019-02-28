{$forms.timesheetForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.timesheetForm.timesheet_name.control}</td>
        </tr>
{if $show_client}
        <tr>
          <td align="right">{$i18n.label.client}:</td>
          <td>{$forms.timesheetForm.client.control}</td>
        </tr>
{/if}
{if $show_project}
        <tr>
          <td align="right">{$i18n.label.project}:</td>
          <td>{$forms.timesheetForm.project.control}</td>
        </tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.start_date} (*):</td>
          <td>{$forms.timesheetForm.start.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.end_date} (*):</td>
          <td>{$forms.timesheetForm.finish.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.comment}:</td>
          <td>{$forms.timesheetForm.comment.control}</td>
        </tr>
        <tr>
          <td></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.timesheetForm.btn_add.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.timesheetForm.close}
