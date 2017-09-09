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

class Mailer {
  var $mMailMode;
  var $mCharSet = 'iso-8859-1';
  var $mContentType = 'text/plain';
  var $mSender;
  var $mReceiver;
  var $mReceiverCC;
  var $mReceiverBCC;

  function __construct($type='mail') {
    $this->mMailMode = $type;
  }

  function setMailMode($value) {
    $this->mMailMode = $value;
  }

  function setCharSet($value) {
    $this->mCharSet = $value;
  }

  function setContentType($value) {
    $this->mContentType = $value;
  }

  function setReceiver($value) {
    $this->mReceiver = $value;
  }

  function setReceiverCC($value) {
    $this->mReceiverCC = $value;
  }

  function setReceiverBCC($value) {
    $this->mReceiverBCC = $value;
  }

  function setSender($value) {
    $this->mSender = $value;
  }

  function send($subject, $data) {
    $data = chunk_split(base64_encode($data));
    $subject = Mailer::mimeEncode($subject, $this->mCharSet);

    $headers = array('From' => $this->mSender, 'To' => $this->mReceiver);
    if (isset($this->mReceiverCC)) $headers = array_merge($headers, array('CC' => $this->mReceiverCC));
    if (isset($this->mReceiverBCC)) $headers = array_merge($headers, array('BCC' => $this->mReceiverBCC));
    $headers = array_merge($headers, array(
      'Subject' => $subject,
      'MIME-Version' => '1.0',
      'Content-Type' => $this->mContentType.'; charset='.$this->mCharSet,
      'Content-Transfer-Encoding' => 'BASE64'));

    // PEAR::Mail
    require_once('Mail.php');

    $recipients = $this->mReceiver;
    switch ($this->mMailMode) {
      case 'mail':
        $mail = Mail::factory('mail');
        break;

    case 'smtp':
        // Mail_smtp does not do CC or BCC -> recipients conversion.
        if (!empty($this->mReceiverCC)) {
          // make exactly one space after a comma
          $recipients .= ', ' . preg_replace('/,[[:space:]]+/', ', ', $this->mReceiverCC);
        }
        if (!empty($this->mReceiverBCC)) {
          // make exactly one space after a comma
          $recipients .= ', ' . preg_replace('/,[[:space:]]+/', ', ', $this->mReceiverBCC);
        }

        $host = defined('MAIL_SMTP_HOST') ? MAIL_SMTP_HOST : 'localhost';
        $port = defined('MAIL_SMTP_PORT') ? MAIL_SMTP_PORT : '25';
        $username = defined('MAIL_SMTP_USER') ? MAIL_SMTP_USER : null;
        $password = defined('MAIL_SMTP_PASSWORD') ? MAIL_SMTP_PASSWORD : null;
        $auth = (defined('MAIL_SMTP_AUTH') && isTrue(MAIL_SMTP_AUTH)) ? true : false;
        $debug = (defined('MAIL_SMTP_DEBUG') && isTrue(MAIL_SMTP_DEBUG)) ? true : false;

        $mail = Mail::factory('smtp', array ('host' => $host,
          'port' => $port,
          'username' => $username,
          'password' => $password,
          'auth' => $auth,
          'debug' => $debug));
        break;
    }

    if (defined('MAIL_SMTP_DEBUG') && isTrue(MAIL_SMTP_DEBUG))
      PEAR::setErrorHandling(PEAR_ERROR_PRINT);

    $res = $mail->send($recipients, $headers, $data);
    return (!is_a($res, 'PEAR_Error'));
  }

  function mimeEncode($in_str, $charset) {
    $out_str = $in_str;
    if ($out_str && $charset) {
      $start = '=?'.strtoupper($charset).'?B?';
      $end = '?=';
      $out_str = base64_encode($out_str);
      $out_str = $start . $out_str . $end;
    }
    return $out_str;
  }
}
