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
// | https://www.anuko.com/time-tracker/credits.htm
// +----------------------------------------------------------------------+

import('ttConfigHelper');
import('ttGroupHelper');

// ttDebugTracer class is used to print debug messages when DEBUG constant is true.
// It does nothing otherwise.
class ttDebugTracer {
  var $debug = false;    // Do work only if true.
  var $file_name = null; // Source file name to print.

  // Constructor.
  function __construct($file_name = null) {
    if (isTrue('DEBUG')) $this->debug = true;
    $this->file_name = $file_name;
  }

  // prinln - prints a line.
  public function println($msg) {
    if ($this->debug) {
      echo "$this->file_name: $msg<br />";
    }
  }
}
