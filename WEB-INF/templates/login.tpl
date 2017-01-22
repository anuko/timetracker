<script>
<!--
function get_date() {
  var date = new Date();
  return date.strftime("%Y-%m-%d");
}
//-->
</script>
<table cellspacing="4" cellpadding="7" border="0">
  <tr>
    <td>
      {$forms.loginForm.open}
      {include file="login.`$smarty.const.AUTH_MODULE`.tpl"}
      {$forms.loginForm.close}
    </td>
  </tr>
</table>

{if !empty($about_text)}
  <div id="LoginAboutText"> {$about_text} </div>
{/if}
