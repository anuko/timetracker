{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{$forms.subgroupsForm.open}
{if isset($group_dropdown) && $group_dropdown}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="group">{$i18n.label.group}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="group">{$i18n.label.group}:</label></td>
    <td class="td-with-input">{$forms.subgroupsForm.group.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
{/if}

<div class="form-control-separator"></div>

{if $subgroups}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{{$i18n.label.description}}</th>
    <th></th>
    <th></th>
  </tr>
  {foreach $subgroups as $subgroup}
  <tr>
    <td class="text-cell">{$subgroup.name|escape}</td>
    <td class="text-cell">{$subgroup.description|escape}</td>
    <td><a href="group_edit.php?id={$subgroup.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="group_delete.php?id={$subgroup.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
  {/foreach}
</table>
{/if}
{$forms.subgroupsForm.close}
<div class="button-set">
  <form>
    <input type="button" onclick="chLocation('group_add.php');" value="{$i18n.button.add}">
  </form>
</div>
