{$forms.groupAdvancedForm.open}

<table cellspacing="4" cellpadding="7" border="0">
    <tr>
      <td>
        <table cellspacing="1" cellpadding="2" border="0">
          <tr>
            <td align="right" nowrap>{$i18n.label.group_name} (*):</td>
            <td>{$forms.groupAdvancedForm.group_name.control}</td>
          </tr>
          <tr>
            <td align = "right">{$i18n.label.description}:</td>
            <td>{$forms.groupAdvancedForm.description.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.bcc}:</td>
            <td>{$forms.groupAdvancedForm.bcc_email.control} <a href="https://www.anuko.com/lp/tt_10.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.group_edit.allow_ip}:</td>
            <td>{$forms.groupAdvancedForm.allow_ip.control} <a href="https://www.anuko.com/lp/tt_21.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
          <tr>
            <td></td>
            <td>{$i18n.label.required_fields}</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" height="50" align="center">{$forms.groupAdvancedForm.btn_save.control}</td>
          </tr>
        </table>
      </td>
    </tr>
</table>
{$forms.groupForm.close}
