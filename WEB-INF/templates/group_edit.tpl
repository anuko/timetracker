{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
function chLocation(newLocation) { document.location = newLocation; }
</script>


{$forms.groupForm.open}
{include file="datetime_format_preview.tpl"}
<table class="centered-table">
{if $user->can('manage_subgroups')}
  {if isset($group_dropdown) && $group_dropdown}
  <tr class = "small-screen-label"><td><label for="group">{$i18n.label.group}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="group">{$i18n.label.group}:</label></td>
    <td class="td-with-input">{$forms.groupForm.group.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  {/if}
  <tr class = "small-screen-label"><td>{$i18n.label.subgroups}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.subgroups}:</td>
    <td class="td-with-input"><a href="groups.php">{$i18n.label.configure}</a></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="currency">{$i18n.label.currency}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="currency">{$i18n.label.currency}:</label></td>
    <td class="td-with-input">{$forms.groupForm.currency.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $user->can('manage_roles')}
  <tr class = "small-screen-label"><td>{$i18n.label.roles}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.roles}:</td>
    <td class="td-with-input"><a href="roles.php">{$i18n.label.configure}</a></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="lang">{$i18n.label.language}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="lang">{$i18n.label.language}:</label></td>
    <td class="td-with-input">{$forms.groupForm.lang.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="decimal_mark">{$i18n.label.decimal_mark}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="decimal_mark">{$i18n.label.decimal_mark}:</label></td>
    <td class="td-with-input">{$forms.groupForm.decimal_mark.control} <span class="format-example" id="decimal_preview">&nbsp;</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="date_format">{$i18n.label.date_format}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="date_format">{$i18n.label.date_format}:</label></td>
    <td class="td-with-input">{$forms.groupForm.date_format.control} <span class="format-example" id="date_format_preview">&nbsp;</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="time_format">{$i18n.label.time_format}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="time_format">{$i18n.label.time_format}:</label></td>
    <td class="td-with-input">{$forms.groupForm.time_format.control} <span class="format-example" id="time_format_preview">&nbsp;</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="start_week">{$i18n.label.week_start}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="start_week">{$i18n.label.week_start}:</label></td>
    <td class="td-with-input">{$forms.groupForm.start_week.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td>{$i18n.form.group_edit.display_options}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.form.group_edit.display_options}:</td>
    <td class="td-with-input"><a href="display_options.php">{$i18n.label.configure}</a></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="holidays">{$i18n.form.group_edit.holidays}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="holidays">{$i18n.form.group_edit.holidays}:</label></td>
    <td class="td-with-input">{$forms.groupForm.holidays.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_36.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_36.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="tracking_mode">{$i18n.form.group_edit.tracking_mode}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="tracking_mode">{$i18n.form.group_edit.tracking_mode}:</label></td>
    <td class="td-with-input">{$forms.groupForm.tracking_mode.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_47.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_47.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="record_type">{$i18n.form.group_edit.record_type}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="record_type">{$i18n.form.group_edit.record_type}:</label></td>
    <td class="td-with-input">{$forms.groupForm.record_type.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_38.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_38.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="punch_mode">{$i18n.form.group_edit.punch_mode}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="punch_mode">{$i18n.form.group_edit.punch_mode}:</label></td>
    <td class="td-with-input">{$forms.groupForm.punch_mode.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_18.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_18.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="allow_overlap">{$i18n.form.group_edit.allow_overlap}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="allow_overlap">{$i18n.form.group_edit.allow_overlap}:</label></td>
    <td class="td-with-input">{$forms.groupForm.allow_overlap.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_16.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_16.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="future_entries">{$i18n.form.group_edit.future_entries}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="future_entries">{$i18n.form.group_edit.future_entries}:</label></td>
    <td class="td-with-input">{$forms.groupForm.future_entries.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_17.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_17.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="uncompleted_indicators">{$i18n.form.group_edit.uncompleted_indicators}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="uncompleted_indicators">{$i18n.form.group_edit.uncompleted_indicators}:</label></td>
    <td class="td-with-input">{$forms.groupForm.uncompleted_indicators.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_15.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_15.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="confirm_save">{$i18n.form.group_edit.confirm_save}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="confirm_save">{$i18n.form.group_edit.confirm_save}:</label></td>
    <td class="td-with-input">{$forms.groupForm.confirm_save.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_26.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_26.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $user->can('manage_advanced_settings')}
  <tr class = "small-screen-label"><td>{$i18n.form.group_edit.advanced_settings}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.form.group_edit.advanced_settings}:</td>
    <td class="td-with-input"><a href="group_advanced_edit.php">{$i18n.label.configure}</a></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
</table>
<div class="button-set">{$forms.groupForm.btn_save.control} {$forms.groupForm.btn_delete.control}</div>
{$forms.groupForm.close}

<script>
{* initialize preview text *}
MakeFormatPreview("date_format_preview", document.getElementById("date_format"));
MakeFormatPreview("time_format_preview", document.getElementById("time_format"));

function adjustDecimalPreview()
{
  var mark = document.getElementById("decimal_mark").value;
  var example = document.getElementById("decimal_preview");
  example.innerHTML = "<i>3"+mark+"14</i>";
}
adjustDecimalPreview();
</script>
