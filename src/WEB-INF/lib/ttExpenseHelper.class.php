<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// The ttExpenseHelper is a class to help with expense items.
class ttExpenseHelper {
  // insert - inserts an entry into tt_expense_items table.
  static function insert($fields) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $date = $fields['date'];
    $client_id = $fields['client_id'];
    $project_id = $fields['project_id'];
    $name = $fields['name'];
    $cost = str_replace(',', '.', $fields['cost']);
    $status = $fields['status'];
    $paid = isset($fields['paid']) ? (int) $fields['paid'] : 0;
    $created = ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$user->id;

    $sql = "insert into tt_expense_items".
      " (date, user_id, group_id, org_id, client_id, project_id, name, cost, paid, created, created_ip, created_by, status)".
      " values (".$mdb2->quote($date).", $user_id, $group_id, $org_id, ".$mdb2->quote($client_id).", ".$mdb2->quote($project_id).
      ", ".$mdb2->quote($name).", ".$mdb2->quote($cost).", $paid $created, ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $id = $mdb2->lastInsertID('tt_expense_items', 'id');
    return $id;
  }

  // update - updates a record in tt_expense_items table.
  static function update($fields) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $id = (int) $fields['id'];
    $date = $fields['date'];
    $client_id = $fields['client_id'];
    $project_id = $fields['project_id'];
    $name = $fields['name'];
    $cost = str_replace(',', '.', $fields['cost']);

    $paid_part = '';
    if ($user->can('manage_invoices') && $user->isPluginEnabled('ps')) {
      $paid_part = $fields['paid'] ? ', paid = 1' : ', paid = 0';
    }
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

    $sql = "update tt_expense_items set date = ".$mdb2->quote($date).", user_id = $user_id, client_id = ".$mdb2->quote($client_id).
      ", project_id = ".$mdb2->quote($project_id).", name = ".$mdb2->quote($name).
      ", cost = ".$mdb2->quote($cost)."$paid_part $modified_part".
      " where id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // markDeleted - marks an item as deleted in tt_expense_items table.
  static function markDeleted($id) {
    global $user;
    $mdb2 = getConnection();

    // Delete associated files.
    if ($user->isPluginEnabled('at')) {
      import('ttFileHelper');
      global $err;
      $fileHelper = new ttFileHelper($err);
      if (!$fileHelper->deleteEntityFiles($id, 'expense'))
        return false;
    }

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

    $sql = "update tt_expense_items set status = null".$modified_part.
      " where id = $id and user_id = $user_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // getTotalForDay - gets total expenses for a user for a specific date.
  static function getTotalForDay($date) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select sum(cost) as total from tt_expense_items".
      " where user_id = $user_id and group_id = $group_id and org_id = $org_id".
      " and date = ".$mdb2->quote($date)." and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      $val['total'] = str_replace('.', $user->getDecimalMark(), $val['total']);
      return $val['total'];
    }
    return false;
  }

  // getItem - retrieves an entry from tt_expense_items table.
  static function getItem($id) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $client_field = null;
    if ($user->isPluginEnabled('cl'))
      $client_field = ", c.name as client_name";

    $left_joins = "";
    $left_joins = " left join tt_projects p on (ei.project_id = p.id)";
    if ($user->isPluginEnabled('cl'))
      $left_joins .= " left join tt_clients c on (ei.client_id = c.id)";

    $sql = "select ei.id, ei.date, ei.client_id, ei.project_id, ei.name, ei.cost, ei.invoice_id, ei.approved,".
      " ei.paid $client_field, p.name as project_name".
      " from tt_expense_items ei $left_joins".
      " where ei.id = $id and ei.group_id = $group_id and ei.org_id = $org_id and ei.user_id = $user_id and ei.status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        $val['cost'] = str_replace('.', $user->getDecimalMark(), $val['cost']);
        return $val;
      }
    }
    return false;
  }

  // getOnBehalfItem - retrieves an expense item on behalf of user.
  // If such item is found, it also sets on behalf user.
  static function getOnBehalfItem($id) {
    global $user;

    // Determine user id for item.
    $user_id = ttExpenseHelper::getUserForItem($id);
    $user_valid = $user->isUserValid($user_id);

    if (!$user_valid) return false;

    // Set on behalf user.
    $user->setOnBehalfUser($user_id);
    // Get on behalf record.
    return ttExpenseHelper::getItem($id);
  }

  // getUserForItem - retrieves user id for an expense item.
  static function getUserForItem($id) {
    global $user;

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $mdb2 = getConnection();

    // Obtain user_id for the expense item.
    $sql = "select ei.user_id from tt_expense_items ei ".
      " where ei.id = $id and ei.group_id = $group_id and ei.org_id = $org_id and ei.status = 1";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;
    if (!$res->numRows()) return false;

    $val = $res->fetchRow();
    $user_id = $val['user_id'];
    return $user_id;
  }

  // getItemForFileView - retrieves an expense item identified by its id for
  // attachment view operation.
  //
  // It is different from getItem, as we want users with appropriate rights
  // to be able to see other users files, without changing "on behalf" user.
  // For example, viewing reports for all users and their attached files
  // from report links.
  static function getItemForFileView($id) {
    // There are several possible situations:
    //
    // Record is ours. Check "view_own_reports" or "view_all_reports".
    // Record is for the current on behalf user. Check "view_reports" or "view_all_reports".
    // Record is for someone else. Check "view_reports" or "view_all_reports" and rank.
    //
    // It looks like the best way is to use 2 queries, obtain user_id first, then check rank.

    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Obtain user_id for the expense item.
    $sql = "select ei.id, ei.user_id, ei.invoice_id, ei.approved from tt_expense_items ei ".
      " where ei.id = $id and ei.group_id = $group_id and ei.org_id = $org_id and ei.status = 1";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;
    if (!$res->numRows()) return false;

    $val = $res->fetchRow();
    $user_id = $val['user_id'];

    // If record is ours.
    if ($user_id == $user->id) {
      if ($user->can('view_own_reports') || $user->can('view_all_reports')) {
        $val['can_edit'] = !($val['invoice_id'] || $val['approved']);
        return $val;
      }
      return false; // No rights.
    }

    // If record belongs to a user we impersonate.
    if ($user->behalfUser && $user_id == $user->behalfUser->id) {
      if ($user->can('view_reports') || $user->can('view_all_reports')) {
        $val['can_edit'] = !($val['invoice_id'] || $val['approved']);
        return $val;
      }
      return false; // No rights.
    }

    // Record belongs to someone else. We need to check user rank.
    if (!($user->can('view_reports') || $user->can('view_all_reports'))) return false;
    $max_rank = $user->can('view_all_reports') ? MAX_RANK : $user->getMaxRankForGroup($group_id);

    $left_joins = ' left join tt_users u on (ei.user_id = u.id)';
    $left_joins .= ' left join tt_roles r on (u.role_id = r.id)';

    $where_part = " where ei.id = $id and ei.group_id = $group_id and ei.org_id = $org_id and ei.status = 1".
    $where_part .= " and r.rank <= $max_rank";

    $sql = "select ei.id, ei.user_id, ei.invoice_id, ei.approved".
      " from tt_expense_items ei $left_joins $where_part";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
        $val['can_edit'] = false;
        return $val;
      }
    }
    return false;
  }

  // getItems - returns expense items for a user for a given date.
  static function getItems($date, $includeFiles = false) {
    global $user;
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();

    $client_field = null;
    if ($user->isPluginEnabled('cl'))
      $client_field = ", c.name as client";

    $filePart = '';
    $fileJoin = '';
    if ($includeFiles) {
      $filePart = ', if(Sub1.entity_id is null, 0, 1) as has_files';
      $fileJoin =  " left join (select distinct entity_id from tt_files".
      " where entity_type = 'expense' and group_id = $group_id and org_id = $org_id and status = 1) Sub1".
      " on (ei.id = Sub1.entity_id)";
    }

    $left_joins = "";
    $left_joins = " left join tt_projects p on (ei.project_id = p.id)";
    if ($user->isPluginEnabled('cl'))
      $left_joins .= " left join tt_clients c on (ei.client_id = c.id)";

    $left_joins .= $fileJoin;

    $sql = "select ei.id as id $client_field, p.name as project, ei.name as item, ei.cost as cost,".
      " ei.invoice_id, ei.approved $filePart from tt_expense_items ei $left_joins".
      " where ei.date = ".$mdb2->quote($date)." and ei.user_id = $user_id".
      " and ei.group_id = $group_id and ei.org_id = $org_id and ei.status = 1 order by ei.id";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
      	$val['cost'] = str_replace('.', $user->getDecimalMark(), $val['cost']);
        $result[] = $val;
      }
    } else return false;

    return $result;
  }
}
