<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td>
      <table border=0 width=100%>
        <tr><td align="center"><b style="font-size: 15pt; font-family: Arial, Helvetica, sans-serif;">{$timesheet['name']|escape} </b></td></tr>
        <tr><td align="left"><b>{$i18n.label.user}:</b> {$timesheet['user_name']|escape}</td></tr>
{if $timesheet['client_id']}
        <tr><td align="left"><b>{$i18n.label.client}:</b> {$timesheet['client_name']|escape}</td></tr>
{/if}
        <tr><td align="left"><b>{$i18n.label.submitted}:</b> {if $timesheet.submit_status}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td></tr>
{if $timesheet['submitter_comment']}
        <tr><td align="left"><b>{$i18n.label.comment}:</b> {$timesheet['submitter_comment']|escape}</td></tr>
{/if}
{if $timesheet['submit_status']}
        <tr><td align="left"><b>{$i18n.label.approved}:</b> {if $timesheet.approval_status != null}{if $timesheet.approval_status}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td></tr>{/if}
{/if}
{if $timesheet['manager_comment']}
        <tr><td align="left"><b>{$i18n.label.note}:</b> {$timesheet['manager_comment']|escape}</td></tr>
{/if}
      </table>
    </td>
  </tr>
  <tr>
    <td valign="top">
      <table border="0" cellpadding="3" cellspacing="1" width="100%">
      <tr>
        <td class="tableHeader">{$group_by_header|escape}</td>
        <td class="tableHeaderCentered" width="5%">{$i18n.label.duration}</td>
        <td class="tableHeaderCentered" width="5%">{$i18n.label.cost}</td>
      </tr>
  {foreach $subtotals as $subtotal}
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{if $subtotal['name']}{$subtotal['name']|escape}{else}&nbsp;{/if}</td>
        <td class="cellRightAlignedSubtotal">{$subtotal['time']}</td>
        <td class="cellRightAlignedSubtotal">{if $user->can('manage_invoices') || $user->isClient()}{$subtotal['cost']}{else}{$subtotal['expenses']}{/if}</td>
      </tr>
  {/foreach}
      <tr><td>&nbsp;</td></tr>
      <tr class="rowReportSubtotal">
        <td class="cellLeftAlignedSubtotal">{$i18n.label.total}</td>
        <td nowrap class="cellRightAlignedSubtotal">{$totals['time']}</td>
        <td nowrap class="cellRightAlignedSubtotal">{$user->currency|escape} {if $user->can('manage_invoices') || $user->isClient()}{$totals['cost']}{else}{$totals['expenses']}{/if}</td>
      </tr>
      </table>

{$forms.timesheetForm.open}
  {if $show_submit}
  <table width="720" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td align="center">
      <table>
        <tr><td>  {if $show_approvers}{$i18n.form.mail.to}: {$forms.timesheetForm.approver.control}{/if} {$forms.timesheetForm.btn_submit.control}</td></tr>
      </table>
    </td>
  </tr>
  </table>
  {/if}
  {if $show_approve}
  <table width="720" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td align="center">
      <table>
        <tr><td align="center">{$i18n.label.comment}:</td></tr>
        <tr><td align="center">{$forms.timesheetForm.comment.control}</td></tr>
        <tr><td align="center">{$forms.timesheetForm.btn_approve.control} {$forms.timesheetForm.btn_disapprove.control}</td></tr>
      </table>
    </td>
  </tr>
  </table>
  {/if}
{$forms.timesheetForm.close}

    </td>
  </tr>
</table>
