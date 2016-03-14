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
  $cl_team_name = trim($request->getParameter('team_name'));
  $cl_manager_name = trim($request->getParameter('manager_name'));
  $cl_manager_login = trim($request->getParameter('manager_login'));
  if (!$auth->isPasswordExternal()) {
    $cl_password1 = $request->getParameter('password1');
    $cl_password2 = $request->getParameter('password2');
  }
  $cl_manager_email = trim($request->getParameter('manager_email'));
}
  
$form = new Form('teamForm');
$form->addInput(array('type'=>'text','maxlength'=>'200','name'=>'team_name','value'=>$cl_team_name));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_name','value'=>$cl_manager_name));
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_login','value'=>$cl_manager_login));
if (!$auth->isPasswordExternal()) {
  $form->addInput(array('type'=>'text','maxlength'=>'30','name'=>'password1','aspassword'=>true,'value'=>$cl_password1));
  $form->addInput(array('type'=>'text','maxlength'=>'30','name'=>'password2','aspassword'=>true,'value'=>$cl_password2));
}
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'manager_email','value'=>$cl_manager_email));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->getKey('button.submit')));

if ($request->getMethod() == 'POST') {
  // Validate user input.
  if (!ttValidString($cl_team_name, true)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.team_name'));
  if (!ttValidString($cl_manager_name)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.manager_name'));
  if (!ttValidString($cl_manager_login)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.manager_login'));
  if (!$auth->isPasswordExternal()) {
    if (!ttValidString($cl_password1)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.password'));
    if (!ttValidString($cl_password2)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.confirm_password'));
    if ($cl_password1 !== $cl_password2)
      $errors->add($i18n->getKey('error.not_equal'), $i18n->getKey('label.password'), $i18n->getKey('label.confirm_password'));
  }	
  if (!ttValidEmail($cl_manager_email, true)) $errors->add($i18n->getKey('error.field'), $i18n->getKey('label.email'));
    
  if ($errors->isEmpty()) {
    if (!ttUserHelper::getUserByLogin($cl_manager_login)) {
      // Create a new team.
      if (!defined('CURRENCY_DEFAULT')) define('CURRENCY_DEFAULT', '$');
      $team_id = ttTeamHelper::insert(array('name'=>$cl_team_name,'currency'=>CURRENCY_DEFAULT));
      if ($team_id) {
      // Team created, now create a team manager.
        $user_id = ttUserHelper::insert(array(
      	  'team_id' => $team_id,
      	  'role' => ROLE_MANAGER,
          'name' => $cl_manager_name,
          'login' => $cl_manager_login,
          'password' => $cl_password1,
      	  'email' => $cl_manager_email));
      }
      if ($team_id && $user_id) {
        header('Location: admin_teams.php');
      } else
        $errors->add($i18n->getKey('error.db'));
    } else
      $errors->add($i18n->getKey('error.user_exists'));
  }
}

$smarty->assign('auth_external', $auth->isPasswordExternal());
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.teamForm.team.focus()"');
$smarty->assign('content_page_name', 'admin_team_add.tpl');
$smarty->assign('title', $i18n->getKey('title.create_team'));
$smarty->display('index.tpl');
