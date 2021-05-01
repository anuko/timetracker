<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// Class ttTemplateHelper is used to help with template related tasks.
class ttTemplateHelper {

  // get - gets template details.
  static function get($id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, name, description, content, status from tt_templates".
      " where id = $id and group_id = $group_id and org_id = $org_id".
      " and status is not null";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val) {
        return $val;
      }
    }
    return false;
  }

  // delete - marks a template as deleted in tt_templates table in database.
  static function delete($id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;

    $sql = "update tt_templates set status = null".$modified_part.
      " where id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    // Delete project binds to this template.
    $sql = "delete from tt_project_template_binds where template_id = $id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      return false;

    return true;
  }

  // insert function inserts a new template into database.
  static function insert($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $name = $fields['name'];
    $description = $fields['description'];
    $content = $fields['content'];
    $projects = $fields['projects'];

    $created_part = ', now(), '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', '.$user->id;

    $sql = "insert into tt_templates (group_id, org_id, name, description, content,".
      " created, created_ip, created_by)".
      " values ($group_id, $org_id, ".$mdb2->quote($name).
      ", ".$mdb2->quote($description).", ".$mdb2->quote($content).$created_part.")";
    $affected = $mdb2->exec($sql);
    $last_id = 0;
    if (is_a($affected, 'PEAR_Error'))
      return false;

    $last_id = $mdb2->lastInsertID('tt_templates', 'id');

    if (is_array($projects)) {
      foreach ($projects as $p_id) {
        // Insert project binds into tt_project_template_binds table.
        $sql = "insert into tt_project_template_binds (project_id, template_id, group_id, org_id)".
          " values($p_id, $last_id, $group_id, $org_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          return false;
      }
    }
    return $last_id;
  }

  // update function - updates a template in database.
  static function update($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $template_id = (int) $fields['id'];
    $name = $fields['name'];
    $description = $fields['description'];
    $content = $fields['content'];
    $modified_part = ', modified = now(), modified_ip = '.$mdb2->quote($_SERVER['REMOTE_ADDR']).', modified_by = '.$user->id;
    $status = (int) $fields['status'];
    $projects = isset($fields['projects']) ? $fields['projects'] : array();

    $sql = "update tt_templates set name = ".$mdb2->quote($name).
      ", description = ".$mdb2->quote($description).
      ", content = ".$mdb2->quote($content).$modified_part.
      ", status = ".$status.
      " where id = $template_id and group_id = $group_id and org_id = $org_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      die($affected->getMessage());

    // Insert project binds into tt_project_template_binds table.
    $sql = "delete from tt_project_template_binds where template_id = $template_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error'))
      die($affected->getMessage());
    if (count($projects) > 0)
      foreach ($projects as $p_id) {
        $sql = "insert into tt_project_template_binds (project_id, template_id, group_id, org_id)".
          " values($p_id, $template_id, $group_id, $org_id)";
        $affected = $mdb2->exec($sql);
        if (is_a($affected, 'PEAR_Error'))
          die($affected->getMessage());
      }

    return true;
  }

  // getAssignedProjects - returns an array of projects associatied with a template.
  static function getAssignedProjects($template_id)
  {
    global $user;

    $result = array();
    $mdb2 = getConnection();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    // Do a query with inner join to get assigned projects.
    $sql = "select p.id, p.name from tt_projects p
      inner join tt_project_template_binds ptb on (ptb.project_id = p.id and ptb.template_id = $template_id)
      where p.group_id = $group_id and p.org_id = $org_id and p.status = 1 order by p.name";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

   // getAssignedTemplates - returns a comma-separated list of template ids assigned to a project.
  static function getAssignedTemplates($project_id)
  {
    global $user;

    $result = array();
    $mdb2 = getConnection();
    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select template_id from tt_project_template_binds
      where project_id = $project_id and group_id = $group_id and org_id = $org_id" ;
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val['template_id'];
      }
    }
    $comma_separated = implode(',', $result); // This is a comma-separated list of associated template ids.
    return $comma_separated;
  }
}
