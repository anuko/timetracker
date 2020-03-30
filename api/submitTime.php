<?php

require __DIR__ . './../vendor/autoload.php';
require_once('../initialize.php');
import('../form.Form');
import('../ttUser');
import('../ttClientHelper');
import('../ttTimeHelper');
import('../DateAndTime');

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

$secret_key = "6D7E07D955DC0316597835BB18F810E6105EB8BCE2B4A9B2B241C4C8047800BE";

$body = file_get_contents("php://input");
$object = json_decode($body);

$jwt = $object->jwt;
if ($jwt) {

  $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

  try {
    $user = new ttUser(null, $object->userId);

    $cl_date = date("Y-m-d");
    $cl_project = $object->projectId;
    $cl_duration = $object->duration;
    $cl_note = $object->note;

    // Insert record.
    $id = ttTimeHelper::insert(array(
      'date' => $cl_date,
      'user_id' => $user->getActiveUser(),
      'client' => $cl_client,
      'project' => $cl_project,
      'task' => $cl_task,
      'duration' => $cl_duration,
      'note' => $cl_note,
      'billable' => true
    ));

    $result = true;
    if ($id && $result) {
      // header('Location: time.php');
      $success_response = ['success' => true, 'data' => $id];
      $response = json_encode($success_response);
      print_r($response);
      exit();
    }
  } catch (Exception $e) {
    $isLoggedIn = false;
    http_response_code(401);
    print_r(json_encode(array(
      "message" => "Access denied.",
      "error" => $e->getMessage()
    )));
    exit();
  }
}
