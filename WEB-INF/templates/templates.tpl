{$forms.templatesForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
{if $inactive_templates}
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.templates.active_templates}</td></tr>
{/if}
        <tr>
          <td class="tableHeader" width="45%">{$i18n.label.thing_name}</td>
          <td class="tableHeader" width="45%">{$i18n.label.description}</td>
          <td></td>
          <td></td>
        </tr>
    {foreach $active_templates as $template}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$template['name']|escape}</td>
          <td>{$template['description']|escape}</td>
          <td><a href="template_edit.php?id={$template['id']}"><img class="table_icon" alt="{$i18n.label.edit}" src="images/icon_edit.png"></a></td>
          <td><a href="template_delete.php?id={$template['id']}"><img class="table_icon" alt="{$i18n.label.delete}" src="images/icon_delete.png"></a></td>
        </tr>
    {/foreach}
      </table>
      <table width="100%">
        <tr><td align="center"><br>{$forms.templatesForm.btn_add.control}</td></tr>
      </table>
{if $inactive_templates}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.templates.inactive_templates}</td></tr>
        <tr>
          <td class="tableHeader" width="45%">{$i18n.label.thing_name}</td>
          <td class="tableHeader" width="45%">{$i18n.label.description}</td>
          <td></td>
          <td></td>
        </tr>
    {foreach $inactive_templates as $template}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$template['name']|escape}</td>
          <td>{$template['description']|escape}</td>
          <td><a href="template_edit.php?id={$template['id']}"><img class="table_icon" alt="{$i18n.label.edit}" src="images/icon_edit.png"></a></td>
          <td><a href="template_delete.php?id={$template['id']}"><img class="table_icon" alt="{$i18n.label.delete}" src="images/icon_delete.png"></a></td>
        </tr>
    {/foreach}
      </table>
      <table width="100%">
        <tr><td align="center"><br>{$forms.templatesForm.btn_add.control}</td></tr>
      </table>
{/if}
      <div class="table-divider"></div>
      <table width="100%">
{if $show_bind_with_projects_checkbox}
        <tr>
          <td align="right" width="25%">{$forms.templatesForm.bind_templates_with_projects.control}</td>
          <td><label for="bind_templates_with_projects">{$i18n.label.bind_templates_with_projects}</label> <a href="https://www.anuko.com/lp/tt_42.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
        </tr>
{/if}
        <tr>
          <td align="right" width="25%">{$forms.templatesForm.prepopulate_note.control}</td>
          <td><label for="prepopulate_note">{$i18n.label.prepopulate_note}</label> <a href="https://www.anuko.com/lp/tt_43.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
        </tr>
        <tr>
          <td colspan="2" height="50" align="center">{$forms.templatesForm.btn_save.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.templatesForm.close}
