{$forms.displayOptionsForm.open}
<table cellspacing="1" cellpadding="2" border="0">
  <tr><td>&nbsp;</td></tr>
  <tr><td class="sectionHeaderNoBorder">{$i18n.title.time}</td></tr>
  <tr>
    <td><label for="time_note_on_separate_row">{$i18n.form.display_options.note_on_separate_row}:</label></td>
    <td nowrap>{$forms.displayOptionsForm.time_note_on_separate_row.control} <a href="https://www.anuko.com/lp/tt_32.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
  </tr>
    <tr>
    <td><label for="time_not_complete_days">{$i18n.form.display_options.not_complete_days}:</label></td>
    <td nowrap>{$forms.displayOptionsForm.time_not_complete_days.control} <a href="https://www.anuko.com/lp/tt_44.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
  </tr>
  <tr>
    <td><label for="record_custom_fields">{$i18n.label.custom_fields}:</label></td>
    <td nowrap>{$forms.displayOptionsForm.record_custom_fields.control} <a href="https://www.anuko.com/lp/tt_48.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
  </tr>

  <tr><td>&nbsp;</td></tr>
  <tr><td class="sectionHeaderNoBorder">{$i18n.title.reports}</td></tr>
  <tr>
    <td><label for="report_note_on_separate_row">{$i18n.form.display_options.note_on_separate_row}:</label></td>
    <td nowrap>{$forms.displayOptionsForm.report_note_on_separate_row.control} <a href="https://www.anuko.com/lp/tt_32.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
  </tr>

  <tr><td>&nbsp;</td></tr>
  <tr><td class="sectionHeaderNoBorder">{$i18n.form.display_options.custom_css}</td></tr>
  <tr>
    <td colspan="2">{$forms.displayOptionsForm.custom_css.control}</td>
  </tr>

  <tr><td>&nbsp;</td></tr>
  <tr>
    <td colspan="2" height="50" align="center">{$forms.displayOptionsForm.btn_save.control}</td>
  </tr>
</table>
{$forms.displayOptionsForm.close}
