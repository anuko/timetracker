<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttClientHelper');
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

$projects = ttGroupHelper::getActiveProjects();

$cl_name = $cl_address = $cl_tax = '';
$cl_projects = array();
if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_address = trim($request->getParameter('address'));
  $cl_tax = $request->getParameter('tax');
  $cl_projects = $request->getParameter('projects');
} else {
  // Do not assign all projects to a new client by default. This should help to reduce clutter.
  // foreach ($projects as $project_item)
  //   $cl_projects[] = $project_item['id'];
}

$show_projects = (MODE_PROJECTS == $user->getTrackingMode() || MODE_PROJECTS_AND_TASKS == $user->getTrackingMode()) && count($projects) > 0;

$form = new Form('clientForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'address','maxlength'=>'255','value'=>$cl_address));
$form->addInput(array('type'=>'floatfield','name'=>'tax','size'=>'10','format'=>'.2','value'=>$cl_tax));
if ($show_projects)
  $form->addInput(array('type'=>'checkboxgroup','name'=>'projects','data'=>$projects,'layout'=>'H','datakeys'=>array('id','name'),'value'=>$cl_projects));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.client_name'));
  if (!ttValidString($cl_address, true)) $err->add($i18n->get('error.field'), $i18n->get('label.client_address'));
  if (!ttValidFloat($cl_tax, true)) $err->add($i18n->get('error.field'), $i18n->get('label.tax'));

  if ($err->no()) {
    if (!ttClientHelper::getClientByName($cl_name)) {
      if (ttClientHelper::insert(array('name' => $cl_name,
        'address' => $cl_address,
        'tax' => $cl_tax,
        'projects' => $cl_projects,
        'status' => ACTIVE))) {
        header('Location: clients.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
     } else
       $err->add($i18n->get('error.object_exists'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.clientForm.name.focus()"');
$smarty->assign('show_projects', $show_projects);
$smarty->assign('title', $i18n->get('title.add_client'));
$smarty->assign('content_page_name', 'client_add.tpl');
$smarty->display('index.tpl');
