<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttTemplateHelper');

// Access checks.
if (!ttAccessAllowed('manage_advanced_settings')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('tp')) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

$config = new ttConfigHelper($user->getConfig());
$bindTemplatesWithProjects = $config->getDefinedValue('bind_templates_with_projects');
if ($bindTemplatesWithProjects)
  $projects = ttGroupHelper::getActiveProjects();

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_content = trim($request->getParameter('content'));
  $cl_projects = $request->getParameter('projects');
} else {
  if ($bindTemplatesWithProjects) {
    foreach ($projects as $project_item)
      $cl_projects[] = $project_item['id'];
  }
}

$form = new Form('templateForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'textarea','name'=>'content','style'=>'width: 250px; height: 80px;','value'=>$cl_content));
$form->addInput(array('type'=>'checkboxgroup','name'=>'projects','layout'=>'H','data'=>$projects,'datakeys'=>array('id','name'),'value'=>$cl_projects));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  if (!ttValidString($cl_content)) $err->add($i18n->get('error.field'), $i18n->get('label.template'));
  if (!ttGroupHelper::validateCheckboxGroupInput($cl_projects, 'tt_projects')) $err->add($i18n->get('error.field'), $i18n->get('label.projects'));
  // Finished validating user input.

  if ($err->no()) {
    if (ttTemplateHelper::insert(array(
        'name' => $cl_name,
        'description' => $cl_description,
        'content' => $cl_content,
        'projects' => $cl_projects))) {
        header('Location: templates.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('show_projects', $bindTemplatesWithProjects && count($projects) > 0);
$smarty->assign('title', $i18n->get('title.add_template'));
$smarty->assign('content_page_name', 'template_add.tpl');
$smarty->display('index.tpl');
