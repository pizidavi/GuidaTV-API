<?php
require 'config.php';
require 'controls/global.php';
require 'database/DAO.php';
header("Content-Type: application/json");

// Variables
$dao = new DAO($config['database']);

$token = isset($_GET['api_key']) ? $_GET['api_key'] : NULL;
$channelId = isset($_GET["channelId"]) ? $_GET["channelId"] : NULL;
$date = isset($_GET["date"]) ? $_GET["date"] : date("d-m-Y");

if ($token == NULL || $token == '') {
  http_response_code(400);
  $response = [
    'data'=> NULL,
    'status'=> False,
    'message'=> 'api_key is missing.'
  ];
  echo json_encode($response, JSON_PRETTY_PRINT);
  die();
}

$result = $dao->getUser($token);
if ($result->rowCount() == 0) {
  http_response_code(403);
  $response = [
    'data'=> NULL,
    'status'=> False,
    'message'=> 'api_key not valid.'
  ];
  echo json_encode($response, JSON_PRETTY_PRINT);
  die();
}

if ($channelId == NULL || $channelId == '') {
  http_response_code(400);
  $response = [
    'data'=> NULL,
    'status'=> False,
    'message'=> 'channelId is missing.'
  ];
  echo json_encode($response, JSON_PRETTY_PRINT);
  die();
}

$dao->updateLastUsage($token);

$result = $dao->getChannel($channelId);
if ($result->rowCount() > 0) {
  $row = $result->fetch(PDO::FETCH_ASSOC);

  require 'schedules/'.$row['station'].'.php';
  $station = new $row['station']();

  $result = $station->getSchedule($row['id'], $row['name'], $date);
  if ($result !== NULL) {
    $response = [
      'data'=> $result,
      'status'=> True
    ];
    echo json_encode($response, JSON_PRETTY_PRINT);
  }
  else {
    print_r($result);
    http_response_code(451);
    $response = [
      'data'=> NULL,
      'status'=> False,
      'message'=> 'General Error'
    ];
    echo json_encode($response, JSON_PRETTY_PRINT);
    die();
  }
}
else {
  http_response_code(404);
  $response = [
    'data'=> NULL,
    'status'=> False,
    'message'=> 'ChannelId not found.'
  ];
  echo json_encode($response, JSON_PRETTY_PRINT);
  die();
}
