{$forms.taskForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.taskForm.name.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.description}:</td>
          <td>{$forms.taskForm.description.control}</td>
        </tr>
        <tr valign="top">
          <td align="right">{$i18n.label.projects}:</td>
          <td>{$forms.taskForm.projects.control}</td>
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
          <td colspan="2" align="center" height="50">{$forms.taskForm.btn_submit.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.taskForm.close}
