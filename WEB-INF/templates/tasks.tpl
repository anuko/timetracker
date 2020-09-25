<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{$forms.tasksForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
{if $user->can('manage_tasks')}
      <table width="100%">
        <tr>
          <td align="right" width="25%">{$forms.tasksForm.task_required.control}</td>
          <td><label for="task_required">{$i18n.label.required}</label> <a href="https://www.anuko.com/lp/tt_46.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
        </tr>
        <tr>
          <td colspan="2" height="50" align="center">{$forms.tasksForm.btn_save.control}</td>
        </tr>
      </table>
      <div class="table-divider"></div>
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
  {if $inactive_tasks}
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.tasks.active_tasks}</td></tr>
  {/if}
        <tr>
          <td width="40%" class="tableHeader">{$i18n.label.thing_name}</td>
          <td width="40%" class="tableHeader">{$i18n.label.description}</td>
          <td></td>
          <td></td>
        </tr>
  {if $active_tasks}
    {foreach $active_tasks as $task}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$task.name|escape}</td>
          <td>{$task.description|escape}</td>
          <td><a href="task_edit.php?id={$task.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
          <td><a href="task_delete.php?id={$task.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
        </tr>
    {/foreach}
  {/if}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('task_add.php');" value="{$i18n.button.add}"></form>
          </td>
        </tr>
      </table>

  {if $inactive_tasks}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.tasks.inactive_tasks}</td></tr>
        <tr>
          <td width="40%" class="tableHeader">{$i18n.label.thing_name}</td>
          <td width="40%" class="tableHeader">{$i18n.label.description}</td>
          <td></td>
          <td></td>
        </tr>
    {foreach $inactive_tasks as $task}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$task.name|escape}</td>
          <td>{$task.description|escape}</td>
          <td><a href="task_edit.php?id={$task.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
          <td><a href="task_delete.php?id={$task.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
        </tr>
    {/foreach}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('task_add.php');" value="{$i18n.button.add}"></form>
          </td>
        </tr>
      </table>
  {/if}
{else}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td class="tableHeader">{$i18n.label.thing_name}</td>
          <td class="tableHeader">{$i18n.label.description}</td>
        </tr>
  {if $active_tasks}
    {foreach $active_tasks as $task}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$task.name|escape}</td>
          <td>{$task.description|escape}</td>
        </tr>
    {/foreach}
  {/if}
      </table>
{/if}
    </td>
  </tr>
</table>
{$forms.tasksForm.close}
