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

<table height="100%" cellspacing="0" cellpadding="0" width="100%" border="0">
  <tr>
    <td valign="top" align="center"> <!-- This is to centrally align all our content. -->

      <!-- top image -->
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
      <!-- end of top image -->

{if $authenticated}
  {if $user->can('administer_site')}
      <!-- top menu for admin -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td class="systemMenu" height="17" align="center">&nbsp;
            <a class="systemMenu" href="logout.php">{$i18n.menu.logout}</a> &middot;
            <a class="systemMenu" href="{$smarty.const.FORUM_LINK}" target="_blank">{$i18n.menu.forum}</a> &middot;
            <a class="systemMenu" href="{$smarty.const.HELP_LINK}" target="_blank">{$i18n.menu.help}</a>
          </td>
        </tr>
      </table>
      <!-- end of top menu for admin -->

      <!-- sub menu for admin -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td align="center" bgcolor="#d9d9d9" nowrap height="17" background="images/subm_bg.gif">&nbsp;
            <a class="mainMenu" href="admin_groups.php">{$i18n.menu.groups}</a> &middot;
            <a class="mainMenu" href="admin_options.php">{$i18n.menu.options}</a>
          </td>
        </tr>
      </table>
      <!-- end of sub menu for admin -->
  {else}
      <!-- top menu for authorized user -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td class="systemMenu" height="17" align="center">&nbsp;
            <a class="systemMenu" href="logout.php">{$i18n.menu.logout}</a> &middot;
    {if $user->can('manage_own_settings')}
            <a class="systemMenu" href="profile_edit.php">{$i18n.menu.profile}</a> &middot;
    {/if}
    {if $user->can('manage_basic_settings')}
            <a class="systemMenu" href="group_edit.php">{$i18n.menu.group}</a> &middot;
    {/if}
            <a class="systemMenu" href="{$smarty.const.FORUM_LINK}" target="_blank">{$i18n.menu.forum}</a> &middot;
            <a class="systemMenu" href="{$smarty.const.HELP_LINK}" target="_blank">{$i18n.menu.help}</a>
          </td>
        </tr>
      </table>
      <!-- end of top menu for authorized user -->

      <!-- sub menu for authorized user -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td align="center" bgcolor="#d9d9d9" nowrap height="17" background="images/subm_bg.gif">&nbsp;
    {if $user->can('track_own_time') || $user->can('track_time')}
           <a class="mainMenu" href="time.php">{$i18n.menu.time}</a>
    {/if}
    {if $user->isPluginEnabled('ex') && ($user->can('track_own_expenses') || $user->can('track_expenses'))}
            &middot; <a class="mainMenu" href="expenses.php">{$i18n.menu.expenses}</a>
    {/if}
    {if $user->can('view_own_reports') || $user->can('view_reports')}
            &middot; <a class="mainMenu" href="reports.php">{$i18n.menu.reports}</a> 
    {/if}        
    {if $user->isPluginEnabled('iv') && ($user->can('view_own_invoices') || $user->can('manage_invoices'))}
            &middot; <a class="mainMenu" href="invoices.php">{$i18n.title.invoices}</a>
    {/if}
    {if ($user->isPluginEnabled('ch') && ($user->can('view_own_charts') || $user->can('view_charts'))) && ($smarty.const.MODE_PROJECTS == $user->tracking_mode
      || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode || $user->isPluginEnabled('cl'))}
            &middot; <a class="mainMenu" href="charts.php">{$i18n.menu.charts}</a>
    {/if}
    {if ($user->can('view_own_projects') || $user->can('manage_projects')) && ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
            &middot; <a class="mainMenu" href="projects.php">{$i18n.menu.projects}</a>
    {/if}
    {if ($smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode && ($user->can('view_own_tasks') || $user->can('manage_tasks')))}
            &middot; <a class="mainMenu" href="tasks.php">{$i18n.menu.tasks}</a>
    {/if}
    {if $user->can('view_users') || $user->can('manage_users')}
            &middot; <a class="mainMenu" href="users.php">{$i18n.menu.users}</a>
    {/if}
    {if $user->isPluginEnabled('cl') && ($user->can('view_own_clients') || $user->can('manage_clients'))}
            &middot; <a class="mainMenu" href="clients.php">{$i18n.menu.clients}</a>
    {/if}
    {if $user->can('export_data')}
            &middot; <a class="mainMenu" href="export.php">{$i18n.menu.export}</a>
    {/if}
          </td>
        </tr>
      </table>
      <!-- end of sub menu for authorized user -->
  {/if}
{else}
      <!-- top menu for non authorized user -->
      <table cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td class="systemMenu" height="17" align="center">&nbsp;
            <a class="systemMenu" href="login.php">{$i18n.menu.login}</a> &middot;
  {if isTrue($smarty.const.MULTITEAM_MODE) && $smarty.const.AUTH_MODULE == 'db'}
            <a class="systemMenu" href="register.php">{$i18n.menu.create_group}</a> &middot;
  {/if}
            <a class="systemMenu" href="{$smarty.const.FORUM_LINK}" target="_blank">{$i18n.menu.forum}</a> &middot;
            <a class="systemMenu" href="{$smarty.const.HELP_LINK}" target="_blank">{$i18n.menu.help}</a>
          </td>
        </tr>
      </table>
{/if}
      <br>

      <!-- page title and user details -->
{if $title}
      <table cellspacing="0" cellpadding="5" width="{$tab_width+20}" border="0">
        <tr><td class="sectionHeader"><div class="pageTitle">{$title}{if $timestring}: {$timestring}{/if}</div></td></tr>
  {if $user->name}
        <tr><td>{$user->name|escape} - {$user->role_name|escape}{if $user->behalf_id > 0} <b>{$i18n.label.on_behalf} {$user->behalf_name|escape}</b>{/if}{if $user->group}, {$user->group|escape}{/if}</td></tr>
  {else}
        <tr><td>&nbsp;</td></tr>
  {/if}
      </table>
{/if}
      <!-- end of page title and user details -->

      <!-- output errors -->
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
      <!-- end of output errors -->

      <!-- output messages -->
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
      <!-- end of output messages -->
