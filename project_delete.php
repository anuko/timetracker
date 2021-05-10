<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttProjectHelper');

// Access checks.
if (!ttAccessAllowed('manage_projects')) {
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

$project_to_delete = $project['name'];

$form = new Form('projectDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_project_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if (ttProjectHelper::delete($cl_project_id)) {
      header('Location: projects.php');
      exit();
    } else
      $err->add($i18n->get('error.db'));
  } elseif ($request->getParameter('btn_cancel')) {
    header('Location: projects.php');
    exit();
  }
} // isPost

$smarty->assign('project_to_delete', $project_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.projectDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_project'));
$smarty->assign('content_page_name', 'project_delete.tpl');
$smarty->display('index.tpl');
