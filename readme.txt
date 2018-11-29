Anuko Time Tracker
Copyright (c) Anuko (https://www.anuko.com)

Project home page: https://www.anuko.com/time_tracker/index.htm
Forum: https://www.anuko.com/forum/viewforum.php?f=4
Info for developers: https://www.anuko.com/time_tracker/info_for_developers.htm
Free hosting of Time Tracker for individuals and small groups is available at https://timetracker.anuko.com

Unless otherwise noted, files in this archive are protected by the LIBERAL FREEWARE LICENSE.
Read the file license.txt for details.


INSTALLATION INSTRUCTIONS

Documentation is available at https://www.anuko.com/time_tracker/install_guide/index.htm

The general installation procedure looks like this:

- Install a web server and make sure it can serve HTML documents.
- Install PHP, configure your server to work with PHP scripts, and make sure it can work with PHP files.
- Install the following PHP extensions: mbstring and GD. The GD extension is needed for pie-charts only.
- Install a database server such as MySQL and make sure it is working properly.
- Install, configure, and test Anuko Time Tracker like so:

1) Unpack distribution files into a selected directory for your web server.
2) Allow writing to WEB-INF/templates_c/. Some hosting providers like Hostmonster additionally require files having 644 and directories 755. Otherwise you'll see error 500 (bad permissions, writable by group).
3) Create a database using the mysql.sql file in the distribution.
4) Create user name and password to access the time tracker database.
5) Create a config file by coping WEB-INF/config.php.dist to WEB-INF/config.php.
6) Change $dsn value in /WEB-INF/config.php file to reflect your database connection parameters (user name and password).
7) If you are upgrading from earlier Time Tracker version run dbinstall.php from your browser and do only the required "Update database structure" steps.
8) If you install time tracker into a sub-directory of your site reflect this in the APP_NAME parameter in /WEB-INF/config.php file. For example, for http://localhost/timetracker/ set APP_NAME = "timetracker".
9) Login to your time tracker site as admin with password "secret" without quotes and create at least one group.
10) Change admin password (on the admin "options" page). You can also use the following SQL console command:
  update tt_users set password = md5('new_password_here') where login='admin'
  or by using the "Change password of administrator account" option in http://your_time_tracker_site/dbinstall.php
11) Test if everything is working.
12) Remove dbinstall.php file from your installation directory.


UPGRADE FROM EARLIER VERSIONS

See https://www.anuko.com/time_tracker/upgrade.htm


BLANK PAGES IN TIME TRACKER

If you see a blank page in when trying to access Anuko Time Tracker it may mean many things, among others, such as:

    * Time tracker database not created.
    * Access (login / password) to the database is not configured properly in config.php.
    * MySQL service is down.
    * On UNIX systems - no full access rights for catalog WEB-INF/templates_c/ (chmod 777 templates_c).

You need to thoroughly test each and every component to make sure they work together nicely.


INSTALLATION / UPGRADES / DATA MIGRATION HELP

Support is available on per-incident basis - see https://www.anuko.com/support.htm


CHANGE LOG

Change log is available at https://www.anuko.com/time_tracker/change_log/index.htm