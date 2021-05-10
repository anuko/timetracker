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
$cl_name = CustomFields::getOptionName($cl_id);
if (!$cl_name) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$form = new Form('optionEditForm');
if ($err->no()) {
  $form->addInput(array('type'=>'text','maxlength'=>'32','name'=>'name','value'=>$cl_name));
  $form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
  $form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
}

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));

  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));

  if ($err->no()) {
    $res = CustomFields::updateOption($cl_id, $cl_name);
    if ($res) {
      // Determine field id for redirect.
      $field_id = CustomFields::getFieldIdForOption($cl_id);
      header("Location: cf_dropdown_options.php?field_id=$field_id");
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.optionEditForm.name.focus()"');
$smarty->assign('title', $i18n->get('title.cf_edit_dropdown_option'));
$smarty->assign('content_page_name', 'cf_dropdown_option_edit.tpl');
$smarty->display('index.tpl');
