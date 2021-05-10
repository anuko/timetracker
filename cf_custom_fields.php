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
// End of access checks.

$form = new Form('customFieldsForm');

if ($request->isPost()) {
  if ($request->getParameter('btn_add')) {
    // The Add button clicked. Redirect to cf_custom_field_add.php page.
    header('Location: cf_custom_field_add.php');
    exit();
  }
} else {
  $form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

  $fields = CustomFields::getFields();
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('custom_fields', $fields);
$smarty->assign('title', $i18n->get('title.cf_custom_fields'));
$smarty->assign('content_page_name', 'cf_custom_fields.tpl');
$smarty->display('index.tpl');
