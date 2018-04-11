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

import('ttTeamHelper');
import('ttUserHelper');
import('ttProjectHelper');
import('ttTaskHelper');
import('ttInvoiceHelper');
import('ttTimeHelper');
import('ttClientHelper');
import('ttCustomFieldHelper');
import('ttFavReportHelper');
import('ttExpenseHelper');
import('ttRoleHelper');

// ttImportHelper - this class is used to import group data from a file.
class ttImportHelper {
  var $errors         = null;    // Errors go here. Set in constructor by reference.

  var $currentElement = array(); // Current element of the XML file we are parsing.
  var $currentTag     = '';      // XML tag of the current element.

  var $canImport      = true;    // False if we cannot import data due to a login collision.
  var $groupData      = array(); // Array of group data such as group name, etc.
  var $group_id       = null;    // New group id we are importing. It is created during the import operation.
  var $roles          = array(); // Array of arrays of role properties.
  var $users          = array(); // Array of arrays of user properties.
  var $top_role_id    = null;    // Top manager role id on the new server.

  // The following arrays are maps between entity ids in the file versus the database.
  // In the file they are sequential (1,2,3...) while in the database the entities have different ids.
  var $roleMap       = array(); // Role ids.
  var $userMap       = array(); // User ids.
  var $projectMap    = array(); // Project ids.
  var $taskMap       = array(); // Task ids.
  var $clientMap     = array(); // Client ids.
  var $invoiceMap    = array(); // Invoice ids.

  var $customFieldMap       = array(); // Custom field ids.
  var $customFieldOptionMap = array(); // Custop field option ids.
  var $logMap        = array(); // Time log ids.

  // Constructor.
  function ttImportHelper(&$errors) {
    $this->errors = &$errors;
  }

  // startElement - callback handler for opening tag of an XML element.
  // In this function we assign passed in attributes to currentElement.
  function startElement($parser, $name, $attrs) {
    if ($name == 'GROUP'
      || $name == 'USER'
      || $name == 'TASK'
      || $name == 'PROJECT'
      || $name == 'CLIENT'
      || $name == 'INVOICE'
      || $name == 'MONTHLY_QUOTA'
      || $name == 'LOG_ITEM'
      || $name == 'CUSTOM_FIELD'
      || $name == 'CUSTOM_FIELD_OPTION'
      || $name == 'CUSTOM_FIELD_LOG_ENTRY'
      || $name == 'INVOICE_HEADER'
      || $name == 'USER_PROJECT_BIND'
      || $name == 'EXPENSE_ITEM'
      || $name == 'FAV_REPORT'
      || $name == 'ROLE') {
      $this->currentElement = $attrs;
    }
    $this->currentTag = $name;
  }

  // endElement - callback handler for the closing tag of an XML element.
  // When we are here, currentElement is an array of the element attributes (as set in startElement).
  // Here we do the actual import of data into the database.
  function endElement($parser, $name) {
    if ($name == 'GROUP') {
      $this->groupData = $this->currentElement;
      // Now groupData is an array of group properties. We'll use it later to create a group.
      // Cannot create the group here. Need to determine whether logins collide with existing logins.
      $this->currentElement = array();
    }
    if ($name == 'ROLE') {
      $this->roles[$this->currentElement['ID']] = $this->currentElement;
      $this->currentElement = array();
    }
    if ($name == 'USER') {
      $this->users[$this->currentElement['ID']] = $this->currentElement;
      $this->currentElement = array();
    }
    if ($name == 'USERS') {
      foreach ($this->users as $user_item) {
        if (('' != $user_item['STATUS']) && ttUserHelper::getUserByLogin($user_item['LOGIN'])) {
          // We have a login collision, cannot import any data.
          $this->canImport = false;
          break;
        }
      }

      // Now we can create a group.
      if ($this->canImport) {
        $this->top_role_id = ttRoleHelper::getRoleByRank(512, 0);
        $group_id = $this->createGroup(array(
          'name' => $this->groupData['NAME'],
          'currency' => $this->groupData['CURRENCY'],
          'decimal_mark' => $this->groupData['DECIMAL_MARK'],
          'lang' => $this->groupData['LANG'],
          'date_format' => $this->groupData['DATE_FORMAT'],
          'time_format' => $this->groupData['TIME_FORMAT'],
          'week_start' => $this->groupData['WEEK_START'],
          'tracking_mode' => $this->groupData['TRACKING_MODE'],
          'project_required' => $this->groupData['PROJECT_REQUIRED'],
          'task_required' => $this->groupData['TASK_REQUIRED'],
          'record_type' => $this->groupData['RECORD_TYPE'],
          'bcc_email' => $this->groupData['BCC_EMAIL'],
          'allow_ip' => $this->groupData['ALLOW_IP'],
          'password_complexity' => $this->groupData['PASSWORD_COMPLEXITY'],
          'plugins' => $this->groupData['PLUGINS'],
          'lock_spec' => $this->groupData['LOCK_SPEC'],
          'workday_minutes' => $this->groupData['WORKDAY_MINUTES'],
          'config' => $this->groupData['CONFIG']));
        if ($group_id) {
          $this->group_id = $group_id;

          // Create roles.
          foreach ($this->roles as $key=>$role_item) {
            $role_id = ttRoleHelper::insert(array(
              'group_id' => $this->group_id,
              'name' => $role_item['NAME'],
              'rank' => $role_item['RANK'],
              'rights' => $role_item['RIGHTS'],
              'status' => $role_item['STATUS']));
            $this->roleMap[$role_item['ID']] = $role_id;
          }

          foreach ($this->users as $key=>$user_item) {
            $role_id = $user_item['ROLE_ID'] === '0' ? $this->top_role_id :  $this->roleMap[$user_item['ROLE_ID']]; // 0 (not null) means top manager role.
            $user_id = ttUserHelper::insert(array(
              'group_id' => $this->group_id,
              'role_id' => $role_id,
              'client_id' => $user_item['CLIENT_ID'], // Note: NOT mapped value, replaced in CLIENT handler.
              'name' => $user_item['NAME'],
              'login' => $user_item['LOGIN'],
              'password' => $user_item['PASSWORD'],
              'rate' => $user_item['RATE'],
              'email' => $user_item['EMAIL'],
              'status' => $user_item['STATUS']), false);
            $this->userMap[$key] = $user_id;
          }
        }
      }
    }

    if ($name == 'TASK' && $this->canImport) {
      $this->taskMap[$this->currentElement['ID']] =
        ttTaskHelper::insert(array(
          'group_id' => $this->group_id,
          'name' => $this->currentElement['NAME'],
          'description' => $this->currentElement['DESCRIPTION'],
          'status' => $this->currentElement['STATUS']));
    }
    if ($name == 'PROJECT' && $this->canImport) {
      // Prepare a list of task ids.
      $tasks = explode(',', $this->currentElement['TASKS']);
      foreach ($tasks as $id)
        $mapped_tasks[] = $this->taskMap[$id];

      // Add a new project.
      $this->projectMap[$this->currentElement['ID']] =
        ttProjectHelper::insert(array(
          'group_id' => $this->group_id,
          'name' => $this->currentElement['NAME'],
          'description' => $this->currentElement['DESCRIPTION'],
          'tasks' => $mapped_tasks,
          'status' => $this->currentElement['STATUS']));
    }
    if ($name == 'USER_PROJECT_BIND' && $this->canImport) {
      ttUserHelper::insertBind(
        $this->userMap[$this->currentElement['USER_ID']],
        $this->projectMap[$this->currentElement['PROJECT_ID']],
        $this->currentElement['RATE'],
        $this->currentElement['STATUS']);
    }

    if ($name == 'CLIENT' && $this->canImport) {
      // Prepare a list of project ids.
      if ($this->currentElement['PROJECTS']) {
        $projects = explode(',', $this->currentElement['PROJECTS']);
        foreach ($projects as $id)
          $mapped_projects[] = $this->projectMap[$id];
      }

      $this->clientMap[$this->currentElement['ID']] =
        ttClientHelper::insert(array(
          'group_id' => $this->group_id,
          'name' => $this->currentElement['NAME'],
          'address' => $this->currentElement['ADDRESS'],
          'tax' => $this->currentElement['TAX'],
          'projects' => $mapped_projects,
          'status' => $this->currentElement['STATUS']));

        // Update client_id for tt_users to a mapped value.
        // We did not do it during user insertion because clientMap was not ready then.
        if ($this->currentElement['ID'] != $this->clientMap[$this->currentElement['ID']])
          ttClientHelper::setMappedClient($this->group_id, $this->currentElement['ID'], $this->clientMap[$this->currentElement['ID']]);
    }

    if ($name == 'INVOICE' && $this->canImport) {
      $this->invoiceMap[$this->currentElement['ID']] =
        ttInvoiceHelper::insert(array(
          'group_id' => $this->group_id,
          'name' => $this->currentElement['NAME'],
          'date' => $this->currentElement['DATE'],
          'client_id' => $this->clientMap[$this->currentElement['CLIENT_ID']],
          'discount' => $this->currentElement['DISCOUNT'],
          'status' => $this->currentElement['STATUS']));
    }

    if ($name == 'MONTHLY_QUOTA' && $this->canImport) {
      $this->insertMonthlyQuota($this->group_id, $this->currentElement['YEAR'], $this->currentElement['MONTH'], $this->currentElement['MINUTES']);
    }

    if ($name == 'LOG_ITEM' && $this->canImport) {
      $this->logMap[$this->currentElement['ID']] =
        ttTimeHelper::insert(array(
          'user_id' => $this->userMap[$this->currentElement['USER_ID']],
          'date' => $this->currentElement['DATE'],
          'start' => $this->currentElement['START'],
          'finish' => $this->currentElement['FINISH'],
          'duration' => $this->currentElement['DURATION'],
          'client' => $this->clientMap[$this->currentElement['CLIENT_ID']],
          'project' => $this->projectMap[$this->currentElement['PROJECT_ID']],
          'task' => $this->taskMap[$this->currentElement['TASK_ID']],
          'invoice' => $this->invoiceMap[$this->currentElement['INVOICE_ID']],
          'note' => (isset($this->currentElement['COMMENT']) ? $this->currentElement['COMMENT'] : ''),
          'billable' => $this->currentElement['BILLABLE'],
          'paid' => $this->currentElement['PAID'],
          'status' => $this->currentElement['STATUS']));
    }

    if ($name == 'CUSTOM_FIELD' && $this->canImport) {
      $this->customFieldMap[$this->currentElement['ID']] =
        ttCustomFieldHelper::insertField(array(
          'group_id' => $this->group_id,
          'type' => $this->currentElement['TYPE'],
          'label' => $this->currentElement['LABEL'],
          'required' => $this->currentElement['REQUIRED'],
          'status' => $this->currentElement['STATUS']));
    }

    if ($name == 'CUSTOM_FIELD_OPTION' && $this->canImport) {
      $this->customFieldOptionMap[$this->currentElement['ID']] =
        ttCustomFieldHelper::insertOption(array(
          'field_id' => $this->customFieldMap[$this->currentElement['FIELD_ID']],
          'value' => $this->currentElement['VALUE']));
    }

    if ($name == 'CUSTOM_FIELD_LOG_ENTRY' && $this->canImport) {
      ttCustomFieldHelper::insertLogEntry(array(
        'log_id' => $this->logMap[$this->currentElement['LOG_ID']],
        'field_id' => $this->customFieldMap[$this->currentElement['FIELD_ID']],
        'option_id' => $this->customFieldOptionMap[$this->currentElement['OPTION_ID']],
        'value' => $this->currentElement['VALUE'],
        'status' => $this->currentElement['STATUS']));
    }

    if ($name == 'EXPENSE_ITEM' && $this->canImport) {
      ttExpenseHelper::insert(array(
        'date' => $this->currentElement['DATE'],
        'user_id' => $this->userMap[$this->currentElement['USER_ID']],
        'client_id' => $this->clientMap[$this->currentElement['CLIENT_ID']],
        'project_id' => $this->projectMap[$this->currentElement['PROJECT_ID']],
        'name' => $this->currentElement['NAME'],
        'cost' => $this->currentElement['COST'],
        'invoice_id' => $this->invoiceMap[$this->currentElement['INVOICE_ID']],
        'paid' => $this->currentElement['PAID'],
        'status' => $this->currentElement['STATUS']));
    }

    if ($name == 'FAV_REPORT' && $this->canImport) {
      $user_list = '';
      if (strlen($this->currentElement['USERS']) > 0) {
        $arr = explode(',', $this->currentElement['USERS']);
        foreach ($arr as $v)
          $user_list .= (strlen($user_list) == 0 ? '' : ',').$this->userMap[$v];
      }
      ttFavReportHelper::insertReport(array(
        'name' => $this->currentElement['NAME'],
        'user_id' => $this->userMap[$this->currentElement['USER_ID']],
        'client' => $this->clientMap[$this->currentElement['CLIENT_ID']],
        'option' => $this->customFieldOptionMap[$this->currentElement['CF_1_OPTION_ID']],
        'project' => $this->projectMap[$this->currentElement['PROJECT_ID']],
        'task' => $this->taskMap[$this->currentElement['TASK_ID']],
        'billable' => $this->currentElement['BILLABLE'],
        'users' => $user_list,
        'period' => $this->currentElement['PERIOD'],
        'from' => $this->currentElement['PERIOD_START'],
        'to' => $this->currentElement['PERIOD_END'],
        'chclient' => (int) $this->currentElement['SHOW_CLIENT'],
        'chinvoice' => (int) $this->currentElement['SHOW_INVOICE'],
        'chpaid' => (int) $this->currentElement['SHOW_PAID'],
        'chip' => (int) $this->currentElement['SHOW_IP'],
        'chproject' => (int) $this->currentElement['SHOW_PROJECT'],
        'chstart' => (int) $this->currentElement['SHOW_START'],
        'chduration' => (int) $this->currentElement['SHOW_DURATION'],
        'chcost' => (int) $this->currentElement['SHOW_COST'],
        'chtask' => (int) $this->currentElement['SHOW_TASK'],
        'chfinish' => (int) $this->currentElement['SHOW_END'],
        'chnote' => (int) $this->currentElement['SHOW_NOTE'],
        'chcf_1' => (int) $this->currentElement['SHOW_CUSTOM_FIELD_1'],
        'group_by' => $this->currentElement['GROUP_BY'],
        'chtotalsonly' => (int) $this->currentElement['SHOW_TOTALS_ONLY']));
    }
    $this->currentTag = '';
  }

  // dataElement - callback handler for text data fragments. It builds up currentElement array with text pieces from XML.
  function dataElement($parser, $data) {
    if ($this->currentTag == 'NAME'
      || $this->currentTag == 'DESCRIPTION'
      || $this->currentTag == 'LABEL'
      || $this->currentTag == 'VALUE'
      || $this->currentTag == 'COMMENT'
      || $this->currentTag == 'ADDRESS'
      || $this->currentTag == 'ALLOW_IP'
      || $this->currentTag == 'PASSWORD_COMPLEXITY') {
      if (isset($this->currentElement[$this->currentTag]))
        $this->currentElement[$this->currentTag] .= trim($data);
      else
        $this->currentElement[$this->currentTag] = trim($data);
    }
  }

  // importXml - uncompresses the file, reads and parses its content. During parsing,
  // startElement, endElement, and dataElement functions are called as many times as necessary.
  // Actual import occurs in the endElement handler.
  function importXml() {
    global $i18n;

    // Do we have a compressed file?
    $compressed = false;
    $file_ext = substr($_FILES['xmlfile']['name'], strrpos($_FILES['xmlfile']['name'], '.') + 1);
    if (in_array($file_ext, array('bz','tbz','bz2','tbz2'))) {
      $compressed = true;
    }

    // Create a temporary file.
    $dirName = dirname(TEMPLATE_DIR . '_c/.');
    $filename = tempnam($dirName, 'import_');

    // If the file is compressed - uncompress it.
    if ($compressed) {
      if (!$this->uncompress($_FILES['xmlfile']['tmp_name'], $filename)) {
        $this->errors->add($i18n->get('error.sys'));
        return;
      }
      unlink($_FILES['xmlfile']['tmp_name']);
    } else {
      if (!move_uploaded_file($_FILES['xmlfile']['tmp_name'], $filename)) {
        $this->errors->add($i18n->get('error.upload'));
        return;
      }
    }

    // Initialize XML parser.
    $parser = xml_parser_create();
    xml_set_object($parser, $this);
    xml_set_element_handler($parser, 'startElement', 'endElement');
    xml_set_character_data_handler($parser, 'dataElement');

    // Read and parse the content of the file. During parsing, startElement, endElement, and dataElement functions are called.
    $file = fopen($filename, 'r');
    while ($data = fread($file, 4096)) {
      if (!xml_parse($parser, $data, feof($file))) {
        $this->errors->add(sprintf("XML error: %s at line %d",
          xml_error_string(xml_get_error_code($parser)),
          xml_get_current_line_number($parser)));
      }
      if (!$this->canImport) {
        $this->errors->add($i18n->get('error.user_exists'));
        break;
      }
    }
    xml_parser_free($parser);
    if ($file) fclose($file);
    unlink($filename);
  }

  // uncompress - uncompresses the content of the $in file into the $out file.
  function uncompress($in, $out) {
    // Do we have the uncompress function?
    if (!function_exists('bzopen'))
      return false;

    // Initial checks of file names and permissions.
    if (!file_exists($in) || !is_readable ($in))
      return false;
    if ((!file_exists($out) && !is_writable(dirname($out))) || (file_exists($out) && !is_writable($out)))
      return false;

    if (!$out_file = fopen($out, 'wb'))
      return false;
    if (!$in_file = bzopen ($in, 'r'))
      return false;

    while (!feof($in_file)) {
      $buffer = bzread($in_file, 4096);
      fwrite($out_file, $buffer, 4096);
    }
    bzclose($in_file);
    fclose ($out_file);
    return true;
  }

  // createGroup function creates a new group.
  private function createGroup($fields) {

    global $user;
    $mdb2 = getConnection();

    $columns = '(name, currency, decimal_mark, lang, date_format, time_format, week_start, tracking_mode'.
      ', project_required, task_required, record_type, bcc_email, allow_ip, password_complexity, plugins'.
      ', lock_spec, workday_minutes, config, created, created_ip, created_by)';

    $values = ' values ('.$mdb2->quote(trim($fields['name']));
    $values .= ', '.$mdb2->quote(trim($fields['currency']));
    $values .= ', '.$mdb2->quote($fields['decimal_mark']);
    $values .= ', '.$mdb2->quote($fields['lang']);
    $values .= ', '.$mdb2->quote($fields['date_format']);
    $values .= ', '.$mdb2->quote($fields['time_format']);
    $values .= ', '.(int)$fields['week_start'];
    $values .= ', '.(int)$fields['tracking_mode'];
    $values .= ', '.(int)$fields['project_required'];
    $values .= ', '.(int)$fields['task_required'];
    $values .= ', '.(int)$fields['record_type'];
    $values .= ', '.$mdb2->quote($fields['bcc_email']);
    $values .= ', '.$mdb2->quote($fields['allow_ip']);
    $values .= ', '.$mdb2->quote($fields['password_complexity']);
    $values .= ', '.$mdb2->quote($fields['plugins']);
    $values .= ', '.$mdb2->quote($fields['lock_spec']);
    $values .= ', '.(int)$fields['workday_minutes'];
    $values .= ', '.$mdb2->quote($fields['config']);
    $values .= ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$mdb2->quote($user->id);
    $values .= ')';

    $sql = 'insert into tt_groups '.$columns.$values;
    $affected = $mdb2->exec($sql);
    if (!is_a($affected, 'PEAR_Error')) {
      $group_id = $mdb2->lastInsertID('tt_groups', 'id');
      return $group_id;
    }
    return false;
  }

  // insertMonthlyQuota - a helper function to insert a monthly quota.
  private function insertMonthlyQuota($group_id, $year, $month, $minutes) {
    $mdb2 = getConnection();
    $sql = "INSERT INTO tt_monthly_quotas (group_id, year, month, minutes) values ($group_id, $year, $month, $minutes)";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
}
