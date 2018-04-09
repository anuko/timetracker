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

// Class ttTaskHelper is used to help with task related operations.
class ttTaskHelper {

  // get - gets details of a task identified by its id.
  static function get($id)
  {
    global $user;
 
    $mdb2 = getConnection();

    $sql = "select id, name, description, status from tt_tasks
      where id = $id and group_id = $user->group_id and (status = 0 or status = 1)";
    $res = $mdb2->query($sql);

    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
	  if ($val['id'] != '') {
        return $val;
      } else
        return false;
    }
    return false;
  }

  // getAssignedProjects - returns an array of projects associatied with a task.
  static function getAssignedProjects($task_id)
  {
  	global $user;
  	
    $result = array();
    $mdb2 = getConnection();
    
    // Do a query with inner join to get assigned projects.
    $sql = "select p.id, p.name from tt_projects p
      inner join tt_project_task_binds ptb on (ptb.project_id = p.id and ptb.task_id = $task_id)
      where p.group_id = $user->group_id and p.status = 1 order by p.name";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }
  
  // The getTaskByName looks up a task by name.
  static function getTaskByName($task_name) {
  	
    $mdb2 = getConnection();
    global $user;

    $sql = "select id from tt_tasks where group_id = $user->group_id and name = ".
      $mdb2->quote($task_name)." and (status = 1 or status = 0)";
      $res = $mdb2->query($sql);

      if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val['id'])
        return $val;
    }
    return false;
  }
 
  // delete - deletes things associated with a task and marks the task as deleted. 
  static function delete($task_id) {
    global $user;
  	    
    $mdb2 = getConnection();

    // Delete project binds to this task from tt_project_task_binds table.
    $sql = "delete from tt_project_task_binds where task_id = $task_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;
        
    // Delete project binds to this task from the tasks field in tt_projects table.
    // Get projects where tasks is not NULL.
    $sql = "select id, tasks from tt_projects where group_id = $user->group_id and tasks is not NULL";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error'))
      return false;
    while ($val = $res->fetchRow()) {
      $project_id = $val['id'];
      $tasks = explode(',', $val['tasks']);
      
      if (in_array($task_id, $tasks)) {
        // Remove task from array.
        unset($tasks[array_search($task_id, $tasks)]);
        $comma_separated = implode(',', $tasks); // This is a new comma-separated list of associated task ids.
      
        // Re-bind the project to tasks.
        $sql = "update tt_projects set tasks = ".$mdb2->quote($comma_separated)." where id = $project_id";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }
    }

    // Mark the task as deleted.
    $sql = "update tt_tasks set status = NULL where id = $task_id";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }
  
 // insert function inserts a new task into database.
  static function insert($fields)
  {
    $mdb2 = getConnection();

    $group_id = (int) $fields['group_id'];
    $name = $fields['name'];
    $description = $fields['description'];
    $projects = $fields['projects'];
    $status = $fields['status'];
        
    $sql = "insert into tt_tasks (group_id, name, description, status)
      values ($group_id, ".$mdb2->quote($name).", ".$mdb2->quote($description).", ".$mdb2->quote($status).")";
    $affected = $mdb2->exec($sql);
    $last_id = 0;
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $sql = "select last_insert_id() as last_insert_id";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    $last_id = $val['last_insert_id'];
    
    if (is_array($projects)) {
      foreach ($projects as $p_id) {
        // Insert task binds into tt_project_task_binds table.
        $sql = "insert into tt_project_task_binds (project_id, task_id) values($p_id, $last_id)";
        $affected = $mdb2->exec($sql);
   		if (is_a($affected, 'PEAR_Error'))
   		  return false;

   		// Add task bind to the tasks field of the tt_projects table.
        $sql = "select tasks from tt_projects where id = $p_id";
        $res = $mdb2->query($sql);
        if (is_a($res, 'PEAR_Error'))
          return false;

        $val = $res->fetchRow();
        $task_ids = $val['tasks'];
        if ($task_ids) {
		  $task_ids .= ",$last_id";
		  $task_ids = ttTaskHelper::sort($task_ids);
		} else
		  $task_ids = $last_id;

        $sql = "update tt_projects set tasks = ".$mdb2->quote($task_ids)." where id = $p_id";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
	  }
    }
    return $last_id;
  }
 
  // update function updates a task in the database.
  static function update($fields)
  {
    global $user;
  	    
    $mdb2 = getConnection();

    $task_id = (int)$fields['task_id'];
    $name = $fields['name'];
    $description = $fields['description'];
    $status = $fields['status'];
    $projects = $fields['projects'];

    $sql = "update tt_tasks set name = ".$mdb2->quote($name).", description = ".$mdb2->quote($description).
      ", status = $status where id = $task_id and group_id = $user->group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      die($affected->getMessage());
        
    // Insert task binds into tt_project_task_binds table.
    $sql = "delete from tt_project_task_binds where task_id = $task_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      die($affected->getMessage());
    if (count($projects) > 0)
      foreach ($projects as $p_id) {
        $sql = "insert into tt_project_task_binds (project_id, task_id) values($p_id, $task_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          die($affected->getMessage());
      }
      
    // Handle task binds in the tasks field of the tt_projects table.
    // We need to either delete or insert task id in all affected projects.
    
    // Get all not deleted projects for group.
    $sql = "select id, tasks from tt_projects where group_id = $user->group_id and status is not NULL";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error'))
      die($res->getMessage());
    
    // Iterate through projects.
    while ($val = $res->fetchRow()) {
      $project_id = $val['id'];
      $task_ids = $val['tasks'];
      $task_arr = explode(',', $task_ids);
      
      if (is_array($projects) && in_array($project_id, $projects)) {
      	// Task needs to be available for this project.
       	if (!in_array($task_id, $task_arr)) {
      	  if ($task_ids) {
            $task_ids .= ",$task_id";
            $task_ids = ttTaskHelper::sort($task_ids);
        } else
          $task_ids = $task_id;

        $sql = "update tt_projects set tasks = ".$mdb2->quote($task_ids)." where id = $project_id";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          die($affected->getMessage());
        }
      } else {
      	// Task needs to be removed from this project.
        if (in_array($task_id, $task_arr)) {
          // Remove task from array.
          unset($task_arr[array_search($task_id, $task_arr)]);
          $comma_separated = implode(",", $task_arr); // This is a comma-separated list of associated task ids.
      
          // Re-bind the project to tasks.
          $sql = "update tt_projects set tasks = ".$mdb2->quote($comma_separated)." where id = $project_id";
          $affected = $mdb2->exec($sql);
          if (is_a($affected, 'PEAR_Error'))
            die($affected->getMessage());
        }
      }
    }
    return true;
  }

  // sort function sorts task ids passed as comma-separated list by their name.
  static function sort($comma_separated) {
  	// We can't sort an empty string.
  	if (!$comma_separated)
  	  return $comma_separated;
  	  	  
    $mdb2 = getConnection();
      
	$sql = "select id, name from tt_tasks where id in ($comma_separated)";
    $res = $mdb2->query($sql);
    if (is_a($res, 'PEAR_Error'))
      die ($res->getMessage());
    
    $task_arr = array();
    while ($val = $res->fetchRow()) {
      $task_arr[] = array('id'=>$val['id'],'name'=>$val['name']);
    }
    $task_arr = mu_sort($task_arr, 'name');
    $task_ids = array();
    for($i = 0; $i < count($task_arr); $i++) {
	  $task_ids[] = $task_arr[$i]['id'];
    }
	$result = implode(',', $task_ids);
    return $result;
  }
}
