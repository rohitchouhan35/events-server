<?php
error_reporting(0);
require_once 'header.php';

require './dbcon.php';
require './status/onError.php';
require './status/onSuccess.php';

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
    onError(405, $requestMethod . ' Method Not Allowed');
}

function saveEvent($eventInput) {
    global $conn;

    $event_name = mysqli_real_escape_string($conn, $eventInput['event_name']);
    $start_time = mysqli_real_escape_string($conn, $eventInput['start_time']);  
    $end_time = mysqli_real_escape_string($conn, $eventInput['end_time']);  
    $location = mysqli_real_escape_string($conn, $eventInput['location']);  
    $description = mysqli_real_escape_string($conn, $eventInput['description']);  
    $category = mysqli_real_escape_string($conn, $eventInput['category']);  
    $banner_image = mysqli_real_escape_string($conn, $eventInput['banner_image']);  

    if (
        !isset($eventInput['event_name']) || 
        !isset($eventInput['start_time']) || 
        !isset($eventInput['end_time']) || 
        !isset($eventInput['location']) || 
        !isset($eventInput['description']) || 
        !isset($eventInput['category']) || 
        !isset($eventInput['banner_image'])
    ){
        exit();
        // return error422('Invalid Input');
    }
    else {
        $query = "INSERT INTO events (event_name, start_time, end_time, location, description, category, banner_image) VALUES ('$event_name', '$start_time', '$end_time', '$location', '$description', '$category', '$banner_image')";
        $result = mysqli_query($conn, $query);

        if($result) {
            onSuccess(201, 'Added successfully');
        }
        else {
            onError(500, 'Internal Server Error');
        }
    }
}
?>
