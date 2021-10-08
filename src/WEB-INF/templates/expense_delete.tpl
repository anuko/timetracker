{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.expenseItemForm.open}
<table class="centered-table">
  <tr>
{if $user->isPluginEnabled('cl')}
    <th>{$i18n.label.client}</th>
{/if}
{if $show_project}
    <th>{$i18n.label.project}</th>
{/if}
    <th>{$i18n.label.item}</th>
    <th>{$i18n.label.cost}</th>
  </tr>
  <tr>
{if $user->isPluginEnabled('cl')}
    <td class="text-cell">{$expense_item.client_name|escape}</td>
{/if}
{if $show_project}
    <td class="text-cell">{$expense_item.project_name|escape}</td>
{/if}
    <td class="text-cell">{$expense_item.name|escape}</td>
    <td class="time-cell">{$expense_item.cost}</td>
  </tr>
</table>
<div class="button-set">{$forms.expenseItemForm.delete_button.control}&nbsp;{$forms.expenseItemForm.cancel_button.control}</div>
{$forms.expenseItemForm.close}
