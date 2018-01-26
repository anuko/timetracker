<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td>
      <table border=0 width=100%>
        <tr><td align="center"><b style="font-size: 15pt; font-family: Arial, Helvetica, sans-serif;">{$i18n.title.invoice} {$invoice_name|escape} </b></td></tr>
        <tr><td align="left"><b>{$i18n.label.date}:</b> {$invoice_date}</td></tr>
        <tr><td align="left"><b>{$i18n.label.client}:</b> {$client_name|escape}</td></tr>
        <tr><td align="left"><b>{$i18n.label.client_address}:</b> {$client_address|escape}</td></tr>
      </table>
    </td>
  </tr>
  <tr>
    <td valign="top">
{if $invoice_items}
      <table border="0" cellpadding="3" cellspacing="1" width="100%">
        <tr>
          <td class="tableHeader">{$i18n.label.date}</td>
          <td class="tableHeader">{$i18n.form.invoice.person}</td>
  {if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
          <td class="tableHeader">{$i18n.label.project}</td>
  {/if}
  {if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
          <td class="tableHeader">{$i18n.label.task}</td>
  {/if}
          <td class="tableHeader">{$i18n.label.note}</td>
          <td class="tableHeaderCentered" width="5%">{$i18n.label.duration}</td>
          <td class="tableHeaderCentered" width="5%">{$i18n.label.cost}</td>
  {if $user->isPluginEnabled('ps')}
          <td class="tableHeader">{$i18n.label.paid}</td>
  {/if}
        </tr>
  {foreach $invoice_items as $invoice_item}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td valign="top">{$invoice_item.date}</td>
          <td valign="top">{$invoice_item.user_name|escape}</td>
    {if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
          <td valign="top">{$invoice_item.project_name|escape}</td>
    {/if}
    {if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
          <td valign="top">{$invoice_item.task_name|escape}</td>
    {/if}
          <td valign="top">{$invoice_item.note|escape}</td>
          <td align="right" valign="top">{$invoice_item.duration}</td>
          <td align="right" valign="top">{$invoice_item.cost}</td>
    {if $user->isPluginEnabled('ps')}
          <td align="right" valign="top">{if $invoice_item.paid}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
    {/if}
        </tr>
  {/foreach}
        <tr><td>&nbsp;</td></tr>
  {if $tax}
        <tr>
          <td align="right" colspan="{$colspan}"><b>{$i18n.label.subtotal}:</b></td>
          <td align="right"><nobr>{$subtotal|escape}</nobr></td>
        </tr>
        <tr>
          <td align="right" colspan="{$colspan}"><b>{$i18n.label.tax}:</b></td>
          <td align="right"><nobr>{$tax|escape}</nobr></td>
        </tr>
   {/if}
        <tr>
          <td align="right" colspan="{$colspan}"><b>{$i18n.label.total}:</b></td>
          <td align="right"><nobr>{$total|escape}</nobr></td>
        </tr>
      </table>

  {$forms.invoiceForm.open}
  {if $user->isPluginEnabled('ps')}
  <table width="720" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td align="right">
      <table>
        <tr><td>{$i18n.label.mark_paid}: {$forms.invoiceForm.mark_paid_action_options.control} {$forms.invoiceForm.btn_mark_paid.control}</td></tr>
      </table>
    </td>
  </tr>
  </table>
  {/if}
  {$forms.invoiceForm.close}
{/if}
    </td>
  </tr>
  <tr><td align="center"><br><form>
    <input type="button" onclick="chLocation('invoice_send.php?id={$invoice_id}');" value="{$i18n.button.send_by_email}">
  </form></td></tr>
</table>
