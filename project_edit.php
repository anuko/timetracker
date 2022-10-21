<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttProjectHelper');
import('ttGroupHelper');

// Access checks.
if (!ttAccessAllowed('manage_projects')) {
  header('Location: access_denied.php');
  exit();
}
if (MODE_PROJECTS != $user->getTrackingMode() && MODE_PROJECTS_AND_TASKS != $user->getTrackingMode()) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_project_id = (int)$request->getParameter('id');
$project = ttProjectHelper::get($cl_project_id);
if (!$project) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields();
  $smarty->assign('custom_fields', $custom_fields);
}

$users = ttGroupHelper::getActiveUsers();
foreach ($users as $user_item)
  $all_users[$user_item['id']] = $user_item['name'];

$tasks = ttGroupHelper::getActiveTasks();
foreach ($tasks as $task_item)
  $all_tasks[$task_item['id']] = $task_item['name'];
$show_tasks = MODE_PROJECTS_AND_TASKS == $user->getTrackingMode() && count($tasks) > 0;

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('project_name'));
  $cl_description = trim($request->getParameter('description'));
  $cl_status = $request->getParameter('status');
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
  $cl_name = $project['name'];
  $cl_description = $project['description'];
  // If we have project custom fields - collect values from database.
  if (isset($custom_fields) && $custom_fields->projectFields) {
    foreach ($custom_fields->projectFields as $projectField) {
      $control_name = 'project_field_'.$projectField['id'];
      $projectCustomFields[$projectField['id']] = array('field_id' => $projectField['id'],
        'control_name' => $control_name,
        'label' => $projectField['label'],
        'type' => $projectField['type'],
        'required' => $projectField['required'],
        'value' => $custom_fields->getEntityFieldValue(CustomFields::ENTITY_PROJECT, $cl_project_id, $projectField['id'], $projectField['type']));
    }
  }
  $cl_status = $project['status'];
  $cl_users = ttProjectHelper::getAssignedUsers($cl_project_id);
  $cl_tasks = explode(',', $project['tasks']);
}

$form = new Form('projectForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_project_id));
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
$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->get('dropdown.status_active'),INACTIVE=>$i18n->get('dropdown.status_inactive'))));
$form->addInput(array('type'=>'checkboxgroup','name'=>'users','data'=>$all_users,'layout'=>'H','value'=>$cl_users));
if ($show_tasks)
  $form->addInput(array('type'=>'checkboxgroup','name'=>'tasks','data'=>$all_tasks,'layout'=>'H','value'=>$cl_tasks));
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_copy','value'=>$i18n->get('button.copy')));

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
  if (!ttValidStatus($cl_status)) $err->add($i18n->get('error.field'), $i18n->get('label.status'));
  if (!ttGroupHelper::validateCheckboxGroupInput($cl_users, 'tt_users')) $err->add($i18n->get('error.field'), $i18n->get('label.users'));
  if (!ttGroupHelper::validateCheckboxGroupInput($cl_tasks, 'tt_tasks')) $err->add($i18n->get('error.field'), $i18n->get('label.tasks'));

  if ($err->no()) {
    if ($request->getParameter('btn_save')) {
      $existing_project = ttProjectHelper::getProjectByName($cl_name);
      if (!$existing_project || ($cl_project_id == $existing_project['id'])) {
        // Update project information.
        $result = ttProjectHelper::update(array(
          'id' => $cl_project_id,
          'name' => $cl_name,
          'description' => $cl_description,
          'status' => $cl_status,
          'users' => $cl_users,
          'tasks' => $cl_tasks));
        // Update project custom fields if we have them.
        if ($result && isset($custom_fields) && $custom_fields->projectFields) {
          $result = $custom_fields->updateEntityFields(CustomFields::ENTITY_PROJECT, $cl_project_id, $projectCustomFields);
        }
        if ($result) {
          header('Location: projects.php');
          exit();
         } else
          $err->add($i18n->get('error.db'));
        } else
        $err->add($i18n->get('error.object_exists'));
    }

    if ($request->getParameter('btn_copy')) {
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
        if ($project_id && $result) {
          header('Location: projects.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
      } else
        $err->add($i18n->get('error.object_exists'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.projectForm.project_name.focus()"');
$smarty->assign('show_users', count($users) > 0);
$smarty->assign('show_tasks', $show_tasks);
$smarty->assign('title', $i18n->get('title.edit_project'));
$smarty->assign('content_page_name', 'project_edit.tpl');
$smarty->display('index.tpl');
