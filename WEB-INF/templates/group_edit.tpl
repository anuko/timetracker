<script>
function chLocation(newLocation) { document.location = newLocation; }
</script>

{$forms.groupForm.open}
{include file="datetime_format_preview.tpl"}

<table cellspacing="4" cellpadding="7" border="0">
    <tr>
      <td>
        <table cellspacing="1" cellpadding="2" border="0">
{if $user->can('manage_subgroups')}
  {if $group_dropdown}
          <tr>
            <td align="right" nowrap>{$i18n.label.group}:</td>
            <td>{$forms.groupForm.group.control}</td>
          </tr>
  {/if}
          <tr>
            <td align="right" nowrap>{$i18n.label.subgroups}:</td>
            <td><a href="groups.php">{$i18n.label.configure}</a></td>
          </tr>
{/if}
          <tr>
            <td align="right">{$i18n.label.currency}:</td>
            <td>{$forms.groupForm.currency.control}</td>
          </tr>
{if $user->can('manage_roles')}
          <tr>
            <td align="right" nowrap>{$i18n.label.roles}:</td>
            <td><a href="roles.php">{$i18n.label.configure}</a></td>
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
            <td align="right" nowrap>{$i18n.form.group_edit.display_options}:</td>
            <td><a href="display_options.php">{$i18n.label.configure}</a></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.holidays}:</td>
            <td>{$forms.groupForm.holidays.control} <a href="https://www.anuko.com/lp/tt_36.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.tracking_mode}:</td>
            <td>{$forms.groupForm.tracking_mode.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.record_type}:</td>
            <td>{$forms.groupForm.record_type.control} <a href="https://www.anuko.com/lp/tt_38.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
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
            <td align="right" nowrap>{$i18n.form.group_edit.advanced_settings}:</td>
            <td><a href="group_advanced_edit.php">{$i18n.label.configure}</a></td>
          </tr>
{/if}
          <tr>
            <td></td>
            <td>{$i18n.label.required_fields}</td>
          </tr>
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
