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

if ($request->isPost()) {
  $cl_field_name = trim($request->getParameter('name'));
  $cl_field_type = $request->getParameter('type');
  $cl_required = $request->getParameter('required');
  if (!$cl_required)
    $cl_required = 0;
}

$form = new Form('fieldForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>''));
$form->addInput(array('type'=>'combobox','name'=>'type',
  'data'=>array(CustomFields::TYPE_TEXT=>$i18n->get('label.type_text'),
                CustomFields::TYPE_DROPDOWN=>$i18n->get('label.type_dropdown'))
));
$form->addInput(array('type'=>'checkbox','name'=>'required'));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_field_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));

  if ($err->no()) {
    $res = CustomFields::insertField($cl_field_name, $cl_field_type, $cl_required);
    if ($res) {
      header('Location: cf_custom_fields.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.fieldForm.name.focus()"');
$smarty->assign('title', $i18n->get('title.cf_add_custom_field'));
$smarty->assign('content_page_name', 'cf_custom_field_add.tpl');
$smarty->display('index.tpl');
