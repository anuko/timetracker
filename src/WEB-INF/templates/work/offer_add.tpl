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
{if $work_id}
        <tr>
          <td align="right">{$i18n.label.work}:</td>
          <td><a href="work_view.php?id={$work_id}">{$work_name}</a></td>
        </tr>
        <tr>
          <td></td>
          <td>{$forms.offerForm.work_description.control}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.offer} (*):</td>
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
{if $show_files}
        <tr>
          <td align="right">{$i18n.label.file}:</td>
          <td>{$forms.offerForm.newfile.control}</td>
        </tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.currency}:</td>
          <td>{$forms.offerForm.currency.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.budget} (*):</td>
          <td>{$forms.offerForm.budget.control} <a href="https://www.anuko.com/lp/tt_41.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.how_to_pay} (*):</td>
          <td>{$forms.offerForm.payment_info.control}  <a href="https://www.anuko.com/lp/tt_40.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
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
          <td colspan="2" align="center" height="50">{$forms.offerForm.btn_add.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.offerForm.close}
