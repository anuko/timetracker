PEAR integration notes.

These notes explain how PEAR and its modules were integrated in Anuko Time Tracker project.

PEAR packages can be downloaded from http://pear.php.net/packages.php 
(click on the package group, then package name, then Download link).
For example, for PEAR it will be http://pear.php.net/package/PEAR/download


PEAR PACKAGE

- Download PEAR package from http://pear.php.net/package/PEAR/download
- Extract the files (what is in the deepest PEAR-1.9.1 folder) into WEB-INF/lib/pear/ folder in Time Tracker, so that you have something like:

folders:

OS
PEAR
scripts

and files

INSTALL
LICENSE
and others in your WEB-INF/lib/pear/ folder.


DB PACKAGES

NOTE: currently we are trying migrate from the old DB package to a newer MDB2 package.
This is why we have (temporarily) both of them here.
When the migration is finished the DB module will be removed.

DB PACKAGE
- Download DB module from http://pear.php.net/package/DB/download
- From archive DB-1.7.14RC1.tgz take "DB.php" file and DB folder and put them into WEB-INF/lib/pear

MDB2 PACKAGE
- Download MDB2 module from http://pear.php.net/package/MDB2/download
- From archive MDB2-2.5.0b3.tgz take "MDB2.php" file and MDB2 folder and put them into WEB-INF/lib/pear

MDB2_Driver_mysql package
- Download MDB2_Driver_mysql module from http://pear.php.net/package/MDB2_Driver_mysql/download
- From archive MDB2_Driver_mysql_1.5.0b3.tgz merge the content of MDB2 folder with your WEB-INF/lib/pear/MDB2
(a collection of mysql.php files organized in a directory structure).

If you need Time Tracker to work with non mysql data sources install additional MDB2 drivers
(similarly to MDB2_Driver_mysql).


Net_SMTP PACKAGE

- Download Net_SMTP module from http://pear.php.net/package/Net_SMTP/download
- From archive Net_SMTP-1.4.2.tgz take the "SMTP.php" file and put it into WEB-INF/lib/pear/Net(you will need to create the Net folder).


Net_Socket PACKAGE

- Download Net_Socket module (dependency of Net_SMTP) from http://pear.php.net/package/Net_Socket/download
- From archive Net_Socket-1.0.9.tgz take the "Socket.php" file and put it into WEB-INF/lib/pear/Net folder.


Mail PACKAGE

- Download Mail module from http://pear.php.net/package/Mail/download
- From archive Mail-1.2.0.tgz take "Mail.php" file and Mail folder. Put them in WEB-INF/lib/pear folder.

Now we have PEAR, and PEAR DB, PEAR MDB2, PEAR Net_SMTP, PEAR Mail modules installed.



Add this line to any place in config.php.dist to set PHP include path for PEAR and its modules:

set_include_path(realpath(dirname(__FILE__).'/lib/pear') . PATH_SEPARATOR . get_include_path());

Note: it is important to include realpath(dirname(__FILE__).'/lib/pear') first to eliminate any potential
PEAR compatibility issues for systems where another version of PEAR may be installed (like SME Server 8.0).