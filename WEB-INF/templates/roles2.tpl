{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{if $inactive_roles}
<div class="section-header">{$i18n.form.roles.active_roles}</div>
{/if}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.form.roles.rank}</th>
    <th>{$i18n.label.description}</th>
    <th></th>
    <th></th>
  </tr>
  {if $active_roles}
    {foreach $active_roles as $role}
  <tr>
    <td class="text-cell">{$role.name|escape}</td>
    <td class="number-cell">{$role.rank}</td>
    <td class="text-cell">{$role.description|escape}</td>
    <td><a href="role_edit.php?id={$role.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="role_delete.php?id={$role.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
   </tr>
    {/foreach}
  {/if}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('role_add.php');" value="{$i18n.button.add}"></form></div>

{if $inactive_roles}
<div class="section-header">{$i18n.form.roles.inactive_roles}</div>
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.form.roles.rank}</th>
    <th>{$i18n.label.description}</th>
    <th></th>
    <th></th>
  </tr>
  {if $active_roles}
    {foreach $inactive_roles as $role}
  <tr>
    <td class="text-cell">{$role.name|escape}</td>
    <td class="number-cell">{$role.rank}</td>
    <td class="text-cell">{$role.description|escape}</td>
    <td><a href="role_edit.php?id={$role.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="role_delete.php?id={$role.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
   </tr>
    {/foreach}
  {/if}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('role_add.php');" value="{$i18n.button.add}"></form></div>
{/if}
