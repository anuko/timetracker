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

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}

$config = $user->getConfigHelper();

if ($request->isPost()) {
  $cl_week_menu = $request->getParameter('week_menu');
  $cl_week_note = $request->getParameter('week_note');
  $cl_week_list = $request->getParameter('week_list');
  $cl_notes = $request->getParameter('notes');
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
