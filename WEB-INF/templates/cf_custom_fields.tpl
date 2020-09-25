{$forms.customFieldsForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
{if $user->can('manage_custom_fields')}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td class="tableHeader">{$i18n.label.thing_name}</td>
          <td class="tableHeader">{$i18n.label.entity}</td>
          <td class="tableHeader">{$i18n.label.type}</td>
          <td class="tableHeader">{$i18n.menu.options}</td>
          <td></td>
          <td></td>
        </tr>
  {if $custom_fields}
    {foreach $custom_fields as $field}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$field['label']|escape}</td>
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

      <table width="100%">
        <tr><td align="center"><br>{$forms.customFieldsForm.btn_add.control}</td></tr>
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.customFieldsForm.close}
