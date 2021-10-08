{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<div class="page-hint">{$i18n.form.groups.hint}</div>
{if $groups}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.id}</th>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.date}</th>
    <th>{$i18n.label.language}</th>
    <th></th>
    <th></th>
  </tr>
  {foreach $groups as $group}
  <tr>
    <td>{$group.id}</td>
    <td class="text-cell">{$group.name|escape}</td>
    <td class="date-cell">{$group.date}</td>
    <td>{$group.lang}</td>
    <td><a href="admin_group_edit.php?id={$group.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="admin_group_delete.php?id={$group.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
  {/foreach}
</table>
{/if}
<div class="button-set">
  <form>
    <input type="button" onclick="chLocation('admin_group_add.php');" value="{$i18n.button.create_group}">&nbsp;{$i18n.label.or}&nbsp;
    <input type="button" onclick="chLocation('import.php');" value="{$i18n.button.import}">
  </form>
</div>
