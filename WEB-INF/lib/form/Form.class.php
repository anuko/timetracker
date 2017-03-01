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

  var $name = '';
  var $elements = array();

  function __construct($formName) {
    $this->name = $formName;
  }

  function getElement($name) {
    return $this->elements[$name];
  }

  function getElements() {
    return $this->elements;
  }

  function getName() { return $this->name; }

  // addInput - adds an input object to the form.
  function addInput($arguments) {
    switch($arguments['type']) {
      case 'text':
        import('form.TextField');
        $el = new TextField($arguments['name']);
        $el->setMaxLength(@$arguments['maxlength']);
        break;

      case 'password':
        import('form.PasswordField');
        $el = new PasswordField($arguments['name']);
        $el->setMaxLength(@$arguments['maxlength']);
        break;

// TODO: refactoring ongoing down from here.
// Change $arguments to something better (maybe). $args or $params?
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
		}
		if ($el!=null) {
			$el->setFormName($this->name);
			if (isset($arguments["id"])) $el->setId($arguments["id"]);
			if (isset($GLOBALS["I18N"])) $el->localize($GLOBALS["I18N"]);
			if (isset($arguments["enable"])) $el->setEnabled($arguments["enable"]);
			
			if (isset($arguments["style"])) $el->setStyle($arguments["style"]);
			if (isset($arguments["size"])) $el->setSize($arguments["size"]);
			
			if (isset($arguments["label"])) $el->setLabel($arguments["label"]);
			if (isset($arguments["value"])) $el->setValue($arguments["value"]);
			
			if (isset($arguments["onchange"])) $el->setOnChange($arguments["onchange"]);
			if (isset($arguments["onclick"])) $el->setOnClick($arguments["onclick"]);
			
			$this->elements[$arguments["name"]] = &$el;
		}
	}
	
	function addInputElement(&$el) {
		if ($el && is_object($el)) {
			if (isset($GLOBALS["I18N"])) $el->localize($GLOBALS["I18N"]);
		
			$el->setFormName($this->name);
			$this->elements[$el->name] = &$el;
		}
	}
	
	
	function toStringOpenTag() {
        $html = "<form name=\"$this->name\"";
        
        $html .= ' method="post"';
        
        // Add enctype for file upload forms.
        foreach ($this->elements as $elname=>$el) {
            if (strtolower(get_class($this->elements[$elname])) == 'uploadfile') {
                $html .= ' enctype="multipart/form-data"';
                break;
            }
        }

        $html .= ">";
        return $html;
    }
    
    function toStringCloseTag() {
    	$html = "\n";
    	foreach ($this->elements as $elname=>$el) {
            if (strtolower(get_class($this->elements[$elname]))=="hidden") {
                $html .= $this->elements[$elname]->getHtml()."\n";
            }
        }
        $html .= "</form>";
        return $html;
    }
	
	function toArray() {
        $vars = array();
        $vars['open'] = $this->toStringOpenTag();
        $vars['close'] = $this->toStringCloseTag();
        
        foreach ($this->elements as $elname=>$el) {
            if (is_object($this->elements[$elname])) 
                $vars[$elname] = $this->elements[$elname]->toArray();
        }
//print_r($vars);
        return $vars;
    }
    
    function getValueByElement($elname) {
    	return $this->elements[$elname]->getValue();
    }
    
    function setValueByElement($elname, $value) {
    	if (isset($this->elements[$elname])) {
    		$this->elements[$elname]->setValue($value);
    	}
    }
}
