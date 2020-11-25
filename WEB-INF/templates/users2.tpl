{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{if $user->can('manage_users')}
  {if $inactive_users}<div class="section-header">{$i18n.label.active_users}</div>{/if}
  {if $active_users}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.person_name}</th>
    <th>{$i18n.label.login}</th>
    <th>{$i18n.form.users.role}</th>
    {if $show_quota}
     <th>{$i18n.label.quota}</th>
    {/if}
    <th></th>
    <th></th>
  </tr>
    {foreach $active_users as $u}
  <tr>
    <td class="text-cell">
      {if $uncompleted_indicators}
      <span class="uncompleted-entry{if $u.has_uncompleted_entry} active{/if}"{if $u.has_uncompleted_entry} title="{$i18n.form.users.uncompleted_entry}"{/if}></span>
      {/if}
      {$u.name|escape}
    </td>
    <td class="text-cell">{$u.login|escape}</td>
    <td class="text-cell">{$u.role_name|escape}</td>
      {if $show_quota}
    <td class="time-cell">{$u.quota_percent}</td>
      {/if}
      {if $u.group_id != $user->group_id || $u.rank < $user->rank || ($u.rank == $user->rank && $u.id == $user->id)}
    <td><a href="user_edit.php?id={$u.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
         {if $u.id != $user->id}<td><a href="user_delete.php?id={$u.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>{else}<td></td>{/if}
      {else}
    <td></td>
    <td></td>
      {/if}
  </tr>
    {/foreach}
  {/if}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('user_add.php');" value="{$i18n.button.add}"></form></div>
  {if $inactive_users}
<div class="section-header">{$i18n.label.inactive_users}</div>
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.person_name}</th>
    <th>{$i18n.label.login}</th>
    <th>{$i18n.form.users.role}</th>
    {if $show_quota}
    <th>{$i18n.label.quota}</th>
    {/if}
    <th></th>
    <th></th>
  </tr>
    {foreach $inactive_users as $u}
  <tr>
    <td class="text-cell">{$u.name|escape}</td>
    <td class="text-cell">{$u.login|escape}</td>
    <td class="text-cell">{$u.role_name|escape}</td>
      {if $show_quota}
    <td class="time-cell">{$u.quota_percent}</td>
      {/if}
      {if $u.group_id != $user->group_id || $u.rank < $user->rank}
    <td><a href="user_edit.php?id={$u.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="user_delete.php?id={$u.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
      {else}
    <td></td>
    <td></td>
      {/if}
  </tr>
    {/foreach}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('user_add.php');" value="{$i18n.button.add}"></form></div>
  {/if}
{else}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.person_name}</th>
    <th>{$i18n.label.login}</th>
    <th>{$i18n.form.users.role}</th>
  </tr>
  {foreach $active_users as $u}
  <tr>
    <td class="text-cell">
    {if $uncompleted_indicators}
      <span class="uncompleted-entry{if $u.has_uncompleted_entry} active{/if}"{if $u.has_uncompleted_entry} title="{$i18n.form.users.uncompleted_entry}"{/if}></span>
    {/if}
      {$u.name|escape}
    </td>
    <td class="text-cell">{$u.login|escape}</td>
    <td class="text-cell">{$u.role_name|escape}</td>
  </tr>
  {/foreach}
</table>
{/if}
