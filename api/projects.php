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

$secret_key = SECRET_KEY;

$body = file_get_contents("php://input");
$object = json_decode($body);
$jwt = $object->jwt;

$isLoggedIn = false;
if ($jwt) {
  try {
    error_log($jwt);
    $decoded = JWT::decode($jwt, $secret_key, array('HS256'));
    $isLoggedIn = true;
    $userId = $decoded->data->id;
    $user = new ttUser(null, $userId);
    if ($isLoggedIn) {
      $project_list = $user->getAssignedProjects();
      $success_response = ['success' => true, 'data' => $project_list];
      $response = json_encode($success_response);
      print_r($response);
    }
  } catch (Exception $e) {
    $isLoggedIn = false;
    http_response_code(401);
    print_r(json_encode(array(
      "message" => "Access denied.",
      "error" => $e->getMessage()
    )));
  }
}

exit();
