{$forms.fieldForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
{if $user->can('manage_custom_fields')}
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.fieldForm.name.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.type}:</td>
          <td>{$forms.fieldForm.type.control}</td>
        </tr>
        <tr>
          <td align="right"><label for="required">{$i18n.label.required}:</label></td>
          <td>{$forms.fieldForm.required.control}</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.fieldForm.btn_save.control}</td>
        </tr>
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.fieldForm.close}
