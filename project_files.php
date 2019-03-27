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
$files = $fileHelper::getProjectFiles($cl_project_id);

$form = new Form('fileUploadForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_project_id));
$form->addInput(array('type'=>'upload','name'=>'newfile','value'=>$i18n->get('button.submit'),'maxsize'=>67108864)); // 64 MB file upload limit.
// Note: for the above limit to work make sure to set upload_max_filesize and post_max_size in php.ini to at least 64M.
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
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
    } else
      $err->add($i18n->get('error.file_storage'));
  }
} // isPost

$smarty->assign('can_manage', $user->can('manage_projects'));
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('files', $files);
$smarty->assign('title', $i18n->get('title.project_files'));
$smarty->assign('content_page_name', 'project_files.tpl');
$smarty->display('index.tpl');
