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

define('TT_CURL_SUCCESS', 1);

// Class ttAdminWorkHelper is used to help with operations of administering Remote Work server.
// It does everything via curl calls to a Remote Work server using its API.
class ttAdminWorkHelper {
  var $errors = null;            // Errors go here. Set in constructor by reference.
  var $remote_work_uri = null;   // Location of remote work server.
  var $register_uri = null;      // URI to register with remote work server.
  var $get_work_uri = null;      // URI to get work details.
  var $update_work_uri = null;   // URI to update work.
  var $get_offer_uri = null;     // URI to get offer details.
  var $update_offer_uri = null;  // URI to update offer.
  var $get_pending_work_uri = null;   // URI to get work pending approval.
  var $get_pending_offers_uri = null; // URI to get offers pending approval.
  var $site_id = null;           // Site id for remote work server.
  var $site_key = null;          // Site key for remote work server.

  // Constructor.
  function __construct(&$errors) {
    $this->errors = &$errors;

    $this->remote_work_uri = defined('REMOTE_WORK_URI') ? REMOTE_WORK_URI : "https://www.anuko.com/work/";
    $this->register_uri = $this->remote_work_uri.'register';
    $this->get_work_uri = $this->remote_work_uri.'admin_getwork';
    $this->update_work_uri = $this->remote_work_uri.'admin_updatework';
    $this->get_offer_uri = $this->remote_work_uri.'admin_getoffer';
    $this->update_offer_uri = $this->remote_work_uri.'admin_updateoffer';
    $this->get_pending_work_uri = $this->remote_work_uri.'admin_getpendingwork';
    $this->get_pending_offers_uri = $this->remote_work_uri.'admin_getpendingoffers';
    $this->checkSiteRegistration();
  }

  // checkSiteRegistration - obtains site id and key from local database.
  // If not found, it tries to register with remote work server.
  function checkSiteRegistration() {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    // Obtain site id.
    $sql = "select param_value as id from tt_site_config where param_name = 'worksite_id'";
    $res = $mdb2->query($sql);
    $val = $res->fetchRow();
    if (!$val) {
      // No site id found, need to register.
      $fields = array('lang' => urlencode($user->lang),
        'name' => urlencode('time tracker'),
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

      if (!$result) {
        $this->errors->add($i18n->get('error.remote_work'));
        return false;
      }

      $result_array = json_decode($result, true);

      // Check for errors.
      $call_status = $result_array['call_status'];
      if (!$call_status) {
        $this->errors->add($i18n->get('error.remote_work'));
        return false;
      }
      if ($call_status['code'] != TT_CURL_SUCCESS) {
        $this->errors->add($call_status['error']);
        return false;
      }

      $reg_status = $result_array['reg_status']; // Registration status.
      if ($reg_status['site_id'] && $reg_status['site_key']) {
        $this->site_id = $reg_status['site_id'];
        $this->site_key = $reg_status['site_key'];

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

  // getPendingWork - obtains a list of work items pending approval.
  function getPendingWork() {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id)
    );

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->get_pending_work_uri);
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

    // Check for errors.
    $call_status = $result_array['call_status'];
    if (!$call_status) {
      $this->errors->add($i18n->get('error.remote_work'));
      return false;
    }
    if ($call_status['code'] != TT_CURL_SUCCESS) {
      $this->errors->add($call_status['error']);
      return false;
    }

    $pending_work = $result_array['pending_work'];
    return $pending_work;
  }
}
