{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.customFieldsForm.open}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.entity}</th>
    <th>{$i18n.label.type}</th>
    <th>{$i18n.menu.options}</th>
    <th></th>
    <th></th>
  </tr>
  {if isset($custom_fields)}
    {foreach $custom_fields as $field}
  <tr>
    <td class="text-cell">{$field['label']|escape}</td>
      {if CustomFields::ENTITY_TIME == $field['entity_type']}
    <td>{$i18n.entity.time}</td>
      {elseif CustomFields::ENTITY_USER == $field['entity_type']}
    <td>{$i18n.entity.user}</td>
      {else}
    <td></td>
      {/if}
      {if CustomFields::TYPE_TEXT == $field['type']}
    <td>{$i18n.label.type_text}</td>
    <td></td>
      {elseif CustomFields::TYPE_DROPDOWN == $field['type']}
    <td>{$i18n.label.type_dropdown}</td>
    <td><a href="cf_dropdown_options.php?field_id={$field['id']}">{$i18n.label.configure}</a></td>
      {/if}
    <td><a href="cf_custom_field_edit.php?id={$field['id']}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="cf_custom_field_delete.php?id={$field['id']}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
    {/foreach}
  {/if}
</table>
<div class="button-set">{$forms.customFieldsForm.btn_add.control}</div>
{$forms.customFieldsForm.close}
