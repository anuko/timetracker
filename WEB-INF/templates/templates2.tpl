{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.templatesForm.open}
{if $inactive_templates}
<div class="section-header">{$i18n.form.templates.active_templates}</div>
{/if}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.description}</th>
    <th></th>
    <th></th>
  </tr>
  {foreach $active_templates as $template}
  <tr>
    <td class="text-cell">{$template['name']|escape}</td>
    <td class="text-cell">{$template['description']|escape}</td>
    <td><a href="template_edit.php?id={$template['id']}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="template_delete.php?id={$template['id']}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
   </tr>
  {/foreach}
</table>
<div class="button-set">{$forms.templatesForm.btn_add.control}</div>

{if $inactive_templates}
<div class="section-header">{$i18n.form.templates.inactive_templates}</div>
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.description}</th>
    <th></th>
    <th></th>
  </tr>
  {foreach $inactive_templates as $template}
  <tr>
    <td class="text-cell">{$template['name']|escape}</td>
    <td class="text-cell">{$template['description']|escape}</td>
    <td><a href="template_edit.php?id={$template['id']}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="template_delete.php?id={$template['id']}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
   </tr>
  {/foreach}
</table>
<div class="button-set">{$forms.templatesForm.btn_add.control}</div>
{/if}
<table class="centered-table">
{if $show_bind_with_projects_checkbox}
  <tr class = "small-screen-label"><td><label for="bind_templates_with_projects">{$i18n.label.bind_templates_with_projects}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="bind_templates_with_projects">{$i18n.label.bind_templates_with_projects}:</label></td>
    <td class="td-with-input">{$forms.templatesForm.bind_templates_with_projects.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_42.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_42.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="prepopulate_note">{$i18n.label.prepopulate_note}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="prepopulate_note">{$i18n.label.prepopulate_note}:</label></td>
    <td class="td-with-input">{$forms.templatesForm.prepopulate_note.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_43.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_43.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.templatesForm.btn_save.control}</div>
{$forms.templatesForm.close}
