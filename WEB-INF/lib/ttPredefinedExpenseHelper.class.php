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


// Class ttPredefinedExpenseHelper is used to help with predefined expense related tasks.
class ttPredefinedExpenseHelper {

  // get - gets predefined expense details.
  static function get($id)
  {
    global $user;
    $replaceDecimalMark = ('.' != $user->decimal_mark);

    $mdb2 = getConnection();

    $sql = "select id, name, cost from tt_predefined_expenses
      where id = $id and group_id = $user->group_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val && $val['id']) {
        if ($replaceDecimalMark)
          $val['cost'] = str_replace('.', $user->decimal_mark, $val['cost']);
        return $val;
      }
    }
    return false;
  }

  // delete - deletes a predefined expense from tt_predefined_expenses table.
  static function delete($id) {
    global $user;

    $mdb2 = getConnection();

    $sql = "delete from tt_predefined_expenses where id = $id and group_id = $user->group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // insert function inserts a new predefined expense into database.
  static function insert($fields)
  {
    global $user;

    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $name = $fields['name'];
    $cost = $fields['cost'];
    if ('.' != $user->decimal_mark)
      $cost = str_replace($user->decimal_mark, '.', $cost);

    $sql = "insert into tt_predefined_expenses (group_id, name, cost)
      values ($group_id, ".$mdb2->quote($name).", ".$mdb2->quote($cost).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // update function - updates a predefined expense in database.
  static function update($fields)
  {
    global $user;

    $mdb2 = getConnection();

    $predefined_expense_id = (int) $fields['id'];
    $group_id = (int) $fields['group_id'];
    $name = $fields['name'];
    $cost = $fields['cost'];
    if ('.' != $user->decimal_mark)
      $cost = str_replace($user->decimal_mark, '.', $cost);

    $sql = "update tt_predefined_expenses set name = ".$mdb2->quote($name).", cost = ".$mdb2->quote($cost).
      " where id = $predefined_expense_id and group_id = $group_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
}
