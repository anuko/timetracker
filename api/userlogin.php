<?php

// +----------------------------------------------------------------------+
// | Author: Sasitha Asaranga
// +----------------------------------------------------------------------+

require __DIR__ . './../vendor/autoload.php';
require_once('../initialize.php');
import('../form.Form');
import('../ttOrgHelper');
import('../ttUser');

use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
  throw new Exception('Only POST requests are allowed');
}

$content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
if (stripos($content_type, 'application/json') === false) {
  throw new Exception('Content-Type must be application/json');
}

$body = file_get_contents("php://input");
$object = json_decode($body);

$cl_login = $object->login;
$cl_password = $object->password;

@include('../plugins/limit/access_check.php');
if ($auth->doLogin($cl_login, $cl_password)) {
  $user = new ttUser(null, $auth->getUserId());

  $isLoggedIn = false;
  if (!empty($user)) {
    $isLoggedIn = true;
  }
  if ($isLoggedIn) {
    $secret_key = SECRET_KEY;
    $issuer_claim = ISSUER_CLAIM;
    $audience_claim = AUDIENCE_CLAIM;
    $issuedat_claim = time(); // issued at
    $notbefore_claim = $issuedat_claim; //not before in seconds
    $expire_claim = $issuedat_claim + 1800; // expire time in seconds
    $token = array(
      "iss" => $issuer_claim,
      "aud" => $audience_claim,
      "iat" => $issuedat_claim,
      "nbf" => $notbefore_claim,
      "exp" => $expire_claim,
      "data" => array(
        "firstname" => $user->name,
        "id" => $user->id,
        "email" => $user->email
      )
    );

    http_response_code(200);
    $jwt = JWT::encode($token, $secret_key);

    $success_response = ['success' => true, 'userId' => $user->id, 'jwt' => $jwt];
    $response = json_encode($success_response);
    print_r($response);
  } else {
    $error_response = ['success' => false, 'error' => 'Empty user'];
    $response = json_encode($error_response);
    print_r($response);
  }
} else {
  $error_response = ['success' => false, 'error' => 'Failed the login'];
  $response = json_encode($error_response);
  print_r($response);
}
exit();
