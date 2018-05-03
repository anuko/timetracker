<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table class="mobile-table">
  <tr>
    <td valign="top">
{if $user->can('manage_tasks')}
      <table class="mobile-table-details">
  {if $inactive_tasks}
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.tasks.active_tasks}</td></tr>
  {/if}
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.thing_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
        </tr>
  {if $active_tasks}
    {foreach $active_tasks as $task}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td><a href="task_edit.php?id={$task.id}">{$task.name|escape}</a></td>
          <td>{$task.description|escape}</td>
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
          <td width="35%" class="tableHeader">{$i18n.label.thing_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
        </tr>
    {foreach $inactive_tasks as $task}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td><a href="task_edit.php?id={$task.id}">{$task.name|escape}</a></td>
          <td>{$task.description|escape}</td>
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
