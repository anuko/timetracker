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

$field_id = $request->getParameter('field_id');
$options = CustomFields::getOptions($field_id);
if (false === $options)
  $err->add($i18n->get('error.db'));

$form = new Form('dropdownOptionsForm');

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('field_id', $field_id);
$smarty->assign('options', $options);
$smarty->assign('title', $i18n->get('title.cf_dropdown_options'));
$smarty->assign('content_page_name', 'cf_dropdown_options.tpl');
$smarty->display('index.tpl');
