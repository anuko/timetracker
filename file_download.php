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
import('ttTimeHelper');
import('ttExpenseHelper');
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
  if (!(ttAccessAllowed('track_own_time') || ttAccessAllowed('track_time')) || !ttTimeHelper::getRecordForFileView($file['entity_id'])) {
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
if ($entity_type == 'project') {
  if (!(ttAccessAllowed('view_own_projects') || ttAccessAllowed('manage_projects')) || !ttProjectHelper::get($file['entity_id'])) {
    header('Location: access_denied.php');
    exit();
  }
}
if ($entity_type != 'project' && $entity_type != 'time' && $entity_type != 'expense') {
  // Currently, files are only associated with time records, expense items, and projects.
  // Improve access checks when the feature evolves.
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$fileHelper = new ttFileHelper($err);

if ($fileHelper->getFile($file)) {
  header('Pragma: public'); // This is needed for IE8 to download files over https.
  header('Content-Type: application/octet-stream');
  header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
  header('Content-Disposition: attachment; filename="'.$file['file_name'].'"');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Cache-Control: private', false);

  echo $fileHelper->getFileData();
  exit;
}

$smarty->assign('title', $i18n->get('title.download_file'));
$smarty->assign('content_page_name', 'file_download2.tpl');
$smarty->display('index2.tpl');
