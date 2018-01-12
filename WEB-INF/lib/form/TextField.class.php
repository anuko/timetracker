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

class TextField extends FormElement {

  var $title = null; // Control title (ex: to display a tooltip).

  function __construct($name)
  {
    $this->class = 'TextField';
    $this->name = $name;
  }

  function setTitle($title) { $this->title = $title; }

  function getHtml() {
    if (empty($this->id)) $this->id = $this->name;
    $html = "\n\t<input type=\"text\"";
    $html .= " id=\"$this->id\" name=\"$this->name\"";
    if (!empty($this->size)) $html .= " size=\"$this->size\"";
    if (!empty($this->style)) $html .= " style=\"$this->style\"";
    if (!empty($this->title)) $html .= " title=\"$this->title\"";

    if($this->isEnabled()) {
      if (!empty($this->max_length)) $html .= " maxlength=\"$this->max_length\"";
      if (!empty($this->on_change)) $html .= " onchange=\"$this->on_change\"";
    }

    $html .= " value=\"".htmlspecialchars($this->getValue())."\"";

    if(!$this->isEnabled()) $html .= " readonly";
    $html .= ">\n";
    return $html;
  }
}
