{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.roleForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.roleForm.name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="description">{$i18n.label.description}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="description">{$i18n.label.description}:</label></td>
    <td class="td-with-input">{$forms.roleForm.description.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="rank">{$i18n.form.roles.rank}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="rank">{$i18n.form.roles.rank}:</label></td>
    <td class="td-with-input">{$forms.roleForm.rank.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_20.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_20.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="status">{$i18n.label.status}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="status">{$i18n.label.status}:</label></td>
    <td class="td-with-input">{$forms.roleForm.status.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.roleForm.btn_save.control}</div>
<table class="centered-table">
  <tr><td class="text-cell">{$i18n.form.roles.assigned}:</td></tr>
  <tr><td class="td-with-input">{$forms.roleForm.assigned_rights.control}</td></tr>
  <tr><td class="td-with-horizontally-centered-input">{$forms.roleForm.btn_delete.control}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td class="text-cell">{$i18n.form.roles.not_assigned}:</td></tr>
  <tr><td class="td-with-input">{$forms.roleForm.available_rights.control}</td></tr>
  <tr><td class="td-with-horizontally-centered-input">{$forms.roleForm.btn_add.control}</td></tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
{$forms.roleForm.close}
