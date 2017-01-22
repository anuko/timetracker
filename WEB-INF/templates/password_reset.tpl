{$forms.resetPasswordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
{if $result_message}
      <table cellspacing="4" cellpadding="7" border="0" width="100%">
        <tr><td align="center"><font color="red"><b>{$result_message}</b></font></td></tr>
      </table>
{else}
      <table>
        <tr>
          <td align="right">{$i18n.label.login}:</td>
          <td colspan="3">{$forms.resetPasswordForm.login.control}</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="3" align="center">{$forms.resetPasswordForm.btn_submit.control}</td>
        </tr>
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.resetPasswordForm.close}
