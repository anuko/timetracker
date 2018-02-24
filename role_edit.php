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
import('ttTeamHelper'); // TODO: remove this?
import('ttTaskHelper'); // TODO: remove this?
import('ttRoleHelper');

// Access check.
if (!ttAccessCheck(right_manage_team)) {
  header('Location: access_denied.php');
  exit();
}

$cl_role_id = (int)$request->getParameter('id');

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_status = $request->getParameter('status');
} else {
  $role = ttRoleHelper::get($cl_role_id);
  $cl_name = $role['name'];
  $cl_description = $role['description'];
  $cl_status = $role['status'];
}

$form = new Form('roleForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_role_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->getKey('dropdown.status_active'),INACTIVE=>$i18n->getKey('dropdown.status_inactive'))));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->getKey('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.description'));

  if ($err->no()) {
    $existing_role = ttRoleHelper::getRoleByName($cl_name);
    if (!$existing_role || ($cl_role_id == $existing_role['id'])) {
      // Update role information.
      if (ttRoleHelper::update(array(
        'id' => $cl_role_id,
        'name' => $cl_name,
        'description' => $cl_description,
        'status' => $cl_status))) {
        header('Location: roles.php');
        exit();
      } else
        $err->add($i18n->getKey('error.db'));
    } else
      $err->add($i18n->getKey('error.object_exists'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->getKey('title.edit_role'));
$smarty->assign('content_page_name', 'role_edit.tpl');
$smarty->display('index.tpl');
