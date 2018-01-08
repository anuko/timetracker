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
	
class TextArea extends FormElement {
    var $mOnKeyPress	= "";

  function __construct($name)
  {
    $this->class = 'TextArea';
    $this->name = $name;
  }

	function getHtml() {
    
	    if (empty($this->id))
                $this->id = $this->name;
	    
		$html = "\n\t<textarea";
		$html .= " name=\"$this->name\" id=\"$this->id\"";

		if ($this->max_length!="") {
			if ($this->mOnKeyPress) $this->mOnKeyPress .= ";";
			$this->mOnKeyPress .= "return validateMaxLenght_".$this->name."(this, event);";
			$html .= " maxlength=\"$this->max_length\"";
		}

		if ($this->style!="")
		   $html .= " style=\"$this->style\"";

		if ($this->mOnKeyPress) {
			$html .= " onkeypress=\"$this->mOnKeyPress\"";
		}
			
		$html .= ">".htmlspecialchars($this->getValue())."</textarea>";
		
		return $html;
	}
}
