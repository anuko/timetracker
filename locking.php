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
import('ttTeamHelper');

// Access check.
if (!ttAccessCheck(right_manage_team)) {
  header('Location: access_denied.php');
  exit();
}

$cl_lock_interval = $request->isPost() ? $request->getParameter('lock_interval') : $user->lock_interval;

$form = new Form('lockingForm');
$form->addInput(array('type'=>'text','maxlength'=>'10','name'=>'lock_interval','value'=>$cl_lock_interval));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->getKey('button.save')));

if ($request->isPost()) {
  if ($cl_lock_interval == null || trim($cl_lock_interval) == '') $cl_lock_interval = 0;

  if (ttTeamHelper::update($user->team_id, array(
    'name' => $user->team,
    'locktime' => $cl_lock_interval))) {
    header('Location: time.php');
    exit();
  } else {
    $err->add($i18n->getKey('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->getKey('title.locking'));
$smarty->assign('content_page_name', 'locking.tpl');
$smarty->display('index.tpl');
