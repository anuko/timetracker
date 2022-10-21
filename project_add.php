<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttProjectHelper');
import('ttGroupHelper');
import('ttFileHelper');

// Access checks.
if (!ttAccessAllowed('manage_projects')) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS != $user->getTrackingMode() && MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
  header('Location: feature_disabled.php');
  exit();
}
// End of access checks.

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields();
  $smarty->assign('custom_fields', $custom_fields);
}

$showFiles = $user->isPluginEnabled('at');
$users = ttGroupHelper::getActiveUsers();
foreach ($users as $user_item)
  $all_users[$user_item['id']] = $user_item['name'];

$tasks = ttGroupHelper::getActiveTasks();
foreach ($tasks as $task_item)
  $all_tasks[$task_item['id']] = $task_item['name'];
$show_tasks = MODE_PROJECTS_AND_TASKS == $user->getTrackingMode() && count($tasks) > 0;

$cl_name = $cl_description = '';
if ($request->isPost()) {
  $cl_name = trim($request->getParameter('project_name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_users = $request->getParameter('users', array());
  $cl_tasks = $request->getParameter('tasks', array());
  // If we have project custom fields - collect input.
  if (isset($custom_fields) && $custom_fields->projectFields) {
    foreach ($custom_fields->projectFields as $projectField) {
      $control_name = 'project_field_'.$projectField['id'];
      $projectCustomFields[$projectField['id']] = array('field_id' => $projectField['id'],
        'control_name' => $control_name,
        'label' => $projectField['label'],
        'type' => $projectField['type'],
        'required' => $projectField['required'],
        'value' => trim($request->getParameter($control_name)));
    }
  }
} else {
  foreach ($users as $user_item)
    $cl_users[] = $user_item['id'];
  foreach ($tasks as $task_item)
    $cl_tasks[] = $task_item['id'];
}

$form = new Form('projectForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'project_name','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','value'=>$cl_description));
// If we have custom fields - add controls for them.
if (isset($custom_fields) && $custom_fields->projectFields) {
  foreach ($custom_fields->projectFields as $projectField) {
    $field_name = 'project_field_'.$projectField['id'];
    if ($projectField['type'] == CustomFields::TYPE_TEXT) {
      $form->addInput(array('type'=>'text','name'=>$field_name,'value'=>$projectCustomFields[$projectField['id']]['value']));
    } elseif ($projectField['type'] == CustomFields::TYPE_DROPDOWN) {
      $form->addInput(array('type'=>'combobox','name'=>$field_name,
      'data'=>CustomFields::getOptions($projectField['id']),
      'value'=>$projectCustomFields[$projectField['id']]['value'],
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
    }
  }
}
if ($showFiles)
  $form->addInput(array('type'=>'upload','name'=>'newfile','value'=>$i18n->get('button.submit')));
$form->addInput(array('type'=>'checkboxgroup','name'=>'users','data'=>$all_users,'layout'=>'H','value'=>$cl_users));
if ($show_tasks)
  $form->addInput(array('type'=>'checkboxgroup','name'=>'tasks','data'=>$all_tasks,'layout'=>'H','value'=>$cl_tasks));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));
  // Validate input in project custom fields.
  if (isset($custom_fields) && $custom_fields->projectFields) {
    foreach ($projectCustomFields as $projectField) {
      // Validation is the same for text and dropdown fields.
      if (!ttValidString($projectField['value'], !$projectField['required'])) $err->add($i18n->get('error.field'), htmlspecialchars($projectField['label']));
    }
  }
  if (!ttGroupHelper::validateCheckboxGroupInput($cl_users, 'tt_users')) $err->add($i18n->get('error.field'), $i18n->get('label.users'));
  if (!ttGroupHelper::validateCheckboxGroupInput($cl_tasks, 'tt_tasks')) $err->add($i18n->get('error.field'), $i18n->get('label.tasks'));

  if ($err->no()) {
    if (!ttProjectHelper::getProjectByName($cl_name)) {
      $project_id = ttProjectHelper::insert(array('name' => $cl_name,
        'description' => $cl_description,
        'users' => $cl_users,
        'tasks' => $cl_tasks,
        'status' => ACTIVE));
      // Insert project custom fields if we have them.
      $result = true;
      if ($project_id && isset($custom_fields) && $custom_fields->projectFields) {
        $result = $custom_fields->insertEntityFields(CustomFields::ENTITY_PROJECT, $project_id, $projectCustomFields);
      }
      // Put a new file in storage if we have it.
      if ($project_id && $showFiles && $_FILES['newfile']['name']) {
        $fileHelper = new ttFileHelper($err);
        $fields = array('entity_type'=>'project',
          'entity_id' => $project_id,
          'file_name' => $_FILES['newfile']['name']);
        $fileHelper->putFile($fields);
      }
      if ($project_id && $result) {
        header('Location: projects.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.object_exists'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.projectForm.project_name.focus()"');
$smarty->assign('show_files', $showFiles);
$smarty->assign('show_users', count($users) > 0);
$smarty->assign('show_tasks', $show_tasks);
$smarty->assign('title', $i18n->get('title.add_project'));
$smarty->assign('content_page_name', 'project_add.tpl');
$smarty->display('index.tpl');
