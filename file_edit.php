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

if ($request->isPost()) {
  $cl_description = trim($request->getParameter('description'));
} else {
  $cl_description = $file['description'];
}
$cl_name = $file['file_name'];

$form = new Form('fileForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_file_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'file_name','value'=>$cl_name));
$form->getElement('file_name')->setEnabled(false);
$form->addInput(array('type'=>'textarea','name'=>'description','value'=>$cl_description));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));

  if ($err->no()) {
    if ($request->getParameter('btn_save')) {
      // Update file information.
      $updated = ttFileHelper::update(array('id' => $cl_file_id,'description' => $cl_description));
      if ($updated) {
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
      } else
        $err->add($i18n->get('error.db'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.fileForm.description.focus()"');
$smarty->assign('title', $i18n->get('title.edit_file'));
$smarty->assign('content_page_name', 'file_edit.tpl');
$smarty->display('index.tpl');
