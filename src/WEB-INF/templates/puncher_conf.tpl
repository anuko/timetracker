{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.puncherConfigForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="puncher_menu">{$i18n.label.menu}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="puncher_menu">{$i18n.label.menu}:</label></td>
    <td class="td-with-input">{$forms.puncherConfigForm.puncher_menu.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_52.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_52.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.puncherConfigForm.btn_save.control}</div>
{$forms.puncherConfigForm.close}
