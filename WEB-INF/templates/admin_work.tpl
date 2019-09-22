<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
{if $pending_work}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.title.pending_work}</td></tr>
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.work}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
          <td class="tableHeader">{$i18n.label.client}</td>
          <td class="tableHeader">{$i18n.label.budget}</td>
          <td></td>
          <td></td>
        </tr>
  {foreach $pending_work as $work_item}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$work_item.subject|escape}</td>
          <td>{$work_item.description|escape}</td>
          <td>{$work_item.group_name|escape} ({$work_item.site_id}.{$work_item.group_id})</td>
          <td nowrap>{$work_item.currency} {$work_item.amount}</td>
          <td><a href="admin_work_edit.php?id={$work_item.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="images/icon_edit.png"></a></td>
          <td><a href="admin_work_delete.php?id={$work_item.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="images/icon_delete.png"></a></td>
        </tr>
  {/foreach}
      </table>
{/if}

{if $pending_offers}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.title.pending_offers}</td></tr>
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.offer}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
          <td class="tableHeader">{$i18n.label.contractor}</td>
          <td class="tableHeader">{$i18n.label.budget}</td>
          <td></td>
          <td></td>
        </tr>
  {foreach $pending_offers as $offer}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$offer.subject|escape}</td>
          <td>{$offer.description|escape}</td>
          <td>{$offer.group_name|escape} ({$offer.site_id}.{$offer.group_id})</td>
          <td nowrap>{$offer.currency} {$offer.amount}</td>
          <td><a href="admin_offer_edit.php?id={$offer.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="images/icon_edit.png"></a></td>
          <td><a href="admin_offer_delete.php?id={$offer.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="images/icon_delete.png"></a></td>
        </tr>
  {/foreach}
      </table>
{/if}

    </td>
  </tr>
</table>
