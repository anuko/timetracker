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

{* Conditional include of confirmSave handler. *}
{if isset($confirm_save) && $confirm_save}
var original_date = "{$entry_date}";

function confirmSave() {
  var date_on_save = document.getElementById("date").value;
  if (original_date != date_on_save) {
    return confirm("{$i18n.warn.confirm_save}");
  }
}
{/if}

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

{$forms.expenseItemForm.open}
<table class="centered-table">
  <tr>
{if $user->isPluginEnabled('cl')}
  <tr class = "small-screen-label"><td><label for="client">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="client">{$i18n.label.client}{if $user->isOptionEnabled('client_required')} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.expenseItemForm.client.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $show_project}
  <tr class = "small-screen-label"><td><label for="project">{$i18n.label.project} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="project">{$i18n.label.project} (*):</label></td>
    <td class="td-with-input">{$forms.expenseItemForm.project.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $predefined_expenses}
  <tr class = "small-screen-label"><td><label for="predefined_expense">{$i18n.label.expense}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="predefined_expense">{$i18n.label.expense}:</label></td>
    <td class="td-with-input">{$forms.expenseItemForm.predefined_expense.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="quantity">{$i18n.label.quantity}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="quantity">{$i18n.label.quantity}:</label></td>
    <td class="td-with-input">{$forms.expenseItemForm.quantity.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="item_name">{$i18n.label.comment} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="item_name">{$i18n.label.comment}(*):</label></td>
    <td class="td-with-input">{$forms.expenseItemForm.item_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="cost">{$i18n.label.cost} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="cost">{$i18n.label.cost} (*):</label></td>
    <td class="td-with-input">{$forms.expenseItemForm.cost.control} {$user->getCurrency()|escape}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if ($user->can('manage_invoices') && $user->isPluginEnabled('ps'))}
  <tr>
    <td class="large-screen-label"></td>
    <td class="td-with-input"><label>{$forms.expenseItemForm.paid.control}{$i18n.label.paid}</label></td>
  </tr>
{/if}
  <tr class="small-screen-label"><td><label for="date">{$i18n.label.date}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="date">{$i18n.label.date}:</label></td>
    <td class="td-with-input">{$forms.expenseItemForm.date.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.expenseItemForm.btn_save.control} {$forms.expenseItemForm.btn_copy.control} {$forms.expenseItemForm.btn_delete.control}</div>
{$forms.expenseItemForm.close}
