{include file="time_script.tpl"}

<p><span id="hour">00</span><span id="separator">:</span><span id="min">00</span>

<script>
var timerID = null;
var startDate = null;
var endDate = null;
var delta = null;
var separatorVisible = true;

function toggleSeparator() {
  document.getElementById('separator').style.visibility = separatorVisible ? 'hidden' : 'visible';
  separatorVisible = !separatorVisible;
}

function updateTimer() {
  if (startDate == null) startDate = new Date();
  endDate = new Date();
  delta = new Date(endDate - startDate);

  var hours = delta.getUTCHours();
  if (hours < 10) hours = '0'+hours;
  document.getElementById('hour').innerHTML = hours;

  var minutes = delta.getUTCMinutes();
  if (minutes <  10) minutes = '0'+minutes;
  document.getElementById('min').innerHTML = minutes;

  // Toggle visibility of separator for 100 ms.
  toggleSeparator();
  setTimeout('toggleSeparator()', 100);
}

function startTimer() {
  if (timerID) return;

  updateTimer();
  timerID = setInterval('updateTimer()', 1000);
}

function stopTimer() {
  clearInterval(timerID);
  timerID = null;
}
</script>

{if $uncompleted}
<script>
startDate = new Date();
startDate.setHours({substr($uncompleted['start'], 0, 2)});
startDate.setMinutes({substr($uncompleted['start'], 3, 2)});
startDate.setSeconds(0);
updateTimer();
startTimer();
</script>
{/if}

{$forms.timeRecordForm.open}
<table cellspacing="4" cellpadding="7" border="0">
<tr>
  <td>
  <table width="100%">
  <tr>
    <td valign="top">
    <table border="0">
{if $show_client}
    <tr><td>{$i18n.label.client}:</td></tr>
    <tr><td>{$forms.timeRecordForm.client.control}</td></tr>
{/if}
{if $show_billable}
    <tr><td><label>{$forms.timeRecordForm.billable.control}{$i18n.form.time.billable}</label></td></tr>
{/if}
{if $custom_fields && $custom_fields->timeFields}
  {foreach $custom_fields->timeFields as $timeField}
      <tr><td>{$timeField['label']|escape}{if $timeField['required']} (*){/if}:</td></tr>
      {assign var="control_name" value='time_field_'|cat:$timeField['id']}
      <tr><td>{$forms.timeRecordForm.$control_name.control}</td></tr>
    </tr>
  {/foreach}
{/if}
{if $show_project}
    <tr><td>{$i18n.label.project}:</td></tr>
    <tr><td>{$forms.timeRecordForm.project.control}</td></tr>
{/if}
{if $show_task}
    <tr><td>{$i18n.label.task}:</td></tr>
    <tr><td>{$forms.timeRecordForm.task.control}</td></tr>
{/if}
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="2" height="50" align="center">{$forms.timeRecordForm.btn_start.control} {$forms.timeRecordForm.btn_stop.control}</td>
  </tr>
  </table>
  </td>
</tr>
</table>
{$forms.timeRecordForm.close}

<table cellspacing="3" cellpadding="0" border="0" width="100%">
<tr>
  <td align="center">
    {if $time_records}
    <table border="0">
      <tr>
        <td align="right">{$i18n.label.day_total}:</td>
        <td>{$day_total}</td>
      </tr>
      <tr>
        <td align="right">{$i18n.label.week_total}:</td>
        <td>{$week_total}</td>
      </tr>
    </table>
    {/if}
  </td>
</tr>
</table>
