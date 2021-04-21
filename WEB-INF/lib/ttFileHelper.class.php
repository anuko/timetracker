<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

// ttFileHelper class is used for attachment handling.
class ttFileHelper {
  var $errors = null;       // Errors go here. Set in constructor by reference.
  var $storage_uri = null;  // Location of file storage facility.
  var $register_uri = null; // URI to register with file storage facility.
  var $putfile_uri = null;  // URI to put file in file storage.
  var $deletefile_uri = null;  // URI to delete file from file storage.
  var $deletefiles_uri = null; // URI to delete multiple files from file storage.
  var $getfile_uri = null;  // URI to get file from file storage.
  var $site_id = null;      // Site id for file storage.
  var $site_key = null;     // Site key for file storage.
  var $file_data = null;     // Downloaded file data.

  // Constructor.
  function __construct(&$errors) {
    $this->errors = &$errors;

    $this->storage_uri = defined('FILE_STORAGE_URI') ? FILE_STORAGE_URI : "https://www.anuko.com/files/";
    $this->register_uri = $this->storage_uri.'register';
    $this->putfile_uri = $this->storage_uri.'putfile';
    $this->deletefile_uri = $this->storage_uri.'deletefile';
    $this->deletefiles_uri = $this->storage_uri.'deletefiles';
    $this->getfile_uri = $this->storage_uri.'getfile';
    $this->checkSiteRegistration();
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
      curl_setopt($ch, CURLOPT_POST, true);
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
      'org_key' => urlencode($user->getOrgKey()),
      'group_id' => urlencode($group_id),
      'group_key' => urlencode($user->getGroupKey()),
      'entity_type' => urlencode($fields['entity_type']),
      'entity_id' => urlencode($fields['entity_id']),
      'file_name' => urlencode($fields['file_name']),
      'description' => urlencode(isset($fields['description']) ? $fields['description'] : ''),
      'content' => urlencode(base64_encode(file_get_contents($_FILES['newfile']['tmp_name'])))
    );

    // url-ify the data for the POST.
    $fields_string = '';
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->putfile_uri);
    curl_setopt($ch, CURLOPT_POST, true);
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
    $error = isset($result_array['error']) ? $result_array['error'] : false;

    if ($error || !$file_id || !$file_key) {
      if ($error) {
        // Add an error from file storage facility if we have it.
        $this->errors->add($error);
      }
      return false;
    }

    // File put was successful. Store file attributes locally.
    $file_key = $mdb2->quote($file_key);
    $entity_type = $mdb2->quote($fields['entity_type']);
    $entity_id = (int) $fields['entity_id'];
    $file_name = $mdb2->quote($fields['file_name']);
    $description = $mdb2->quote(isset($fields['description']) ? $fields['description'] : '');
    $created = 'now()';
    $created_ip = $mdb2->quote($_SERVER['REMOTE_ADDR']);
    $created_by = $user->id;

    $columns = '(group_id, org_id, remote_id, file_key, entity_type, entity_id, file_name, description, created, created_ip, created_by)';
    $values = "values($group_id, $org_id, $file_id, $file_key, $entity_type, $entity_id, $file_name, $description, $created, $created_ip, $created_by)";
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
      'org_key' => urlencode($user->getOrgKey()),
      'group_id' => urlencode($group_id),
      'group_key' => urlencode($user->getGroupKey()),
      'entity_type' => urlencode($fields['entity_type']),
      'entity_id' => urlencode($fields['entity_id']),
      'file_id' => urlencode($fields['remote_id']),
      'file_key' => urlencode($fields['file_key']),
      'file_name' => urlencode($fields['file_name']));

    // url-ify the data for the POST.
    $fields_string = '';
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->deletefile_uri);
    curl_setopt($ch, CURLOPT_POST, true);
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
    $status = (int) $result_array['status'];
    $error = isset($result_array['error']) ? $result_array['error'] : false;

    if ($error) {
      // Add an error from file storage facility if we have it.
      $this->errors->add($error);
    }
    if ($status != 1) {
      // There is no explicit error message, but still something not right.
      $this->errors->add($i18n->get('error.file_storage'));
    }

    // Delete file reference from database even when remote file storage call fails.
    // This is by design to keep things simple.
    $file_id = (int) $fields['id'];
    $entity_id = (int) $fields['entity_id'];
    $sql = "delete from tt_files".
      " where id = $file_id and org_id = $org_id and group_id = $group_id and entity_id = $entity_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) {
      $this->errors->add($i18n->get('error.db'));
      return false;
    }

    // File successfully deleted from both file storage and database.
    return true;
  }

  // deleteEntityFiles - deletes all files associated with an entity.
  function deleteEntityFiles($entity_id, $entity_type) {

    if (!$this->entityHasFiles($entity_id, $entity_type))
      return true; // No files to delete.

    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $curl_fields = array('site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'org_id' => urlencode($org_id),
      'org_key' => urlencode($user->getOrgKey()),
      'group_id' => urlencode($group_id),
      'group_key' => urlencode($user->getGroupKey()),
      'entity_type' => urlencode($entity_type),
      'entity_id' => urlencode($entity_id));

    // url-ify the data for the POST.
    $fields_string = '';
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->deletefiles_uri);
    curl_setopt($ch, CURLOPT_POST, true);
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
    $status = (int) $result_array['status'];
    $error = isset($result_array['error']) ? $result_array['error'] : false;

    if ($error) {
      // Add an error from file storage facility if we have it.
      $this->errors->add($error);
    }
    if ($status != 1) {
      // There is no explicit error message, but still something not right.
      $this->errors->add($i18n->get('error.file_storage'));
    }

    // Many things can go wrong with a remote call to file storage facility.
    // By design, we ignore such errors, and proceed with removal of entity
    // records from the database.

    // Delete all entity records from the database.
    $sql = "delete from tt_files".
      " where entity_id = $entity_id".
      " and entity_type = ".$mdb2->quote($entity_type).
      " and org_id = $org_id and group_id = $group_id";
    $affected = $mdb2->exec($sql);
    if (is_a($affected, 'PEAR_Error')) {
      $this->errors->add($i18n->get('error.db'));
      return false;
    }

    return true;
  }

  // entityHasFiles determines if an entity has any files referenced in database.
  private function entityHasFiles($entity_id, $entity_type) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $sql = "select id from tt_files where org_id = $org_id and group_id = $group_id".
      " and entity_type = ".$mdb2->quote($entity_type)." and entity_id = $entity_id limit 1";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    return (isset($val['id']) && $val['id'] > 0);
  }

  // getEntityFiles obtains a list of files for an entity.
  static function getEntityFiles($id, $type) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $result = array();
    $entity_type = $mdb2->quote($type);
    $sql = "select id, remote_id, file_key, file_name as name, description from tt_files".
      " where entity_type = $entity_type and entity_id = $id".
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

  // update - updates file details in local database.
  static function update($fields) {
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $file_id = (int) $fields['id'];
    $description = $mdb2->quote($fields['description']);

    $sql = "update tt_files set description = $description where id = $file_id".
      " and group_id = $group_id and org_id = $org_id and (status = 0 or status = 1)";
    $affected = $mdb2->exec($sql);
    return !is_a($affected, 'PEAR_Error');
  }


  // getFile - downloads file from remote storage to memory.
  function getFile($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $curl_fields = array('site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'org_id' => urlencode($org_id),
      'org_key' => urlencode($user->getOrgKey()),
      'group_id' => urlencode($group_id),
      'group_key' => urlencode($user->getGroupKey()),
      'entity_type' => urlencode($fields['entity_type']),
      'entity_id' => urlencode($fields['entity_id']),
      'file_id' => urlencode($fields['remote_id']),
      'file_key' => urlencode($fields['file_key']),
      'file_name' => urlencode($fields['file_name']));

    // url-ify the data for the POST.
    $fields_string = '';
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->getfile_uri);
    curl_setopt($ch, CURLOPT_POST, true);
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
    $status = (int) $result_array['status'];
    $error = isset($result_array['error']) ? $result_array['error'] : false;

    if ($error) {
      // Add an error from file storage facility if we have it.
      $this->errors->add($error);
      return false;
    }
    if ($status != 1) {
      // There is no explicit error message, but still something not right.
      $this->errors->add($i18n->get('error.file_storage'));
      return false;
    }

    $this->file_data = $result_array['content'];
    return true;
  }


  // getFileData - returns file data from memory.
  function getFileData() {
    return base64_decode($this->file_data);
  }
}
