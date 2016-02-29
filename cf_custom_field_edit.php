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

// Access check.
if (!ttAccessCheck(right_manage_team)) {
  header('Location: access_denied.php');
  exit();
}

$cl_id = $request->getParameter('id');
$field = CustomFields::getField($cl_id);
if (false === $field)
  $errors->add($i18n->getKey('error.db'));

$form = new Form('fieldForm');
if ($errors->isEmpty()) {
  $form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>$field['label']));
  $form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
  $form->addInput(array('type'=>'checkbox','name'=>'required','data'=>1,'value'=>$field['required']));
  $form->addInput(array('type'=>'combobox','name'=>'type','value'=>$field['type'],
    'data'=>array(CustomFields::TYPE_TEXT=>$i18n->getKey('label.type_text'),
                  CustomFields::TYPE_DROPDOWN=>$i18n->getKey('label.type_dropdown'))
  ));
  $form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->getKey('button.save')));	
}    

if ($request->getMethod() == 'POST') {
  $cl_name = trim($request->getParameter('name'));
  $cl_type = $request->getParameter('type');
  $cl_required = $request->getParameter('required');
  if (!$cl_required)
    $cl_required = 0;
  
  // Validate user input.
  if (!ttValidString($cl_name)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.thing_name'));

  if ($errors->isEmpty()) {
    $res = CustomFields::updateField($cl_id, $cl_name, $cl_type, $cl_required);
    if ($res) {
      header('Location: cf_custom_fields.php');
      exit();
    } else {
      $errors->add($i18n->getKey('error.db'));
    }
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.fieldForm.name.focus()"');
$smarty->assign('title', $i18n->getKey('title.cf_edit_custom_field'));
$smarty->assign('content_page_name', 'cf_custom_field_edit.tpl');
$smarty->display('index.tpl');
?>