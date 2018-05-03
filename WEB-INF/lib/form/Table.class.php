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

import('form.FormElement');
import('form.TableColumn');

class Table extends FormElement {

  var $mColumns       = array(); // array of columns in table
  var $mData          = null;    // array of rows with data for column cells
  var $mHeaders       = array(); // column headers
  var $mFooters       = array(); // column footers
  var $mInteractive   = true;    // adds a clickable checkbox column to table
  var $mIAScript      = null;    // sctipt to execute when a checkbox is clicked
  var $mKeyField      = '';      // identifies a column used as key to access row data
  var $mColumnFields  = array(); // field names (from mData) for data in each column
  var $mBgColor       = '#ffffff';
  var $mBgColorOver   = '#eeeeff';
  var $mWidth         = '';
  var $mTableOptions  = array();
  var $mRowOptions    = array();
  var $mHeaderOptions = array();
  var $mProccessed    = false;
	
  function __construct($name, $cssClass = null) {
    $this->class = 'Table';
    $this->name = $name;
    $this->cssClass = $cssClass;
  }
  
  function setKeyField($value) {
    $this->mKeyField = $value;
  }
  
  function setData($data) {
    if (is_array($data) && isset($data[0]) && is_array($data[0]))
      $this->mData = &$data;
  }
  
  function addColumn($column) {
    if ($column != null) $column->setTable($this);
    $this->mColumns[] = &$column;
  }
  
  function setInteractive($value) { $this->mInteractive = $value; }
  function isInteractive() { return $this->mInteractive; }
  
  function setIAScript($value) { $this->mIAScript = $value; }
  function getIAScript() { return $this->mIAScript; }
		
  function setWidth($value) { $this->mWidth = $value; }
  function getWidth() { return $this->mWidth; }

  function setTableOptions($value) { $this->mTableOptions = $value; }
  function getTableOptions() { return $this->mTableOptions; }
  
  function setRowOptions($value) { $this->mRowOptions = $value; }
  function getRowOptions() { return $this->mRowOptions; }

  function setHeaderOptions($value) { $this->mHeaderOptions = $value; }
  function getHeaderOptions() { return $this->mHeaderOptions; }
  
  function getValueAt($rowindex, $colindex) {
    if (!$this->mProccessed) $this->_process();
    return @$this->mData[$rowindex][$this->mColumnFields[$colindex]];
  }
	
  function getValueAtName($rowindex, $fieldname) {
    if (!$this->mProccessed) $this->_process();
    return @$this->mData[$rowindex][$fieldname];
  }

  function _process() {
    $this->mProccessed = true;
  	
    if ($this->mInteractive) {
      // Add a column of clickable checkboxes.
      $column = new TableColumn("","<input type=\"checkbox\" name=\"".$this->name."_all\" onclick=\"setAll(this.checked)\">");
      import('form.CheckboxCellRenderer');
      $cb = new CheckboxCellRenderer();
      if ($this->getIAScript()) $cb->setOnChangeAdd($this->getIAScript()."(this)");
      $column->setRenderer($cb);
      $column->setTable($this);
      array_unshift($this->mColumns, $column);
    }
    
    foreach ($this->mColumns as $column) {
      $this->mColumnFields[] = $column->getField();
      $this->mHeaders[] = $column->getHeader();
      $this->mFooters[] = $column->getFooter();
    }
  }
  
  function getHtml() {
    if (!$this->mProccessed) $this->_process();
    
    $html = "";
    if ($this->mInteractive) $html .= $this->_addJavaScript();

    $html .= "<table";
    if ($this->cssClass) {
      $html .= " class=\"".$this->cssClass."\"";
    }
    if (count($this->mTableOptions) > 0) {
      foreach ($this->mTableOptions as $k=>$v) {
        $html .= " $k=\"$v\"";
      }
    } else {
      $html .= " border=\"1\"";
    }
    if ($this->mWidth!="") $html .= " width=\"".$this->mWidth."\"";
    $html .= ">\n";
    
    // Print headers.
    if (($this->mInteractive && (count($this->mHeaders) > 1)) || (!$this->mInteractive && (count($this->mHeaders) > 0))) {
      $html .= "<tr";
      if (count($this->mRowOptions) > 0) {
        foreach ($this->mRowOptions as $k=>$v) {
          $html .= " $k=\"$v\"";
        }
      }
      $html .= ">\n";
      foreach ($this->mHeaders as $header) {
        $html .= "<th";
        if (count($this->mHeaderOptions) > 0) {
          foreach ($this->mHeaderOptions as $k=>$v) {
          	$html .= " $k=\"$v\"";
          }
        }
        $html .= ">$header</th>\n";
      }
      $html .= "</tr>\n";
    }
    
    // Print rows.
    for ($row = 0; $row < count($this->mData); $row++) {
      $html .= "\n<tr bgcolor=\"".$this->mBgColor."\" onmouseover=\"setRowBackground(this, '".$this->mBgColorOver."')\" onmouseout=\"setRowBackground(this, null)\">\n";
      for ($col = 0; $col < $this->getColumnCount(); $col++) {
        if (0 == $col && strtolower(get_class($this->mColumns[$col]->getRenderer())) == 'checkboxcellrenderer') {
          // Checkbox for the row. Determine if selected.
          $selected = false;
          if (is_array($this->value)) {
            foreach ($this->value as $p) {
              if ($p == $this->mData[$row][$this->mKeyField]) {
              	$selected = true;
              	break;
              }
            }
          }
          // Render control checkbox.
          $html .= $this->mColumns[$col]->renderCell($this->mData[$row][$this->mKeyField], $row, $col, $selected);
        } else {
          // Render regular cell.
          $html .= $this->mColumns[$col]->renderCell($this->getValueAt($row, $col), $row, $col);
        }
      }
      $html .= "</tr>\n";
    }

    // Print footers.
    if (($this->mInteractive && (count($this->mFooters) > 1)) || (!$this->mInteractive && (count($this->mFooters) > 0))) {
      $html .= "<tr";
      if (count($this->mRowOptions) > 0) {
        foreach ($this->mRowOptions as $k=>$v) {
          $html .= " $k=\"$v\"";
        }
      }
      $html .= ">\n";
      foreach ($this->mFooters as $footer) {
        $html .= "<th";
        if (count($this->mHeaderOptions) > 0) {
          foreach ($this->mHeaderOptions as $k=>$v) {
            $html .= " $k=\"$v\"";
          }
        }
        $html .= ">$footer</th>\n";
      }
      $html .= "</tr>\n";
    }

    $html .= "</table>";
    return $html;
  }
  
  function getColumnCount() {
    return count($this->mColumns);
  }

  function _addJavaScript() {
    $html = "<script>\n";
    // setAll - checks / unchecks all checkboxes in the table.
    $html .= "function setAll(value) {\n";
    $html .= "\tfor (var i = 0; i < ".$this->getFormName().".elements.length; i++) {\n";
    $html .= "\t\tif ((".$this->getFormName().".elements[i].type=='checkbox') && (".$this->getFormName().".elements[i].name=='".$this->name."[]')) {\n";
    $html .= "\t\t\t".$this->getFormName().".elements[i].checked=value;\n";
    if ($this->getIAScript()) {
      $html .= "\t\t\t".$this->getIAScript()."(".$this->getFormName().".elements[i]);\n";
    }
    $html .= "\t}}\n";
    $html .= "}\n\n";
    
    $html .= "var rowBgColors;\n";
    // setRowBackground - sets background for a row.
    $html .= "function setRowBackground(theRow, thePointerColor) {\n";
    $html .= "\tif (typeof(theRow.style) == 'undefined' || typeof(theRow.cells) == 'undefined') {\n";
    $html .= "\t\treturn false;\n\t}\n\n";
    $html .= "\tvar row_cells_cnt = theRow.cells.length;\n";
    $html .= "\tif (thePointerColor != null) {\n";
    $html .= "\t\trowBgColors = new Array(row_cells_cnt);\n";
    $html .= "\t\tfor (var c = 0; c < row_cells_cnt; c++) {\n";
    $html .= "\t\t\trowBgColors[c]=theRow.cells[c].bgColor;\n\t\t}\n";
    $html .= "\t}\n";
    $html .= "\tfor (var c = 0; c < row_cells_cnt; c++) {\n";
    $html .= "\t\ttheRow.cells[c].bgColor = thePointerColor;\n\t}\n\n";
    $html .= "\tif (thePointerColor == null) {\n";
    $html .= "\t\tfor (var c = 0; c < row_cells_cnt; c++) {\n";
    $html .= "\t\t\ttheRow.cells[c].bgColor=rowBgColors[c];\n\t\t}\n";
    $html .= "\t\tdelete rowBgColors;\n";
    $html .= "\t}\n";
    $html .= "\treturn true;\n}\n";
    $html .= "</script>\n";
    
    return $html;
  }
}
