<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={$smarty.const.CHARSET}">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link href="{$smarty.const.DEFAULT_CSS}" rel="stylesheet" type="text/css">
{if $i18n.language.rtl}
  <link href="{$smarty.const.RTL_CSS}" rel="stylesheet" type="text/css">
{/if}
  <title>Time Tracker{if $title} - {$title}{/if}</title>
  <script src="js/strftime.js"></script>
  <script>
    {* Setup locale for strftime *}
    {$js_date_locale}
  </script>
  <script src="js/strptime.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" {$onload}>

{assign var="tab_width" value="700"}

<!--  101% height here is a workaround for Firefox shifting content horizontally when scrollbar appears / disappears.
See https://bugzilla.mozilla.org/show_bug.cgi?id=279425.
With 101% height we essentially force the scrollbar to always appear. -->
<table height="101%" cellspacing="0" cellpadding="0" width="100%" border="0">
  <tr>
    <td valign="top" align="center"> <!-- This is to centrally align all our content. -->

      <!-- Top image -->
      <table cellspacing="0" cellpadding="0" width="100%" border="0">
        <tr>
{if $user->custom_logo}
          <td align="center">
{else}
          <td bgcolor="#a6ccf7" background="images/top_bg.gif" align="center">
{/if}
            <table cellspacing="0" cellpadding="0" width="{$tab_width}" border="0">
              <tr>
                <td valign="top">
                  <table cellspacing="0" cellpadding="0" width="100%" border="0">
                    <tr><td height="6" colspan="2"><img width="1" height="6" src="images/1x1.gif" border="0"></td></tr>
                    <tr valign="top">
{if $user->custom_logo}
                      <td height="55" align="center"><img alt="Time Tracker" width="300" height="43" src="{$custom_logo}" border="0"></a></td>
{else}
                      <td height="55" align="center"><a href="https://www.anuko.com/lp/tt_1.htm" target="_blank"><img alt="Anuko Time Tracker" width="300" height="43" src="images/tt_logo.png" border="0"></a></td>
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
      <!-- Top menu for admin -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td class="systemMenu" height="17" align="center">&nbsp;
            <a class="systemMenu" href="logout.php">{$i18n.menu.logout}</a> &middot;
            <a class="systemMenu" href="{$smarty.const.FORUM_LINK}" target="_blank">{$i18n.menu.forum}</a> &middot;
            <a class="systemMenu" href="{$smarty.const.HELP_LINK}" target="_blank">{$i18n.menu.help}</a>
          </td>
        </tr>
      </table>
      <!-- End of top menu for admin -->

      <!-- Sub menu for admin -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td align="center" bgcolor="#d9d9d9" nowrap height="17" background="images/subm_bg.gif">&nbsp;
            <a class="mainMenu" href="admin_teams.php">{$i18n.menu.teams}</a> &middot;
            <a class="mainMenu" href="admin_options.php">{$i18n.menu.options}</a>
          </td>
        </tr>
      </table>
      <!-- End of sub menu for admin -->
  {else}
      <!-- Top menu for authorized user -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td class="systemMenu" height="17" align="center">&nbsp;
            <a class="systemMenu" href="logout.php">{$i18n.menu.logout}</a> &middot;
            <a class="systemMenu" href="profile_edit.php">{$i18n.menu.profile}</a> &middot;
            <a class="systemMenu" href="{$smarty.const.FORUM_LINK}" target="_blank">{$i18n.menu.forum}</a> &middot;
            <a class="systemMenu" href="{$smarty.const.HELP_LINK}" target="_blank">{$i18n.menu.help}</a>
          </td>
        </tr>
      </table>
      <!-- End of top menu for authorized user -->

      <!-- Sub menu for authorized user -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td align="center" bgcolor="#d9d9d9" nowrap height="17" background="images/subm_bg.gif">&nbsp;
    {if !$user->isClient()}
           <a class="mainMenu" href="time.php">{$i18n.menu.time}</a>
    {/if}
    {if in_array('ex', explode(',', $user->plugins)) && !$user->isClient()}
            &middot; <a class="mainMenu" href="expenses.php">{$i18n.menu.expenses}</a>
    {/if}
            {if !$user->isClient()}&middot; {/if}<a class="mainMenu" href="reports.php">{$i18n.menu.reports}</a>
    {if ($user->canManageTeam() || $user->isClient()) && in_array('iv', explode(',', $user->plugins))}
            &middot; <a class="mainMenu" href="invoices.php">{$i18n.title.invoices}</a>
    {/if}
    {if (in_array('ch', explode(',', $user->plugins)) && !$user->isClient()) && ($smarty.const.MODE_PROJECTS == $user->tracking_mode
      || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode
      || in_array('cl', explode(',', $user->plugins)))}
            &middot; <a class="mainMenu" href="charts.php">{$i18n.menu.charts}</a>
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
    {if $user->canManageTeam() && in_array('cl', explode(',', $user->plugins))}
            &middot; <a class="mainMenu" href="clients.php">{$i18n.menu.clients}</a>
    {/if}
    {if $user->isManager()}
            &middot; <a class="mainMenu" href="export.php">{$i18n.menu.export}</a>
    {/if}
          </td>
        </tr>
      </table>
      <!-- End of sub menu for authorized user -->
  {/if}
{else}
      <!-- Top menu for non authorized user -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td class="systemMenu" height="17" align="center">&nbsp;
            <a class="systemMenu" href="login.php">{$i18n.menu.login}</a> &middot;
  {if isTrue($smarty.const.MULTITEAM_MODE) && $smarty.const.AUTH_MODULE == 'db'}
            <a class="systemMenu" href="register.php">{$i18n.menu.create_team}</a> &middot;
  {/if}
            <a class="systemMenu" href="{$smarty.const.FORUM_LINK}" target="_blank">{$i18n.menu.forum}</a> &middot;
            <a class="systemMenu" href="{$smarty.const.HELP_LINK}" target="_blank">{$i18n.menu.help}</a>
          </td>
        </tr>
      </table>
{/if}
      <br>

      <!-- Page title and user details -->
{if $title}
      <table cellspacing="0" cellpadding="5" width="{$tab_width+20}" border="0">
        <tr><td class="sectionHeader"><div class="pageTitle">{$title}{if $timestring}: {$timestring}{/if}</div></td></tr>
        <tr><td>{$user->name|escape:'html'}{if $user->isAdmin()} {$i18n.label.role_admin}{elseif $user->isManager()} {$i18n.label.role_manager}{elseif $user->canManageTeam()} {$i18n.label.role_comanager}{/if}{if $user->behalf_id > 0} <b>{$i18n.label.on_behalf} {$user->behalf_name|escape:'html'}</b>{/if}{if $user->team}, {$user->team|escape:'html'}{/if}</td></tr>
      </table>
{/if}
      <!-- End of page title and user details -->

      <!-- Output errors -->
{if !$errors->isEmpty()}
      <table cellspacing="4" cellpadding="7" width="{$tab_width}" border="0">
        <tr>
          <td class="error">
  {foreach $errors->getErrors() as $error}
            {$error.message}<br> {* No need to escape as they are not coming from user and may contain a link. *}
  {/foreach}
          </td>
        </tr>
      </table>
{/if}
      <!-- End of output errors -->

      <!-- Output messages -->
{if !$messages->isEmpty()}
      <table cellspacing="4" cellpadding="7" width="{$tab_width}" border="0">
        <tr>
          <td class="info_message">
  {foreach $messages->getErrors() as $message}
            {$message.message}<br> {* No need to escape. *}
  {/foreach}
          </td>
        </tr>
      </table>
{/if}
      <!-- End of output messages -->
