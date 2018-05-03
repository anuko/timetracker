<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

<table class="mobile-table">
  <tr>
    <td valign="top">
{if $user->can('manage_projects')}
      <table class="mobile-table-details">
  {if $inactive_projects}
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.projects.active_projects}</td></tr>
  {/if}
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.thing_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
        </tr>
  {if $active_projects}
    {foreach $active_projects as $project}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td><a href="project_edit.php?id={$project.id}">{$project.name|escape}</a></td>
          <td>{$project.description|escape}</td>
        </tr>
    {/foreach}
  {/if}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('project_add.php');" value="{$i18n.button.add}"></form>
          </td>
        </tr>
      </table>

  {if $inactive_projects}
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr><td class="sectionHeaderNoBorder">{$i18n.form.projects.inactive_projects}</td></tr>
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.thing_name}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
        </tr>
    {foreach $inactive_projects as $project}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td><a href="project_edit.php?id={$project.id}">{$project.name|escape}</a></td>
          <td>{$project.description|escape}</td>
        </tr>
    {/foreach}
      </table>

      <table width="100%">
        <tr>
          <td align="center"><br>
            <form><input type="button" onclick="chLocation('project_add.php');" value="{$i18n.button.add}"></form>
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
  {if $active_projects}
    {foreach $active_projects as $project}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$project.name|escape}</td>
          <td>{$project.description|escape}</td>
        </tr>
    {/foreach}
  {/if}
      </table>
{/if}
    </td>
  </tr>
</table>
