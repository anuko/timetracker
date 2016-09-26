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

require_once('../initialize.php');
import('form.Form');
import('ttClientHelper');
import('ttTeamHelper');

// Access check.
if (!ttAccessCheck(right_manage_team) || !$user->isPluginEnabled('cl')) {
  header('Location: access_denied.php');
  exit();
}

$cl_id = (int) $request->getParameter('id');

$projects = ttTeamHelper::getActiveProjects($user->team_id);

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_address = trim($request->getParameter('address'));
  $cl_tax = trim($request->getParameter('tax'));
  $cl_status = $request->getParameter('status');
  $cl_projects = $request->getParameter('projects');
} else {
  $client = ttClientHelper::getClient($cl_id, true);
  $cl_name = $client['name'];
  $cl_address = $client['address'];
  $cl_tax = $client['tax'];
  $cl_status = $client['status'];
  $assigned_projects = ttClientHelper::getAssignedProjects($cl_id);
  foreach($assigned_projects as $project_item) {
    $cl_projects[] = $project_item['id'];
  }
}

$form = new Form('clientForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
$form->addInput(array('type'=>'text','name'=>'name','maxlength'=>'100','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'address','maxlength'=>'255','class'=>'mobile-textarea','value'=>$cl_address));
$form->addInput(array('type'=>'floatfield','name'=>'tax','size'=>'10','format'=>'.2','value'=>$cl_tax));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->getKey('dropdown.status_active'),INACTIVE=>$i18n->getKey('dropdown.status_inactive'))));
if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode)
  $form->addInput(array('type'=>'checkboxgroup','name'=>'projects','data'=>$projects,'datakeys'=>array('id','name'),'layout'=>'H','value'=>$cl_projects));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->getKey('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_copy','value'=>$i18n->getKey('button.copy')));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->getKey('label.delete')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.client_name'));
  if (!ttValidString($cl_address, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.client_address'));
  if (!ttValidFloat($cl_tax, true)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.tax'));

  if ($err->no()) {
    if ($request->getParameter('btn_save')) {
      $client = ttClientHelper::getClientByName($cl_name);
      if (($client && ($cl_id == $client['id'])) || !$client) {
        if (ttClientHelper::update(array(
          'id' => $cl_id,
          'name' => $cl_name,
          'address' => $cl_address,
          'tax' => $cl_tax,
          'status' => $cl_status,
          'projects' => $cl_projects))) {
          header('Location: clients.php');
          exit();
        } else
          $err->add($i18n->getKey('error.db'));
      } else
        $err->add($i18n->getKey('error.client_exists'));
    }

    if ($request->getParameter('btn_copy')) {
      if (!ttClientHelper::getClientByName($cl_name)) {
        if (ttClientHelper::insert(array(
          'team_id' => $user->team_id,
          'name' => $cl_name,
          'address' => $cl_address,
          'tax' => $cl_tax,
          'status' => $cl_status,
          'projects' => $cl_projects))) {
          header('Location: clients.php');
          exit();
        } else
          $err->add($i18n->getKey('error.db'));
      } else
        $err->add($i18n->getKey('error.client_exists'));
    }
    
    if ($request->getParameter('btn_delete')) {
      header("Location: client_delete.php?id=$cl_id");
      exit();
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->getKey('title.edit_client'));
$smarty->assign('content_page_name', 'mobile/client_edit.tpl');
$smarty->display('mobile/index.tpl');
