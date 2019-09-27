<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
{if $active_work}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.title.active_work}</td></tr>
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.work}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
          <td class="tableHeader">{$i18n.label.status}</td>
          <td class="tableHeader">{$i18n.label.budget}</td>
          <td></td>
          <td></td>
        </tr>
  {foreach $active_work as $work_item}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$work_item.subject|escape}</td>
          <td>{$work_item.description|escape}</td>
          <td>{$work_item.status_label}</td>
          <td nowrap>{$work_item.amount_with_currency}</td>
          <td><a href="work_edit.php?id={$work_item.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="images/icon_edit.png"></a></td>
          <td><a href="work_delete.php?id={$work_item.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="images/icon_delete.png"></a></td>
        </tr>
  {/foreach}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('work_add.php');" value="{$i18n.button.add}"></form>
          </td>
        </tr>
      </table>
{/if}

      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.title.available_work}</td></tr>
{if $available_work}
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.work}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
          <td class="tableHeader">{$i18n.label.client}</td>
          <td class="tableHeader">{$i18n.label.budget}</td>
        </tr>
  {foreach $available_work as $work_item}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$work_item.subject|escape}</td>
          <td>{$work_item.description|escape}</td>
          <td>{$work_item.group_name|escape}</td>
          <td nowrap>{$work_item.amount_with_currency}</td>
        </tr>
  {/foreach}
{/if}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('work_add.php');" value="{$i18n.button.add}"></form>
          </td>
        </tr>
      </table>

{if $active_offers}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.title.active_offers}</td></tr>
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.offer}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
          <td class="tableHeader">{$i18n.label.status}</td>
          <td class="tableHeader">{$i18n.label.budget}</td>
          <td></td>
          <td></td>
        </tr>
  {foreach $active_offers as $offer}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$offer.subject|escape}</td>
          <td>{$offer.description|escape}</td>
          <td>{$offer.status_label}</td>
          <td nowrap>{$offer.amount_with_currency}</td>
          <td><a href="offer_edit.php?id={$offer.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="images/icon_edit.png"></a></td>
          <td><a href="offer_delete.php?id={$offer.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="images/icon_delete.png"></a></td>
        </tr>
  {/foreach}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('offer_add.php');" value="{$i18n.button.add}"></form>
          </td>
        </tr>
      </table>
{/if}

      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.title.available_offers}</td></tr>
{if $available_offers}
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.offer}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
          <td class="tableHeader">{$i18n.label.contractor}</td>
          <td class="tableHeader">{$i18n.label.budget}</td>
        </tr>
  {foreach $available_offers as $offer}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$offer.subject|escape}</td>
          <td>{$offer.description|escape}</td>
          <td>{$offer.group_name|escape}</td>
          <td nowrap>{$offer.amount_with_currency}</td>
        </tr>
  {/foreach}
{/if}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('offer_add.php');" value="{$i18n.button.add}"></form>
          </td>
        </tr>
      </table>

    </td>
  </tr>
</table>
