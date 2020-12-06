<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttProjectHelper');
import('ttFileHelper');

// Access checks.
if (!(ttAccessAllowed('view_own_projects') || ttAccessAllowed('manage_projects'))) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS != $user->getTrackingMode() && MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_project_id = (int)$request->getParameter('id');
$project = ttProjectHelper::get($cl_project_id);
if (!$project) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

if ($request->isPost()) {
  $cl_description = trim($request->getParameter('description'));
}

$fileHelper = new ttFileHelper($err);
$files = $fileHelper::getEntityFiles($cl_project_id, 'project');

$form = new Form('fileUploadForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_project_id));
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
    $fields = array('entity_type'=>'project',
      'entity_id' => $cl_project_id,
      'file_name' => $_FILES['newfile']['name'],
      'description'=>$cl_description);
    if ($fileHelper->putFile($fields)) {
      header('Location: project_files.php?id='.$cl_project_id);
      exit();
    }
  }
} // isPost

$smarty->assign('can_edit', $user->can('manage_projects'));
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('files', $files);
$smarty->assign('title', $i18n->get('title.project_files').': '.$project['name']);
$smarty->assign('content_page_name', 'entity_files2.tpl');
$smarty->display('index2.tpl');
