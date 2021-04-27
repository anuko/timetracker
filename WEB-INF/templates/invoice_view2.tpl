{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<div class="invoice-header">{$i18n.title.invoice} {$invoice_name|escape}</div>
<table class="centered-table">
  <tr>
    <th class="invoice-label">{$i18n.label.date}:</th>
    <td class="text-cell">{$invoice_date}</td>
  </tr>
  <tr>
    <th class="invoice-label">{$i18n.label.client}:</th>
    <td class="text-cell">{$client_name|escape}</td></tr>
{if isset($client_address)}
  <tr>
    <th class="invoice-label">{$i18n.label.client_address}:</th>
    <td class="text-cell">{$client_address|escape}</td>
  </tr>
{/if}
</table>
<div class="form-control-separator"></div>

{if $invoice_items}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.date}</th>
    <th>{$i18n.form.invoice.person}</th>
  {if $show_project}
    <th>{$i18n.label.project}</th>
  {/if}
  {if $show_task}
    <th>{$i18n.label.task}</th>
  {/if}
    <th>{$i18n.label.note}</th>
    <th>{$i18n.label.duration}</th>
    <th>{$i18n.label.cost}</th>
  {if $user->isPluginEnabled('ps')}
    <th>{$i18n.label.paid}</th>
  {/if}
  </tr>
  {foreach $invoice_items as $invoice_item}
  <tr>
    <td class="date-cell">{$invoice_item.date}</td>
    <td class="text-cell">{$invoice_item.user_name|escape}</td>
    {if $show_project}
    <td class="text-cell">{$invoice_item.project_name|escape}</td>
    {/if}
    {if $show_task}
    <td class="text-cell">{$invoice_item.task_name|escape}</td>
    {/if}
     <td class="text-cell">{$invoice_item.note|escape}</td>
     <td class="time-cell">{$invoice_item.duration}</td>
     <td class="money-value-cell">{$invoice_item.cost}</td>
    {if $show_paid_column}
     <td class="yes-no-cell">{if $invoice_item.paid}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
    {/if}
  </tr>
  {/foreach}
  {if isset($tax)}
  <tr>
    <th class="invoice-label" colspan="{$colspan}">{$i18n.label.subtotal}:</th>
    <td class="money-value-cell"><nobr>{$subtotal|escape}</nobr></td>
    {if $show_paid_column}
    <td></td>
    {/if}
  </tr>
  <tr>
    <th class="invoice-label" colspan="{$colspan}">{$i18n.label.tax}:</th>
    <td class="money-value-cell"><nobr>{$tax|escape}</nobr></td>
    {if $show_paid_column}
    <td></td>
    {/if}
  </tr>
  {/if}
  <tr>
    <th class="invoice-label" colspan="{$colspan}">{$i18n.label.total}:</th>
    <td class="money-value-cell"><nobr>{$total|escape}</nobr></td>
    {if $show_paid_column}
    <td></td>
    {/if}
  </tr>
</table>
{/if}

{if isset($show_mark_paid)}
{$forms.invoiceForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="mark_paid_action_options">{$i18n.label.mark_paid}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="mark_paid_action_options">{$i18n.label.mark_paid}:</label></td>
    <td class="td-with-input">{$forms.invoiceForm.mark_paid_action_options.control} {$forms.invoiceForm.btn_mark_paid.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
{$forms.invoiceForm.close}
{/if}
<div class="button-set">
  <form>
    <input type="button" onclick="chLocation('invoice_send.php?id={$invoice_id}');" value="{$i18n.button.send_by_email}">
  </form>
</div>
