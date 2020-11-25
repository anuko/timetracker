{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
function get_date() {
  var date = new Date();
  return date.strftime("%Y-%m-%d");
}
</script>

{$forms.loginForm.open}
{include file="login.`$smarty.const.AUTH_MODULE`2.tpl"}
{$forms.loginForm.close}

{if !empty($about_text)}
  <div id="LoginAboutText">{$about_text}</div>
{/if}
