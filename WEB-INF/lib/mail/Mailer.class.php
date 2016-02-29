<?php
// License here

class Mailer {
	var $mSendType;
	var $mCharSet = "iso-8859-1";
	var $mContentType = "text/plain";
	var $mSender;
	var $mReceiver;
	var $mReceiverCC;

    function Mailer($type='standard') {
    	$this->mSendType = $type;
    }

    function setSendType($value) {
    	$this->mSendType = $value;
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

    function setSender($value) {
    	$this->mSender = $value;
    }

    function send($subject, $data) {
    	$data = chunk_split(base64_encode($data));
    	$subject = Mailer::mimeEncode($subject, $this->mCharSet);

    	$headers = array(
    		'From' => $this->mSender,
    		'To' => $this->mReceiver);
    	if (isset($this->mReceiverCC)) $headers = array_merge($headers, array(
    		'CC' => $this->mReceiverCC));
    	$headers = array_merge($headers, array(
    		'Subject' => $subject,
    		'MIME-Version' => '1.0',
    		'Content-Type' => $this->mContentType.'; charset='.$this->mCharSet,
    		'Content-Transfer-Encoding' => 'BASE64',
    	));

    	// PEAR::Mail
    	require_once('Mail.php');

    	$recipients = $this->mReceiver;
    	switch ($this->mSendType) {
    		case 'mail':
					$mail = Mail::factory('mail');
    			break;

    		case "smtp":
    			// Mail_smtp does not do CC -> recipients conversion
    			if (!empty($this->mReceiverCC)) {
    				// make exactly one space after a comma
    				$recipients .= ', ' . preg_replace('/,[[:space:]]+/', ', ', $this->mReceiverCC);;
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

    /**
     * convert to base64-string
     *
     * @param string $in_str
     * @param string $charset
     * @return string
     */
    function mimeEncode($in_str, $charset) {
	   $out_str = $in_str;
	   if ($out_str && $charset) {

	       $end = "?=";
	       $start = "=?" . strtoupper($charset) . "?B?";
	       $spacer = $end . "\r\n " . $start;

	       $length = 75 - strlen($start) - strlen($end);
	       $length = floor($length/2) * 2;

	       $out_str = base64_encode($out_str);
	       //$out_str = Mail::encodemime($out_str,"base64");
	       //$out_str = chunk_split($out_str, $length, $spacer);

	       //$spacer = preg_quote($spacer);
	       //$out_str = preg_replace("/" . $spacer . "$/", "", $out_str);
	       $out_str = $start . $out_str . $end;
	   }
	   return $out_str;
	}
}