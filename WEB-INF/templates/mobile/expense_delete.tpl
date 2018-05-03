{$forms.expenseItemForm.open}
<table class="mobile-table">
<tr>
  <td>
  <table border="0" cellpadding="3" cellspacing="1" width="100%">
  <tr>
{if $user->isPluginEnabled('cl')}
    <td class="tableHeader" align="center">{$i18n.label.client}</td>
{/if}

{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td class="tableHeader" align="center">{$i18n.label.project}</td>
{/if}
    <td class="tableHeader" align="center">{$i18n.label.item}</td>
    <td class="tableHeader" align="center">{$i18n.label.cost}</td>
  </tr>
  <tr>
{if $user->isPluginEnabled('cl')}
  <td>{$expense_item.client_name|escape}</td>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td>{$expense_item.project_name|escape}</td>
{/if}
    <td>{$expense_item.name|escape}</td>
    <td align="right">{$expense_item.cost}</td>
  </tr>
  </table>
  <table width="100%">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">{$forms.expenseItemForm.delete_button.control}&nbsp;&nbsp;{$forms.expenseItemForm.cancel_button.control}</td>
  </tr>
  </table>
  </td>
</tr>
</table>
{$forms.expenseItemForm.close}
