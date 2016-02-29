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
	
//  name        CDATA          #IMPLIED  -- field name --
//  size        NUMBER         #IMPLIED  -- rows visible --
//  multiple    (multiple)     #IMPLIED  -- default is single selection --
//  disabled    (disabled)     #IMPLIED  -- unavailable in this context --
//  tabindex    NUMBER         #IMPLIED  -- position in tabbing order --
//  onfocus     %Script;       #IMPLIED  -- the element got the focus --
//  onblur      %Script;       #IMPLIED  -- the element lost the focus --
//  onchange    %Script;       #IMPLIED  -- the element value was changed --

class Combobox extends FormElement {
    var $mMultiple	= false;
    var $mOptions	= array();
    var $mOptionsEmpty	= array();
    var $mCompareOn = "key"; // or "value"
    var $mDataDeep = 1;
    var $mDataKeys = array();
    var $cClassName	= "Combobox";

	function Combobox($name,$value="")
	{
		$this->mName			= $name;
		$this->mValue			= $value;
	}

	function setMultiple($value)	{ $this->mMultiple = $value; }
	function isMultiple() { return $this->mMultiple; }
	
	function setData($value)	{ $this->mOptions = $value; }
	function getData() { return $this->mOptions; }
	
	function setDataDefault($value)	{ $this->mOptionsEmpty = $value; }
	function getDataDefault() { return $this->mOptionsEmpty; }
	
	function setDataKeys($keys)	{ $this->mDataKeys = $keys; $this->mDataDeep = 2; }
	function getDataKeys() { return $this->mDataKeys; }
	
	
	function toStringControl()	{
		if (!$this->isRenderable()) return "";
	    
	    if ($this->mId=="") $this->mId = $this->mName;
	    
		$html = "\n\t<select";
		$html .= " name=\"$this->mName\" id=\"$this->mId\"";
		
		if ($this->mSize!="")
		  $html .= " size=\"$this->mSize\"";
		 
		if ($this->mMultiple)
		  $html .= " multiple";
		  
		if ($this->mTabindex!="")
		   $html .= " tabindex=\"$this->mTabindex\"";
		   
		if ($this->mOnChange!="")
		   $html .= " onchange=\"$this->mOnChange\"";
		   
		if ($this->mStyle!="")
		   $html .= " style=\"$this->mStyle\"";
		   
		$html .= ">\n";   
		if (is_array($this->mOptionsEmpty) && (count($this->mOptionsEmpty) > 0))
		foreach ($this->mOptionsEmpty as $key=>$value) {
			$html .= "<option value=\"".$key."\"";
			if (($this->mValue == $value) && ($this->mValue != '')) $html .= " selected";
			$html .= ">".$value."</option>\n";
		}
		if (is_array($this->mOptions) && (count($this->mOptions) > 0))
		foreach ($this->mOptions as $key=>$value) {

			if ($this->mDataDeep>1) {
				$key = $value[$this->mDataKeys[0]];
				$value = $value[$this->mDataKeys[1]];
			}
			$html .= "<option value=\"".$key."\"";
			if (($this->mValue == $key) && ($this->mValue != '')) $html .= " selected";
			$html .= ">".htmlspecialchars($value)."</option>\n";
		}
		
		$html .= "</select>";
		
		return $html;
	}
}
?>