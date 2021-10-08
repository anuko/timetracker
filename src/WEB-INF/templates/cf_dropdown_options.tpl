{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th></th>
    <th></th>
  </tr>
{if isset($options)}
  {foreach $options as $key=>$val}
  <tr>
    <td class="text-cell">{$val|escape}</td>
    <td><a href="cf_dropdown_option_edit.php?id={$key}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="cf_dropdown_option_delete.php?id={$key}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
  {/foreach}
{/if}
</table>
<div class="button-set">
  <form><input type="button" onclick="chLocation('cf_dropdown_option_add.php?field_id={$field_id}');" value="{$i18n.button.add}"></form>
</div>
