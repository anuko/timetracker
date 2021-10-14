<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttExpenseHelper');
import('ttFileHelper');

// Access checks.
if (!(ttAccessAllowed('track_own_expenses') || ttAccessAllowed('track_expenses'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('at')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_id = (int)$request->getParameter('id');
$item = ttExpenseHelper::getItemForFileView($cl_id);
if (!$item) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

if ($request->isPost()) {
  $cl_description = trim($request->getParameter('description'));
}

$fileHelper = new ttFileHelper($err);
$files = $fileHelper::getEntityFiles($cl_id, 'expense');

$form = new Form('fileUploadForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
$form->addInput(array('type'=>'upload','name'=>'newfile','value'=>$i18n->get('button.submit')));
$form->addInput(array('type'=>'textarea','name'=>'description','value'=>$cl_description));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // We are adding a new file.

  // Validate user input.
  if (!$_FILES['newfile']['name']) $err->add($i18n->get('error.upload'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  // Finished validating user input.

  if ($err->no()) {
    $fields = array('entity_type'=>'expense',
      'entity_id' => $cl_id,
      'file_name' => $_FILES['newfile']['name'],
      'description'=>$cl_description);
    if ($fileHelper->putFile($fields)) {
      header('Location: expense_files.php?id='.$cl_id);
      exit();
    }
  }
} // isPost

$smarty->assign('can_edit', $item['can_edit']);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('files', $files);
$smarty->assign('title', $i18n->get('title.expense_files'));
$smarty->assign('content_page_name', 'entity_files.tpl');
$smarty->display('index.tpl');
