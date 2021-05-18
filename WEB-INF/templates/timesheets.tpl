{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{$forms.timesheetsForm.open}
<table class="centered-table">
{if $user_dropdown}
  <tr class = "small-screen-label"><td><label for="user">{$i18n.label.user}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="user">{$i18n.label.user}:</label></td>
    <td class="td-with-input">{$forms.timesheetsForm.user.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
</table>
{$forms.timesheetsForm.close}
<div class="form-control-separator"></div>
{if $inactive_timesheets}
<div class="section-header">{$i18n.form.timesheets.active_timesheets}</div>
{/if}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
  {if $show_client}
    <th>{$i18n.label.client}</th>
  {/if}
    <th>{$i18n.label.submitted}</th>
    <th>{$i18n.label.approved}</th>
  {if $show_files}
    <th></th>
  {/if}
    <th></th>
    <th></th>
  </tr>
  {foreach $active_timesheets as $timesheet}
  <tr>
    <td class="text-cell"><a href="timesheet_view.php?id={$timesheet.id}">{$timesheet.name|escape}</a></td>
    {if $show_client}
    <td class="text-cell">{$timesheet.client_name|escape}</td>
    {/if}
    <td class="yes-no-cell">{if $timesheet.submit_status}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
    {if $timesheet.approve_status == null}
    <td></td>
    {else}
    <td>{if $timesheet.approve_status}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
    {/if}
    {if $show_files}
      {if $timesheet.has_files}
    <td><a href="timesheet_files.php?id={$timesheet.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a></td>
      {else}
    <td><a href="timesheet_files.php?id={$timesheet.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-file.png"></a></td>
      {/if}
    {/if}
    <td><a href="timesheet_edit.php?id={$timesheet.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="timesheet_delete.php?id={$timesheet.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
  {/foreach}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('timesheet_add.php');" value="{$i18n.button.add}"></form></div>
{if $inactive_timesheets}
<div class="section-header">{$i18n.form.timesheets.inactive_timesheets}</div>
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
  {if $show_client}
    <th>{$i18n.label.client}</th>
  {/if}
    <th>{$i18n.label.submitted}</th>
    <th>{$i18n.label.approved}</th>
  {if $show_files}
    <th></th>
  {/if}
    <th></th>
    <th></th>
  </tr>
  {foreach $inactive_timesheets as $timesheet}
  <tr>
    <td class="text-cell"><a href="timesheet_view.php?id={$timesheet.id}">{$timesheet.name|escape}</a></td>
    {if $show_client}
    <td class="text-cell">{$timesheet.client_name|escape}</td>
    {/if}
    <td class="yes-no-cell">{if $timesheet.submit_status}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
    {if $timesheet.approve_status == null}
    <td></td>
    {else}
    <td>{if $timesheet.approve_status}{$i18n.label.yes}{else}{$i18n.label.no}{/if}</td>
    {/if}
    {if $show_files}
      {if $timesheet.has_files}
    <td><a href="timesheet_files.php?id={$timesheet.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a></td>
      {else}
    <td><a href="timesheet_files.php?id={$timesheet.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-file.png"></a></td>
      {/if}
    {/if}
    <td><a href="timesheet_edit.php?id={$timesheet.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="timesheet_delete.php?id={$timesheet.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
  {/foreach}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('timesheet_add.php');" value="{$i18n.button.add}"></form></div>
{/if}
