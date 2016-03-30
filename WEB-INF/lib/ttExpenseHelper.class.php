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

// The ttExpenseHelper is a class to help with expense items.
class ttExpenseHelper {
  // insert - inserts an entry into tt_expense_items table.
  static function insert($fields)
  {
    $mdb2 = getConnection();

    $date = $fields['date'];
    $user_id = (int) $fields['user_id'];
    $client_id = $fields['client_id'];
    $project_id = $fields['project_id'];
    $name = $fields['name'];
    $cost = str_replace(',', '.', $fields['cost']);
    $invoice_id = $fields['invoice_id'];
    $status = $fields['status'];
       
    $sql = "insert into tt_expense_items (date, user_id, client_id, project_id, name, cost, invoice_id, status) ".
      "values (".$mdb2->quote($date).", $user_id, ".$mdb2->quote($client_id).", ".$mdb2->quote($project_id).
      ", ".$mdb2->quote($name).", ".$mdb2->quote($cost).", ".$mdb2->quote($invoice_id).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;
    
    $id = $mdb2->lastInsertID('tt_expense_items', 'id');
    return $id;
  }
  
  // update - updates a record in tt_expense_items table.
  static function update($fields)
  {
    $mdb2 = getConnection();

    $id = (int) $fields['id'];
    $date = $fields['date'];
    $user_id = (int) $fields['user_id'];
    $client_id = $fields['client_id'];
    $project_id = $fields['project_id'];
    $name = $fields['name'];
    $cost = str_replace(',', '.', $fields['cost']);
    $invoice_id = $fields['invoice_id'];
    
    $sql = "UPDATE tt_expense_items set date = ".$mdb2->quote($date).", user_id = $user_id, client_id = ".$mdb2->quote($client_id).
      ", project_id = ".$mdb2->quote($project_id).", name = ".$mdb2->quote($name).
      ", cost = ".$mdb2->quote($cost).", invoice_id = ".$mdb2->quote($invoice_id).
      " WHERE id = $id";
    
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;
   
    return true;
  }
  
  // markDeleted - marks an item as deleted in tt_expense_items table.
  static function markDeleted($id, $user_id) {
    $mdb2 = getConnection();

    $sql = "update tt_expense_items set status = NULL where id = $id and user_id = $user_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;
      
    return true;
  }
  
  // getTotalForDay - gets total expenses for a user for a specific date.
  static function getTotalForDay($user_id, $date) {
  	global $user;
  	
    $mdb2 = getConnection();

    $sql = "select sum(cost) as sm from tt_expense_items where user_id = $user_id and date = ".$mdb2->quote($date)." and status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      $val['sm'] = str_replace('.', $user->decimal_mark, $val['sm']);
      return $val['sm'];
    }
    return false;
  }
  
  // getItem - retrieves an entry from tt_expense_items table.
  static function getItem($id, $user_id) {
  	global $user;
  	
    $mdb2 = getConnection();
    
    $client_field = null;
    if (ttPluginEnabled('cl'))
      $client_field = ", c.name as client_name";
      
    $left_joins = "";
    $left_joins = " left join tt_projects p on (ei.project_id = p.id)";
    if (ttPluginEnabled('cl'))
      $left_joins .= " left join tt_clients c on (ei.client_id = c.id)";
      
    $sql = "select ei.id, ei.date, ei.client_id, ei.project_id, ei.name, ei.cost, ei.invoice_id $client_field, p.name as project_name
      from tt_expense_items ei
      $left_joins
      where ei.id = $id and ei.user_id = $user_id and ei.status = 1";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if (!$res->numRows()) {
        return false;
      }
      if ($val = $res->fetchRow()) {
      	$val['cost'] = str_replace('.', $user->decimal_mark, $val['cost']);
        return $val;
      }
    }
    return false;
  }
  
  /*
  // getAllItems - returns all expense items for a certain user.
  static function getAllItems($user_id) {
    $result = array();

    $mdb2 = getConnection();

    $sql = "select * from tt_expense_items where user_id = $user_id order by id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    } else return false;

    return $result;
  }*/

  // getItems - returns expense items for a user for a given date.
  static function getItems($user_id, $date) {
  	global $user;
  	  	
    $result = array();
    $mdb2 = getConnection();

    $client_field = null;
    if (ttPluginEnabled('cl'))
      $client_field = ", c.name as client";
    
    $left_joins = "";
    $left_joins = " left join tt_projects p on (ei.project_id = p.id)";
    if (ttPluginEnabled('cl'))
      $left_joins .= " left join tt_clients c on (ei.client_id = c.id)";

    $sql = "select ei.id as id $client_field, p.name as project, ei.name as item, ei.cost as cost,
      ei.invoice_id from tt_expense_items ei
      $left_joins
      where ei.date = ".$mdb2->quote($date)." and ei.user_id = $user_id and ei.status = 1
      order by ei.id";
      
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
      	$val['cost'] = str_replace('.', $user->decimal_mark, $val['cost']);
        $result[] = $val;
      }
    } else return false;

    return $result;
  }
}
