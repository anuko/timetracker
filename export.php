<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('ttOrgExportHelper');
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

  $exportHelper = new ttOrgExportHelper();
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
