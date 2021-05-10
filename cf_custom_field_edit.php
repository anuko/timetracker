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
$field = CustomFields::getField($cl_id);
if (!$field) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$form = new Form('fieldForm');
if ($err->no()) {
  $form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>$field['label']));
  $form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));

  // TODO: consider encapsulating this block in a function.
  $entity_type = $field['entity_type'];
  if (CustomFields::ENTITY_TIME == $entity_type)
    $entity = $i18n->get('entity.time');
  else if (CustomFields::ENTITY_USER == $entity_type)
    $entity = $i18n->get('entity.user');
  else if (CustomFields::ENTITY_PROJECT == $entity_type)
    $entity = $i18n->get('entity.project');
  $form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'entity','value'=>$entity,'enable'=>false));

  $form->addInput(array('type'=>'combobox','name'=>'type','value'=>$field['type'],
    'data'=>array(CustomFields::TYPE_TEXT=>$i18n->get('label.type_text'),
                  CustomFields::TYPE_DROPDOWN=>$i18n->get('label.type_dropdown'))));
  $form->addInput(array('type'=>'checkbox','name'=>'required','value'=>$field['required']));
  $form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
}

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_type = $request->getParameter('type');
  $cl_required = $request->getParameter('required');
  if (!$cl_required)
    $cl_required = 0;

  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));

  if ($err->no()) {
    $res = CustomFields::updateField($cl_id, $cl_name, $cl_type, $cl_required);
    if ($res) {
      header('Location: cf_custom_fields.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.fieldForm.name.focus()"');
$smarty->assign('title', $i18n->get('title.cf_edit_custom_field'));
$smarty->assign('content_page_name', 'cf_custom_field_edit.tpl');
$smarty->display('index.tpl');
