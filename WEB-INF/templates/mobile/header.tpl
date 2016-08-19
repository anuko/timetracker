<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$smarty.const.CHARSET}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  <link href="../{$smarty.const.DEFAULT_CSS}" rel="stylesheet" type="text/css">
{if $i18n.language.rtl}
  <link href="../{$smarty.const.RTL_CSS}" rel="stylesheet" type="text/css">
{/if}
  <title>Time Tracker{if $title} - {$title}{/if}</title>
  <script src="../js/strftime.js"></script>
  <script>
    {* Setup locale for strftime *}
    {$js_date_locale}
  </script>
  <script src="../js/strptime.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" {$onload}>

{assign var="tab_width" value="300"}

<table height="100%" cellspacing="0" cellpadding="0" width="320" border="0">
  <tr>
    <td valign="top" align="center"> <!-- This is to centrally align all our content. -->

      <!-- Top image -->
      <table cellspacing="0" cellpadding="0" width="100%" border="0">
        <tr>
{if $user->custom_logo}
          <td align="center">
{else}
          <td bgcolor="#a6ccf7" background="../images/top_bg.gif" align="center">
{/if}
            <table cellspacing="0" cellpadding="0" width="{$tab_width}" border="0">
              <tr>
                <td valign="top">
                  <table cellspacing="0" cellpadding="0" width="100%" border="0">
                    <tr><td height="6" colspan="2"><img width="1" height="6" src="../images/1x1.gif" border="0"></td></tr>
                    <tr valign="top">
{if $user->custom_logo}
                      <td height="55" align="center"><img alt="Time Tracker" width="300" height="43" src="{$mobile_custom_logo}" border="0"></td>
{else}
                      <td height="55" align="center"><img alt="Anuko Time Tracker" width="300" height="43" src="../images/tt_logo.png" border="0"></td>
{/if}
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- End of top image -->
      
{if $authenticated}
  {if $user->isAdmin()}
  
      <!-- Sub menu for admin -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td align="center" bgcolor="#d9d9d9" height="17" style="background-repeat: repeat-x;" background="../images/subm_bg.gif">&nbsp;
            <a class="mainMenu" href="admin_teams.php">{$i18n.menu.teams}</a> &middot;
            <a class="mainMenu" href="admin_options.php">{$i18n.menu.options}</a>
          </td>
        </tr>
      </table>
      <!-- End of sub menu for admin -->
  {else}

      <!-- Sub menu for authorized user -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td align="center" bgcolor="#d9d9d9" height="17" style="background-repeat: repeat-x;" background="../images/subm_bg.gif">&nbsp;
    {if !$user->isClient()}
           <a class="mainMenu" href="time.php">{$i18n.menu.time}</a>
    {/if}
    {if $user->isPluginEnabled('ex') && !$user->isClient()}
            &middot; <a class="mainMenu" href="expenses.php">{$i18n.menu.expenses}</a>
    {/if}
    {if !$user->isClient() && ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
            &middot; <a class="mainMenu" href="projects.php">{$i18n.menu.projects}</a>
    {/if}
    {if $user->canManageTeam() && ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
            &middot; <a class="mainMenu" href="tasks.php">{$i18n.menu.tasks}</a>
    {/if}
    {if !$user->isClient()}
            &middot; <a class="mainMenu" href="users.php">{$i18n.menu.users}</a>
    {/if}
    {if $user->canManageTeam() && $user->isPluginEnabled('cl')}
            &middot; <a class="mainMenu" href="clients.php">{$i18n.menu.clients}</a>
    {/if}
          </td>
        </tr>
      </table>
      <!-- End of sub menu for authorized user -->
  {/if}
{/if}
      
      <!-- Output errors -->
{if $err->yes()}
      <table cellspacing="4" cellpadding="7" width="{$tab_width}" border="0">
        <tr>
          <td class="error">
  {foreach $err->getErrors() as $error}
            {$error.message}<br> {* No need to escape as they are not coming from user and may contain a link. *}
  {/foreach}
          </td>
        </tr>
      </table>
{/if}
      <!-- End of output errors -->

      <!-- Output messages -->
{if $msg->yes()}
      <table cellspacing="4" cellpadding="7" width="{$tab_width}" border="0">
        <tr>
          <td class="info_message">
  {foreach $msg->getErrors() as $message}
            {$message.message}<br> {* No need to escape. *}
  {/foreach}
          </td>
        </tr>
      </table>
{/if}
      <!-- End of output messages -->
