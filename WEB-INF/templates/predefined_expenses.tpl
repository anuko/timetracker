{$forms.predefinedExpensesForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
{if $user->can('manage_advanced_settings')}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td class="tableHeader">{$i18n.label.thing_name}</td>
          <td class="tableHeader">{$i18n.label.cost}</td>
          <td class="tableHeader">{$i18n.label.edit}</td>
          <td class="tableHeader">{$i18n.label.delete}</td>
        </tr>
  {if $predefined_expenses}
    {foreach $predefined_expenses as $predefined_expense}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$predefined_expense['name']|escape}</td>
          <td>{$predefined_expense['cost']|escape}</td>
          <td><a href="predefined_expense_edit.php?id={$predefined_expense['id']}">{$i18n.label.edit}</a></td>
          <td><a href="predefined_expense_delete.php?id={$predefined_expense['id']}">{$i18n.label.delete}</a></td>
        </tr>
    {/foreach}
  {/if}
      </table>

      <table width="100%">
        <tr><td align="center"><br>{$forms.predefinedExpensesForm.btn_add.control}</td></tr>
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.predefinedExpensesForm.close}
