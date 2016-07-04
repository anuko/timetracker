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

require_once('WEB-INF/config.php');
require_once('WEB-INF/lib/common.lib.php');
require_once('initialize.php');
import('ttUserHelper');
import('ttTaskHelper');

function setChange($sql) {
  print "<pre>".$sql."</pre>";
  $mdb2 = getConnection();
  $affected = $mdb2->exec($sql);
  if (is_a($affected, 'PEAR_Error'))
    print "error: ".$affected->getMessage()."<br>";
  else
    print "successful update<br>\n";
}


if ($_POST) {
  print "Processing...<br>\n";

  if ($_POST["crstructure"]) {
    $sqlQuery = join("\n", file("mysql.sql"));
    $sqlQuery = str_replace("TYPE=MyISAM","",$sqlQuery);
    $queries  = explode(";",$sqlQuery);
    if (is_array($queries)) {
      foreach ($queries as $query) {
        $query = trim($query);
        if (strlen($query)>0) {
          setChange($query);
        }
      }
    }
  }

  if ($_POST["convert5to7"]) {
    setChange("alter table `activity_log` CHANGE al_comment al_comment BLOB");
    setChange("CREATE TABLE `sysconfig` (`sysc_id` int(11) unsigned NOT NULL auto_increment,`sysc_name` varchar(32) NOT NULL default '',`sysc_value` varchar(70) default NULL, PRIMARY KEY  (`sysc_id`), UNIQUE KEY `sysc_id` (`sysc_id`), UNIQUE KEY `sysc_name` (`sysc_name`))");
    setChange("alter table `companies` add c_locktime int(4) default -1");
    setChange("alter table `activity_log` add al_billable tinyint(4) default 0");
    setChange("alter table `sysconfig` drop INDEX `sysc_name`");
    setChange("alter table `sysconfig` add sysc_id_u int(4)");
    setChange("alter table `report_filter_set` add rfs_billable VARCHAR(10)");
    setChange("ALTER TABLE clients MODIFY clnt_id int(11) NOT NULL AUTO_INCREMENT");
    setChange("ALTER TABLE `users` ADD `u_show_pie` smallint(2) DEFAULT '1'");
    setChange("alter table `users` ADD `u_pie_mode` smallint(2) DEFAULT '1'");
    setChange("alter table users drop `u_aprojects`");
  }

  if ($_POST["convert7to133"]) {
    setChange("ALTER TABLE users ADD COLUMN u_lang VARCHAR(20) DEFAULT NULL");
    setChange("ALTER TABLE users ADD COLUMN u_email VARCHAR(100) DEFAULT NULL");
    setChange("ALTER TABLE `activity_log` drop `al_proof`");
    setChange("ALTER TABLE `activity_log` drop `al_charge`");
    setChange("ALTER TABLE `activities` drop `a_project_id`");
    setChange("DROP TABLE `activity_status_list`");
    setChange("DROP TABLE `project_status_list`");
    setChange("DROP TABLE `user_status_list`");
    setChange("DROP TABLE `companies_c_id_seq`");
    setChange("ALTER TABLE projects ADD COLUMN p_activities TEXT");
  }

  // The update_projects function updates p_activities field in the projects table so that we could
  // improve performance of the application by using this field instead of activity_bind table.
  if ($_POST["update_projects"]) {
    $mdb2 = getConnection();
    // $sql = "select p_id from projects where p_status = 1 and p_activities is NULL";
    $sql = "select p_id from projects where p_status = 1";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      die($res->getMessage());
    }
    // Iterate through projects.
    while ($val = $res->fetchRow()) {
      $project_id = $val['p_id'];

      // Get activity binds for project (old way).
      // $sql = "select ab_id_a from activity_bind where ab_id_p = $project_id";
      $sql = "select ab_id_a, a_id, a_name from activity_bind
        inner join activities on (ab_id_a = a_id)
        where ab_id_p = $project_id order by a_name";

      $result = $mdb2->query($sql);
      if (is_a($result, 'PEAR_Error')) {
        die($result->getMessage());
      }
      $activity_arr = array();
      while ($value = $result->fetchRow()) {
        $activity_arr[] = $value['ab_id_a'];
      }
      $a_comma_separated = implode(",", $activity_arr); // This is a comma-separated list of associated activity ids.

      // Re-bind the project to activities (new way).
      $sql = "update projects set p_activities = ".$mdb2->quote($a_comma_separated)." where p_id = $project_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) {
        die($affected->getMessage());
      }
    }
  }

  if ($_POST["convert133to1340"]) {
    setChange("ALTER TABLE companies ADD COLUMN c_show_pie smallint(2) DEFAULT 1");
    setChange("ALTER TABLE companies ADD COLUMN c_pie_mode smallint(2) DEFAULT 1");
    setChange("ALTER TABLE companies ADD COLUMN c_lang varchar(20) default NULL");
  }

  // The update_companies function sets up c_show_pie, c_pie_mode, and c_lang
  // fields in the companies table from the corresponding manager fields. 
  if ($_POST["update_companies"]) {
    $mdb2 = getConnection();
    // Get all active managers.
    $sql = "select u_company_id, u_show_pie, u_pie_mode, u_lang from users
      where u_manager_id is NULL and u_login <> 'admin' and u_company_id is not NULL and u_active = 1"; 
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      die($res->getMessage());
    }
    // Iterate through managers and set fields in the companies table.
    while ($val = $res->fetchRow()) {
      $company_id = $val['u_company_id'];
      $show_pie = $val['u_show_pie'];
      $pie_mode = $val['u_pie_mode'];
      $lang = $val['u_lang'];

      $sql = "update companies set
        c_show_pie = $show_pie, c_pie_mode = $pie_mode, c_lang = ".$mdb2->quote($lang).
        " where c_id = $company_id";

      $result = $mdb2->query($sql);
      if (is_a($result, 'PEAR_Error')) {
        die($result->getMessage());
      }
    }
  }

  if ($_POST["convert1340to1485"]) {
    setChange("ALTER TABLE users DROP u_show_pie");
    setChange("ALTER TABLE users DROP u_pie_mode");
    setChange("ALTER TABLE users DROP u_lang");
    setChange("ALTER TABLE `users` modify u_login varchar(100) NOT NULL");
    setChange("ALTER TABLE `users` modify u_active smallint(6) default '1'");
    setChange("drop index u_login_idx on users");
    setChange("create unique index u_login_idx on users(u_login, u_active)");
    setChange("ALTER TABLE companies MODIFY `c_lang` varchar(20) NOT NULL default 'en'");
    setChange("ALTER TABLE companies ADD COLUMN `c_date_format` varchar(20) NOT NULL default '%Y-%m-%d'");
    setChange("ALTER TABLE companies ADD COLUMN `c_time_format` varchar(20) NOT NULL default '%H:%M'");
    setChange("ALTER TABLE companies ADD COLUMN `c_week_start` smallint(2) NOT NULL DEFAULT '0'");
    setChange("ALTER TABLE clients MODIFY `clnt_status` smallint(6) default '1'");
    setChange("create unique index clnt_name_idx on clients(clnt_id_um, clnt_name, clnt_status)");
    setChange("ALTER TABLE projects modify p_status smallint(6) default '1'");
    setChange("update projects set p_status = NULL where p_status = 1000");
    setChange("drop index p_manager_idx on projects");
    setChange("create unique index p_name_idx on projects(p_manager_id, p_name, p_status)");
    setChange("ALTER TABLE activities modify a_status smallint(6) default '1'");
    setChange("update activities set a_status = NULL where a_status = 1000");
    setChange("drop index a_manager_idx on activities");
    setChange("create unique index a_name_idx on activities(a_manager_id, a_name, a_status)");
    setChange("RENAME TABLE companies TO teams");
    setChange("RENAME TABLE teams TO att_teams");
    setChange("ALTER TABLE att_teams CHANGE c_id id int(11) NOT NULL auto_increment");
    setChange("RENAME TABLE users TO att_users");
    setChange("update att_users set u_company_id = 0 where u_company_id is NULL");
    setChange("ALTER TABLE att_users CHANGE u_company_id team_id int(11) NOT NULL");
    setChange("RENAME TABLE att_teams TO tt_teams");
    setChange("RENAME TABLE att_users TO tt_users");
    setChange("ALTER TABLE tt_teams CHANGE c_name name varchar(80) NOT NULL");
    setChange("ALTER TABLE `tt_teams` drop `c_www`");
    setChange("ALTER TABLE `tt_teams` MODIFY `name` varchar(80) default NULL");
    setChange("ALTER TABLE clients ADD COLUMN `your_name` varchar(255) default NULL");
    setChange("ALTER TABLE tt_teams ADD COLUMN `address` varchar(255) default NULL");
    setChange("ALTER TABLE invoice_header ADD COLUMN `client_name` varchar(255) default NULL");
    setChange("ALTER TABLE invoice_header ADD COLUMN `client_addr` varchar(255) default NULL");
    setChange("ALTER TABLE report_filter_set ADD COLUMN `rfs_cb_cost` tinyint(4) default '0'");
    setChange("ALTER TABLE activity_log DROP primary key");
    setChange("ALTER TABLE activity_log ADD COLUMN `id` bigint NOT NULL auto_increment primary key"); 
    setChange("CREATE TABLE `tt_custom_fields` (`id` int(11) NOT NULL auto_increment, `team_id` int(11) NOT NULL, `type` tinyint(4) NOT NULL default '0', `label` varchar(32) NOT NULL default '', PRIMARY KEY (`id`))");
    setChange("CREATE TABLE `tt_custom_field_options` (`id` int(11) NOT NULL auto_increment, `field_id` int(11) NOT NULL, `value` varchar(32) NOT NULL default '', PRIMARY KEY (`id`))");
    setChange("CREATE TABLE `tt_custom_field_log` (`id` bigint NOT NULL auto_increment, `al_id` bigint NOT NULL, `field_id` int(11) NOT NULL, `value` varchar(255) default NULL, PRIMARY KEY (`id`))");
    setChange("ALTER TABLE tt_users DROP u_level");
    setChange("ALTER TABLE tt_custom_fields ADD COLUMN `status` tinyint(4) default '1'");
    setChange("ALTER TABLE report_filter_set ADD COLUMN `rfs_cb_cf_1` tinyint(4) default '0'");
    setChange("ALTER TABLE tt_teams ADD COLUMN `plugins` varchar(255) default NULL");
    setChange("ALTER TABLE tt_teams MODIFY c_locktime int(4) default '0'");
    setChange("ALTER TABLE clients DROP your_name");
    setChange("ALTER TABLE clients DROP clnt_addr_your");
    setChange("ALTER TABLE `tt_custom_fields` ADD COLUMN `required` tinyint(4) default '0'");
    setChange("ALTER TABLE tt_teams DROP c_pie_mode");
    setChange("RENAME TABLE report_filter_set TO tt_fav_reports");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_id id int(11) unsigned NOT NULL auto_increment");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_name name varchar(200) NOT NULL");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_id_u user_id int(11) NOT NULL");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_id_p project_id int(11) default NULL");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_id_a task_id int(11) default NULL");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_users users text default NULL");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_period period tinyint(4) default NULL");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_period_start period_start date default NULL");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_period_finish period_end date default NULL");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_project show_project tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_activity show_task tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_note show_note tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_start show_start tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_finish show_end tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_duration show_duration tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_cost show_cost tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_cf_1 show_custom_field_1 tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_idle show_empty_days tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_cb_totals_only show_totals_only tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_groupby group_by varchar(20) default NULL");
    setChange("ALTER TABLE tt_fav_reports CHANGE rfs_billable billable tinyint(4) default NULL");
    setChange("ALTER TABLE projects CHANGE p_activities tasks text default NULL");
    setChange("ALTER TABLE tt_teams CHANGE c_currency currency varchar(7) default NULL");
    setChange("ALTER TABLE tt_teams CHANGE c_locktime locktime int(4) default '0'");
    setChange("ALTER TABLE tt_teams CHANGE c_show_pie show_pie smallint(2) DEFAULT '1'");
    setChange("ALTER TABLE tt_teams CHANGE c_lang lang varchar(10) NOT NULL default 'en'");
    setChange("ALTER TABLE tt_teams CHANGE c_date_format date_format varchar(20) NOT NULL default '%Y-%m-%d'");
    setChange("ALTER TABLE tt_teams CHANGE c_time_format time_format varchar(20) NOT NULL default '%H:%M'");
    setChange("ALTER TABLE tt_teams CHANGE c_week_start week_start smallint(2) NOT NULL DEFAULT '0'");
    setChange("ALTER TABLE tt_users CHANGE u_id id int(11) NOT NULL auto_increment");
    setChange("ALTER TABLE tt_users CHANGE u_timestamp timestamp timestamp NOT NULL");
    setChange("ALTER TABLE tt_users CHANGE u_login login varchar(50) NOT NULL");
    setChange("drop index u_login_idx on tt_users");
    setChange("create unique index login_idx on tt_users(login, u_active)");
    setChange("ALTER TABLE tt_users CHANGE u_password password varchar(50) default NULL");
    setChange("ALTER TABLE tt_users CHANGE u_name name varchar(100) default NULL");
    setChange("ALTER TABLE tt_users CHANGE u_email email varchar(100) default NULL");
    setChange("ALTER TABLE tt_users CHANGE u_rate rate float(6,2) NOT NULL default '0.00'");
    setChange("update tt_users set u_active = NULL where u_active = 1000");
    setChange("ALTER TABLE tt_users CHANGE u_active status tinyint(4) default '1'");
    setChange("ALTER TABLE tt_teams ADD COLUMN status tinyint(4) default '1'");
    setChange("ALTER TABLE tt_users ADD COLUMN role int(11) default '4'");
    setChange("update tt_users set role = 1024 where login = 'admin'");
    setChange("update tt_users set role = 68 where u_comanager = 1");
    setChange("update tt_users set role = 324 where u_manager_id is null and login != 'admin'");
    setChange("ALTER TABLE user_bind CHANGE ub_checked status tinyint(4) default '1'");
    setChange("ALTER TABLE activities ADD COLUMN team_id int(11) NOT NULL");
    setChange("ALTER TABLE clients ADD COLUMN team_id int(11) NOT NULL");
    setChange("ALTER TABLE projects ADD COLUMN team_id int(11) NOT NULL");
  }

  // The update_to_team_id function sets team_id field projects, activities, and clients tables.
  if ($_POST["update_to_team_id"]) {
    $mdb2 = getConnection();

    // Update projects.
    $sql = "select p_id, p_manager_id from projects where team_id = 0 limit 1000";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      die($res->getMessage());
    }
    // Iterate through projects.
    $projects_updated = 0;
    while ($val = $res->fetchRow()) {
      $project_id = $val['p_id'];
      $manager_id = $val['p_manager_id'];

      $sql = "select team_id from tt_users where id = $manager_id";
      $res2 = $mdb2->query($sql);
      if (is_a($res2, 'PEAR_Error')) {
        die($res2->getMessage());
      }
      $val2 = $res2->fetchRow();
      $team_id = $val2['team_id'];

      if ($team_id) {
        $sql = "update projects set team_id = $team_id where p_id = $project_id";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error')) {
          die($affected->getMessage());
        }
        $projects_updated += $affected;	
      }
    }
    print "Updated $projects_updated projects...<br>\n";

    // Update tasks.
    $sql = "select a_id, a_manager_id from activities where team_id = 0 limit 1000";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      die($res->getMessage());
    }
    // Iterate through tasks.
    $tasks_updated = 0;
    while ($val = $res->fetchRow()) {
      $task_id = $val['a_id'];
      $manager_id = $val['a_manager_id'];

      $sql = "select team_id from tt_users where id = $manager_id";
      $res2 = $mdb2->query($sql);
      if (is_a($res2, 'PEAR_Error')) {
        die($res2->getMessage());
      }
      $val2 = $res2->fetchRow();
      $team_id = $val2['team_id'];

      if ($team_id) {
        $sql = "update activities set team_id = $team_id where a_id = $task_id";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error')) {
          die($affected->getMessage());
        }
        $tasks_updated += $affected;
      }
    }
    print "Updated $tasks_updated tasks...<br>\n";

    // Update clients.
    $sql = "select clnt_id, clnt_id_um from clients where team_id = 0 limit 1000";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      die($res->getMessage());
    }
    // Iterate through clients.
    $clients_updated = 0;
    while ($val = $res->fetchRow()) {
      $client_id = $val['clnt_id'];
      $manager_id = $val['clnt_id_um'];

      $sql = "select team_id from tt_users where id = $manager_id";
      $res2 = $mdb2->query($sql);
      if (is_a($res2, 'PEAR_Error')) {
        die($res2->getMessage());
      }
      $val2 = $res2->fetchRow();
      $team_id = $val2['team_id'];

      if ($team_id) {
        $sql = "update clients set team_id = $team_id where clnt_id = $client_id";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error')) {
          die($affected->getMessage());
        }
        $clients_updated += $affected;
      }
    }
    print "Updated $clients_updated clients...<br>\n";
  }

  if ($_POST["convert1485to1579"]) {
    setChange("ALTER TABLE tt_fav_reports MODIFY id int(11) NOT NULL auto_increment");
    setChange("RENAME TABLE clients TO tt_clients");
    setChange("ALTER TABLE tt_clients CHANGE clnt_id id int(11) NOT NULL AUTO_INCREMENT");
    setChange("ALTER TABLE tt_clients CHANGE clnt_status status tinyint(4) default '1'");
    setChange("ALTER TABLE tt_clients DROP clnt_id_um");
    setChange("ALTER TABLE tt_clients CHANGE clnt_name name varchar(80) NOT NULL");
    setChange("drop index clnt_name_idx on tt_clients");
    setChange("drop index client_name_idx on tt_clients");
    setChange("create unique index client_name_idx on tt_clients(team_id, name, status)");
    setChange("ALTER TABLE tt_teams ADD COLUMN `timestamp` timestamp NOT NULL");
    setChange("ALTER TABLE tt_clients CHANGE clnt_addr_cust address varchar(255) default NULL");
    setChange("ALTER TABLE tt_clients DROP clnt_discount");
    setChange("ALTER TABLE tt_clients DROP clnt_comment");
    setChange("ALTER TABLE tt_clients DROP clnt_fsubtotals");
    setChange("ALTER TABLE tt_clients CHANGE clnt_tax tax float(6,2) NOT NULL default '0.00'");
    setChange("ALTER TABLE activity_log ADD COLUMN client_id int(11) default NULL");
    setChange("ALTER TABLE tt_teams DROP show_pie");
    setChange("ALTER TABLE tt_fav_reports CHANGE group_by sort_by varchar(20) default 'date'");
    setChange("RENAME TABLE tmp_refs TO tt_tmp_refs");
    setChange("ALTER TABLE tt_tmp_refs CHANGE tr_created timestamp timestamp NOT NULL");
    setChange("ALTER TABLE tt_tmp_refs CHANGE tr_code ref char(32) NOT NULL default ''");
    setChange("ALTER TABLE tt_tmp_refs CHANGE tr_userid user_id int(11) NOT NULL");
    setChange("RENAME TABLE projects TO tt_projects");
    setChange("ALTER TABLE tt_projects CHANGE p_id id int(11) NOT NULL auto_increment");
    setChange("ALTER TABLE tt_projects DROP p_timestamp");
    setChange("ALTER TABLE tt_projects CHANGE p_name name varchar(80) NOT NULL");
    setChange("ALTER TABLE tt_projects CHANGE p_status status tinyint(4) default '1'");
    setChange("drop index p_name_idx on tt_projects");
    setChange("create unique index project_idx on tt_projects(team_id, name, status)");
    setChange("RENAME TABLE activities TO tt_tasks");
    setChange("ALTER TABLE tt_tasks CHANGE a_id id int(11) NOT NULL auto_increment");
    setChange("ALTER TABLE tt_tasks DROP a_timestamp");
    setChange("ALTER TABLE tt_tasks CHANGE a_name name varchar(80) NOT NULL");
    setChange("ALTER TABLE tt_tasks CHANGE a_status status tinyint(4) default '1'");
    setChange("drop index a_name_idx on tt_tasks");
    setChange("create unique index task_idx on tt_tasks(team_id, name, status)");
    setChange("RENAME TABLE invoice_header TO tt_invoice_headers");
    setChange("ALTER TABLE tt_invoice_headers CHANGE ih_user_id user_id int(11) NOT NULL");
    setChange("ALTER TABLE tt_invoice_headers CHANGE ih_number number varchar(20) default NULL");
    setChange("ALTER TABLE tt_invoice_headers DROP ih_addr_your");
    setChange("ALTER TABLE tt_invoice_headers DROP ih_addr_cust");
    setChange("ALTER TABLE tt_invoice_headers CHANGE ih_comment comment varchar(255) default NULL");
    setChange("ALTER TABLE tt_invoice_headers CHANGE ih_tax tax float(6,2) default '0.00'");
    setChange("ALTER TABLE tt_invoice_headers CHANGE ih_discount discount float(6,2) default '0.00'");
    setChange("ALTER TABLE tt_invoice_headers CHANGE ih_fsubtotals subtotals tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_users DROP u_comanager");
    setChange("ALTER TABLE tt_tasks DROP a_manager_id");
    setChange("ALTER TABLE tt_projects DROP p_manager_id");
    setChange("ALTER TABLE tt_users DROP u_manager_id");
    setChange("ALTER TABLE activity_bind DROP ab_id");
    setChange("RENAME TABLE activity_bind TO tt_project_task_binds");
    setChange("ALTER TABLE tt_project_task_binds CHANGE ab_id_p project_id int(11) NOT NULL");
    setChange("ALTER TABLE tt_project_task_binds CHANGE ab_id_a task_id int(11) NOT NULL");
    setChange("RENAME TABLE user_bind TO tt_user_project_binds");
    setChange("ALTER TABLE tt_user_project_binds CHANGE ub_rate rate float(6,2) NOT NULL default '0.00'");
    setChange("ALTER TABLE tt_user_project_binds CHANGE ub_id_p project_id int(11) NOT NULL");
    setChange("ALTER TABLE tt_user_project_binds CHANGE ub_id_u user_id int(11) NOT NULL");
    setChange("ALTER TABLE tt_user_project_binds CHANGE ub_id id int(11) NOT NULL auto_increment");
    setChange("CREATE TABLE `tt_client_project_binds` (`client_id` int(11) NOT NULL, `project_id` int(11) NOT NULL)");
    setChange("ALTER TABLE tt_user_project_binds MODIFY rate float(6,2) default '0.00'");
    setChange("ALTER TABLE tt_clients MODIFY tax float(6,2) default '0.00'");
    setChange("RENAME TABLE activity_log TO tt_log");
    setChange("ALTER TABLE tt_log CHANGE al_timestamp timestamp timestamp NOT NULL");
    setChange("ALTER TABLE tt_log CHANGE al_user_id user_id int(11) NOT NULL");
    setChange("ALTER TABLE tt_log CHANGE al_date date date NOT NULL");
    setChange("drop index al_date_idx on tt_log");
    setChange("create index date_idx on tt_log(date)");
    setChange("ALTER TABLE tt_log CHANGE al_from start time default NULL");
    setChange("ALTER TABLE tt_log CHANGE al_duration duration time default NULL");
    setChange("ALTER TABLE tt_log CHANGE al_project_id project_id int(11) NOT NULL");
    setChange("ALTER TABLE tt_log MODIFY project_id int(11) default NULL");
    setChange("ALTER TABLE tt_log CHANGE al_activity_id task_id int(11) default NULL");
    setChange("ALTER TABLE tt_log CHANGE al_comment comment blob");
    setChange("ALTER TABLE tt_log CHANGE al_billable billable tinyint(4) default '0'");
    setChange("drop index al_user_id_idx on tt_log");
    setChange("drop index al_project_id_idx on tt_log");
    setChange("drop index al_activity_id_idx on tt_log");
    setChange("create index user_idx on tt_log(user_id)");
    setChange("create index project_idx on tt_log(project_id)");
    setChange("create index task_idx on tt_log(task_id)");
    setChange("ALTER TABLE tt_custom_field_log CHANGE al_id log_id bigint NOT NULL");
    setChange("RENAME TABLE sysconfig TO tt_config");
    setChange("ALTER TABLE tt_config DROP sysc_id");
    setChange("ALTER TABLE tt_config CHANGE sysc_id_u user_id int(11) NOT NULL");
    setChange("ALTER TABLE tt_config CHANGE sysc_name param_name varchar(32) NOT NULL");
    setChange("ALTER TABLE tt_config CHANGE sysc_value param_value varchar(80) default NULL");
    setChange("create unique index param_idx on tt_config(user_id, param_name)");
    setChange("ALTER TABLE tt_log ADD COLUMN invoice_id int(11) default NULL");
    setChange("ALTER TABLE tt_projects ADD COLUMN description varchar(255) default NULL");
    setChange("CREATE TABLE `tt_invoices` (`id` int(11) NOT NULL auto_increment, `team_id` int(11) NOT NULL, `number` varchar(20) default NULL, `client_name` varchar(255) default NULL, `client_addr` varchar(255) default NULL, `comment` varchar(255) default NULL, `tax` float(6,2) default '0.00', `discount` float(6,2) default '0.00', PRIMARY KEY (`id`))");
    setChange("ALTER TABLE tt_invoices drop number");
    setChange("ALTER TABLE tt_invoices drop client_name");
    setChange("ALTER TABLE tt_invoices drop client_addr");
    setChange("ALTER TABLE tt_invoices drop comment");
    setChange("ALTER TABLE tt_invoices drop tax");
    setChange("ALTER TABLE tt_invoices ADD COLUMN name varchar(80) NOT NULL");
    setChange("ALTER TABLE tt_invoices ADD COLUMN client_id int(11) NOT NULL");
    setChange("ALTER TABLE tt_invoices ADD COLUMN start_date date NOT NULL");
    setChange("ALTER TABLE tt_invoices ADD COLUMN end_date date NOT NULL");
    setChange("create unique index name_idx on tt_invoices(team_id, name)");
    setChange("drop index ub_id_u on tt_user_project_binds");
    setChange("create unique index bind_idx on tt_user_project_binds(user_id, project_id)");
    setChange("create index client_idx on tt_log(client_id)");
    setChange("create index invoice_idx on tt_log(invoice_id)");
  }

  if ($_POST["convert1579to1600"]) {
    setChange("ALTER TABLE tt_invoices ADD COLUMN date date NOT NULL");
    setChange("ALTER TABLE tt_teams ADD COLUMN custom_logo tinyint(4) default '0'");
    setChange("ALTER TABLE tt_tasks ADD COLUMN description varchar(255) default NULL");
    setChange("ALTER TABLE tt_projects MODIFY name varchar(80) COLLATE utf8_bin NOT NULL");
    setChange("ALTER TABLE tt_users MODIFY login varchar(50) COLLATE utf8_bin NOT NULL");
    setChange("ALTER TABLE tt_tasks MODIFY name varchar(80) COLLATE utf8_bin NOT NULL");
    setChange("ALTER TABLE tt_invoices MODIFY name varchar(80) COLLATE utf8_bin NOT NULL");
    setChange("ALTER TABLE tt_clients MODIFY name varchar(80) COLLATE utf8_bin NOT NULL");
    setChange("ALTER TABLE tt_clients ADD COLUMN projects text default NULL");
    setChange("ALTER TABLE tt_custom_field_log ADD COLUMN option_id int(11) default NULL");
    setChange("ALTER TABLE tt_teams ADD COLUMN tracking_mode smallint(2) NOT NULL DEFAULT '2'");
    setChange("ALTER TABLE tt_teams ADD COLUMN record_type smallint(2) NOT NULL DEFAULT '0'");
    setChange("ALTER TABLE tt_invoices DROP start_date");
    setChange("ALTER TABLE tt_invoices DROP end_date");
  }

  if ($_POST["convert1600to1900"]) {
    setChange("DROP TABLE IF EXISTS tt_invoice_headers");
    setChange("ALTER TABLE tt_fav_reports ADD COLUMN `client_id` int(11) default NULL");
    setChange("ALTER TABLE tt_fav_reports ADD COLUMN `cf_1_option_id` int(11) default NULL");
    setChange("ALTER TABLE tt_fav_reports ADD COLUMN `show_client` tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports ADD COLUMN `show_invoice` tinyint(4) NOT NULL default '0'");
    setChange("ALTER TABLE tt_fav_reports ADD COLUMN `group_by` varchar(20) default NULL");
    setChange("CREATE TABLE `tt_expense_items` (`id` bigint NOT NULL auto_increment, `date` date NOT NULL, `user_id` int(11) NOT NULL, `client_id` int(11) default NULL, `project_id` int(11) default NULL, `name` varchar(255) NOT NULL, `cost` decimal(10,2) default '0.00', `invoice_id` int(11) default NULL, PRIMARY KEY  (`id`))");
    setChange("create index date_idx on tt_expense_items(date)");
    setChange("create index user_idx on tt_expense_items(user_id)");
    setChange("create index client_idx on tt_expense_items(client_id)");
    setChange("create index project_idx on tt_expense_items(project_id)");
    setChange("create index invoice_idx on tt_expense_items(invoice_id)");
    setChange("ALTER TABLE tt_fav_reports DROP sort_by");
    setChange("ALTER TABLE tt_fav_reports DROP show_empty_days");
    setChange("ALTER TABLE tt_invoices DROP discount");
    setChange("ALTER TABLE tt_users ADD COLUMN `client_id` int(11) default NULL");
    setChange("ALTER TABLE tt_teams ADD COLUMN `decimal_mark` char(1) NOT NULL default '.'");
    setChange("ALTER TABLE tt_fav_reports ADD COLUMN `invoice` tinyint(4) default NULL");
    setChange("CREATE TABLE `tt_cron` (`id` int(11) NOT NULL auto_increment, `cron_spec` varchar(255) NOT NULL, `last` int(11) default NULL, `next` int(11) default NULL, `report_id` int(11) default NULL, `email` varchar(100) default NULL, `status` tinyint(4) default '1', PRIMARY KEY (`id`))");
    setChange("ALTER TABLE tt_cron ADD COLUMN `team_id` int(11) NOT NULL");
    setChange("create index client_idx on tt_client_project_binds(client_id)");
    setChange("create index project_idx on tt_client_project_binds(project_id)");
    setChange("ALTER TABLE tt_log ADD COLUMN status tinyint(4) default '1'");
    setChange("ALTER TABLE tt_custom_field_log ADD COLUMN status tinyint(4) default '1'");
    setChange("ALTER TABLE tt_expense_items ADD COLUMN status tinyint(4) default '1'");
    setChange("ALTER TABLE tt_invoices ADD COLUMN status tinyint(4) default '1'");
    setChange("DROP INDEX name_idx on tt_invoices");
    setChange("create unique index name_idx on tt_invoices(team_id, name, status)");
    setChange("ALTER TABLE tt_teams ADD COLUMN lock_spec varchar(255) default NULL");
    setChange("ALTER TABLE tt_teams DROP locktime");
  }
  
  if ($_POST["convert1900to1930"]){
    setChange("CREATE TABLE `tt_monthly_quota` (`team_id` int(11) NOT NULL, `year` smallint(5) UNSIGNED NOT NULL, `month` tinyint(3) UNSIGNED NOT NULL, `quota` smallint(5) UNSIGNED NOT NULL, PRIMARY KEY (`year`,`month`,`team_id`))");
    setChange("ALTER TABLE `tt_monthly_quota` ADD CONSTRAINT `FK_TT_TEAM_CONSTRAING` FOREIGN KEY (`team_id`) REFERENCES `tt_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
    setChange("ALTER TABLE `tt_teams` ADD `daily_working_hours` SMALLINT NULL DEFAULT '8' AFTER `lock_spec`");
    setChange("UPDATE `tt_teams` SET `daily_working_hours` = 8");
  }
  
  // The update_clients function updates projects field in tt_clients table.
  if ($_POST["update_clients"]) {
    $mdb2 = getConnection();
    $sql = "select id from tt_clients where status = 1 or status = 0";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) {
      die($res->getMessage());
    }

    $clients_updated = 0;
    // Iterate through clients.
    while ($val = $res->fetchRow()) {
      $client_id = $val['id'];

      // Get projects binds for client.
      $sql = "select cpb.project_id from tt_client_project_binds cpb
        left join tt_projects p on (p.id = cpb.project_id)
        where cpb.client_id = $client_id order by p.name";

      $result = $mdb2->query($sql);
      if (is_a($result, 'PEAR_Error'))
        die($result->getMessage());

      $project_arr = array();
      while ($value = $result->fetchRow()) {
        $project_arr[] = $value['project_id'];	
      }
      $comma_separated = implode(',', $project_arr); // This is a comma-separated list of associated project ids.

      // Update the projects field.
      $sql = "update tt_clients set projects = ".$mdb2->quote($comma_separated)." where id = $client_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        die($affected->getMessage());
      $clients_updated += $affected;
    }
    print "Updated $clients_updated clients...<br>\n";
  }

  // The update_custom_fields function updates option_id field field in tt_custom_field_log table.
  if ($_POST['update_custom_fields']) {
    $mdb2 = getConnection();
    $sql = "update tt_custom_field_log set option_id = value where field_id in (select id from tt_custom_fields where type = 2)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      die($affected->getMessage());

    print "Updated $affected custom fields...<br>\n";
  }

  // The update_tracking_mode function sets the tracking_mode field in tt_teams table to 2 (== MODE_PROJECTS_AND_TASKS).
  if ($_POST['update_tracking_mode']) {
    $mdb2 = getConnection();
    $sql = "update tt_teams set tracking_mode = 2 where tracking_mode = 0";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      die($affected->getMessage());

    print "Updated $affected teams...<br>\n";
  }

  if ($_POST["cleanup"]) {

    $mdb2 = getConnection();
    $inactive_teams = ttTeamHelper::getInactiveTeams();

    $count = count($inactive_teams);
    print "$count inactive teams found...<br>\n";
    for ($i = 0; $i < $count; $i++) {
      print "  deleting team ".$inactive_teams[$i]."<br>\n";
      $res = ttTeamHelper::delete($inactive_teams[$i]);
    }

    setChange("OPTIMIZE TABLE tt_client_project_binds");
    setChange("OPTIMIZE TABLE tt_clients");
    setChange("OPTIMIZE TABLE tt_config");
    setChange("OPTIMIZE TABLE tt_custom_field_log");
    setChange("OPTIMIZE TABLE tt_custom_field_options");
    setChange("OPTIMIZE TABLE tt_custom_fields"); 
    setChange("OPTIMIZE TABLE tt_expense_items");
    setChange("OPTIMIZE TABLE tt_fav_reports");
    setChange("OPTIMIZE TABLE tt_invoices");
    setChange("OPTIMIZE TABLE tt_log");
    setChange("OPTIMIZE TABLE tt_monthly_quota");
    setChange("OPTIMIZE TABLE tt_project_task_binds");
    setChange("OPTIMIZE TABLE tt_projects");
    setChange("OPTIMIZE TABLE tt_tasks");
    setChange("OPTIMIZE TABLE tt_teams");
    setChange("OPTIMIZE TABLE tt_tmp_refs");
    setChange("OPTIMIZE TABLE tt_user_project_binds");
    setChange("OPTIMIZE TABLE tt_users");
  }

  print "done.<br>\n";
}
?>
<html>
<body>
<div align="center">
<form method="POST">
<h2>DB Install</h2>
<table width="80%" border="1" cellpadding="10" cellspacing="0">
  <tr>
    <td width="80%"><b>Create database structure (v1.9.30)</b>
    <br>(applies only to new installations, do not execute when updating)</br></td><td><input type="submit" name="crstructure" value="Create"></td>
  </tr>
</table>

<h2>Updates</h2>

<table width="80%" border="1" cellpadding="10" cellspacing="0">
  <tr valign="top">
    <td>Update database structure (v0.5 to v0.7)</td><td><input type="submit" name="convert5to7" value="Update"></td>
  </tr>
  <tr valign="top">
    <td>Update database structure (v0.7 to v1.3.3)</td>
    <td><input type="submit" name="convert7to133" value="Update"><br><input type="submit" name="update_projects" value="Update projects"></td>
  </tr>
  <tr valign="top">
    <td>Update database structure (v1.3.3 to v1.3.40)</td>
    <td><input type="submit" name="convert133to1340" value="Update"><br><input type="submit" name="update_companies" value="Update companies"></td>
  </tr>
  <tr valign="top">
    <td>Update database structure (v1.3.40 to v1.4.85)</td>
    <td><input type="submit" name="convert1340to1485" value="Update"><br><input type="submit" name="update_to_team_id" value="Update team_id"></td>
  </tr>
  <tr valign="top">
    <td>Update database structure (v1.4.85 to v1.5.79)</td>
    <td><input type="submit" name="convert1485to1579" value="Update"></td>
  </tr>
  <tr valign="top">
    <td>Update database structure (v1.5.79 to v1.6)</td>
    <td><input type="submit" name="convert1579to1600" value="Update"><br><input type="submit" name="update_clients" value="Update clients"><br><input type="submit" name="update_custom_fields" value="Update custom fields"><br><input type="submit" name="update_tracking_mode" value="Update tracking mode"></td>
  </tr>
  <tr valign="top">
    <td>Update database structure (v1.6 to v1.9)</td>
    <td><input type="submit" name="convert1600to1900" value="Update"><br></td>
  </tr>
  <tr valign="top">
    <td>Update database structure (v1.9 to v1.9.30)</td>
    <td><input type="submit" name="convert1900to1930" value="Update"><br></td>
  </tr>
</table>

<h2>DB Maintenance</h2>
<table width="80%" border="1" cellpadding="10" cellspacing="0">
  <tr>
    <td width="80%">Clean up DB from inactive teams</td><td><input type="submit" name="cleanup" value="Clean up"></td>
  </tr>
</table>

</form>
</div>
</body>
</html>