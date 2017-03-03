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
    var $mMaxSize		= 100000;	// 100kb // TODO: refactor this.

  function __construct($name)
  {
    $this->class = 'UploadFile';
    $this->name = $name;
  }

// TODO: refactoring ongoing down from here.
	function setMaxSize($value)	{ $this->mMaxSize = $value;	}
	function getMaxSize()	{ return $this->mMaxSize; }
	
	function getHtml() {

            if ($this->id=="") $this->id = $this->name;
	    
		$html = "\n\t<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"".$this->mMaxSize."\"/>";
		$html .= "\n\t<input";
		$html .= " name=\"$this->name\" id=\"$this->id\"";
		
		$html .= " type=\"file\"";
		$html .= ">";

                return $html;
	}
}
