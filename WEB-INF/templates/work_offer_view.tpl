{$forms.offerForm.open}
<table cellspacing="4" cellpadding="7" border="0" width="720">
{if $work_item}
    <tr>
    <td>
      <table border=0 width=100%>
        <tr><td align="left"><b>{$i18n.label.work}:</b> {$work_item.subject}</td></tr>
        <tr><td align="left"><b>{$i18n.label.description}:</b> {$work_item.descr_short|escape}</td></tr>
        <tr><td align="left"><b>{$i18n.label.budget}:</b> {$work_item.amount_with_currency}</td></tr>
      </table>
    </td>
  </tr>
{/if}

  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.contractor}:</td>
          <td>{$forms.offerForm.contractor.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.offer}:</td>
          <td>{$forms.offerForm.offer_name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.description}:</td>
          <td>{$forms.offerForm.description.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.details}:</td>
          <td>{$forms.offerForm.details.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.budget}:</td>
          <td>{$forms.offerForm.budget.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.status}:</td>
          <td>{$forms.offerForm.status.control}</td>
        </tr>

        <tr><td>&nbsp;</td></tr>
        <tr>
          <td></td>
          <td align="center" height="50">{$forms.offerForm.btn_accept.control} {$forms.offerForm.btn_decline.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.comment}:</td>
          <td>{$forms.offerForm.client_comment.control}</td>
        </tr>

      </table>
    </td>
  </tr>
</table>
{$forms.offerForm.close}
