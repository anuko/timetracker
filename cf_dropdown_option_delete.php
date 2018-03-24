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

$cl_id = $request->getParameter('id');
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
  $option = CustomFields::getOptionName($cl_id);
  if (false === $option)
    $err->add($i18n->get('error.db'));

  if ($err->no()) {
    $form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
    $form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
    $form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));
  }
}

$smarty->assign('option', $option);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.optionDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.cf_delete_dropdown_option'));
$smarty->assign('content_page_name', 'cf_dropdown_option_delete.tpl');
$smarty->display('index.tpl');
