{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.predefinedExpensesForm.open}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.cost}</th>
    <th></th>
    <th></th>
  </tr>
{if $predefined_expenses}
  {foreach $predefined_expenses as $predefined_expense}
  <tr>
    <td class="text-cell">{$predefined_expense['name']|escape}</td>
    <td class="money-value-cell">{$predefined_expense['cost']|escape}</td>
    <td><a href="predefined_expense_edit.php?id={$predefined_expense['id']}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="predefined_expense_delete.php?id={$predefined_expense['id']}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
  {/foreach}
{/if}
</table>
<div class="button-set">{$forms.predefinedExpensesForm.btn_add.control}</div>
{$forms.predefinedExpensesForm.close}
