{$forms.taskForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="name">{$i18n.label.thing_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="name">{$i18n.label.thing_name} (*):</label></td>
    <td class="td-with-input">{$forms.taskForm.name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="description">{$i18n.label.description}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="description">{$i18n.label.description}:</label></td>
    <td class="td-with-input">{$forms.taskForm.description.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
{if $show_projects}
  <tr class = "small-screen-label"><td>{$i18n.label.projects}:</td></tr>
  <tr>
    <td class="large-screen-label">{$i18n.label.projects}:</td>
    <td class="td-with-input">{$forms.taskForm.projects.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
{/if}
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
  <tr>
    <td colspan="2">{$forms.taskForm.btn_submit.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
</table>
{$forms.taskForm.close}
