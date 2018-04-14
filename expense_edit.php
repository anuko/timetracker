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
import('ttTeamHelper');
import('DateAndTime');
import('ttExpenseHelper');

// Access checks.
if (!(ttAccessAllowed('track_own_expenses') || ttAccessAllowed('track_expenses'))) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('ex')) {
  header('Location: feature_disabled.php');
  exit();
}
$cl_id = (int)$request->getParameter('id');
// Get the expense item we are editing.
$expense_item = ttExpenseHelper::getItem($cl_id, $user->getActiveUser());
if (!$expense_item || $expense_item['invoice_id']) {
  // Prohibit editing not ours or invoiced items.
  header('Location: access_denied.php');
  exit();
}

$item_date = new DateAndTime(DB_DATEFORMAT, $expense_item['date']);

// Initialize variables.
$cl_date = $cl_client = $cl_project = $cl_item_name = $cl_cost = null;
if ($request->isPost()) {
  $cl_date = trim($request->getParameter('date'));
  $cl_client = $request->getParameter('client');
  $cl_project = $request->getParameter('project');
  $cl_item_name = trim($request->getParameter('item_name'));
  $cl_cost = trim($request->getParameter('cost'));
  if ($user->isPluginEnabled('ps'))
    $cl_paid = $request->getParameter('paid');
} else {
  $cl_date = $item_date->toString($user->date_format);
  $cl_client = $expense_item['client_id'];
  $cl_project = $expense_item['project_id'];
  $cl_item_name = $expense_item['name'];
  $cl_cost = $expense_item['cost'];
  $cl_paid = $expense_item['paid'];
}

// Initialize elements of 'expenseItemForm'.
$form = new Form('expenseItemForm');

// Dropdown for clients in MODE_TIME. Use all active clients.
if (MODE_TIME == $user->tracking_mode && $user->isPluginEnabled('cl')) {
  $active_clients = ttTeamHelper::getActiveClients($user->group_id, true);
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'fillProjectDropdown(this.value);',
    'name'=>'client',
    'style'=>'width: 250px;',
    'value'=>$cl_client,
    'data'=>$active_clients,
    'datakeys'=>array('id', 'name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));
  // Note: in other modes the client list is filtered to relevant clients only. See below.
}

if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  // Dropdown for projects assigned to user.
  $project_list = $user->getAssignedProjects();
  $form->addInput(array('type'=>'combobox',
    'name'=>'project',
    'style'=>'width: 250px;',
    'value'=>$cl_project,
    'data'=>$project_list,
    'datakeys'=>array('id','name'),
    'empty'=>array(''=>$i18n->get('dropdown.select'))));

  // Dropdown for clients if the clients plugin is enabled.
  if ($user->isPluginEnabled('cl')) {
    $active_clients = ttTeamHelper::getActiveClients($user->group_id, true);
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
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
  }
}
// If predefined expenses are configured, add controls to select an expense and quantity.
$predefined_expenses = ttTeamHelper::getPredefinedExpenses($user->group_id);
if ($predefined_expenses) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'recalculateCost();',
      'name'=>'predefined_expense',
      'style'=>'width: 250px;',
      'value'=>$cl_predefined_expense,
      'data'=>$predefined_expenses,
      'datakeys'=>array('id', 'name'),
      'empty'=>array(''=>$i18n->get('dropdown.select'))));
    $form->addInput(array('type'=>'text','onchange'=>'recalculateCost();','maxlength'=>'40','name'=>'quantity','style'=>'width: 100px;','value'=>$cl_quantity));
}
$form->addInput(array('type'=>'textarea','maxlength'=>'800','name'=>'item_name','style'=>'width: 250px; height:'.NOTE_INPUT_HEIGHT.'px;','value'=>$cl_item_name));
$form->addInput(array('type'=>'text','maxlength'=>'40','name'=>'cost','style'=>'width: 100px;','value'=>$cl_cost));
if ($user->can('manage_invoices') && $user->isPluginEnabled('ps'))
  $form->addInput(array('type'=>'checkbox','name'=>'paid','value'=>$cl_paid));
$form->addInput(array('type'=>'datefield','name'=>'date','maxlength'=>'20','value'=>$cl_date));
// Hidden control for record id.
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$cl_id));
$form->addInput(array('type'=>'hidden','name'=>'browser_today','value'=>'')); // User current date, which gets filled in on btn_save or btn_copy click.
$form->addInput(array('type'=>'submit','name'=>'btn_save','onclick'=>'browser_today.value=get_date()','value'=>$i18n->get('button.save')));
$form->addInput(array('type'=>'submit','name'=>'btn_copy','onclick'=>'browser_today.value=get_date()','value'=>$i18n->get('button.copy')));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));

if ($request->isPost()) {
  // Validate user input.
  if ($user->isPluginEnabled('cl') && $user->isPluginEnabled('cm') && !$cl_client)
    $err->add($i18n->get('error.client'));
  if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
    if (!$cl_project) $err->add($i18n->get('error.project'));
  }
  if (!ttValidString($cl_item_name)) $err->add($i18n->get('error.field'), $i18n->get('label.item'));
  if (!ttValidFloat($cl_cost)) $err->add($i18n->get('error.field'), $i18n->get('label.cost'));
  if (!ttValidDate($cl_date)) $err->add($i18n->get('error.field'), $i18n->get('label.date'));

  // This is a new date for the expense item.
  $new_date = new DateAndTime($user->date_format, $cl_date);

  // Prohibit creating entries in future.
  if (!$user->future_entries) {
    $browser_today = new DateAndTime(DB_DATEFORMAT, $request->getParameter('browser_today', null));
    if ($new_date->after($browser_today))
      $err->add($i18n->get('error.future_date'));
  }

  // Save record.
  if ($request->getParameter('btn_save')) {
    // We need to:
    // 1) Prohibit updating locked entries (that are in locked range).
    // 2) Prohibit saving unlocked entries into locked range.

    // Now, step by step.
    // 1) Prohibit saving locked entries in any form.
    if ($user->isDateLocked($item_date))
      $err->add($i18n->get('error.range_locked'));

    // 2) Prohibit saving unlocked entries into locked range.
    if ($err->no() && $user->isDateLocked($new_date))
      $err->add($i18n->get('error.range_locked'));

    // Now, an update.
    if ($err->no()) {
      if (ttExpenseHelper::update(array('id'=>$cl_id,'date'=>$new_date->toString(DB_DATEFORMAT),'user_id'=>$user->getActiveUser(),
          'client_id'=>$cl_client,'project_id'=>$cl_project,'name'=>$cl_item_name,'cost'=>$cl_cost,'paid'=>$cl_paid))) {
        header('Location: expenses.php?date='.$new_date->toString(DB_DATEFORMAT));
        exit();
      }
    }
  }

  // Save as new record.
  if ($request->getParameter('btn_copy')) {
    // We need to prohibit saving into locked interval.
    if ($user->isDateLocked($new_date))
      $err->add($i18n->get('error.range_locked'));

    // Now, a new insert.
    if ($err->no()) {
      if (ttExpenseHelper::insert(array('date'=>$new_date->toString(DB_DATEFORMAT),'user_id'=>$user->getActiveUser(),
        'client_id'=>$cl_client,'project_id'=>$cl_project,'name'=>$cl_item_name,'cost'=>$cl_cost,'status'=>1))) {
        header('Location: expenses.php?date='.$new_date->toString(DB_DATEFORMAT));
        exit();
      } else
        $err->add($i18n->get('error.db'));
    }
  }

  if ($request->getParameter('btn_delete')) {
    header("Location: expense_delete.php?id=$cl_id");
    exit();
  }
} // isPost

$smarty->assign('predefined_expenses', $predefined_expenses);
$smarty->assign('client_list', $client_list);
$smarty->assign('project_list', $project_list);
$smarty->assign('task_list', $task_list);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.edit_expense'));
$smarty->assign('content_page_name', 'expense_edit.tpl');
$smarty->display('index.tpl');
