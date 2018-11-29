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
import('ttGroupHelper');

// Access checks.
if (!ttAccessAllowed('manage_subgroups')) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

if ($request->isPost()) {
  $cl_name = trim($request->getParameter('group_name'));
  $cl_description = trim($request->getParameter('description'));
}

$form = new Form('groupForm');
$form->addInput(array('type'=>'text','maxlength'=>'200','name'=>'group_name','value'=>$cl_name));
$form->addInput(array('type'=>'textarea','name'=>'description','style'=>'width: 250px; height: 40px;','value'=>$cl_description));
$form->addInput(array('type'=>'submit','name'=>'btn_add','value'=>$i18n->get('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_name)) $err->add($i18n->get('error.field'), $i18n->get('label.thing_name'));
  if (!ttValidString($cl_description, true)) $err->add($i18n->get('error.field'), $i18n->get('label.description'));

  if ($err->no()) {
    if (!ttGroupHelper::getSubgroupByName($cl_name)) {
       if (ttGroupHelper::insertSubgroup(array(
        'name' => $cl_name,
        'description' => $cl_description))) {
          header('Location: groups.php');
          exit();
        } else
          $err->add($i18n->get('error.db'));
    } else
      $err->add($i18n->get('error.object_exists'));
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.groupForm.group_name.focus()"');
$smarty->assign('title', $i18n->get('title.add_group'));
$smarty->assign('content_page_name', 'group_add.tpl');
$smarty->display('index.tpl');
