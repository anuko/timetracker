<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table class="mobile-table">
  <tr>
    <td valign="top">
{if $user->can('manage_users')}
      <table class="mobile-table-details">
  {if $inactive_users}
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.users.active_users}</td></tr>
  {/if}
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.person_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.login}</td>
          <td width="10%" class="tableHeader">{$i18n.form.users.role}</td>
        </tr>
  {if $active_users}
    {foreach $active_users as $u}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>
            {if $user->uncompleted_indicators}
              <span class="uncompleted-entry{if $u.has_uncompleted_entry} active{/if}"{if $u.has_uncompleted_entry} title="{$i18n.form.users.uncompleted_entry}"{/if}></span>
            {/if}
            {if $u.rank < $user->rank || ($u.rank == $user->rank && $u.id == $user->id)}
              <a href="user_edit.php?id={$u.id}">{$u.name|escape}</a>
            {else}
              {$u.name|escape}
            {/if}
          </td>
          <td>{$u.login|escape}</td>
          <td>{$u.role_name|escape}</td>
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
      <table class="mobile-table-details">
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.users.inactive_users}</td></tr>
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.person_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.login}</td>
          <td width="10%" class="tableHeader">{$i18n.form.users.role}</td>
        </tr>
    {foreach $inactive_users as $u}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>
            {if $u.rank < $user->rank}
              <a href="user_edit.php?id={$u.id}">{$u.name|escape}</a>
            {else}
              {$u.name|escape}
            {/if}
          </td>
          <td>{$u.login|escape}</td>
          <td>{$u.role_name|escape}</td>
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
          <td>{$u.name|escape}</td>
          <td>{$u.login|escape}</td>
          <td>{$u.role_name|escape}</td>
        </tr>
  {/foreach}
      </table>
{/if}
    </td>
  </tr>
</table>
