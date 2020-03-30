<?php

require __DIR__ . './../vendor/autoload.php';
require_once('../initialize.php');
import('../form.Form');
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
  // Set current user date (as determined by user browser) into session.
  $current_user_date = $request->getParameter('browser_today', null);
  if ($current_user_date)
    $_SESSION['date'] = $current_user_date;

  // Remember user login in a cookie.
  setcookie('tt_login', $cl_login, time() + COOKIE_EXPIRE, '/');

  $user = new ttUser(null, $auth->getUserId());
  // Redirect, depending on user role.
  $isLoggedIn = true;

  if ($isLoggedIn) {
    $secret_key = "91566E2C4E72AF394CAE190D1F2A6062E7826F84BB264962DD3450485C240117"; // (SHA256) TestTimetrackerAPI@2020
    $issuer_claim = "sasitha"; // this can be the servername
    $audience_claim = "THE_AUDIENCE";
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
    // $jwt = true;

    $success_response = ['success' => true, 'userId' => $user->id, 'jwt' => $jwt];
    $response = json_encode($success_response);
    error_log("success_response");
    print_r($response);
  }
  exit();
} else {
  print_r(['success' => false, 'error' => 'Failed the login']);
}
