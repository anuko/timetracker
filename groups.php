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
import('ttUser');
import('form.Form');

// Access checks.
if (!ttAccessAllowed('manage_subgroups')) {
  header('Location: access_denied.php');
  exit();
}
if ($request->isPost() && !$user->isGroupValid($request->getParameter('group'))) {
  header('Location: access_denied.php'); // Wrong group id in post.
  exit();
}
// End of access checks.

if ($request->isPost()) {
  $group_id = $request->getParameter('group');
  $user->setOnBehalfGroup($group_id);
} else {
  $group_id = $user->getActiveGroup();
}

$form = new Form('subgroupsForm');
$groups = $user->getGroupsForDropdown();
if (count($groups) > 1) {
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'this.form.submit();',
    'name'=>'group',
    'style'=>'width: 250px;',
    'value'=>$group_id,
    'data'=>$groups,
    'datakeys'=>array('id','name')));
  $smarty->assign('group_dropdown', 1);
}

$smarty->assign('subgroups', $user->getSubgroups($group_id));
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('label.subgroups'));
$smarty->assign('content_page_name', 'groups.tpl');
$smarty->display('index.tpl');
