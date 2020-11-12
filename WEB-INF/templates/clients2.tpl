<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{if $user->can('manage_clients')}
  {if $inactive_clients}<div class="section-header">{$i18n.form.clients.active_clients}</div>{/if}
  {if $active_clients}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.person_name}</th>
    <th>{$i18n.label.address}</th>
    <th></th>
    <th></th>
  </tr>
    {foreach $active_clients as $client}
  <tr>
    <td class="text-cell">{$client.name|escape}</td>
    <td class="text-cell">{$client.address|escape}</td>
    <td><a href="client_edit.php?id={$client.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="client_delete.php?id={$client.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
    {/foreach}
  {/if}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('client_add.php');" value="{$i18n.button.add}"></form></div>
  {if $inactive_clients}
<div class="section-header">{$i18n.form.clients.inactive_clients}</div>
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.person_name}</th>
    <th>{$i18n.label.address}</th>
    <th></th>
    <th></th>
  </tr>
    {foreach $inactive_clients as $client}
  <tr>
    <td class="text-cell">{$client.name|escape}</td>
    <td class="text-cell">{$client.address|escape}</td>
    <td><a href="client_edit.php?id={$client.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="client_delete.php?id={$client.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
    {/foreach}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('client_add.php');" value="{$i18n.button.add}"></form></div>
  {/if}
{else}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.person_name}</th>
    <th>{$i18n.label.address}</th>
  </tr>
  {foreach $active_clients as $client}
  <tr>
    <td class="text-cell">{$client.name|escape}</td>
    <td class="text-cell">{$client.address|escape}</td>
  </tr>
  {/foreach}
</table>
{/if}
