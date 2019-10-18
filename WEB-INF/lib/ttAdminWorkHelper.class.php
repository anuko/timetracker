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
  var $work_server_uri = null;   // Location of work server.
  var $register_uri = null;      // URI to register with remote work server.
  var $get_work_item_uri = null; // URI to get work item details.
  var $update_work_item_uri = null;  // URI to update work item.
  var $delete_work_item_uri = null;  // URI to delete work item.
  var $approve_work_item_uri = null; // URI to approve work item.
  var $approve_work_item_on_offer_uri = null; // URI to approve work item posted on offer.
  var $disapprove_work_item_uri = null; // URI to disapprove work item.
  var $disapprove_work_item_on_offer_uri = null; // URI to disapprove work item posted on offer.
  var $get_offer_uri = null;     // URI to get offer details.
  var $update_offer_uri = null;  // URI to update offer.
  var $delete_offer_uri = null;  // URI to delete offer.
  var $approve_offer_uri = null;    // URI to approved offer.
  var $disapprove_offer_uri = null; // URI to disapprove offer.
  var $get_pending_work_items_uri = null;  // URI to get work items pending approval.
  var $get_pending_offers_uri = null; // URI to get offers pending approval.
  var $get_items_uri = null;     // URI to get all admin items in one API call.
  var $site_id = null;           // Site id for remote work server.
  var $site_key = null;          // Site key for remote work server.

  // Constructor.
  function __construct(&$errors) {
    $this->errors = &$errors;

    $this->work_server_uri = defined('WORK_SERVER_URI') ? WORK_SERVER_URI : "https://www.anuko.com/work/";
    $this->register_uri = $this->work_server_uri.'register';
    $this->get_work_item_uri = $this->work_server_uri.'admin_getworkitem';
    $this->update_work_item_uri = $this->work_server_uri.'admin_updateworkitem';
    $this->delete_work_item_uri = $this->work_server_uri.'admin_deleteworkitem';
    $this->approve_work_item_uri = $this->work_server_uri.'admin_approveworkitem';
    $this->approve_work_item_on_offer_uri = $this->work_server_uri.'admin_approveworkitemonoffer';
    $this->disapprove_work_item_uri = $this->work_server_uri.'admin_disapproveworkitem';
    $this->disapprove_work_item_on_offer_uri = $this->work_server_uri.'admin_disapproveworkitemonoffer';
    $this->get_offer_uri = $this->work_server_uri.'admin_getoffer';
    $this->update_offer_uri = $this->work_server_uri.'admin_updateoffer';
    $this->delete_offer_uri = $this->work_server_uri.'admin_deleteoffer';
    $this->approve_offer_uri = $this->work_server_uri.'admin_approveoffer';
    $this->disapprove_offer_uri = $this->work_server_uri.'admin_disapproveoffer';
    $this->get_pending_work_items_uri = $this->work_server_uri.'admin_getpendingworkitems';
    $this->get_pending_offers_uri = $this->work_server_uri.'admin_getpendingoffers';
    $this->get_items_uri = $this->work_server_uri.'admin_getitems';
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

  // getPendingOffers - obtains a list of offers pending approval.
  function getPendingOffers() {
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
    curl_setopt($ch, CURLOPT_URL, $this->get_pending_offers_uri);
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

    $pending_offers = $result_array['pending_offers'];
    return $pending_offers;
  }

  // getPendingWorkItems - obtains a list of work items pending approval.
  function getPendingWorkItems() {
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
    curl_setopt($ch, CURLOPT_URL, $this->get_pending_work_items_uri);
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

  // getWorkItem - gets work item details from remote work server.
  function getWorkItem($work_id) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'work_id' => urlencode($work_id));

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->get_work_item_uri);
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

    $work_item = $result_array['work_item'];
    return $work_item;
  }

  // deleteWorkItem - deletes work item from remote work server.
  function deleteWorkItem($work_id) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'work_id' => urlencode($work_id),
      'modified_ip' => urlencode($_SERVER['REMOTE_ADDR']),
      'modified_by' => urlencode($user->getUser()),
      'modified_by_name' => urlencode(base64_encode($user->getName())),
      'modified_by_email' => urlencode(base64_encode($user->getEmail())));

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->delete_work_item_uri);
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

    return true;
  }

  // deleteOffer - deletes an offer from remote work server.
  function deleteOffer($offer_id) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'offer_id' => urlencode($offer_id),
      'modified_ip' => urlencode($_SERVER['REMOTE_ADDR']),
      'modified_by' => urlencode($user->getUser()),
      'modified_by_name' => urlencode(base64_encode($user->getName())),
      'modified_by_email' => urlencode(base64_encode($user->getEmail())));

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->delete_offer_uri);
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

    return true;
  }

  // getOffer - gets offer details from remote work server.
  function getOffer($offer_id) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'offer_id' => urlencode($offer_id));

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

    $offer = $result_array['offer'];
    return $offer;
  }

  // updateWorkItem - updates a work item in remote work server.
  function updateWorkItem($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'work_id' => urlencode($fields['work_id']),
      'subject' => urlencode(base64_encode($fields['subject'])),
      'descr_short' => urlencode(base64_encode($fields['descr_short'])),
      'descr_long' => urlencode(base64_encode($fields['descr_long'])),
      'currency' => urlencode($fields['currency']),
      'amount' => urlencode($fields['amount']),
      'moderator_comment' => urlencode(base64_encode($fields['moderator_comment'])),
      'modified_ip' => urlencode($_SERVER['REMOTE_ADDR']),
      'modified_by' => urlencode($user->getUser()),
      'modified_by_name' => urlencode(base64_encode($user->getName())),
      'modified_by_email' => urlencode(base64_encode($user->getEmail()))
    );

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->update_work_item_uri);
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

    return true;
  }

  // approveWorkItem - approves work item in remote work server.
  function approveWorkItem($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'work_id' => urlencode($fields['work_id']),
      'subject' => urlencode(base64_encode($fields['subject'])),
      'descr_short' => urlencode(base64_encode($fields['descr_short'])),
      'descr_long' => urlencode(base64_encode($fields['descr_long'])),
      'currency' => urlencode($fields['currency']),
      'amount' => urlencode($fields['amount']),
      'moderator_comment' => urlencode(base64_encode($fields['moderator_comment'])),
      'modified_ip' => urlencode($_SERVER['REMOTE_ADDR']),
      'modified_by' => urlencode($user->getUser()),
      'modified_by_name' => urlencode(base64_encode($user->getName())),
      'modified_by_email' => urlencode(base64_encode($user->getEmail())));

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->approve_work_item_uri);
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

    return true;
  }

  // disapproveWorkItem - disapproves work item in remote work server.
  function disapproveWorkItem($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'work_id' => urlencode($fields['work_id']),
      'subject' => urlencode(base64_encode($fields['subject'])),
      'descr_short' => urlencode(base64_encode($fields['descr_short'])),
      'descr_long' => urlencode(base64_encode($fields['descr_long'])),
      'currency' => urlencode($fields['currency']),
      'amount' => urlencode($fields['amount']),
      'moderator_comment' => urlencode(base64_encode($fields['moderator_comment'])),
      'modified_ip' => urlencode($_SERVER['REMOTE_ADDR']),
      'modified_by' => urlencode($user->getUser()),
      'modified_by_name' => urlencode(base64_encode($user->getName())),
      'modified_by_email' => urlencode(base64_encode($user->getEmail())));

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');
    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->disapprove_work_item_uri);
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

    return true;
  }

  // disapproveWorkItemOnOffer - disapproves work item posted on offer in remote work server.
  function disapproveWorkItemOnOffer($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'work_id' => urlencode($fields['work_id']),
      'descr_short' => urlencode(base64_encode($fields['descr_short'])),
      'descr_long' => urlencode(base64_encode($fields['descr_long'])),
      'moderator_comment' => urlencode(base64_encode($fields['moderator_comment'])),
      'modified_ip' => urlencode($_SERVER['REMOTE_ADDR']),
      'modified_by' => urlencode($user->getUser()),
      'modified_by_name' => urlencode(base64_encode($user->getName())),
      'modified_by_email' => urlencode(base64_encode($user->getEmail())));

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');
    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->disapprove_work_item_on_offer_uri);
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

    return true;
  }

  // updateOffer - updates an offer in remote work server.
  function updateOffer($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'offer_id' => urlencode($fields['offer_id']),
      'subject' => urlencode(base64_encode($fields['subject'])),
      'descr_short' => urlencode(base64_encode($fields['descr_short'])),
      'descr_long' => urlencode(base64_encode($fields['descr_long'])),
      'currency' => urlencode($fields['currency']),
      'amount' => urlencode($fields['amount']),
      'moderator_comment' => urlencode(base64_encode($fields['moderator_comment'])),
      'modified_ip' => urlencode($_SERVER['REMOTE_ADDR']),
      'modified_by' => urlencode($user->getUser()),
      'modified_by_name' => urlencode(base64_encode($user->getName())),
      'modified_by_email' => urlencode(base64_encode($user->getEmail()))
    );

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->update_offer_uri);
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

    return true;
  }

  // approveOffer - approves offer in remote work server.
  function approveOffer($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'offer_id' => urlencode($fields['offer_id']),
      'subject' => urlencode(base64_encode($fields['subject'])),
      'descr_short' => urlencode(base64_encode($fields['descr_short'])),
      'descr_long' => urlencode(base64_encode($fields['descr_long'])),
      'currency' => urlencode($fields['currency']),
      'amount' => urlencode($fields['amount']),
      'moderator_comment' => urlencode(base64_encode($fields['moderator_comment'])),
      'modified_ip' => urlencode($_SERVER['REMOTE_ADDR']),
      'modified_by' => urlencode($user->getUser()),
      'modified_by_name' => urlencode(base64_encode($user->getName())),
      'modified_by_email' => urlencode(base64_encode($user->getEmail())));

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->approve_offer_uri);
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

    return true;
  }


  // disapproveOffer - disapproves offer in remote work server.
  function disapproveOffer($fields) {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $curl_fields = array('lang' => urlencode($user->lang),
      'site_id' => urlencode($this->site_id),
      'site_key' => urlencode($this->site_key),
      'user_id' => urlencode($user->id),
      'offer_id' => urlencode($fields['offer_id']),
      'subject' => urlencode(base64_encode($fields['subject'])),
      'descr_short' => urlencode(base64_encode($fields['descr_short'])),
      'descr_long' => urlencode(base64_encode($fields['descr_long'])),
      'currency' => urlencode($fields['currency']),
      'amount' => urlencode($fields['amount']),
      'moderator_comment' => urlencode(base64_encode($fields['moderator_comment'])),
      'modified_ip' => urlencode($_SERVER['REMOTE_ADDR']),
      'modified_by' => urlencode($user->getUser()),
      'modified_by_name' => urlencode(base64_encode($user->getName())),
      'modified_by_email' => urlencode(base64_encode($user->getEmail())));

    // url-ify the data for the POST.
    foreach($curl_fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    $fields_string = rtrim($fields_string, '&');

    // Open connection.
    $ch = curl_init();

    // Set the url, number of POST vars, POST data.
    curl_setopt($ch, CURLOPT_URL, $this->disapprove_offer_uri);
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

    return true;
  }

  // getItems - obtains a list of all items relevant to admin in one API call to Remote Work Server.
  function getItems() {
    global $i18n;
    global $user;
    $mdb2 = getConnection();

    $group_id = $user->getGroup();
    $org_id = $user->org_id;

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
    curl_setopt($ch, CURLOPT_URL, $this->get_items_uri);
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

    unset($result_array['call_status']); // Remove call_status element.
    return $result_array;
  }
}
