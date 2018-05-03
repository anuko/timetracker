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

require_once('../initialize.php');
import('form.Form');
import('ttClientHelper');

// Access checks.
if (!ttAccessAllowed('manage_clients')) {
  header('Location: access_denied.php');
  exit();
}
if (!$user->isPluginEnabled('cl')) {
  header('Location: feature_disabled.php');
  exit();
}

$id = (int)$request->getParameter('id');
$client = ttClientHelper::getClient($id);

$client_to_delete = $client['name'];

$form = new Form('clientDeleteForm');
$form->addInput(array('type'=>'hidden','name'=>'id','value'=>$id));
$form->addInput(array('type'=>'combobox','name'=>'delete_client_entries',
  'data'=>array('0'=>$i18n->get('dropdown.do_not_delete'),'1'=>$i18n->get('dropdown.delete'))));
$form->addInput(array('type'=>'submit','name'=>'btn_delete','value'=>$i18n->get('label.delete')));
$form->addInput(array('type'=>'submit','name'=>'btn_cancel','value'=>$i18n->get('button.cancel')));

if ($request->isPost()) {
  if(ttClientHelper::getClient($id)) {
    if ($request->getParameter('btn_delete')) {
      if (ttClientHelper::delete($id, $request->getParameter('delete_client_entries'))) {
        header('Location: clients.php');
        exit();
      } else
        $err->add($i18n->get('error.db'));
    }
  } else 
      $err->add($i18n->get('error.db'));

  if ($request->getParameter('btn_cancel')) {
    header('Location: clients.php');
    exit();
  }
} // isPost

$smarty->assign('client_to_delete', $client_to_delete);
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.delete_client'));
$smarty->assign('content_page_name', 'mobile/client_delete.tpl');
$smarty->display('mobile/index.tpl');
