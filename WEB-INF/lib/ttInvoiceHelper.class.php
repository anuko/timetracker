<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

import('ttClientHelper');
import('DateAndTime');

// Class ttInvoiceHelper is used for help with invoices.
class ttInvoiceHelper {

  // getInvoice - obtains invoice data from the database.
  static function getInvoice($invoice_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $client_part = '';
    if ($user->isClient()) $client_part = "and client_id = $user->client_id";

    $sql = "select * from tt_invoices".
      " where id = $invoice_id and group_id = $group_id and org_id = $org_id $client_part and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if ($val = $res->fetchRow())
        return $val;
    }
    return false;
  }

  // The getInvoiceByName looks up an invoice by name.
  static function getInvoiceByName($invoice_name) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_invoices where group_id = $group_id and org_id = $org_id".
      " and name = ".$mdb2->quote($invoice_name)." and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if (isset($val['id']) && $val['id'] > 0) {
        return $val;
      }
    }
    return false;
  }

  // The isPaid determines if an invoice is paid by looking at the paid status of its items.
  // If any non-paid item is found, the entire invoice is considered not paid.
  // Therefore, the paid status of the invoice is a calculated value.
  // This is because we maintain the paid status on individual item level.
  static function isPaid($invoice_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select count(*) as count from tt_log".
      " where invoice_id = $invoice_id and group_id = $group_id and org_id = $org_id and status = 1 and paid < 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['count'] > 0)
        return false; // A non-paid time item exists.
    }
    $sql = "select count(*) as count from tt_expense_items".
      " where invoice_id = $invoice_id and group_id = $group_id and org_id = $org_id and status = 1 and paid < 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['count'] > 0)
        return false; // A non-paid expense item exists.
      else
        return true; // All time and expense items in invoice are paid.
    }
    return false;
  }

  // markPaid marks invoice items as paid.
  static function markPaid($invoice_id, $mark_paid = true) {
    global $user;
    if ($user->isClient()) return false; // Not for clients.

    $mdb2 = getConnection();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $paid_status = $mark_paid ? 1 : 0;
    $sql = "update tt_log set paid = $paid_status".
      " where invoice_id = $invoice_id and group_id = $group_id and org_id = $org_id and status = 1";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    $sql = "update tt_expense_items set paid = $paid_status".
      " where invoice_id = $invoice_id and group_id = $group_id and org_id = $org_id and status = 1";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    return true;
  }

  // The getInvoiceItems retrieves tt_log items associated with the invoice. 
  static function getInvoiceItems($invoice_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // At this time only detailed invoice is supported.
    // It is anticipated to support "totals only" option later on.

    // Our query is different depending on tracking mode.
    if (MODE_TIME == $user->getTrackingMode()) {
      // In "time only" tracking mode there is a single user rate.
      $sql = "select l.date as date, 1 as type, u.name as user_name, p.name as project_name,".
        " t.name as task_name, l.comment as note, time_format(l.duration, '%k:%i') as duration,".
        " cast(l.billable * u.rate * time_to_sec(l.duration)/3600 as decimal(10, 2)) as cost,".
        " l.paid as paid from tt_log l".
        " inner join tt_users u on (l.user_id = u.id)".
        " left join tt_projects p on (p.id = l.project_id)".
        " left join tt_tasks t on (t.id = l.task_id)".
        " where l.status = 1 and l.billable = 1 and l.invoice_id = $invoice_id".
        " and l.group_id = $group_id and l.org_id = $org_id order by l.date, u.name";
    } else {
      $sql = "select l.date as date, 1 as type, u.name as user_name, p.name as project_name,".
        " t.name as task_name, l.comment as note, time_format(l.duration, '%k:%i') as duration,".
        " cast(l.billable * coalesce(upb.rate, 0) * time_to_sec(l.duration)/3600 as decimal(10, 2)) as cost,".
        " l.paid as paid from tt_log l".
        " inner join tt_users u on (l.user_id = u.id)".
        " left join tt_projects p on (p.id = l.project_id)".
        " left join tt_tasks t on (t.id = l.task_id)".
        " left join tt_user_project_binds upb on (upb.user_id = l.user_id and upb.project_id = l.project_id)".
        " where l.status = 1 and l.billable = 1 and l.invoice_id = $invoice_id".
        " and l.group_id = $group_id and l.org_id = $org_id order by l.date, u.name";
    }

    // If we have expenses, we need to do a union with a separate query for expense items from tt_expense_items table.
    if ($user->isPluginEnabled('ex')) {
      $sql_for_expense_items = "select ei.date as date, 2 as type, u.name as user_name, p.name as project_name,".
        " null as task_name, ei.name as note,".
        " null as duration, ei.cost as cost,".
        " ei.paid as paid from tt_expense_items ei".
        " inner join tt_users u on (ei.user_id = u.id)".
        " left join tt_projects p on (p.id = ei.project_id)".
        " where ei.invoice_id = $invoice_id and ei.group_id = $group_id and ei.org_id = $org_id and ei.status = 1";

      // Construct a union.
      $sql = "($sql) union all ($sql_for_expense_items)";

      $sort_part = " order by date, user_name, type";
      $sql .= $sort_part;
    }

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $dt = new DateAndTime(DB_DATEFORMAT);
      while ($val = $res->fetchRow()) {
        $dt->parseVal($val['date']);
        $val['date'] = $dt->toString($user->getDateFormat());
        $result[] = $val;
      }
    }
    return $result;
  }

  // delete - deletes the invoice data from the database.
  static function delete($invoice_id, $delete_invoice_items) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

    // Handle custom field log records.
    if ($delete_invoice_items) {
      $sql = "update tt_custom_field_log set status = null".
        " where log_id in".
        " (select id from tt_log where invoice_id = $invoice_id and group_id = $group_id and org_id = $org_id and status = 1)";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error')) return false;
    }

    // Handle time records.
    if ($delete_invoice_items) {
      $sql = "update tt_log set status = null".$modified_part.
        " where invoice_id = $invoice_id and group_id = $group_id and org_id = $org_id";
    } else {
      $sql = "update tt_log set invoice_id = null".$modified_part.
        " where invoice_id = $invoice_id and group_id = $group_id and org_id = $org_id";
    }
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Handle expense items.
    if ($delete_invoice_items) {
      $sql = "update tt_expense_items set status = null".$modified_part.
        " where invoice_id = $invoice_id and group_id = $group_id and org_id = $org_id";
    } else {
      $sql = "update tt_expense_items set invoice_id = null".$modified_part.
        " where invoice_id = $invoice_id and group_id = $group_id and org_id = $org_id";
    }
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    $sql = "update tt_invoices set status = null".
      " where id = $invoice_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // The invoiceableItemsExist determines whether invoiceable records exist in the specified period.
  static function invoiceableItemsExist($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $client_id = (int) $fields['client_id'];

    $start_date = new DateAndTime($user->date_format, $fields['start_date']);
    $start = $start_date->toString(DB_DATEFORMAT);

    $end_date = new DateAndTime($user->date_format, $fields['end_date']);
    $end = $end_date->toString(DB_DATEFORMAT);

    $project_id = null;
    $project_part = '';
    if (isset($fields['project_id'])) $project_id = (int) $fields['project_id'];

    // Our query is different depending on tracking mode.
    if (MODE_TIME == $user->getTrackingMode()) {
      // In "time only" tracking mode there is a single user rate.
      $sql = "select count(*) as num from tt_log l, tt_users u".
        " where l.status = 1 and l.client_id = $client_id and l.invoice_id is null".
        " and l.date >= ".$mdb2->quote($start)." and l.date <= ".$mdb2->quote($end).
        " and l.user_id = u.id and l.group_id = $group_id and l.org_id = $org_id".
        " and l.billable = 1"; // l.billable * u.rate * time_to_sec(l.duration)/3600 > 0 // See explanation below.
    } else {
      // sql part for project id.
      if ($project_id) $project_part = " and l.project_id = $project_id";

      // When we have projects, rates are defined for each project in tt_user_project_binds table.
      $sql = "select count(*) as num from tt_log l, tt_user_project_binds upb".
        " where l.status = 1 and l.client_id = $client_id $project_part and l.invoice_id is null".
        " and l.date >= ".$mdb2->quote($start)." and l.date <= ".$mdb2->quote($end).
        " and l.group_id = $group_id and l.org_id = $org_id".
        " and upb.user_id = l.user_id and upb.project_id = l.project_id".
        " and l.billable = 1"; // l.billable * upb.rate * time_to_sec(l.duration)/3600 > 0
        // Users with a lot of clients and projects (Jaro) may forget to set user rates properly.
        // Specifically, user rate may be set to 0 on a project, by mistake. This leads to error.no_invoiceable_items
        // and increased support cost. Commenting out allows us to include 0 cost items in invoices so that
        // the problem becomes obvious.

        // TODO: If the above turns out useful, rework the query to simplify it by removing left join.
    }
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['num']) {
        return true;
      }
    }

    if ($user->isPluginEnabled('ex')) {
      // sql part for project id.
      if ($project_id) $project_part = " and ei.project_id = $project_id";

      $sql = "select count(*) as num from tt_expense_items ei".
        " where ei.client_id = $client_id $project_part and ei.invoice_id is null".
        " and ei.date >= ".$mdb2->quote($start)." and ei.date <= ".$mdb2->quote($end).
        " and ei.group_id = $group_id and ei.org_id = $org_id".
        " and ei.cost <> 0 and ei.status = 1";
      $res = $mdb2->query($sql);
      if (!is_a($res, 'PEAR_Error')) {
        $val = $res->fetchRow();
        if ($val['num']) {
          return true;
        }
      }
    }

    return false;
  }

  // createInvoice - marks items for invoice as belonging to it (with its reference number).
  static function createInvoice($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $name = $fields['name'];
    if (!$name) return false;

    $client_id = (int) $fields['client_id'];

    $invoice_date = new DateAndTime($user->date_format, $fields['date']);
    $date = $invoice_date->toString(DB_DATEFORMAT);

    $start_date = new DateAndTime($user->date_format, $fields['start_date']);
    $start = $start_date->toString(DB_DATEFORMAT);

    $end_date = new DateAndTime($user->date_format, $fields['end_date']);
    $end = $end_date->toString(DB_DATEFORMAT);

    $project_id = null;
    $project_part = '';
    if (isset($fields['project_id'])) $project_id = (int) $fields['project_id'];

    // Create a new invoice record.
    $sql = "insert into tt_invoices (group_id, org_id, name, date, client_id)".
      " values($group_id, $org_id, ".$mdb2->quote($name).", ".$mdb2->quote($date).", $client_id)";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    // Mark associated invoice items with invoice id.
    $last_id = $mdb2->lastInsertID('tt_invoices', 'id');

    // Our update sql is different depending on tracking mode.
    if (MODE_TIME == $user->getTrackingMode()) {
      // In "time only" tracking mode there is a single user rate.
      $sql = "update tt_log l".
        " left join tt_users u on (u.id = l.user_id)".
        " set l.invoice_id = $last_id".
        " where l.status = 1 and l.client_id = $client_id and l.invoice_id is null".
        " and l.group_id = $group_id and l.org_id = $org_id".
        " and l.date >= ".$mdb2->quote($start)." and l.date <= ".$mdb2->quote($end).
        " and l.duration > 0 and l.billable = 1"; // l.billable * u.rate * time_to_sec(l.duration)/3600 > 0"; // See explanation below.
    } else {
       // sql part for project id.
      if ($project_id) $project_part = " and l.project_id = $project_id";

      // When we have projects, rates are defined for each project in tt_user_project_binds.
      $sql = "update tt_log l".
        " left join tt_user_project_binds upb on (upb.user_id = l.user_id and upb.project_id = l.project_id)".
        " set l.invoice_id = $last_id".
        " where l.status = 1 and l.client_id = $client_id $project_part and l.invoice_id is null".
        " and l.group_id = $group_id and l.org_id = $org_id".
        " and l.date >= ".$mdb2->quote($start)." and l.date <= ".$mdb2->quote($end).
        " and l.duration > 0 and l.billable = 1"; //  l.billable * upb.rate * time_to_sec(l.duration)/3600 > 0";
        // Users with a lot of clients and projects (Jaro) may forget to set user rates properly.
        // Specifically, user rate may be set to 0 on a project, by mistake. This leads to error.no_invoiceable_items
        // and increased support cost. Commenting out allows us to include 0 cost items in invoices so that
        // the problem becomes obvious.

        // TODO: If the above turns out useful, rework the query to simplify it by removing left join.
    }
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // sql part for project id.
    if ($project_id) $project_part = " and project_id = $project_id";

    $sql = "update tt_expense_items set invoice_id = $last_id".
      " where client_id = $client_id $project_part and invoice_id is null".
      " and group_id = $group_id and org_id = $org_id".
      " and date >= ".$mdb2->quote($start)." and date <= ".$mdb2->quote($end)." and cost <> 0 and status = 1";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // prepareInvoiceBody - prepares an email body for invoice.
  static function prepareInvoiceBody($invoice_id, $comment)
  {
    global $user;
    global $i18n;

    $currency = $user->getCurrency();
    $decimalMark = $user->getDecimalMark();

    $invoice = ttInvoiceHelper::getInvoice($invoice_id);
    $client = ttClientHelper::getClient($invoice['client_id'], true);
    $invoice_items = ttInvoiceHelper::getInvoiceItems($invoice_id);

    $tax_percent = $client['tax'];

    $subtotal = 0;
    $tax = 0;
    foreach($invoice_items as $item)
      $subtotal += $item['cost'];
    if ($tax_percent) {
      $tax_expenses = $user->isPluginEnabled('et');
      foreach($invoice_items as $item) {
        if ($item['type'] == 2 && !$tax_expenses)
          continue;
        $tax += round($item['cost'] * $tax_percent / 100, 2);
      }
    }
    $total = $subtotal + $tax;

    $subtotal = htmlspecialchars($currency).' '.str_replace('.', $decimalMark, sprintf('%8.2f', round($subtotal, 2)));
    if ($tax) $tax = htmlspecialchars($currency).' '.str_replace('.', $decimalMark, sprintf('%8.2f', round($tax, 2)));
    $total = htmlspecialchars($currency).' '.str_replace('.', $decimalMark, sprintf('%8.2f', round($total, 2)));

    if ('.' != $decimalMark) {
      foreach ($invoice_items as &$item) {
        $item['cost'] = str_replace('.', $decimalMark, $item['cost']);
      }
      unset($item); // Unset the reference. If we don't, the foreach loop below modifies the array while printing.
                    // See http://stackoverflow.com/questions/8220399/php-foreach-pass-by-reference-last-element-duplicating-bug
    }

    // Define some styles to use in email.
    $style_title = 'text-align: center; font-size: 15pt; font-family: Arial, Helvetica, sans-serif;';
    $style_tableHeader = 'font-weight: bold; background-color: #a6ccf7; text-align: left;';
    $style_tableHeaderCentered = 'font-weight: bold; background-color: #a6ccf7; text-align: center;';

    // Determine tracking mode once for multiple reuse below.
    $trackingMode = $user->getTrackingMode();

    // Start creating email body.
    $body = '<html>';
    $body .= '<head><meta http-equiv="content-type" content="text/html; charset='.CHARSET.'"></head>';
    $body .= '<body>';

    // Output title.
    $body .= '<p style="'.$style_title.'">'.$i18n->get('title.invoice').' '.htmlspecialchars($invoice['name']).'</p>';

    // Output comment.
    if($comment) $body .= '<p>'.htmlspecialchars($comment).'</p>';

    // Output invoice info.
    $body .= '<table>';
    $body .= '<tr><td><b>'.$i18n->get('label.date').':</b> '.$invoice['date'].'</td></tr>';
    $body .= '<tr><td><b>'.$i18n->get('label.client').':</b> '.htmlspecialchars($client['name']).'</td></tr>';
    $body .= '<tr><td><b>'.$i18n->get('label.client_address').':</b> '.htmlspecialchars($client['address']).'</td></tr>';
    $body .= '</table>';

    $body .= '<p></p>';

    // Output invoice items.
    $body .= '<table border="0" cellpadding="4" cellspacing="0" width="100%">';
    $body .= '<tr>';
    $body .= '<td style="'.$style_tableHeader.'">'.$i18n->get('label.date').'</td>';
    $body .= '<td style="'.$style_tableHeader.'">'.$i18n->get('form.invoice.person').'</td>';
    if (MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode)
      $body .= '<td style="'.$style_tableHeader.'">'.$i18n->get('label.project').'</td>';
    if (MODE_PROJECTS_AND_TASKS == $trackingMode)
      $body .= '<td style="'.$style_tableHeader.'">'.$i18n->get('label.task').'</td>';
    $body .= '<td style="'.$style_tableHeader.'">'.$i18n->get('label.note').'</td>';
    $body .= '<td style="'.$style_tableHeaderCentered.'" width="5%">'.$i18n->get('label.duration').'</td>';
    $body .= '<td style="'.$style_tableHeaderCentered.'" width="5%">'.$i18n->get('label.cost').'</td>';
    $body .= '</tr>';
    foreach ($invoice_items as $item) {
      $body .= '<tr>';
      $body .= '<td>'.$item['date'].'</td>';
      $body .= '<td>'.htmlspecialchars($item['user_name']).'</td>';
      if (MODE_PROJECTS == $trackingMode || MODE_PROJECTS_AND_TASKS == $trackingMode)
        $body .= '<td>'.htmlspecialchars($item['project_name']).'</td>';
      if (MODE_PROJECTS_AND_TASKS == $trackingMode)
        $body .= '<td>'.htmlspecialchars($item['task_name']).'</td>';
      $body .= '<td>'.htmlspecialchars($item['note']).'</td>';
      $body .= '<td align="right">'.$item['duration'].'</td>';
      $body .= '<td align="right">'.$item['cost'].'</td>';
      $body .= '</tr>';
    }
    // Output summary.
    $colspan = 4;
    if (MODE_PROJECTS == $trackingMode)
      $colspan++;
    elseif (MODE_PROJECTS_AND_TASKS == $trackingMode)
      $colspan += 2;
    $body .= '<tr><td>&nbsp;</td></tr>';
    if ($tax) {
      $body .= '<tr><td colspan="'.$colspan.'" align="right"><b>'.$i18n->get('label.subtotal').':</b></td><td nowrap align="right">'.$subtotal.'</td></tr>';
      $body .= '<tr><td colspan="'.$colspan.'" align="right"><b>'.$i18n->get('label.tax').':</b></td><td nowrap align="right">'.$tax.'</td></tr>';
    }
    $body .= '<tr><td colspan="'.$colspan.'" align="right"><b>'.$i18n->get('label.total').':</b></td><td nowrap align="right">'.$total.'</td></tr>';
    $body .= '</table>';

    // Output footer.
    if (!defined('REPORT_FOOTER') || !(REPORT_FOOTER == false))
      $body .= '<p style="text-align: center;">'.$i18n->get('form.mail.footer').'</p>';

    // Finish creating email body.
    $body .= '</body></html>';

    return $body;
  }

  // validSortOption validates user input for sort option.
  static function validSortOption($option, $emptyValid = false) {
    if (!$option)
      return ($emptyValid ? true : false);

    $valid_options = array('name', 'client', 'date');

    return (in_array($option, $valid_options) ? true : false);
  }

  // validSortOrder validates user input for sort order.
  static function validSortOrder($order) {
    $valid_options = array('ascending', 'descending');
    return (in_array($order, $valid_options) ? true : false);
  }
}
