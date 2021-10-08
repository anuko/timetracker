<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('ttOrgImportHelper');
import('form.Form');

// Access check.
if (!ttAccessAllowed('administer_site')) {
  header('Location: access_denied.php');
  exit();
}

$form = new Form('importForm');
$form->addInput(array('type'=>'upload','name'=>'xmlfile','value'=>'browse','maxsize'=>67108864)); // 64 MB file upload limit.
// Note: for the above limit to work make sure to set upload_max_filesize and post_max_size in php.ini to at least 64M.
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.import')));

if ($request->isPost()) {
  $importHelper = new ttOrgImportHelper($err);
  $importHelper->importXml();
  if ($err->no()) $msg->add($i18n->get('form.import.success'));
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()) );
$smarty->assign('title', $i18n->get('title.import'));
$smarty->assign('content_page_name', 'import.tpl');
$smarty->display('index.tpl');
