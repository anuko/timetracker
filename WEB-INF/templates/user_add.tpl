<script>
// Prepare an array of available roles. We need it for "is_client" property.
// It is used to selectively display client selector for client roles.
roles = new Array();
var idx = 0;
{foreach $active_roles as $active_role}
roles[idx] = new Array({$active_role.id}, '{$active_role.is_client}');
idx++;
{/foreach}

// The setDefaultRate function sets / unsets default rate for a project
// when a corresponding checkbox is ticked.
function setDefaultRate(element) {
  var default_rate = document.userForm.rate.value;
  if (default_rate == '') {
    // No default rate, nothing to do!
    return;
  }
  // Iterate through elements of the form to find and set the project rate. 
  for (var i = 0; i < userForm.elements.length; i++) {
    if ((userForm.elements[i].type == 'text') && (userForm.elements[i].name == ('rate_'+element.value))) {
      if (element.checked) {
        userForm.elements[i].value = default_rate;
      } else {
        userForm.elements[i].value = '';
      }
      break; // Element is found and set, nothing more to do, break out of the loop.
    }
  }
}

// handleClientControl - controls visibility of the client dropdown depending on the selected user role.
// We need to show it only when the "Client" user role is selected.
function handleClientControl() {
  var selectedRoleId = document.getElementById("role").value;
  var clientControl = document.getElementById("client");
  var len = roles.length;
  for (var i = 0; i < len; i++) {
    if (selectedRoleId == roles[i][0]) {
      var isClient = roles[i][1];
      if (isClient == 1)
        clientControl.style.visibility = "visible";
      else
        clientControl.style.visibility = "hidden";
      break;
    }
  }
}
</script>

{$forms.userForm.open}
<table cellspacing="4" cellpadding="7" border="0">
  <table cellspacing="1" cellpadding="2" border="0">
    <tr>
      <td align="right">{$i18n.label.person_name} (*):</td>
      <td>{$forms.userForm.name.control}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.label.login} (*):</td>
      <td>{$forms.userForm.login.control}</td>
    </tr>
{if !$auth_external}
    <tr>
      <td align="right">{$i18n.label.password} (*):</td>
      <td>{$forms.userForm.pas1.control}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.label.confirm_password} (*):</td>
      <td>{$forms.userForm.pas2.control}</td>
    </tr>
{/if}
    <tr>
      <td align="right" nowrap>{$i18n.label.email}:</td>
      <td>{$forms.userForm.email.control}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.form.users.role}:</td>
      <td>{$forms.userForm.role.control} {$forms.userForm.client.control}</td>
    </tr>
    <tr>
      <td align="right">{$i18n.form.users.default_rate}&nbsp;(0{$user->decimal_mark}00):</td>
      <td>{$forms.userForm.rate.control}</td>
    </tr>
{if ($smarty.const.MODE_PROJECTS == $user->tracking_mode || $smarty.const.MODE_PROJECTS_AND_TASKS == $user->tracking_mode)}
    <tr valign="top">
      <td align="right">{$i18n.label.projects}:</td>
      <td>{$forms.userForm.projects.control}</td>
    </tr>
    <tr>
      <td colspan="2" align="center">{$i18n.label.required_fields}</td>
    </tr>
{/if}
    <tr>
      <td colspan="2" align="center" height="50">{$forms.userForm.btn_submit.control}</td>
    </tr>
  </table>
</table>
{$forms.userForm.close}
