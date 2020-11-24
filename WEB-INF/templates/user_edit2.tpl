<script>
// Prepare an array of available roles. We need it for "is_client" property.
// It is used to selectively display client selector for client roles.
roles = new Array();
var idx = 0;
{foreach $active_roles as $active_role}
roles[idx] = new Array({$active_role.id}, '{$active_role.is_client}');
idx++;
{/foreach}

// Prepare an array of rates.
// Format: project_rates[0] = Array(100, '25.00'), project_rates[1] = Array(120, '30.00'), etc...
// First element = project_id, second element = rate for project. Quotes needed for string representation of rates.
project_rates = new Array();
var idx = 0;
{foreach $rates as $rate}
project_rates[idx] = new Array({$rate.id}, '{$rate.rate}');
idx++;
{/foreach}

// getRate - returns a rate for the project. If rate was set for user previously we'll get this old rate
// if project time entries for user exists. Otherwise return user default rate.
function getRate(project_id) {
  var length = project_rates.length;
  for(var i = 0; i < length; i++) {
    if(project_rates[i][0] == project_id) {
      return project_rates[i][1];
    }
  }
  var default_rate = document.userForm.rate.value;
  return default_rate;
}

// The setRate function sets / unsets user rate for a project when a corresponding checkbox is ticked.
function setRate(element) {
  var default_rate = document.userForm.rate.value;
  if (default_rate == '') {
    // No default rate, nothing to do!
    return;
  }
  // Iterate through elements of the form to find and set the project rate.
  for (var i = 0; i < userForm.elements.length; i++) {
    if ((userForm.elements[i].type == 'text') && (userForm.elements[i].name == ('rate_'+element.value))) {
      if (element.checked) {
        userForm.elements[i].value = getRate(element.value);
      } else {
        userForm.elements[i].value = '';
      }
      break; // Element is found and set, nothing more to do, break out of the loop.
    }
  }
}

// handleClientRole - manages visibility and content of controls related to client role,
// also hides and unselects projects when client role is selected.
function handleClientRole() {
  var selectedRoleId = document.getElementById("role").value;
  var clientControl = document.getElementById("client");
  var clientBlock = document.getElementById("client_block");
  var nonClientBlock = document.getElementById("non_client_block");
  var projectsControl = document.getElementById("projects_control");

  var len = roles.length;
  for (var i = 0; i < len; i++) {
    if (selectedRoleId == roles[i][0]) {
      var isClient = roles[i][1];
      if (isClient == 1) {
        clientBlock.style.display = "";
        nonClientBlock.style.display = "none";
        projectsControl.style.display = "none";

        // Uncheck all project checkboxes.
        var checkboxes = document.getElementsByName("projects[]");
        var j;
        for (j = 0; j < checkboxes.length; j++) {
          checkboxes[j].checked = false;
        }
      } else {
        clientControl.value = "";
        clientBlock.style.display = "none";
        nonClientBlock.style.display = "";
        projectsControl.style.display = "";
      }
      break;
    }
  }
}
</script>

{$forms.userForm.open}
<table class="centered-table">
  <tr class = "small-screen-label"><td><label for="name">{$i18n.label.person_name} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="name">{$i18n.label.person_name} (*):</label></td>
    <td class="td-with-input">{$forms.userForm.name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="login">{$i18n.label.login} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="login">{$i18n.label.login} (*):</label></td>
    <td class="td-with-input">{$forms.userForm.login.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{if !$auth_external}
  <tr class = "small-screen-label"><td><label for="pas1">{$i18n.label.password} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="pas1">{$i18n.label.password} (*):</label></td>
    <td class="td-with-input">{$forms.userForm.pas1.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  <tr class = "small-screen-label"><td><label for="pas2">{$i18n.label.confirm_password} (*):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="pas2">{$i18n.label.confirm_password} (*):</label></td>
    <td class="td-with-input">{$forms.userForm.pas2.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
  <tr class = "small-screen-label"><td><label for="email">{$i18n.label.email}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="email">{$i18n.label.email}:</label></td>
    <td class="td-with-input">{$forms.userForm.email.control}</td>
  </tr>
{if $user->id != $user_id}
  <tr class = "small-screen-label"><td><label for="role">{$i18n.form.users.role}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="role">{$i18n.form.users.role}:</label></td>
    <td class="td-with-input">{$forms.userForm.role.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
<tbody id="client_block">
  <tr class = "small-screen-label"><td><label for="role">{$i18n.label.client}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="client">{$i18n.label.client} (*):</label></td>
    <td class="td-with-input">{$forms.userForm.client.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</tbody>
  <tr class = "small-screen-label"><td><label for="status">{$i18n.label.status}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="status">{$i18n.label.status}:</label></td>
    <td class="td-with-input">{$forms.userForm.status.control}</td>
  </tr>
  <tr><td><div class="small-screenform-control-separator"></div></td></tr>
{/if}
{if $user->id == $user_id}
  <tr class = "small-screen-label"><td><label for="role">{$i18n.form.users.role}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="role">{$i18n.form.users.role}:</label></td>
    <td class="text-cell">{$user->role_name} {if $can_swap}<a href="swap_roles.php">{$i18n.form.user_edit.swap_roles}</a>{/if}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
<tbody id="non_client_block">
{if $show_quota}
  <tr class = "small-screen-label"><td><label for="quota_percent">{$i18n.label.quota}&nbsp;(%):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="quota_percent">{$i18n.label.quota}&nbsp;(%):</label></td>
    <td class="td-with-input">{$forms.userForm.quota_percent.control}
      <span class="what-is-it-img"><a href="https://www.anuko.com/lp/tt_27.htm" target="_blank"><img src="img/icon-question-mark.png" title="{$i18n.label.what_is_it}" alt="{$i18n.label.what_is_it}"></a></span>
      <span class="what-is-it-text"><a href="https://www.anuko.com/lp/tt_27.htm" target="_blank">{$i18n.label.what_is_it}</a></span>
    </td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
{/if}
{if $custom_fields && $custom_fields->userFields}
  {foreach $custom_fields->userFields as $userField}
        {assign var="control_name" value='user_field_'|cat:$userField['id']}
  <tr class = "small-screen-label"><td><label for="{$control_name}">{$userField['label']|escape}{if $userField['required']} (*){/if}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="{$control_name}">{$userField['label']|escape}{if $userField['required']} (*){/if}:</label></td>
    <td class="td-with-input">{$forms.userForm.$control_name.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
  {/foreach}
{/if}
  <tr class = "small-screen-label"><td><label for="rate">{$i18n.form.users.default_rate}&nbsp;(0{$user->getDecimalMark()}00):</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="rate">{$i18n.form.users.default_rate}&nbsp;(0{$user->getDecimalMark()}00):</label></td>
    <td class="td-with-input">{$forms.userForm.rate.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</tbody>
{if $show_projects}
<tbody id="projects_control">
  <tr class = "small-screen-label"><td><label for="projects">{$i18n.label.projects}:</label></td></tr>
  <tr>
    <td class="large-screen-label"><label for="projects">{$i18n.label.projects}:</label></td>
    <td class="td-with-input">{$forms.userForm.projects.control}</td>
  </tr>
  <tr><td><div class="small-screen-form-control-separator"></div></td></tr>
</tbody>
{/if}
  <tr><td colspan="2">{$i18n.label.required_fields}</td></tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
  <tr>
    <td colspan="2">{$forms.userForm.btn_submit.control}</td>
  </tr>
  <tr><td><div class="form-control-separator"></div></td></tr>
</table>
{$forms.userForm.close}
