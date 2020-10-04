{if $authenticated}
  {if $user->can('administer_site')}
  {* sub menu for admin *}
<p>
  <a href="admin_groups.php">{$i18n.menu.groups}</a><br>
  <a href="admin_options.php">{$i18n.menu.options}</a><br>
    {if isTrue('WORK_SERVER_ADMINISTRATION')}
  <a href="work/admin_work.php">{$i18n.label.work}</a><br>
    {/if}
</p>
  {* end of sub menu for admin *}
  {* main menu for admin *}
<p>
  <a href="logout.php">{$i18n.menu.logout}</a><br>
  <a href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a><br>
  <a href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a><br>
</p>
  {* end of main menu for admin *}
  {else}
  {* sub menu for authorized user *}
<p>
    {if $user->exists() && ($user->can('track_own_time') || $user->can('track_time'))}
        <a href="time.php">{$i18n.menu.time}</a><br>
      {if $user->isPluginEnabled('wv') && $user->isOptionEnabled('week_menu')}
  <a href="week.php">{$i18n.menu.week}</a><br>
      {/if}
    {/if}
    {if $user->exists() && $user->isPluginEnabled('ex') && ($user->can('track_own_expenses') || $user->can('track_expenses'))}
  <a href="expenses.php">{$i18n.menu.expenses}</a><br>
    {/if}
    {if $user->exists() && ($user->can('view_own_reports') || $user->can('view_reports') || $user->can('view_all_reports') || $user->can('view_client_reports'))}
  <a href="reports.php">{$i18n.menu.reports}</a><br>
    {/if}
    {if $user->exists() && $user->isPluginEnabled('ts') && ($user->can('track_own_time') || $user->can('track_time'))}
  <a href="timesheets.php">{$i18n.menu.timesheets}</a><br>
    {/if}
    {if $user->exists() && $user->isPluginEnabled('iv') && ($user->can('manage_invoices') || $user->can('view_client_invoices'))}
  <a href="invoices.php">{$i18n.title.invoices}</a><br>
    {/if}
    {if ($user->exists() && $user->isPluginEnabled('ch') && ($user->can('view_own_charts') || $user->can('view_charts'))) &&
        (constant('MODE_PROJECTS') == $user->getTrackingMode() || constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode() ||
        $user->isPluginEnabled('cl'))}
  <a href="charts.php">{$i18n.menu.charts}</a><br>
    {/if}
    {if ($user->can('view_own_projects') || $user->can('manage_projects')) && (constant('MODE_PROJECTS') == $user->getTrackingMode() || constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode())}
  <a href="projects.php">{$i18n.menu.projects}</a><br>
    {/if}
    {if (constant('MODE_PROJECTS_AND_TASKS') == $user->getTrackingMode() && ($user->can('view_own_tasks') || $user->can('manage_tasks')))}
  <a href="tasks.php">{$i18n.menu.tasks}</a><br>
    {/if}
    {if $user->can('view_users') || $user->can('manage_users')}
  <a href="users.php">{$i18n.menu.users}</a><br>
    {/if}
    {if $user->isPluginEnabled('cl') && ($user->can('view_own_clients') || $user->can('manage_clients'))}
  <a href="clients.php">{$i18n.menu.clients}</a><br>
    {/if}
    {if $user->can('export_data')}
  <a href="export.php">{$i18n.menu.export}</a><br>
    {/if}
</p>
  {* end of sub menu for authorized user *}
  {* main menu for authorized user *}
<p>
  <a href="logout.php">{$i18n.menu.logout}</a><br>
    {if $user->exists() && $user->can('manage_own_settings')}
  <a href="profile_edit.php">{$i18n.menu.profile}</a><br>
    {/if}
    {if $user->can('manage_basic_settings')}
  <a href="group_edit.php">{$i18n.menu.group}</a><br>
    {/if}
    {if $user->can('manage_features')}
  <a href="plugins.php">{$i18n.menu.plugins}</a><br>
    {/if}
  <a href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a><br>
  <a href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a><br>
</p>
  {* end of main menu for authorized user *}
  {/if}
{else}
  {* main menu for non authorized user *}
<p>
  <a href="login.php">{$i18n.menu.login}</a><br>
  {if isTrue('MULTIORG_MODE') && constant('AUTH_MODULE') == 'db'}
  <a href="register.php">{$i18n.menu.register}</a><br>
  {/if}
  <a href="{constant('FORUM_LINK')}" target="_blank">{$i18n.menu.forum}</a><br>
  <a href="{constant('HELP_LINK')}" target="_blank">{$i18n.menu.help}</a><br>
</p>
  {* end of main menu for non authorized user *}
{/if}
