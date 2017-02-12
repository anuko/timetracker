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
import('ttPredefinedExpenseHelper');

// Access check.
if (!ttAccessCheck(right_manage_team) || !$user->isPluginEnabled('ex')) {
  header('Location: access_denied.php');
  exit();
}

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('name'));
  $cl_cost = trim($request->getParameter('cost'));
}

$form = new Form('predefinedExpenseForm');
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'name','style'=>'width: 250px;','value'=>$cl_name));
$form->addInput(array('type'=>'text','maxlength'=>'40','name'=>'cost','style'=>'width: 100px;','value'=>$cl_cost));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->getKey('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.thing_name'));
  if (!ttValidFloat($cl_cost)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.cost'));
  if ($err->no()) {
    if (ttPredefinedExpenseHelper::insert(array(
        'team_id' => $user->team_id,
        'name' => $cl_name,
        'cost' => $cl_cost))) {
        header('Location: predefined_expenses.php');
        exit();
      } else
        $err->add($i18n->getKey('error.db'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->getKey('title.add_predefined_expense'));
$smarty->assign('content_page_name', 'predefined_expense_add.tpl');
$smarty->display('index.tpl');
