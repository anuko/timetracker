<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table class="mobile-table">
  <tr>
    <td valign="top">
{if $user->canManageTeam()}
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
        <tr bgcolor="{cycle values="#f5f5f5,#dedee5"}">
          <td>
            {if $smarty.const.UNCOMPLETED_INDICATORS == $user->uncompleted_indicators}
              <span class="uncompleted-entry{if $u.has_uncompleted_entry} active{/if}"{if $u.has_uncompleted_entry} title="{$i18n.form.users.uncompleted_entry}"{/if}></span>
            {/if}
            {if $user->isManager()}
              <a href="user_edit.php?id={$u.id}">{$u.name|escape:'html'}</a>
            {else}
              {if ($user->id == $u.id) || ($smarty.const.ROLE_CLIENT == $u.role) || ($smarty.const.ROLE_USER == $u.role)}
                <a href="user_edit.php?id={$u.id}">{$u.name|escape:'html'}</a>
              {else}
                {$u.name|escape:'html'}
              {/if}
            {/if}
          </td>
          <td>{$u.login|escape:'html'}</td>
      {if $smarty.const.ROLE_MANAGER == $u.role}
            <td>{$i18n.form.users.manager}</td>
      {elseif $smarty.const.ROLE_COMANAGER == $u.role}
            <td>{$i18n.form.users.comanager}</td>
      {elseif $smarty.const.ROLE_CLIENT == $u.role}
            <td>{$i18n.label.client}</td>
      {elseif $smarty.const.ROLE_USER == $u.role}
            <td>{$i18n.label.user}</td>
      {/if}
        </tr>
    {/foreach}
  {/if}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('user_add.php');" value="{$i18n.button.add_user}"></form>
          </td>
        </tr>
      </table>

  {if $inactive_users}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.users.inactive_users}</td></tr>
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.person_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.login}</td>
          <td width="10%" class="tableHeader">{$i18n.form.users.role}</td>
          <td width="10%" class="tableHeader">{$i18n.label.edit}</td>
        </tr>
    {foreach $inactive_users as $u}
        <tr bgcolor="{cycle values="#f5f5f5,#dedee5"}">
          <td>
            {if $user->isManager()}
              <a href="user_edit.php?id={$u.id}">{$u.name|escape:'html'}</a>
            {else}
              {if ($user->id == $u.id) || ($smarty.const.ROLE_CLIENT == $u.role) || ($smarty.const.ROLE_USER == $u.role)}<a href="user_edit.php?id={$u.id}">{$u.name|escape:'html'}</a>{/if}
            {/if}
          </td>
          <td>{$u.login|escape:'html'}</td>
      {if $smarty.const.ROLE_MANAGER == $u.role}
            <td>{$i18n.form.users.manager}</td>
      {elseif $smarty.const.ROLE_COMANAGER == $u.role}
            <td>{$i18n.form.users.comanager}</td>
      {elseif $smarty.const.ROLE_CLIENT == $u.role}
            <td>{$i18n.label.client}</td>
      {elseif $smarty.const.ROLE_USER == $u.role}
            <td>{$i18n.label.user}</td>
      {/if}
      {if $user->isManager()}
          <!-- Manager can edit everybody. -->
          <td><a href="user_edit.php?id={$u.id}">{$i18n.label.edit}</a></td>
      {else}
          <!--  Comanager can edit self and clients or users but not manager and other comanagers. -->
          <td>{if ($user->id == $u.id) || ($smarty.const.ROLE_CLIENT == $u.role) || ($smarty.const.ROLE_USER == $u.role)}<a href="user_edit.php?id={$u.id}">{$i18n.label.edit}</a>{/if}</td>
      {/if}
        </tr>
    {/foreach}

      </table>

      <table width="100%">
        <tr>
          <td align="center" height="50">
            <form><input type="button" onclick="chLocation('user_add.php');" value="{$i18n.button.add_user}"></form>
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
        <tr bgcolor="{cycle values="#f5f5f5,#dedee5"}">
          <td>{$u.name|escape:'html'}</td>
          <td>{$u.login|escape:'html'}</td>
    {if $smarty.const.ROLE_MANAGER == $u.role}
            <td>{$i18n.form.users.manager}</td>
    {elseif $smarty.const.ROLE_COMANAGER == $u.role}
            <td>{$i18n.form.users.comanager}</td>
    {elseif $smarty.const.ROLE_CLIENT == $u.role}
            <td>{$i18n.label.client}</td>
    {elseif $smarty.const.ROLE_USER == $u.role}
            <td>{$i18n.label.user}</td>
    {/if}
        </tr>
  {/foreach}
      </table>
{/if}
    </td>
  </tr>
</table>
