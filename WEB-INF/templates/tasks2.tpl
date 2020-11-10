<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{$forms.tasksForm.open}
{if $user->can('manage_tasks')}
<table class="centered-table">
  <tr>
    <td>{$forms.tasksForm.task_required.control}</td>
    <td><label for="task_required">{$i18n.label.required}</label> <a href="https://www.anuko.com/lp/tt_46.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
    <td>{$forms.tasksForm.btn_save.control}</td>
  </tr>
</table>
  {if $inactive_tasks}<div class="section-header">{$i18n.form.tasks.active_tasks}</div>{/if}
  {if $active_tasks}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.description}</th>
    <th></th>
    <th></th>
  </tr>
    {foreach $active_tasks as $task}
  <tr>
    <td class="text-cell">{$task.name|escape}</td>
    <td class="text-cell">{$task.description|escape}</td>
    <td><a href="task_edit.php?id={$task.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="task_delete.php?id={$task.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
    {/foreach}
</table>
  {/if}
<div class="button-set"><form><input type="button" onclick="chLocation('task_add.php');" value="{$i18n.button.add}"></form></div>
  {if $inactive_tasks}
<div class="section-header">{$i18n.form.tasks.inactive_tasks}</div>
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.description}</th>
    <th></th>
    <th></th>
  </tr>
    {foreach $inactive_tasks as $task}
  <tr>
    <td class="text-cell">{$task.name|escape}</td>
    <td class="text-cell">{$task.description|escape}</td>
    <td><a href="task_edit.php?id={$task.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="task_delete.php?id={$task.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
    {/foreach}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('task_add.php');" value="{$i18n.button.add}"></form></div>
  {/if}
{else}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.description}</th>
  </tr>
  {if $active_tasks}
    {foreach $active_tasks as $task}
  <tr>
    <td class="text-cell">{$task.name|escape}</td>
    <td class="text-cell">{$task.description|escape}</td>
  </tr>
    {/foreach}
  {/if}
</table>
{/if}
{$forms.tasksForm.close}
