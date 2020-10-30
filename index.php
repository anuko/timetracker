<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');

// Redirects for admin and client roles.
if ($auth->isAuthenticated()) {
  if ($user->can('administer_site')) {
    header('Location: admin_groups.php');
    exit();
  } elseif ($user->isClient()) {
    header('Location: reports.php');
    exit();
  }
}
// html below redirects to time.php for today in browser timezone.
?>

<html>
  <script src="js/strftime.js"></script>
  <script>
    location.href = "time.php?date="+(new Date()).strftime('<?php print DB_DATEFORMAT;?>');
  </script>
  <noscript>
    <p>Anuko Time Tracker is a simple, easy to use, open source, web-based time tracking system.</p>
    <p>Your browser does not support JavaScript. Time Tracker will not work without it.</p>
  </noscript>
</html>
