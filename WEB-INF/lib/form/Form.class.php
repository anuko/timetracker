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

// +----------------------------------------------------------------------+
// |
// | Class generates elements of specification HTML 4.01
// | http://www.w3.org/TR/1999/REC-html401-19991224
// |
// +----------------------------------------------------------------------+

class Form {
    var $formName      = "";
	var $mAction       = "";
	var $mMethod       = "post";
	var $mEnctype      = "";
	var $mId           = "";
    var $error;
	var $debugFunction;
	var $mElements     = array();
	var $mRequest;
//	var $mFormBean;
    
    function Form($formid) {
        $this->formName = $formid;
    }
    
    function setRequest(&$request) {
        $this->mRequest = &$request;
    }
    
/*    function setFormBean(&$bean) {
        $this->mFormBean = &$bean;
    }
*/    
    function &getElement($name) {
    	return $this->mElements[$name];
    }
    
    function &getElements() {
    	return $this->mElements;
    }
    
	//// FORM element
	// action
	// method - GET, POST
	// enctype - enctype="multipart/form-data"
	// name
	// onsubmit
	// onreset
	function setName($value) { $this->formName = $value; }
    function getName() { return $this->formName; }
    
    function setId($value) { $this->mId = $value; }
    function getId() { return $this->mId; }
    
    function setAction($value) { $this->mAction = $value; }
    function getAction() { return $this->mAction; }
    
    function setMethod($value) { $this->mMethod = $value; }
    function getMethod() { return $this->mMethod; }
    
    function setEnctype($value) { $this->mEnctype = $value; }
    function getEnctype() { return $this->mEnctype; }
    
    function isSubmit()	{
    	if (!isset($this->mRequest)) return false;
        $result = false;
	    foreach ($this->mElements as $el) {
	        if (strtolower(get_class($el))=="submit") {
	            $name = $el->getName();
	            $value = $this->mRequest->getAttribute($name);
	            if($value) {
	               $result = true; 
	            }
	        }
	    }
        return $result;
    }
	
	function OutputError($error,$scope="")
	{
		$this->error=(strcmp($scope,"") ? $scope.": ".$error : $error);
		if(strcmp($function=$this->debugFunction,"")
		&& strcmp($this->error,""))
			$function($this->error);
		return($this->error);
	}
	
	//// INPUT element
	// type = TEXT | PASSWORD | CHECKBOX | RADIO | SUBMIT | RESET | FILE | HIDDEN | IMAGE | BUTTON
	// name
	// value
	// checked - for type radio and checkbox
	// size - width pixels or chars
	// maxlength
	// src - for type image
	// tabindex - support  A, AREA, BUTTON, INPUT, OBJECT, SELECT, and TEXTAREA
	// accesskey - support A, AREA, BUTTON, INPUT, LABEL, and LEGEND, and TEXTAREA
	// onfocus
	// onblur
	// onselect -  INPUT and TEXTAREA
	// onchange
	function addInput($arguments) {
		if(strcmp(gettype($arguments),"array"))
			$this->OutputError("arguments must be array","AddInput");
			
		if(!isset($arguments["type"]) || !strcmp($arguments["type"],""))
			return($this->OutputError("Type not defined","AddInput"));
			
		if(!isset($arguments["name"]) || !strcmp($arguments["name"],""))
			return($this->OutputError("Name of element not defined","AddInput"));
			
		if (isset($this->mElements[$arguments["name"]]))
		    return($this->OutputError("it was specified '".$arguments["name"]."' name of an already defined input","AddInput"));
			
		switch($arguments["type"]) {
		    
			case "textfield":
			case "text":
			    import('form.TextField');
			    $el = new TextField($arguments["name"]);
			    $el->setMaxLength(@$arguments["maxlength"]);
			    if (isset($arguments["aspassword"])) $el->setAsPassword($arguments["aspassword"]);
			    break;
			    
			case "datefield":
			    import('form.DateField');
			    $el = new DateField($arguments["name"]);
				$el->setMaxLength("10");
			    break;
			    
			case "floatfield":
			    import('form.FloatField');
			    $el = new FloatField($arguments["name"]);
			    if (isset($arguments["format"])) $el->setFormat($arguments["format"]);
			    break;
			    
			case "textarea":
			    import('form.TextArea');
			    $el = new TextArea($arguments["name"]);
			    $el->setColumns(@$arguments["cols"]);
			    $el->setRows(@$arguments["rows"]);
			    if (isset($arguments["maxlength"])) $el->setMaxLength($arguments["maxlength"]);
			    break;
			    
			case "checkbox":
			    import('form.Checkbox');
			    $el = new Checkbox($arguments["name"]);
			    if (@$arguments["checked"]) $el->setChecked(true);
			    $el->setData(@$arguments["data"]);
			    break;
			    
			case "checkboxgroup":
			    import('form.CheckboxGroup');
			    $el = new CheckboxGroup($arguments["name"]);
			    if (isset($arguments["layout"])) $el->setLayout($arguments["layout"]);
			    if (isset($arguments["groupin"])) $el->setGroupIn($arguments["groupin"]);
			    if (isset($arguments["datakeys"])) $el->setDataKeys($arguments["datakeys"]);
			    $el->setData(@$arguments["data"]);
			    break;
			    
			case "combobox":
			    import('form.Combobox');
			    $el = new Combobox($arguments["name"]);
			    $el->setData(@$arguments["data"]);
			    $el->setDataDefault(@$arguments["empty"]);
			    if (isset($arguments["datakeys"])) $el->setDataKeys($arguments["datakeys"]);
			    break;
			    
			case "hidden":
			    import('form.Hidden');
			    $el = new Hidden($arguments["name"]);
			    break;
			 
			case "submit":
			    import('form.Submit');
			    $el = new Submit($arguments["name"]);
			    break;
			    
			case "calendar":
			    import('form.Calendar');
			    $el = new Calendar($arguments["name"]);
			    $el->setHighlight(@$arguments["highlight"]);
			    break;  
			    
			case "table":
			    import('form.Table');
			    $el = new Table($arguments["name"]);
			    $el->setData(@$arguments["data"]);
			    $el->setWidth(@$arguments["width"]);
			    break;
			    
			case "upload":
			    import('form.UploadFile');
			    $el = new UploadFile($arguments["name"]);
			    if (isset($arguments["maxsize"])) $el->setMaxSize($arguments["maxsize"]);
			    break;
			      
			default:
				return($this->OutputError("Type not found for input element","AddInput"));
		}
		if ($el!=null) {
			$el->setFormName($this->formName);
			if (isset($arguments["id"])) $el->setId($arguments["id"]);
			if (isset($GLOBALS["I18N"])) $el->setLocalization($GLOBALS["I18N"]);
			if (isset($arguments["render"])) $el->setRenderable($arguments["render"]);
			if (isset($arguments["enable"])) $el->setEnable($arguments["enable"]);
			
			if (isset($arguments["style"])) $el->setStyle($arguments["style"]);
			if (isset($arguments["size"])) $el->setSize($arguments["size"]);
			
			if (isset($arguments["label"])) $el->setLabel($arguments["label"]);
			if (isset($arguments["value"])) $el->setValue($arguments["value"]);
			
			if (isset($arguments["onchange"])) $el->setOnChange($arguments["onchange"]);
			if (isset($arguments["onclick"])) $el->setOnClick($arguments["onclick"]);
			
			$this->mElements[$arguments["name"]] = &$el;
		}
	}
	
	function addInputElement(&$el) {
		if ($el && is_object($el)) {
			if (!$el->getName())
			    return($this->OutputError("no name in element","addInputElement"));
			    
			if (isset($GLOBALS["I18N"])) $el->setLocalization($GLOBALS["I18N"]);
		
			$el->setFormName($this->formName);
			$this->mElements[$el->getName()] = &$el;
		}
	}
	
	
	function toStringOpenTag() {
        $html = "<form name=\"$this->formName\"";
        
        if ($this->mId!="") 
            $html .= " id=\"$this->mId\"";
            
        if ($this->mAction!="") 
            $html .= " action=\"$this->mAction\"";
        
        if ($this->mMethod!="") 
            $html .= " method=\"$this->mMethod\"";
        
        // for upload forms
        foreach ($this->mElements as $elname=>$el) {
            if (strtolower(get_class($this->mElements[$elname]))=="uploadfile") {
            	$this->mEnctype = "multipart/form-data";
            }
        }
        
        if ($this->mEnctype!="")
        	$html .= " enctype=\"$this->mEnctype\"";
        
        $html .= ">";
        return $html;
    }
    
    function toStringCloseTag() {
    	$html = "\n";
    	foreach ($this->mElements as $elname=>$el) {
            if (strtolower(get_class($this->mElements[$elname]))=="hidden") {
            	$html .= $this->mElements[$elname]->toStringControl()."\n";
            }
        }
        $html .= "</form>";
        return $html;
    }
	
	function toArray() {
        $vars = array();
        $vars['open'] = $this->toStringOpenTag();
        $vars['close'] = $this->toStringCloseTag();
        
        foreach ($this->mElements as $elname=>$el) {
            if (is_object($this->mElements[$elname])) 
                $vars[$elname] = $this->mElements[$elname]->toArray();
        }
//print_r($vars);
        return $vars;
    }
    
    function getValueByElement($elname) {
    	return $this->mElements[$elname]->getValue();
    }
    
    function setValueByElement($elname, $value) {
    	if (isset($this->mElements[$elname])) {
    		$this->mElements[$elname]->setValue($value);
    	}
    }
}
