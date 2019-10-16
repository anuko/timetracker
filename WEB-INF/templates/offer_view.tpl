<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{$forms.offerForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      <table cellspacing="1" cellpadding="2" border="0">
        <tr>
          <td align="right">{$i18n.label.contractor}:</td>
          <td>{$forms.offerForm.contractor.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.offer}:</td>
          <td>{$forms.offerForm.offer_name.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.description}:</td>
          <td>{$forms.offerForm.description.control}</td>
        </tr>
        <tr>
          <td align = "right">{$i18n.label.details}:</td>
          <td>{$forms.offerForm.details.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.budget}:</td>
          <td>{$forms.offerForm.budget.control}</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
{$forms.offerForm.close}

<table width="720" cellspacing="4" cellpadding="4" border="0">
<tr>
  <td align="center">
  <table>
  <tr>
    <td><input type="button" onclick="chLocation('work_add.php?offer_id={$offer_id}');" value="{$i18n.work.button.accept}"></td>
  </tr>
  </table>
  </td>
</tr>
</table>
