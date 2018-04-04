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
import('ttExportHelper');
import('form.Form');

// Access check.
if (!ttAccessAllowed('export_data')) {
  header('Location: access_denied.php');
  exit();
}

$cl_compression = $request->getParameter('compression');
$compressors = array('' => $i18n->get('form.export.compression_none'));
if (function_exists('bzcompress'))
  $compressors['bzip'] = $i18n->get('form.export.compression_bzip');

$form = new Form('exportForm');
$form->addInput(array('type'=>'combobox','name'=>'compression','value'=>$cl_compression,'data'=>$compressors));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.export')));

if ($request->isPost()) {

  $filename = 'group_data.xml';
  $mime_type = 'text/xml';
  $compress = false;
  if ('bzip' == $cl_compression) {
    $compress = true;
    $filename  .= '.bz2';
    $mime_type = 'application/x-bzip2';
  }

  $exportHelper = new ttExportHelper();
  if ($exportHelper->createDataFile($compress)) {
    header('Pragma: public'); // This is needed for IE8 to download files over https.
    header('Content-Type: '.$mime_type);
    header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);

    if ($file_pointer = fopen($exportHelper->getFileName(), 'r')) {
      while ($data = fread($file_pointer, 4096)) {
        echo $data;
      }
      fclose($file_pointer);
      unlink($exportHelper->getFileName());
    }
    exit;
  } else
    $err->add($i18n->get('error.sys'));
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.export'));
$smarty->assign('content_page_name', 'export.tpl');
$smarty->display('index.tpl');
