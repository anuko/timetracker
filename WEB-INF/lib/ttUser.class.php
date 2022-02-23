<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('ttConfigHelper');
import('ttGroupHelper');
import('ttBehalfUser');
import('ttGroup');
import('form.Form');
import('form.ActionForm');
import('ttTemplateHelper');
import('ttDate');

class ttUser {
  var $login = null;            // User login.
  var $name = null;             // User name.
  var $id = null;               // User id.
  var $org_id = null;           // Organization id.
  var $org_key = null;          // Organization key.
  var $group_id = null;         // Group id.
  var $group_key = null;        // Group key.
  var $role_id = null;          // Role id.
  var $role_name = null;        // Role name.
  var $rank = null;             // User role rank.
  var $client_id = null;        // Client id for client user role.
  var $quota_percent = 100.0;   // Time quota percent for quotas plugin.
  var $behalf_id = null;        // User id, on behalf of whom we are working.
  var $behalf_group_id = null;  // Group id, on behalf of which we are working.
  var $behalf_name = null;      // User name, on behalf of whom we are working.
  var $group_name = null;       // Group name.
  var $behalf_group_name = null;// Group name, on behalf of which we are working.
  var $email = null;            // User email.
  var $lang = null;             // Language.
  var $decimal_mark = '.';      // Decimal separator.
  var $date_format = null;      // Date format.
  var $time_format = null;      // Time format.
  var $week_start = 0;          // Week start day.
  var $tracking_mode = 0;       // Tracking mode.
  var $project_required = 0;    // Whether project selection is required on time entires.
  var $record_type = 0;         // Record type (duration vs start and finish, or both).
  var $punch_mode = 0;          // Whether punch mode is enabled for user.
  var $allow_overlap = 0;       // Whether to allow overlapping time entries.
  var $bcc_email = null;        // Bcc email.
  var $allow_ip = null;         // Specification from where user is allowed access.
  var $password_complexity = null; // Password complexity example.
  var $currency = null;         // Currency.
  var $plugins = null;          // Comma-separated list of enabled plugins.

  // Refactoring ongoing. Towards using helper instead of config string?
  var $config = null;           // Comma-separated list of miscellaneous config options.
  var $configHelper = null;     // An instance of ttConfigHelper class.
  var $custom_css = null;       // Custom css.

  var $custom_logo = 0;         // Whether to use a custom logo for group.
  var $lock_spec = null;        // Cron specification for record locking.
  var $holidays = null;         // Holidays specification.
  var $workday_minutes = 480;   // Number of work minutes in a regular day.
  var $rights = array();        // An array of user rights such as 'track_own_time', etc.
  var $is_client = false;       // Whether user is a client as determined by missing 'track_own_time' right.

  var $behalfUser = null;       // A ttBehalfUser instance with on behalf user attributes.
  var $behalfGroup = null;      // A ttGroup instance with on behalf group attributes.

  // Constructor.
  function __construct($login, $id = null) {
    if (!$login && !$id) {
      // nothing to initialize
      return;
    }

    $mdb2 = getConnection();

    $sql = "SELECT u.id, u.login, u.name, u.group_id, u.role_id, r.rank, r.name as role_name, r.rights, u.client_id,".
      " u.quota_percent, u.email, g.org_id, g.group_key, g.name as group_name, g.currency, g.lang, g.decimal_mark, g.date_format,".
      " g.time_format, g.week_start, g.tracking_mode, g.project_required, g.record_type,".
      " g.bcc_email, g.allow_ip, g.password_complexity, g.plugins, g.config, g.lock_spec, g.custom_css, g.holidays, g.workday_minutes, g.custom_logo".
      " FROM tt_users u LEFT JOIN tt_groups g ON (u.group_id = g.id) LEFT JOIN tt_roles r on (r.id = u.role_id) WHERE ";
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
      $this->org_id = $val['org_id'];
      $this->group_id = $val['group_id'];
      $this->group_key = $val['group_key'];
      if ($this->org_id == $this->group_key) $this->org_key = $val['group_key'];
      $this->role_id = $val['role_id'];
      $this->role_name = $val['role_name'];
      $this->rights = explode(',', $val['rights']);
      $this->rank = $val['rank'];
      $this->client_id = $val['client_id'];
      $this->is_client = $this->client_id && !in_array('track_own_time', $this->rights);
      if ($val['quota_percent']) $this->quota_percent = $val['quota_percent'];
      $this->email = $val['email'];
      if ($val['lang']) $this->lang = $val['lang'];
      if ($val['decimal_mark']) $this->decimal_mark = $val['decimal_mark'];
      $this->date_format = $val['date_format'];
      $this->time_format = $val['time_format'];
      $this->week_start = $val['week_start'];
      $this->tracking_mode = $val['tracking_mode'];
      $this->project_required = $val['project_required'];
      $this->record_type = $val['record_type'];
      $this->bcc_email = $val['bcc_email'];
      $this->allow_ip = $val['allow_ip'];
      $this->password_complexity = $val['password_complexity'];
      $this->group_name = $val['group_name'];
      $this->currency = $val['currency'];
      $this->plugins = $val['plugins'];
      $this->lock_spec = $val['lock_spec'];
      $this->holidays = $val['holidays'];
      $this->workday_minutes = $val['workday_minutes'];
      $this->custom_logo = $val['custom_logo'];

      // TODO: refactor this.
      $this->config = $val['config'];
      $this->configHelper = new ttConfigHelper($val['config']);

      // Set user config options.
      $this->punch_mode = $this->configHelper->getDefinedValue('punch_mode');
      $this->allow_overlap = $this->configHelper->getDefinedValue('allow_overlap');

      $this->custom_css = $val['custom_css'];

      // Set "on behalf" id and name (user).
      if (isset($_SESSION['behalf_id'])) {
        $this->behalf_id = $_SESSION['behalf_id'];
        $this->behalf_name = $_SESSION['behalf_name'];

        $this->behalfUser = new ttBehalfUser($this->behalf_id, $this->org_id);
      }
      // Set "on behalf" id and name (group).
      if (isset($_SESSION['behalf_group_id'])) {
        $this->behalf_group_id = $_SESSION['behalf_group_id'];
        $this->behalf_group_name = $_SESSION['behalf_group_name'];

        $this->behalfGroup = new ttGroup($this->behalf_group_id, $this->org_id);
      }
    }
  }

  // getUser returns user id on behalf of whom the current user is operating.
  function getUser() {
    return ($this->behalfUser ? $this->behalfUser->id : $this->id);
  }

  // getName returns user name on behalf of whom the current user is operating.
  function getName() {
    return ($this->behalfUser ? $this->behalfUser->name : $this->name);
  }

  // getQuotaPercent returns quota percent for active user.
  function getQuotaPercent() {
    return ($this->behalfUser ? $this->behalfUser->quota_percent : $this->quota_percent);
  }

  // getEmail returns email for active user.
  function getEmail() {
    return ($this->behalfUser ? $this->behalfUser->email : $this->email);
  }

  // The getGroup returns group id on behalf of which the current user is operating.
  function getGroup() {
    return ($this->behalfGroup ? $this->behalfGroup->id : $this->group_id);
  }

  // getGroupName returns group name on behalf of which the current user is operating.
  function getGroupName() {
    return ($this->behalfGroup ? $this->behalfGroup->name : $this->group_name);
  }

  // getGroupKey returns group key for active group.
  function getGroupKey() {
    return ($this->behalfGroup ? $this->behalfGroup->group_key : $this->group_key);
  }

  // getOrgKey returns org key.
  function getOrgKey() {
    if ($this->org_key) {
      return $this->org_key;
    }

    // Org key is not set because we are in a subgroup. Obtain it.
    $mdb2 = getConnection();
    $org_id = $this->org_id;
    $sql = "select group_key from tt_groups where id = $org_id and status = 1";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    $this->org_key = $val['group_key'];
    return $this->org_key;
  }

  // getDecimalMark returns decimal mark for active group.
  function getDecimalMark() {
    return ($this->behalfGroup ? $this->behalfGroup->decimal_mark : $this->decimal_mark);
  }

  // getDateFormat returns date format for active group.
  function getDateFormat() {
    return ($this->behalfGroup ? $this->behalfGroup->date_format : $this->date_format);
  }

  // getTimeFormat returns time format for active group.
  function getTimeFormat() {
    return ($this->behalfGroup ? $this->behalfGroup->time_format : $this->time_format);
  }

  // getWeekStart returns week start day for active group.
  function getWeekStart() {
    return ($this->behalfGroup ? $this->behalfGroup->week_start : $this->week_start);
  }

  // getTrackingMode returns tracking mode for active group.
  function getTrackingMode() {
    return ($this->behalfGroup ? $this->behalfGroup->tracking_mode : $this->tracking_mode);
  }

  // getRecordType returns record type for active group.
  function getRecordType() {
    return ($this->behalfGroup ? $this->behalfGroup->record_type : $this->record_type);
  }

  // getCurrency returns currency string for active group.
  function getCurrency() {
    return ($this->behalfGroup ? $this->behalfGroup->currency : $this->currency);
  }

  // getPlugins returns plugins string for active group.
  function getPlugins() {
    return ($this->behalfGroup ? $this->behalfGroup->plugins : $this->plugins);
  }

  // getLockSpec returns lock specification for active group.
  function getLockSpec() {
    return ($this->behalfGroup ? $this->behalfGroup->lock_spec : $this->lock_spec);
  }

  // getHolidays returns holidays specification for active group.
  function getHolidays() {
    return ($this->behalfGroup ? $this->behalfGroup->holidays : $this->holidays);
  }

  // getWorkdayMinutes returns workday_minutes for active group.
  function getWorkdayMinutes() {
    return ($this->behalfGroup ? $this->behalfGroup->workday_minutes : $this->workday_minutes);
  }

  // getConfig returns config string for active group.
  function getConfig() {
    return ($this->behalfGroup ? $this->behalfGroup->configHelper->getConfig() : $this->configHelper->getConfig());
  }

  // getConfigHelper returns ttConfigHelper instance for active group.
  function getConfigHelper() {
    return ($this->behalfGroup ? $this->behalfGroup->configHelper : $this->configHelper);
  }

  // getConfigOption returns true if an option is defined for group.
  // This helps us keeping a set of user attributes smaller.
  // We determine whether the option is set only on pages that need to know.
  // For example: confirm_save is used only on time and expense edit pages.
  function getConfigOption($name) {
    $config = new ttConfigHelper($this->getConfig());
    return $config->getDefinedValue($name);
  }

  // getConfigInt returns an integer value defined in a group, or false.
  function getConfigInt($name, $defaultVal = 0) {
    $config = new ttConfigHelper($this->getConfig());
    return $config->getIntValue($name, $defaultVal);
  }

  // getCustomCss returns custom css for active group.
  function getCustomCss() {
    return ($this->behalfGroup ? $this->behalfGroup->custom_css : $this->custom_css);
  }

  // can - determines whether user has a right to do something.
  function can($do_something) {
    return in_array($do_something, $this->rights);
  }

  // isClient - determines whether current user is a client.
  function isClient() {
    return $this->is_client;
  }

  // isPluginEnabled checks whether a plugin is enabled for user.
  function isPluginEnabled($plugin)
  {
    return in_array($plugin, explode(',', $this->getPlugins() ? $this->getPlugins() : ''));
  }

  // isOptionEnabled checks whether a config option is enabled for user.
  function isOptionEnabled($option)
  {
    return $this->behalfGroup ? $this->behalfGroup->configHelper->getDefinedValue($option) : $this->configHelper->getDefinedValue($option);
  }

  // setOption sets an option inside of ttConfigHelper instance.
  // Note that it does not write to the database.
  function setOption($option, $enable = true)
  {
    return $this->behalfGroup ? $this->behalfGroup->configHelper->setDefinedValue($option, $enable) : $this->configHelper->setDefinedValue($option, $enable);
  }

  // getAssignedProjects - returns an array of assigned projects.
  function getAssignedProjects($options = null)
  {
    $result = array();
    $mdb2 = getConnection();

    $user_id = $this->getUser();
    $group_id = $this->getGroup();
    $org_id = $this->org_id;

    $filePart = '';
    $fileJoin = '';
    if (isset($options['include_files']) && $options['include_files']) {
      $filePart = ', if(Sub1.entity_id is null, 0, 1) as has_files';
      $fileJoin =  " left join (select distinct entity_id from tt_files".
      " where entity_type = 'project' and group_id = $group_id and org_id = $org_id and status = 1) Sub1".
      " on (p.id = Sub1.entity_id)";
    }

    // Do a query with inner join to get assigned projects.
    $sql = "select p.id, p.name, p.description, p.tasks, upb.rate $filePart from tt_projects p $fileJoin".
      " inner join tt_user_project_binds upb on (upb.user_id = $user_id and upb.project_id = p.id and upb.status = 1)".
      " where p.group_id = $group_id and p.org_id = $org_id and p.status = 1 order by p.name";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $bindTemplatesWithProjects = isset($options['include_templates']) && $options['include_templates'];
      while ($val = $res->fetchRow()) {
        // If we have to include templates, get them in a separate query for each project.
        // Although, theoretically, we could use mysql group_concat, but this requires grouping by, which makes
        // maintenance of this code more complex.
        if ($bindTemplatesWithProjects) {
          $val['templates'] = ttTemplateHelper::getAssignedTemplates($val['id']);
        }
        $result[] = $val;
      }
    }
    return $result;
  }

  // getAssignedTasks - returns an array of assigned tasks.
  function getAssignedTasks()
  {
    // Start with projects;
    $projects = $this->getAssignedProjects();
    if (!$projects) return false;

    // Build an array of task ids.
    $task_ids = array();
    foreach($projects as $project) {
      $one_project_tasks = $project['tasks'] ? explode(',', $project['tasks']) : array();
      $task_ids = array_unique(array_merge($task_ids, $one_project_tasks));
    }
    if (!$task_ids) return false;

    // Get task descriptions.
    $result = array();
    $mdb2 = getConnection();
    $tasks = implode(',', $task_ids); // This is a comma-separated list of task ids.

    $group_id = $this->getGroup();
    $org_id = $this->org_id;

    $sql = "select id, name, description from tt_tasks".
      " where group_id = $group_id and org_id = $org_id and status = 1 and id in ($tasks) order by name";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getAssignedClients - returns an array of clients assigned to own projects.
  function getAssignedClients()
  {
    // Start with projects;
    $projects = $this->getAssignedProjects();
    if (!$projects) return false;
    $assigned_project_ids = array();
    foreach($projects as $project) {
      $assigned_project_ids[] = $project['id'];
    }

    $mdb2 = getConnection();

    $group_id = $this->getGroup();
    $org_id = $this->org_id;

    // Get active clients for group.
    $clients = array();
    $sql = "select id, name, address, projects from tt_clients where group_id = $group_id and org_id = $org_id and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $client_project_ids = $val['projects'] ? explode(',', $val['projects']) : array();
        if (array_intersect($assigned_project_ids, $client_project_ids))
          $clients[] = $val; // Add client if one of user projects is a client project, too.
      }
    }
    return $clients;
  }

  // isDateLocked checks whether a specifc date is locked for modifications.
  function isDateLocked($date)
  {
    if (!$this->isPluginEnabled('lk'))
      return false; // Locking feature is disabled.

    if (!$this->getLockSpec())
      return false; // There is no lock specification.

    if (!$this->behalf_id && $this->can('override_own_date_lock'))
      return false; // User is working as self and can override own date lock.

    if ($this->behalf_id && $this->can('override_date_lock'))
      return false; // User is working on behalf of someone else and can override date lock.

    require_once(LIBRARY_DIR.'/tdcron/class.tdcron.php');
    require_once(LIBRARY_DIR.'/tdcron/class.tdcron.entry.php');

    // Calculate the last occurrence of a lock.
    $last = tdCron::getLastOccurrence($this->getLockSpec(), time());
    $lockdate = new ttDate(strftime('%Y-%m-%d', $last));
    if ($date->before($lockdate))
      return true;

    return false;
  }

  // canOverridePunchMode checks whether a user can override punch mode in a situation.
  function canOverridePunchMode()
  {
    if (!$this->behalf_id && !$this->can('override_own_punch_mode'))
      return false; // User is working as self and cannot override for self.

    if ($this->behalf_id && !$this->can('override_punch_mode'))
      return false; // User is working on behalf of someone else and cannot override.

    return true;
  }

  // getUsers obtains users in a group, as specififed by options.
  function getUsers($options) {
    $mdb2 = getConnection();

    $group_id = $this->getGroup();
    $org_id = $this->org_id;

    $skipClients = !isset($options['include_clients']);
    $includeSelf = isset($options['include_self']);

    $select_part = 'select u.id, u.group_id, u.name';
    $include_quota = false;
    if (isset($options['include_login'])) {
      $select_part .= ', u.login';
      // Piggy-back on include_login to see if we must also include quota_percent.
      $include_quota = $this->isPluginEnabled('mq');
      if ($include_quota) {
        $decimal_mark = $this->getDecimalMark();
        $replaceDecimalMark = ('.' != $decimal_mark);
        $select_part .= ', u.quota_percent';
      }
    }
    if (!isset($options['include_clients'])) $select_part .= ', r.rights';
    if (isset($options['include_role'])) $select_part .= ', r.name as role_name, r.rank';

    $from_part = ' from tt_users u';

    $left_joins = null;
    if (isset($options['max_rank']) || $skipClients || isset($options['include_role']))
      $left_joins .= ' left join tt_roles r on (u.role_id = r.id)';

    $where_part = " where u.org_id = $org_id and u.group_id = $group_id";
    if (isset($options['status']))
      $where_part .= ' and u.status = '.(int)$options['status'];
    else
      $where_part .= ' and u.status is not null';
    if ($includeSelf) {
      $where_part .= " and (u.id = $this->id || r.rank <= ".(int)$options['max_rank'].')';
    } else {
      if (isset($options['max_rank'])) $where_part .= ' and r.rank <= '.(int)$options['max_rank'];
    }

    $order_part = " order by upper(u.name)";

    $sql = $select_part.$from_part.$left_joins.$where_part.$order_part;
    $res = $mdb2->query($sql);
    $user_list = array();
    if (is_a($res, 'PEAR_Error'))
      return false;

    while ($val = $res->fetchRow()) {
      if ($skipClients) {
        $isClient = in_array('track_own_time', explode(',', $val['rights'])) ? 0 : 1; // Clients do not have track_own_time right.
        if ($isClient)
          continue; // Skip adding clients.
      }
      if ($include_quota) {
        $quota = $val['quota_percent'];
        if (ttEndsWith($quota, '.00'))
          $quota = substr($quota, 0, strlen($quota)-3); // Trim trailing ".00";
        elseif ($replaceDecimalMark)
          $quota = str_replace('.', $decimal_mark, $quota);
        $val['quota_percent'] = $quota.'%';
      }
      $user_list[] = $val;
    }

    if (isset($options['self_first'])) {
      // Put own entry at the front.
      $cnt = count($user_list);
      for($i = 0; $i < $cnt; $i++) {
        if ($user_list[$i]['id'] == $this->id) {
          $self = $user_list[$i]; // Found self.
          array_unshift($user_list, $self); // Put own entry at the front.
          array_splice($user_list, $i+1, 1); // Remove duplicate.
        }
      }
    }
    return $user_list;
  }

  // getGroupsForDropdown obtains an array of groups to populate the "Group" dropdown.
  // It consists of the entire tree starting from user home group.
  // Group name is prefixed with additional characters to indicate subgroups level.
  function getGroupsForDropdown() {
    global $user;

    // Start with user home group.
    $groups = array();
    $subgroup_level = 0;
    $group_id = $user->group_id;

    $this->addGroupToDropdown($groups, $group_id, $subgroup_level);
    return $groups;
  }

  // addGroupToDropdown is a recursive function to populate a tree of groups, used with getGroupsForDropdown().
  function addGroupToDropdown(&$groups, $group_id, $subgroup_level) {
    $name = '';
    // Add indentation markup to indicate a subdirectory level.
    for ($i = 0; $i < $subgroup_level; $i++) {
      $name .= '*';
      // $name .= '🛑'; // Unicode stop sign. Does not display properly in Chrome 98.
    }
    if ($subgroup_level) $name .= ' '; // Add an extra space.
    $name .= ttGroupHelper::getGroupName($group_id);

    $groups[] = array('id'=>$group_id, 'name'=>$name);

    $subgroups = (array) $this->getSubgroups($group_id);
    foreach($subgroups as $subgroup) {
      $this->addGroupToDropdown($groups, $subgroup['id'], $subgroup_level+1);
    }
  }

  // getSubgroups obtains a list of immediate subgroups.
  function getSubgroups($group_id = null) {
    $groups = array();
    $mdb2 = getConnection();

    if (!$group_id) $group_id = $this->getGroup();

    $sql = "select id, name, description from tt_groups where org_id = $this->org_id".
      " and parent_id = $group_id and status is not null order by upper(name)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $groups[] = $val;
      }
    }
    return $groups;
  }

  // getUserDetails function returns user details.
   function getUserDetails($user_id) {
    $mdb2 = getConnection();
    $group_id = $this->getGroup();
    $org_id = $this->org_id;
    $uid = (int)$user_id;

    // Determine max rank. If we are searching in on behalf group
    // then rank restriction does not apply.
    $max_rank = $this->behalfGroup ? MAX_RANK : $this->rank;

    $sql =  "select u.id, u.name, u.login, u.role_id, u.client_id, u.status, u.rate, u.quota_percent, u.email from tt_users u".
      " left join tt_roles r on (u.role_id = r.id)".
      " where u.id = $uid and u.group_id = $group_id and u.org_id = $org_id and u.status is not null".
      " and (r.rank < $max_rank or (r.rank = $max_rank and u.id = $this->id))"; // Users with lesser roles or self.
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val;
    }
    return false;
  }

  // checkBehalfId checks whether behalf_id is appropriate.
  // On behalf user must be active and have lower rank if the user is from home group,
  // otherwise:
  // - subgroup must ve valid;
  // - user should be a member of it.
  function checkBehalfId() {
    if (!$this->behalfGroup) {
      // Checking user from home group.
      $options = array('status'=>ACTIVE,'max_rank'=>$this->rank-1);
      $users = $this->getUsers($options);
      foreach($users as $one_user) {
        if ($one_user['id'] == $this->behalf_id)
          return true;
      }
    } else {
      // Checking user from a subgroup.
      $group_id = $this->behalfGroup->id;
      if (!$this->isSubgroupValid($group_id))
        return false;

      // So far, so good. Check user now.
      $options = array('status'=>ACTIVE,'max_rank'=>MAX_RANK);
      $users = $this->getUsers($options);
      foreach($users as $one_user) {
        if ($one_user['id'] == $this->behalf_id)
          return true;
      }
    }
    return false;
  }

  // adjustBehalfId attempts to adjust behalf_id and behalf_name to a first found
  // apropriate user.
  //
  // Needed for situations when user does not have do_own_something right.
  // Example: has view_charts but does not have view_own_charts.
  // In this case we still allow access to charts, but set behalf_id to someone else.
  // Another example: working in a subgroup on behalf of someone else.
  function adjustBehalfId() {
    $rank = $this->getMaxRankForGroup($this->getGroup());

    // Adjust to first found user in group.
    $options = array('status'=>ACTIVE,'max_rank'=>$rank);
    $users = $this->getUsers($options);
    foreach($users as $one_user) {
      // Fake loop to access first element.
      $this->behalf_id = $one_user['id'];
      $this->behalf_name = $one_user['name'];
      $_SESSION['behalf_id'] = $this->behalf_id;
      $_SESSION['behalf_name'] = $this->behalf_name;
      return true;
    }
    return false;
  }

  // updateGroup updates group information with new data.
  function updateGroup($fields) {
    $mdb2 = getConnection();

    $group_id = isset($fields['group_id']) ? $fields['group_id'] : null;
    if ($group_id && !$this->isGroupValid($group_id)) return false;
    if (!$group_id) $group_id = $this->getGroup();

    $name_part = $description_part = $currency_part = $lang_part = $decimal_mark_part = $date_format_part = $time_format_part =
      $week_start_part = $tracking_mode_part = $project_required_part = $record_type_part = $bcc_email_part =  $allow_ip_part =
      $plugins_part = $config_part = $custom_css_part = $lock_spec_part = $holidays_part = $workday_minutes_part = '';
    if (isset($fields['name'])) $name_part = ', name = '.$mdb2->quote($fields['name']);
    if (isset($fields['description'])) $description_part = ', description = '.$mdb2->quote($fields['description']);
    if (isset($fields['currency'])) $currency_part = ', currency = '.$mdb2->quote($fields['currency']);
    if (isset($fields['lang'])) $lang_part = ', lang = '.$mdb2->quote($fields['lang']);
    if (isset($fields['decimal_mark'])) $decimal_mark_part = ', decimal_mark = '.$mdb2->quote($fields['decimal_mark']);
    if (isset($fields['date_format'])) $date_format_part = ', date_format = '.$mdb2->quote($fields['date_format']);
    if (isset($fields['time_format'])) $time_format_part = ', time_format = '.$mdb2->quote($fields['time_format']);
    if (isset($fields['week_start'])) $week_start_part = ', week_start = '.(int) $fields['week_start'];
    if (isset($fields['tracking_mode'])) {
      $tracking_mode_part = ', tracking_mode = '.(int) $fields['tracking_mode'];
      $project_required_part = ' , project_required = '.(int) $fields['project_required'];
    }
    if (isset($fields['record_type'])) $record_type_part = ', record_type = '.(int) $fields['record_type'];
    if (isset($fields['bcc_email'])) $bcc_email_part = ', bcc_email = '.$mdb2->quote($fields['bcc_email']);
    if (isset($fields['allow_ip'])) $allow_ip_part = ', allow_ip = '.$mdb2->quote($fields['allow_ip']);
    if (isset($fields['plugins'])) $plugins_part = ', plugins = '.$mdb2->quote($fields['plugins']);
    if (isset($fields['config'])) $config_part = ', config = '.$mdb2->quote($fields['config']);
    if (isset($fields['custom_css'])) $custom_css_part = ', custom_css = '.$mdb2->quote($fields['custom_css']);
    if (isset($fields['lock_spec'])) $lock_spec_part = ', lock_spec = '.$mdb2->quote($fields['lock_spec']);
    if (isset($fields['holidays'])) $holidays_part = ', holidays = '.$mdb2->quote($fields['holidays']);
    if (isset($fields['workday_minutes'])) $workday_minutes_part = ', workday_minutes = '.$mdb2->quote($fields['workday_minutes']);
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($this->id);

    $parts = trim($name_part.$description_part.$currency_part.$lang_part.$decimal_mark_part.$date_format_part.
      $time_format_part.$week_start_part.$tracking_mode_part.$project_required_part.$record_type_part.
      $bcc_email_part.$allow_ip_part.$plugins_part.$config_part.$custom_css_part.$lock_spec_part.$holidays_part.$workday_minutes_part.$modified_part, ',');

    $sql = "update tt_groups set $parts where id = $group_id and org_id = $this->org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Update entities_modified, too.
    if (!ttGroupHelper::updateEntitiesModified())
      return false;

    return true;
  }

  // markUserDeleted marks a user in group as deleted.
  function markUserDeleted($user_id) {
    if (!$this->can('manage_users') || $this->id == $user_id)
      return false;

    // Make sure we operate on a legit user.
    $user_details = $this->getUserDetails($user_id);
    if (!$user_details) return false;

    $mdb2 = getConnection();
    $group_id = $this->getGroup();
    $org_id = $this->org_id;

    // Mark user to project binds as deleted.
    $sql = "update tt_user_project_binds set status = NULL where user_id = $user_id".
      " and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Mark user favorite reports as deleted.
    $sql = "update tt_fav_reports set status = NULL where user_id = $user_id".
      " and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Mark user custom fields as deleted,
    require_once('plugins/CustomFields.class.php');
    $entity_type = CustomFields::ENTITY_USER;
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($this->id);
    $sql = "update tt_entity_custom_fields set status = null $modified_part".
      " where entity_type = $entity_type and entity_id = $user_id".
      " and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Mark user as deleted.
    $sql = "update tt_users set status = null $modified_part where id = $user_id".
      " and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Update entities_modified, too.
    if (!ttGroupHelper::updateEntitiesModified())
      return false;

    return true;
  }

  // isUserValid determines if a user is valid for on behalf work.
  function isUserValid($user_id) {
    if ($user_id == $this->id)
      return true;
    return ($this->getUserDetails($user_id) != null);
  }

  // isGroupValid determines if a group is valid for user.
  function isGroupValid($group_id) {
    if ($group_id == $this->group_id)
      return true;
    else
      return $this->isSubgroupValid($group_id);
  }

  // isSubgroupValid determines if a subgroup is valid for user.
  // A subgroup is valid if:
  //   - user can manage_subgroups;
  //   - subgroup is either a direct child of user group, or "on the path"
  //   to it (grand-child, etc.).
  function isSubgroupValid($subgroup_id) {
    if (!$this->can('manage_subgroups')) return false; // User cannot manage subgroups.

    $current_group_id = $subgroup_id;
    while ($parent_group_id = ttGroupHelper::getParentGroup($current_group_id)) {
      if ($parent_group_id == $this->group_id) {
        return true; // Found it.
      }
      $current_group_id = $parent_group_id;
    }
    return false;
  }

  // getMaxRankForGroup determines effective user rank for a user in a given group.
  // For home group it is the existing user rank (as per role) minus 1.
  // For subgroups, if user can "manage_subgroups", it is MAX_RANK.
  function getMaxRankForGroup($group_id) {

    $max_rank = 0; // Start safely.
    if ($this->group_id == $group_id) {
      $max_rank = $this->rank - 1;
      return $max_rank;
    }

    if ($this->isSubgroupValid($group_id))
      $max_rank = MAX_RANK;

    return $max_rank;
  }

  // getUserPartForHeader constructs a string for user to display on pages header.
  // It changes with "on behalf" attributes for both user and group.
  function getUserPartForHeader() {
    global $i18n;
    if (!$this->id) return null;

    $user_part = htmlspecialchars($this->name);
    $user_part .= ' - '.htmlspecialchars($this->role_name);
    if ($this->behalf_id) {
      $user_part .= ' <span class="onBehalf">'.$i18n->get('label.on_behalf').' '.htmlspecialchars($this->behalf_name).'</span>';
    }
    if ($this->behalf_group_id) {
      $user_part .= ',  <span class="onBehalf">'.htmlspecialchars($this->behalf_group_name).'</span>';
    } else {
      if ($this->group_name) // Note: we did not require group names in the past.
        $user_part .= ', '.htmlspecialchars($this->group_name);
    }
    return $user_part;
  }

  // setOnBehalfGroup sets on behalf group for the user in both the object and the session.
  function setOnBehalfGroup($group_id) {

    // Unset things first.
    $this->behalf_group_id = null;
    $this->behalf_group_name = null;
    $this->behalf_id = null;
    $this->behalf_name = null;
    unset($this->behalfGroup);
    $this->behalfGroup = null;
    unset($_SESSION['behalf_group_id']);
    unset($_SESSION['behalf_group_name']);
    unset($_SESSION['behalf_id']);
    unset($_SESSION['behalf_name']);

    // Destroy report bean if it was set in session.
    $form = new Form('dummyForm');
    global $request;
    $bean = new ActionForm('reportBean', $form, $request);
    if ($bean->isSaved()) {
      $bean->destroyBean();
    }

    // Do not do anything if we don't have rights.
    if (!$this->can('manage_subgroups')) return;

    // No need to set if group is our home group.
    if ($group_id == $this->group_id) return;

    // No need to set if subgroup is not valid.
    if (!$this->isSubgroupValid($group_id)) return;

    // We are good to set on behalf group.
    $onBehalfGroupName = ttGroupHelper::getGroupName($group_id);
    $_SESSION['behalf_group_id'] = $group_id;
    $_SESSION['behalf_group_name'] = $onBehalfGroupName;
    $this->behalf_group_id = $group_id;
    $this->behalf_group_name = $onBehalfGroupName;

    $this->behalfGroup = new ttGroup($this->behalf_group_id, $this->org_id);

    // Adjust on behalf user to first found user in subgroup.
    $this->adjustBehalfId();
    return;
  }

  // setOnBehalfUser sets on behalf user both the object and the session.
  function setOnBehalfUser($user_id) {
    $uid = (int)$user_id; // In case we forgot to sanitize $user_id before getting here.

    // Unset things first.
    $this->behalf_id = null;
    $this->behalf_name = null;
    unset($this->behalfUser);
    unset($_SESSION['behalf_id']);
    unset($_SESSION['behalf_name']);

    // No need to set if user is us.
    if ($uid == $this->id) return;

    // No need to set if user id is not valid.
    if (!$this->isUserValid($uid)) return;

    // We are good to set on behalf user.
    $onBehalfUserName = ttUserHelper::getUserName($uid);
    $_SESSION['behalf_id'] = $uid;
    $_SESSION['behalf_name'] = $onBehalfUserName;
    $this->behalf_id = $uid;
    $this->behalf_name = $onBehalfUserName;

    $this->behalfUser = new ttBehalfUser($this->behalf_id, $this->org_id);
    return;
  }

  // The exists() function determines if an active user exists in context of a page.
  // If we are working as self, true.
  // If we are working in a subgroup with active users, true.
  // If we are working in a subgroup without active users, false.
  function exists() {
    if (!$this->behalfGroup)
      return true; // Working as self.
    else if ($this->behalfGroup->active_users)
      return true; // Subgroup has users.

    return false;
  }
}
