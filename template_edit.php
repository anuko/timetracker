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
$cl_template_id = (int) $request->getParameter('id');
$template = ttTemplateHelper::get($cl_template_id);
if (!$template) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

$config = $user->getConfigHelper();
$bindTemplatesWithProjects = $config->getDefinedValue('bind_templates_with_projects');
if ($bindTemplatesWithProjects)
  $projects = ttGroupHelper::getActiveProjects();

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_content = trim($request->getParameter('content'));
  $cl_status = $request->getParameter('status');
  if ($bindTemplatesWithProjects)
    $cl_projects = $request->getParameter('projects');
} else {
  $cl_name = $template['name'];
  $cl_description = $template['description'];
  $cl_content = $template['content'];
  $cl_status = $template['status'];
  if ($bindTemplatesWithProjects) {
    $assigned_projects = ttTemplateHelper::getAssignedProjects($cl_template_id);
    foreach ($assigned_projects as $project_item)
      $cl_projects[] = $project_item['id'];
  }
}

$form = new Form('templateForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_template_id));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'textarea','name'=>'content','style'=>'width: 250px; height: 80px;','value'=>$cl_content));
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->get('dropdown.status_active'),INACTIVE=>$i18n->get('dropdown.status_inactive'))));
$form->addInput(array('type'=>'checkboxgroup','name'=>'projects','layout'=>'H','data'=>$projects,'datakeys'=>array('id','name'),'value'=>$cl_projects));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  if (!ttValidString($cl_content)) $err->add($i18n->get('error.field'), $i18n->get('label.template'));
  // Finished validating user input.

  if ($err->no()) {
    if (ttTemplateHelper::update(array(
        'id' => $cl_template_id,
        'name' => $cl_name,
        'description' => $cl_description,
        'content' => $cl_content,
        'status' => $cl_status,
        'projects' => $cl_projects))) {
        header('Location: templates.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('show_projects', $bindTemplatesWithProjects && count($projects) > 0);
$smarty->assign('title', $i18n->get('title.edit_template'));
$smarty->assign('content_page_name', 'template_edit.tpl');
$smarty->display('index.tpl');
