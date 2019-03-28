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

// ttFileHelper class is used for attachment handling.
class ttFileHelper {
  var $errors = null;       // Errors go here. Set in constructor by reference.
  var $storage_uri = null;  // Location of file storage facility.
  var $register_uri = null; // URI to register with file storage facility.
  var $putfile_uri = null;  // URI to put file in file storage.
  var $getfile_uri = null;  // URI to get file from file storage.
  var $site_id = null;      // Site id for file storage.
  var $site_key = null;     // Site key for file storage.

  // Constructor.
  function __construct(&$errors) {
    $this->errors = &$errors;

    if (defined('FILE_STORAGE_URI')) {
      $this->storage_uri = FILE_STORAGE_URI;
      $this->register_uri = $this->storage_uri.'register';
      $this->putfile_uri = $this->storage_uri.'putfile';
      $this->getfile_uri = $this->storage_uri.'getfile';
      $this->checkSiteRegistration();
    }
  }

  // checkSiteRegistration - obtains site id and key from local database.
  // If not found, it tries to register with file storage facility.
  function checkSiteRegistration() {

    global $i18n;
    $mdb2 = getConnection();

    // Obtain site id.
    $sql = "select param_value as id from tt_site_config where param_name = 'locker_id'";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    if (!$val) {
      // No site id found, need to register.
      $fields = array('name' => urlencode('time tracker'),
        'origin' => urlencode('time tracker source'));

      // Urlify the data for the POST.
      foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
      $fields_string = rtrim($fields_string, '&');

      // Open connection.
      $ch = curl_init();

      // Set the url, number of POST vars, POST data.
      curl_setopt($ch, CURLOPT_URL, $this->register_uri);
      curl_setopt($ch, CURLOPT_POST, count($fields));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      // Execute a post request.
      $result = curl_exec($ch);

      // Close connection.
      curl_close($ch);

      $result_array = json_decode($result, true);
      if (!$result_array) {
        $this->errors->add($i18n->get('error.file_storage'));
      }
      else if ($result_array['error']) {
        // Add an error from file storage facility if we have it.
        $this->errors->add($result_array['error']);
      }
      else if ($result_array['id'] && $result_array['key']) {
        $this->site_id = $result_array['id'];
        $this->site_key = $result_array['key'];

        // Registration successful. Store id and key locally for future use.
        $sql = "insert into tt_site_config values('locker_id', $this->site_id, now(), null)";
        $mdb2->exec($sql);
        $sql = "insert into tt_site_config values('locker_key', ".$mdb2->quote($this->site_key).", now(), null)";
        $mdb2->exec($sql);
      } else {
        $this->errors->add($i18n->get('error.file_storage'));
      }
    } else {
      // Site id found.
      $this->site_id = $val['id'];

      // Obtain site key.
      $sql = "select param_value as site_key from tt_site_config where param_name = 'locker_key'";
      $res = $mdb2->query($sql);
      $val = $res->fetchRow();
      $this->site_key = $val['site_key'];
    }
  }

  // putFile - puts uploaded file in remote storage.
  function putFile($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $curl_fields = array('site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'org_id' => urlencode($org_id),
      'org_key' => urlencode($this->getOrgKey()),
      'group_id' => urlencode($group_id),
      'group_key' => urlencode($this->getGroupKey()),
      'user_id' => urlencode($fields['user_id']),   // May be null.
      'user_key' => urlencode($fields['user_key']), // May be null.
      'file_name' => urlencode($fields['file_name']),
      'description' => urlencode($fields['description']),
      'content' => urlencode(file_get_contents($_FILES['newfile']['tmp_name']))
    );

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->putfile_uri);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute a post request.
    $result = curl_exec($ch);

    // Close connection.
    curl_close($ch);

    // Delete uploaded file.
    unlink($_FILES['newfile']['tmp_name']);

    if (!$result) {
      $this->errors->add($i18n->get('error.file_storage'));
      return false;
    }

    $result_array = json_decode($result, true);
    $file_id = (int) $result_array['file_id'];
    $file_key = $result_array['file_key'];
    $error = $result_array['error'];

    if ($error || !$file_id || !$file_key) {
      if ($error) {
        // Add an error from file storage facility if we have it.
        $this->errors->add($error);
      }
      return false;
    }

    // File put was successful. Store file attributes locally.
    $entity_type = $mdb2->quote($fields['entity_type']);
    $entity_id = (int) $fields['entity_id'];
    $file_name = $mdb2->quote($fields['file_name']);
    $description = $mdb2->quote($fields['description']);
    $created = 'now()';
    $created_ip = $mdb2->quote($_SERVER['REMOTE_ADDR']);
    $created_by = $user->id;

    $columns = '(group_id, org_id, remote_id, entity_type, entity_id, file_name, description, created, created_ip, created_by)';
    $values = "values($group_id, $org_id, $file_id, $entity_type, $entity_id, $file_name, $description, $created, $created_ip, $created_by)";
    $sql = "insert into tt_files $columns $values";
    $affected = $mdb2->exec($sql);
    return (!is_a($affected, 'PEAR_Error'));
  }

  // deleteFile - deletes a file from remote storage and its details from local database.
  function deleteFile($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $curl_fields = array('site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'org_id' => urlencode($org_id),
      'org_key' => urlencode($this->getOrgKey()),
      'group_id' => urlencode($group_id),
      'group_key' => urlencode($this->getGroupKey()),
      'user_id' => urlencode($fields['user_id']),   // May be null.
      'user_key' => urlencode($fields['user_key']), // May be null.
      'file_id' => urlencode($fields['remote_id']),
      'file_key' => urlencode($fields['file_key'])
    );

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->putfile_uri);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute a post request.
    $result = curl_exec($ch);

    // Close connection.
    curl_close($ch);

    if (!$result) {
      $this->errors->add($i18n->get('error.file_storage'));
      return false;
    }

    $result_array = json_decode($result, true);
    // $status = (int) $result_array['status'];
    $error = $result_array['error'];

    if ($error) {
      // Add an error from file storage facility if we have it.
      $this->errors->add($error);
      return false;
    }

    // Delete file reference from database.
    $file_id = $file['id'];
    $sql = "delete from tt_files".
      " where id = $file_id and org_id = $org_id and group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) {
      $err->add($i18n->get('error.db'));
      return false;
    }

    return true;
  }

  // getOrgKey obtains organization key from the database.
  private function getOrgKey() {
    global $user;
    $mdb2 = getConnection();

    $org_id = $user->org_id;
    $sql = "select group_key from tt_groups where id = $org_id and status = 1";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    return $val['group_key'];
  }

  // getGrtoupKey obtains group key from the database.
  private function getGroupKey() {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select group_key from tt_groups where id = $group_id and org_id = $org_id and status = 1";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    return $val['group_key'];
  }

  // getProjectFiles obtains a list of files for a project.
  function getProjectFiles($project_id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    $sql = "select id, remote_id, file_name as name, description from tt_files".
      " where entity_type = 'project' and entity_id = $project_id".
      " and group_id = $group_id and org_id = $org_id and status = 1 order by id";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      while ($val = $res->fetchRow()) {
        $result[] = $val;
      }
    }
    return $result;
  }

  // get - obtains file details from local database. 
  static function get($id) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id, remote_id, file_key, entity_type, entity_id, file_name, description, status from tt_files".
      " where id = $id and group_id = $group_id and org_id = $org_id and (status = 0 or status = 1)";
    $res = $mdb2->query($sql);
    if (!is_a($res, 'PEAR_Error')) {
      $val = $res->fetchRow();
      if ($val && $val['id'])
        return $val;
    }
    return false;
  }
}
