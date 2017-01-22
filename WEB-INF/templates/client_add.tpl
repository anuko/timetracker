{$forms.clientForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.client_name} (*):</td>
          <td>{$forms.clientForm.name.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.client_address}:</td>
          <td>{$forms.clientForm.address.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.tax}, %:</td>
          <td>{$forms.clientForm.tax.control}&nbsp;(0{$user->decimal_mark}00)</td>
        </tr>
        <tr>
          <td height="40"></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr>
          <td align="right">{$i18n.label.projects}:</td>
          <td>{$forms.clientForm.projects.control}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
{/if}
        <tr>
          <td colspan="2" align="center" height="50">{$forms.clientForm.btn_submit.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.clientForm.close}
