<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

define('SYSC_CHART_INTERVAL', 'chart_interval');
define('SYSC_CHART_TYPE', 'chart_type');
define('SYSC_LAST_REPORT_EMAIL', 'last_report_email');
define('SYSC_LAST_REPORT_CC', 'last_report_cc');
define('SYSC_LAST_INVOICE_EMAIL', 'last_invoice_email');
define('SYSC_LAST_INVOICE_CC', 'last_invoice_cc');
define('SYSC_PDF_REPORT_PAGE_BREAKS', 'pdf_report_page_breaks');

// Class ttUserConfig is used for storing and retrieving named values associated with users.
// When user is working on behalf of someone else, this class is still associated with a user.
class ttUserConfig {
  var $user_id = null;
  var $group_id = null;
  var $org_id = null;
  var $mdb2 = null;

  // Constructor.
  function __construct() {
    global $user;
    $this->user_id = $user->id; // Not behalf id by design.
    $this->group_id = $user->group_id;
    $this->org_id = $user->org_id;
    $this->mdb2 = getConnection();
  }

  // The getValue retrieves a value identified by name.
  function getValue($name) {
    $res = $this->mdb2->query("select param_value from tt_config".
      " where user_id = $this->user_id and group_id = $this->group_id and org_id = $this->org_id".
      " and param_name=".$this->mdb2->quote($name));
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return @$val['param_value'];
    }
    return false;
  }

  // The setValue sets a value identified by name.
  function setValue($name, $value) {
    $count = 0;
    $res = $this->mdb2->query("select count(*) as count from tt_config where user_id = ".$this->user_id." and param_name = ".$this->mdb2->quote($name));
    if ($val = $res->fetchRow()) $count = $val['count'];

    if ($count > 0) {
      $affected = $this->mdb2->exec("update tt_config set param_value = ".$this->mdb2->quote($value).
        " where user_id = $this->user_id and group_id = $this->group_id and org_id = $this->org_id".
        " and param_name=".$this->mdb2->quote($name));
    } else {
      $sql = "insert into tt_config set param_value = ".$this->mdb2->quote($value).
        ", param_name = ".$this->mdb2->quote($name).", user_id = $this->user_id, group_id = $this->group_id, org_id = ".$this->org_id;
      $affected = $this->mdb2->exec($sql);
    }
    return (!is_a($affected, 'PEAR_Error'));
  }
}
