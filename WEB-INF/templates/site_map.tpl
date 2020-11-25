{if $authenticated}
  {if $user->can('administer_site')}
  {* sub menu for admin *}
<div class="sitemap-item-group">
  <div class="sitemap-item"><a href="admin_groups.php">{$i18n.menu.groups}</a></div>
  <div class="sitemap-item"><a href="admin_options.php">{$i18n.menu.options}</a></div>
    {if isTrue('WORK_SERVER_ADMINISTRATION')}
  <div class="sitemap-item"><a href="work/admin_work.php">{$i18n.label.work}</a></div>
    {/if}
</div>
  {* end of sub menu for admin *}
  {* main menu for admin *}
<div class="sitemap-item-group">
  <div class="sitemap-item"><a href="logout.php">{$i18n.menu.logout}</a></div>
  <div class="sitemap-item"><a href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a></div>
  <div class="sitemap-item"><a href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a></div>
</div>
  {* end of main menu for admin *}
  {else}
  {* sub menu for authorized user *}
<div class="sitemap-item-group">
    {if $user->exists() && ($user->can('track_own_time') || $user->can('track_time'))}
  <div class="sitemap-item"><a href="time.php">{$i18n.menu.time}</a></div>
      {if $user->isPluginEnabled('wv') && $user->isOptionEnabled('week_menu')}
  <div class="sitemap-item"><a href="week.php">{$i18n.menu.week}</a></div>
      {/if}
    {/if}
    {if $user->exists() && $user->isPluginEnabled('ex') && ($user->can('track_own_expenses') || $user->can('track_expenses'))}
  <div class="sitemap-item"><a href="expenses.php">{$i18n.menu.expenses}</a></div>
    {/if}
    {if $user->exists() && ($user->can('view_own_reports') || $user->can('view_reports') || $user->can('view_all_reports') || $user->can('view_client_reports'))}
  <div class="sitemap-item"><a href="reports.php">{$i18n.menu.reports}</a></div>
    {/if}
    {if $user->exists() && $user->isPluginEnabled('ts') && ($user->can('track_own_time') || $user->can('track_time'))}
  <div class="sitemap-item"><a href="timesheets.php">{$i18n.menu.timesheets}</a></div>
    {/if}
    {if $user->exists() && $user->isPluginEnabled('iv') && ($user->can('manage_invoices') || $user->can('view_client_invoices'))}
  <div class="sitemap-item"><a href="invoices.php">{$i18n.title.invoices}</a></div>
    {/if}
    {if ($user->exists() && $user->isPluginEnabled('ch') && ($user->can('view_own_charts') || $user->can('view_charts'))) &&
        (constant('MODE_PROJECTS') == $user->getTrackingMode() || constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode() ||
        $user->isPluginEnabled('cl'))}
  <div class="sitemap-item"><a href="charts.php">{$i18n.menu.charts}</a></div>
    {/if}
    {if ($user->can('view_own_projects') || $user->can('manage_projects')) && (constant('MODE_PROJECTS') == $user->getTrackingMode() || constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode())}
  <div class="sitemap-item"><a href="projects.php">{$i18n.menu.projects}</a></div>
    {/if}
    {if (constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode() && ($user->can('view_own_tasks') || $user->can('manage_tasks')))}
  <div class="sitemap-item"><a href="tasks.php">{$i18n.menu.tasks}</a></div>
    {/if}
    {if $user->can('view_users') || $user->can('manage_users')}
  <div class="sitemap-item"><a href="users.php">{$i18n.menu.users}</a></div>
    {/if}
    {if $user->isPluginEnabled('cl') && ($user->can('view_own_clients') || $user->can('manage_clients'))}
  <div class="sitemap-item"><a href="clients.php">{$i18n.menu.clients}</a></div>
    {/if}
    {if $user->can('export_data')}
  <div class="sitemap-item"><a href="export.php">{$i18n.menu.export}</a></div>
    {/if}
</div>
  {* end of sub menu for authorized user *}
  {* main menu for authorized user *}
<div class="sitemap-item-group">
  <div class="sitemap-item"><a href="logout.php">{$i18n.menu.logout}</a></div>
    {if $user->exists() && $user->can('manage_own_settings')}
  <div class="sitemap-item"><a href="profile_edit.php">{$i18n.menu.profile}</a></div>
    {/if}
    {if $user->can('manage_basic_settings')}
  <div class="sitemap-item"><a href="group_edit.php">{$i18n.menu.group}</a></div>
    {/if}
    {if $user->can('manage_features')}
  <div class="sitemap-item"><a href="plugins.php">{$i18n.menu.plugins}</a></div>
    {/if}
  <div class="sitemap-item"><a href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a></div>
  <div class="sitemap-item"><a href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a></div>
</div>
  {* end of main menu for authorized user *}
  {/if}
{else}
  {* main menu for non authorized user *}
<div class="sitemap-item-group">
  <div class="sitemap-item"><a href="login.php">{$i18n.menu.login}</a></div>
  {if isTrue('MULTIORG_MODE') && constant('AUTH_MODULE') == 'db'}
  <div class="sitemap-item"><a href="register.php">{$i18n.menu.register}</a></div>
  {/if}
  <div class="sitemap-item"><a href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a></div>
  <div class="sitemap-item"><a href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a></div>
</div>
  {* end of main menu for non authorized user *}
{/if}
