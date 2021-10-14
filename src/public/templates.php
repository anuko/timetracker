<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

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
$trackingMode = $user->getTrackingMode();
$showBindWithProjectsCheckbox = $trackingMode != MODE_TIME;

if ($request->isPost()) {
  $cl_bind_templates_with_projects = $request->getParameter('bind_templates_with_projects');
  $cl_prepopulate_note = $request->getParameter('prepopulate_note');
} else {
  $cl_bind_templates_with_projects = $config->getDefinedValue('bind_templates_with_projects');
  $cl_prepopulate_note = $config->getDefinedValue('prepopulate_note');
}

$form = new Form('templatesForm');
if ($showBindWithProjectsCheckbox) $form->addInput(array('type'=>'checkbox','name'=>'bind_templates_with_projects','value'=>$cl_bind_templates_with_projects));
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
$smarty->assign('show_bind_with_projects_checkbox', $showBindWithProjectsCheckbox);
$smarty->assign('title', $i18n->get('title.templates'));
$smarty->assign('content_page_name', 'templates.tpl');
$smarty->display('index.tpl');
