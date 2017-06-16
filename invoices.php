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

// Access check.
if (!ttAccessCheck(right_view_invoices) || !$user->isPluginEnabled('iv')) {
  header('Location: access_denied.php');
  exit();
}
$form = new Form('invoicesForm');
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->getKey('button.submit')));
$form->addInput(array('type'=>'datefield','maxlength'=>'20','name'=>'date'));
//$form->addInput(array('type'=>'datefield','maxlength'=>'20','name'=>'end_date'));
        
// Submit.
if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {
      $date_array = split("-", $request->getParameter('date'));
      // $date should be m-Y -> 06-2017
      if ((int)$date_array[1] <= 12 && (int)$date_array[1] >= 1 && (int)$date_array[0] <= 3000 && (int)$date_array[0] >= 2000){
	$invoices = ttTeamHelper::getInvoicesByDate($date_array[1]."-".$date_array[0]);
      } else {
	$invoices = ttTeamHelper::getActiveInvoices();
      }
      $form->setValueByElement("date", $request->getParameter('date'));
  }
} else {
  $form->setValueByElement("date", date("Y-m"));
  $invoices = ttTeamHelper::getActiveInvoices();
}

$smarty->assign('invoices', $invoices);
$smarty->assign('title', $i18n->getKey('title.invoices'));
$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('content_page_name', 'invoices.tpl');
$smarty->display('index.tpl');
