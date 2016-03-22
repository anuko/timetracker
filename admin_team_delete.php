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
if (!ttAccessCheck(right_administer_site)) {
  header('Location: access_denied.php');
  exit();
}

$team_id = (int)$request->getParameter('id');
$team_details = ttTeamHelper::getTeamDetails($team_id);
$team_name = $team_details['team_name'];

$form = new Form('teamForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$team_id));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->getKey('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->getKey('button.cancel')));

if ($request->isPost()) {
  if ($request->getParameter('btn_delete')) {
    if (ttTeamHelper::markDeleted($team_id)) {
      header('Location: admin_teams.php');
      exit();
    } else
      $errors->add($i18n->getKey('error.db'));
  }

  if ($request->getParameter('btn_cancel')) {
    header('Location: admin_teams.php');
    exit();
  }
} // POST

$smarty->assign('team_to_delete', $team_name);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->getKey('title.delete_team'));
$smarty->assign('content_page_name', 'admin_team_delete.tpl');
$smarty->display('index.tpl');
