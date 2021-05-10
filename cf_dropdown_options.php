<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
require_once('plugins/CustomFields.class.php');
import('form.Form');

// Access checks.
if (!ttAccessAllowed('manage_custom_fields')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('cf')) {
  header('Location: feature_disabled.php');
  exit();
}
$field_id = (int)$request->getParameter('field_id');
$field = CustomFields::getField($field_id);
if (!$field) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$options = CustomFields::getOptions($field_id);

$smarty->assign('field_id', $field_id);
$smarty->assign('options', $options);
$smarty->assign('title', $i18n->get('title.cf_dropdown_options'));
$smarty->assign('content_page_name', 'cf_dropdown_options.tpl');
$smarty->display('index.tpl');
