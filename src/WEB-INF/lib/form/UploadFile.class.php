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

import('form.FormElement');
	
class UploadFile extends FormElement {

  var $maxSize = 8388608; // 8MB default max size.

  function __construct($name)
  {
    $this->class = 'UploadFile';
    $this->name = $name;
  }

  function setMaxSize($value) { $this->maxSize = $value; }

  function getHtml() {

    if ($this->id == '') $this->id = $this->name;

    $html = "\n\t<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$this->maxSize\">";
    $html .= "\n\t<input type=\"file\" id=\"$this->id\" name=\"$this->name\">";
    return $html;
  }
}
