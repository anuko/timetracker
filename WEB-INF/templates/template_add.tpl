{$forms.templateForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.templateForm.name.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.description}:</td>
          <td>{$forms.templateForm.description.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.template} (*):</td>
          <td>{$forms.templateForm.content.control}</td>
        </tr>
{if $show_projects}
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td align="right">{$i18n.label.projects}:</td>
          <td>{$forms.templateForm.projects.control}</td>
        </tr>
{/if}
        <tr>
          <td height="40"></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.templateForm.btn_add.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.templateForm.close}
