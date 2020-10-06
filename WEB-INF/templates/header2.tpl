<!DOCTYPE html>
<html lang="{constant('LANG_DEFAULT')}">
<head>
  <meta charset="{constant('CHARSET')}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link href="{constant('DEFAULT_CSS')}" rel="stylesheet">
{if $i18n.language.rtl}
  <link href="{constant('RTL_CSS')}" rel="stylesheet">
{/if}
{if $user->getCustomCss()}
  <link href="custom_css.php" rel="stylesheet">
{/if}
  <title>Time Tracker{if $title} - {$title}{/if}</title>
  <script src="js/strftime.js"></script>
  <script>
    {* Setup locale for strftime *}
    {$js_date_locale}
  </script>
  <script src="js/strptime.js"></script>
</head>

<body {$onload}>

<div class="logo">
{if $user->custom_logo}
  <img alt="Time Tracker" width="300" height="43" src="{$custom_logo}">
{else}
  <a href="https://www.anuko.com/lp/tt_1.htm" target="_blank"><img alt="Anuko Time Tracker" width="300" height="43" src="img/logo.png"></a>
{/if}
</div>

{* top menu for small screens *}
<div class="top-menu-small-screen">
  <table class="top-menu-table">
    <tr>
      <td><a href="site_map.php">{$i18n.label.menu}</a> </td>
      <td><a href="{constant('HELP_LINK')}">{$i18n.menu.help}</a></td>
    </tr>
  </table>
</div>
{* end of top menu for small screens *}

{* top menu for large screens *}
{if $authenticated}
  {if $user->can('administer_site')}
  {* top menu for admin *}
<div class="top-menu-large-screen">
  <table class="top-menu-table">
    <tr>
      <td><a href="logout.php">{$i18n.menu.logout}</a></td>
      <td><a href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a></td>
      <td><a href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a></td>
    </tr>
  </table>
</div>
  {* end of top menu for admin *}

  {* sub menu for admin *}
<div class="top-submenu-large-screen">
  <table class="top-submenu-table">
    <tr>
      <td><a href="admin_groups.php">{$i18n.menu.groups}</a></td>
      <td><a href="admin_options.php">{$i18n.menu.options}</a></td>
    {if isTrue('WORK_SERVER_ADMINISTRATION')}
      <td><a href="work/admin_work.php">{$i18n.label.work}</a></td>
    {/if}
    </td>
  </table>
</div>
  {* end of sub menu for admin *}
  {else}
  {* top menu for authorized user *}
<div class="top-menu-large-screen">
  <table class="top-menu-table">
    <tr>
      <td><a href="logout.php">{$i18n.menu.logout}</a></td>
    {if $user->exists() && $user->can('manage_own_settings')}
      <td><a href="profile_edit.php">{$i18n.menu.profile}</a></td>
    {/if}
    {if $user->can('manage_basic_settings')}
      <td><a href="group_edit.php">{$i18n.menu.group}</a></td>
    {/if}
    {if $user->can('manage_features')}
      <td><a href="plugins.php">{$i18n.menu.plugins}</a></td>
    {/if}
      <td><a href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a></td>
      <td><a href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a></td>
    </tr>
  </table>
</div>
  {* end of top menu for authorized user *}

  {* sub menu for authorized user *}
<div class="top-submenu-large-screen">
  <table class="top-submenu-table">
    <tr>
    {if $user->exists() && ($user->can('track_own_time') || $user->can('track_time'))}
      <td><a href="time.php">{$i18n.menu.time}</a></td>
      {if $user->isPluginEnabled('wv') && $user->isOptionEnabled('week_menu')}
      <td><a href="week.php">{$i18n.menu.week}</a></td>
      {/if}
    {/if}
    {if $user->exists() && $user->isPluginEnabled('ex') && ($user->can('track_own_expenses') || $user->can('track_expenses'))}
      <td><a href="expenses.php">{$i18n.menu.expenses}</a></td>
    {/if}
    {if $user->exists() && ($user->can('view_own_reports') || $user->can('view_reports') || $user->can('view_all_reports') || $user->can('view_client_reports'))}
      <td><a href="reports.php">{$i18n.menu.reports}</a></td>
    {/if}
    {if $user->exists() && $user->isPluginEnabled('ts') && ($user->can('track_own_time') || $user->can('track_time'))}
      <td><a href="timesheets.php">{$i18n.menu.timesheets}</a></td>
    {/if}
    {if $user->exists() && $user->isPluginEnabled('iv') && ($user->can('manage_invoices') || $user->can('view_client_invoices'))}
      <td><a href="invoices.php">{$i18n.title.invoices}</a></td>
    {/if}
    {if ($user->exists() && $user->isPluginEnabled('ch') && ($user->can('view_own_charts') || $user->can('view_charts'))) &&
        (constant('MODE_PROJECTS') == $user->getTrackingMode() || constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode() ||
        $user->isPluginEnabled('cl'))}
      <td><a href="charts.php">{$i18n.menu.charts}</a></td>
    {/if}
    {if ($user->can('view_own_projects') || $user->can('manage_projects')) && (constant('MODE_PROJECTS') == $user->getTrackingMode() || constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode())}
      <td><a href="projects.php">{$i18n.menu.projects}</a></td>
    {/if}
    {if (constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode() && ($user->can('view_own_tasks') || $user->can('manage_tasks')))}
      <td><a href="tasks.php">{$i18n.menu.tasks}</a></td>
    {/if}
    {if $user->can('view_users') || $user->can('manage_users')}
      <td><a href="users.php">{$i18n.menu.users}</a></td>
    {/if}
    {if $user->isPluginEnabled('cl') && ($user->can('view_own_clients') || $user->can('manage_clients'))}
      <td><a href="clients.php">{$i18n.menu.clients}</a></td>
    {/if}
    {if $user->isPluginEnabled('wk') && ($user->can('update_work') || $user->can('bid_on_work') || $user->can('manage_work')) && $user->exists()}
      <td><a href="work/work.php">{$i18n.title.work}</a></td>
    {/if}
    {if $user->can('export_data')}
      <td><a href="export.php">{$i18n.menu.export}</a></td>
    {/if}
    </tr>
  </table>
</div>
  {* end of sub menu for authorized user *}
  {/if}
{else}
  {* top menu for non authorized user *}
<div class="top-menu-large-screen">
  <table class="top-menu-table">
    <tr>
      <td><a href="login.php">{$i18n.menu.login}</a></td>
  {if isTrue('MULTIORG_MODE') && constant('AUTH_MODULE') == 'db'}
      <td><a href="register.php">{$i18n.menu.register}</a></td>
  {/if}
      <td><a href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a></td>
      <td><a href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a></td>
    </tr>
  </table>
</div>
{/if}
{* end of top menu for large screens *}

{* page title and user details *}
{if $title}
<div class="page-title">{$title}{if $timestring}: {$timestring}{/if}</div>
  {if $authenticated}
<div class="user-details">{$user->getUserPartForHeader()}</div> {* No need to escape as it is done in the class. *}
  {/if}
{/if}
{* end of page title and user details *}

{* output errors *}
{if $err->yes()}
<div class="page-errors">
  {foreach $err->getErrors() as $error}
{$error.message}<br> {* No need to escape as they are not coming from user and may contain a link. *}
  {/foreach}
</div>
{/if}
{* end of output errors *}

{* output messages *}
{if $msg->yes()}
<div class="page-messages">
  {foreach $msg->getErrors() as $message}
{$message.message}<br> {* No need to escape. *}
  {/foreach}
</div>
{/if}
{* end of output messages *}

<div class="page-content">
