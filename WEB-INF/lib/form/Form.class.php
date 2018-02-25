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

// Form class is a container for HTML forms we use in the application.
// It contains an array of $elements - which are individual input controls
// belonging to a form.
class Form {
  var $name = '';          // Form name.
  var $elements = array(); // An array of input controls in form.

  function __construct($name) {
    $this->name = $name;
  }

  function getElement($name) {
    return $this->elements[$name];
  }

  function getElements() {
    return $this->elements;
  }

  function getName() { return $this->name; }

  // addInput - adds an input object to the form.
  function addInput($params) {
    switch($params['type']) {
      case 'text':
        import('form.TextField');
        $el = new TextField($params['name']);
        if (isset($params['maxlength'])) $el->setMaxLength($params['maxlength']);
        break;

      case 'password':
        import('form.PasswordField');
        $el = new PasswordField($params['name']);
        if (isset($params['maxlength'])) $el->setMaxLength($params['maxlength']);
        break;

      case 'datefield':
        import('form.DateField');
        $el = new DateField($params['name']);
        $el->setMaxLength('10');
        break;

      case 'floatfield':
        import('form.FloatField');
        $el = new FloatField($params['name']);
        if (isset($params['format'])) $el->setFormat($params['format']);
        break;

      case 'textarea':
        import('form.TextArea');
        $el = new TextArea($params['name']);
        if (isset($params['maxlength'])) $el->setMaxLength($params['maxlength']);
        break;

      case 'checkbox':
        import('form.Checkbox');
        $el = new Checkbox($params['name']);
        break;

      case 'hidden':
        import('form.Hidden');
        $el = new Hidden($params['name']);
        break;

      case 'submit':
        import('form.Submit');
        $el = new Submit($params['name']);
        break;

// TODO: refactoring ongoing down from here.
			case "checkboxgroup":
			    import('form.CheckboxGroup');
			    $el = new CheckboxGroup($params["name"]);
			    if (isset($params["layout"])) $el->setLayout($params["layout"]);
			    if (isset($params["groupin"])) $el->setGroupIn($params["groupin"]);
			    if (isset($params["datakeys"])) $el->setDataKeys($params["datakeys"]);
			    $el->setData(@$params["data"]);
			    break;
			    
			case "combobox":
			    import('form.Combobox');
			    $el = new Combobox($params["name"]);
			    $el->setData(@$params["data"]);
			    $el->setDataDefault(@$params["empty"]);
                            if (isset($params["multiple"])) {
                              $el->setMultiple($params["multiple"]);
                              $el->name .= '[]'; // Add brackets to the end of name to get back an array on POST.
                            }
			    if (isset($params["datakeys"])) $el->setDataKeys($params["datakeys"]);
			    break;

			case "calendar":
			    import('form.Calendar');
			    $el = new Calendar($params["name"]);
			    $el->setHighlight(@$params["highlight"]);
			    break;  
			    
			case "table":
			    import('form.Table');
			    $el = new Table($params["name"]);
			    $el->setData(@$params["data"]);
			    $el->setWidth(@$params["width"]);
			    break;
			    
			case "upload":
			    import('form.UploadFile');
			    $el = new UploadFile($params["name"]);
			    if (isset($params["maxsize"])) $el->setMaxSize($params["maxsize"]);
			    break;
		}
		if ($el!=null) {
			$el->setFormName($this->name);
			if (isset($params["id"])) $el->setId($params["id"]);
			$el->localize();
			if (isset($params["enable"])) $el->setEnabled($params["enable"]);
			
			if (isset($params["style"])) $el->setStyle($params["style"]);
			if (isset($params["size"])) $el->setSize($params["size"]);
			
			if (isset($params["label"])) $el->setLabel($params["label"]);
			if (isset($params["value"])) $el->setValue($params["value"]);
			
			if (isset($params["onchange"])) $el->setOnChange($params["onchange"]);
			if (isset($params["onclick"])) $el->setOnClick($params["onclick"]);
			
			$this->elements[$params["name"]] = &$el;
		}
	}
	
	function addInputElement(&$el) {
		if ($el && is_object($el)) {
			$el->localize();
		
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
