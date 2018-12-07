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

// Access checks.
if (!ttAccessAllowed('manage_features')) {
  header('Location: access_denied.php');
  exit();
}
if ($request->isPost()) {
  $groupChanged = $request->getParameter('group_changed'); // Reused in multiple places below.
  if ($groupChanged && !($user->can('manage_subgroups') && $user->isGroupValid($request->getParameter('group')))) {
    header('Location: access_denied.php'); // Group changed, but no rght or wrong group id.
    exit();
  }
}
// End of access checks.

// Determine group for which we display this page.
if ($request->isPost() && $groupChanged) {
  $group_id = $request->getParameter('group');
  $user->setOnBehalfGroup($group_id);
} else {
  $group_id = $user->getGroup();
}

if ($request->isPost() && $request->getParameter('btn_save')) {
  // Plugins that user wants to save for the current group.
  $cl_charts = $request->getParameter('charts');
  $cl_clients = $request->getParameter('clients');
  $cl_client_required = $request->getParameter('client_required');
  $cl_invoices = $request->getParameter('invoices');
  $cl_paid_status = $request->getParameter('paid_status');
  $cl_custom_fields = $request->getParameter('custom_fields');
  $cl_expenses = $request->getParameter('expenses');
  $cl_tax_expenses = $request->getParameter('tax_expenses');
  $cl_notifications = $request->getParameter('notifications');
  $cl_locking = $request->getParameter('locking');
  $cl_quotas = $request->getParameter('quotas');
  $cl_week_view = $request->getParameter('week_view');
  $cl_work_units = $request->getParameter('work_units');
} else {
  // Note: we get here in get, and also in post when group changes.
  // Which plugins do we have enabled in currently selected group?
  $plugins = explode(',', $user->getPlugins());
  $cl_charts = in_array('ch', $plugins);
  $cl_clients = in_array('cl', $plugins);
  $cl_client_required = in_array('cm', $plugins);
  $cl_invoices = in_array('iv', $plugins);
  $cl_paid_status = in_array('ps', $plugins);
  $cl_custom_fields = in_array('cf', $plugins);
  $cl_expenses = in_array('ex', $plugins);
  $cl_tax_expenses = in_array('et', $plugins);
  $cl_notifications = in_array('no', $plugins);
  $cl_locking = in_array('lk', $plugins);
  $cl_quotas = in_array('mq', $plugins);
  $cl_week_view = in_array('wv', $plugins);
  $cl_work_units = in_array('wu', $plugins);
}

$form = new Form('pluginsForm');
// Group dropdown.
if ($user->can('manage_subgroups')) {
  $groups = $user->getGroupsForDropdown();
  if (count($groups) > 1) {
    $form->addInput(array('type'=>'combobox',
      'onchange'=>'document.pluginsForm.group_changed.value=1;document.pluginsForm.submit();',
      'name'=>'group',
      'style'=>'width: 250px;',
      'value'=>$group_id,
      'data'=>$groups,
      'datakeys'=>array('id','name')));
    $form->addInput(array('type'=>'hidden','name'=>'group_changed'));
    $smarty->assign('group_dropdown', 1);
  }
}
// Plugin checkboxes.
$form->addInput(array('type'=>'checkbox','name'=>'charts','value'=>$cl_charts));
$form->addInput(array('type'=>'checkbox','name'=>'clients','value'=>$cl_clients,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'client_required','value'=>$cl_client_required));
$form->addInput(array('type'=>'checkbox','name'=>'invoices','value'=>$cl_invoices));
$form->addInput(array('type'=>'checkbox','name'=>'paid_status','value'=>$cl_paid_status));
$form->addInput(array('type'=>'checkbox','name'=>'custom_fields','value'=>$cl_custom_fields,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'expenses','value'=>$cl_expenses,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'tax_expenses','value'=>$cl_tax_expenses));
$form->addInput(array('type'=>'checkbox','name'=>'notifications','value'=>$cl_notifications,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'locking','value'=>$cl_locking,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'quotas','value'=>$cl_quotas,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'week_view','value'=>$cl_week_view,'onchange'=>'handlePluginCheckboxes()'));
$form->addInput(array('type'=>'checkbox','name'=>'work_units','value'=>$cl_work_units,'onchange'=>'handlePluginCheckboxes()'));
// Submit button.
$form->addInput(array('type'=>'submit','name'=>'btn_save','value'=>$i18n->get('button.save')));

if ($request->isPost() && $request->getParameter('btn_save')) {
  // Note: we get here when the Save button is clicked.
  // We update plugin list for the currently selected group.
  //
  // We don't get here if group changed in post.
  // In this case the page is simply re-displayed for new group.

  // Prepare plugins string.
  if ($cl_charts)
    $plugins .= ',ch';
  if ($cl_clients)
     $plugins .= ',cl';
  if ($cl_client_required)
    $plugins .= ',cm';
  if ($cl_invoices)
    $plugins .= ',iv';
  if ($cl_paid_status)
    $plugins .= ',ps';
  if ($cl_custom_fields)
    $plugins .= ',cf';
  if ($cl_expenses)
    $plugins .= ',ex';
  if ($cl_tax_expenses)
    $plugins .= ',et';
  if ($cl_notifications)
    $plugins .= ',no';
  if ($cl_locking)
    $plugins .= ',lk';
  if ($cl_quotas)
    $plugins .= ',mq';
  if ($cl_week_view)
    $plugins .= ',wv';
  if ($cl_work_units)
    $plugins .= ',wu';

  // Recycle week view plugin options as they are not configured on this page.
  $existing_plugins = explode(',', $user->getPlugins());
  if (in_array('wvn', $existing_plugins))
    $plugins .= ',wvn';
  if (in_array('wvl', $existing_plugins))
    $plugins .= ',wvl';
  if (in_array('wvns', $existing_plugins))
    $plugins .= ',wvns';

  $plugins = trim($plugins, ',');

  if ($user->updateGroup(array(
    'plugins' => $plugins))) {
    header('Location: success.php');
    exit();
  } else
    $err->add($i18n->get('error.db'));
} // isPost

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('onload', 'onLoad="handlePluginCheckboxes();"');
$smarty->assign('user_exists', $user->exists());
$smarty->assign('title', $i18n->get('title.plugins'));
$smarty->assign('content_page_name', 'plugins.tpl');
$smarty->display('index.tpl');
