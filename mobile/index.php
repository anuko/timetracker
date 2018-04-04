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

require_once('../initialize.php');

// Redirects for admin and client roles.
if ($auth->isAuthenticated()) {
  if ($user->can('administer_site')) {
    header('Location: ../admin_groups.php');
    exit();
  } elseif ($user->isClient()) {
    header('Location: ../reports.php');
    exit();
  }
}
// Redirect to time.php or mobile/time.php for other roles.
?>

<html>
  <script src="../js/strftime.js"></script>
  <script>
    location.href = "time.php?date="+(new Date()).strftime('<?php print DB_DATEFORMAT;?>');
  </script>
  <noscript>
    <p>Anuko Time Tracker is a simple, easy to use, open source, web-based time tracking system.</p>
    <p>Your browser does not support JavaScript. Time Tracker will not work without it.</p>
  </noscript>
</html>
