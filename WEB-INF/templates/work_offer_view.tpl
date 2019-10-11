{$forms.offerForm.open}
<table cellspacing="4" cellpadding="7" border="0">
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
{if $show_files}
        <tr>
          <td align="right">{$i18n.label.file}:</td>
          <td>{$forms.offerForm.newfile.control}</td>
        </tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.budget}:</td>
          <td>{$forms.offerForm.budget.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.status}:</td>
          <td>{$forms.offerForm.status.control}</td>
        </tr>
{if isTrue('WORK_DEBUG')}
        <tr>
          <td colspan="2" align="center" height="50">{$forms.offerForm.btn_accept.control} {$forms.offerForm.btn_decline.control} </td>
{/if}        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.offerForm.close}
