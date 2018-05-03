{$forms.optionDeleteForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
{if $user->can('manage_custom_fields')}
      <table cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td colspan="2" align="center"><b>{$option|escape}</b></td>
        </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">{$forms.optionDeleteForm.btn_delete.control}&nbsp;</td>
          <td align="left">&nbsp;{$forms.optionDeleteForm.btn_cancel.control}</td>
        </tr>
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.optionDeleteForm.close}
