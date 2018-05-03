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
import('ttProjectHelper');
import('ttTeamHelper');
import('ttUserHelper');
import('form.Table');
import('form.TableColumn');
import('ttRoleHelper');

// Access checks.
if (!ttAccessAllowed('manage_users')) {
  header('Location: access_denied.php');
  exit();
}
$user_id = (int)$request->getParameter('id');
$user_details = $user->getUser($user_id);
if (!$user_details) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

if ($user->isPluginEnabled('cl'))
  $clients = ttTeamHelper::getActiveClients($user->group_id);

$projects = ttTeamHelper::getActiveProjects($user->group_id);
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
  $cl_status = $request->getParameter('status');
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
} else {
  $cl_name = $user_details['name'];
  $cl_login = $user_details['login'];
  $cl_email = $user_details['email'];
  $cl_rate = str_replace('.', $user->decimal_mark, $user_details['rate']);
  $cl_role_id = $user_details['role_id'];
  $cl_client_id = $user_details['client_id'];
  $cl_status = $user_details['status'];
  $cl_projects = array();
  $assigned_projects = ttProjectHelper::getAssignedProjects($user_id);
  foreach($assigned_projects as $p) {
    $cl_projects[] = $p['id'];
  }
}

$form = new Form('userForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 300px;','value'=>$cl_name));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'login','style'=>'width: 300px;','value'=>$cl_login));
if (!$auth->isPasswordExternal()) {
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'pas1','value'=>$cl_password1));
  $form->addInput(array('type'=>'password','maxlength'=>'30','name'=>'pas2','value'=>$cl_password2));
}
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'email','style'=>'width: 300px;','value'=>$cl_email));

$active_roles = ttTeamHelper::getActiveRolesForUser();
$form->addInput(array('type'=>'combobox','onchange'=>'handleClientControl()','name'=>'role','value'=>$cl_role_id,'data'=>$active_roles, 'datakeys'=>array('id', 'name')));
if ($user->isPluginEnabled('cl'))
  $form->addInput(array('type'=>'combobox','name'=>'client','value'=>$cl_client_id,'data'=>$clients,'datakeys'=>array('id', 'name'),'empty'=>array(''=>$i18n->get('dropdown.select'))));

$form->addInput(array('type'=>'combobox','name'=>'status','value'=>$cl_status,
  'data'=>array(ACTIVE=>$i18n->get('dropdown.status_active'),INACTIVE=>$i18n->get('dropdown.status_inactive'))));
$form->addInput(array('type'=>'floatfield','maxlength'=>'10','name'=>'rate','format'=>'.2','value'=>$cl_rate));

// Define classes for the projects table.
class NameCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    $this->setOptions(array('width'=>200));
    $this->setValue('<label for = "'.$table->name.'_'.$row.'">'.htmlspecialchars($value).'</label>');
    return $this->toString();
  }
}
class RateCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    global $assigned_projects;

    $field = new FloatField('rate_'.$table->getValueAtName($row,'id'));
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
$table->setIAScript('setRate');
$table->setTableOptions(array('width'=>'100%','cellspacing'=>'1','cellpadding'=>'3','border'=>'0'));
$table->setRowOptions(array('valign'=>'top','class'=>'tableHeader'));
$table->setData($projects);
$table->setKeyField('id');
$table->setValue($cl_projects);
$table->addColumn(new TableColumn('name', $i18n->get('label.project'), new NameCellRenderer()));
$table->addColumn(new TableColumn('p_rate', $i18n->get('form.users.rate'), new RateCellRenderer()));
$form->addInputElement($table);

$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$user_id));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.save')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.person_name'));
  if (!ttValidString($cl_login)) $err->add($i18n->get('error.field'), $i18n->get('label.login'));
  if (!$auth->isPasswordExternal() && ($cl_password1 || $cl_password2)) {
    if (!ttValidString($cl_password1)) $err->add($i18n->get('error.field'), $i18n->get('label.password'));
    if (!ttValidString($cl_password2)) $err->add($i18n->get('error.field'), $i18n->get('label.confirm_password'));
    if ($cl_password1 !== $cl_password2)
      $err->add($i18n->get('error.not_equal'), $i18n->get('label.password'), $i18n->get('label.confirm_password'));
  }
  if (!ttValidEmail($cl_email, true)) $err->add($i18n->get('error.field'), $i18n->get('label.email'));
  // Require selection of a client for a client role.
  if ($user->isPluginEnabled('cl') && ttRoleHelper::isClientRole($cl_role_id) && !$cl_client_id) $err->add($i18n->get('error.client'));
  if (!ttValidFloat($cl_rate, true)) $err->add($i18n->get('error.field'), $i18n->get('form.users.default_rate'));

  if ($err->no()) {
    $existing_user = ttUserHelper::getUserByLogin($cl_login);
    if (!$existing_user || ($user_id == $existing_user['id'])) {

        $fields = array(
        'name' => $cl_name,
        'login' => $cl_login,
        'password' => $cl_password1,
        'email' => $cl_email,
        'status' => $cl_status,
        'rate' => $cl_rate,
        'projects' => $assigned_projects);
      if (in_array('manage_users', $user->rights) && $cl_role_id) {
        $fields['role_id'] = $cl_role_id;
        $fields['client_id'] = $cl_client_id;
      }

      if (ttUserHelper::update($user_id, $fields)) {

        // If our own login changed, set new one in cookie to remember it.
        if (($user_id == $user->id) && ($user->login != $cl_login)) {
          setcookie('tt_login', $cl_login, time() + COOKIE_EXPIRE, '/');
        }

        // In case the name of the "on behalf" user has changed - set it in session.
        if (($user->behalf_id == $user_id) && ($user->behalf_name != $cl_name)) {
          $_SESSION['behalf_name'] = $cl_name;
        }

        // If we deactivated our own account, do housekeeping and logout.
        if ($user->id == $user_id && !is_null($cl_status) && $cl_status == INACTIVE) {
          // Remove tt_login cookie that stores login name.
          unset($_COOKIE['tt_login']);
          setcookie('tt_login', NULL, -1);

          $auth->doLogout();
          header('Location: login.php');
          exit();
        }

        header('Location: users.php');
        exit();

      } else
        $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.user_exists'));
  }
} // isPost

$can_swap = false;
if ($user->id == $user_id && $user->can('swap_roles')) {
  $users_for_swap = ttTeamHelper::getUsersForSwap();
  if (is_array($users_for_swap) && sizeof($users_for_swap) > 0)
    $can_swap = true;
}

$rates = ttProjectHelper::getRates($user_id);
$smarty->assign('rates', $rates);

$smarty->assign('auth_external', $auth->isPasswordExternal());
$smarty->assign('active_roles', $active_roles);
$smarty->assign('can_swap', $can_swap);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.userForm.name.focus();handleClientControl();"');
$smarty->assign('user_id', $user_id);
$smarty->assign('title', $i18n->get('title.edit_user'));
$smarty->assign('content_page_name', 'user_edit.tpl');
$smarty->display('index.tpl');
