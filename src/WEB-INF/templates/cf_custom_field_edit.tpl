{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.fieldForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.fieldForm.name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="entity">{$i18n.label.entity} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="entity">{$i18n.label.entity} (*):</label></td>
    <td class="td-with-input">{$forms.fieldForm.entity.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_39.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_39.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="type">{$i18n.label.type} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="type">{$i18n.label.type} (*):</label></td>
    <td class="td-with-input">{$forms.fieldForm.type.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr>
    <td class = "large-screen-label">&nbsp;</td>
    <td><label class="checkbox-label">{$forms.fieldForm.required.control}{$i18n.label.required}</label></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
</table>
<div class="button-set">{$forms.fieldForm.btn_save.control}</div>
{$forms.fieldForm.close}
