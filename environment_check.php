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

echo('<h2>Environment check</h2>');

// Require the configuration file with application settings.
if (file_exists(APP_DIR."/WEB-INF/config.php")) {
  echo('WEB-INF/config.php file exists.<br>');
} else {
  echo('<font color="red">Error: WEB-INF/config.php file does not exist.</font><br>');
}

// Check whether DSN is defined.
if (defined('DSN')) {
  echo('DSN is defined as '.DSN.'<br>');
} else {
  echo('<font color="red">Error: DSN value is not defined. Check your config.php file.</font><br>');
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
  echo('<font color="red">Error: there are no tables in database. Use dbinstall.php.</font><br>');
}
$conn->disconnect();
