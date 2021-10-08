<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{$forms.messageForm.open}
<table cellspacing="4" cellpadding="7" border="0" width="720">
{if $work_item}
  <tr>
    <td>
      <table border="0" width="100%">
        <tr><td align="left"><b>{$i18n.label.work}:</b> {$work_item.subject}</td></tr>
        <tr><td align="left"><b>{$i18n.label.description}:</b> {$work_item.descr_short|escape}</td></tr>
        <tr><td align="left"><b>{$i18n.label.budget}:</b> {$work_item.amount_with_currency}</td></tr>
      </table>
    </td>
  </tr>
{/if}
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0" width="100%">
        <tr>
          <td align="right">{$i18n.work.label.message}:</td>
          <td>{$forms.messageForm.message_body.control}</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.messageForm.btn_send.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.messageForm.close}
