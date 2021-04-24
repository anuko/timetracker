<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Class ttClientHelper is used to help with client related tasks.
class ttClientHelper {

  // The getClient looks up a client by id.
  static function getClient($client_id, $all_fields = false) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = 'select ';
    if ($all_fields)
      $sql .= '* ';
    else
      $sql .= 'name ';

    $sql .= "from tt_clients where group_id = $group_id and org_id = $org_id".
      " and id = $client_id and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val;
    }
    return false;
  }

  // getClients - returns an array of active and inactive clients in a group.
  static function getClients() {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();

    $sql = "select id, name, projects from tt_clients where group_id = $group_id and org_id = $org_id and (status = 0 or status = 1) order by upper(name)";
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
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_clients where group_id = $group_id and org_id = $org_id".
      " and name = ".$mdb2->quote($client_name)." and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if (isset($val['id']) && $val['id'] > 0) {
        return $val;
      }
    }
    return false;
  }

  // The getDeletedClient looks up a deleted client by id.
  static function getDeletedClient($client_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select name, address from tt_clients where group_id = $group_id and org_id = $org_id".
      " and id = $client_id and status is NULL";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      return $val;
    }
    return false;
  }

  // The delete function marks client as deleded.
  static function delete($id, $delete_client_entries) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Handle custom field log records.
    if ($delete_client_entries) {
      $sql = "update tt_custom_field_log set status = null".
        " where log_id in (select id from tt_log where client_id = $id and status = 1) and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }

    // Handle time records.
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;
    if ($delete_client_entries) {
      $sql = 'update tt_log set status = null'.$modified_part.
        " where client_id = $id and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }

    // Handle expense items.
    if ($delete_client_entries) {
      $sql = 'update tt_expense_items set status = null'.$modified_part.
        " where client_id = $id and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }

    // Handle invoices.
    if ($delete_client_entries) {
      $sql = "update tt_invoices set status = null".
        " where client_id = $id and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }

    // Delete project binds to this client.
    $sql = "delete from tt_client_project_binds".
      " where client_id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Handle users for client.
    $sql = 'update tt_users set status = null'.$modified_part.
      " where client_id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Mark client deleted.
    $sql = "update tt_clients set status = null".
      " where id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // The insert function inserts a new client record into the clients table.
  static function insert($fields)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $name = $fields['name'];
    $address = $fields['address'];
    $tax = $fields['tax'];
    $projects = $fields['projects'];
    $comma_separated = null;
    if ($projects)
      $comma_separated = implode(',', $projects); // This is a comma-separated list of associated projects ids.
    $status = $fields['status'];

    $tax = str_replace(',', '.', $tax);
    if ($tax == '') $tax = 0;

    $sql = "insert into tt_clients (group_id, org_id, name, address, tax, projects, status)".
      " values ($group_id, $org_id, ".$mdb2->quote($name).", ".$mdb2->quote($address).", $tax, ".$mdb2->quote($comma_separated).", ".$mdb2->quote($status).")";

    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_clients', 'id');
    if (isset($projects) && count($projects) > 0)
      foreach ($projects as $p_id) {
        $sql = "insert into tt_client_project_binds (client_id, project_id, group_id, org_id) values($last_id, $p_id, $group_id, $org_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }

    return $last_id;
  }

  // The update function updates a client record in tt_clients table.  
  static function update($fields)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $id = $fields['id'];
    $name = $fields['name'];
    $address = $fields['address'];
    $tax = $fields['tax'];
    $status = $fields['status'];
    $projects = isset($fields['projects']) ? $fields['projects'] : array();

    $tax = str_replace(',', '.', $tax);
    if ($tax == '') $tax = 0;

    // Insert client to project binds into tt_client_project_binds table.
    $sql = "delete from tt_client_project_binds".
      " where client_id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      die($affected->getMessage());
    if (count($projects) > 0)
      foreach ($projects as $p_id) {
        $sql = "insert into tt_client_project_binds (client_id, project_id, group_id, org_id) values($id, $p_id, $group_id, $org_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }

    // Update client properties in tt_clients table.
    $comma_separated = implode(",", $projects); // This is a comma-separated list of associated project ids.
    $sql = "update tt_clients set name = ".$mdb2->quote($name).", address = ".$mdb2->quote($address).
      ", tax = $tax, projects = ".$mdb2->quote($comma_separated).", status = $status".
      " where id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
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
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();

    // Do a query with inner join to get assigned projects.
    $sql = "select p.id, p.name from tt_projects p".
      " inner join tt_client_project_binds cpb on (cpb.client_id = $client_id and cpb.project_id = p.id)".
      " where p.group_id = $group_id and p.org_id = $org_id and p.status = 1 order by p.name";
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
    $mdb2 = getConnection();

    $user_id = $user->getUser();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();

    $sql = "select distinct c.id, c.name, c.projects from tt_user_project_binds upb".
      " inner join tt_client_project_binds cpb on (cpb.project_id = upb.project_id)".
      " inner join tt_clients c on (c.id = cpb.client_id and c.status = 1)".
      " where upb.user_id = $user_id and upb.group_id = $group_id and upb.org_id = $org_id".
      " and upb.status = 1 order by upper(c.name)";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
      	$result[] = $val;
      }
    }
    return $result;
  }

  // deleteProject - deletes a project from the projects field it tt_clients table
  // for all clients in a group.
  static function deleteProject($project_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_clients".
      " where projects like '%$project_id%'".
      " and group_id = $group_id and org_id = $org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        if (!ttClientHelper::deleteProjectFromClient($project_id, $val['id']))
          return false;
      }
    }
    return true;
  }

  // deleteProjectFromClient - deletes a project from the projects field in tt_clients table
  // for a single client in a group.
  static function deleteProjectFromClient($project_id, $client_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select projects from tt_clients".
      " where id = $client_id and group_id = $group_id and org_id = $org_id";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;
    $val = $res->fetchRow();
    $projects = explode(',', $val['projects']);
    if (($key = array_search($project_id, $projects)) !== false) {
      unset($projects[$key]);
    }
    $comma_separated = implode(',', $projects);
    $sql = "update tt_clients set projects = ".$mdb2->quote($comma_separated).
      " where id = $client_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
}
