<?php
require 'config.php';
require 'controls/global.php';
require 'database/DAO.php';
header('Content-Type: application/json');

// Variables
$dao = new DAO($config['database']);

$name = isset($_POST["name"]) ? $_POST["name"] : NULL;
$email = isset($_POST["email"]) ? $_POST["email"] : NULL;
$project_name = isset($_POST["project_name"]) ? $_POST["project_name"] : NULL;
$project_description = isset($_POST["project_description"]) ? $_POST["project_description"] : NULL;

if (!$name || !$email || !$project_name) {
  http_response_code(400);
  $response = [
    'api_key'=> NULL,
    'status'=> False,
    'message'=> 'Some data is missing.'
  ];
  echo json_encode($response, JSON_PRETTY_PRINT);
  die();
}

if (strlen($name) >= 50 || strlen($email) >= 50 || strlen($project_name) >= 100) {
  http_response_code(400);
  $response = [
    'api_key'=> NULL,
    'status'=> False,
    'message'=> 'Some data is malformed.'
  ];
  echo json_encode($response, JSON_PRETTY_PRINT);
  die();
}


$api_key = NULL;
do {
  $api_key = getToken();
} while($dao->existApiKey($api_key)->rowCount());

$result = $dao->setUser($name, $email, $project_name, $project_description, $api_key);

if ($result) {
  $response = [
    'api_key' => $api_key,
    'status' => True
  ];
  echo json_encode($response, JSON_PRETTY_PRINT);
}
else {
  http_response_code(500);
  $response = [
    'api_key'=> NULL,
    'status'=> False,
    'message'=> 'Internal error.'
  ];
  echo json_encode($response, JSON_PRETTY_PRINT);
  die();
}

 ?>
