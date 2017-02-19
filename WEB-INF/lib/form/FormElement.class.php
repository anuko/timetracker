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

// FromElement is the base class for controls on forms.
class FormElement {
  var $id = '';
  var $name;
  var $form_name = '';
  var $value = '';
  // TODO: refactoring ongoing down from here.
	var $mSize			= "";
	var $mMaxLength		= "";
	var $mTabindex		= "";
	var $mAccesskey     = "";
	var $mOnSelect		= "";
	var $mOnChange		= "";
	var $mOnClick		= "";
	var $mOnKeyPress	= "";
	var $mOnFocus		= "";
	var $mLabel         = "";
	var $mStyle         = "";
	var $mRenderable    = true;
	var $mEnabled		= true;
	var $cClassName		= "FormElement";
	var $mI18n 			= null;

	function __construct() {
	}

	function getClass()	{ return $this->cClassName; }
	
	function setName($name)	{ $this->name = $name; }
	function getName()	{ return $this->name; }
	
	function setFormName($name) { $this->form_name = $name; }
	function getFormName()	{ return $this->form_name; }
	
	function setValue($value) { $this->value = $value;}
	function getValue() { return $this->value; }
	
	function setValueSafe($value) { $this->value = $value;}
	function getValueSafe() { return $this->value; }

	function setId($id)	{ $this->id = $id;	}
	function getId() { return $this->id; }
	
	function setSize($value)	{ $this->mSize = $value; }
	function getSize() { return $this->mSize; }

	function setLabel($label)	{ $this->mLabel = $label; }
	function getLabel() { return $this->mLabel; }
	
	function setMaxLength($value)	{ $this->mMaxLength = $value; }
	function getMaxLength() { return $this->mMaxLength; }
	
	function setTabindex($value)	{ $this->mTabindex = $value; }
	function getTabindex() { return $this->mTabindex; }
	
	function setAccesskey($value)	{ $this->mAccesskey = $value; }
	function getAccesskey() { return $this->mAccesskey; }

	function setStyle($value)	{ $this->mStyle = $value; }
	function getStyle() { return $this->mStyle; }
	
	function setRenderable($flag)	{ $this->mRenderable = $flag;	}
	function isRenderable()	{ return $this->mRenderable; }
	
	function setEnable($flag)	{ $this->mEnabled = $flag;	}
	function isEnable()	{ return $this->mEnabled; }
	
	function setOnChange($str)	{ $this->mOnChange = $str; }
	function setOnClick($str)	{ $this->mOnClick = $str; }
	function setOnSelect($str)	{ $this->mOnSelect = $str; }

	function setLocalization($i18n)	{
		$this->mI18n = $i18n;
	}
	
	function toStringControl()	{
		return "";
	}
	
	function toStringLabel() {
	    return "<label for=\"" . $this->id . "\">" . $this->mLabel . "</label>";
	}
	
	function toArray() {
	    return array(
	             "label"=>$this->toStringLabel(),
	             "control"=>$this->toStringControl()
	           );
	}

}
