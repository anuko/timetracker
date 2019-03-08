{$forms.templatesForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td class="tableHeader">{$i18n.label.thing_name}</td>
          <td class="tableHeader">{$i18n.label.description}</td>
          <td class="tableHeader">{$i18n.label.edit}</td>
          <td class="tableHeader">{$i18n.label.delete}</td>
        </tr>
  {if $templates}
    {foreach $templates as $template}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$template['name']|escape}</td>
          <td>{$template['description']|escape}</td>
          <td><a href="template_edit.php?id={$template['id']}">{$i18n.label.edit}</a></td>
          <td><a href="template_delete.php?id={$template['id']}">{$i18n.label.delete}</a></td>
        </tr>
    {/foreach}
  {/if}
      </table>

      <table width="100%">
        <tr><td align="center"><br>{$forms.templatesForm.btn_add.control}</td></tr>
      </table>
    </td>
  </tr>
</table>
{$forms.templatesForm.close}
