<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttRoleHelper');

// Access check.
if (!ttAccessAllowed('manage_roles')) {
  header('Location: access_denied.php');
  exit();
}

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_rank = (int)$request->getParameter('rank');
}

$form = new Form('roleForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
for ($i = 0; $i < $user->rank; $i++) {
  $rank_data[] = $i;
}
$form->addInput(array('type'=>'combobox','name'=>'rank','data'=>$rank_data));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  if ($cl_rank >= $user->rank || $cl_rank < 0) $err->add($i18n->get('error.field'), $i18n->get('form.roles.rank'));
  if ($err->no() && ttRoleHelper::getRoleByName($cl_name)) $err->add($i18n->get('error.object_exists'));

  if ($err->no()) {
    $existing_role = ttRoleHelper::getRoleByRank($cl_rank);
    if (!$existing_role) {
        // Insert a role with default user rights.
        if (ttRoleHelper::insert(array(
          'name' => $cl_name,
          'rank' => $cl_rank,
          'description' => $cl_description,
          'rights' => 'track_own_time,track_own_expenses,view_own_reports,view_own_charts,manage_own_settings,view_users', // Default user rights.
          'status' => ACTIVE))) {
          header('Location: roles.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.role_exists'));
    }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.add_role'));
$smarty->assign('content_page_name', 'role_add.tpl');
$smarty->display('index.tpl');
