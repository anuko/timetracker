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
import('ttRoleHelper');

// Access checks.
if (!ttAccessAllowed('manage_roles')) {
  header('Location: access_denied.php');
  exit();
}
$cl_role_id = (int)$request->getParameter('id');
$role = ttRoleHelper::get($cl_role_id);
if (!$role) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$assigned_rights = explode(',', $role['rights']);
$available_rights = array_diff($user->rights, $assigned_rights);

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_rank = $request->getParameter('rank');
  $cl_status = $request->getParameter('status');
} else {
  $cl_name = $role['name'];
  $cl_description = $role['description'];
  $cl_rank = $role['rank'];
  $cl_status = $role['status'];
}

$form = new Form('roleForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_role_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
for ($i = 0; $i < $user->rank; $i++) {
  $rank_data[] = $i;
}
$form->addInput(array('type'=>'combobox','name'=>'rank','data'=>$rank_data,'value'=>$cl_rank));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->get('dropdown.status_active'),INACTIVE=>$i18n->get('dropdown.status_inactive'))));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

// Multiple select controls for assigned and available rights.
$form->addInput(array('type'=>'combobox','name'=>'assigned_rights','style'=>'width: 250px;','multiple'=>true,'data'=>$assigned_rights));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('button.delete')));
$form->addInput(array('type'=>'combobox','name'=>'available_rights','style'=>'width: 250px;','multiple'=>true,'data'=>$available_rights));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
    if ($request->getParameter('btn_save')) {
    // Validate user input.
    if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
    if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
    if ($cl_rank >= $user->rank || $cl_rank < 0) $err->add($i18n->get('error.field'), $i18n->get('form.roles.rank'));

    if ($err->no()) {
      $existing_role = ttRoleHelper::getRoleByName($cl_name);
      if (!$existing_role || ($cl_role_id == $existing_role['id'])) {
        // Update role information.
        if (ttRoleHelper::update(array(
          'id' => $cl_role_id,
          'name' => $cl_name,
          'rank' => $cl_rank,
          'description' => $cl_description,
          'status' => $cl_status))) {
          header('Location: roles.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.object_exists'));
    }
  }
  if ($request->getParameter('btn_delete') && $request->getParameter('assigned_rights')) {
     $rights = $role['rights'];
     $to_delete = $request->getParameter('assigned_rights');
     foreach($to_delete as $index) {
       $right_to_delete = $assigned_rights[$index];
       $rights = str_replace($right_to_delete, '', $rights);
       $rights = str_replace(',,',',', $rights);
     }
     $rights = trim($rights, ',');
     if (ttRoleHelper::update(array('id' => $cl_role_id,'rights'=> $rights))) {
       header('Location: role_edit.php?id='.$role['id']);
       exit();
     } else
       $err->add($i18n->get('error.db'));
  }
  if ($request->getParameter('btn_add') && $request->getParameter('available_rights')) {
     $rights = $role['rights'];
     $to_add = $request->getParameter('available_rights');
     foreach($to_add as $index) {
       $right_to_add = $available_rights[$index];
       // Just in case remove it.
       $rights = str_replace($right_to_add, '', $rights);
       $rights = str_replace(',,',',', $rights);
       // Add the right only if we have it ourselves.
       if (in_array($right_to_add, $user->rights))
         $rights .= ','.$right_to_add;
     }
     $rights = trim($rights, ',');
     if (ttRoleHelper::update(array('id' => $cl_role_id,'rights'=> $rights))) {
       header('Location: role_edit.php?id='.$role['id']);
       exit();
     } else
       $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.edit_role'));
$smarty->assign('content_page_name', 'role_edit.tpl');
$smarty->display('index.tpl');
