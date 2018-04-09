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
{if $groups}
  {foreach $groups as $group}
  <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
    <td>{$group.id}</td>
    <td>{$group.name|escape}</td>
    <td nowrap>{$group.date}</td>
    <td align="center">{$group.lang}</td>
    <td><a href="admin_group_edit.php?id={$group.id}">{$i18n.label.edit}</a></td>
    <td><a href="admin_group_delete.php?id={$group.id}">{$i18n.label.delete}</a></td>
  </tr>
  {/foreach}
{/if}
</table>

<table width="100%">
  <tr>
    <td align="center">
      <br>
      <form>
        <input type="button" onclick="chLocation('admin_group_add.php');" value="{$i18n.button.create_group}">&nbsp;{$i18n.label.or}&nbsp;
        <input type="button" onclick="chLocation('import.php');" value="{$i18n.button.import}">
      </form>
    </td>
  </tr>
</table>
