{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

{$forms.notificationsForm.open}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.schedule}</th>
    <th>{$i18n.label.email}</th>
    <th>{$i18n.label.condition}</th>
    <th></th>
    <th></th>
  </tr>
{if $notifications}
  {foreach $notifications as $notification}
  <tr>
    <td class="text-cell">{$notification['name']|escape}</td>
    <td class="text-cell">{$notification['cron_spec']|escape}</td>
    <td class="text-cell">{$notification['email']|escape}</td>
    <td class="text-cell">{$notification['report_condition']|escape}</td>
    <td><a href="notification_edit.php?id={$notification['id']}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="notification_delete.php?id={$notification['id']}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
  {/foreach}
{/if}
</table>
<div class="button-set">{$forms.notificationsForm.btn_add.control}</div>
{$forms.notificationsForm.close}
