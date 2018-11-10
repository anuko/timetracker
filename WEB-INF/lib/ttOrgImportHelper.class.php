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

import('ttUserHelper');
import('ttRoleHelper');

// ttOrgImportHelper - this class is a future replacement for ttImportHelper.
// Currently, it is work in progress.
// When done, it should handle import of complex groups consisting of other groups.
class ttOrgImportHelper {
  var $errors               = null; // Errors go here. Set in constructor by reference.
  var $conflicting_entities = null; // A comma-separated list of entity names we cannot import.
  var $canImport      = true;    // False if we cannot import data due to a conflict such as login collision.
  var $firstPass      = true;    // True during first pass through the file.
  var $org_id         = null;    // Organization id (same as top group_id).
  var $current_group_id        = null; // Current group id during parsing.
  var $current_parent_group_id = null; // Current parent group id during parsing.
                                       // Set when we create a new group.
  // Entities for current group. -- Looks like they are not needed as we insert right away...
  // var $currentGroupRoles = array(); // Array of arrays of role properties.
  // var $currentGroupUsers = array(); // Array of arrays of user properties.

  // Entity maps for current group. They map XML ids with database ids.
  var $currentGroupRoleMap = array(); // Maps role ids from XML to their database ids.
  //var $userMap       = array(); // User ids.
  //var $projectMap    = array(); // Project ids.
  //var $taskMap       = array(); // Task ids.
  //var $clientMap     = array(); // Client ids.
  //var $invoiceMap    = array(); // Invoice ids.

  // Constructor.
  function __construct(&$errors) {
    $this->errors = &$errors;
  }

  // startElement - callback handler for opening tag of an XML element in the file.
  function startElement($parser, $name, $attrs) {

    // First pass. We only check user logins for potential collisions with existing.
    if ($this->firstPass) {
      if ($name == 'USER' && $this->canImport) {
        $login = $attrs['LOGIN'];
        if ('' != $attrs['STATUS'] && ttUserHelper::getUserByLogin($login)) {
          // We have a login collision. Append colliding login to a list of things we cannot import.
          $this->conflicting_entities .= ($this->conflicting_entities ? ", $login" : $login);
        }
      }
    }

    // Second pass processing. We import data here, one tag at a time.
    if (!$this->firstPass && $this->canImport) {
      $mdb2 = getConnection();

      // We are in second pass and can import data.
      if ($name == 'GROUP') {
        // Create a new group.
        $this->current_group_id = $this->createGroup(array(
          'parent_id' => $this->current_parent_group_id,
          'org_id' => $this->org_id,
          'name' => $attrs['NAME'],
          'currency' => $attrs['CURRENCY'],
          'lang' => $attrs['LANG']));
        // We only have 3 properties at the moment, while work is ongoing...

        // Special handling for top group.
        if (!$this->org_id) {
          $this->org_id = $this->current_group_id;
          $sql = "update tt_groups set org_id = $this->current_group_id where org_id is NULL and id = $this->current_group_id";
          $affected = $mdb2->exec($sql);
          // TODO: design a better error handling approach for the entire import process.
        }
        // Set current parent group.
        $this->current_parent_group_id = $this->current_group_id;
      }

      if ($name == 'ROLES') {
        // If we get here, we have to recycle both $currentGroupRoles and $currentGroupRoleMap.
        unset($this->currentGroupRoles);
        unset($this->currentGroupRoleMap);
        $this->currentGroupRoles = array();
        $this->currentGroupRoleMap = array();
        // Both arrays are now empty.
        // They will get reconstructed after processing of <role> elements in XML. See below.
      }

      if ($name == 'ROLE') {
        // We get here when processing a <role> tag for the current group.
        $role_id = ttRoleHelper::insert(array(
              'group_id' => $this->current_group_id,
              'org_id' => $this->org_id,
              'name' => $attrs['NAME'],
              'description' => $attrs['DESCRIPTION'],
              'rank' => $attrs['RANK'],
              'rights' => $attrs['RIGHTS'],
              'status' => $attrs['STATUS']));
        // Add a mapping.
        $this->currentGroupRoleMap[$attrs['ID']] = $role_id;
      }
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
    xml_set_element_handler($parser, 'startElement', false);

    // We need to parse the file 2 times:
    //   1) First pass: determine if import is possible - there must be no login collisions.
    //   2) Second pass: if we can import, then do import in a second pass.
    // This is different from earlier approach for single group import, where we could
    // do both things in one pass because user info was in the beginning of XML file.
    // Now, with subgroups, users can be located anywhere in the file.

    // Read and parse the content of the file. During parsing, startElement, endElement, and dataElement functions are called.
    $file = fopen($filename, 'r');
    while ($data = fread($file, 4096)) {
      if (!xml_parse($parser, $data, feof($file))) {
        $this->errors->add(sprintf($i18n->get('error.xml'),
          xml_get_current_line_number($parser),
          xml_error_string(xml_get_error_code($parser))));
      }
    }
    if ($this->conflicting_entities) {
      $this->canImport = false;
      $this->errors->add($i18n->get('error.user_exists'));
      $this->errors->add(sprintf($i18n->get('error.cannot_import'), $this->conflicting_entities));
    }

    $this->firstPass = false; // We are done with 1st pass.
    xml_parser_free($parser);
    if ($file) fclose($file);
    if (!$this->canImport) {
      unlink($filename);
      return;
    }

    // Now we can do a second pass, where real work is done.
    $parser = xml_parser_create();
    xml_set_object($parser, $this);
    xml_set_element_handler($parser, 'startElement', false);

    // Read and parse the content of the file. During parsing, startElement, endElement, and dataElement functions are called.
    $file = fopen($filename, 'r');
    while ($data = fread($file, 4096)) {
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
    $mdb2 = getConnection();

    $columns = '(parent_id, org_id, name, currency, lang)';

//    $columns = '(name, currency, decimal_mark, lang, date_format, time_format, week_start, tracking_mode'.
//      ', project_required, task_required, record_type, bcc_email, allow_ip, password_complexity, plugins'.
//      ', lock_spec, workday_minutes, config, created, created_ip, created_by)';

    $values = ' values (';
    $values .= $mdb2->quote($fields['parent_id']);
    $values .= ', '.$mdb2->quote($fields['org_id']);
    $values .= ', '.$mdb2->quote(trim($fields['name']));
    $values .= ', '.$mdb2->quote(trim($fields['currency']));
    //$values .= ', '.$mdb2->quote($fields['decimal_mark']);
    $values .= ', '.$mdb2->quote($fields['lang']);
/*
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
    $values .= ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$mdb2->quote($user->id); */
    $values .= ')';

    $sql = 'insert into tt_groups '.$columns.$values;
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) return false;

    $group_id = $mdb2->lastInsertID('tt_groups', 'id');
    return $group_id;
  }
}
