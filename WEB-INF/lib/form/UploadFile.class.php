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
    var $mValue;
    var $cClassName		= "UploadFile";
    var $mMaxSize		= 100000;	// 100kb

	function UploadFile($name,$value="")
	{
		$this->mName			= $name;
		$this->mValue			= $value;
	}
	
	function setMaxSize($value)	{ $this->mMaxSize = $value;	}
	function getMaxSize()	{ return $this->mMaxSize; }
	
	function toStringControl()	{
		if (!$this->isRenderable()) return "";
	    
	    if ($this->mId=="") $this->mId = $this->mName;
	    
		$html = "\n\t<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"".$this->mMaxSize."\"/>";
		$html .= "\n\t<input";
		$html .= " name=\"$this->mName\" id=\"$this->mId\"";
		
		$html .= " type=\"file\"";
		$html .= ">";
		
		// only IE
		/*$html = "<input type=\"file\" name=\"".$this->mName."\" id=\"".$this->mId."\" style=\"display: none;\">\n";
		$html .= "<input type=\"text\" name=\"".$this->mName."file\">\n";
		$html .= "<input type=\"button\" 
			style=\"text-align:center;\" onClick=\"".$this->mName.".click();".$this->mName."file.value=".$this->mName.".value;".$this->mName.".disabled=true;\"";
		$html .= " value=\"".$this->getValue()."\">\n";
		$html .= "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"".$this->mMaxSize."\"/>";*/
		
		
		return $html;
	}
}
?>