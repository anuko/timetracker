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
  // If not found, it tries to register with file stroage facility.
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

      if ($result) {
        $result_array = json_decode($result, true);
        if ($result_array && $result_array['id'] && $result_array['key']) {

          $this->site_id = $mdb2->quote($result_array['id']);
          $this->site_key = $mdb2->quote($result_array['key']);

          // Registration successful. Store id and key locally for future use.
          $sql = "insert into tt_site_config values('locker_id', $site_id, now(), null)";
          $mdb2->exec($sql);
          $sql = "insert into tt_site_config values('locker_key', $key, now(), null)";
          $mdb2->exec($sql);
        }
      }
    } else {
      // Site id found, need to update site attributes.
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
    // if (!$this->site_id || !$this->site_key) return false;

    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $fields = array('site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'org_id' => urlencode($org_id),
      //'org_key' => urlencode($this->org_key),     // TODO: obtain this properly.
      'group_id' => urlencode($group_id),
      //'group_key' => urlencode($this->group_key), // TODO: obtain this properly.
      //'user_id' => urlencode($this->user_id),     // TODO: obtain this properly.
      //'user_key' => urlencode($this->user_key),   // TODO: obtain this properly.
      'file_name' => urlencode($fields['file_name']),
      'description' => urlencode($fields['description']),
      // TODO: add file content here, too. Will this work for large files?
      //
    );

    // url-ify the data for the POST.
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->putfile_uri);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute a post rewuest.
    $result = curl_exec($ch);

    // Close connection.
    curl_close($ch);

    // Delete uploaded file.
    unlink($_FILES['newfile']['tmp_name']);

    if (!$result) return false;

    $result_array = json_decode($result, true);
    $file_id = (int) $result_array['file_id'];
    $file_key = $result_array['file_key'];
    $file_error = $result_array['file_error'];

    if (!$file_id || !$file_key) {
      if ($file_error) {
        // Add an error message from file storage facility if we have it.
        $this->errors->add($file_error);
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
}
