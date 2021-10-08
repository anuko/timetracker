{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
// We need a few arrays to populate project dropdown.
// When client selection changes, the project dropdown must be re-populated with only relevant projects.
// Format:
// project_ids[143] = "325,370,390,400";  // Comma-separated list of project ids for client.
// project_names[325] = "Time Tracker";   // Project name.

// Prepare an array of project ids for clients.
var project_ids = new Array();
{foreach $client_list as $client}
  project_ids[{$client.id}] = "{$client.projects}";
{/foreach}
// Prepare an array of project names.
var project_names = new Array();
{foreach $project_list as $project}
  project_names[{$project.id}] = "{$project.name|escape:'javascript'}";
{/foreach}
// We'll use this array to populate project dropdown when client is not selected.
var idx = 0;
var projects = new Array();
{foreach $project_list as $project}
  projects[idx] = new Array("{$project.id}", "{$project.name|escape:'javascript'}");
  idx++;
{/foreach}

// Mandatory top option for project dropdown.
var empty_label_project = "{$i18n.dropdown.select|escape:'javascript'}";

// Prepare an array of predefined expenses.
idx = 0;
var defined_expenses = new Array();
{foreach $predefined_expenses as $predefined_expense}
  defined_expenses[idx] = new Array("{$predefined_expense.id}", "{$predefined_expense.name|escape:'javascript'}", "{$predefined_expense.cost}");
  idx++;
{/foreach}

// The fillProjectDropdown function populates the project combo box with
// projects associated with a selected client (client id is passed here as id).
function fillProjectDropdown(id) {
  var str_ids = project_ids[id];
  var dropdown = document.getElementById("project");
  // Determine previously selected item.
  var selected_item = dropdown.options[dropdown.selectedIndex].value;

  // Remove existing content.
  dropdown.length = 0;
  // Add mandatory top option.
  dropdown.options[0] = new Option(empty_label_project, '', true);

  // Populate project dropdown.
  if (!id) {
    // If we are here, client is not selected.
    var len = projects.length;
    for (var i = 0; i < len; i++) {
      dropdown.options[i+1] = new Option(projects[i][1], projects[i][0]);
      if (dropdown.options[i+1].value == selected_item)
        dropdown.options[i+1].selected = true;
    }
  } else if (str_ids) {
    var ids = new Array();
    ids = str_ids.split(",");
    var len = ids.length;

    for (var i = 0; i < len; i++) {
      var p_id = ids[i];
      dropdown.options[i+1] = new Option(project_names[p_id], p_id);
      if (dropdown.options[i+1].value == selected_item)
        dropdown.options[i+1].selected = true;
    }
  }
}

function get_date() {
  var date = new Date();
  return date.strftime("%Y-%m-%d");
}

// The recalculateCost function recalculates cost based on the current selection
// of predefined expense and quantity and also changes the comment accordingly.
function recalculateCost() {
  var quantity_control = document.getElementById("quantity");
  // Set quantity to 1 if it is not set already.
  if (!quantity_control.value) {
     quantity_control.value = "1";
  }

  var comment_control = document.getElementById("item_name");
  var cost_control = document.getElementById("cost");
  var replaceDecimalMark = ("." != "{$user->getDecimalMark()}");

  // Calculate cost.
  var dropdown = document.getElementById("predefined_expense");
  if (dropdown.selectedIndex == 0) {
    quantity_control.value = "";
    comment_control.value = "";
    cost_control.value = "";
  } else {
    comment_control.value = defined_expenses[dropdown.selectedIndex - 1][1] + " - " + quantity_control.value;
    var quantity = quantity_control.value;
    if (isNaN(quantity))
      cost_control.value = "";
    else {
      var expenseCost = defined_expenses[dropdown.selectedIndex - 1][2];
      if (replaceDecimalMark)
        expenseCost = expenseCost.replace("{$user->getDecimalMark()}", ".");
      var newCost = (quantity_control.value * expenseCost).toFixed(2);
      if (replaceDecimalMark)
        newCost = newCost.replace(".", "{$user->getDecimalMark()}");
      cost_control.value = newCost;
    }
  }
}
</script>

{$forms.expensesForm.open}
<div class="small-screen-calendar">{$forms.expensesForm.date.control}</div>
<table class="centered-table">
  <tr><td></td><td></td><td rowspan="{$large_screen_calendar_row_span}"><div class="large-screen-calendar">{$forms.expensesForm.date.control}</div></td></tr>
{if $user_dropdown}
  <tr class = "small-screen-label"><td><label for="user">{$i18n.label.user}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="user">{$i18n.label.user}:</label></td>
    <td class="td-with-input">{$forms.expensesForm.user.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $user->isPluginEnabled('cl')}
  <tr class = "small-screen-label"><td><label for="client">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="client">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.expensesForm.client.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_project}
  <tr class = "small-screen-label"><td><label for="project">{$i18n.label.project} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="project">{$i18n.label.project} (*):</label></td>
    <td class="td-with-input">{$forms.expensesForm.project.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $predefined_expenses}
  <tr class = "small-screen-label"><td><label for="predefined_expense">{$i18n.label.expense}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="predefined_expense">{$i18n.label.expense}:</label></td>
    <td class="td-with-input">{$forms.expensesForm.predefined_expense.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="quantity">{$i18n.label.quantity}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="quantity">{$i18n.label.quantity}:</label></td>
    <td class="td-with-input">{$forms.expensesForm.quantity.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="item_name">{$i18n.label.comment} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="item_name">{$i18n.label.comment} (*):</label></td>
    <td class="td-with-input">{$forms.expensesForm.item_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="cost">{$i18n.label.cost} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="cost">{$i18n.label.cost} (*):</label></td>
    <td class="td-with-input">{$forms.expensesForm.cost.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if $show_files}
  <tr class = "small-screen-label"><td><label for="newfile">{$i18n.label.file}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="newfile">{$i18n.label.file}:</label></td>
    <td class="td-with-input">{$forms.expensesForm.newfile.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr>
    <td align="center" colspan="3">{$forms.expensesForm.btn_submit.control}</td>
  </tr>
</table>
{$forms.expensesForm.close}

{if $expense_items}
<div class="record-list">
<table class="x-scrollable-table">
  <tr>
  {if $user->isPluginEnabled('cl')}
    <th>{$i18n.label.client}</th>
  {/if}
  {if $show_project}
    <th>{$i18n.label.project}</th>
  {/if}
    <th>{$i18n.label.item}</th>
    <th>{$i18n.label.cost}</th>
  {if $show_files}
    <th></th>
  {/if}
    <th></th>
    <th></th>
  </tr>
  {foreach $expense_items as $item}
  <tr>
    {if $user->isPluginEnabled('cl')}
    <td class="text-cell">{$item.client|escape}</td>
    {/if}
    {if $show_project}
    <td class="text-cell">{$item.project|escape}</td>
    {/if}
    <td class="text-cell">{$item.item|escape}</td>
    <td class="time-cell">{$item.cost}</td>
    {if $show_files}
      {if $item.has_files}
        <td><a href="expense_files.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-files.png"></a></td>
      {else}
        <td><a href="expense_files.php?id={$item.id}"><img class="table_icon" alt="{$i18n.label.files}" src="img/icon-file.png"></a></td>
      {/if}
    {/if}
    <td>
    {if $item.approved || $item.invoice_id}
      &nbsp;
    {else}
      <a href='expense_edit.php?id={$item.id}'><img class="table_icon" alt="{$i18n.label.edit}" src="img/icon-edit.png"></a>
    {/if}
    </td>
    <td>
    {if $item.approved || $item.invoice_id}
      &nbsp;
    {else}
      <a href='expense_delete.php?id={$item.id}'><img class="table_icon" alt="{$i18n.label.delete}" src="img/icon-delete.png"></a>
    {/if}
    </td>
  </tr>
  {/foreach}
</table>
</div>
<div class="day-totals">{$i18n.label.day_total}: {$user->getCurrency()|escape} {$day_total}</div>
{/if}

