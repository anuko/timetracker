<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>
{$forms.subgroupsForm.open}
{if $group_dropdown}
<table cellspacing="1" cellpadding="3" border="0" width="100%">
  <tr>
    <td align="center">{$i18n.label.group}: {$forms.subgroupsForm.group.control}</td>
  </tr>
  <tr><td>&nbsp;</td></tr>
</table>
{/if}
{if $subgroups}
<table cellspacing="1" cellpadding="3" border="0" width="720">
  <tr>
    <td width="40%" class="tableHeader">{$i18n.label.thing_name}</td>
    <td width="40%" class="tableHeader">{$i18n.label.description}</td>
    <td></td>
    <td></td>
  </tr>
  {foreach $subgroups as $subgroup}
  <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
    <td>{$subgroup.name|escape}</td>
    <td>{$subgroup.description|escape}</td>
    <td><a href="group_edit.php?id={$subgroup.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="group_delete.php?id={$subgroup.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
  {/foreach}
</table>
{/if}
{$forms.subgroupsForm.close}

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
