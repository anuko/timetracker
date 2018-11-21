<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="1" cellpadding="3" border="0" width="720">
  <tr>
    <td width="35%" class="tableHeader">{$i18n.label.thing_name}</td>
    <td width="35%" class="tableHeader">{$i18n.label.description}</td>
    <td class="tableHeader">{$i18n.label.edit}</td>
    <td class="tableHeader">{$i18n.label.delete}</td>
  </tr>
{if $groups}
  {foreach $groups as $group}
  <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
    <td>{$group.name|escape}</td>
    <td>{$group.description|escape}</td>
    <td><a href="group_edit.php?id={$group.id}">{$i18n.label.edit}</a></td>
    <td><a href="group_delete.php?id={$group.id}">{$i18n.label.delete}</a></td>
  </tr>
  {/foreach}
{/if}
</table>

<table width="100%">
  <tr>
    <td align="center">
      <br>
      <form>
        <input type="button" onclick="chLocation('group_add.php');" value="{$i18n.button.add}">
      </form>
    </td>
  </tr>
</table>
