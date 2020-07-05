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
import('ttGroupHelper');

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

$config = $user->getConfigHelper();

if ($request->isPost()) {
  $cl_bind_templates_with_projects = $request->getParameter('bind_templates_with_projects');
  $cl_prepopulate_note = $request->getParameter('prepopulate_note');
} else {
  $cl_bind_templates_with_projects = $config->getDefinedValue('bind_templates_with_projects');
  $cl_prepopulate_note = $config->getDefinedValue('prepopulate_note');
}

$form = new Form('templatesForm');
$form->addInput(array('type'=>'checkbox','name'=>'bind_templates_with_projects','value'=>$cl_bind_templates_with_projects));
$form->addInput(array('type'=>'checkbox','name'=>'prepopulate_note','value'=>$cl_prepopulate_note));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));
$activeTemplates = ttGroupHelper::getActiveTemplates();
$inactiveTemplates = ttGroupHelper::getInactiveTemplates();

if ($request->isPost()) {
  if ($request->getParameter('btn_save')) {
    // Save button clicked. Update config.
    $config->setDefinedValue('bind_templates_with_projects', $cl_bind_templates_with_projects);
    $config->setDefinedValue('prepopulate_note', $cl_prepopulate_note);
    if (!$user->updateGroup(array('config' => $config->getConfig()))) {
      $err->add($i18n->get('error.db'));
    }
  }

  if ($request->getParameter('btn_add')) {
    // The Add button clicked. Redirect to template_add.php page.
    header('Location: template_add.php');
    exit();
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('active_templates', $activeTemplates);
$smarty->assign('inactive_templates', $inactiveTemplates);
$smarty->assign('title', $i18n->get('title.templates'));
$smarty->assign('content_page_name', 'templates.tpl');
$smarty->display('index.tpl');
