{$forms.roleForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.thing_name} (*):</td>
          <td>{$forms.roleForm.name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.description}:</td>
          <td>{$forms.roleForm.description.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.form.roles.rank}:</td>
          <td>{$forms.roleForm.rank.control} <a href="https://www.anuko.com/lp/tt_20.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
        </tr>
        <tr>
          <td></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="50">{$forms.roleForm.btn_submit.control}</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.roleForm.close}
