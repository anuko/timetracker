{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{if $show_sorting_options}
{$forms.invoicesForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="sort_option_1">{$i18n.label.sort}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="sort_option_1">{$i18n.label.sort}:</label></td>
    <td class="td-with-input">{$forms.invoicesForm.sort_option_1.control} {$forms.invoicesForm.sort_order_1.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="sort_option_2">{$i18n.label.sort}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="sort_option_2">{$i18n.label.sort}:</label></td>
    <td class="td-with-input">{$forms.invoicesForm.sort_option_2.control} {$forms.invoicesForm.sort_order_2.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
{$forms.invoicesForm.close}
{/if}

<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.invoice}</th>
    <th>{$i18n.label.client}</th>
    <th>{$i18n.label.date}</th>
{if $user->isPluginEnabled('ps')}
    <th>{$i18n.label.paid}</th>
{/if}
{if !$user->isClient()}
    <th></th>
{/if}
  </tr>
{foreach $invoices as $invoice}
  <tr>
    <td class="text-cell"><a href="invoice_view.php?id={$invoice.id}">{$invoice.name|escape}</a></td>
    <td class="text-cell">{$invoice.client|escape}</td>
    <td class="date-cell">{$invoice.date}</td>
  {if $user->isPluginEnabled('ps')}
    <td class="yes-no-cell">{if $invoice.paid}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
  {/if}
  {if !$user->isClient()}
    <td><a href="invoice_delete.php?id={$invoice.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  {/if}
  </tr>
{/foreach}
</table>

{if !$user->isClient()}
<div class="button-set"><form><input type="button" onclick="chLocation('invoice_add.php');" value="{$i18n.button.add}"></form></div>
{/if}
