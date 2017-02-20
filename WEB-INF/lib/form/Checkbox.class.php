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

class Checkbox extends FormElement {
    var $mChecked	= false;
    var $mOptions	= null;
    var $cClassName		= "Checkbox";

	function __construct($name,$value="")
	{
		$this->name = $name;
		$this->value = $value;
	}

	function setChecked($value)	{ $this->mChecked = $value; }
	function isChecked() { return $this->mChecked; }
	
	function setData($value)	{ $this->mOptions = $value; }
	function getData() { return $this->mOptions; }
	
	function toStringControl()	{
		if (!$this->isRenderable()) return "";
	    
	    if ($this->id=="") $this->id = $this->name;
	    
		$html = "\n\t<input type=\"checkbox\"";
		$html .= " name=\"$this->name\" id=\"$this->id\"";

		if ($this->mOnChange!="")
		   $html .= " onchange=\"$this->mOnChange\"";
		   
		if ($this->mStyle!="")
		   $html .= " style=\"$this->mStyle\"";

		if ($this->mChecked || (($this->value == $this->mOptions) && ($this->value != null)))
		   $html .= " checked=\"true\"";
		   
		if (!$this->isEnable())
		   $html .= " disabled=\"disabled\"";
		   
		$html .= " value=\"".htmlspecialchars($this->mOptions)."\"";
		
		$html .= "/>\n";   
		
		return $html;
	}
}
