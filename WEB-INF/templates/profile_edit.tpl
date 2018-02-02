<script>
// handleTaskRequiredCheckbox - controls visibility of the Task Required checkbox.
function handleTaskRequiredCheckbox() {
  var taskRequiredCheckbox = document.getElementById("task_required");
  var taskRequiredLabel = document.getElementById("task_required_label");
  var trackingModeDropdown = document.getElementById("tracking_mode");
  if (trackingModeDropdown.value == 2) {
    taskRequiredCheckbox.style.visibility = "visible";
    taskRequiredLabel.style.visibility = "visible";
  } else {
    taskRequiredCheckbox.style.visibility = "hidden";
    taskRequiredLabel.style.visibility = "hidden";
  }
}


// handleControls - controls visibility of controls.
function handlePluginCheckboxes() {
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
  var configureLabel = document.getElementById("expenses_config");
  if (expensesCheckbox.checked) {
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }

  var customFieldsCheckbox = document.getElementById("custom_fields");
  configureLabel = document.getElementById("cf_config");
  if (customFieldsCheckbox.checked) {
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }

  var notificationsCheckbox = document.getElementById("notifications");
  configureLabel = document.getElementById("notifications_config");
  if (notificationsCheckbox.checked) {
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }

  var lockingCheckbox = document.getElementById("locking");
  configureLabel = document.getElementById("locking_config");
  if (lockingCheckbox.checked) {
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }
  
  var quotasCheckbox = document.getElementById("quotas");
  configureLabel = document.getElementById("quotas_config");
  if (quotasCheckbox.checked){
    configureLabel.style.visibility = "visible";
  } else {
    configureLabel.style.visibility = "hidden";
  }
}
</script>

{$forms.profileForm.open}

{if $user->canManageTeam()}
{include file="datetime_format_preview.tpl"}
{/if}

<table cellspacing="4" cellpadding="7" border="0">
    <tr>
      <td>
        <table cellspacing="1" cellpadding="2" border="0">
          <tr>
            <td align="right" nowrap>{$i18n.label.person_name} (*):</td>
            <td>{$forms.profileForm.name.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.login} (*):</td>
            <td>{$forms.profileForm.login.control}</td>
          </tr>
{if !$auth_external}
          <tr>
            <td align="right" nowrap>{$i18n.label.password} (*):</td>
            <td>{$forms.profileForm.password1.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.confirm_password} (*):</td>
            <td>{$forms.profileForm.password2.control}</td>
          </tr>
{/if}
          <tr>
            <td align="right" nowrap>{$i18n.label.email}:</td>
            <td>{$forms.profileForm.email.control}</td>
          </tr>
          <tr>
            <td></td>
            <td>{$i18n.label.required_fields}</td>
          </tr>

{if $user->canManageTeam()}
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.team_name}:</td>
            <td>{$forms.profileForm.team_name.control}</td>
          </tr>
          <tr>
            <td align="right">{$i18n.label.currency}:</td>
            <td>{$forms.profileForm.currency.control}</td>
          </tr>
          <tr>
           <td align="right" nowrap>{$i18n.label.language}:</td>
           <td>{$forms.profileForm.lang.control}</td>
          </tr>
          <tr>
            <td align="right">{$i18n.label.decimal_mark}:</td>
            <td>{$forms.profileForm.decimal_mark.control} <font id="decimal_preview" color="#777777">&nbsp;</font></td>
          <tr>
            <td align="right" nowrap>{$i18n.label.date_format}:</td>
            <td>{$forms.profileForm.date_format.control} <font id="date_format_preview" color="#777777">&nbsp;</font></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.time_format}:</td>
            <td>{$forms.profileForm.time_format.control} <font id="time_format_preview" color="#777777">&nbsp;</font></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.label.week_start}:</td>
            <td>{$forms.profileForm.start_week.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.profile.tracking_mode}:</td>
            <td>{$forms.profileForm.tracking_mode.control} {$forms.profileForm.task_required.control} <span id="task_required_label"><label for="task_required">{$i18n.label.required}</label></span></td></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.profile.record_type}:</td>
            <td>{$forms.profileForm.record_type.control}</td>
          </tr>
          <tr>
            <td align="right" nowrap>{$i18n.form.profile.uncompleted_indicators}:</td>
            <td>{$forms.profileForm.uncompleted_indicators.control}</td>
          </tr>
{if $user->isManager()}
          <tr>
            <td align="right" nowrap>{$i18n.label.bcc}:</td>
            <td>{$forms.profileForm.bcc_email.control} <a href="https://www.anuko.com/lp/tt_10.htm" target="_blank">{$i18n.label.what_is_it}</a></td>
          </tr>
{/if}
          {* initialize preview text *}
          <script>
            MakeFormatPreview("date_format_preview", document.getElementById("date_format"));
            MakeFormatPreview("time_format_preview", document.getElementById("time_format"));

            function adjustDecimalPreview()
            {
              var mark = document.getElementById("decimal_mark").value;
              var example = document.getElementById("decimal_preview");
              example.innerHTML = "<i>3"+mark+"14</i>";
            }
            adjustDecimalPreview();
          </script>

          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>

          <tr>
             <td colspan="2" class="sectionHeader">{$i18n.form.profile.plugins}</td>
          </tr>
          <tr><td>&nbsp;</td></tr>
          <tr>
            <td align="right" nowrap>{$forms.profileForm.charts.control}</td>
            <td><label for="charts">{$i18n.title.charts}</label></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$forms.profileForm.clients.control}</td>
            <td><label for="clients">{$i18n.title.clients}</label> {$forms.profileForm.client_required.control} <span id="client_required_label"><label for="client_required">{$i18n.label.required}</label></span></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$forms.profileForm.invoices.control}</td>
            <td><label for="invoices">{$i18n.title.invoices}</label></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$forms.profileForm.paid_status.control}</td>
            <td><label for="paid_status">{$i18n.label.paid_status}</label></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$forms.profileForm.custom_fields.control}</td>
            <td><label for="custom_fields">{$i18n.label.custom_fields}</label> <span id="cf_config"><a href="cf_custom_fields.php">{$i18n.label.configure}</a></span></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$forms.profileForm.expenses.control}</td>
            <td><label for="expenses">{$i18n.title.expenses}</label> {$forms.profileForm.tax_expenses.control} <span id="tax_label"><label for="tax_expenses">{$i18n.label.tax}</label></span> <span id="expenses_config"><a href="predefined_expenses.php">{$i18n.label.configure}</a></span></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$forms.profileForm.notifications.control}</td>
            <td><label for="notifications">{$i18n.title.notifications}</label> <span id="notifications_config"><a href="notifications.php">{$i18n.label.configure}</a></span></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$forms.profileForm.locking.control}</td>
            <td><label for="locking">{$i18n.title.locking}</label> <span id="locking_config"><a href="locking.php">{$i18n.label.configure}</a></span></td>
          </tr>
          <tr>
            <td align="right" nowrap>{$forms.profileForm.quotas.control}</td>
            <td><label for="quotas">{$i18n.label.monthly_quotas}</label> <span id="quotas_config"><a href="quotas.php">{$i18n.label.configure}</a></span></td>
          </tr>
  {if $smarty.const.WEEK_VIEW_DEBUG == 1}
          <tr>
            <td align="right" nowrap>{$forms.profileForm.week_view.control}</td>
            <td><label for="quotas">{$i18n.label.week_view}</label> <span id="week_view_config"><a href="week_view.php">{$i18n.label.configure}</a></span></td>
          </tr>
  {/if}
{/if}

          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" height="50" align="center">{$forms.profileForm.btn_save.control}</td>
          </tr>
        </table>
      </td>
    </tr>
</table>
{$forms.profileForm.close}
