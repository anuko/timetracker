{$forms.projectForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="project_name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="project_name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.projectForm.project_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="description">{$i18n.label.description}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="description">{$i18n.label.description}:</label></td>
    <td class="td-with-input">{$forms.projectForm.description.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
{if $show_files}
  <tr class = "small-screen-label"><td><label for="newfile">{$i18n.label.file}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="newfile">{$i18n.label.file}:</label></td>
    <td class="td-with-input">{$forms.projectForm.newfile.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
{/if}
{if $show_users}
  <tr class = "small-screen-label"><td>{$i18n.label.users}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.users}:</td>
    <td class="td-with-input">{$forms.projectForm.users.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
{/if}
{if $show_tasks}
  <tr class = "small-screen-label"><td>{$i18n.label.tasks}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.tasks}:</td>
    <td class="td-with-input">{$forms.projectForm.tasks.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
{/if}
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
  <tr>
    <td colspan="2">{$forms.projectForm.btn_add.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
</table>
{$forms.projectForm.close}
