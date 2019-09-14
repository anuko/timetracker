<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.title.active_work}</td></tr>
  {if $active_work}
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.thing_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
    {if $show_files}
          <td></td>
    {/if}
          <td></td>
          <td></td>
        </tr>
    {foreach $active_work as $work_item}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$work_item.name|escape}</td>
          <td><a href="work_edit.php?id={$work_item.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="images/icon_edit.png"></a></td>
          <td><a href="work_delete.php?id={$work_item.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="images/icon_delete.png"></a></td>
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

      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.work.offers}</td></tr>
  {if $available_offers}
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.thing_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
    {if $show_files}
          <td></td>
    {/if}
          <td></td>
          <td></td>
        </tr>
    {foreach $available_offers as $offer}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$offer.name|escape}</td>
          <td><a href="offer_edit.php?id={$offer.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="images/icon_edit.png"></a></td>
          <td><a href="offer_delete.php?id={$offer.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="images/icon_delete.png"></a></td>
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