<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr><td valign="top">{$i18n.form.groups.hint}</td></tr>
</table>

<table cellspacing="1" cellpadding="3" border="0" width="720">
  <tr>
    <td width="3%" class="tableHeader">{$i18n.label.id}</td>
    <td width="70%" class="tableHeader">{$i18n.label.thing_name}</td>
    <td class="tableHeader">{$i18n.label.date}</td>
    <td class="tableHeader">{$i18n.label.language}</td>
    <td class="tableHeader">{$i18n.label.edit}</td>
    <td class="tableHeader">{$i18n.label.delete}</td>
  </tr>
{if $teams}
  {foreach $teams as $team}
  <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
    <td>{$team.id}</td>
    <td>{$team.name|escape}</td>
    <td nowrap>{$team.date}</td>
    <td align="center">{$team.lang}</td>
    <td><a href="admin_team_edit.php?id={$team.id}">{$i18n.label.edit}</a></td>
    <td><a href="admin_team_delete.php?id={$team.id}">{$i18n.label.delete}</a></td>
  </tr>
  {/foreach}
{/if}
</table>

<table width="100%">
  <tr>
    <td align="center">
      <br>
      <form>
        <input type="button" onclick="chLocation('admin_team_add.php');" value="{$i18n.button.create_group}">&nbsp;{$i18n.label.or}&nbsp;
        <input type="button" onclick="chLocation('import.php');" value="{$i18n.button.import}">
      </form>
    </td>
  </tr>
</table>
      