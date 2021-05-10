<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttClientHelper');
import('ttTeamHelper');
import('ttGroupHelper');

// Access checks.
if (!ttAccessAllowed('manage_clients')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('cl')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_id = (int)$request->getParameter('id');
$client = ttClientHelper::getClient($cl_id, true);
if (!$client) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$projects = ttGroupHelper::getActiveProjects();
$cl_name = $cl_address = $cl_tax = $cl_status = null;
$cl_projects = array();
if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_address = trim($request->getParameter('address'));
  $cl_tax = trim($request->getParameter('tax'));
  $cl_status = $request->getParameter('status');
  $cl_projects = $request->getParameter('projects');
} else {
  $cl_name = $client['name'];
  $cl_address = $client['address'];
  $cl_tax = $client['tax'];
  $cl_status = $client['status'];
  $assigned_projects = ttClientHelper::getAssignedProjects($cl_id);
  foreach($assigned_projects as $project_item) {
    $cl_projects[] = $project_item['id'];
  }
}

$show_projects = (MODE_PROJECTS == $user->getTrackingMode() || MODE_PROJECTS_AND_TASKS == $user->getTrackingMode()) && count($projects) > 0;

$form = new Form('clientForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
$form->addInput(array('type'=>'text','name'=>'name','maxlength'=>'100','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'address','maxlength'=>'255','value'=>$cl_address));
$form->addInput(array('type'=>'floatfield','name'=>'tax','size'=>'10','format'=>'.2','value'=>$cl_tax));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->get('dropdown.status_active'),INACTIVE=>$i18n->get('dropdown.status_inactive'))));
if ($show_projects)
  $form->addInput(array('type'=>'checkboxgroup','name'=>'projects','data'=>$projects,'datakeys'=>array('id','name'),'layout'=>'H','value'=>$cl_projects));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_copy','value'=>$i18n->get('button.copy')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.client_name'));
  if (!ttValidString($cl_address, true)) $err->add($i18n->get('error.field'), $i18n->get('label.client_address'));
  if (!ttValidFloat($cl_tax, true)) $err->add($i18n->get('error.field'), $i18n->get('label.tax'));

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
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.object_exists'));
    }

    if ($request->getParameter('btn_copy')) {
      if (!ttClientHelper::getClientByName($cl_name)) {
        if (ttClientHelper::insert(array('name' => $cl_name,
          'address' => $cl_address,
          'tax' => $cl_tax,
          'status' => $cl_status,
          'projects' => $cl_projects))) {
          header('Location: clients.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.object_exists'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('show_projects', $show_projects);
$smarty->assign('title', $i18n->get('title.edit_client'));
$smarty->assign('content_page_name', 'client_edit.tpl');
$smarty->display('index.tpl');
