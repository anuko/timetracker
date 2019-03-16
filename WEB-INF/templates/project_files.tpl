<table cellspacing="0" cellpadding="7" border="0" width="720">
  <tr>
    <td valign="top">
      <table cellspacing="1" cellpadding="3" border="0" width="100%">
        <tr>
          <td width="35%" class="tableHeader">{$i18n.label.image}</td>
          <td width="35%" class="tableHeader">{$i18n.label.description}</td>
{if $can_manage}
          <td class="tableHeader">{$i18n.label.edit}</td>
          <td class="tableHeader">{$i18n.label.delete}</td>
{/if}
        </tr>
{if $files}
  {foreach $files as $file}
        <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
          <td>{$file.name|escape}</td>
          <td>{$file.description|escape}</td>
    {if $can_manage}
          <td><a href="file_edit.php?id={$file.id}">{$i18n.label.edit}</a></td>
          <td><a href="file_delete.php?id={$file.id}">{$i18n.label.delete}</a></td>
    {/if}
        </tr>
  {/foreach}
{/if}
      </table>
    </td>
  </tr>
</table>

{if $can_manage}
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
