{$forms.offerForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
{if $work_id}
        <tr>
          <td align="right">{$i18n.label.work}:</td>
          <td><a href="admin_work_edit.php?id={$work_id}">{$work_name}</a></td>
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
          <td>{$forms.offerForm.budget.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.how_to_pay} (*):</td>
          <td>{$forms.offerForm.payment_info.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.status}:</td>
          <td>{$forms.offerForm.status.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.moderator_comment}:</td>
          <td>{$forms.offerForm.moderator_comment.control}</td>
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
          <td colspan="2" align="center" height="50">{$forms.offerForm.btn_approve.control} {$forms.offerForm.btn_save.control} {$forms.offerForm.btn_disapprove.control} </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.offerForm.close}
