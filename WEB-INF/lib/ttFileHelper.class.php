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
  var $errors = null; // Errors go here. Set in constructor by reference.
  var $storage_uri = null;
  var $site_id = null;
  var $site_key = null;

  // Constructor.
  function __construct(&$errors) {
    $this->errors = &$errors;

    if (isset($GLOBALS['FILE_STORAGE_PARAMS']) && is_array($GLOBALS['FILE_STORAGE_PARAMS'])) {
       $params = $GLOBALS['FILE_STORAGE_PARAMS'];
       $this->storage_uri = $params['uri'];
       $this->site_id = $params['site_id'];
       $this->site_key = $params['site_key'];
    }
  }

  // putFile - puts uploaded file in remote storage.
  function putFile($description) {

    $url = $this->storage_uri;
    $fields = array('description' => urlencode($description),
//	'fname' => urlencode($_POST['first_name']),
//	'title' => urlencode($_POST['title']),
//	'company' => urlencode($_POST['institution']),
//	'age' => urlencode($_POST['age']),
//	'email' => urlencode($_POST['email']),
//	'phone' => urlencode($_POST['phone'])
    );

    // url-ify the data for the POST.
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute a post rewuest.
    $result = curl_exec($ch);

    // Close connection.
    curl_close($ch);

    if ($result) {
      $result_array = json_decode($result, true);
      $file_id = $mdb2->quote($result_array['id']);
    }

    unlink($_FILES['newfile']['tmp_name']);
    return false; // Not implemented.
/*
    // Create a temporary file.
    $dirName = dirname(TEMPLATE_DIR . '_c/.');
    $filename = tempnam($dirName, 'import_');

    // If the file is compressed - uncompress it.
    if ($compressed) {
      if (!$this->uncompress($_FILES['xmlfile']['tmp_name'], $filename)) {
        $this->errors->add($i18n->get('error.sys'));
        return;
      }
      unlink($_FILES['newfile']['tmp_name']);
    } else {
      if (!move_uploaded_file($_FILES['xmlfile']['tmp_name'], $filename)) {
        $this->errors->add($i18n->get('error.upload'));
        return;
      }
    }*/
  }
}
