{$forms.mailForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
    <table cellspacing="4" cellpadding="7" border="0">
    <tr>
      <td valign="top" colspan="2">
        <table>
        <tr>
          <td align="right">{$i18n.form.mail.from} (*):</td>
          <td>{$sender}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.form.mail.to} (*):</td>
          <td>{$forms.mailForm.receiver.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.cc}:</td>
          <td>{$forms.mailForm.cc.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.subject} (*):</td>
          <td>{$forms.mailForm.subject.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.comment}:</td>
          <td>{$forms.mailForm.comment.control}</td>
        </tr>
        <tr>
          <td></td>
          <td>{$i18n.label.required_fields}</td>
        </tr>
        <tr>
          <td colspan="2" align="center" height="70">{$forms.mailForm.btn_send.control}</td>
        </tr>
        </table>
      </td>
    </tr>
    </table>
  </td>
</tr>
</table>
{$forms.mailForm.close}
