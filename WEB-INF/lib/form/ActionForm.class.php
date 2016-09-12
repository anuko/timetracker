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

import("DateAndTime");

class ActionForm {
	var $mName		= "";
	var $mSessionCell;
    var $mValues	= array(); // values without localisation
    var $mVariables = array();
    var $mForm		= null;
    var $mInitForm	= false;

    function __construct($name, &$form, $request=null) {
    	$this->setName($name);
    	$form->setRequest($request);
		$this->setForm($form);
		//if ($request) $this->initAttributes($request);
		$this->initAttributes($request);
    }
    
    function setForm(&$form) {
    	$this->mForm = $form;
    	$elements = $form->getElements();
    	if (is_array($elements))
    		$this->setVariablesNames(array_keys($elements));
    }
    
    function &getFormElement($name) {
    	if ($this->mForm!=null) {
	   		return  $this->mForm->mElements[$name];
    	}
    	return null;
    }
    
    function getName() {
		return $this->mName;
	}

    function setName($name) {
		$this->mName = $name;
		$this->mSessionCell = "formbean_".$this->mName;
	}
    
    /**
     * init parameters and form
     *
     * @param object $request
     */
    function initAttributes(&$request) {
        //$submit_flag = $this->isSubmit();
        $submit_flag = (is_object($request) && ($request->isPost()));
        	
        if ($submit_flag) {
        	// fill ActionForm and Form from Request

	    	foreach ($this->mVariables as $name) {
     			if ($this->mForm->mElements[$name] && $request->getParameter($name)) {
	     		    $this->mForm->mElements[$name]->setValue($request->getParameter($name));
    			    $this->mValues[$name] = $this->mForm->mElements[$name]->getValue();
	    		}
	        }
        } else {
        	// fill ActionForm from Session
        	$this->loadBean();
        }
        
        // fill Form by ActionForm
        if ($this->mForm) {
	        $elements = $this->mForm->getElements();
			foreach ($elements as $name=>$el) {
    			if ($this->mForm->mElements[$name] && isset($this->mValues[$name])) {
				    $this->mForm->mElements[$name]->setValue($this->mValues[$name]);
	    	    }
	        }
	        $this->mInitForm = true;
        }
    }
    
    /**
     * Init custom variables
     *
     * @param unknown $request
     * @param unknown $respons
     */
    function initVariables(&$request, &$respons) {
    	
    }
    
    function setVariablesNames($namelist) {
        $this->mVariables = $namelist;
    }

    function setAttribute($name,$value) {
    	global $user;
    	
        $this->mValues[$name] = $value;
        if ($this->mForm) {
        	if (isset($this->mForm->mElements[$name])) {
        		if ($this->mForm->mElements[$name]->cClassName=="DateField") {
        			$dt = new DateAndTime($user->date_format, $value);
					$value = $dt->toString(DB_DATEFORMAT);
        		}
        		$this->mForm->mElements[$name]->setValueSafe($value);
        	}
        }
    }

    function getAttribute($name) {
        return @$this->mValues[$name];
    }
	
	function getAttributes() {
        return $this->mValues;
    }

    function validate(&$actionMapping, &$request) {
        return null;
    }

	function setAttributes($value) {
		global $user;
		
        $this->mValues = $value;
        if (is_array($this->mValues))
        foreach ($this->mValues as $name=>$value) {
	        if ($this->mForm) {
	        	if (isset($this->mForm->mElements[$name])) {
	        		if ($this->mForm->mElements[$name]->cClassName=="DateField") {
	        			$dt = new DateAndTime($user->date_format, $value);
						$value = $dt->toString(DB_DATEFORMAT);
	        		}
	        		$this->mForm->mElements[$name]->setValueSafe($value);
	        	}
	        }
        }
    }
    
    function dump() {
        print_r($this->mValues);
    }
    
    function isSubmit() {
        $res = false;
        if (is_object($this->mForm)) {
            $res = $this->mForm->isSubmit();
        }
        return $res;
    }
    
    function saveBean() {
    	if ($this->mForm) {
    		$elements = $this->mForm->getElements();
    		$el_list = array();
    		foreach ($elements as $el) {
    			$el_list[] = array("name"=>$el->getName(),"class"=>$el->getClass());
    			
				$_SESSION[$this->mSessionCell . "_" . $el->getName()] = $el->getValueSafe();
    		}
    		$_SESSION[$this->mSessionCell . "session_store_elements"] = $el_list;
    	}
    	//print_r($_SESSION);
    }
    
    function loadBean() {
    	$el_list = @$_SESSION[$this->mSessionCell . "session_store_elements"];
    	if (is_array($el_list)) {
    		foreach ($el_list as $ref_el) {
    			
    			// restore form elements
    			import('form.'.$ref_el["class"]);
    			$class_name = $ref_el["class"];
    			$el = new $class_name($ref_el["name"]);
    			if (isset($GLOBALS["I18N"])) $el->setLocalization($GLOBALS["I18N"]);
    			$el->setValueSafe(@$_SESSION[$this->mSessionCell . "_" .$el->getName()]);
    			
				if ($this->mForm && !isset($this->mForm->mElements[$ref_el["name"]])) {
					$this->mForm->mElements[$ref_el["name"]] = &$el;
				}
    			$this->mValues[$el->getName()] = $el->getValue();
    		}
    	}
   		//print_r($_SESSION);
    }
    
    function destroyBean() {
    	$el_list = @$_SESSION[$this->mSessionCell . "session_store_elements"];
    	if (is_array($el_list)) {
    		foreach ($el_list as $ref_el) {
    			unset($_SESSION[$this->mSessionCell . "_" .$ref_el["name"]]);
    		}
    	}
    	unset($_SESSION[$this->mSessionCell . "session_store_elements"]);
    }
    
    function isSaved() {
    	return (isset($_SESSION[$this->mSessionCell . "session_store_elements"]) ? true : false);
    }
}

