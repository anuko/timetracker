{$forms.timesheetForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align = "right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.timesheetForm.timesheet_name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.comment}:</td>
          <td>{$forms.timesheetForm.comment.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.status}:</td>
          <td>{$forms.timesheetForm.status.control}</td>
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
          <td></td>
          <td align="center" height="50">{$forms.timesheetForm.btn_save.control} {if $can_delete}{$forms.timesheetForm.btn_delete.control}{/if}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.timesheetForm.close}
