<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset={constant('CHARSET')}">
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  <link href="../{constant('DEFAULT_CSS')}" rel="stylesheet" type="text/css">
{if $i18n.language.rtl}
  <link href="../{constant('RTL_CSS')}" rel="stylesheet" type="text/css">
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
          <td bgcolor="#a6ccf7" background="../img/top_bg.gif" align="center">
{/if}
            <table cellspacing="0" cellpadding="0" width="{$tab_width}" border="0">
              <tr>
                <td valign="top">
                  <table id="page_logo" cellspacing="0" cellpadding="0" width="100%" border="0">
                    <tr><td height="6" colspan="2"><img width="1" height="6" src="../img/1x1.gif" border="0"></td></tr>
                    <tr valign="top">
{if $user->custom_logo}
                      <td height="55" align="center"><img alt="Time Tracker" width="300" height="43" src="../{$custom_logo}" border="0"></td>
{else}
                      <td height="55" align="center"><a href="https://www.anuko.com/lp/tt_1.htm" target="_blank"><img alt="Anuko Time Tracker" width="300" height="43" src="../img/logo.png" border="0"></a></td>
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
      <table id="top_menu_admin" cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td class="systemMenu" height="17" align="center">&nbsp;
            <a class="systemMenu" href="../logout.php">{$i18n.menu.logout}</a>
            <a class="systemMenu" href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a>
            <a class="systemMenu" href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a>
          </td>
        </tr>
      </table>
      <!-- end of top menu for admin -->

      <!-- sub menu for admin -->
      <table id="sub_menu_admin" cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td align="center" bgcolor="#d9d9d9" nowrap height="17" background="img/subm_bg.gif">&nbsp;
            <a class="mainMenu" href="../admin_groups.php">{$i18n.menu.groups}</a>
            <a class="mainMenu" href="../admin_options.php">{$i18n.menu.options}</a>
    {if isTrue('WORK_SERVER_ADMINISTRATION')}
            <a class="mainMenu" href="admin_work.php">{$i18n.label.work}</a>
    {/if}
          </td>
        </tr>
      </table>
      <!-- end of sub menu for admin -->
  {else}
      <!-- top menu for authorized user -->
      <table id="top_menu_authorized_user" cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td class="systemMenu" height="17" align="center">&nbsp;
            <a class="systemMenu" href="../logout.php">{$i18n.menu.logout}</a>
    {if $user->exists() && $user->can('manage_own_settings')}
            <a class="systemMenu" href="../profile_edit.php">{$i18n.menu.profile}</a>
    {/if}
    {if $user->can('manage_basic_settings')}
            <a class="systemMenu" href="../group_edit.php">{$i18n.menu.group}</a>
    {/if}
    {if $user->can('manage_features')}
            <a class="systemMenu" href="../plugins.php">{$i18n.menu.plugins}</a>
    {/if}
            <a class="systemMenu" href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a>
            <a class="systemMenu" href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a>
          </td>
        </tr>
      </table>
      <!-- end of top menu for authorized user -->

      <!-- sub menu for authorized user -->
      <table id="sub_menu_authorized_user" cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td align="center" bgcolor="#d9d9d9" nowrap height="17" background="img/subm_bg.gif">&nbsp;
    {if $user->exists() && ($user->can('track_own_time') || $user->can('track_time'))}
           <a class="mainMenu" href="../time.php">{$i18n.menu.time}</a>
      {if $user->isPluginEnabled('wv') && $user->isOptionEnabled('week_menu')}
           <a class="mainMenu" href="../week.php">{$i18n.menu.week}</a>
      {/if}
    {/if}
    {if $user->exists() && $user->isPluginEnabled('ex') && ($user->can('track_own_expenses') || $user->can('track_expenses'))}
           <a class="mainMenu" href="../expenses.php">{$i18n.menu.expenses}</a>
    {/if}
    {if $user->exists() && ($user->can('view_own_reports') || $user->can('view_reports') || $user->can('view_all_reports') || $user->can('view_client_reports'))}
           <a class="mainMenu" href="../reports.php">{$i18n.menu.reports}</a>
    {/if}
    {if $user->exists() && $user->isPluginEnabled('ts') && ($user->can('track_own_time') || $user->can('track_time'))}
           <a class="mainMenu" href="../timesheets.php">{$i18n.menu.timesheets}</a>
    {/if}
    {if $user->exists() && $user->isPluginEnabled('iv') && ($user->can('manage_invoices') || $user->can('view_client_invoices'))}
           <a class="mainMenu" href="../invoices.php">{$i18n.title.invoices}</a>
    {/if}
    {if ($user->exists() && $user->isPluginEnabled('ch') && ($user->can('view_own_charts') || $user->can('view_charts'))) &&
        (constant('MODE_PROJECTS') == $user->getTrackingMode() || constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode() ||
        $user->isPluginEnabled('cl'))}
           <a class="mainMenu" href="../charts.php">{$i18n.menu.charts}</a>
    {/if}
    {if ($user->can('view_own_projects') || $user->can('manage_projects')) && (constant('MODE_PROJECTS') == $user->getTrackingMode() || constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode())}
           <a class="mainMenu" href="../projects.php">{$i18n.menu.projects}</a>
    {/if}
    {if (constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode() && ($user->can('view_own_tasks') || $user->can('manage_tasks')))}
           <a class="mainMenu" href="../tasks.php">{$i18n.menu.tasks}</a>
    {/if}
    {if $user->can('view_users') || $user->can('manage_users')}
           <a class="mainMenu" href="../users.php">{$i18n.menu.users}</a>
    {/if}
    {if $user->isPluginEnabled('cl') && ($user->can('view_own_clients') || $user->can('manage_clients'))}
           <a class="mainMenu" href="../clients.php">{$i18n.menu.clients}</a>
    {/if}
    {if $user->isPluginEnabled('wk') && ($user->can('update_work') || $user->can('bid_on_work') || $user->can('manage_work')) && $user->exists()}
           <a class="mainMenu" href="work.php">{$i18n.title.work}</a>
    {/if}
    {if $user->can('export_data')}
           <a class="mainMenu" href="../export.php">{$i18n.menu.export}</a>
    {/if}
          </td>
        </tr>
      </table>
      <!-- end of sub menu for authorized user -->
  {/if}
{else}
      <!-- top menu for non authorized user -->
      <table id="top_menu_non_authorized_user" cellspacing="0" cellpadding="3" width="100%" border="0">
        <tr>
          <td class="systemMenu" height="17" align="center">&nbsp;
            <a class="systemMenu" href="../login.php">{$i18n.menu.login}</a>
  {if isTrue('MULTIORG_MODE') && constant('AUTH_MODULE') == 'db'}
            <a class="systemMenu" href="../register.php">{$i18n.menu.register}</a>
  {/if}
            <a class="systemMenu" href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a>
            <a class="systemMenu" href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a>
          </td>
        </tr>
      </table>
{/if}
      <br>

      <!-- page title and user details -->
{if $title}
      <table id="page_title" cellspacing="0" cellpadding="5" width="{$tab_width+20}" border="0">
        <tr><td class="sectionHeader"><div class="pageTitle">{$title}{if $timestring}: {$timestring}{/if}</div></td></tr>
        <tr><td>{$user->getUserPartForHeader()}</td></tr> {* No need to escape as it is done in the class. *}
      </table>
{/if}
      <!-- end of page title and user details -->

      <!-- output errors -->
{if $err->yes()}
      <table id="page_errors" cellspacing="4" cellpadding="7" width="{$tab_width}" border="0">
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
      <table id="page_messages" cellspacing="4" cellpadding="7" width="{$tab_width}" border="0">
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
