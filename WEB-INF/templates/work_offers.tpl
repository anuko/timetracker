<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td>
      <table border=0 width=100%>
        <tr><td align="left"><b>{$i18n.label.work}:</b> {$work_item.subject}</td></tr>
        <tr><td align="left"><b>{$i18n.label.description}:</b> {$work_item.descr_short|escape}</td></tr>
        <tr><td align="left"><b>{$i18n.label.budget}:</b> {$work_item.amount_with_currency}</td></tr>
      </table>
    </td>
  </tr>

  <tr>
    <td valign="top">

{if $work_item_offers}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td class="tableHeader">{$i18n.label.contractor}</td>
          <td class="tableHeader">{$i18n.label.description}</td>
          <td class="tableHeader">{$i18n.label.status}</td>
          <td class="tableHeader">{$i18n.label.budget}</td>
        </tr>
  {foreach $work_item_offers as $offer}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td><a href='work_offer_view.php?id={$offer.id}'>{$offer.group_name|escape}</a></td>
          <td>{$offer.description|escape}</td>
          <td>{$offer.status_label}</td>
          <td nowrap>{$offer.amount_with_currency}</td>
        </tr>
  {/foreach}
      </table>
{/if}

    </td>
  </tr>
</table>
