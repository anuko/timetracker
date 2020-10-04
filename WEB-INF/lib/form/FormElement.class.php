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
  var $id = '';          // control id
  var $name;             // control name
  var $form_name = '';   // form name the control is in
  var $value = '';       // value of the control
  var $placeholder = ''; // placeholder
  var $size = '';        // control size
  var $max_length = '';  // max length of text in control
  var $on_change = '';   // what happens when value of control changes
  var $on_click = '';    // what happens when the control is clicked
  var $label = '';       // optional label for control
  var $style = '';       // control style
  var $enabled = true;   // whether the control is enabled
  var $class = 'FormElement'; // php class name for the control
  var $css_class = null; // css class name for the control

  function __construct() {
  }

  function getName() { return $this->name; }
  function getClass() { return $this->class; }
  function getCssClass() { return $this->css_class; }
  function setCssClass($css_class) { $this->css_class = $css_class; }

  function setFormName($name) { $this->form_name = $name; }
  function getFormName() { return $this->form_name; }

  function setValue($value) { $this->value = $value; }
  function getValue() { return $this->value; }

  // Safe function variations are used to store/read values in/from user session for further reuse.
  // They may convert data in derived classes to some standard form. For example, floats are stored
  // with a dot delimiter (not comma), and dates are stored in DB_DATEFORMAT.
  // This allows to reuse data in session even when user changes the deliminter or date format.
  function setValueSafe($value) { $this->value = $value;}
  function getValueSafe() { return $this->value; }

  function setId($id) { $this->id = $id; }
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
  function setPlaceholder($str) { $this->placeholder = $str; }

  function localize() {} // Localization occurs in derived classes and is dependent on control type.
                         // For example, in calendar control we need to localize day and month names.

  // getHtml returns HTML for the element.
  function getHtml() { return ''; }

  // getLabelHtml returns HTML code for element label.
  function getLabelHtml() { return '<label for="'.$this->id.'">'.$this->label.'</label>'; }

  function toArray() {
    return array(
      'label'=>$this->getLabelHtml(),
      'control'=>$this->getHtml());
  }
}
