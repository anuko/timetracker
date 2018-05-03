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
import('ttRoleHelper');

// setChange - executes an sql statement. TODO: rename this function to something better.
// Better yet, redo the entire thing and make an installer.
function setChange($sql) {
  print "<pre>".$sql."</pre>";
  $mdb2 = getConnection();
  $affected = $mdb2->exec($sql);
  if (is_a($affected, 'PEAR_Error'))
    print "error: ".$affected->getMessage()."<br>";
  else
    print "successful update<br>\n";
}


if ($request->isGet()) {
  echo('<h2>Environment Checks</h2>');

  // Check if WEB-INF/templates_c dir is writable.
  if (is_writable(APP_DIR.'/WEB-INF/templates_c/')) {
    echo('WEB-INF/templates_c/ directory is writable.<br>');
  } else {
    echo('<font color="red">Error: WEB-INF/templates_c/ directory is not writable.</font><br>');
  }

  // Require the configuration file with application settings.
  if (file_exists(APP_DIR."/WEB-INF/config.php")) {
    echo('WEB-INF/config.php file exists.<br>');

    // Config file must start with the PHP opening tag. We are checking this because
    // a Unicode editor may insert a byte order mark (BOM) before it. This is not good as it will
    // spit white space before output in some situations such as in PDF reports.
    $file = fopen(APP_DIR.'/WEB-INF/config.php', 'r');
    $line = fgets($file);
    if (strcmp("<?php\n", $line) !== 0 && strcmp("<?php\r\n", $line) !== 0) {
      echo('<font color="red">Error: WEB-INF/config.php file does not start with PHP opening tag.</font><br>');
    }
    fclose($file);
  } else {
    echo('<font color="red">Error: WEB-INF/config.php file does not exist.</font><br>');
  }

  // Check whether DSN is defined.
  if (defined('DSN')) {
    // echo('DSN is defined as '.DSN.'<br>');
    echo('DSN is defined.<br>');
  } else {
    echo('<font color="red">Error: DSN value is not defined. Check your config.php file.</font><br>');
  }

  // Check if PHP version is good enough.
  // $required_version = '5.2.1'; // Something in TCPDF library does not work below this one.
  $required_version = '5.4.0';    // Week view (week.php) requires 5.4 because of []-way of referencing arrays.
                                  // This needs further investigation as we use [] elsewhere without obvious problems.
  if (version_compare(phpversion(), $required_version, '>=')) {
    echo('PHP version: '.phpversion().', good enough.<br>');
  } else {
    echo('<font color="red">Error: PHP version is not high enough: '.phpversion().'. Required: '.$required_version.'.</font><br>');
  }

  // Depending on DSN, require either mysqli or mysql extensions.
  if (strrpos(DSN, 'mysqli://', -strlen(DSN)) !== FALSE) {
    if (extension_loaded('mysqli')) {
      echo('mysqli PHP extension is loaded.<br>');
    } else {
      echo('<font color="red">Error: mysqli PHP extension is required but is not loaded.</font><br>');
    }
  }
  if (strrpos(DSN, 'mysql://', -strlen(DSN)) !== FALSE) {
    if (extension_loaded('mysql')) {
      echo('mysql PHP extension is loaded.<br>');
    } else {
      echo('<font color="red">Error: mysql PHP extension is required but is not loaded.</font><br>');
    }
  }

  // Check mbstring extension.
  if (extension_loaded('mbstring')) {
    echo('mbstring PHP extension is loaded.<br>');
  } else {
    echo('<font color="red">Error: mbstring PHP extension is not loaded.</font><br>');
  }

  // Check gd extension.
  if (extension_loaded('gd')) {
    echo('gd PHP extension is loaded.<br>');
  } else {
    echo('<font color="red">Error: gd PHP extension is not loaded. It is required for charts plugin.</font><br>');
  }

  // Check ldap extension.
  if (AUTH_MODULE == 'ldap') {
    if (extension_loaded('ldap_')) {
      echo('ldap PHP extension is loaded.<br>');
    } else {
      echo('<font color="red">Error: ldap PHP extension is not loaded. It is required for LDAP authentication.</font><br>');
    }
  }

  // Check database access.
  require_once('MDB2.php');
  $conn = MDB2::connect(DSN);
  if (!is_a($conn, 'MDB2_Error')) {
    echo('Connection to database successful.<br>');
  } else {
    die('<font color="red">Error: connection to database failed. '.$conn->getMessage().'</font><br>');
  }

  $conn->setOption('debug', true);
  $conn->setFetchMode(MDB2_FETCHMODE_ASSOC);

  $sql = "show tables";
  $res = $conn->query($sql);
  if (is_a($res, 'MDB2_Error')) {
    die('<font color="red">Error: show tables returned an error. '.$res->getMessage().'</font><br>');
  }
  $tblCnt = 0;
  while ($val = $res->fetchRow()) {
    $tblCnt++;
  }
  if ($tblCnt > 0) {
    echo("There are $tblCnt tables in database.<br>");
  } else {
    echo('<font color="red">There are no tables in database. Execute step 1 - Create database structure.</font><br>');
  }

  $sql = "select param_value from tt_site_config where param_name = 'version_db'";
  $res = $conn->query($sql);
  if (is_a($res, 'MDB2_Error')) {
    echo('<font color="red">Error: database schema version query failed. '.$res->getMessage().'</font><br>');
  } else {
    $val = $res->fetchRow();
    echo('Database version is: '.$val['param_value'].'.');
  }

  $conn->disconnect();
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
    setChange("alter table `activity_log` CHANGE al_comment al_comment text");
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
    setChange("ALTER TABLE tt_log CHANGE al_comment comment text");
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

  if ($_POST["convert1600to11400"]) {
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
    setChange("CREATE TABLE `tt_monthly_quota` (`team_id` int(11) NOT NULL, `year` smallint(5) UNSIGNED NOT NULL, `month` tinyint(3) UNSIGNED NOT NULL, `quota` smallint(5) UNSIGNED NOT NULL, PRIMARY KEY (`year`,`month`,`team_id`))");
    setChange("ALTER TABLE `tt_monthly_quota` ADD CONSTRAINT `FK_TT_TEAM_CONSTRAING` FOREIGN KEY (`team_id`) REFERENCES `tt_teams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
    setChange("ALTER TABLE `tt_teams` ADD `workday_hours` SMALLINT NULL DEFAULT '8' AFTER `lock_spec`");
    setChange("RENAME TABLE tt_monthly_quota TO tt_monthly_quotas");
    setChange("ALTER TABLE tt_expense_items modify `name` text NOT NULL");
    setChange("ALTER TABLE `tt_teams` ADD `uncompleted_indicators` SMALLINT(2) NOT NULL DEFAULT '0' AFTER `record_type`");
    setChange("CREATE TABLE `tt_predefined_expenses` (`id` int(11) NOT NULL auto_increment, `team_id` int(11) NOT NULL, `name` varchar(255) NOT NULL, `cost` decimal(10,2) default '0.00', PRIMARY KEY  (`id`))");
    setChange("ALTER TABLE `tt_teams` ADD `task_required` smallint(2) NOT NULL DEFAULT '0' AFTER `tracking_mode`");
    setChange("ALTER TABLE `tt_teams` ADD `project_required` smallint(2) NOT NULL DEFAULT '0' AFTER `tracking_mode`");
    setChange("ALTER TABLE `tt_cron` ADD `report_condition` varchar(255) default NULL AFTER `email`");
    setChange("ALTER TABLE `tt_fav_reports` ADD `status` tinyint(4) default '1'");
    setChange("ALTER TABLE `tt_teams` ADD `bcc_email` varchar(100) default NULL AFTER `uncompleted_indicators`");
    setChange("ALTER TABLE `tt_cron` ADD `cc` varchar(100) default NULL AFTER `email`");
    setChange("ALTER TABLE `tt_cron` ADD `subject` varchar(100) default NULL AFTER `cc`");
    setChange("ALTER TABLE `tt_log` ADD `paid` tinyint(4) NULL default '0' AFTER `billable`");
  }

  if ($_POST["convert11400to11744"]) {
    setChange("ALTER TABLE `tt_teams` DROP `address`");
    setChange("ALTER TABLE `tt_fav_reports` ADD `report_spec` text default NULL AFTER `user_id`");
    setChange("ALTER TABLE `tt_fav_reports` ADD `paid_status` tinyint(4) default NULL AFTER `invoice`");
    setChange("ALTER TABLE `tt_fav_reports` ADD `show_paid` tinyint(4) NOT NULL DEFAULT '0' AFTER `show_invoice`");
    setChange("ALTER TABLE `tt_expense_items` ADD `paid` tinyint(4) NULL default '0' AFTER `invoice_id`");
    setChange("ALTER TABLE `tt_monthly_quotas` MODIFY `quota` decimal(5,2) NOT NULL");
    setChange("ALTER TABLE `tt_teams` MODIFY `workday_hours` decimal(5,2) DEFAULT '8.00'");
    setChange("ALTER TABLE `tt_teams` ADD `config` text default NULL AFTER `custom_logo`");
    setChange("ALTER TABLE `tt_monthly_quotas` ADD `minutes` int(11) DEFAULT NULL");
    setChange("ALTER TABLE `tt_teams` ADD `workday_minutes` smallint(4) DEFAULT '480' AFTER `workday_hours`");
    setChange("UPDATE `tt_teams` SET `workday_minutes` = 60 * `workday_hours`");
    setChange("ALTER TABLE `tt_teams` DROP `workday_hours`");
    setChange("UPDATE `tt_monthly_quotas` SET `minutes` = 60 * `quota`");
    setChange("ALTER TABLE `tt_monthly_quotas` DROP `quota`");
    setChange("ALTER TABLE `tt_teams` DROP `uncompleted_indicators`");
    setChange("ALTER TABLE `tt_users` MODIFY `timestamp` timestamp default CURRENT_TIMESTAMP");
    setChange("ALTER TABLE `tt_teams` MODIFY `timestamp` timestamp default CURRENT_TIMESTAMP");
    setChange("ALTER TABLE `tt_log` MODIFY `timestamp` timestamp default CURRENT_TIMESTAMP");
    setChange("ALTER TABLE `tt_tmp_refs` MODIFY `timestamp` timestamp default CURRENT_TIMESTAMP");
    setChange("CREATE TABLE `tt_roles` (`id` int(11) NOT NULL auto_increment, `team_id` int(11) NOT NULL, `name` varchar(80) default NULL, `rank` int(11) default 0, `rights` text default NULL, `status` tinyint(4) default 1, PRIMARY KEY (`id`))");
    setChange("create unique index role_idx on tt_roles(team_id, rank, status)");
    setChange("ALTER TABLE `tt_roles` ADD `description` varchar(255) default NULL AFTER `name`");
    setChange("ALTER TABLE `tt_users` ADD `role_id` int(11) default NULL AFTER `role`");
    setChange("CREATE TABLE `tt_site_config` (`param_name` varchar(32) NOT NULL, `param_value` text default NULL, `created` datetime default NULL, `updated` datetime default NULL, PRIMARY KEY (`param_name`))");
    setChange("INSERT INTO `tt_site_config` (`param_name`, `param_value`, `created`) VALUES ('version_db', '1.17.34', now())");
    setChange("INSERT INTO `tt_roles` (`team_id`, `name`, `rank`, `rights`) VALUES (0, 'Site administrator', 1024, 'administer_site')");
    setChange("INSERT INTO `tt_roles` (`team_id`, `name`, `rank`, `rights`) VALUES (0, 'Top manager', 512, 'data_entry,view_own_data,manage_own_settings,view_users,on_behalf_data_entry,view_data,override_punch_mode,swap_roles,approve_timesheets,manage_users,manage_projects,manage_tasks,manage_custom_fields,manage_clients,manage_invoices,manage_features,manage_basic_settings,manage_advanced_settings,manage_roles,export_data,manage_subgroups')");
    setChange("UPDATE `tt_site_config` SET `param_value` = '1.17.35' where param_name = 'version_db'");
    setChange("update `tt_users` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.35') set role_id = (select id from tt_roles where rank = 1024) where role = 1024");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.35') set rights = 'data_entry,view_own_reports,view_own_charts,view_own_invoices,manage_own_settings,view_users,on_behalf_data_entry,view_reports,view_charts,override_punch_mode,swap_roles,approve_timesheets,manage_users,manage_projects,manage_tasks,manage_custom_fields,manage_clients,manage_invoices,manage_features,manage_basic_settings,manage_advanced_settings,manage_roles,export_data,manage_subgroups' where team_id = 0 and rank = 512");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.35') set rights = replace(rights, 'view_own_data', 'view_own_reports,view_own_charts') where team_id > 0");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.35') set rights = replace(rights, 'view_data', 'view_reports,view_charts') where team_id > 0");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.35') set rights = replace(rights, 'view_own_charts,manage_own_settings', 'view_own_charts,view_own_invoices,manage_own_settings') where team_id > 0 and rank = 16");
    setChange("UPDATE `tt_site_config` SET `param_value` = '1.17.40' where param_name = 'version_db'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.40') set rights = replace(rights, 'on_behalf_data_entry', 'track_time,track_expenses')");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.40') set rights = replace(rights, 'data_entry', 'track_own_time,track_own_expenses')");
    setChange("UPDATE `tt_site_config` SET `param_value` = '1.17.43' where param_name = 'version_db'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.43') set rights = replace(rights, 'override_punch_mode,swap_roles', 'override_punch_mode,override_date_lock,swap_roles')");
    setChange("UPDATE `tt_site_config` SET `param_value` = '1.17.44' where param_name = 'version_db'");
  }

  // The update_role_id function assigns a role_id to users, who don't have it.
  if ($_POST['update_role_id']) {
    import('I18n');

    $mdb2 = getConnection();

    $sql = "select u.id, u.team_id, u.role, t.lang from tt_users u inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.44') left join tt_teams t on (u.team_id = t.id) where u.role_id is NULL and u.status is NOT NULL";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) die($res->getMessage());

    $users_updated = 0;
    // Iterate through users.
    while ($val = $res->fetchRow()) {

      $user_id = $val['id'];
      $team_id = $val['team_id'];
      $lang = $val['lang'];
      $legacy_role = $val['role'];
  
      $sql = "select count(*) as count from tt_roles where team_id = $team_id";
      $result = $mdb2->query($sql);
      if (is_a($result, 'PEAR_Error')) die($result->getMessage());
      $row = $result->fetchRow();
      if ($row['count'] == 0)
        ttRoleHelper::createPredefinedRoles($team_id, $lang);

      // Obtain new role id based on legacy role.
      $role_id = ttRoleHelper::getRoleByRank($legacy_role, $team_id);
      if (!$role_id) continue; // Role not found, nothing to do.

      $sql = "update tt_users set role_id = $role_id where id = $user_id and team_id = $team_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) die($affected->getMessage());

      $users_updated++;
      // if ($users_updated >= 1000) break; // TODO: uncomment for large user sets to run multiple times.
    }
    print "Updated $users_updated users...<br>\n";
  }

  if ($_POST["convert11744to11788"]) {
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.44') set rights = replace(rights, 'override_punch_mode,override_date_lock', 'override_punch_mode,override_own_punch_mode,override_date_lock')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.48' where param_name = 'version_db' and param_value = '1.17.44'");
    setChange("update `tt_users` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.48') set role_id = (select id from tt_roles where team_id = 0 and rank = 512) where role = 324");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.49' where param_name = 'version_db' and param_value = '1.17.48'");
    setChange("ALTER TABLE `tt_users` drop role");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.50' where param_name = 'version_db' and param_value = '1.17.49'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.50') set rights = replace(rights, 'override_date_lock,swap_roles', 'override_date_lock,override_own_date_lock,swap_roles')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.51' where param_name = 'version_db' and param_value = '1.17.50'");
    setChange("ALTER TABLE `tt_users` ADD `created` datetime default NULL AFTER `email`");
    setChange("ALTER TABLE `tt_users` ADD `created_ip` varchar(45) default NULL AFTER `created`");
    setChange("ALTER TABLE `tt_users` ADD `created_by` int(11) default NULL AFTER `created_ip`");
    setChange("ALTER TABLE `tt_users` ADD `modified` datetime default NULL AFTER `created_by`");
    setChange("ALTER TABLE `tt_users` ADD `modified_ip` varchar(45) default NULL AFTER `modified`");
    setChange("ALTER TABLE `tt_users` ADD `modified_by` int(11) default NULL AFTER `modified_ip`");
    setChange("ALTER TABLE `tt_users` ADD `accessed` datetime default NULL AFTER `modified_by`");
    setChange("ALTER TABLE `tt_users` ADD `accessed_ip` varchar(45) default NULL AFTER `accessed`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.52' where param_name = 'version_db' and param_value = '1.17.51'");
    setChange("ALTER TABLE `tt_site_config` CHANGE `updated` `modified` datetime default NULL");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.53', modified = now() where param_name = 'version_db' and param_value = '1.17.52'");
    setChange("ALTER TABLE `tt_log` ADD `created` datetime default NULL AFTER `paid`");
    setChange("ALTER TABLE `tt_log` ADD `created_ip` varchar(45) default NULL AFTER `created`");
    setChange("ALTER TABLE `tt_log` ADD `created_by` int(11) default NULL AFTER `created_ip`");
    setChange("ALTER TABLE `tt_log` ADD `modified` datetime default NULL AFTER `created_by`");
    setChange("ALTER TABLE `tt_log` ADD `modified_ip` varchar(45) default NULL AFTER `modified`");
    setChange("ALTER TABLE `tt_log` ADD `modified_by` int(11) default NULL AFTER `modified_ip`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.56', modified = now() where param_name = 'version_db' and param_value = '1.17.53'");
    setChange("ALTER TABLE `tt_expense_items` ADD `created` datetime default NULL AFTER `paid`");
    setChange("ALTER TABLE `tt_expense_items` ADD `created_ip` varchar(45) default NULL AFTER `created`");
    setChange("ALTER TABLE `tt_expense_items` ADD `created_by` int(11) default NULL AFTER `created_ip`");
    setChange("ALTER TABLE `tt_expense_items` ADD `modified` datetime default NULL AFTER `created_by`");
    setChange("ALTER TABLE `tt_expense_items` ADD `modified_ip` varchar(45) default NULL AFTER `modified`");
    setChange("ALTER TABLE `tt_expense_items` ADD `modified_by` int(11) default NULL AFTER `modified_ip`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.59', modified = now() where param_name = 'version_db' and param_value = '1.17.56'");
    setChange("ALTER TABLE `tt_fav_reports` ADD `show_ip` tinyint(4) NOT NULL DEFAULT '0' AFTER `show_paid`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.61', modified = now() where param_name = 'version_db' and param_value = '1.17.59'");
    setChange("update `tt_log` l inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.61') set l.created = l.timestamp where l.created is null");
    setChange("ALTER TABLE `tt_log` drop `timestamp`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.64', modified = now() where param_name = 'version_db' and param_value = '1.17.61'");
    setChange("ALTER TABLE `tt_teams` ADD `created` datetime default NULL AFTER `config`");
    setChange("ALTER TABLE `tt_teams` ADD `created_ip` varchar(45) default NULL AFTER `created`");
    setChange("ALTER TABLE `tt_teams` ADD `created_by` int(11) default NULL AFTER `created_ip`");
    setChange("ALTER TABLE `tt_teams` ADD `modified` datetime default NULL AFTER `created_by`");
    setChange("ALTER TABLE `tt_teams` ADD `modified_ip` varchar(45) default NULL AFTER `modified`");
    setChange("ALTER TABLE `tt_teams` ADD `modified_by` int(11) default NULL AFTER `modified_ip`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.65', modified = now() where param_name = 'version_db' and param_value = '1.17.64'");
    setChange("update `tt_teams` t inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.65') set t.created = t.timestamp where t.created is null");
    setChange("update `tt_users` u inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.65') set u.created = u.timestamp where u.created is null");
    setChange("ALTER TABLE `tt_teams` drop `timestamp`");
    setChange("ALTER TABLE `tt_users` drop `timestamp`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.66', modified = now() where param_name = 'version_db' and param_value = '1.17.65'");
    setChange("ALTER TABLE `tt_tmp_refs` ADD `created` datetime default NULL AFTER `timestamp`");
    setChange("ALTER TABLE `tt_tmp_refs` drop `timestamp`");
    setChange("delete from `tt_tmp_refs`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.67', modified = now() where param_name = 'version_db' and param_value = '1.17.66'");
    setChange("ALTER TABLE `tt_teams` ADD `parent_id` int(11) default NULL AFTER `id`");
    setChange("ALTER TABLE `tt_teams` ADD `org_id` int(11) default NULL AFTER `parent_id`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.76', modified = now() where param_name = 'version_db' and param_value = '1.17.67'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.76') set rights = replace(rights, ',manage_users', ',manage_own_account,manage_users')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.77', modified = now() where param_name = 'version_db' and param_value = '1.17.76'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.77') set rights = replace(rights, 'manage_own_settings,view_users', 'manage_own_settings,view_projects,view_users')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.78', modified = now() where param_name = 'version_db' and param_value = '1.17.77'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.78') set rights = replace(rights, 'manage_own_settings,view_projects,view_users', 'view_own_projects,manage_own_settings,view_users')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.79', modified = now() where param_name = 'version_db' and param_value = '1.17.78'");
    setChange("RENAME TABLE `tt_teams` TO `tt_groups`");
    setChange("ALTER TABLE `tt_monthly_quotas` DROP FOREIGN KEY FK_TT_TEAM_CONSTRAING");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.80', modified = now() where param_name = 'version_db' and param_value = '1.17.79'");
    setChange("ALTER TABLE `tt_roles` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("ALTER TABLE `tt_users` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("ALTER TABLE `tt_projects` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("ALTER TABLE `tt_tasks` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("ALTER TABLE `tt_invoices` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("ALTER TABLE `tt_cron` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("ALTER TABLE `tt_clients` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("ALTER TABLE `tt_custom_fields` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("ALTER TABLE `tt_predefined_expenses` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("ALTER TABLE `tt_monthly_quotas` CHANGE `team_id` `group_id` int(11) NOT NULL");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.81', modified = now() where param_name = 'version_db' and param_value = '1.17.80'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.81') set rights = replace(rights, ',manage_invoices', ',manage_invoices,view_all_reports')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.82', modified = now() where param_name = 'version_db' and param_value = '1.17.81'");
    setChange("ALTER TABLE `tt_groups` ADD `allow_ip` varchar(255) default NULL AFTER `bcc_email`");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.82') set rights = replace(rights, 'manage_invoices,view_all_reports', 'manage_invoices,override_allow_ip,view_all_reports')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.83', modified = now() where param_name = 'version_db' and param_value = '1.17.82'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.83') set rights = replace(rights, 'view_own_projects,manage_own_settings', 'view_own_projects,view_own_tasks,manage_own_settings')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.84', modified = now() where param_name = 'version_db' and param_value = '1.17.83'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.84') set rights = replace(rights, 'view_charts,override_punch_mode', 'view_charts,view_own_clients,override_punch_mode')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.85', modified = now() where param_name = 'version_db' and param_value = '1.17.84'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.85') set rights = replace(rights, 'override_allow_ip,view_all_reports', 'override_allow_ip,manage_basic_settings,view_all_reports')");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.85') set rights = replace(rights, 'manage_features,manage_basic_setting,manage_advanced_settings', 'manage_features,manage_advanced_settings')");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.86', modified = now() where param_name = 'version_db' and param_value = '1.17.85'");
    setChange("ALTER TABLE `tt_groups` ADD `password_complexity` varchar(64) default NULL AFTER `allow_ip`");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.87', modified = now() where param_name = 'version_db' and param_value = '1.17.86'");
    setChange("update `tt_roles` inner join `tt_site_config` sc on (sc.param_name = 'version_db' and sc.param_value = '1.17.87') set rights = replace(rights, 'manage_subgroups', 'manage_subgroups,delete_group') where rank = 512");
    setChange("UPDATE `tt_site_config` SET param_value = '1.17.88', modified = now() where param_name = 'version_db' and param_value = '1.17.87'");
  }

  if ($_POST["cleanup"]) {

    $mdb2 = getConnection();
    $inactive_groups = ttTeamHelper::getInactiveGroups();

    $count = count($inactive_groups);
    print "$count inactive groups found...<br>\n";
    for ($i = 0; $i < $count; $i++) {
      print "  deleting group ".$inactive_groups[$i]."<br>\n";
      $res = ttTeamHelper::delete($inactive_groups[$i]);
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
    setChange("OPTIMIZE TABLE tt_monthly_quotas");
    setChange("OPTIMIZE TABLE tt_project_task_binds");
    setChange("OPTIMIZE TABLE tt_projects");
    setChange("OPTIMIZE TABLE tt_tasks");
    setChange("OPTIMIZE TABLE tt_groups");
    setChange("OPTIMIZE TABLE tt_tmp_refs");
    setChange("OPTIMIZE TABLE tt_user_project_binds");
    setChange("OPTIMIZE TABLE tt_users");
    setChange("OPTIMIZE TABLE tt_roles");
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
    <td width="80%"><b>Create database structure (v1.17.88)</b>
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
    <td>Update database structure (v1.6 to v1.14)</td>
    <td><input type="submit" name="convert1600to11400" value="Update"><br></td>
  </tr>
  <tr valign="top">
    <td>Update database structure (v1.14 to v1.17.44)</td>
    <td><input type="submit" name="convert11400to11744" value="Update"><br><input type="submit" name="update_role_id" value="Update role_id"></td>
  </tr>
    <tr valign="top">
    <td>Update database structure (v1.17.44 to v1.17.88)</td>
    <td><input type="submit" name="convert11744to11788" value="Update"></td>
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
