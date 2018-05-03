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

require_once('initialize.php');
import('form.Form');
import('form.DefaultCellRenderer');
import('form.Table');
import('form.TextField');

$durations_with_labels = array(
  array( // Row 0.
    'id' => 'something goes here too', // Row ideentifier.
    'label' => 'This is a label for row 0',
    'day_0' => array('id' => '0_0', 'duration' => '00:00'),
    'day_1' => array('id' => '0_1', 'duration' => '01:00'),
    'day_2' => array('id' => '0_2', 'duration' => '02:00'),
    'day_3' => array('id' => '0_3', 'duration' => null),
    'day_4' => array('id' => '0_4', 'duration' => '04:00')
  ),
  array( // Row 1.
    'label' => 'This is a label for row 1',
    'day_0' => array('id' => '1_0', 'duration' => '00:30'),
    'day_1' => array('id' => '1_1', 'duration' => '01:30'),
    'day_2' => array('id' => '1_2', 'duration' => '02:30'),
  )
);

$totals = array(
    'label' => 'Total:',
    'day_0' => '00:30',
    'day_1' => '02:30',
    'day_2' => '04:30',
    'day_3' => null,
    'day_4' => '04:00',
    'day_5' => null,
    'day_6' => null
);

// Define rendering class for a label field to the left of durations.
class LabelCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    $this->setOptions(array('width'=>200,'valign'=>'middle'));
    $this->setValue(htmlspecialchars($value));
    return $this->toString();
  }
}

// Define rendering class for a single cell for time entry in week view table.
class TimeCellRenderer extends DefaultCellRenderer {
  function render(&$table, $value, $row, $column, $selected = false) {
    $field_name = $table->getValueAt($row,$column)['id']; // Our text field names (and ids) are like x_y (row_column).
    $field = new TextField($field_name);
    $field->setFormName($table->getFormName());
    $field->setSize(2);
    $field->setValue($table->getValueAt($row,$column)['duration']);
    $this->setValue($field->getHtml());
    return $this->toString();
  }
}

// Elements of weekTimeForm.
$form = new Form('weekTimeForm');

// Create week_durations table.
$table = new Table('week_durations');
// $table->setIAScript('markModified'); // TODO: write a script to mark table or particular cells as modified.
$table->setTableOptions(array('width'=>'100%','cellspacing'=>'1','cellpadding'=>'3','border'=>'0'));
$table->setRowOptions(array('valign'=>'top','class'=>'tableHeader'));
$table->setData($durations_with_labels);
// Add columns to table.
$table->addColumn(new TableColumn('label', '', new LabelCellRenderer(), $totals['label']));
$table->addColumn(new TableColumn('day_0', 'day 0', new TimeCellRenderer(), $totals['day_0']));
$table->addColumn(new TableColumn('day_1', 'day 1', new TimeCellRenderer(), $totals['day_1']));
$table->addColumn(new TableColumn('day_2', 'day 2', new TimeCellRenderer(), $totals['day_2']));
$table->addColumn(new TableColumn('day_3', 'day 3', new TimeCellRenderer(), $totals['day_3']));
$table->addColumn(new TableColumn('day_4', 'day 4', new TimeCellRenderer(), $totals['day_4']));
$table->addColumn(new TableColumn('day_5', 'day 5', new TimeCellRenderer()));
$table->addColumn(new TableColumn('day_6', 'day 6', new TimeCellRenderer()));
$table->setInteractive(false);
$form->addInputElement($table);

$form->addInput(array('type'=>'submit','name'=>'btn_submit','value'=>$i18n->get('button.submit')));

// Submit.
if ($request->isPost()) {
  if ($request->getParameter('btn_submit')) {
  }
}

$smarty->assign('forms', array($form->getName()=>$form->toArray()));
$smarty->assign('title', $i18n->get('title.time'));
$smarty->assign('content_page_name', 'table_test.tpl');
$smarty->display('index.tpl');
