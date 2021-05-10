<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
import('form.Form');
import('ttTeamHelper');
import('ttGroupHelper');
import('ttUserHelper');
import('form.Table');
import('form.TableColumn');
import('ttRoleHelper');

// Access checks.
if (!ttAccessAllowed('manage_users')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Use the "limit" plugin if we have one. Ignore include errors.
// The "limit" plugin is not required for normal operation of Time Tracker.
@include('plugins/limit/user_add.php');

$show_quota = $user->isPluginEnabled('mq');
if ($user->isPluginEnabled('cl'))
  $clients = ttGroupHelper::getActiveClients();

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields();
  $smarty->assign('custom_fields', $custom_fields);
}

$cl_name = $cl_login = $cl_password1 = $cl_password2 = $cl_email =
$cl_role_id = $cl_client_id = $cl_quota_percent = $cl_rate = null;
$cl_projects = array();
$assigned_projects = array();
if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_login = trim($request->getParameter('login'));
  if (!$auth->isPasswordExternal()) {
    $cl_password1 = $request->getParameter('pas1');
    $cl_password2 = $request->getParameter('pas2');
  }
  $cl_email = trim($request->getParameter('email'));
  $cl_role_id = $request->getParameter('role');
  $cl_client_id = $request->getParameter('client');
  $cl_quota_percent = $request->getParameter('quota_percent');
  // If we have user custom fields - collect input.
  if (isset($custom_fields) && $custom_fields->userFields) {
    foreach ($custom_fields->userFields as $userField) {
      $control_name = 'user_field_'.$userField['id'];
      $userCustomFields[$userField['id']] = array('field_id' => $userField['id'],
        'control_name' => $control_name,
        'label' => $userField['label'],
        'type' => $userField['type'],
        'required' => $userField['required'],
        'value' => trim($request->getParameter($control_name)));
    }
  }
  $cl_rate = $request->getParameter('rate');
  $cl_projects = $request->getParameter('projects');
  if (is_array($cl_projects)) {
    foreach ($cl_projects as $p) {
      if (ttValidFloat($request->getParameter('rate_'.$p), true)) {
        $project_with_rate = array();
        $project_with_rate['id'] = $p;
        $project_with_rate['rate'] = $request->getParameter('rate_'.$p);
        $assigned_projects[] = $project_with_rate;
      } else
        $err->add($i18n->get('error.field'), 'rate_'.$p);
    }
  }
}

$form = new Form('userForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','value'=>$cl_name));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'login','value'=>$cl_login));
if (!$auth->isPasswordExternal()) {
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'pas1','value'=>$cl_password1));
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'pas2','value'=>$cl_password2));
}
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'email','value'=>$cl_email));

$active_roles = ttTeamHelper::getActiveRolesForUser();
$form->addInput(array('type'=>'combobox','onchange'=>'handleClientRole()','name'=>'role','value'=>$cl_role_id,'data'=>$active_roles,'datakeys'=>array('id', 'name')));
if ($user->isPluginEnabled('cl'))
  $form->addInput(array('type'=>'combobox','name'=>'client','value'=>$cl_client_id,'data'=>$clients,'datakeys'=>array('id', 'name'),'empty'=>array(''=>$i18n->get('dropdown.select'))));

// If we have custom fields - add controls for them.
if (isset($custom_fields) && $custom_fields->userFields) {
  foreach ($custom_fields->userFields as $userField) {
    $field_name = 'user_field_'.$userField['id'];
    if ($userField['type'] == CustomFields::TYPE_TEXT) {
      $form->addInput(array('type'=>'text','name'=>$field_name,'value'=>$userCustomFields[$userField['id']]['value']));
    } elseif ($userField['type'] == CustomFields::TYPE_DROPDOWN) {
      $form->addInput(array('type'=>'combobox','name'=>$field_name,
      'data'=>CustomFields::getOptions($userField['id']),
      'value'=>$userCustomFields[$userField['id']]['value'],
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
    }
  }
}

$form->addInput(array('type'=>'floatfield','maxlength'=>'10','name'=>'rate','format'=>'.2','value'=>$cl_rate));
if ($show_quota)
  $form->addInput(array('type'=>'floatfield','maxlength'=>'10','name'=>'quota_percent','format'=>'.2','value'=>$cl_quota_percent));

$show_projects = MODE_PROJECTS == $user->getTrackingMode() || MODE_PROJECTS_AND_TASKS == $user->getTrackingMode();
if ($show_projects) {
  $projects = ttGroupHelper::getActiveProjects();
  if (count($projects) == 0) $show_projects = false;
}

// Define classes for the projects table.
class NameCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    $this->setValue('<label for = "'.$table->name.'_'.$row.'">'.htmlspecialchars($value).'</label>');
    return $this->toString();
  }
}
class RateCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    global $assigned_projects;
    $field = new FloatField('rate_'.$table->getValueAtName($row, 'id'));
    $field->setCssClass('project-rate-field');
    $field->setFormName($table->getFormName());
    $field->setSize(5);
    $field->setFormat('.2');
    foreach ($assigned_projects as $p) {
      if ($p['id'] == $table->getValueAtName($row,'id')) $field->setValue($p['rate']);
    }
    $this->setValue($field->getHtml());
    return $this->toString();
  }
}
// Create projects table.
$table = new Table('projects');
$table->setCssClass('project-rate-table');
$table->setIAScript('setDefaultRate');
$table->setData($projects);
$table->setKeyField('id');
$table->setValue($cl_projects);
$table->addColumn(new TableColumn('name', $i18n->get('label.project'), new NameCellRenderer()));
$table->addColumn(new TableColumn('p_rate', $i18n->get('form.users.rate'), new RateCellRenderer()));
$form->addInputElement($table);

$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.person_name'));
  if (!ttValidString($cl_login)) $err->add($i18n->get('error.field'), $i18n->get('label.login'));
  if (!$auth->isPasswordExternal()) {
    if (!ttValidString($cl_password1)) $err->add($i18n->get('error.field'), $i18n->get('label.password'));
    if (!ttValidString($cl_password2)) $err->add($i18n->get('error.field'), $i18n->get('label.confirm_password'));
    if ($cl_password1 !== $cl_password2)
      $err->add($i18n->get('error.not_equal'), $i18n->get('label.password'), $i18n->get('label.confirm_password'));
  }
  if (!ttValidEmail($cl_email, true)) $err->add($i18n->get('error.field'), $i18n->get('label.email'));
  // Require selection of a client for a client role.
  if ($user->isPluginEnabled('cl') && ttRoleHelper::isClientRole($cl_role_id) && !$cl_client_id) $err->add($i18n->get('error.client'));
  if (!ttValidFloat($cl_quota_percent, true)) $err->add($i18n->get('error.field'), $i18n->get('label.quota'));
  // Validate input in user custom fields.
  if (isset($custom_fields) && $custom_fields->userFields) {
    foreach ($userCustomFields as $userField) {
      // Validation is the same for text and dropdown fields.
      if (!ttValidString($userField['value'], !$userField['required'])) $err->add($i18n->get('error.field'), htmlspecialchars($userField['label']));
    }
  }
  if (!ttValidFloat($cl_rate, true)) $err->add($i18n->get('error.field'), $i18n->get('form.users.default_rate'));
  if (!ttUserHelper::canAdd()) $err->add($i18n->get('error.user_count'));

  if ($err->no()) {
    if (!ttUserHelper::getUserByLogin($cl_login)) {
      $fields = array(
        'name' => $cl_name,
        'login' => $cl_login,
        'password' => $cl_password1,
        'rate' => $cl_rate,
        'quota_percent' => $cl_quota_percent,
        'group_id' => $user->getGroup(),
        'org_id' => $user->org_id,
        'role_id' => $cl_role_id,
        'client_id' => $cl_client_id,
        'projects' => $assigned_projects,
        'email' => $cl_email);
      $user_id = ttUserHelper::insert($fields);

      // Insert user custom fields if we have them.
      $result = true;
      if ($user_id && isset($custom_fields) && $custom_fields->userFields) {
        $result = $custom_fields->insertEntityFields(CustomFields::ENTITY_USER, $user_id, $userCustomFields);
      }

      if ($user_id && $result) {
        if (!$user->exists()) {
          // We added a user to an empty subgroup. Set new user as on behalf user.
          // Needed for user-based things to work (such as notifications config).
          $user->setOnBehalfUser($user_id);
        }
        header('Location: users.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.user_exists'));
  }
} // isPost

$smarty->assign('auth_external', $auth->isPasswordExternal());
$smarty->assign('active_roles', $active_roles);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.userForm.name.focus();handleClientRole();"');
$smarty->assign('show_quota', $show_quota);
$smarty->assign('show_projects', $show_projects);
$smarty->assign('title', $i18n->get('title.add_user'));
$smarty->assign('content_page_name', 'user_add.tpl');
$smarty->display('index.tpl');
