<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{$forms.workForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.client}:</td>
          <td>{$forms.workForm.client.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.work}:</td>
          <td>{$forms.workForm.work_name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.description}:</td>
          <td>{$forms.workForm.description.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.details}:</td>
          <td>{$forms.workForm.details.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.budget}:</td>
          <td>{$forms.workForm.budget.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.workForm.close}

<table width="720" cellspacing="4" cellpadding="4" border="0">
<tr>
  <td align="center">
  <table>
  <tr>
    <td><input type="button" onclick="chLocation('work_message.php?work_id={$work_id}');" value="{$i18n.work.button.send_message}"></td>
    <td><input type="button" onclick="chLocation('offer_add.php?work_id={$work_id}');" value="{$i18n.work.button.make_offer}"></td>
  </tr>
  </table>
  </td>
</tr>
</table>
