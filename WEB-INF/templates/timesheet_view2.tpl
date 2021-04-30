{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<div class="invoice-header">{$timesheet['name']|escape}</div>
<table class="centered-table">
{if $user->behalfUser}
  <tr>
    <th class="invoice-label">{$i18n.label.user}:</th>
    <td class="text-cell">{$timesheet['user_name']|escape}</td>
  </tr>
{/if}
{if $timesheet['client_id']}
  <tr>
    <th class="invoice-label">{$i18n.label.client}:</th>
    <td class="text-cell">{$timesheet['client_name']|escape}</td>
  </tr>
{/if}
{if $timesheet['project_id']}
  <tr>
    <th class="invoice-label">{$i18n.label.project}:</th>
    <td class="text-cell">{$timesheet['project_name']|escape}</td>
  </tr>
{/if}
{if $timesheet['comment']}
  <tr>
    <th class="invoice-label">{$i18n.label.comment}:</th>
    <td class="text-cell">{$timesheet['comment']|escape}</td>
  </tr>
{/if}
{if $timesheet['approve_status'] == null}
  <tr>
    <th class="invoice-label">{$i18n.label.submitted}:</th>
    <td class="text-cell">{if $timesheet.submit_status}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
  </tr>
{/if}
{if $timesheet['approve_status'] != null}
  <tr>
    <th class="invoice-label">{$i18n.label.approved}:</th>
    <td class="text-cell">{if $timesheet.approve_status}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
  </tr>
{/if}
{if $timesheet['approve_comment']}
  <tr>
    <th class="invoice-label">{$i18n.label.note}:</th>
    <td class="text-cell">{$timesheet['approve_comment']|escape}</td>
  </tr>
{/if}
</table>
<div class="form-control-separator"></div>
<table class="x-scrollable-table">
  <tr>
    <th>{$group_by_header|escape}</th>
    <th>{$i18n.label.duration}</th>
  </tr>
  {foreach $subtotals as $subtotal}
  <tr>
    <td class="text-cell">{if $subtotal['name']}{$subtotal['name']|escape}{else}&nbsp;{/if}</td>
    <td class="time-cell">{$subtotal['time']}</td>
  </tr>
  {/foreach}
  <tr>
    <th class="invoice-label">{$i18n.label.total}:</th>
    <td class="time-cell">{$totals['time']}</td>
  </tr>
</table>

{$forms.timesheetForm.open}
{if $show_submit}
<div class="button-set">{if $show_approvers}{$i18n.form.mail.to}: {$forms.timesheetForm.approver.control}{/if} {$forms.timesheetForm.btn_submit.control}</div>
{/if}
{if $show_approve}
<table class="centered-table">
    <tr><th><label for="comment">{$i18n.label.comment}:</label></th></tr>
  <tr><td class="td-with-input">{$forms.timesheetForm.comment.control}</td></tr>
</table>
<div class="button-set">{$forms.timesheetForm.btn_approve.control} {$forms.timesheetForm.btn_disapprove.control}</div>
{/if}
{$forms.timesheetForm.close}
