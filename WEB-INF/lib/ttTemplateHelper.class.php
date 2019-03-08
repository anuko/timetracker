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


// Class ttTemplateHelper is used to help with template related tasks.
class ttTemplateHelper {

  // get - gets template details.
  static function get($id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, name, description, content, status from tt_templates".
      " where id = $id and group_id = $group_id and org_id = $org_id".
      " and status is not null";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val) {
        return $val;
      }
    }
    return false;
  }

  // delete - marks a template as deleted in tt_templates table in database.
  static function delete($id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "update tt_templates set status = null".
      " where id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // insert function inserts a new template into database.
  static function insert($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $name = $fields['name'];
    $description = $fields['description'];
    $content = $fields['content'];

    $sql = "insert into tt_templates (group_id, org_id, name, description, content)".
      " values ($group_id, $org_id, ".$mdb2->quote($name).
      ", ".$mdb2->quote($description).", ".$mdb2->quote($content).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // update function - updates a template in database.
  static function update($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $template_id = (int) $fields['id'];
    $name = $fields['name'];
    $description = $fields['description'];
    $content = $fields['content'];
    $status = (int) $fields['status'];

    $sql = "update tt_templates set name = ".$mdb2->quote($name).
      ", description = ".$mdb2->quote($description).
      ", content = ".$mdb2->quote($content).
      ", status = ".$status.
      " where id = $template_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
}
