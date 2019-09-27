{$forms.workForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.work}:</td>
          <td>{$forms.workForm.work_name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.description}:</td>
          <td>{$forms.workForm.description.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.details}:</td>
          <td>{$forms.workForm.details.control}</td>
        </tr>
{if $show_files}
        <tr>
          <td align="right">{$i18n.label.file}:</td>
          <td>{$forms.workForm.newfile.control}</td>
        </tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.budget}:</td>
          <td>{$forms.workForm.budget.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.workForm.close}
