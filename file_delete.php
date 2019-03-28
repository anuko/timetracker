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
import('ttFileHelper');
import('ttProjectHelper');

// Access checks.
$cl_file_id = (int)$request->getParameter('id');
$file = ttFileHelper::get($cl_file_id);
if (!$file) {
  header('Location: access_denied.php');
  exit();
}
// Entity-specific checks.
if ($file['entity_type'] == 'project') {
  if (!ttAccessAllowed('manage_projects') || !ttProjectHelper::get($file['entity_id'])) {
    header('Location: access_denied.php');
    exit();
  }
}
if ($file['entity_type'] != 'project') {
  // Currently, files are only associated with projects.
  // Improve access checks when the feature evolves.
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$file_to_delete = $file['file_name'];

$form = new Form('fileDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_file_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    $fileHelper = new ttFileHelper($err);
    $deleted = $fileHelper->deleteFile($file);
    if ($deleted && $file['entity_type'] == 'project') {
      header('Location: project_files.php?id='.$file['entity_id']);
      exit();
    }
  } elseif ($request->getParameter('btn_cancel')) {
    if ($file['entity_type'] == 'project') {
      header('Location: project_files.php?id='.$file['entity_id']);
    }
    exit();
  }
} // isPost

$smarty->assign('file_to_delete', $file_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.fileDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_file'));
$smarty->assign('content_page_name', 'file_delete.tpl');
$smarty->display('index.tpl');
