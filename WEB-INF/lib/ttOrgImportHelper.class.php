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

// ttOrgImportHelper - this class is a future replacement for ttImportHelper.
// Currently, it is work in progress.
// When done, it should handle import of complex groups consisting of other groups.
class ttOrgImportHelper {
  var $errors         = null;    // Errors go here. Set in constructor by reference.

  var $currentElement = array(); // Current element of the XML file we are parsing.
  var $currentTag     = '';      // XML tag of the current element.

  var $canImport      = true;    // False if we cannot import data due to a login collision.
  var $firstPass      = true;    // True during first pass through the file.

  // Constructor.
  function __construct(&$errors) {
    $this->errors = &$errors;
  }

  // startElement - callback handler for opening tag of an XML element.
  // In this function we assign passed in attributes to currentElement.
  function startElement($parser, $name, $attrs) {
    if ($name == 'GROUP'
      || $name == 'USER') {
      $this->currentElement = $attrs;
    }
    $this->currentTag = $name;
  }

  // endElement - callback handler for the closing tag of an XML element.
  // When we are here, currentElement is an array of the element attributes (as set in startElement).
  // Here we do the actual import of data into the database.
  function endElement($parser, $name) {
    // During first pass we only check user logins.
    if ($this->firstPass) {
      if ($name == 'USER' && $this->canImport) {
        if ('' != $this->currentElement['STATUS'] && ttUserHelper::getUserByLogin($this->currentElement['LOGIN'])) {
          // We have a login collision, cannot import any data.
          $this->canImport = false;
        }
      }
      $this->currentTag = '';
    }

    // During second pass we import data.
    if (!$this->firstPass && $this->canImport) {
      // TODO: write code here. Nothing is imported currently.
    }
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
        $this->errors->add(sprintf("XML error: %s at line %d",
          xml_error_string(xml_get_error_code($parser)),
          xml_get_current_line_number($parser)));
      }
      if (!$this->canImport) {
        $this->errors->add($i18n->get('error.user_exists'));
        break;
      }
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
}
