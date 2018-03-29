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

// Class ttCustomFieldHelper is used to help with custom field related tasks.
class ttCustomFieldHelper {
	
  // The insertField function inserts a new custom field in database.
  static function insertField($fields)
  {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $type = (int) $fields['type'];
    $label = $fields['label'];
    $required = (int) $fields['required'];
    $status = $fields['status'];
    
    $sql = "insert into tt_custom_fields (group_id, type, label, required, status)".
      " values ($group_id, $type, ".$mdb2->quote($label).", $required, ".$mdb2->quote($status).")";
      
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;
      
    $last_id = 0;
    $sql = "select last_insert_id() as last_insert_id";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    $last_id = $val['last_insert_id'];
      
    return $last_id;
  }
  
  // The insertOption function inserts a new custom field option in database.
  static function insertOption($fields)
  {
    $mdb2 = getConnection();

    $field_id = (int) $fields['field_id'];
    $value = $fields['value'];
    
    $sql = "insert into tt_custom_field_options (field_id, value) 
      values ($field_id, ".$mdb2->quote($value).")";
      
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;
      
    $last_id = 0;
    $sql = "select last_insert_id() as last_insert_id";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    $last_id = $val['last_insert_id'];
      
    return $last_id;
  }
  
  // The insertLogEntry function inserts a new custom field log entry in database.
  static function insertLogEntry($fields)
  {
    $mdb2 = getConnection();

    $log_id = (int) $fields['log_id'];
    $field_id = (int) $fields['field_id'];
    $option_id = $fields['option_id'];
    $value = $fields['value'];
    $status = $fields['status'];
    
    $sql = "insert into tt_custom_field_log (log_id, field_id, option_id, value, status) 
      values ($log_id, $field_id, ".$mdb2->quote($option_id).", ".$mdb2->quote($value).", ".$mdb2->quote($status).")";
      
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
}
