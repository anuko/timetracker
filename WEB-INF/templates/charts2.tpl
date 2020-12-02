{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
// adjustTodayLinks adjusts today links to match today in user browser on load and also on click.
function adjustTodayLinks() {
  var today_links = document.getElementsByClassName("today_link");
  var i;
  var browser_today = new Date();
  for (i = 0; i < today_links.length; i++) {
    today_links[i].href = '?date='+browser_today.strftime("%Y-%m-%d");
    today_links[i].onclick = function() {
      var today = new Date();
      var links = document.getElementsByClassName("today_link");
      var j;
      for (j = 0; j < links.length; j++) {
        links[j].href = '?date='+today.strftime("%Y-%m-%d");
      }
    }
  }
}
</script>

{$forms.chartForm.open}
<div class="small-screen-calendar">{$forms.chartForm.date.control}</div>
<table class="centered-table">
  <tr><td></td><td></td><td rowspan="{$large_screen_calendar_row_span}"><div class="large-screen-calendar">{$forms.chartForm.date.control}</div></td></tr>
{if $user_dropdown}
  <tr class = "small-screen-label"><td><label for="user">{$i18n.label.user}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="user">{$i18n.label.user}:</label></td>
    <td class="td-with-input">{$forms.chartForm.user.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="interval">{$i18n.form.charts.interval}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="interval">{$i18n.form.charts.interval}:</label></td>
    <td class="td-with-input">{$forms.chartForm.interval.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $chart_selector}
  <tr class = "small-screen-label"><td><label for="type">{$i18n.form.charts.chart}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="type">{$i18n.form.charts.chart}:</label></td>
    <td class="td-with-input">{$forms.chartForm.type.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
</table>

<div class="chart">
<table class="centered-table">
  <tr>
    <td><img class="chart-image" src="{$img_file_name}"></td>
    <td class="large-screen-chart-items-list">
      <table class="chart-items-list-table">
      {section name=i loop=$totals}
      {if $smarty.section.i.index <= 12}
        <tr><td class="chart-color-cell" style="background-color:{$totals[i].color_html};"></td><td class="chart-description-cell">{$totals[i].name|escape}</td></tr>
      {/if}
      {/section}
      </table>
    </td>
</table>
</div>

<div class="chart">
<table class="centered-table">
  <tr>
    <td class="small-screen-chart-items-list">
      <table class="chart-items-list-table">
      {section name=i loop=$totals}
      {if $smarty.section.i.index <= 12}
        <tr><td class="chart-color-cell" style="background-color:{$totals[i].color_html};"></td><td class="chart-description-cell">{$totals[i].name|escape}</td></tr>
      {/if}
      {/section}
      </table>
    </td>
</table>
</div>
{$forms.chartForm.close}
