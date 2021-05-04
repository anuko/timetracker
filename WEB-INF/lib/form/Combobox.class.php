<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

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
    $this->css_class = 'dropdown-field';
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
                $html .= " class=\"$this->css_class\"";
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
