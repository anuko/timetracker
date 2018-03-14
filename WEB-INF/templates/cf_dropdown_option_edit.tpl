{$forms.optionEditForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
{if $user->can('manage_custom_fields')}
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.optionEditForm.name.control}</td>
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
         <td colspan="2" align="center" height="50">{$forms.optionEditForm.btn_save.control}</td>
        </tr>
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.optionEditForm.close}
