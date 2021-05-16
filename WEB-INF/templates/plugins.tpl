{* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt *}

<script>
// handlePluginCheckboxes - controls visibility of controls.
function handlePluginCheckboxes() {
  var puncherCheckbox = document.getElementById("puncher");
  var configureLabel = document.getElementById("puncher_conf");
  var docLabel = document.getElementById("puncher_doc");
  if (puncherCheckbox.checked) {
    configureLabel.style.display = "";
    docLabel.style.display = "none";
  } else {
    configureLabel.style.display = "none";
    docLabel.style.display = "";
  }

  var clientsCheckbox = document.getElementById("clients");
  var invoicesCheckbox = document.getElementById("invoices");
  var requiredCheckbox = document.getElementById("client_required");
  var requiredLabel = document.getElementById("client_required_label");
  if (clientsCheckbox.checked) {
    requiredCheckbox.style.visibility = "visible";
    requiredLabel.style.visibility = "visible";
    invoicesCheckbox.disabled = false;
  } else {
    requiredCheckbox.checked = false;
    requiredCheckbox.style.visibility = "hidden";
    requiredLabel.style.visibility = "hidden";
    invoicesCheckbox.checked = false;
    invoicesCheckbox.disabled = true;
  }

  var expensesCheckbox = document.getElementById("expenses");
  var taxCheckbox = document.getElementById("tax_expenses");
  var taxLabel = document.getElementById("tax_label");
  if (expensesCheckbox.checked) {
    taxCheckbox.style.visibility = "visible";
    taxLabel.style.visibility = "visible";
  } else {
    taxCheckbox.checked = false;
    taxCheckbox.style.visibility = "hidden";
    taxLabel.style.visibility = "hidden";
  }
  configureLabel = document.getElementById("expenses_conf");
  if (expensesCheckbox.checked) {
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }

  var customFieldsCheckbox = document.getElementById("custom_fields");
  configureLabel = document.getElementById("cf_conf");
  if (customFieldsCheckbox.checked) {
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }

  var notificationsCheckbox = document.getElementById("notifications");
  configureLabel = document.getElementById("notifications_conf");
  docLabel = document.getElementById("notifications_doc");
  if (notificationsCheckbox.checked) {
    configureLabel.style.display = "";
    docLabel.style.display = "none";
  } else {
    configureLabel.style.display = "none";
    docLabel.style.display = "";
  }

  var lockingCheckbox = document.getElementById("locking");
  configureLabel = document.getElementById("locking_conf");
  if (lockingCheckbox.checked) {
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }

  var quotasCheckbox = document.getElementById("quotas");
  configureLabel = document.getElementById("quotas_conf");
  if (quotasCheckbox.checked){
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }

  var weekViewCheckbox = document.getElementById("week_view");
  configureLabel = document.getElementById("week_view_conf");
  if (weekViewCheckbox.checked){
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }

  var workUnitsCheckbox = document.getElementById("work_units");
  configureLabel = document.getElementById("work_units_conf");
  if (workUnitsCheckbox.checked){
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }

  var templatesCheckbox = document.getElementById("templates");
  configureLabel = document.getElementById("templates_conf");
  docLabel = document.getElementById("templates_doc");
  if (templatesCheckbox.checked){
    configureLabel.style.display = "";
    docLabel.style.display = "none";
  } else {
    configureLabel.style.display = "none";
    docLabel.style.display = "";
  }
}
</script>

{$forms.pluginsForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="charts">{$i18n.title.charts}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="charts">{$i18n.title.charts}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.charts.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="puncher">{$i18n.label.puncher}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="puncher">{$i18n.label.puncher}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.puncher.control} <span id="puncher_doc"><a href="https://www.anuko.com/lp/tt_51.htm" target="_blank">{$i18n.label.what_is_it}</a></span><span id="puncher_conf">{if $user->isPluginEnabled('pu')}<a href="puncher_conf.php">{$i18n.label.configure}</a>{/if}</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="clients">{$i18n.title.clients}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="clients">{$i18n.title.clients}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.clients.control} {$forms.pluginsForm.client_required.control} <span id="client_required_label"><label for="client_required">{$i18n.label.required}</label></span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="invoices">{$i18n.title.invoices}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="invoices">{$i18n.title.invoices}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.invoices.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="paid_status">{$i18n.label.paid_status}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="paid_status">{$i18n.label.paid_status}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.paid_status.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="custom_fields">{$i18n.label.custom_fields}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="custom_fields">{$i18n.label.custom_fields}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.custom_fields.control} <span id="cf_conf">{if $user->isPluginEnabled('cf')}<a href="cf_custom_fields.php">{$i18n.label.configure}</a>{/if}</span></td>
  </tr>
  <tr class = "small-screen-label"><td><label for="expenses">{$i18n.title.expenses}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="expenses">{$i18n.title.expenses}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.expenses.control} {$forms.pluginsForm.tax_expenses.control} <span id="tax_label"><label for="tax_expenses">{$i18n.label.tax}</label></span> <span id="expenses_conf">{if $user->isPluginEnabled('ex')}<a href="predefined_expenses.php">{$i18n.label.configure}</a>{/if}</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="notifications">{$i18n.title.notifications}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="notifications">{$i18n.title.notifications}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.notifications.control} <span id="notifications_doc"><a href="https://www.anuko.com/lp/tt_45.htm" target="_blank">{$i18n.label.what_is_it}</a></span><span id="notifications_conf">{if $user_exists && $user->isPluginEnabled('no')}<a href="notifications.php">{$i18n.label.configure}</a>{/if}</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="locking">{$i18n.title.locking}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="locking">{$i18n.title.locking}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.locking.control} <span id="locking_conf">{if $user->isPluginEnabled('lk')}<a href="locking.php">{$i18n.label.configure}</a>{/if}</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="quotas">{$i18n.label.monthly_quotas}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="quotas">{$i18n.label.monthly_quotas}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.quotas.control} <span id="quotas_conf">{if $user->isPluginEnabled('mq')}<a href="quotas.php">{$i18n.label.configure}</a>{/if}</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="week_view">{$i18n.label.week_view}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="week_view">{$i18n.label.week_view}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.week_view.control} <span id="week_view_conf">{if $user->isPluginEnabled('wv')}<a href="week_view.php">{$i18n.label.configure}</a>{/if}</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="work_units">{$i18n.label.work_units}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="work_units">{$i18n.label.work_units}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.work_units.control} <span id="work_units_conf">{if $user->isPluginEnabled('wu')}<a href="work_units.php">{$i18n.label.configure}</a>{/if}</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="approval">{$i18n.label.approval}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="approval">{$i18n.label.approval}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.approval.control} <a href="https://www.anuko.com/lp/tt_28.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="timesheets">{$i18n.title.timesheets}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="timesheets">{$i18n.title.timesheets}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.timesheets.control} <a href="https://www.anuko.com/lp/tt_30.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="templates">{$i18n.title.templates}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="templates">{$i18n.title.templates}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.templates.control} <span id="templates_doc"><a href="https://www.anuko.com/lp/tt_29.htm" target="_blank">{$i18n.label.what_is_it}</a></span> <span id="templates_conf">{if $user->isPluginEnabled('tp')}<a href="templates.php">{$i18n.label.configure}</a>{/if}</span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="attachments">{$i18n.label.attachments}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="attachments">{$i18n.label.attachments}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.attachments.control} <span id="attachments_doc"><a href="https://www.anuko.com/lp/tt_31.htm" target="_blank">{$i18n.label.what_is_it}</a></span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="work">{$i18n.title.work}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="work">{$i18n.title.work}:</label></td>
    <td class="td-with-input">{$forms.pluginsForm.work.control} <span id="work_doc"><a href="https://www.anuko.com/lp/tt_34.htm" target="_blank">{$i18n.label.what_is_it}</a></span></td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</table>
<div class="button-set">{$forms.pluginsForm.btn_save.control}</div>
{$forms.pluginsForm.close}
