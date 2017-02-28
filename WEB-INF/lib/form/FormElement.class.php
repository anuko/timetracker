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
  var $id = '';         // Control id.
  var $name;            // Control name.
  var $form_name = '';  // Form name the control is in.
  var $value = '';      // Value of the control.
  var $size = '';       // Control size.
  var $max_length = ''; // Max length of text in control.
  var $on_change = '';  // What happens when value of control changes.
  var $on_click = '';   // What happens when the control is clicked.
  var $label = '';      // Optional label for control.
  var $style = '';      // Control style.
  var $enabled = true;  // Whether the control is enabled.
  var $class = 'FormElement'; // Class name for the element.

  // TODO: refactoring ongoing down from here.
	var $mI18n 			= null;

	function __construct() {
	}

	function getClass() { return $this->class; }
	
	function setName($name)	{ $this->name = $name; }
	function getName()	{ return $this->name; }
	
	function setFormName($name) { $this->form_name = $name; }
	function getFormName()	{ return $this->form_name; }
	
	function setValue($value) { $this->value = $value; }
	function getValue() { return $this->value; }
	
	function setValueSafe($value) { $this->value = $value;}
	function getValueSafe() { return $this->value; }

	function setId($id) { $this->id = $id;	}
	function getId() { return $this->id; }
	
	function setSize($value) { $this->size = $value; }
	function getSize() { return $this->size; }

	function setLabel($label) { $this->label = $label; }
	function getLabel() { return $this->label; }
	
	function setMaxLength($value) { $this->max_length = $value; }
	function getMaxLength() { return $this->max_length; }

	function setStyle($value) { $this->style = $value; }
	function getStyle() { return $this->style; }

	function setEnabled($flag) { $this->enabled = $flag; }
	function isEnabled() { return $this->enabled; }
	
	function setOnChange($str) { $this->on_change = $str; }
	function setOnClick($str) { $this->on_click = $str; }

	function setLocalization($i18n)	{
		$this->mI18n = $i18n;
	}
	
	function toStringControl()	{
		return "";
	}

	function toStringLabel() {
	    return "<label for=\"" . $this->id . "\">" . $this->label . "</label>";
	}
	
	function toArray() {
	    return array(
	             "label"=>$this->toStringLabel(),
	             "control"=>$this->toStringControl()
	           );
	}

}
