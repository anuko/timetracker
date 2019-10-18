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
          <td align="right">{$i18n.label.work} (*):</td>
          <td>{$forms.workForm.work_name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.type}:</td>
          <td>{$forms.workForm.work_type.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.description}:</td>
          <td>{$forms.workForm.description.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.details}:</td>
          <td>{$forms.workForm.details.control}</td>
        </tr>
{if $show_files}
        <tr>
          <td align="right">{$i18n.label.file}:</td>
          <td>{$forms.workForm.newfile.control}</td>
        </tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.currency}:</td>
          <td>{$forms.workForm.currency.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.budget} (*):</td>
          <td>{$forms.workForm.budget.control} <a href="https://www.anuko.com/lp/tt_41.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.status}:</td>
          <td>{$forms.workForm.status.control}</td>
        </tr>
{if $show_moderator_comment}
        <tr>
          <td align = "right">{$i18n.label.moderator_comment}:</td>
          <td>{$forms.workForm.moderator_comment.control}</td>
        </tr>
{/if}
        <tr>
          <td></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.workForm.btn_save.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.workForm.close}
