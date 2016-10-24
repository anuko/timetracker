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

define('SYSC_CHART_INTERVAL', 'chart_interval');
define('SYSC_CHART_TYPE', 'chart_type');
define('SYSC_LAST_REPORT_EMAIL', 'last_report_email');
define('SYSC_LAST_REPORT_CC', 'last_report_cc');
define('SYSC_LAST_INVOICE_EMAIL', 'last_invoice_email');
define('SYSC_LAST_INVOICE_CC', 'last_invoice_cc');

// Class ttSysConfig is used for storing and retrieving named values associated with users.
class ttSysConfig {
  var $u_id = null;
  var $mdb2 = null;

  // Constructor.
  function __construct($u_id) {
    $this->u_id = $u_id;
    $this->mdb2 = getConnection();
  }

  // The getValue retrieves a value identified by name.
  function getValue($name) {
    $res = $this->mdb2->query("select param_value from tt_config where user_id = ".$this->u_id." and param_name=".$this->mdb2->quote($name));
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val['param_value'];
    }
    return false;
  }

  // The setValue sets a value identified by name.
  function setValue($name, $value) {
    $rcnt = 0;
    $res = $this->mdb2->query("select count(*) as rcnt from tt_config where user_id = ".$this->u_id." and param_name = ".$this->mdb2->quote($name));
    if ($val = $res->fetchRow()) $rcnt = $val['rcnt'];
    
    if ($rcnt > 0) {
      $affected = $this->mdb2->exec("update tt_config set param_value = ".$this->mdb2->quote($value)." where user_id = ".$this->u_id." and param_name=".$this->mdb2->quote($name));
    } else {
      $affected = $this->mdb2->exec("insert into tt_config set param_value = ".$this->mdb2->quote($value).", param_name = ".$this->mdb2->quote($name).", user_id = ".$this->u_id);
    }
    return (!is_a($affected, 'PEAR_Error'));
  }
}
