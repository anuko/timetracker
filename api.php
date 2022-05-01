<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Access-Control-Allow-Headers: Content-Type, Origin, Authorization, X-Auth-Token");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Origin: *");

if($_SERVER['REQUEST_METHOD']=="OPTIONS"){
    exit(0);
}

require_once('initialize.php');
require_once('api_lib.php');
require_once 'api_route_projects.php';
require_once 'api_route_time.php';
require_once 'api_route_clients.php';
require_once(__DIR__.'/vendor/autoload.php');

$apiReq = preg_replace('/^.*\/api.php\//i','',$_SERVER['REQUEST_URI']);
$params = explode('/',$apiReq);
$domain = array_shift($params);
$requestBody = file_get_contents("php://input");
if(!empty($requestBody) ){
    $body = json_decode($requestBody,true);
}

if($domain == "authenticate"){
    $loginSucceeded = $auth->doLogin($body['username'], $body['password']);
    if ($loginSucceeded) {
        $user = new ttUser(null, $auth->getUserId());
        echo json_encode(array('token'=>generate_decoded_token($user)));
    } else {
        send_error('error.auth');
    }
    exit;
}else {
    $decodedTokenExistsInHeader = preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matcheddecodedTokenArr);
    if (! $decodedTokenExistsInHeader) {
        send_error('error.jwt_ecoded_token_not_found');
        exit;
    }else {
        $decodedToken = decode_token($matcheddecodedTokenArr[1]);
        if(! validate_decodedToken($decodedToken)){
            exit;
        }
        $user = new ttUser(null, $decodedToken->sub->id);
        route_request($domain,$params,$body,$user);
    }
}

function generate_decoded_token($user) {
    $current_ts = (new DateTimeImmutable())->getTimestamp();
    $payload = [
        'iss' => $_SERVER['SERVER_NAME'],
        'aud' => $_SERVER['SERVER_NAME'],
        'iat' => $current_ts,
        'nbf' => $current_ts,
        'sub' => get_subject($user),
        'exp' => $current_ts+(3600*24)
    ];
    return JWT::encode($payload, JWT_KEY, JWT_ALGO);
}

function get_subject($user) {
    return array(
        'login' => $user->login,
        'name' => $user->name,
        'id' => $user->id,
        'org_id' => $user->org_id,
        'group_id' => $user->group_id,
        'group_name' => $user->group_name,
        'role_id' => $user->role_id,
        'role_name' => $user->role_name,
        'rank' => $user->rank,
        'email' => $user->email,
    );
}

function decode_token($jwt) {
    return JWT::decode($jwt, new key (JWT_KEY, JWT_ALGO));
}

function validate_decodedToken($decodedToken) {    
    $now = new DateTimeImmutable();
    $serverName = $_SERVER['SERVER_NAME'];
    if ($decodedToken->iss !== $serverName ||
        $decodedToken->nbf > $now->getTimestamp() ||
        $decodedToken->exp < $now->getTimestamp()) {
        send_error('error.jwt_invalid_token');
        return false;
    }
    
    return true;
}

function route_request($domain, $params, $body, $user) {
    $routeHandler = "handle_req_".$domain;
    if(function_exists($routeHandler)) {
        $routeHandler($params,$body,$user);
    }else{
        send_error('error.api_no_handler', $domain);
    }
    
}