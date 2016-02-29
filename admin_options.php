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
if (!ttAccessCheck(right_administer_site)) {
  header('Location: access_denied.php');
  exit();
}

if ($request->getMethod() == 'POST') {
  $cl_password1 = $request->getParameter('password1');
  $cl_password2 = $request->getParameter('password2');
}

$form = new Form('optionsForm');
$form->addInput(array('type'=>'text','aspassword'=>true,'maxlength'=>'30','name'=>'password1','style'=>'width: 150px;','value'=>$cl_password1));
$form->addInput(array('type'=>'text','aspassword'=>true,'maxlength'=>'30','name'=>'password2','style'=>"width: 150px;",'value'=>$cl_password2));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->getKey('button.submit')));

if ($request->getMethod() == 'POST') {
  if ($cl_password1 || $cl_password2) {
  	// Validate user input.
  	if (!ttValidString($cl_password1)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.password'));
  	if (!ttValidString($cl_password2)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.confirm_password'));
    if ($cl_password1 !== $cl_password2)
      $errors->add($i18n->getKey('error.not_equal'), $i18n->getKey('label.password'), $i18n->getKey('label.confirm_password'));
  }

  if ($errors->isEmpty() && $cl_password1) {
    if (ttUserHelper::setPassword($user->id, $cl_password1)) {
      header('Location: admin_teams.php');
      exit();
    } else
      $errors->add($i18n->getKey('error.db'));
  }
} // post

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->getKey('title.options'));
$smarty->assign('content_page_name', 'admin_options.tpl');
$smarty->display('index.tpl');
?>