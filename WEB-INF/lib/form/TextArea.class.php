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
    var $mValue;
    var $mPassword	= false;
    var $mColumns	= "";
    var $mRows		= "";
    var $cClassName		= "TextArea";

	function TextArea($name,$value="")
	{
		$this->mName			= $name;
		$this->mValue			= $value;
	}
	
	function setColumns($value)	{ $this->mColumns = $value;	}
	function getColumns()	{ return $this->mColumns; }

	function setRows($value)	{ $this->mRows = $value;	}
	function getRows()	{ return $this->mRows; }
	
	function toStringControl()	{
		if (!$this->isRenderable()) return "";
	    
	    if ($this->mId=="") $this->mId = $this->mName;
	    
	    $js_maxlen = "";
	    
		$html = "\n\t<textarea";
		$html .= " name=\"$this->mName\" id=\"$this->mId\"";
		
		if ($this->mColumns!="")
		  $html .= " cols=\"$this->mColumns\"";
		  
		if ($this->mRows!="")
		   $html .= " rows=\"$this->mRows\"";
		   
		if ($this->mMaxLength!="") {
			if ($this->mOnKeyPress) $this->mOnKeyPress .= ";";
			$this->mOnKeyPress .= "return validateMaxLenght_".$this->mName."(this, event);";
			$js_maxlen = $this->getExtraScript();
			$html .= " maxlength=\"$this->mMaxLength\"";
		}

		if ($this->mStyle!="")
		   $html .= " style=\"$this->mStyle\"";

		if ($this->mOnKeyPress) {
			$html .= " onkeypress=\"$this->mOnKeyPress\"";
		}
			
		$html .= ">".htmlspecialchars($this->getValue())."</textarea>";
		if ($js_maxlen) $html = $js_maxlen."\n".$html;
		
		return $html;
	}
	
	function getExtraScript() {
		$s = "<script>\n";
		$s .= "var isNS4 = (navigator.appName==\"Netscape\")?1:0;\n";
		$s .= "function validateMaxLenght_".$this->mName."(element, event) {\n";
		$s .= "\tmaxlength=".$this->mMaxLength.";\n";
		$s .= "\tvar iKey = (!isNS4?event.keyCode:event.which);\n";
		//$s .= "alert(iKey);";
		$s .= "\tvar re = new RegExp(\"".'\r\n'."\",\"g\");\n";
		$s .= "\tvar x = element.value.replace(re,\"\").length;\n";
		$s .= "\tif ((x>=maxlength) && ((iKey > 31 && iKey < 1200) || (iKey > 95 && iKey < 106)) && (iKey != 13)) {\n";
		$s .= "\t\treturn false;\n";
		$s .= "\t} else {\n";
		$s .= "\t\treturn true;\n";
		$s .= "\t}\n}\n";
		$s .= "</script>\n";
		return $s;
	}
}
