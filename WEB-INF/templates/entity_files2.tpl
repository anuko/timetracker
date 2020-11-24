{if $files}
<table class="x-scrollable-table">
  <tr>
    <th>{$i18n.label.thing_name}</th>
    <th>{$i18n.label.description}</th>
    <th></th>
    <th></th>
  </tr>
  {foreach $files as $file}
  <tr>
    <td class="text-cell"><a href="file_download.php?id={$file.id}">{$file.name|escape}</a></td>
    <td class="text-cell">{$file.description|escape}</td>
    {if $can_edit}
    <td><a href="file_edit.php?id={$file.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
    <td><a href="file_delete.php?id={$file.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
    {/if}
  </tr>
  {/foreach}
</table>
{/if}

{if $can_edit}
{$forms.fileUploadForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="newfile">{$i18n.label.file}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="newfile">{$i18n.label.file}:</label></td>
    <td class="td-with-input">{$forms.fileUploadForm.newfile.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="description">{$i18n.label.description}:</label></td></tr>
  <tr>
    <td class = "large-screen-label"><label for="description">{$i18n.label.description}:</label></td>
    <td class="td-with-input">{$forms.fileUploadForm.description.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.fileUploadForm.btn_submit.control}</div>
{$forms.fileUploadForm.close}
{/if}



