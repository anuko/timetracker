<script>
function chLocation(newLocation) { document.location = newLocation; }

// handleTaskRequiredCheckbox - controls visibility of the Task Required checkbox.
function handleTaskRequiredCheckbox() {
  var taskRequiredCheckbox = document.getElementById("task_required");
  var taskRequiredLabel = document.getElementById("task_required_label");
  var trackingModeDropdown = document.getElementById("tracking_mode");
  if (trackingModeDropdown.value == 2) {
    taskRequiredCheckbox.style.visibility = "visible";
    taskRequiredLabel.style.visibility = "visible";
  } else {
    taskRequiredCheckbox.style.visibility = "hidden";
    taskRequiredLabel.style.visibility = "hidden";
  }
}
</script>

{$forms.groupForm.open}

{if $user->can('manage_basic_settings')}
{include file="datetime_format_preview.tpl"}
{/if}

<table cellspacing="4" cellpadding="7" border="0">
    <tr>
      <td>
        <table cellspacing="1" cellpadding="2" border="0">
{if $user->can('manage_subgroups') && $group_dropdown}
          <tr>
            <td align="right" nowrap>{$i18n.label.group}:</td>
            <td>{$forms.groupForm.group.control}</td>
          </tr>
{/if}
{if $user->can('manage_basic_settings')}
          <tr>
            <td align="right" nowrap>{$i18n.label.group_name} (*):</td>
            <td>{$forms.groupForm.group_name.control}</td>
          </tr>
          <tr>
            <td align = "right">{$i18n.label.description}:</td>
            <td>{$forms.groupForm.description.control}</td>
          </tr>
          <tr>
            <td align="right">{$i18n.label.currency}:</td>
            <td>{$forms.groupForm.currency.control}</td>
          </tr>
  {if $user->can('manage_roles')}
          <tr>
            <td align="right" nowrap>{$i18n.label.roles}:</td>
            <td><a href="roles.php?group_id={$group_id}">{$i18n.label.configure}</a></td>
          </tr>
  {/if}
          <tr>
           <td align="right" nowrap>{$i18n.label.language}:</td>
           <td>{$forms.groupForm.lang.control}</td>
          </tr>
          <tr>
            <td align="right">{$i18n.label.decimal_mark}:</td>
            <td>{$forms.groupForm.decimal_mark.control} <font id="decimal_preview" color="#777777">&nbsp;</font></td>
          <tr>
            <td align="right" nowrap>{$i18n.label.date_format}:</td>
            <td>{$forms.groupForm.date_format.control} <font id="date_format_preview" color="#777777">&nbsp;</font></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.time_format}:</td>
            <td>{$forms.groupForm.time_format.control} <font id="time_format_preview" color="#777777">&nbsp;</font></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.week_start}:</td>
            <td>{$forms.groupForm.start_week.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.show_holidays}:</td>
            <td>{$forms.groupForm.show_holidays.control} <a href="https://www.anuko.com/lp/tt_14.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.tracking_mode}:</td>
            <td>{$forms.groupForm.tracking_mode.control} {$forms.groupForm.task_required.control} <span id="task_required_label"><label for="task_required">{$i18n.label.required}</label></span></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.record_type}:</td>
            <td>{$forms.groupForm.record_type.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.punch_mode}:</td>
            <td>{$forms.groupForm.punch_mode.control} <a href="https://www.anuko.com/lp/tt_18.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.allow_overlap}:</td>
            <td>{$forms.groupForm.allow_overlap.control} <a href="https://www.anuko.com/lp/tt_16.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.future_entries}:</td>
            <td>{$forms.groupForm.future_entries.control} <a href="https://www.anuko.com/lp/tt_17.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.uncompleted_indicators}:</td>
            <td>{$forms.groupForm.uncompleted_indicators.control} <a href="https://www.anuko.com/lp/tt_15.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.confirm_save}:</td>
            <td>{$forms.groupForm.confirm_save.control} <a href="https://www.anuko.com/lp/tt_26.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
  {if $user->can('manage_advanced_settings')}
          <tr>
            <td align="right" nowrap>{$i18n.label.bcc}:</td>
            <td>{$forms.groupForm.bcc_email.control} <a href="https://www.anuko.com/lp/tt_10.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.allow_ip}:</td>
            <td>{$forms.groupForm.allow_ip.control} <a href="https://www.anuko.com/lp/tt_21.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td></td>
            <td>{$i18n.label.required_fields}</td>
          </tr>
  {/if}
          {* initialize preview text *}
          <script>
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
{/if}

          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" height="50" align="center">{$forms.groupForm.btn_save.control} {$forms.groupForm.btn_delete.control}</td>
          </tr>
        </table>
      </td>
    </tr>
</table>
{$forms.groupForm.close}
