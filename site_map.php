<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');

// Access checks.
// No need.
// End of access checks.

// Determine is user is authenticated or not.
global $auth;
$authenticated = $auth->isAuthenticated(); // This call assigns 'authenticated' to smarty.

// $smarty->assign('title', $i18n->get('form.label.menu'));
$smarty->assign('content_page_name', 'site_map.tpl');
$smarty->display('index2.tpl');
