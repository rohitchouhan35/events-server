<?php

require '../config/dbcon.php';

function getEventList() {
    global $conn;
    $query = "SELECT * FROM events"; 
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => '200',
                'message' => 'Successfully fetched data',
                'data' => $res 
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } 
        else {
            $data = [
                'status' => '404',
                'message' => 'No events listed',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
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
