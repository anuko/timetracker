<?php
// +----------------------------------------------------------------------+
// | Anuko Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) Anuko International Ltd. (https://www.anuko.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors:
// | https://www.anuko.com/time_tracker/credits.htm
// +----------------------------------------------------------------------+

class ttUser {
  var $login = null;            // User login.
  var $name = null;             // User name.
  var $id = null;               // User id.
  var $team_id = null;          // Team id.
  var $role = null;             // User role (user, client, comanager, manager, admin).
  var $client_id = null;        // Client id for client user role.
  var $behalf_id = null;        // User id, on behalf of whom we are working.
  var $behalf_name = null;      // User name, on behalf of whom we are working.
  var $email = null;            // User email.
  var $lang = null;             // Language.
  var $decimal_mark = null;     // Decimal separator.
  var $date_format = null;      // Date format.
  var $time_format = null;      // Time format.
  var $week_start = 0;          // Week start day.
  var $show_holidays = 0;       // Whether to show holidays in calendar.
  var $tracking_mode = 0;       // Tracking mode.
  var $project_required = 0;    // Whether project selection is required on time entires.
  var $task_required = 0;       // Whether task selection is required on time entires.
  var $record_type = 0;         // Record type (duration vs start and finish, or both).
  var $punch_in_mode = 0;       // Whether punch in mode is enabled for user.
  var $allow_overlap = 0;       // Whether to allow overlapping time entries.
  var $future_entries = 0;      // Whether to allow creating future entries.
  var $uncompleted_indicators = 0; // Uncompleted time entry indicators (show nowhere or on users page).
  var $bcc_email = null;        // Bcc email.
  var $currency = null;         // Currency.
  var $plugins = null;          // Comma-separated list of enabled plugins.
  var $config = null;           // Comma-separated list of miscellaneous config options.
  var $team = null;             // Team name.
  var $custom_logo = 0;         // Whether to use a custom logo for team.
  var $lock_spec = null;        // Cron specification for record locking.
  var $workday_minutes = 480;   // Number of work minutes in a regular day.
  var $rights = 0;              // A mask of user rights.
  var $rights_array = array();  // An array of user rights, planned replacement of array mask.

  // Constructor.
  function __construct($login, $id = null) {
    if (!$login && !$id) {
      // nothing to initialize
      return;
    }

    $mdb2 = getConnection();

    $sql = "SELECT u.id, u.login, u.name, u.team_id, u.role, u.client_id, u.email, t.name as team_name, 
      t.currency, t.lang, t.decimal_mark, t.date_format, t.time_format, t.week_start,
      t.tracking_mode, t.project_required, t.task_required, t.record_type,
      t.bcc_email, t.plugins, t.config, t.lock_spec, t.workday_minutes, t.custom_logo
      FROM tt_users u LEFT JOIN tt_teams t ON (u.team_id = t.id) WHERE ";
    if ($id)
      $sql .= "u.id = $id";
    else
      $sql .= "u.login = ".$mdb2->quote($login);
    $sql .= " AND u.status = 1";

    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      return;
    }

    $val = $res->fetchRow();
    if ($val['id'] > 0) {
      $this->login = $val['login'];
      $this->name = $val['name'];
      $this->id = $val['id'];
      $this->team_id = $val['team_id'];
      $this->role = $val['role'];
      $this->client_id = $val['client_id'];
      $this->email = $val['email'];
      $this->lang = $val['lang'];
      $this->decimal_mark = $val['decimal_mark'];
      $this->date_format = $val['date_format'];
      $this->time_format = $val['time_format'];
      $this->week_start = $val['week_start'];
      $this->tracking_mode = $val['tracking_mode'];
      $this->project_required = $val['project_required'];
      $this->task_required = $val['task_required'];
      $this->record_type = $val['record_type'];
      $this->bcc_email = $val['bcc_email'];
      $this->team = $val['team_name'];
      $this->currency = $val['currency'];
      $this->plugins = $val['plugins'];
      $this->lock_spec = $val['lock_spec'];
      $this->workday_minutes = $val['workday_minutes'];
      $this->custom_logo = $val['custom_logo'];

      $this->config = $val['config'];
      $config_array = explode(',', $this->config);

      // Set user config options.
      $this->show_holidays = in_array('show_holidays', $config_array);
      $this->punch_in_mode = in_array('punch_in_mode', $config_array);
      $this->allow_overlap = in_array('allow_overlap', $config_array);
      $this->future_entries = in_array('future_entries', $config_array);
      $this->uncompleted_indicators = in_array('uncompleted_indicators', $config_array);

      // Set "on behalf" id and name.
      if (isset($_SESSION['behalf_id'])) {
          $this->behalf_id = $_SESSION['behalf_id'];
          $this->behalf_name = $_SESSION['behalf_name'];
      }

      // Set user rights.
      if ($this->role == ROLE_USER) {
        $this->rights = right_data_entry|right_view_charts|right_view_reports;
        // TODO: get customized rights from the database instead.
        $this->rights_array[] = "data_entry";       // Right to enter time and expense records into Time Tracker.
        $this->rights_array[] = "view_own_reports"; // Right to view own reports (for a specific user).
        $this->rights_array[] = "view_own_charts";  // Right to view own charts (for a specific user).
      } elseif ($this->role == ROLE_CLIENT) {
        $this->rights = right_view_reports|right_view_invoices; // TODO: how about right_view_charts, too?
        $this->rights_array[] = "view_client_reports";  // Right to view reports for a specific client.
        $this->rights_array[] = "view_client_charts";   // Right to view charts for a specific client.
        $this->rights_array[] = "view_client_invoices"; // Right to view invoices for a specific client.
      } elseif ($this->role == ROLE_COMANAGER) {
        $this->rights = right_data_entry|right_view_charts|right_view_reports|right_view_invoices|right_manage_team;
      } elseif ($this->role == ROLE_MANAGER) {
        $this->rights = right_data_entry|right_view_charts|right_view_reports|right_view_invoices|right_manage_team|right_assign_roles|right_export_team;
      } elseif ($this->role == ROLE_SITE_ADMIN) {
        $this->rights = right_administer_site;
      }

/*
// TODO: redesign of user rights and roles is currently ongoing.
// As we run our of bits for sure at some point, rights should be strings instead,
// for example: "data_entry".
// Also, we need rights editor page and team-customized roles.
// Move this stuff from here to ttUser class.
//
// User access rights - bits that collectively define an access mask to the system (a role).
// We'll have some bits here (1,2, etc...) reserved for future use.
define('right_data_entry', 4);     // Right to enter work hours and expenses.
define('right_view_charts', 8);    // Right to view charts.
define('right_view_reports', 16);  // Right to view reports.
define('right_view_invoices', 32); // Right to view invoices.
define('right_manage_team', 64);   // Right to manage team. Note that this is not full access to team.
define('right_assign_roles', 128); // Right to assign user roles.
define('right_export_team', 256);  // Right to export team data to a file.
define('right_administer_site', 1024); // Admin account right to manage the application as a whole.

// User roles.
define('ROLE_USER', 4);          // Regular user.
define('ROLE_CLIENT', 16);       // Client (to view reports and invoices).
define('ROLE_COMANAGER', 68);    // Team co-manager. Can do many things but not as much as team manager.
define('ROLE_MANAGER', 324);     // Team manager. Can do everything for a team.
define('ROLE_SITE_ADMIN', 1024); // Site administrator.
*/

      // Adjust punch_in_mode for managers as they are allowed to overwrite start and end times.
      if ($this->canManageTeam()) $this->punch_in_mode = 0;
    }
  }

  // The getActiveUser returns user id on behalf of whom current user is operating.
  function getActiveUser() {
    return ($this->behalf_id ? $this->behalf_id : $this->id);
  }

  // isAdmin - determines whether current user is admin (has right_administer_site).
  function isAdmin() {
    return (right_administer_site & $this->role);
  }

  // isManager - determines whether current user is team manager.
  function isManager() {
    return (ROLE_MANAGER == $this->role);
  }

  // isCoManager - determines whether current user is team comanager.
  function isCoManager() {
    return (ROLE_COMANAGER == $this->role);
  }

  // isClient - determines whether current user is a client.
  function isClient() {
    return (ROLE_CLIENT == $this->role);
  }

  // canManageTeam - determines whether current user is manager or co-manager.
  function canManageTeam() {
    return (right_manage_team & $this->role);
  }

  // isPluginEnabled checks whether a plugin is enabled for user.
  function isPluginEnabled($plugin)
  {
    return in_array($plugin, explode(',', $this->plugins));
  }

  // getAssignedProjects - returns an array of assigned projects.
  function getAssignedProjects()
  {
    $result = array();
    $mdb2 = getConnection();

    // Do a query with inner join to get assigned projects.
    $sql = "select p.id, p.name, p.description, p.tasks, upb.rate from tt_projects p
      inner join tt_user_project_binds upb on (upb.user_id = ".$this->getActiveUser()." and upb.project_id = p.id and upb.status = 1)
      where p.team_id = $this->team_id and p.status = 1 order by p.name";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // isDateLocked checks whether a specifc date is locked for modifications.
  function isDateLocked($date)
  {
    if ($this->isPluginEnabled('lk') && $this->lock_spec) {
      // Override for managers.
      if ($this->canManageTeam()) return false;

      require_once(LIBRARY_DIR.'/tdcron/class.tdcron.php');
      require_once(LIBRARY_DIR.'/tdcron/class.tdcron.entry.php');

      // Calculate the last occurrence of a lock.
      $last = tdCron::getLastOccurrence($this->lock_spec, time());
      $lockdate = new DateAndTime(DB_DATEFORMAT, strftime('%Y-%m-%d', $last));
      if ($date->before($lockdate)) {
        return true;
      }
    }
    return false;
  }
}
