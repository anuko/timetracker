{$forms.workForm.open}
<table cellspacing="4" cellpadding="7" border="0" width="720">
{if $offer}
  <tr>
    <td>
      <table border=0 width=100%>
        <tr><td align="left"><b>{$i18n.label.offer}:</b> {$offer.subject}</td></tr>
        <tr><td align="left"><b>{$i18n.label.contractor}:</b> {$offer.group_name}</td></tr>
        <tr><td align="left"><b>{$i18n.label.description}:</b> {$offer.descr_short|escape}</td></tr>
        <tr><td align="left"><b>{$i18n.label.budget}:</b> {$offer.amount_with_currency}</td></tr>
      </table>
    </td>
  </tr>
{/if}
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
        <tr>
          <td align="right">{$i18n.label.budget}:</td>
          <td>{$forms.workForm.budget.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.workForm.close}
