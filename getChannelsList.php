<?php
require 'config.php';
require 'controls/global.php';
require 'database/DAO.php';
header("Content-Type: application/json");

// Variables
$dao = new DAO($config['database']);

$token = isset($_GET['api_key']) ? $_GET['api_key'] : NULL;

if ($token == NULL || $token == "") {
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


$dao->updateLastUsage($token);

$response = [
  'data'=> [],
  'status'=> True
];
$result = $dao->getChannels();

while($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $channel = [
    'id'=> $row['strIdChannel'],
    'name'=> $row['strName'],
    'channel'=> (int)$row['intChannelNumber'],
    'station'=> [
      'id'=> (int)$row['intIdStation'],
      'name'=> $row['strNameStation']
    ]
  ];
  $response['data'][] = $channel;
}

echo json_encode($response, JSON_PRETTY_PRINT);
