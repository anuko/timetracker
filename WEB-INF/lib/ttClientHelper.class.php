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

// Class ttClientHelper is used to help with client related tasks.
class ttClientHelper {

  // The getClient looks up a client by id.
  static function getClient($client_id, $all_fields = false) {

    $mdb2 = getConnection();
    global $user;

    $sql = 'select ';
    if ($all_fields)
      $sql .= '* ';
    else
      $sql .= 'name ';

    $sql .= "from tt_clients where group_id = $user->group_id
      and id = $client_id and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val;
    }
    return false;
  }

  // getClients - returns an array of active and inactive clients in a group.
  static function getClients()
  {
    global $user;

    $result = array();
    $mdb2 = getConnection();

    $sql = "select id, name from tt_clients
      where group_id = $user->group_id and (status = 0 or status = 1) order by upper(name)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // The getClientByName looks up a client by name.
  static function getClientByName($client_name) {

    $mdb2 = getConnection();
    global $user;

    $sql = "select id from tt_clients where group_id = $user->group_id and name = ".
      $mdb2->quote($client_name)." and (status = 1 or status = 0)";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['id']) {
        return $val;
      }
    }
    return false;
  }

  // The getDeletedClient looks up a deleted client by id.
  static function getDeletedClient($client_id) {

    $mdb2 = getConnection();
    global $user;

    $sql = "select name, address from tt_clients where group_id = $user->group_id
      and id = $client_id and status is NULL";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val;
    }
    return false;
  }

  // The delete function marks client as deleded.
  static function delete($id, $delete_client_entries) {

    $mdb2 = getConnection();
    global $user;

    // Handle custom field log records.
    if ($delete_client_entries) {
      $sql = "update tt_custom_field_log set status = NULL where log_id in (select id from tt_log where client_id = $id and status = 1)";
      $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
    }

    // Handle time records.
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$mdb2->quote($user->id);
    if ($delete_client_entries) {
      $sql = 'update tt_log set status = NULL'.$modified_part." where client_id = $id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }

    // Handle expense items.
    if ($delete_client_entries) {
      $sql = 'update tt_expense_items set status = NULL'.$modified_part." where client_id = $id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }

    // Handle invoices.
    if ($delete_client_entries) {
      $sql = "update tt_invoices set status = NULL where client_id = $id and group_id = $user->group_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }

    // Delete project binds to this client.
    $sql = "delete from tt_client_project_binds where client_id = $id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Handle users for client.
    $sql = 'update tt_users set status = NULL'.$modified_part." where client_id = $id and group_id = $user->group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Mark client deleted.
    $sql = "update tt_clients set status = NULL where id = $id and group_id = $user->group_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // The insert function inserts a new client record into the clients table.
  static function insert($fields)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $name = $fields['name'];
    $address = $fields['address'];
    $tax = $fields['tax'];
    $projects = $fields['projects'];
    if ($projects)
      $comma_separated = implode(',', $projects); // This is a comma-separated list of associated projects ids.
    $status = $fields['status'];

    $tax = str_replace(',', '.', $tax);
    if ($tax == '') $tax = 0;

    $sql = "insert into tt_clients (group_id, name, address, tax, projects, status)".
      " values ($group_id, ".$mdb2->quote($name).", ".$mdb2->quote($address).", $tax, ".$mdb2->quote($comma_separated).", ".$mdb2->quote($status).")";

    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = 0;
    $sql = "select last_insert_id() as last_insert_id";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    $last_id = $val['last_insert_id'];

    if (count($projects) > 0)
      foreach ($projects as $p_id) {
        $sql = "insert into tt_client_project_binds (client_id, project_id) values($last_id, $p_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }

    return $last_id;
  }

  // The update function updates a client record in tt_clients table.  
  static function update($fields)
  {
    $mdb2 = getConnection();
    global $user;

    $id = $fields['id'];
    $name = $fields['name'];
    $address = $fields['address'];
    $tax = $fields['tax'];
    $status = $fields['status'];
    $projects = $fields['projects'];

    $tax = str_replace(',', '.', $tax);
    if ($tax == '') $tax = 0;

    // Insert client to project binds into tt_client_project_binds table.
    $sql = "delete from tt_client_project_binds where client_id = $id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      die($affected->getMessage());
    if (count($projects) > 0)
      foreach ($projects as $p_id) {
        $sql = "insert into tt_client_project_binds (client_id, project_id) values($id, $p_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }

    // Update client properties in tt_clients table.
    $comma_separated = implode(",", $projects); // This is a comma-separated list of associated project ids.
    $sql = "update tt_clients set name = ".$mdb2->quote($name).", address = ".$mdb2->quote($address).
      ", tax = $tax, projects = ".$mdb2->quote($comma_separated).", status = $status where group_id = ".$user->group_id." and id = ".$id;
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // The setMappedClient function is used during group import to change client_id value for tt_users to a mapped value.
  static function setMappedClient($group_id, $imported_id, $mapped_id)
  {
    $mdb2 = getConnection();
    $sql = "update tt_users set client_id = $mapped_id where client_id = $imported_id and group_id = $group_id ";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // The fillBean function fills the ActionForm object with client data.
  static function fillBean($client_id, &$bean) {
    $client = ttClientHelper::getClient($client_id, true);
    $bean->setAttribute('name', $client['name']);
    $bean->setAttribute('address', $client['address']);
    $bean->setAttribute('tax', $client['tax']);
  }

  // getAssignedProjects - returns an array of projects associatied with a client.
  static function getAssignedProjects($client_id)
  {
    global $user;

    $result = array();
    $mdb2 = getConnection();

    // Do a query with inner join to get assigned projects.
    $sql = "select p.id, p.name from tt_projects p
      inner join tt_client_project_binds cpb on (cpb.client_id = $client_id and cpb.project_id = p.id)
      where p.group_id = $user->group_id and p.status = 1 order by p.name";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getClientsForUser - returns an array of clients that are relevant to a user via assigned projects. 
  static function getClientsForUser()
  {
    global $user;
    $user_id = $user->getActiveUser();

    $result = array();
    $mdb2 = getConnection();

    $sql = "select distinct c.id, c.name, c.projects from tt_user_project_binds upb
      inner join tt_client_project_binds cpb on (cpb.project_id = upb.project_id)
      inner join tt_clients c on (c.id = cpb.client_id and c.status = 1)
      where upb.user_id = $user_id and upb.status = 1 order by upper(c.name)";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
      	$result[] = $val;
      }
    }
    return $result;
  }

  // getAssignedProjectsForUser - returns an array of projects assigned to a user and associatied with a client.
  static function getAssignedProjectsForUser($client_id)
  {
    global $user;
    $user_id = $user->getActiveUser();

    $result = array();
    $mdb2 = getConnection();

    // Do a query with inner join to get assigned projects.
    $sql = "select p.id, p.name from tt_projects p
      inner join tt_client_project_binds cpb on (cpb.client_id = $client_id and cpb.project_id = p.id)
      inner join tt_user_project_binds upb on (upb.user_id = $user_id and upb.project_id = p.id and upb.status = 1)
      where p.group_id = $user->group_id and p.status = 1 order by p.name";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }
}
