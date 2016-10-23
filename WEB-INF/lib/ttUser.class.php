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
  var $tracking_mode = 0;       // Tracking mode.
  var $record_type = 0;         // Record type (duration vs start and finish, or both).
  var $uncompleted_entries = 0; // Uncompleted entries (show nowhere or on users page).
  var $currency = null;         // Currency.
  var $plugins = null;          // Comma-separated list of enabled plugins.
  var $team = null;             // Team name.
  var $custom_logo = 0;         // Whether to use a custom logo for team.
  var $address = null;          // Address for invoices.
  var $lock_spec = null;        // Cron specification for record locking.
  var $workday_hours = 8;       // Number of work hours in a regular day.
  var $rights = 0;              // A mask of user rights.

  // Constructor.
  function ttUser($login, $id = null) {
    if (!$login && !$id) {
      // nothing to initialize
      return;
    }

    $mdb2 = getConnection();

    $sql = "SELECT u.id, u.login, u.name, u.team_id, u.role, u.client_id, u.email, t.name as team_name, 
      t.address, t.currency, t.lang, t.decimal_mark, t.date_format, t.time_format, t.week_start,
      t.tracking_mode, t.record_type, t.uncompleted_indicators, t.plugins, t.lock_spec, t.workday_hours, t.custom_logo
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
      $this->record_type = $val['record_type'];
      $this->uncompleted_entries = $val['uncompleted_indicators'];
      $this->team = $val['team_name'];
      $this->address = $val['address'];
      $this->currency = $val['currency'];
      $this->plugins = $val['plugins'];
      $this->lock_spec = $val['lock_spec'];
      $this->workday_hours = $val['workday_hours'];
      $this->custom_logo = $val['custom_logo'];

      // Set "on behalf" id and name.
      if (isset($_SESSION['behalf_id'])) {
          $this->behalf_id = $_SESSION['behalf_id'];
          $this->behalf_name = $_SESSION['behalf_name'];
      }

      // Set user rights.
      if ($this->role == ROLE_USER) {
        $this->rights = right_data_entry|right_view_charts|right_view_reports;
      } elseif ($this->role == ROLE_CLIENT) {
        $this->rights = right_view_reports|right_view_invoices; // TODO: how about right_view_charts, too?
      } elseif ($this->role == ROLE_COMANAGER) {
        $this->rights = right_data_entry|right_view_charts|right_view_reports|right_view_invoices|right_manage_team;
      } elseif ($this->role == ROLE_MANAGER) {
        $this->rights = right_data_entry|right_view_charts|right_view_reports|right_view_invoices|right_manage_team|right_assign_roles|right_export_team;
      } elseif ($this->role == ROLE_SITE_ADMIN) {
        $this->rights = right_administer_site;
      }
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
      $last = tdCron::getLastOccurrence($this->lock_spec, mktime());
      $lockdate = new DateAndTime(DB_DATEFORMAT, strftime('%Y-%m-%d', $last));
      if ($date->before($lockdate)) {
        return true;
      }
    }
    return false;
  }
}
