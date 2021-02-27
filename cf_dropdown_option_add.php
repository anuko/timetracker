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
$cl_field_id = (int)$request->getParameter('field_id');
$field = CustomFields::getField($cl_field_id);
if (!$field) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$form = new Form('optionAddForm');
if ($err->no()) {
  $form->addInput(array('type'=>'hidden','name'=>'field_id','value'=>$cl_field_id));
  $form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>''));
  $form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));
}

if ($request->isPost()) {
  $cl_option_name = trim($request->getParameter('name'));

  // Validate user input.
  if (!ttValidString($cl_option_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));

  if ($err->no()) {
    $res = CustomFields::insertOption($cl_field_id, $cl_option_name);
    if ($res) {
      header("Location: cf_dropdown_options.php?field_id=$cl_field_id");
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.optionAddForm.name.focus()"');
$smarty->assign('title', $i18n->get('title.cf_add_dropdown_option'));
$smarty->assign('content_page_name', 'cf_dropdown_option_add.tpl');
$smarty->display('index.tpl');
