<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');

$msg->add($i18n->get('msg.success'));
if ($auth->isAuthenticated()) $smarty->assign('authenticated', true); // Used in header.tpl for menu display.

$smarty->assign('title', $i18n->get('title.success'));
$smarty->assign('content_page_name', 'success.tpl');
$smarty->display('index.tpl');
