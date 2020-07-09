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

// ttOrgImportHelper class is used to import organization data from an XML file
// prepared by ttOrgExportHelper and consisting of nested groups with their info.
class ttOrgImportHelper {
  var $errors               = null; // Errors go here. Set in constructor by reference.
  var $schema_version       = null; // Database schema version from XML file we import from.
  var $num_users            = 0;    // A number of active and inactive users we are importing.
  var $conflicting_logins   = null; // A comma-separated list of logins we cannot import.
  var $canImport      = true;    // False if we cannot import data due to a conflict such as login collision.
  var $firstPass      = true;    // True during first pass through the file.
  var $org_id         = null;    // Organization id (same as top group_id).
  var $current_group_id     = null; // Current group id during parsing.
  var $parents        = array(); // A stack of parent group ids for current group all the way to the root including self.
  var $top_role_id    = 0;       // Top role id.

  // Entity maps for current group. They map XML ids with database ids.
  var $currentGroupRoleMap    = array();
  var $currentGroupTaskMap    = array();
  var $currentGroupProjectMap = array();
  var $currentGroupClientMap  = array();
  var $currentGroupUserMap    = array();
  var $currentGroupTimesheetMap = array();
  var $currentGroupInvoiceMap = array();
  var $currentGroupLogMap     = array();
  var $currentGroupCustomFieldMap = array();
  var $currentGroupCustomFieldOptionMap = array();
  var $currentGroupTemplateMap = array();
  var $currentGroupFavReportMap = array();

  // Constructor.
  function __construct(&$errors) {
    $this->errors = &$errors;
    $this->top_role_id = $this->getTopRole();
  }

  // startElement - callback handler for opening tags in XML.
  function startElement($parser, $name, $attrs) {
    global $i18n;

    // First pass through the file determines if we can import data.
    // We require 2 things:
    //   1) Database schema version must be set. This ensures we have a compatible file.
    //   2) No login collisions are allowed.
    if ($this->firstPass) {
      if ($name == 'ORG' && $this->canImport) {
         if ($attrs['SCHEMA'] == null) {
           // We need (database) schema attribute to be available for import to work.
           // Old Time Tracker export files don't have this.
           // Current import code does not work with old format because we had to
           // restructure data in export files for subgroup support.
           $this->canImport = false;
           $this->errors->add($i18n->get('error.format'));
           return;
         }
      }

      // In first pass we check user logins for potential collisions with existing.
      if ($name == 'USER' && $this->canImport) {
        $login = $attrs['LOGIN'];
        if ('' != $attrs['STATUS']) $this->num_users++;
        if ('' != $attrs['STATUS'] && $this->loginExists($login)) {
          // We have a login collision. Append colliding login to a list of things we cannot import.
          $this->conflicting_logins .= ($this->conflicting_logins ? ", $login" : $login);
          // The above is printed in error message with all found colliding logins.
        }
      }
    }

    // Second pass processing. We import data here, one tag at a time.
    if (!$this->firstPass && $this->canImport && $this->errors->no()) {
      $mdb2 = getConnection();

      // We are in second pass and can import data.
      if ($name == 'GROUP') {
        // Create a new group.
        $this->current_group_id = $this->createGroup(array(
          'parent_id' => $this->current_group_id, // Note: after insert current_group_id changes.
          'org_id' => $this->org_id,
          'group_key' => $attrs['GROUP_KEY'],
          'name' => $attrs['NAME'],
          'description' => $attrs['DESCRIPTION'],
          'currency' => $attrs['CURRENCY'],
          'decimal_mark' => $attrs['DECIMAL_MARK'],
          'lang' => $attrs['LANG'],
          'date_format' => $attrs['DATE_FORMAT'],
          'time_format' => $attrs['TIME_FORMAT'],
          'week_start' => $attrs['WEEK_START'],
          'tracking_mode' => $attrs['TRACKING_MODE'],
          'project_required' => $attrs['PROJECT_REQUIRED'],
          'task_required' => $attrs['TASK_REQUIRED'],
          'record_type' => $attrs['RECORD_TYPE'],
          'bcc_email' => $attrs['BCC_EMAIL'],
          'allow_ip' => $attrs['ALLOW_IP'],
          'password_complexity' => $attrs['PASSWORD_COMPLEXITY'],
          'plugins' => $attrs['PLUGINS'],
          'lock_spec' => $attrs['LOCK_SPEC'],
          'workday_minutes' => $attrs['WORKDAY_MINUTES'],
          'custom_logo' => $attrs['CUSTOM_LOGO'],
          'config' => $attrs['CONFIG']));

        // Special handling for top group.
        if (!$this->org_id && $this->current_group_id) {
          $this->org_id = $this->current_group_id;
          $sql = "update tt_groups set org_id = $this->current_group_id where org_id is NULL and id = $this->current_group_id";
          $affected = $mdb2->exec($sql);
        }
        // Add self to parent stack.
        array_push($this->parents, $this->current_group_id);

        // Recycle all maps as we are starting to work on new group.
        // Note that for this to work properly all nested groups must be last entries in xml for each group.
        unset($this->currentGroupRoleMap); $this->currentGroupRoleMap = array();
        unset($this->currentGroupTaskMap); $this->currentGroupTaskMap = array();
        unset($this->currentGroupProjectMap); $this->currentGroupProjectMap = array();
        unset($this->currentGroupClientMap); $this->currentGroupClientMap = array();
        unset($this->currentGroupUserMap); $this->currentGroupUserMap = array();
        unset($this->currentGroupTimesheetMap); $this->currentGroupTimesheetMap = array();
        unset($this->currentGroupInvoiceMap); $this->currentGroupInvoiceMap = array();
        unset($this->currentGroupLogMap); $this->currentGroupLogMap = array();
        unset($this->currentGroupCustomFieldMap); $this->currentGroupCustomFieldMap = array();
        unset($this->currentGroupCustomFieldOptionMap); $this->currentGroupCustomFieldOptionMap = array();
        unset($this->currentGroupTemplateMap); $this->currentGroupTemplateMap = array();
        unset($this->currentGroupFavReportMap); $this->currentGroupFavReportMap = array();
        return;
      }

      if ($name == 'ROLE') {
        // We get here when processing <role> tags for the current group.
        $role_id = $this->insertRole(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'name' => $attrs['NAME'],
          'description' => $attrs['DESCRIPTION'],
          'rank' => $attrs['RANK'],
          'rights' => $attrs['RIGHTS'],
          'status' => $attrs['STATUS']));
        if ($role_id) {
          // Add a mapping.
          $this->currentGroupRoleMap[$attrs['ID']] = $role_id;
        } else {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'TASK') {
        // We get here when processing <task> tags for the current group.
        $task_id = $this->insertTask(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'name' => $attrs['NAME'],
          'description' => $attrs['DESCRIPTION'],
          'status' => $attrs['STATUS']));
        if ($task_id) {
          // Add a mapping.
          $this->currentGroupTaskMap[$attrs['ID']] = $task_id;
        } else {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'PROJECT') {
        // We get here when processing <project> tags for the current group.

        // Prepare a list of task ids.
        if ($attrs['TASKS']) {
          $tasks = explode(',', $attrs['TASKS']);
          foreach ($tasks as $id)
            $mapped_tasks[] = $this->currentGroupTaskMap[$id];
        }

        $project_id = $this->insertProject(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'name' => $attrs['NAME'],
          'description' => $attrs['DESCRIPTION'],
          'tasks' => $mapped_tasks,
          'status' => $attrs['STATUS']));
        if ($project_id) {
          // Add a mapping.
          $this->currentGroupProjectMap[$attrs['ID']] = $project_id;
        } else {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'CLIENT') {
        // We get here when processing <client> tags for the current group.

        // Prepare a list of project ids.
        if ($attrs['PROJECTS']) {
          $projects = explode(',', $attrs['PROJECTS']);
          foreach ($projects as $id)
            $mapped_projects[] = $this->currentGroupProjectMap[$id];
        }

        $client_id = $this->insertClient(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'name' => $attrs['NAME'],
          'address' => $attrs['ADDRESS'],
          'tax' => $attrs['TAX'],
          'projects' => $mapped_projects,
          'status' => $attrs['STATUS']));
        if ($client_id) {
          // Add a mapping.
          $this->currentGroupClientMap[$attrs['ID']] = $client_id;
        } else {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'USER') {
        // We get here when processing <user> tags for the current group.

        $role_id = $attrs['ROLE_ID'] === '0' ? $this->top_role_id :  $this->currentGroupRoleMap[$attrs['ROLE_ID']]; // 0 (not null) means top manager role.

        $user_id = $this->insertUser(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'role_id' => $role_id,
          'client_id' => $this->currentGroupClientMap[$attrs['CLIENT_ID']],
          'name' => $attrs['NAME'],
          'login' => $attrs['LOGIN'],
          'password' => $attrs['PASSWORD'],
          'rate' => $attrs['RATE'],
          'quota_percent' => $attrs['QUOTA_PERCENT'],
          'email' => $attrs['EMAIL'],
          'status' => $attrs['STATUS']), false);
        if ($user_id) {
          // Add a mapping.
          $this->currentGroupUserMap[$attrs['ID']] = $user_id;
        } else {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'USER_PROJECT_BIND') {
        if (!$this->insertUserProjectBind(array(
          'user_id' => $this->currentGroupUserMap[$attrs['USER_ID']],
          'project_id' => $this->currentGroupProjectMap[$attrs['PROJECT_ID']],
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'rate' => $attrs['RATE'],
          'status' => $attrs['STATUS']))) {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'TIMESHEET') {
        // We get here when processing <timesheet> tags for the current group.
        $timesheet_id = $this->insertTimesheet(array(
          'user_id' => $this->currentGroupUserMap[$attrs['USER_ID']],
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'client_id' => $this->currentGroupClientMap[$attrs['CLIENT_ID']],
          'project_id' => $this->currentGroupProjectMap[$attrs['PROJECT_ID']],
          'name' => $attrs['NAME'],
          'comment' => $attrs['COMMENT'],
          'start_date' => $attrs['START_DATE'],
          'end_date' => $attrs['END_DATE'],
          'submit_status' => $attrs['SUBMIT_STATUS'],
          'approve_status' => $attrs['APPROVE_STATUS'],
          'approve_comment' => $attrs['APPROVE_COMMENT'],
          'status' => $attrs['STATUS']));
        if ($timesheet_id) {
          // Add a mapping.
          $this->currentGroupTimesheetMap[$attrs['ID']] = $timesheet_id;
        } else {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'INVOICE') {
        // We get here when processing <invoice> tags for the current group.
        $invoice_id = $this->insertInvoice(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'name' => $attrs['NAME'],
          'date' => $attrs['DATE'],
          'client_id' => $this->currentGroupClientMap[$attrs['CLIENT_ID']],
          'status' => $attrs['STATUS']));
        if ($invoice_id) {
          // Add a mapping.
          $this->currentGroupInvoiceMap[$attrs['ID']] = $invoice_id;
        } else {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'LOG_ITEM') {
        // We get here when processing <log_item> tags for the current group.
        $log_item_id = $this->insertLogEntry(array(
          'user_id' => $this->currentGroupUserMap[$attrs['USER_ID']],
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'date' => $attrs['DATE'],
          'start' => $attrs['START'],
          'finish' => $attrs['FINISH'],
          'duration' => $attrs['DURATION'],
          'client_id' => $this->currentGroupClientMap[$attrs['CLIENT_ID']],
          'project_id' => $this->currentGroupProjectMap[$attrs['PROJECT_ID']],
          'task_id' => $this->currentGroupTaskMap[$attrs['TASK_ID']],
          'timesheet_id' => $this->currentGroupTimesheetMap[$attrs['TIMESHEET_ID']],
          'invoice_id' => $this->currentGroupInvoiceMap[$attrs['INVOICE_ID']],
          'comment' => (isset($attrs['COMMENT']) ? $attrs['COMMENT'] : ''),
          'billable' => $attrs['BILLABLE'],
          'approved' => $attrs['APPROVED'],
          'paid' => $attrs['PAID'],
          'status' => $attrs['STATUS']));
        if ($log_item_id) {
          // Add a mapping.
          $this->currentGroupLogMap[$attrs['ID']] = $log_item_id;
        } else $this->errors->add($i18n->get('error.db'));
        return;
      }

      if ($name == 'CUSTOM_FIELD') {
        // We get here when processing <custom_field> tags for the current group.
        $custom_field_id = $this->insertCustomField(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'entity_type' => $attrs['ENTITY_TYPE'],
          'type' => $attrs['TYPE'],
          'label' => $attrs['LABEL'],
          'required' => $attrs['REQUIRED'],
          'status' => $attrs['STATUS']));
        if ($custom_field_id) {
          // Add a mapping.
          $this->currentGroupCustomFieldMap[$attrs['ID']] = $custom_field_id;
        } else $this->errors->add($i18n->get('error.db'));
        return;
      }

      if ($name == 'CUSTOM_FIELD_OPTION') {
        // We get here when processing <custom_field_option> tags for the current group.
        $custom_field_option_id = $this->insertCustomFieldOption(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'field_id' => $this->currentGroupCustomFieldMap[$attrs['FIELD_ID']],
          'value' => $attrs['VALUE']));
        if ($custom_field_option_id) {
          // Add a mapping.
          $this->currentGroupCustomFieldOptionMap[$attrs['ID']] = $custom_field_option_id;
        } else $this->errors->add($i18n->get('error.db'));
        return;
      }

      if ($name == 'CUSTOM_FIELD_LOG_ENTRY') {
        // We get here when processing <custom_field_log_entry> tags for the current group.
        if (!$this->insertCustomFieldLogEntry(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'log_id' => $this->currentGroupLogMap[$attrs['LOG_ID']],
          'field_id' => $this->currentGroupCustomFieldMap[$attrs['FIELD_ID']],
          'option_id' => $this->currentGroupCustomFieldOptionMap[$attrs['OPTION_ID']],
          'value' => $attrs['VALUE'],
          'status' => $attrs['STATUS']))) {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'EXPENSE_ITEM') {
        // We get here when processing <expense_item> tags for the current group.
        $expense_item_id = $this->insertExpense(array(
          'date' => $attrs['DATE'],
          'user_id' => $this->currentGroupUserMap[$attrs['USER_ID']],
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'client_id' => $this->currentGroupClientMap[$attrs['CLIENT_ID']],
          'project_id' => $this->currentGroupProjectMap[$attrs['PROJECT_ID']],
          'timesheet_id' => $this->currentGroupTimesheetMap[$attrs['TIMESHEET_ID']],
          'name' => $attrs['NAME'],
          'cost' => $attrs['COST'],
          'invoice_id' => $this->currentGroupInvoiceMap[$attrs['INVOICE_ID']],
          'approved' => $attrs['APPROVED'],
          'paid' => $attrs['PAID'],
          'status' => $attrs['STATUS']));
        if (!$expense_item_id) $this->errors->add($i18n->get('error.db'));
        return;
      }

      if ($name == 'PREDEFINED_EXPENSE') {
        if (!$this->insertPredefinedExpense(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'name' => $attrs['NAME'],
          'cost' => $attrs['COST']))) {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'TEMPLATE') {
        $template_id = $this->insertTemplate(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'name' => $attrs['NAME'],
          'description' => $attrs['DESCRIPTION'],
          'content' => $attrs['CONTENT'],
          'status' => $attrs['STATUS']));
        if ($template_id) {
          // Add a mapping.
          $this->currentGroupTemplateMap[$attrs['ID']] = $template_id;
        } else $this->errors->add($i18n->get('error.db'));
        return;
      }

      if ($name == 'PROJECT_TEMPLATE_BIND') {
        if (!$this->insertProjectTemplateBind(array(
          'project_id' => $this->currentGroupProjectMap[$attrs['PROJECT_ID']],
          'template_id' => $this->currentGroupTemplateMap[$attrs['TEMPLATE_ID']],
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id))) {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'MONTHLY_QUOTA') {
        if (!$this->insertMonthlyQuota(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'year' => $attrs['YEAR'],
          'month' => $attrs['MONTH'],
          'minutes' => $attrs['MINUTES']))) {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'FAV_REPORT') {
        $user_list = '';
        if (strlen($attrs['USERS']) > 0) {
          $arr = explode(',', $attrs['USERS']);
          foreach ($arr as $v)
            $user_list .= (strlen($user_list) == 0 ? '' : ',').$this->currentGroupUserMap[$v];
        }
        $fav_report_id = $this->insertFavReport(array(
          'name' => $attrs['NAME'],
          'user_id' => $this->currentGroupUserMap[$attrs['USER_ID']],
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'report_spec' => $this->remapReportSpec($attrs['REPORT_SPEC']),
          'client' => $this->currentGroupClientMap[$attrs['CLIENT_ID']],
          'project' => $this->currentGroupProjectMap[$attrs['PROJECT_ID']],
          'task' => $this->currentGroupTaskMap[$attrs['TASK_ID']],
          'billable' => $attrs['BILLABLE'],
          'approved' => $attrs['APPROVED'],
          'invoice' => $attrs['INVOICE'],
          'timesheet' => $attrs['TIMESHEET'],
          'paid_status' => $attrs['PAID_STATUS'],
          'users' => $user_list,
          'period' => $attrs['PERIOD'],
          'from' => $attrs['PERIOD_START'],
          'to' => $attrs['PERIOD_END'],
          'chclient' => (int) $attrs['SHOW_CLIENT'],
          'chinvoice' => (int) $attrs['SHOW_INVOICE'],
          'chpaid' => (int) $attrs['SHOW_PAID'],
          'chip' => (int) $attrs['SHOW_IP'],
          'chproject' => (int) $attrs['SHOW_PROJECT'],
          'chtimesheet' => (int) $attrs['SHOW_TIMESHEET'],
          'chstart' => (int) $attrs['SHOW_START'],
          'chduration' => (int) $attrs['SHOW_DURATION'],
          'chcost' => (int) $attrs['SHOW_COST'],
          'chtask' => (int) $attrs['SHOW_TASK'],
          'chfinish' => (int) $attrs['SHOW_END'],
          'chnote' => (int) $attrs['SHOW_NOTE'],
          'chapproved' => (int) $attrs['SHOW_APPROVED'],
          'chunits' => (int) $attrs['SHOW_WORK_UNITS'],
          'group_by1' => $attrs['GROUP_BY1'],
          'group_by2' => $attrs['GROUP_BY2'],
          'group_by3' => $attrs['GROUP_BY3'],
          'chtotalsonly' => (int) $attrs['SHOW_TOTALS_ONLY']));
        if ($fav_report_id) {
          // Add a mapping.
          $this->currentGroupFavReportMap[$attrs['ID']] = $fav_report_id;
          } else $this->errors->add($i18n->get('error.db'));
        return;
      }

      if ($name == 'NOTIFICATION') {
        if (!$this->insertNotification(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'cron_spec' => $attrs['CRON_SPEC'],
          'last' => $attrs['LAST'],
          'next' => $attrs['NEXT'],
          'report_id' => $this->currentGroupFavReportMap[$attrs['REPORT_ID']],
          'email' => $attrs['EMAIL'],
          'cc' => $attrs['CC'],
          'subject' => $attrs['SUBJECT'],
          'report_condition' => $attrs['REPORT_CONDITION'],
          'status' => $attrs['STATUS']))) {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }

      if ($name == 'USER_PARAM') {
        if (!$this->insertUserParam(array(
          'group_id' => $this->current_group_id,
          'org_id' => $this->org_id,
          'user_id' => $this->currentGroupUserMap[$attrs['USER_ID']],
          'param_name' => $attrs['PARAM_NAME'],
          'param_value' => $attrs['PARAM_VALUE']))) {
          $this->errors->add($i18n->get('error.db'));
        }
        return;
      }
    }
  }

  // endElement - callback handler for ending tags in XML.
  // We use this only for process </group> element endings and
  // set current_group_id to an immediate parent.
  // This is required to import group hierarchy correctly.
  function endElement($parser, $name) {
    // No need to care about first or second pass, as this is used only in second pass.
    // See 2nd xml_set_element_handler, where this handler is set.
    if ($name == 'GROUP') {
      // Remove self from the parent stack.
      $self = array_pop($this->parents);
      // Set current group id to an immediate parent.
      $len = count($this->parents);
      $this->current_group_id = $len ? $this->parents[$len-1] : null;
    }
  }

  // importXml - uncompresses the file, reads and parses its content.
  // It goes through the file 2 times.
  //
  // During 1st pass, it determines whether we can import data.
  // In 1st pass, startElement function is called as many times as necessary.
  //
  // Actual import occurs during 2nd pass.
  // In 2nd pass, startElement and endElement are called many times.
  // We only use endElement to finish current group processing.
  //
  // The above allows us to export/import complex orgs with nested groups,
  // while by design all data are in attributes of the elements (no CDATA).
  //
  // There is currently at least one problem with keeping all data in attributes:
  // a vertical tab character 0xB anywhere breaks parsing, making import impossible.
  // See https://github.com/sparklemotion/nokogiri/issues/1581 - looks like
  // an XML standard thing. Apparently, other invalid characters break parsing too.
  // This problem needs to be addressed at some point but how exactly without
  // complicating export-import too much with CDATA and dataElement processing?
  function importXml() {
    global $i18n;

    if (!$_FILES['xmlfile']['name']) {
      $this->errors->add($i18n->get('error.upload'));
      return; // There is nothing to do if we don't have a file.
    }

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
    xml_set_element_handler($parser, 'startElement', false); // No need to process end tags in 1st pass.

    // We need to parse the file 2 times:
    //   1) First pass: determine if import is possible.
    //   2) Second pass: import data, one tag at a time.

    // Read and parse the content of the file. During parsing, startElement is called back for each tag.
    $file = fopen($filename, 'r');
    while (($data = fread($file, 4096)) && $this->errors->no()) {
      if (!xml_parse($parser, $data, feof($file))) {
        $this->errors->add(sprintf($i18n->get('error.xml'),
          xml_get_current_line_number($parser),
          xml_error_string(xml_get_error_code($parser))));
      }
    }
    if ($this->conflicting_logins) {
      $this->canImport = false;
      $this->errors->add($i18n->get('error.user_exists'));
      $this->errors->add(sprintf($i18n->get('error.cannot_import'), $this->conflicting_logins));
    }
    if (!ttUserHelper::canAdd($this->num_users)) {
      $this->canImport = false;
      $this->errors->add($i18n->get('error.user_count'));
    }

    $this->firstPass = false; // We are done with 1st pass.
    xml_parser_free($parser);
    if ($file) fclose($file);
    if ($this->errors->yes()) {
      // Remove the file and exit if we have errors.
      unlink($filename);
      return;
    }

    // Now we can do a second pass, where real work is done.
    $parser = xml_parser_create();
    xml_set_object($parser, $this);
    xml_set_element_handler($parser, 'startElement', 'endElement'); // Need to process ending tags too.

    // Read and parse the content of the file. During parsing, startElement and endElement are called back for each tag.
    $file = fopen($filename, 'r');
    while (($data = fread($file, 4096)) && $this->errors->no()) {
      if (!xml_parse($parser, $data, feof($file))) {
        $this->errors->add(sprintf($i18n->get('error.xml'),
          xml_get_current_line_number($parser),
          xml_error_string(xml_get_error_code($parser))));
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
    global $i18n;
    $mdb2 = getConnection();

    $columns = '(parent_id, org_id, group_key, name, description, currency, decimal_mark, lang, date_format, time_format,'.
      ' week_start, tracking_mode, project_required, task_required, record_type, bcc_email,'.
      ' allow_ip, password_complexity, plugins, lock_spec,'.
      ' workday_minutes, config, created, created_ip, created_by)';

    $values = ' values (';
    $values .= $mdb2->quote($fields['parent_id']);
    $values .= ', '.$mdb2->quote($fields['org_id']);
    $values .= ', '.$mdb2->quote(trim($fields['group_key']));
    $values .= ', '.$mdb2->quote(trim($fields['name']));
    $values .= ', '.$mdb2->quote(trim($fields['description']));
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
    $values .= ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$user->id;
    $values .= ')';

    $sql = 'insert into tt_groups '.$columns.$values;
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) {
      $this->errors->add($i18n->get('error.db'));
      return false;
    }

    $group_id = $mdb2->lastInsertID('tt_groups', 'id');
    return $group_id;
  }

  // insertMonthlyQuota - a helper function to insert a monthly quota.
  private function insertMonthlyQuota($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $year = (int) $fields['year'];
    $month = (int) $fields['month'];
    $minutes = (int) $fields['minutes'];

    $sql = "INSERT INTO tt_monthly_quotas (group_id, org_id, year, month, minutes)".
      " values ($group_id, $org_id, $year, $month, $minutes)";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // insertPredefinedExpense - a helper function to insert a predefined expense.
  private function insertPredefinedExpense($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $name = $mdb2->quote($fields['name']);
    $cost = $mdb2->quote($fields['cost']);

    $sql = "INSERT INTO tt_predefined_expenses (group_id, org_id, name, cost)".
      " values ($group_id, $org_id, $name, $cost)";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // insertTemplate - a helper function to insert a template.
  private function insertTemplate($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $name = $mdb2->quote($fields['name']);
    $description = $mdb2->quote($fields['description']);
    $content = $mdb2->quote($fields['content']);
    $status = $mdb2->quote($fields['status']);

    $sql = "INSERT INTO tt_templates (group_id, org_id, name, description, content, status)".
      " values ($group_id, $org_id, $name, $description, $content, $status)";
    $affected = $mdb2->exec($sql);
    $last_id = 0;
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_templates', 'id');
    return $last_id;
  }

  // insertProjectTemplateBind - inserts a project to template bind into tt_project_template_binds table.
  private function insertProjectTemplateBind($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $project_id = (int) $fields['project_id'];
    $template_id = (int) $fields['template_id'];
    $sql = "insert into tt_project_template_binds (project_id, template_id, group_id, org_id)".
      " values($project_id, $template_id, $group_id, $org_id)";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // insertExpense - a helper function to insert an expense item.
  private function insertExpense($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $date = $fields['date'];
    $user_id = (int) $fields['user_id'];
    $client_id = $fields['client_id'];
    $project_id = $fields['project_id'];
    $name = $fields['name'];
    $cost = str_replace(',', '.', $fields['cost']);
    $invoice_id = $fields['invoice_id'];
    $status = $fields['status'];
    $approved = (int) $fields['approved'];
    $paid = (int) $fields['paid'];
    $created = ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$user->id;

    $sql = "insert into tt_expense_items".
      " (date, user_id, group_id, org_id, client_id, project_id, name,".
      " cost, invoice_id, approved, paid, created, created_ip, created_by, status)".
      " values (".$mdb2->quote($date).", $user_id, $group_id, $org_id, ".$mdb2->quote($client_id).", ".$mdb2->quote($project_id).
      ", ".$mdb2->quote($name).", ".$mdb2->quote($cost).", ".$mdb2->quote($invoice_id).
      ", $approved, $paid $created, ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // insertTask function inserts a new task into database.
  private function insertTask($fields)
  {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $name = $fields['name'];
    $description = $fields['description'];
    $projects = $fields['projects'];
    $status = $fields['status'];

    $sql = "insert into tt_tasks (group_id, org_id, name, description, status)
      values ($group_id, $org_id, ".$mdb2->quote($name).", ".$mdb2->quote($description).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    $last_id = 0;
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_tasks', 'id');
    return $last_id;
  }

  // insertUserProjectBind - inserts a user to project bind into tt_user_project_binds table.
  private function insertUserProjectBind($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $user_id = (int) $fields['user_id'];
    $project_id = (int) $fields['project_id'];
    $rate = $mdb2->quote($fields['rate']);
    $status = $mdb2->quote($fields['status']);

    $sql = "insert into tt_user_project_binds (user_id, project_id, group_id, org_id, rate, status)".
      " values($user_id, $project_id, $group_id, $org_id, $rate, $status)";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // insertUser - inserts a user into database.
  private function insertUser($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];

    $columns = '(login, password, name, group_id, org_id, role_id, client_id, rate, quota_percent, email, created, created_ip, created_by, status)';

    $values = 'values (';
    $values .= $mdb2->quote($fields['login']);
    $values .= ', '.$mdb2->quote($fields['password']);
    $values .= ', '.$mdb2->quote($fields['name']);
    $values .= ', '.$group_id;
    $values .= ', '.$org_id;
    $values .= ', '.(int)$fields['role_id'];
    $values .= ', '.$mdb2->quote($fields['client_id']);
    $values .= ', '.$mdb2->quote($fields['rate']);
    $values .= ', '.$mdb2->quote($fields['quota_percent']);
    $values .= ', '.$mdb2->quote($fields['email']);
    $values .= ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$user->id;
    $values .= ', '.$mdb2->quote($fields['status']);
    $values .= ')';

    $sql = "insert into tt_users $columns $values";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    $last_id = $mdb2->lastInsertID('tt_users', 'id');
    return $last_id;
  }

  // insertProject - a helper function to insert a project as well as project to task binds.
  private function insertProject($fields)
  {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $name = $fields['name'];
    $description = $fields['description'];
    $tasks = $fields['tasks'];
    $comma_separated = implode(',', $tasks); // This is a comma-separated list of associated task ids.
    $status = $fields['status'];

    $sql = "insert into tt_projects (group_id, org_id, name, description, tasks, status)
      values ($group_id, $org_id, ".$mdb2->quote($name).", ".$mdb2->quote($description).", ".$mdb2->quote($comma_separated).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_projects', 'id');

    // Insert binds into tt_project_task_binds table.
    if (is_array($tasks)) {
      foreach ($tasks as $task_id) {
        $sql = "insert into tt_project_task_binds (project_id, task_id, group_id, org_id)".
          " values($last_id, $task_id, $group_id, $org_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }
    }

    return $last_id;
  }

  // insertRole - inserts a role into tt_roles table.
  private function insertRole($fields)
  {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $name = $fields['name'];
    $rank = (int) $fields['rank'];
    $description = $fields['description'];
    $rights = $fields['rights'];
    $status = $fields['status'];

    $sql = "insert into tt_roles (group_id, org_id, name, `rank`, description, rights, status)
      values ($group_id, $org_id, ".$mdb2->quote($name).", $rank, ".$mdb2->quote($description).", ".$mdb2->quote($rights).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_roles', 'id');
    return $last_id;
  }

  // insertTimesheet - inserts a timesheet in database.
  private function insertTimesheet($fields)
  {
    $mdb2 = getConnection();

    $user_id = (int) $fields['user_id'];
    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $client_id = $fields['client_id'];
    $project_id = $fields['project_id'];
    $name = $fields['name'];
    $comment = $fields['comment'];
    $start_date = $fields['start_date'];
    $end_date = $fields['end_date'];
    $submit_status = $fields['submit_status'];
    $approve_status = $fields['approve_status'];
    $approve_comment = $fields['approve_comment'];
    $status = $fields['status'];

    // Insert a new timesheet record.
    $sql = "insert into tt_timesheets (user_id, group_id, org_id, client_id, project_id, name,".
      " comment, start_date, end_date, submit_status, approve_status, approve_comment, status)".
      " values($user_id, $group_id, $org_id, ".$mdb2->quote($client_id).", ".$mdb2->quote($project_id).", ".$mdb2->quote($name).", ".
      $mdb2->quote($comment).", ".$mdb2->quote($start_date).", ".$mdb2->quote($end_date).", ".
      $mdb2->quote($submit_status).", ".$mdb2->quote($approve_status).", ".
      $mdb2->quote($approve_comment).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    $last_id = $mdb2->lastInsertID('tt_timesheets', 'id');
    return $last_id;
  }

  // insertInvoice - inserts an invoice in database.
  private function insertInvoice($fields)
  {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $name = $fields['name'];
    $client_id = (int) $fields['client_id'];
    $date = $fields['date'];
    $status = $fields['status'];

    // Insert a new invoice record.
    $sql = "insert into tt_invoices (group_id, org_id, name, date, client_id, status)".
      " values($group_id, $org_id, ".$mdb2->quote($name).", ".$mdb2->quote($date).", $client_id, ".$mdb2->quote($fields['status']).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    $last_id = $mdb2->lastInsertID('tt_invoices', 'id');
    return $last_id;
  }

  // The insertClient function inserts a new client as well as client to project binds.
  private function insertClient($fields)
  {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $name = $fields['name'];
    $address = $fields['address'];
    $tax = $fields['tax'];
    $projects = $fields['projects'];
    if ($projects)
      $comma_separated = implode(',', $projects); // This is a comma-separated list of associated projects ids.
    $status = $fields['status'];

    $tax = str_replace(',', '.', $tax);
    if ($tax == '') $tax = 0;

    $sql = "insert into tt_clients (group_id, org_id, name, address, tax, projects, status)".
      " values ($group_id, $org_id, ".$mdb2->quote($name).", ".$mdb2->quote($address).", $tax, ".$mdb2->quote($comma_separated).", ".$mdb2->quote($status).")";

    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_clients', 'id');

    if (count($projects) > 0)
      foreach ($projects as $p_id) {
        $sql = "insert into tt_client_project_binds (client_id, project_id, group_id, org_id) values($last_id, $p_id, $group_id, $org_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }

    return $last_id;
  }

  // insertFavReport - inserts a favorite report in database.
  private function insertFavReport($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];

    $sql = "insert into tt_fav_reports".
      " (name, user_id, group_id, org_id, report_spec, client_id, project_id, task_id,".
      " billable, approved, invoice, timesheet, paid_status, users, period, period_start, period_end,".
      " show_client, show_invoice, show_paid, show_ip,".
      " show_project, show_timesheet, show_start, show_duration, show_cost,".
      " show_task, show_end, show_note, show_approved, show_work_units,".
      " group_by1, group_by2, group_by3, show_totals_only)".
      " values(".
      $mdb2->quote($fields['name']).", ".$fields['user_id'].", $group_id, $org_id, ".
      $mdb2->quote($fields['report_spec']).", ".$mdb2->quote($fields['client']).", ".
      $mdb2->quote($fields['project']).", ".$mdb2->quote($fields['task']).", ".
      $mdb2->quote($fields['billable']).", ".$mdb2->quote($fields['approved']).", ".
      $mdb2->quote($fields['invoice']).", ".$mdb2->quote($fields['timesheet']).", ".
      $mdb2->quote($fields['paid_status']).", ".
      $mdb2->quote($fields['users']).", ".$mdb2->quote($fields['period']).", ".
      $mdb2->quote($fields['from']).", ".$mdb2->quote($fields['to']).", ".
      $fields['chclient'].", ".$fields['chinvoice'].", ".$fields['chpaid'].", ".$fields['chip'].", ".
      $fields['chproject'].", ".$fields['chtimesheet'].", ".$fields['chstart'].", ".$fields['chduration'].", ".
      $fields['chcost'].", ".$fields['chtask'].", ".$fields['chfinish'].", ".$fields['chnote'].", ".
      $fields['chapproved'].", ".$fields['chunits'].", ".
      $mdb2->quote($fields['group_by1']).", ".$mdb2->quote($fields['group_by2']).", ".
      $mdb2->quote($fields['group_by3']).", ".$fields['chtotalsonly'].")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_fav_reports', 'id');
    return $last_id;
  }

  // insertNotification function inserts a new notification into database.
  private function insertNotification($fields)
  {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $cron_spec = $fields['cron_spec'];
    $last = (int) $fields['last'];
    $next = (int) $fields['next'];
    $report_id = (int) $fields['report_id'];
    $email = $fields['email'];
    $cc = $fields['cc'];
    $subject = $fields['subject'];
    $report_condition = $fields['report_condition'];
    $status = $fields['status'];

    $sql = "insert into tt_cron".
      " (group_id, org_id, cron_spec, last, next, report_id, email, cc, subject, report_condition, status)".
      " values ($group_id, $org_id, ".$mdb2->quote($cron_spec).", $last, $next, $report_id, ".$mdb2->quote($email).", ".$mdb2->quote($cc).", ".$mdb2->quote($subject).", ".$mdb2->quote($report_condition).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // insertUserParam - a helper function to insert a user parameter.
  private function insertUserParam($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $user_id = (int) $fields['user_id'];
    $param_name = $fields['param_name'];
    $param_value = $fields['param_value'];

    $sql = "insert into tt_config".
      " (user_id, group_id, org_id, param_name, param_value)".
      " values ($user_id, $group_id, $org_id, ".$mdb2->quote($param_name).", ".$mdb2->quote($param_value).")";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // insertCustomField - a helper function to insert a custom field.
  private function insertCustomField($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $entity_type = (int) $fields['entity_type'];
    $type = (int) $fields['type'];
    $label = $fields['label'];
    $required = (int) $fields['required'];
    $status = $fields['status'];

    $sql = "insert into tt_custom_fields".
      " (group_id, org_id, entity_type, type, label, required, status)".
      " values($group_id, $org_id, $entity_type, $type, ".$mdb2->quote($label).", $required, ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_custom_fields', 'id');
    return $last_id;
  }

  // insertCustomFieldOption - a helper function to insert a custom field option.
  private function insertCustomFieldOption($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $field_id = (int) $fields['field_id'];
    $value = $fields['value'];

    $sql = "insert into tt_custom_field_options (group_id, org_id, field_id, value)".
      " values ($group_id, $org_id, $field_id, ".$mdb2->quote($value).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_custom_field_options', 'id');
    return $last_id;
  }

  // insertLogEntry - a helper function to insert a time log entry.
  private function insertLogEntry($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $user_id = (int) $fields['user_id'];
    $date = $fields['date'];
    $start = $fields['start'];
    $duration = $fields['duration'];
    $client_id = $fields['client_id'];
    $project_id = $fields['project_id'];
    $task_id = $fields['task_id'];
    $timesheet_id = $fields['timesheet_id'];
    $invoice_id = $fields['invoice_id'];
    $comment = $fields['comment'];
    $billable = (int) $fields['billable'];
    $approved = (int) $fields['approved'];
    $paid = (int) $fields['paid'];
    $status = $fields['status'];

    $sql = "insert into tt_log".
      " (user_id, group_id, org_id, date, start, duration, client_id, project_id, task_id, timesheet_id, invoice_id, comment".
      ", billable, approved, paid, created, created_ip, created_by, status)".
      " values ($user_id, $group_id, $org_id".
      ", ".$mdb2->quote($date).
      ", ".$mdb2->quote($start).
      ", ".$mdb2->quote($duration).
      ", ".$mdb2->quote($client_id).
      ", ".$mdb2->quote($project_id).
      ", ".$mdb2->quote($task_id).
      ", ".$mdb2->quote($timesheet_id).
      ", ".$mdb2->quote($invoice_id).
      ", ".$mdb2->quote($comment).
      ", $billable, $approved, $paid".
      ", now(), ".$mdb2->quote($_SERVER['REMOTE_ADDR']).", ".$user->id.
      ", ". $mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) {
      $this->errors->add($i18n->get('error.db')); // TODO: review whether or not to add error here in all insert calls.
      return false;
    }

    $log_id = $mdb2->lastInsertID('tt_log', 'id');
    return $log_id;
  }

  // insertCustomFieldLogEntry - a helper function to insert a custom field log entry.
  private function insertCustomFieldLogEntry($fields) {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $org_id = (int) $fields['org_id'];
    $log_id = (int) $fields['log_id'];
    $field_id = (int) $fields['field_id'];
    $option_id = $fields['option_id'];
    $value = $fields['value'];
    $status = $fields['status'];

    $sql = "insert into tt_custom_field_log (group_id, org_id, log_id, field_id, option_id, value, status)".
      " values ($group_id, $org_id, $log_id, $field_id, ".$mdb2->quote($option_id).", ".$mdb2->quote($value).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // getTopRole returns top role id.
  private function getTopRole() {
    $mdb2 = getConnection();

    $sql = "select id from tt_roles where group_id = 0 and `rank` = ".MAX_RANK." and status = 1";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['id'])
        return $val['id'];
    }
    return false;
  }

  // The loginExists function detrmines if a login already exists.
  private function loginExists($login) {
    $mdb2 = getConnection();

    $sql = "select id from tt_users where login = ".$mdb2->quote($login)." and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      if ($val = $res->fetchRow()) {
        return true;
      }
    }
    return false;
  }

  // isDropdownCustomField is a helper function for remapReportSpecPart.
  // It deteremines if a custom field is of dropdown type.
  private function isDropdownCustomField($field_id) {
    global $user;
    $mdb2 = getConnection();

    $sql = "select type from tt_custom_fields where id = $field_id";
    $res = $mdb2->query($sql);
    $isDropdown = false;
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $isDropdown = $val['type'] == 2; // TYPE_DROPDOWN, see CustomFields.class.php.
        break;
      }
    }
    return $isDropdown;
  }

  // remapReportSpecPart is a helper function remapReportSpec below.
  // It remaps a single report spec part.
  private function remapReportSpecPart($report_spec_part, $prefix) {
    // Strip prefix.
    $remainder = substr($report_spec_part, strlen($prefix));
    // Find colon, which separates field id from its value.
    $pos = strpos($remainder, ':');
    $field_id = substr($remainder, 0, $pos);
    $field_value = substr($remainder, $pos + 1);
    $mapped_field_id = $this->currentGroupCustomFieldMap[$field_id];

    // Do we need to map option id?
    if (!ttStartsWith($prefix, 'show_') && $this->isDropdownCustomField($mapped_field_id)) {
      $mapped_field_value = $this->currentGroupCustomFieldOptionMap[$field_value];
    } else {
      $mapped_field_value = $field_value;
    }

    $mappedPart = $prefix.$mapped_field_id.':'.$mapped_field_value;
    return $mappedPart;
  }

  // remapReportSpec takes the source report spec as a parameter.
  // It remaps it with new custom field and option ids so that it can be used for import.
  private function remapReportSpec($report_spec) {
    $remappedSpec = null;
    $report_spec_parts = explode(',', $report_spec);
    foreach ($report_spec_parts as $report_spec_part) {
      if (ttStartsWith($report_spec_part, 'time_field_')) {
        $remappedSpec .= ','.$this->remapReportSpecPart($report_spec_part, 'time_field_');
      } elseif (ttStartsWith($report_spec_part, 'show_time_field_')) {
        $remappedSpec .= ','.$this->remapReportSpecPart($report_spec_part, 'show_time_field_');
      } elseif (ttStartsWith($report_spec_part, 'user_field_')) {
        $remappedSpec .= ','.$this->remapReportSpecPart($report_spec_part, 'user_field_');
      } elseif (ttStartsWith($report_spec_part, 'show_user_field_')) {
        $remappedSpec .= ','.$this->remapReportSpecPart($report_spec_part, 'show_user_field_');
      } else {
        // Use the part as is.
        $remappedSpec .= ','.$report_spec_part;
      }
    }
    // Trim comma from the beginning.
    $remappedSpec = ltrim($remappedSpec, ',');
    return $remappedSpec;
  }
}
