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

    $mdb2 = getConnection();

    $sql = "select id, name, cost from tt_predefined_expenses
      where id = $id and team_id = $user->team_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
	  if ($val && $val['id'])
        return $val;
    }
    return false;
  }

  // delete - deletes a predefined expense from tt_predefined_expenses table.
  static function delete($id) {
    global $user;

    $mdb2 = getConnection();

    $sql = "delete from tt_predefined_expenses where id = $id and team_id = $user->team_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // insert function inserts a new predefined expense into database.
  static function insert($fields)
  {
    $mdb2 = getConnection();

    $team_id = (int) $fields['team_id'];
    $name = $fields['name'];
    $cost = $fields['cost'];

    $sql = "insert into tt_predefined_expenses (team_id, name, cost)
      values ($team_id, ".$mdb2->quote($name).", ".$mdb2->quote($cost).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // update function - updates a predefined expense in database.
  static function update($fields)
  {
    $mdb2 = getConnection();

    $predefined_expense_id = (int) $fields['id'];
    $team_id = (int) $fields['team_id'];
    $name = $fields['name'];
    $cost = $fields['cost'];

    $sql = "update tt_predefined_expenses set name = ".$mdb2->quote($name).", cost = ".$mdb2->quote($cost).
      " where id = $predefined_expense_id and team_id = $team_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
}
