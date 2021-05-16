<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}

$config = $user->getConfigHelper();

if ($request->isPost()) {
  $cl_puncher_menu = (bool)$request->getParameter('puncher_menu');
} else {
  $cl_puncher_menu =  $config->getDefinedValue('puncher_menu');
}

$form = new Form('puncherConfigForm');
$form->addInput(array('type'=>'checkbox','name'=>'puncher_menu','value'=>$cl_puncher_menu));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()){
  // Update config.
  $config->setDefinedValue('puncher_menu', $cl_puncher_menu);
  if (!$user->updateGroup(array('config' => $config->getConfig()))) {
    $err->add($i18n->get('error.db'));
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.puncher'));
$smarty->assign('content_page_name', 'puncher_conf.tpl');
$smarty->display('index.tpl');
