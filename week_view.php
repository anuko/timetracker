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
  $cl_week_menu = (bool)$request->getParameter('week_menu');
  $cl_week_note = (bool)$request->getParameter('week_note');
  $cl_week_list = (bool)$request->getParameter('week_list');
  $cl_notes = (bool)$request->getParameter('notes');
} else {
  $cl_week_menu =  $config->getDefinedValue('week_menu');
  $cl_week_note = $config->getDefinedValue('week_note');
  $cl_week_list = $config->getDefinedValue('week_list');
  $cl_notes = $config->getDefinedValue('week_notes');
}

$form = new Form('weekViewForm');
$form->addInput(array('type'=>'checkbox','name'=>'week_menu','value'=>$cl_week_menu));
$form->addInput(array('type'=>'checkbox','name'=>'week_note','value'=>$cl_week_note));
$form->addInput(array('type'=>'checkbox','name'=>'week_list','value'=>$cl_week_list));
$form->addInput(array('type'=>'checkbox','name'=>'notes','value'=>$cl_notes));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()){
  // Update config.
  $config->setDefinedValue('week_menu', $cl_week_menu);
  $config->setDefinedValue('week_note', $cl_week_note);
  $config->setDefinedValue('week_list', $cl_week_list);
  $config->setDefinedValue('week_notes', $cl_notes);
  if (!$user->updateGroup(array('config' => $config->getConfig()))) {
    $err->add($i18n->get('error.db'));
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.week_view'));
$smarty->assign('content_page_name', 'week_view.tpl');
$smarty->display('index.tpl');
