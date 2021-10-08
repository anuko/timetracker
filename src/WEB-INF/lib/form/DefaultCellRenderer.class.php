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

class DefaultCellRenderer {
	var $mCellValue		= null;
	var $mCellOptions	= array();
	var $mWidth			= null;
	var $mOnChangeAdd	= null;
	
	function __construct() {
	}

	function getValue() { return $this->mCellValue; }
	function setValue($value) { $this->mCellValue = $value; }

	function getOptions() { return $this->mCellOptions; }
	function setOptions($value) { $this->mCellOptions = $value; }
	
	function getOnChangeAdd() { return $this->mOnChangeAdd; }
	function setOnChangeAdd($value) { $this->mOnChangeAdd = $value; }

	function toStringOpenTag() {
		$html = "<td";
		foreach ($this->mCellOptions as $k=>$v) {
			$html .= " $k=\"$v\"";
		}
		$html .= ">";
		return $html;
	}
	
	function toStringCloseTag() {
		return "</td>";
	}
	
	function toStringValue($value) {
		return ($this->mCellValue=='' || $this->mCellValue==null ? '&nbsp;' : $this->mCellValue);
	}
	
	function toString() {
		return $this->toStringOpenTag() . $this->toStringValue('') . $this->toStringCloseTag();
	}
	
	function render(&$table, $value, $row, $column, $selected = false) {
		$this->setValue($value);
		return $this->toString();
	}
}
