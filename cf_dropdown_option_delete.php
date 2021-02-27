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
$cl_id = (int)$request->getParameter('id');
$option = CustomFields::getOptionName($cl_id);
if (!$option) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$form = new Form('optionDeleteForm');

if ($request->isPost()) {

  // Determine field id for redirect.
  $field_id = CustomFields::getFieldIdForOption($cl_id);
  if ($request->getParameter('btn_delete'))  {
    // Delete button pressed.
    $res = CustomFields::deleteOption($cl_id);
    if ($res) {
      header("Location: cf_dropdown_options.php?field_id=$field_id");
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
  if ($request->getParameter('btn_cancel')) {
    // Cancel button pressed.
    header("Location: cf_dropdown_options.php?field_id=$field_id");
    exit();
  }
} else {
  $form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
  $form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
  $form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));
}

$smarty->assign('option', $option);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.optionDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.cf_delete_dropdown_option'));
$smarty->assign('content_page_name', 'cf_dropdown_option_delete.tpl');
$smarty->display('index.tpl');
