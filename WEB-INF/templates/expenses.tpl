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
  var replaceDecimalMark = ("." != "{$user->decimal_mark}");

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
        expenseCost = expenseCost.replace("{$user->decimal_mark}", ".");
      var newCost = (quantity_control.value * expenseCost).toFixed(2);
      if (replaceDecimalMark)
        newCost = newCost.replace(".", "{$user->decimal_mark}");
      cost_control.value = newCost;
    }
  }
}
</script>

{$forms.expensesForm.open}
<table cellspacing="4" cellpadding="0" border="0">
  <tr>
    <td valign="top">
      <table>
{if $on_behalf_control}
        <tr>
          <td align="right">{$i18n.label.user}:</td>
          <td>{$forms.expensesForm.onBehalfUser.control}</td>
        </tr>
{/if}
{if $user->isPluginEnabled('cl')}
        <tr>
          <td align="right">{$i18n.label.client}{if $user->isPluginEnabled('cm')} (*){/if}:</td>
          <td>{$forms.expensesForm.client.control}</td>
        </tr>
{/if}
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <tr>
          <td align="right">{$i18n.label.project} (*):</td>
          <td>{$forms.expensesForm.project.control}</td>
        </tr>
{/if}
{if $predefined_expenses}
        <tr>
          <td align="right">{$i18n.label.expense}:</td>
          <td>{$forms.expensesForm.predefined_expense.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.quantity}:</td>
          <td>{$forms.expensesForm.quantity.control}</td>
        </tr>
{/if}
        <tr>
          <td align="right">{$i18n.label.comment} (*):</td>
          <td>{$forms.expensesForm.item_name.control}</td>
        </tr>
        <tr>
          <td align="right">{$i18n.label.cost} (*):</td>
          <td>{$forms.expensesForm.cost.control} {$user->currency|escape}</td>
        </tr>
      </table>
    </td>
    <td valign="top">
      <table>
        <tr><td>{$forms.expensesForm.date.control}</td></tr>
      </table>
    </td>
  </tr>
</table>

<table>
  <tr>
    <td align="center" colspan="2">{$forms.expensesForm.btn_submit.control}</td>
  </tr>
</table>

<table width="720">
<tr>
  <td valign="top">
{if $expense_items}
      <table border="0" cellpadding="3" cellspacing="1" width="100%">
      <tr>
  {if $user->isPluginEnabled('cl')}
        <td width="20%" class="tableHeader">{$i18n.label.client}</td>
  {/if}
  {if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <td class="tableHeader">{$i18n.label.project}</td>
  {/if}
        <td class="tableHeader">{$i18n.label.item}</td>
        <td width="5%" class="tableHeaderCentered">{$i18n.label.cost}</td>
        <td width="5%" class="tableHeader">{$i18n.label.edit}</td>
      </tr>
  {foreach $expense_items as $item}
      <tr bgcolor="{cycle values="#f5f5f5,#ffffff"}">
    {if $user->isPluginEnabled('cl')}
        <td valign="top">{$item.client|escape}</td>
    {/if}
    {if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
        <td valign="top">{$item.project|escape}</td>
    {/if}
        <td valign="top">{$item.item|escape}</td>
        <td valign="top" align="right">{$item.cost}</td>
        <td valign="top" align="center">{if $item.invoice_id}&nbsp;{else}<a href='expense_edit.php?id={$item.id}'>{$i18n.label.edit}</a>{/if}</td>
      </tr>
  {/foreach}
    </table>
    <table border="0" cellpadding="3" cellspacing="1" width="100%">
      <tr>
        <td nowrap align="right">{$i18n.label.day_total}: {$user->currency|escape} {$day_total}</td>
      </tr>
    </table>
{/if}
  </td>
</tr>
</table>
{$forms.expensesForm.close}
