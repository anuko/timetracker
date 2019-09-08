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

// ttOfferHelper class is used for handling offers for the Remote work plugin.
// An offer is a proposal to do something for compensation in selected currency
// within a specified timeframe.
class ttOfferHelper {
  var $errors = null;            // Errors go here. Set in constructor by reference.
  var $remote_work_uri = null;   // Location of remote work server.
  var $register_uri = null;      // URI to register with remote work server.
  var $create_offer_uri = null;  // URI to publish offer.
  var $get_offer_uri = null;     // URI to get offer details.
  var $get_offers_uri = null;    // URI to get a list of offers.
  var $delete_offer_uri = null;  // URI to delete offer.
  var $delete_offers_uri = null; // URI to delete multiple offers.
  var $update_offer_uri = null;  // URI to update offer.
  var $site_id = null;           // Site id for remote work server.
  var $site_key = null;          // Site key for remote work server.

  // Constructor.
  function __construct(&$errors) {
    $this->errors = &$errors;

    if (defined('REMOTE_WORK_URI')) {
      $this->remote_work_uri = REMOTE_WORK_URI;
      $this->register_uri = $this->remote_work_uri.'register';
      $this->create_offer_uri = $this->remote_work_uri.'createoffer';
      $this->get_offer_uri = $this->remote_work_uri.'getoffer';
      $this->get_offers_uri = $this->remote_work_uri.'getoffers';
      $this->delete_offer_uri = $this->remote_work_uri.'deleteoffer';
      $this->delete_offers_uri = $this->remote_work_uri.'deleteoffers';
      $this->update_offer_uri = $this->remote_work_uri.'updateoffer';
      $this->checkSiteRegistration();
    }
  }

  // checkSiteRegistration - obtains site id and key from local database.
  // If not found, it tries to register with remote work server.
  function checkSiteRegistration() {

    global $i18n;
    $mdb2 = getConnection();

    // Obtain site id.
    $sql = "select param_value as id from tt_site_config where param_name = 'worksite_id'";
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
        $this->errors->add($i18n->get('error.remote_work'));
      }
      else if ($result_array['error']) {
        // Add an error from remote work server if we have it.
        $this->errors->add($result_array['error']);
      }
      else if ($result_array['id'] && $result_array['key']) {
        $this->site_id = $result_array['id'];
        $this->site_key = $result_array['key'];

        // Registration successful. Store id and key locally for future use.
        $sql = "insert into tt_site_config values('worksite_id', $this->site_id, now(), null)";
        $mdb2->exec($sql);
        $sql = "insert into tt_site_config values('worksite_key', ".$mdb2->quote($this->site_key).", now(), null)";
        $mdb2->exec($sql);
      } else {
        $this->errors->add($i18n->get('error.remote_work'));
      }
    } else {
      // Site id found.
      $this->site_id = $val['id'];

      // Obtain site key.
      $sql = "select param_value as site_key from tt_site_config where param_name = 'worksite_key'";
      $res = $mdb2->query($sql);
      $val = $res->fetchRow();
      $this->site_key = $val['site_key'];
    }
  }

  // createOffer - publishes an offer in remote work server.
  function createOffer($fields) {
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
      'offer_lang' => urlencode($fields['offer_lang']),
      'offer_subject' => urlencode($fields['offer_subject']),
      'offer_descr_short' => urlencode($fields['offer_descr_short']),
      'offer_descr_long' => urlencode($fields['offer_descr_long']),
      'offer_currency' => urlencode($fields['offer_currency']),
      'offer_amount' => urlencode($fields['offer_amount'])
    );

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->create_offer_uri);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute a post request.
    $result = curl_exec($ch);

    // Close connection.
    curl_close($ch);

    if (!$result) {
      $this->errors->add($i18n->get('error.remote_work'));
      return false;
    }

    $result_array = json_decode($result, true);
    $offer_id = (int) $result_array['offer_id'];
    $offer_key = $result_array['offer_key'];
    $error = $result_array['error'];

    if ($error || !$offer_id || !$offer_key) {
      if ($error) {
        // Add an error from remote work server if we have it.
        $this->errors->add($error);
      }
      return false;
    }

    return true;
  }


  // getOffer - gets offer details from remote work server.
  function getOffer($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

    $curl_fields = array('site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
// Do we need these here?
//      'org_id' => urlencode($org_id),
//      'org_key' => urlencode($this->getOrgKey()),
//      'group_id' => urlencode($group_id),
//      'group_key' => urlencode($this->getGroupKey()),
      'offer_id' => urlencode($fields['remote_id']));

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->get_offer_uri);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute a post request.
    $result = curl_exec($ch);

    $error = curl_error();
    $result_array2 = json_decode($result, true);

    // Close connection.
    curl_close($ch);

    if (!$result) {
      $this->errors->add($i18n->get('error.remote_work'));
      return false;
    }

    $result_array = json_decode($result, true);
    $status = (int) $result_array['status'];
    $error = $result_array['error'];

    if ($error) {
      // Add an error from remote work server if we have it.
      $this->errors->add($error);
      return false;
    }
    if ($status != 1) {
      // There is no explicit error message, but still something not right.
      $this->errors->add($i18n->get('error.remote_work'));
      return false;
    }

    // TODO: construct and return an array of fields here...
    return true;
  }

  // TODO: redo the function above.
  // Concerns: 1) why $result_array2
  // 2) We need to return an array of fields.

  
  
  
  
  
  
    // The following code is originally from ttFileHelper an needs to be redone.
    // 
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
      'entity_type' => urlencode($fields['entity_type']),
      'entity_id' => urlencode($fields['entity_id']),
      'file_id' => urlencode($fields['remote_id']),
      'file_key' => urlencode($fields['file_key']),
      'file_name' => urlencode($fields['file_name']));

    // url-ify the data for the POST.
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
    $error = $result_array['error'];

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
      'org_key' => urlencode($this->getOrgKey()),
      'group_id' => urlencode($group_id),
      'group_key' => urlencode($this->getGroupKey()),
      'entity_type' => urlencode($entity_type),
      'entity_id' => urlencode($entity_id));

    // url-ify the data for the POST.
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
    $error = $result_array['error'];

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
    $file_id = $fields['id'];
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
    return $val['id'] > 0;
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


  // getFileData - returns file data from memory.
  function getFileData() {
    return base64_decode($this->file_data);
  }
}
