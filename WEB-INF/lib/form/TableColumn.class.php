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

import('form.DefaultCellRenderer');

// TableColumn class represents a single column in a table.
class TableColumn {
  var $colHeader = ''; // Column header.
  var $colFooter = ''; // Column footer, example: totals in week view.

// TODO: refactoring ongoing down from here.

	var $mIndexField	= "";
	var $mRenderer		= null;
	var $mWidth			= "";
	var $mTable         = null;
	var $mBgColor		= "#ffffff";
	var $mFgColor		= "#000000";
	
	function __construct($indexField, $header = '', $renderer = null, $footer = '') {
		$this->mIndexField	= $indexField;
		$this->colHeader = $header;
                $this->colFooter = $footer;
		if ($renderer!=null) {
		  $this->mRenderer	= $renderer;
		} else {
		  $this->mRenderer	= new DefaultCellRenderer();
		}
	}
	
  function getHeader() { return $this->colHeader; }
  function getFooter() { return $this->colFooter; }

	function getField() { return $this->mIndexField; }
    
    function setTable(&$table) { $this->mTable = &$table; }

    function setRenderer(&$renderer) { $this->mRenderer = &$renderer; }
    function &getRenderer() { return $this->mRenderer; }    
    
    function setFgColor($value) { $this->mFgColor = $value; }
    function getFgColor() { return $this->mFgColor; }
    
    function setBgColor($value) { $this->mBgColor = $value; }
    function getBgColor() { return $this->mBgColor; }
    
    function renderCell($value,$row,$column,$selected=false) {
    	if ($this->mRenderer!=null) {
    		return $this->mRenderer->render($this->mTable, $value, $row, $column, $selected);
    	} else {
    		return null;
    	}
    }
    
    function setWidth($value) {
    	$this->mWidth = $value;
    	if ($this->mRenderer!=null) $this->mRenderer->setWidth($value);
    }
    
    function getWidth() {
        return $this->mWidth;
    }
}
