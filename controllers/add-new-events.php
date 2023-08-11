<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, OPTIONS, GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include('../services/saveEvent.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST" || $requestMethod == "OPTIONS") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if(empty($inputData)) {
        $eventInput = saveEvent($_POST);
    }
    else {
        $eventInput = saveEvent($inputData);
    }
    echo $eventInput;
} 
else {
    $data = [
        'status' => '405',
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data); 
}
?>