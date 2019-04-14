<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
{if $user->can('manage_invoices') || $user->can('view_client_invoices')}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td class="tableHeader">{$i18n.label.invoice}</td>
          <td class="tableHeader">{$i18n.label.client}</td>
          <td class="tableHeader">{$i18n.label.date}</td>
  {if $user->isPluginEnabled('ps')}
          <td class="tableHeader">{$i18n.label.paid}</td>
  {/if}
  {if !$user->isClient()}
          <td></td>
  {/if}
        </tr>
        {foreach $invoices as $invoice}
        <tr valign="top" bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td><a href="invoice_view.php?id={$invoice.id}">{$invoice.name|escape}</a></td>
          <td>{$invoice.client_name|escape}</td>
          <td>{$invoice.date}</td>
  {if $user->isPluginEnabled('ps')}
          <td>{if $invoice.paid}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
  {/if}
  {if !$user->isClient()}
          <td><a href="invoice_delete.php?id={$invoice.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="images/icon_delete.png"></a></td>
  {/if}
        </tr>
        {/foreach}
      </table>

  {if !$user->isClient()}
      <table width="100%">
        <tr><td align="center"><br><form><input type="button" onclick="chLocation('invoice_add.php');" value="{$i18n.button.add}"></form></td></tr>
      </table>
  {/if}
{/if}
    </td>
  </tr>
</table>
