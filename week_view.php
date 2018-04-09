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
if (!$user->isPluginEnabled('wv')) {
  header('Location: feature_disabled.php');
  exit();
}

if ($request->isPost()) {
  $cl_week_note = $request->getParameter('week_note');
  $cl_week_list = $request->getParameter('week_list');
  $cl_notes = $request->getParameter('notes');
} else {
  $plugins = explode(',', $user->plugins);
  $cl_week_note = in_array('wvn', $plugins);
  $cl_week_list = in_array('wvl', $plugins);
  $cl_notes = in_array('wvns', $plugins);
}


$form = new Form('weekViewForm');
$form->addInput(array('type'=>'checkbox','name'=>'week_note','value'=>$cl_week_note));
$form->addInput(array('type'=>'checkbox','name'=>'week_list','value'=>$cl_week_list));
$form->addInput(array('type'=>'checkbox','name'=>'notes','value'=>$cl_notes));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost()){
  if (!$user->enablePlugin('wvn', $cl_week_note) ||
      !$user->enablePlugin('wvl', $cl_week_list) ||
      !$user->enablePlugin('wvns', $cl_notes)) {
    $err->add($i18n->get('error.db'));
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.week_view'));
$smarty->assign('content_page_name', 'week_view.tpl');
$smarty->display('index.tpl');
