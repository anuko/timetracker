<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table class="mobile-table">
  <tr>
    <td valign="top">
{if $user->can('manage_clients')}
      <table class="mobile-table-details">
  {if $inactive_clients}
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.clients.active_clients}</td></tr>
  {/if}
        <tr>
          <td width="40%" class="tableHeader">{$i18n.label.person_name}</td>
          <td width="40%" class="tableHeader">{$i18n.label.address}</td>
        </tr>
  {foreach $active_clients as $client}
        <tr valign="top" bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td><a href="client_edit.php?id={$client.id}">{$client.name|escape}</a></td>
          <td>{$client.address|escape}</td>
        </tr>
  {/foreach}
      </table>

      <table width="100%">
        <tr><td align="center"><br><form><input type="button" onclick="chLocation('client_add.php');" value="{$i18n.button.add}"></form></td></tr>
      </table>

  {if $inactive_clients}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.clients.inactive_clients}</td></tr>
        <tr>
          <td width="40%" class="tableHeader">{$i18n.label.person_name}</td>
          <td width="40%" class="tableHeader">{$i18n.label.address}</td>
        </tr>
    {foreach $inactive_clients as $client}
        <tr valign="top" bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td><a href="client_edit.php?id={$client.id}">{$client.name|escape}</a></td>
          <td>{$client.address|escape}</td>
        </tr>
    {/foreach}
      </table>

      <table width="100%">
        <tr><td align="center"><br><form><input type="button" onclick="chLocation('client_add.php');" value="{$i18n.button.add}"></form></td></tr>
      </table>
  {/if}
{else}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td class="tableHeader">{$i18n.label.thing_name}</td>
          <td class="tableHeader">{$i18n.label.address}</td>
        </tr>
  {if $active_clients}
    {foreach $active_clients as $client}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$client.name|escape}</td>
          <td>{$client.address|escape}</td>
        </tr>
    {/foreach}
  {/if}
      </table>
{/if}
    </td>
  </tr>
</table>
