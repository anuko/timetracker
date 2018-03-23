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

class CheckboxGroup extends FormElement {
    var $mChecked	= false;
    var $mOptions	= array();
    var $mLayout	= "V";
    var $mGroupIn	= 1;
    var $mDataKeys	= array();
    var $mDataDeep	= 1;
    var $lSelAll	= "All";
    var $lSelNone	= "None";

  function __construct($name) {
    $this->class = 'CheckboxGroup';
    $this->name = $name;
  }

	function setChecked($value)	{ $this->mChecked = $value; }
	function isChecked() { return $this->mChecked; }
	
	function setData($value)	{ $this->mOptions = $value; }
	function getData() { return $this->mOptions; }
	
	function setDataKeys($keys)	{ $this->mDataKeys = $keys; $this->mDataDeep = 2; }
	function getDataKeys() { return $this->mDataKeys; }
	
	function setLayout($value)	{ $this->mLayout = $value; }
	function getLayout() { return $this->mLayout; }
	
	function setGroupIn($value)	{ $this->mGroupIn = $value; if ($this->mGroupIn<1) $this->mGroupIn = 1;}
	function getGroupIn() { return $this->mGroupIn; }
	
	function localize() {
          global $i18n;
          $this->lSelAll = $i18n->get('label.select_all');
          $this->lSelNone = $i18n->get('label.select_none');
	}
		
	function getHtml() {

	    if ($this->id=="") $this->id = $this->name;
	    
	    $renderArray = array();
	    $renderCols = 0;
	    $renderRows = 0;
	    
	    if ($this->mLayout=="H") {
	    	$i = 0;
	    	if (is_array($this->mOptions)) {
	    		$renderCols = $this->mGroupIn;
	    		$renderRows = ceil(count($this->mOptions) / $this->mGroupIn);
	    		$col = $row = 0;
			    foreach ($this->mOptions as $optkey=>$optval) {
			    	if ($this->mDataDeep>1) {
						$optkey = $optval[$this->mDataKeys[0]];
						$optval = $optval[$this->mDataKeys[1]];
					}
			    	$html = "<input type=\"checkbox\" name=\"$this->name[]\" id=\"$this->id"."_".$i."\"";
			    	if (is_array($this->value)) {
			    		foreach ($this->value as $element) {
			    			if (($element == $optkey) && ($element != null))
			    				$html .= " checked=\"true\"";
			    		}
			    	}
				   	$html .= " value=\"".htmlspecialchars($optkey)."\">&nbsp;<label for=\"$this->id"."_".$i."\">".htmlspecialchars($optval)."</label>";
				   	$renderArray[$col][$row] = $html;
				   	
			    	$col++;			    	
				   	if ($col==$this->mGroupIn) { $col = 0; $row++; }
			    	$i++;
			    }
	    	}
	    }
	    
	    if ($this->mLayout=="V") {
			$i = 0;
	    	if (is_array($this->mOptions)) {
	    		$renderCols = ceil(count($this->mOptions) / $this->mGroupIn);
	    		$renderRows = $this->mGroupIn;
	    		$col = $row = 0;
			    foreach ($this->mOptions as $optkey=>$optval) {
			    	if ($this->mDataDeep>1) {
						$optkey = $optval[$this->mDataKeys[0]];
						$optval = $optval[$this->mDataKeys[1]];
					}
			    	$html = "<input type=\"checkbox\" name=\"$this->name[]\" id=\"$this->id"."_".$i."\"";
			    	if (is_array($this->value)) {
			    		foreach ($this->value as $element) {
			    			if (($element == $optkey) && ($element != null))
			    				$html .= " checked=\"true\"";
			    		}
			    	}
				   	$html .= " value=\"".htmlspecialchars($optkey)."\">&nbsp;<label for=\"$this->id"."_".$i."\">".htmlspecialchars($optval)."</label>";
				   	$renderArray[$col][$row] = $html;

				   	$row++;
			    	if ($row==$this->mGroupIn) { $row = 0; $col++; }
		    		$i++;
			    }
	    	}
	    }
	    
	    
	    $html = "\n\t<table style=\"".$this->style."\"><tr><td align=\"center\" bgcolor=\"eeeeee\">\n";
	    $html .= '<a href="#" onclick="setAll'.$this->name.'(true);return false;">'.$this->lSelAll.'</a>&nbsp;/&nbsp;<a href="#" onclick="setAll'.$this->name.'(false);return false;">'.$this->lSelNone.'</a>';
	    $html .= "</td></tr>\n";
	    $html .= "<tr><td>";
	    $html .= "\n\t<table width=\"100%\">\n";
	    for ($i = 0; $i < $renderRows; $i++) {
	    	$html .= "<tr>";
	    	for ($j = 0; $j < $renderCols; $j++) {
    			$html .= "\t<td width=\"".(floor(100/$renderCols))."%\">".(isset($renderArray[$j][$i])?$renderArray[$j][$i]:"&nbsp;")."</td>\n";
	    	}
	    	$html .= "</tr>\n";
	    }
	    $html .= "</table>\n";
	    $html .= "</td></tr></table>\n";
	    
	    $str = "<script>\n";
		$str .= "function setAll".$this->name."(value) {\n";
		$str .= "\tvar formInputs = document.getElementsByTagName(\"input\");\n";
		$str .= "\tfor (var i = 0; i < formInputs.length; i++) {\n";
        $str .= "\t\tif ((formInputs.item(i).type=='checkbox') && (formInputs.item(i).name=='".$this->name."[]')) {\n";
        $str .= "\t\tformInputs.item(i).checked=value;\n";
        $str .= "\t}\n}\n";
		$str .= "}\n";
		$str .= "</script>\n";
	    
		return $html.$str;
	}
}
