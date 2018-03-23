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

// Access check.
if (!ttAccessAllowed('swap_roles')) {
  header('Location: access_denied.php');
  exit();
}

$users = ttTeamHelper::getUsersForSwap();

if ($request->isPost()) {
  $cl_id = $request->getParameter('swap_with');
}

$form = new Form('swapForm');
$form->addInput(array('type'=>'combobox','name'=>'swap_with','style'=>'width: 250px;','data'=>$users,'datakeys'=>array('id','name')));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));

if ($request->isPost()) {
  if (ttTeamHelper::swapRolesWith($cl_id)) {
    header('Location: users.php');
    exit();
  } else
    $err->add($i18n->get('error.db'));
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.swap_roles'));
$smarty->assign('content_page_name', 'swap_roles.tpl');
$smarty->display('index.tpl');
