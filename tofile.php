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

// Access checks.
if (!(ttAccessAllowed('view_own_reports') || ttAccessAllowed('view_reports'))) {
  header('Location: access_denied.php');
  exit();
}
// End of access checks.

// Use custom fields plugin if it is enabled.
if ($user->isPluginEnabled('cf')) {
  require_once('plugins/CustomFields.class.php');
  $custom_fields = new CustomFields($user->group_id);
}

// Report settings are stored in session bean before we get here.
$bean = new ActionForm('reportBean', new Form('reportForm'), $request);

// This file handles 2 types of export to a file:
// 1) xml
// 2) csv
// Export to pdf is handled separately in topdf.php.
$type = $request->getParameter('type');

// Also, there are 2 variations of report: totals only, or normal. Totals only means that the report
// is grouped by (either date, user, client, project, task, or cf_1) and user only needs to see subtotals by group.
$totals_only = $bean->getAttribute('chtotalsonly');

// Obtain items.
if ($totals_only)
  $subtotals = ttReportHelper::getSubtotals($bean);
else
  $items = ttReportHelper::getItems($bean);

// Build a string to use as filename for the files being downloaded.
$filename = strtolower($i18n->get('title.report')).'_'.$bean->mValues['start_date'].'_'.$bean->mValues['end_date'];

header('Pragma: public'); // This is needed for IE8 to download files over https.
header('Content-Type: text/html; charset=utf-8');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Cache-Control: private', false);

// Handle 2 cases of possible exports individually.

// 1) entries exported to xml
if ('xml' == $type) {
  header('Content-Type: application/xml');
  header('Content-Disposition: attachment; filename="'.$filename.'.xml"');

  print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
  print "<rows>\n";

  $group_by = $bean->getAttribute('group_by');
  if ($totals_only) {
    // Totals only report. Print subtotals.
    foreach ($subtotals as $subtotal) {
      print "<row>\n";
      print "\t<".$group_by."><![CDATA[".$subtotal['name']."]]></".$group_by.">\n";
      if ($bean->getAttribute('chduration')) {
        $val = $subtotal['time'];
        if($val && defined('EXPORT_DECIMAL_DURATION') && isTrue(EXPORT_DECIMAL_DURATION))
          $val = time_to_decimal($val);
        print "\t<duration><![CDATA[".$val."]]></duration>\n";
      }
      if ($bean->getAttribute('chcost')) {
        print "\t<cost><![CDATA[";
        if ($user->can('manage_invoices') || $user->isClient())
          print $subtotal['cost'];
        else
          print $subtotal['expenses'];
        print "]]></cost>\n";
      }
      print "</row>\n";
    }
  } else {
    // Normal report.
    foreach ($items as $item) {
      print "<row>\n";

      print "\t<date><![CDATA[".$item['date']."]]></date>\n";
      if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) print "\t<user><![CDATA[".$item['user']."]]></user>\n"; 
      if ($bean->getAttribute('chclient')) print "\t<client><![CDATA[".$item['client']."]]></client>\n";
      if ($bean->getAttribute('chproject')) print "\t<project><![CDATA[".$item['project']."]]></project>\n";
      if ($bean->getAttribute('chtask')) print "\t<task><![CDATA[".$item['task']."]]></task>\n";
      if ($bean->getAttribute('chcf_1')) print "\t<cf_1><![CDATA[".$item['cf_1']."]]></cf_1>\n";
      if ($bean->getAttribute('chstart')) print "\t<start><![CDATA[".$item['start']."]]></start>\n";
      if ($bean->getAttribute('chfinish')) print "\t<finish><![CDATA[".$item['finish']."]]></finish>\n";
      if ($bean->getAttribute('chduration')) {
        $duration = $item['duration'];
        if($duration && defined('EXPORT_DECIMAL_DURATION') && isTrue(EXPORT_DECIMAL_DURATION))
          $duration = time_to_decimal($duration);
          print "\t<duration><![CDATA[".$duration."]]></duration>\n";
      }
      if ($bean->getAttribute('chnote')) print "\t<note><![CDATA[".$item['note']."]]></note>\n";
      if ($bean->getAttribute('chcost')) {
        print "\t<cost><![CDATA[";
        if ($user->can('manage_invoices') || $user->isClient())
          print $item['cost'];
        else
          print $item['expense'];
        print "]]></cost>\n";
      }
      if ($bean->getAttribute('chpaid')) print "\t<paid><![CDATA[".$item['paid']."]]></paid>\n";
      if ($bean->getAttribute('chip')) {
        $ip = $item['modified'] ? $item['modified_ip'].' '.$item['modified'] : $item['created_ip'].' '.$item['created'];
        print "\t<ip><![CDATA[".$ip."]]></ip>\n";
      }
      if ($bean->getAttribute('chinvoice')) print "\t<invoice><![CDATA[".$item['invoice']."]]></invoice>\n";

      print "</row>\n";
    }
  }

  print "</rows>";
}

// 2) entries exported to csv
if ('csv' == $type) {
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
      $group_by_header = $i18n->get($key);
    }

    // Print headers.
    print '"'.$group_by_header.'"';
    if ($bean->getAttribute('chduration')) print ',"'.$i18n->get('label.duration').'"';
    if ($bean->getAttribute('chcost')) print ',"'.$i18n->get('label.cost').'"';
    print "\n";

    // Print subtotals.
    foreach ($subtotals as $subtotal) {
      print '"'.$subtotal['name'].'"';
      if ($bean->getAttribute('chduration')) {
        $val = $subtotal['time'];
        if($val && defined('EXPORT_DECIMAL_DURATION') && isTrue(EXPORT_DECIMAL_DURATION))
          $val = time_to_decimal($val);
        print ',"'.$val.'"';
      }
      if ($bean->getAttribute('chcost')) {
        if ($user->can('manage_invoices') || $user->isClient())
          print ',"'.$subtotal['cost'].'"';
        else
          print ',"'.$subtotal['expenses'].'"';
      }
      print "\n";
    }
  } else {
    // Normal report. Print headers.
    print '"'.$i18n->get('label.date').'"';
    if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) print ',"'.$i18n->get('label.user').'"';
    if ($bean->getAttribute('chclient')) print ',"'.$i18n->get('label.client').'"';
    if ($bean->getAttribute('chproject')) print ',"'.$i18n->get('label.project').'"';
    if ($bean->getAttribute('chtask')) print ',"'.$i18n->get('label.task').'"';
    if ($bean->getAttribute('chcf_1')) print ',"'.$custom_fields->fields[0]['label'].'"';
    if ($bean->getAttribute('chstart')) print ',"'.$i18n->get('label.start').'"';
    if ($bean->getAttribute('chfinish')) print ',"'.$i18n->get('label.finish').'"';
    if ($bean->getAttribute('chduration')) print ',"'.$i18n->get('label.duration').'"';
    if ($bean->getAttribute('chnote')) print ',"'.$i18n->get('label.note').'"';
    if ($bean->getAttribute('chcost')) print ',"'.$i18n->get('label.cost').'"';
    if ($bean->getAttribute('chpaid')) print ',"'.$i18n->get('label.paid').'"';
    if ($bean->getAttribute('chip')) print ',"'.$i18n->get('label.ip').'"';
    if ($bean->getAttribute('chinvoice')) print ',"'.$i18n->get('label.invoice').'"';
    print "\n";

    // Print items.
    foreach ($items as $item) {
      print '"'.$item['date'].'"';
      if ($user->can('view_reports') || $user->can('view_all_reports') || $user->isClient()) print ',"'.str_replace('"','""',$item['user']).'"';
      if ($bean->getAttribute('chclient')) print ',"'.str_replace('"','""',$item['client']).'"';
      if ($bean->getAttribute('chproject')) print ',"'.str_replace('"','""',$item['project']).'"';
      if ($bean->getAttribute('chtask')) print ',"'.str_replace('"','""',$item['task']).'"';
      if ($bean->getAttribute('chcf_1')) print ',"'.str_replace('"','""',$item['cf_1']).'"';
      if ($bean->getAttribute('chstart')) print ',"'.$item['start'].'"';
      if ($bean->getAttribute('chfinish')) print ',"'.$item['finish'].'"';
      if ($bean->getAttribute('chduration')) {
        $val = $item['duration'];
        if($val && defined('EXPORT_DECIMAL_DURATION') && isTrue(EXPORT_DECIMAL_DURATION))
          $val = time_to_decimal($val);
        print ',"'.$val.'"';
      }
      if ($bean->getAttribute('chnote')) print ',"'.str_replace('"','""',$item['note']).'"';
      if ($bean->getAttribute('chcost')) {
        if ($user->can('manage_invoices') || $user->isClient())
          print ',"'.$item['cost'].'"';
        else
          print ',"'.$item['expense'].'"';
      }
      if ($bean->getAttribute('chpaid')) print ',"'.$item['paid'].'"';
      if ($bean->getAttribute('chip')) {
        $ip = $item['modified'] ? $item['modified_ip'].' '.$item['modified'] : $item['created_ip'].' '.$item['created'];
        print ',"'.$ip.'"';
      }
      if ($bean->getAttribute('chinvoice')) print ',"'.str_replace('"','""',$item['invoice']).'"';
      print "\n";
    }
  }
}
