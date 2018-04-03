{$forms.exportForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td align="center">
{if $user->can('export_data')}
      <table border="0" width="60%">
        <colgroup>
          <col width="50%">
          <col width="50%">
        </colgroup>
        <tr><td colspan="2">{$i18n.form.export.hint}<br></td></tr>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
          <td align="right">{$i18n.form.export.compression}:</td>
          <td>{$forms.exportForm.compression.control}</td>
        </tr>
        <tr><td height="50" align="center" colspan="2">{$forms.exportForm.btn_submit.control}</td></tr>
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.exportForm.close}
