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
$id = (int)$request->getParameter('id');
$field = CustomFields::getField($id);
if (!$field) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$form = new Form('fieldDeleteForm');

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    // Delete button pressed.
    $res = CustomFields::deleteField($id);
    if ($res) {
      header('Location: cf_custom_fields.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
  if ($request->getParameter('btn_cancel')) {
    // Cancel button pressed.
    header('Location: cf_custom_fields.php');
    exit();
  }
} else {
  $form->addInput(array('type'=>'hidden','name'=>'id','value'=>$id));
  $form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
  $form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));
}

$smarty->assign('field', $field['label']);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.fieldDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.cf_delete_custom_field'));
$smarty->assign('content_page_name', 'cf_custom_field_delete.tpl');
$smarty->display('index.tpl');
