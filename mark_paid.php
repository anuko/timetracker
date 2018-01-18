<?php
require_once('initialize.php');
import('form.ActionForm');
import('form.Form');

$form = new Form('reportForm');

// Create a bean (which is a mechanism to remember form values in session).
$bean = new ActionForm('reportBean', $form, $request);

if ($user->canManageTeam()) {
  require_once('plugins/PaidStatus.class.php');
  PaidStatus::markReportPaid($bean);
  $message = "Report marked as paid.";
} else {
  $message = "Access Denied";
}

$smarty->assign('message', $message);
$smarty->assign('content_page_name', 'mark_paid.tpl');
$smarty->display('index.tpl');