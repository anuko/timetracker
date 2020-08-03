<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
{if $user->can('manage_users')}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
  {if $inactive_users}
        <tr><td class="sectionHeaderNoBorder">{$i18n.label.active_users}</td></tr>
  {/if}
  {if $active_users}
        <tr>
          <td width="30%" class="tableHeader">{$i18n.label.person_name}</td>
          <td width="30%" class="tableHeader">{$i18n.label.login}</td>
          <td width="20%" class="tableHeader">{$i18n.form.users.role}</td>
    {if $show_quota}
          <td class="tableHeader">{$i18n.label.quota}</td>
    {/if}
          <td></td>
          <td></td>
        </tr>
    {foreach $active_users as $u}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>
      {if $uncompleted_indicators}
            <span class="uncompleted-entry{if $u.has_uncompleted_entry} active{/if}"{if $u.has_uncompleted_entry} title="{$i18n.form.users.uncompleted_entry}"{/if}></span>
      {/if}
            {$u.name|escape}
          </td>
          <td>{$u.login|escape}</td>
          <td>{$u.role_name|escape}</td>
      {if $show_quota}
          <td class="cellRightAligned">{$u.quota_percent}</td>
      {/if}
      {if $u.group_id != $user->group_id || $u.rank < $user->rank || ($u.rank == $user->rank && $u.id == $user->id)}
          <td><a href="user_edit.php?id={$u.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon_edit.png"></a></td>
         {if $u.id != $user->id}<td><a href="user_delete.php?id={$u.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon_delete.png"></a></td>{else}<td></td>{/if}
      {else}
          <td></td>
          <td></td>
      {/if}
        </tr>
    {/foreach}
  {/if}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('user_add.php');" value="{$i18n.button.add}"></form>
          </td>
        </tr>
      </table>

  {if $inactive_users}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.label.inactive_users}</td></tr>
        <tr>
          <td width="30%" class="tableHeader">{$i18n.label.person_name}</td>
          <td width="30%" class="tableHeader">{$i18n.label.login}</td>
          <td width="20%" class="tableHeader">{$i18n.form.users.role}</td>
    {if $show_quota}
          <td class="tableHeader">{$i18n.label.quota}</td>
    {/if}
          <td></td>
          <td></td>
        </tr>
    {foreach $inactive_users as $u}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$u.name|escape}</td>
          <td>{$u.login|escape}</td>
          <td>{$u.role_name|escape}</td>
      {if $show_quota}
          <td class="cellRightAligned">{$u.quota_percent}</td>
      {/if}
      {if $u.group_id != $user->group_id || $u.rank < $user->rank}
          <td><a href="user_edit.php?id={$u.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon_edit.png"></a></td>
          <td><a href="user_delete.php?id={$u.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon_delete.png"></a></td>
      {else}
          <td></td>
          <td></td>
      {/if}
        </tr>
    {/foreach}

      </table>

      <table width="100%">
        <tr>
          <td align="center" height="50">
            <form><input type="button" onclick="chLocation('user_add.php');" value="{$i18n.button.add}"></form>
          </td>
        </tr>
      </table>
  {/if}
{else}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.person_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.login}</td>
          <td class="tableHeader">{$i18n.form.users.role}</td>
        </tr>
  {foreach $active_users as $u}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>
    {if $uncompleted_indicators}
            <span class="uncompleted-entry{if $u.has_uncompleted_entry} active{/if}"{if $u.has_uncompleted_entry} title="{$i18n.form.users.uncompleted_entry}"{/if}></span>
    {/if}
            {$u.name|escape}
          </td>
          <td>{$u.login|escape}</td>
          <td>{$u.role_name|escape}</td>
        </tr>
  {/foreach}
      </table>
{/if}
    </td>
  </tr>
</table>
