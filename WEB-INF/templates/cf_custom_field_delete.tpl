{$forms.fieldDeleteForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
{if $user->can('manage_custom_fields')}
      <table cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td colspan="2" align="center"><b>{$field|escape}</b></td>
        </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">{$forms.fieldDeleteForm.btn_delete.control}&nbsp;</td>
          <td align="left">&nbsp;{$forms.fieldDeleteForm.btn_cancel.control}</td>
        </tr>
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.fieldDeleteForm.close}
