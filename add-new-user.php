<?php
error_reporting(0);
require_once 'header.php';

require './dbcon.php';
require './status/onError.php';
require './status/onSuccess.php';

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
    onError(405, $requestMethod . ' Method Not Allowed');
}

function saveUser($userInput) {
    global $conn;

    $name = mysqli_real_escape_string($conn, $userInput['name']);
    $email = mysqli_real_escape_string($conn, $userInput['email']);

    if (
        !isset($userInput['name']) ||
        !isset($userInput['email'])
    ) {
        onError(400, 'Invalid Input');
    } else {
        $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            onSuccess(201, 'User added successfully');
        } else {
            onError(500, 'Internal Server Error');
        }
    }
}
?>
