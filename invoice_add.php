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
import('ttInvoiceHelper');

// Access check.
if (!ttAccessCheck(right_manage_team) || !$user->isPluginEnabled('iv')) {
  header('Location: access_denied.php');
  exit();
}

if ($request->isPost()) {
  $cl_date = $request->getParameter('date');
  $cl_client = $request->getParameter('client');
  $cl_project = $request->getParameter('project');
  $cl_number = trim($request->getParameter('number'));
  $cl_start = $request->getParameter('start');
  $cl_finish = $request->getParameter('finish');
}

$form = new Form('invoiceForm');
$form->addInput(array('type'=>'datefield','name'=>'date','size'=>'20','value'=>$cl_date));

// Dropdown for clients if the clients plugin is enabled.
if ($user->isPluginEnabled('cl')) {
  $clients = ttTeamHelper::getActiveClients($user->team_id);
  $form->addInput(array('type'=>'combobox','name'=>'client','style'=>'width: 250px;','data'=>$clients,'datakeys'=>array('id','name'),'value'=>$cl_client,'empty'=>array(''=>$i18n->getKey('dropdown.select'))));
}
// Dropdown for projects.
if (MODE_PROJECTS == $user->tracking_mode || MODE_PROJECTS_AND_TASKS == $user->tracking_mode) {
  $projects = ttTeamHelper::getActiveProjects($user->team_id);
  $form->addInput(array('type'=>'combobox','name'=>'project','style'=>'width: 250px;','data'=>$projects,'datakeys'=>array('id','name'),'value'=>$cl_project,'empty'=>array(''=>$i18n->getKey('dropdown.all'))));
}
$form->addInput(array('type'=>'text','maxlength'=>'100','name'=>'number','style'=>'width: 250px;','value'=>$cl_number));
$form->addInput(array('type'=>'datefield','maxlength'=>'20','name'=>'start','value'=>$cl_start));
$form->addInput(array('type'=>'datefield','maxlength'=>'20','name'=>'finish','value'=>$cl_finish));
$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->getKey('button.add')));

if ($request->isPost()) {
  // Validate user input.
  if (!ttValidString($cl_number)) $err->add($i18n->getKey('error.field'), $i18n->getKey('form.invoice.number'));
  if (!ttValidDate($cl_date)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.date'));
  if (!$cl_client) $err->add($i18n->getKey('error.client'));
  if (!ttValidDate($cl_start)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.start_date'));
  if (!ttValidDate($cl_finish)) $err->add($i18n->getKey('error.field'), $i18n->getKey('label.end_date'));

  $fields = array('date'=>$cl_date,'name'=>$cl_number,'client_id'=>$cl_client,'project_id'=>$cl_project,'start_date'=>$cl_start,'end_date'=>$cl_finish);
  if ($err->no()) {
    if (ttInvoiceHelper::getInvoiceByName($cl_number))
      $err->add($i18n->getKey('error.invoice_exists'));

    if (!ttInvoiceHelper::invoiceableItemsExist($fields))
      $err->add($i18n->getKey('error.no_invoiceable_items'));
  }

  if ($err->no()) {
    // Now we can go ahead and create our invoice.
    if (ttInvoiceHelper::createInvoice($fields)) {
      header('Location: invoices.php');
      exit();
    } else {
      $err->add($i18n->getKey('error.db'));
    }
  }
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="document.invoiceForm.number.focus()"');
$smarty->assign('title', $i18n->getKey('title.add_invoice'));
$smarty->assign('content_page_name', 'invoice_add.tpl');
$smarty->display('index.tpl');
