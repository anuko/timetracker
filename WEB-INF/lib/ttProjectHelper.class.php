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

import('ttUserHelper');
import('ttGroupHelper');
import('ttClientHelper');

// Class ttProjectHelper is used to help with project related tasks.
class ttProjectHelper {
	
  // getAssignedProjects - returns an array of assigned projects.
  static function getAssignedProjects($user_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    // Do a query with inner join to get assigned projects.
    $sql = "select p.id, p.name, p.tasks, upb.rate from tt_projects p".
      " inner join tt_user_project_binds upb on (upb.user_id = $user_id and upb.project_id = p.id and upb.status = 1)".
      " where p.group_id = $group_id and p.org_id = $org_id and p.status = 1 order by upper(p.name)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getRates - returns an array of project rates for user, including deassigned and deactivated projects.
  static function getRates($user_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    $sql = "select p.id, upb.rate from tt_projects p".
      " inner join tt_user_project_binds upb on (upb.user_id = $user_id and upb.project_id = p.id)".
      " where p.group_id = $group_id and p.org_id = $org_id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $val['rate'] = str_replace('.', $user->getDecimalMark(), $val['rate']);
        $result[] = $val;
      }
    }
    return $result;
  }
  
  // getProjects - returns an array of active and inactive projects in group.
  static function getProjects() {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    $sql = "select id, name, tasks from tt_projects".
      " where group_id = $group_id and org_id = $org_id and (status = 0 or status = 1) order by upper(name)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // getProjectsForClient - returns an array of active and inactive projects in a group for a client.
  static function getProjectsForClient() {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    $sql = "select p.id, p.name, p.tasks from tt_projects p".
      " inner join tt_client_project_binds cpb on (cpb.client_id = $user->client_id and cpb.project_id = p.id)".
      " where p.group_id = $group_id and p.org_id = $org_id and (p.status = 0 or p.status = 1)".
      " order by upper(p.name)";

    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // get - gets details of the project identified by its id. 
  static function get($id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, name, description, status, tasks from tt_projects".
      " where id = $id and group_id = $group_id and org_id = $org_id and (status = 0 or status = 1)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val && $val['id'])
        return $val;
    }
    return false;
  }

  // The getProjectByName looks up a project by name.
  static function getProjectByName($name) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_projects".
      " where group_id = $group_id and org_id = $org_id and name = ".$mdb2->quote($name).
      " and (status = 1 or status = 0)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val && $val['id'])
        return $val;
    }
    return false;
  }
  
  
  // delete - deletes things associated with a project and marks the project as deleted. 
  static function delete($id) {
    global $user;
    $mdb2 = getConnection();

    // Delete associated files.
    if ($user->isPluginEnabled('at')) {
      import('ttFileHelper');
      global $err;
      $fileHelper = new ttFileHelper($err);
      if (!$fileHelper->deleteEntityFiles($id, 'project'))
        return false;
    }

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Start with project itself. Reason: if the passed in project_id is bogus,
    // we'll fail right here and don't damage any other data.

    // Mark project as deleted and remove associated tasks.
    $sql = "update tt_projects set status = NULL, tasks = NULL where id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error') || 0 == $affected)
      return false; // An error ocurred, or 0 rows updated.

    // Delete user binds to this project.
    $sql = "delete from tt_user_project_binds where project_id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Delete task binds to this project.
    $sql = "delete from tt_project_task_binds where project_id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Delete client binds to this project.
    $sql = "delete from tt_client_project_binds where project_id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Delete template binds to this project.
    $sql = "delete from tt_project_template_binds where project_id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Finally, delete the project from the projects field in tt_clients table.
    $result = ttClientHelper::deleteProject($id);
    return $result;
  }
  
  // insert function inserts a new project into database.
  static function insert($fields)
  {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $name = $fields['name'];
    $description = $fields['description'];
    $users = $fields['users'];
    $tasks = $fields['tasks'];
    $comma_separated = implode(',', $tasks); // This is a comma-separated list of associated task ids.
    $status = $fields['status'];
    
    $sql = "insert into tt_projects (group_id, org_id, name, description, tasks, status)".
      " values ($group_id, $org_id, ".$mdb2->quote($name).", ".$mdb2->quote($description).", ".$mdb2->quote($comma_separated).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_projects', 'id');

    // Bind the project to users.
    $active_users = ttGroupHelper::getActiveUsers(array('getAllFields'=>true));
    foreach ($active_users as $u) {
      if(in_array($u['id'], $users)) {
        $sql = "insert into tt_user_project_binds (project_id, user_id, group_id, org_id, status, rate) values(
          $last_id, ".$u['id'].", $group_id, $org_id, 1, ".$u['rate'].")";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }
    }

    // Bind the project to tasks in tt_project_task_binds table.
    $active_tasks = ttGroupHelper::getActiveTasks();
    foreach ($active_tasks as $task) {
      if(in_array($task['id'], $tasks)) {
        $sql = "insert into tt_project_task_binds (project_id, task_id, group_id, org_id)".
          " values($last_id, ".$task['id'].", $group_id, $org_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }
    }

    return $last_id;
  } 

  // update function - updates the project in database.
  static function update($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $project_id = $fields['id']; // Project we are updating.
    $name = $fields['name']; // Project name.
    $description = $fields['description']; // Project description.
    $users_to_bind = $fields['users']; // Users to bind with project.
    $tasks_to_bind = $fields['tasks']; // Tasks to bind with project.
    $status = $fields['status']; // Project status.
    
    // Update records in tt_user_project_binds table.
    // This logic is complicated because these binds have rates associated with them.
    // We try to recover old rates if a bind existed before and is now reactivated.
    $sql = "select user_id, status from tt_user_project_binds".
      " where project_id = $project_id and group_id = $group_id and org_id = $org_id";
    $all_users = array();
    $users_to_update = array();
    $res2 = $mdb2->query($sql);
    while ($row = $res2->fetchRow()) {
      if(!in_array($row['user_id'], $users_to_bind)) { 
      	// Delete tt_user_project_binds record (safely).
      	ttUserHelper::deleteBind($row['user_id'], $project_id);
      } elseif (!$row['status']) {
        // If we are here, status of the bind is not active. Memorize such users to activate their bind status.
        $users_to_update[] = $row['user_id'];  // Users we need to update in tt_user_project_binds.
      }
      $all_users[] = $row['user_id']; // All users from tt_user_project_binds for project.
    }
    // Insert records.
    $users_to_add = array_diff($users_to_bind, $all_users); // Users missing from tt_user_project_binds, that we need to insert.
    if(count($users_to_add) > 0) {
      $sql = "select id, rate from tt_users".
        " where id in (".join(', ', $users_to_add).") and group_id = $group_id and org_id = $org_id";
      $res = $mdb2->query($sql);
      while ($row = $res->fetchRow()) {
        $user_rate[$row['id']] = $row['rate'];
      }
      foreach ($users_to_add as $id) {
        $sql = "insert into tt_user_project_binds (user_id, project_id, group_id, org_id, rate, status)".
          " values($id, $project_id, $group_id, $org_id, ".$user_rate[$id].", 1)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }
    }
    // Update status (to active) in existing tt_user_project_binds records.
    if ($users_to_update) {
      $sql = "update tt_user_project_binds set status = 1".
        " where project_id = $project_id and user_id in (".join(', ', $users_to_update).") and group_id = $group_id and org_id = $org_id";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }
    // End of updating tt_user_project_binds table.

    // Update records in tt_project_task_binds table by deleting and inserting.
    $sql = "delete from tt_project_task_binds".
      " where project_id = $project_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    foreach ($tasks_to_bind as $task_id) {
      $sql = "insert into tt_project_task_binds (project_id, task_id, group_id, org_id)".
        " values($project_id, $task_id, $group_id, $org_id)";
      $affected = $mdb2->exec($sql);
      if (is_a($affected, 'PEAR_Error'))
        return false;
    }
    // End of updating tt_project_task_binds table.
    
    // Update project name, description, tasks and status in tt_projects table.
    $comma_separated = implode(",", $tasks_to_bind); // This is a comma-separated list of associated task ids.
    $sql = "update tt_projects set name = ".$mdb2->quote($name).", description = ".$mdb2->quote($description).
      ", tasks = ".$mdb2->quote($comma_separated).", status = ".$mdb2->quote($status).
      " where id = $project_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // getAssignedUsers - returns an array of user ids assigned to a project.
  static function getAssignedUsers($project_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    $sql = "select user_id from tt_user_project_binds".
      " where project_id = $project_id and group_id = $group_id and org_id = $org_id and status = 1";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error')) return false;
    while ($row = $res->fetchRow()) {
      $result[] = $row['user_id'];
    }
    return $result;
  }
}
