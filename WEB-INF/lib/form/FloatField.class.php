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

import('form.TextField');
	
class FloatField extends TextField {
	var $mDelimiter = '.';
	var $mFFormat;
	var $cClassName	= "FloatField";

	function __construct($name) {
		$this->mName	= $name;
	}
	
	function setLocalization($i18n)	{
		FormElement::setLocalization($i18n);
		global $user;
		$this->mDelimiter = $user->decimal_mark;
	}
	
	function setFormat($format)	{
		$this->mFFormat = $format;
	}
	
	function setValue($value) {
		if (isset($this->mFFormat) && isset($value) && strlen($value)) {
			$value = str_replace($this->mDelimiter,".",$value);
			$value = sprintf("%".$this->mFFormat."f",$value);
			$value = str_replace(".",$this->mDelimiter,$value);
		}
		$this->mValue = $value;
	}
	
	function setValueSafe($value)	{
		// '.' to ',' , apply localisation 
		if (strlen($value)>0)
			$this->mValue = str_replace(".",$this->mDelimiter,$value);
	}
	
	function getValueSafe() {
		// ',' to '.'
		if (strlen($this->mValue)>0) {
			return str_replace($this->mDelimiter,".",$this->mValue);
		} else {
			return null;
		}
	}
}
