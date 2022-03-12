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
// | https://www.anuko.com/time-tracker/credits.htm
// +----------------------------------------------------------------------+


// Class ttPredefinedExpenseHelper is used to help with predefined expense related tasks.
class ttPredefinedExpenseHelper {

  // get - gets predefined expense details.
  static function get($id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, name, cost from tt_predefined_expenses".
      " where id = $id and group_id = $group_id and org_id = $org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val && $val['id']) {
        if ('.' != $user->getDecimalMark())
          $val['cost'] = str_replace('.', $user->getDecimalMark(), $val['cost']);
        return $val;
      }
    }
    return false;
  }

  // delete - deletes a predefined expense from tt_predefined_expenses table.
  static function delete($id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "delete from tt_predefined_expenses".
      " where id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Update entities_modified, too.
    if (!ttGroupHelper::updateEntitiesModified())
      return false;

    return true;
  }

  // insert function inserts a new predefined expense into database.
  static function insert($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $name = $fields['name'];
    $cost = $fields['cost'];
    if ('.' != $user->getDecimalMark())
      $cost = str_replace($user->getDecimalMark(), '.', $cost);

    $sql = "insert into tt_predefined_expenses (group_id, org_id, name, cost)".
      " values ($group_id, $org_id, ".$mdb2->quote($name).", ".$mdb2->quote($cost).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Update entities_modified, too.
    if (!ttGroupHelper::updateEntitiesModified())
      return false;

    return true;
  }

  // update function - updates a predefined expense in database.
  static function update($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $predefined_expense_id = (int) $fields['id'];
    $name = $fields['name'];
    $cost = $fields['cost'];
    if ('.' != $user->getDecimalMark())
      $cost = str_replace($user->getDecimalMark(), '.', $cost);

    $sql = "update tt_predefined_expenses set name = ".$mdb2->quote($name).", cost = ".$mdb2->quote($cost).
      " where id = $predefined_expense_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Update entities_modified, too.
    if (!ttGroupHelper::updateEntitiesModified())
      return false;

    return true;
  }
}
