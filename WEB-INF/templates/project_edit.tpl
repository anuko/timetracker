{$forms.projectForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align = "right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.projectForm.project_name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.description}:</td>
          <td>{$forms.projectForm.description.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.status}:</td>
          <td>{$forms.projectForm.status.control}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td align="right">{$i18n.label.users}:</td>
          <td>{$forms.projectForm.users.control}</td>
        </tr>
{if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td align="right">{$i18n.label.tasks}:</td>
          <td>{$forms.projectForm.tasks.control}</td>
        </tr>
{/if}
        <tr>
          <td></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.projectForm.btn_save.control} {$forms.projectForm.btn_copy.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.projectForm.close}
