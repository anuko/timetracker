<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');

$err->add($i18n->get('error.access_denied'));
if ($auth->isAuthenticated()) $smarty->assign('authenticated', true); // Used in header.tpl for menu display.

$smarty->assign('title', $i18n->get('label.error'));
$smarty->assign('content_page_name', 'access_denied2.tpl');
$smarty->display('index2.tpl');
