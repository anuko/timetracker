<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttTemplateHelper');

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('tp')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_template_id = (int)$request->getParameter('id');
$template = ttTemplateHelper::get($cl_template_id);
if (!$template) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$template_to_delete = $template['name'];

$form = new Form('templateDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_template_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if (ttTemplateHelper::delete($cl_template_id)) {
      header('Location: templates.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: templates.php');
    exit();
  }
} // isPost

$smarty->assign('template_to_delete', $template_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.templateDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_template'));
$smarty->assign('content_page_name', 'template_delete.tpl');
$smarty->display('index.tpl');
