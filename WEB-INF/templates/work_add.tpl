{$forms.workForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.workForm.work_name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.description}:</td>
          <td>{$forms.workForm.description.control}</td>
        </tr>
{if $show_files}
        <tr>
          <td align="right">{$i18n.label.file}:</td>
          <td>{$forms.workForm.newfile.control}</td>
        </tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.currency}:</td>
          <td>{$forms.workForm.currency.control}</td>
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
          <td colspan="2" align="center" height="50">{$forms.workForm.btn_add.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.workForm.close}
