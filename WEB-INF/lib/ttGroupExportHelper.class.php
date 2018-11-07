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

// ttGroupExportHelper - this class is used to write data for a single group
// to a file. When group contains other groups, it reuses itself recursively.
//
// Currently, it is work in progress.
// When done, it should handle export of organizations containing multiple groups.
class ttGroupExportHelper {

  var $group_id = null;     // Group we are exporting.
  var $file     = null;     // File to write to.
  var $indentation = null;  // A string consisting of a number of spaces.
  var $subgroups = array(); // Immediate subgroups.

  // The following arrays are maps between entity ids in the file versus the database.
  // We write to the file sequentially (1,2,3...) while in the database the entities have different ids.
  var $userMap   = array(); // User ids.
  var $roleMap   = array(); // Role ids.
  var $clientMap = array(); // Client ids.

  // Constructor.
  function __construct($group_id, $file, $indentation) {
    global $user;

    $this->group_id = $group_id;
    $this->file = $file;
    $this->indentation = $indentation;

    // Build a list of subgroups.
    $mdb2 = getConnection();
    $sql =  "select id from tt_groups".
            " where status = 1 and parent_id = $this->group_id and org_id = $user->org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $this->subgroups[] = $val;
      }
    }
  }

  // getGroupData obtains group attributes for export.
  function getGroupData() {
    global $user;
    $mdb2 = getConnection();

    $sql =  "select name, currency, lang from tt_groups".
            " where status = 1 and id = $this->group_id and org_id = $user->org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
    }
    return $val;
  }

  // The getUsers obtains all users in group for the purpose of export.
  function getUsers() {
    global $user;
    $mdb2 = getConnection();

    $sql = "select u.*, r.rank from tt_users u left join tt_roles r on (u.role_id = r.id)".
      " where u.group_id = $this->group_id and u.org_id = $user->org_id order by upper(u.name)"; // Note: deleted users are included.
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // getRoles - obtains all roles defined for group.
  function getRoles() {
    global $user;
    $mdb2 = getConnection();

    $result = array();
    $sql = "select * from tt_roles where group_id = $this->group_id and org_id = $user->org_id";
    $res = $mdb2->query($sql);
    $result = array();
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
      return $result;
    }
    return false;
  }

  // writeData writes group data into file.
  function writeData() {

    // Write group info.
    $group = $this->getGroupData();
    $group_part = "<group name=\"".htmlentities($group['name'])."\"";
    $group_part .= " currency=\"".htmlentities($group['currency'])."\"";
    $group_part .= " lang=\"".$group['lang']."\"";
    // TODO: add other group attributes here.
    $group_part .= ">\n";

    // Write group info.
    fwrite($this->file, $this->indentation.$group_part);

    // Prepare user map.
    $users = $this->getUsers();
    foreach ($users as $key=>$user_item)
      $this->userMap[$user_item['id']] = $key + 1;

    // Prepare role map.
    $roles = $this->getRoles();
    foreach ($roles as $key=>$role_item)
      $this->roleMap[$role_item['id']] = $key + 1;

    // Prepare client map.
    $clients = ttTeamHelper::getAllClients($this->group_id, true);
    foreach ($clients as $key=>$client_item)
      $this->clientMap[$client_item['id']] = $key + 1;

    // Write users.
    fwrite($this->file, $this->indentation."<users>\n");
    foreach ($users as $user_item) {
      $role_id = $user_item['rank'] == 512 ? 0 : $this->roleMap[$user_item['role_id']]; // Special role_id 0 (not null) for top manager.
      $user_part = $this->indentation.'  '."<user id=\"".$this->userMap[$user_item['id']]."\"";
      $user_part .= " name=\"".htmlentities($user_item['name'])."\"";
      $user_part .= " login=\"".htmlentities($user_item['login'])."\"";
      $user_part .= " password=\"".$user_item['password']."\"";
      $user_part .= " role_id=\"".$role_id."\"";
      $user_part .= " client_id=\"".$this->clientMap[$user_item['client_id']]."\"";
      $user_part .= " rate=\"".$user_item['rate']."\"";
      $user_part .= " email=\"".$user_item['email']."\"";
      $user_part .= " status=\"".$user_item['status']."\"";
      $user_part .= "></user>\n";
      fwrite($this->file, $user_part);
    }
    fwrite($this->file, $this->indentation."</users>\n");

    // Call self recursively for all subgroups.
    foreach ($this->subgroups as $subgroup) {
      $subgroup_helper = new ttGroupExportHelper($subgroup['id'], $this->file, $this->indentation.'  ');
      $subgroup_helper->writeData();
    }

    fwrite($this->file, $this->indentation."</group>\n");
  }
}
