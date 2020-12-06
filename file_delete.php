<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttFileHelper');
import('ttTimeHelper');
import('ttExpenseHelper');
import('ttTimesheetHelper');
import('ttProjectHelper');

// Access checks.
$cl_file_id = (int)$request->getParameter('id');
$file = ttFileHelper::get($cl_file_id);
if (!$file) {
  header('Location: access_denied.php');
  exit();
}
// Entity-specific checks.
$entity_type = $file['entity_type'];
if ($entity_type == 'time') {
  if (!(ttAccessAllowed('track_own_time') || ttAccessAllowed('track_time')) || !ttTimeHelper::getRecord($file['entity_id'])) {
    header('Location: access_denied.php');
    exit();
  }
}
if ($entity_type == 'expense') {
  if (!(ttAccessAllowed('track_own_expenses') || ttAccessAllowed('track_expenses')) || !ttExpenseHelper::getItemForFileView($file['entity_id'])) {
    header('Location: access_denied.php');
    exit();
  }
}
if ($entity_type == 'timesheet') {
  if (!(ttAccessAllowed('track_own_time') || ttAccessAllowed('track_time')) || !ttTimesheetHelper::getTimesheet($file['entity_id'])) {
    header('Location: access_denied.php');
    exit();
  }
}
if ($entity_type == 'project') {
  if (!ttAccessAllowed('manage_projects') || !ttProjectHelper::get($file['entity_id'])) {
    header('Location: access_denied.php');
    exit();
  }
}
if (!($entity_type == 'time' || $entity_type != 'expense' || $entity_type != 'timesheet' || $entity_type == 'project')) {
  // Currently, files are only associated with time records, expense items, timesheets, and projects.
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
    if ($deleted) {
      if ($entity_type == 'time') {
        header('Location: time_files.php?id='.$file['entity_id']);
      }
      if ($entity_type == 'expense') {
        header('Location: expense_files.php?id='.$file['entity_id']);
      }
      if ($entity_type == 'timesheet') {
        header('Location: timesheet_files.php?id='.$file['entity_id']);
      }
      if ($entity_type == 'project') {
        header('Location: project_files.php?id='.$file['entity_id']);
      }
      exit();
    }
  } elseif ($request->getParameter('btn_cancel')) {
    if ($entity_type == 'time') {
      header('Location: time_files.php?id='.$file['entity_id']);
    }
    if ($entity_type == 'expense') {
      header('Location: expense_files.php?id='.$file['entity_id']);
    }
    if ($entity_type == 'timesheet') {
      header('Location: timesheet_files.php?id='.$file['entity_id']);
    }
    if ($entity_type == 'project') {
      header('Location: project_files.php?id='.$file['entity_id']);
    }
    exit();
  }
} // isPost

$smarty->assign('file_to_delete', $file_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.fileDeleteForm.btn_cancel.focus()"');
$smarty->assign('title', $i18n->get('title.delete_file'));
$smarty->assign('content_page_name', 'file_delete2.tpl');
$smarty->display('index2.tpl');
