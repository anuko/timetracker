{$forms.expenseItemForm.open}
<table cellspacing="4" cellpadding="7" border="0" width="720">
<tr>
  <td>
  <table border='0' cellpadding='3' cellspacing='1' width="100%">
  <tr>
{if in_array('cl', explode(',', $user->plugins))}
    <td class="tableHeader" align="center">{$i18n.label.client}</td>
{/if}

{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td class="tableHeader" align="center">{$i18n.label.project}</td>
{/if}
    <td class="tableHeader" align="center">{$i18n.label.item}</td>
    <td class="tableHeader" align="center">{$i18n.label.cost}</td>
  </tr>
  <tr bgcolor="{cycle values="#f5f5f5,#ccccce"}">
{if in_array('cl', explode(',', $user->plugins))}
  <td>{$expense_item.client_name|escape:'html'}</td>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <td>{$expense_item.project_name|escape:'html'}</td>
{/if}
    <td>{$expense_item.name|escape:'html'}</td>
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