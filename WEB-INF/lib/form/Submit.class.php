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
	
class Submit extends FormElement {
	var $cClassName	= "Submit";

	function Submit($name,$value="")
	{
		$this->mName			= $name;
		$this->mValue			= $value;
	}

	function toStringControl()	{
		if (!$this->isRenderable()) return "";
	    
	    if ($this->mId=="") $this->mId = $this->mName;
	    
		$html = "\n\t<input";
		$html .= " type=\"submit\" name=\"$this->mName\" id=\"$this->mId\"";
		
		if (!$this->isEnable()) {
			$html .= " disabled=\"true\"";
		}
		
		$html .= " value=\"$this->mValue\"";
		
		if ($this->mOnClick) {
			$html .= " onclick=\"".$this->mOnClick."\"";
		}
		
		$html .= ">";
		
		return $html;
	}
}
