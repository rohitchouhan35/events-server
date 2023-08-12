<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, OPTIONS, GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require './dbcon.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST" || $requestMethod == "OPTIONS") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {
        $userInput = saveUser($_POST);
    } else {
        $userInput = saveUser($inputData);
    }
    echo $userInput;
} else {
    $data = [
        'status' => '405',
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

function saveUser($userInput) {

    global $conn;
    $name = mysqli_real_escape_string($conn, $userInput['name']);
    $email = mysqli_real_escape_string($conn, $userInput['email']);

    if (
        !isset($userInput['name']) ||
        !isset($userInput['email'])
    ) {
        exit();
    } else {
        $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => '201',
                'message' => 'User added successfully',
            ];
            header("HTTP/1.0 201 created");
            return json_encode($data);
        } else {
            $data = [
                'status' => '500',
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}
?>
