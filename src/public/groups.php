<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

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
  $group_id = (int)$request->getParameter('group');
  $user->setOnBehalfGroup($group_id);
} else {
  $group_id = $user->getGroup();
}

$form = new Form('subgroupsForm');
$groups = $user->getGroupsForDropdown();
if (count($groups) > 1) {
  $form->addInput(array('type'=>'combobox',
    'onchange'=>'this.form.submit();',
    'name'=>'group',
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
