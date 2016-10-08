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
import('ttUserHelper');
import('ttTeamHelper');
import('DateAndTime');
import('ttExpenseHelper');

// Access check.
if (!ttAccessCheck(right_data_entry) || !$user->isPluginEnabled('ex')) {
  header('Location: access_denied.php');
  exit();
}

// Initialize and store date in session.
$cl_date = $request->getParameter('date', @$_SESSION['date']);
$selected_date = new DateAndTime(DB_DATEFORMAT, $cl_date);
if($selected_date->isError())
  $selected_date = new DateAndTime(DB_DATEFORMAT);
if(!$cl_date)
  $cl_date = $selected_date->toString(DB_DATEFORMAT);
$_SESSION['date'] = $cl_date;

// Initialize variables.
$on_behalf_id = $request->getParameter('onBehalfUser', (isset($_SESSION['behalf_id']) ? $_SESSION['behalf_id'] : $user->id));
$cl_client = $request->getParameter('client', ($request->getMethod()=='POST' ? null : @$_SESSION['client']));
$_SESSION['client'] = $cl_client;
$cl_project = $request->getParameter('project', ($request->getMethod()=='POST' ? null : @$_SESSION['project']));
$_SESSION['project'] = $cl_project;
$cl_item_name = $request->getParameter('item_name');
$cl_cost = $request->getParameter('cost');

// Elements of expensesForm.
$form = new Form('expensesForm');

if ($user->canManageTeam()) {
  $user_list = ttTeamHelper::getActiveUsers(array('putSelfFirst'=>true));
  if (count($user_list) > 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'this.form.submit();',
      'name'=>'onBehalfUser',
      'style'=>'width: 250px;',
      'value'=>$on_behalf_id,
      'data'=>$user_list,
      'datakeys'=>array('id','name')));
    $smarty->assign('on_behalf_control', 1);
  }
}

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $user->tracking_mode && $user->isPluginEnabled('cl')) {
    $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'value'=>$cl_client,
      'data'=>$active_clients,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
  // Note: in other modes the client list is filtered to relevant clients only. See below.
}

if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  // Dropdown for projects assigned to user.
  $project_list = $user->getAssignedProjects();
  $form->addInput(array('type'=>'combobox',
    // 'onchange'=>'fillTaskDropdown(this.value);',
    'name'=>'project',
    'style'=>'width: 250px;',
    'value'=>$cl_project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->getKey('dropdown.select'))));

  // Dropdown for clients if the clients plugin is enabled.
  if ($user->isPluginEnabled('cl')) {
    $active_clients = ttTeamHelper::getActiveClients($user->team_id, true);
    // We need an array of assigned project ids to do some trimming. 
    foreach($project_list as $project)
      $projects_assigned_to_user[] = $project['id'];

    // Build a client list out of active clients. Use only clients that are relevant to user.
    // Also trim their associated project list to only assigned projects (to user).
    foreach($active_clients as $client) {
      $projects_assigned_to_client = explode(',', $client['projects']);
      $intersection = array_intersect($projects_assigned_to_client, $projects_assigned_to_user);
      if ($intersection) {
        $client['projects'] = implode(',', $intersection);
        $client_list[] = $client;
      }
    }
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'fillProjectDropdown(this.value);',
      'name'=>'client',
      'style'=>'width: 250px;',
      'value'=>$cl_client,
      'data'=>$client_list,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
  }
}
$form->addInput(array('type'=>'textarea','maxlength'=>'800','name'=>'item_name','style'=>'width: 250px; height:'.NOTE_INPUT_HEIGHT.'px;','value'=>$cl_item_name));
$form->addInput(array('type'=>'text','maxlength'=>'40','name'=>'cost','style'=>'width: 100px;','value'=>$cl_cost));
$form->addInput(array('type'=>'calendar','name'=>'date','highlight'=>'expenses','value'=>$cl_date)); // calendar
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_submit click.
$form->addInput(array('type'=>'submit','name'=>'btn_submit','onclick'=>'browser_today.value=get_date()','value'=>$i18n->getKey('button.submit')));

// Submit.
if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {
    // Validate user input.
    if ($user->isPluginEnabled('cl') && $user->isPluginEnabled('cm') && !$cl_client)
      $err->add($i18n->getKey('error.client'));
    if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
      if (!$cl_project) $err->add($i18n->getKey('error.project'));
    }
    if (!ttValidString($cl_item_name)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.item'));
    if (!ttValidFloat($cl_cost)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.cost'));

    // Prohibit creating entries in future.
    if (defined('FUTURE_ENTRIES') && !isTrue(FUTURE_ENTRIES)) {
      $browser_today = new DateAndTime(DB_DATEFORMAT, $request->getParameter('browser_today', null));
      if ($selected_date->after($browser_today))
        $err->add($i18n->getKey('error.future_date'));
    }
    // Finished validating input data.

    // Prohibit creating entries in locked range.
    if ($user->isDateLocked($selected_date))
      $err->add($i18n->getKey('error.range_locked'));

    // Insert record.
    if ($err->no()) {
      if (ttExpenseHelper::insert(array('date'=>$cl_date,'user_id'=>$user->getActiveUser(),
        'client_id'=>$cl_client,'project_id'=>$cl_project,'name'=>$cl_item_name,'cost'=>$cl_cost,'status'=>1))) {
        header('Location: expenses.php');
        exit();
      } else
        $err->add($i18n->getKey('error.db'));
    }
  } elseif ($request->getParameter('onBehalfUser')) {
    if($user->canManageTeam()) {
      unset($_SESSION['behalf_id']);
      unset($_SESSION['behalf_name']);

      if($on_behalf_id != $user->id) {
        $_SESSION['behalf_id'] = $on_behalf_id;
        $_SESSION['behalf_name'] = ttUserHelper::getUserName($on_behalf_id);
      }
      header('Location: expenses.php');
      exit();
    }
  }
}

$smarty->assign('day_total', ttExpenseHelper::getTotalForDay($user->getActiveUser(), $cl_date));
$smarty->assign('expense_items', ttExpenseHelper::getItems($user->getActiveUser(), $cl_date));
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('timestring', $selected_date->toString($user->date_format));
$smarty->assign('title', $i18n->getKey('title.expenses'));
$smarty->assign('content_page_name', 'expenses.tpl');
$smarty->display('index.tpl');
