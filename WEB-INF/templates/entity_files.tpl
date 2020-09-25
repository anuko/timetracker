<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td width="40%" class="tableHeader">{$i18n.label.thing_name}</td>
          <td width="40%" class="tableHeader">{$i18n.label.description}</td>
{if $can_edit}
          <td></td>
          <td></td>
{/if}
        </tr>
{if $files}
  {foreach $files as $file}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td><a href="file_download.php?id={$file.id}">{$file.name|escape}</a></td>
          <td>{$file.description|escape}</td>
    {if $can_edit}
          <td><a href="file_edit.php?id={$file.id}"><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a></td>
          <td><a href="file_delete.php?id={$file.id}"><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a></td>
    {/if}
        </tr>
  {/foreach}
{/if}
      </table>
    </td>
  </tr>
</table>

{if $can_edit}
{$forms.fileUploadForm.open}
<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td align="center">
      <table border="0" width="60%">
        <tr>
            <td align="right">{$i18n.label.description}:</td>
            <td>{$forms.fileUploadForm.description.control}</td>
            <td align="left">{$forms.fileUploadForm.newfile.control}</td>
        </tr>
        <tr><td height="50" align="center" colspan="3">{$forms.fileUploadForm.btn_submit.control}</td></tr>
      </table>
    </td>
  </tr>
</table>
{$forms.fileUploadForm.close}
{/if}
