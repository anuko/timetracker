<p></p>
{$forms.chartForm.open}
<table border="0" width="720">
  <tr>
{if $on_behalf_control}
      <td width="50%" align="center">{$i18n.label.user}: {$forms.chartForm.onBehalfUser.control}</td>
  {if $chart_selector}
      <td width="50%" align="left">{$i18n.form.charts.chart}: {$forms.chartForm.type.control}</td>
  {/if}
{else}
  {if $chart_selector}
      <td width="100%" align="center">{$i18n.form.charts.chart}: {$forms.chartForm.type.control}</td>
  {/if}
{/if}

  </tr>
</table>
<table border="0" width="720">
  <tr>
    <td width="50%" align="center"><img src="{$img_file_name}" border="0"/></td>
    <td>
      <table border="0" cellspacing="3">
      {section name=i loop=$totals}
      {if $smarty.section.i.index <= 12}
        <tr><td style="width:7px;height:1em;background-color:{$totals[i].color_html};"></td><td>{$totals[i].name|escape}</td></tr>
      {/if}
      {/section}
      </table>
    </td>
  </tr>
</table>
<p></p>
<table>
  <tr><td align="center">{$i18n.form.charts.interval}: {$forms.chartForm.interval.control}</td></tr>
  <tr><td valign="top">{$forms.chartForm.date.control}</td></tr>
</table>
{$forms.chartForm.close}
