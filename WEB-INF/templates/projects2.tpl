<script>
  function chLocation(newLocation) { document.location = newLocation; }
</script>

{if $user->can('manage_projects')}
  {if $inactive_projects}
<div class="section-header">{$i18n.form.projects.active_projects}</div>
  {/if}
  {if $active_projects}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.description}</th>
    {if $show_files}
    <th></th>
    {/if}
    <th></th>
    <th></th>
  </tr>
    {foreach $active_projects as $project}
  <tr>
    <td class="text-cell">{$project.name|escape}</td>
    <td class="text-cell">{$project.description|escape}</td>
      {if $show_files}
        {if $project.has_files}
    <td><a href="project_files.php?id={$project.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a></td>
        {else}
    <td><a href="project_files.php?id={$project.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-file.png"></a></td>
        {/if}
      {/if}
    <td><a href="project_edit.php?id={$project.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="project_delete.php?id={$project.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
    {/foreach}
</table>
  {/if}
<div class="button-set"><form><input type="button" onclick="chLocation('project_add.php');" value="{$i18n.button.add}"></form></div>
  {if $inactive_projects}
<div class="section-header">{$i18n.form.projects.inactive_projects}</div>
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.description}</th>
    {if $show_files}
    <th></th>
    {/if}
    <th></th>
    <th></th>
  </tr>
    {foreach $inactive_projects as $project}
  <tr>
    <td class="text-cell">{$project.name|escape}</td>
    <td class="text-cell">{$project.description|escape}</td>
      {if $show_files}
        {if $project.has_files}
    <td><a href="project_files.php?id={$project.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a></td>
        {else}
    <td><a href="project_files.php?id={$project.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-file.png"></a></td>
        {/if}
      {/if}
    <td><a href="project_edit.php?id={$project.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="project_delete.php?id={$project.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
  </tr>
    {/foreach}
</table>
<div class="button-set"><form><input type="button" onclick="chLocation('project_add.php');" value="{$i18n.button.add}"></form></div>
  {/if}
{else}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.description}</th>
    {if $show_files}
    <th></th>
    {/if}
  </tr>
  {if $active_projects}
    {foreach $active_projects as $project}
  <tr>
    <td class="text-cell">{$project.name|escape}</td>
    <td class="text-cell">{$project.description|escape}</td>
      {if $show_files}
        {if $project.has_files}
    <td><a href="project_files.php?id={$project.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a></td>
        {else}
    <td>&nbsp;</td>
        {/if}
      {/if}
  </tr>
    {/foreach}
  {/if}
</table>
{/if}
