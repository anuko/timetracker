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

  function __construct($name) {
    $this->class = 'Combobox';
    $this->name = $name;
  }

	function setMultiple($value)	{ $this->mMultiple = $value; }
	function isMultiple() { return $this->mMultiple; }
	
	function setData($value)	{ $this->mOptions = $value; }
	function getData() { return $this->mOptions; }
	
	function setDataDefault($value)	{ $this->mOptionsEmpty = $value; }
	function getDataDefault() { return $this->mOptionsEmpty; }
	
	function setDataKeys($keys)	{ $this->mDataKeys = $keys; $this->mDataDeep = 2; }
	function getDataKeys() { return $this->mDataKeys; }
	
	
	function getHtml() {

	    if ($this->id=="") $this->id = $this->name;
	    
		$html = "\n\t<select";
		$html .= " name=\"$this->name\" id=\"$this->id\"";
		
		if ($this->size!="")
		  $html .= " size=\"$this->size\"";
		 
		if ($this->mMultiple)
		  $html .= " multiple";

		if ($this->on_change!="")
		   $html .= " onchange=\"$this->on_change\"";
		   
		if ($this->style!="")
		   $html .= " style=\"$this->style\"";
                
                if (!$this->isEnabled())
		   $html .= " disabled";
		   
		$html .= ">\n";   
		if (is_array($this->mOptionsEmpty) && (count($this->mOptionsEmpty) > 0))
		foreach ($this->mOptionsEmpty as $key=>$value) {
			$html .= "<option value=\"".$key."\"";
			if (($this->value == $value) && ($this->value != '')) $html .= " selected";
			$html .= ">".$value."</option>\n";
		}
		if (is_array($this->mOptions) && (count($this->mOptions) > 0))
		foreach ($this->mOptions as $key=>$value) {

			if ($this->mDataDeep>1) {
				$key = $value[$this->mDataKeys[0]];
				$value = $value[$this->mDataKeys[1]];
			}
			$html .= "<option value=\"".$key."\"";
			if (($this->value == $key) && ($this->value != '')) $html .= " selected";
			$html .= ">".htmlspecialchars($value)."</option>\n";
		}
		
		$html .= "</select>";
		
		return $html;
	}
}
