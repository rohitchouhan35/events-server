<?php

require '../config/dbcon.php';

function error422($message) {
    $data = [
        'status' => '422',
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable");
    echo json_encode($data);
    exit();
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
            $data = [
                'status' => '201',
                'message' => 'added successfully',
            ];
            header("HTTP/1.0 201 created");
            return json_encode($data);
        }
        else {
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
