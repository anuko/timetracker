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
import('form.ActionForm');
import('ttReportHelper');

// Access check.
if (!ttAccessCheck(right_view_reports)) {
  header('Location: access_denied.php');
  exit();
}

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields($user->team_id);
}

// Set the separator
$SEPARATOR = ";";

// Report settings are stored in session bean before we get here.
$bean = new ActionForm('reportBean', new Form('reportForm'), $request);


// Also, there are 2 variations of report: totals only, or normal. Totals only means that the report
// is grouped by (either date, user, client, project, task or cf_1) and user only needs to see subtotals by group.
$totals_only = $bean->getAttribute('chtotalsonly');

// Obtain items.
if ($totals_only)
  $subtotals = ttReportHelper::getSubtotals($bean);
else
  $items = ttReportHelper::getItems($bean);

// Build a string to use as filename for the files being downloaded.
$filename = strtolower($i18n->getKey('title.report')).'_'.$bean->mValues['start_date'].'_'.$bean->mValues['end_date'];

header('Pragma: public'); // This is needed for IE8 to download files over https.
header('Content-Type: text/html; charset=utf-8');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Cache-Control: private', false);


header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="'.$filename.'.csv"');

// Print UTF8 BOM first to identify encoding.
$bom = chr(239).chr(187).chr(191); // 0xEF 0xBB 0xBF in the beginning of the file is UTF8 BOM.
print $bom; // Without this Excel does not display UTF8 characters properly.

$group_by = $bean->getAttribute('group_by');
if ($totals_only) {
  // Totals only report.

  // Determine group_by header.
  if ('cf_1' == $group_by)
    $group_by_header = $custom_fields->fields[0]['label'];
  else {
    $key = 'label.'.$group_by;
    $group_by_header = $i18n->getKey($key);
  }

  // Print headers.
  print '"'.$group_by_header.'"';
  if ($bean->getAttribute('chduration')) print $SEPARATOR.'"'.$i18n->getKey('label.duration').'"';
  if ($bean->getAttribute('chcost')) print $SEPARATOR.'"'.$i18n->getKey('label.cost').'"';
  print "\n";

  // Print subtotals.
  foreach ($subtotals as $subtotal) {
    print '"'.$subtotal['name'].'"';
    if ($bean->getAttribute('chduration')) {
      $val = $subtotal['time'];
      if($val && defined('EXPORT_DECIMAL_DURATION') && isTrue(EXPORT_DECIMAL_DURATION))
	$val = time_to_decimal($val);
      print $SEPARATOR.'"'.$val.'"';
    }
    if ($bean->getAttribute('chcost')) {
      if ($user->canManageTeam() || $user->isClient())
	print $SEPARATOR.'"'.$subtotal['cost'].'"';
      else
	print $SEPARATOR.'"'.$subtotal['expenses'].'"';
    }
    print "\n";
  }
} else {
  // Normal report. Print headers.
  print '"'.$i18n->getKey('label.date').'"';
  if ($user->canManageTeam() || $user->isClient()) print $SEPARATOR.'"'.$i18n->getKey('label.user').'"';
  if ($bean->getAttribute('chclient')) print $SEPARATOR.'"'.$i18n->getKey('label.client').'"';
  if ($bean->getAttribute('chclient_number')) print $SEPARATOR.'"'.$i18n->getKey('label.client_number').'"';
  if ($bean->getAttribute('chproject')) print $SEPARATOR.'"'.$i18n->getKey('label.project').'"';
  if ($bean->getAttribute('chtask')) print $SEPARATOR.'"'.$i18n->getKey('label.task').'"';
  if ($bean->getAttribute('chcf_1')) print $SEPARATOR.'"'.$custom_fields->fields[0]['label'].'"';
  if ($bean->getAttribute('chstart')) print $SEPARATOR.'"'.$i18n->getKey('label.start').'"';
  if ($bean->getAttribute('chfinish')) print $SEPARATOR.'"'.$i18n->getKey('label.finish').'"';
  if ($bean->getAttribute('chduration')) print $SEPARATOR.'"'.$i18n->getKey('label.duration').'"';
  if ($bean->getAttribute('chnote')) print $SEPARATOR.'"'.$i18n->getKey('label.note').'"';
  if ($bean->getAttribute('chcost')) print $SEPARATOR.'"'.$i18n->getKey('label.cost').'"';
  if ($bean->getAttribute('chinvoice')) print $SEPARATOR.'"'.$i18n->getKey('label.invoice').'"';
  if ($bean->getAttribute('chbillable')) print $SEPARATOR.'"'.$i18n->getKey('label.billable').'"';
  print "\n";

  // Print items.
  foreach ($items as $item) {
    print '"'.$item['date'].'"';
    if ($user->canManageTeam() || $user->isClient()) print $SEPARATOR.'"'.str_replace('"','""',$item['user']).'"';
    if ($bean->getAttribute('chclient')) print $SEPARATOR.'"'.str_replace('"','""',$item['client']).'"';
    if ($bean->getAttribute('chclient_number')) print $SEPARATOR.'"'.str_replace('"','""',$item['client_number']).'"';
    if ($bean->getAttribute('chproject')) print $SEPARATOR.'"'.str_replace('"','""',$item['project']).'"';
    if ($bean->getAttribute('chtask')) print $SEPARATOR.'"'.str_replace('"','""',$item['task']).'"';
    if ($bean->getAttribute('chcf_1')) print $SEPARATOR.'"'.str_replace('"','""',$item['cf_1']).'"';
    if ($bean->getAttribute('chstart')) print $SEPARATOR.'"'.$item['start'].'"';
    if ($bean->getAttribute('chfinish')) print $SEPARATOR.'"'.$item['finish'].'"';
    if ($bean->getAttribute('chduration')) {
      $val = $item['duration'];
      if($val && defined('EXPORT_DECIMAL_DURATION') && isTrue(EXPORT_DECIMAL_DURATION))
	$val = time_to_decimal($val);
      print $SEPARATOR.'"'.$val.'"';
    }
    // Remove new line? str_replace(array("\r", "\n"), ' ', );
    if ($bean->getAttribute('chnote')) print $SEPARATOR.'"'.str_replace('"','""',$item['note']).'"';
    if ($bean->getAttribute('chcost')) {
      if ($user->canManageTeam() || $user->isClient())
	print $SEPARATOR.'"'.$item['cost'].'"';
      else
	print $SEPARATOR.'"'.$item['expense'].'"';
    }
    if ($bean->getAttribute('chinvoice')) print $SEPARATOR.'"'.str_replace('"','""',$item['invoice']).'"';
	if ($bean->getAttribute('chbillable')) print $SEPARATOR.'"'.$item['billable'].'"';
    print "\n";
  }
}

