<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require './dbcon.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {
    $userList = getUserList();
    echo $userList;
} else {
    $data = [
        'status' => '405',
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

function getUserList() {
    global $conn;
    $query = "SELECT * FROM users";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => '200',
                'message' => 'Successfully fetched user data',
                'data' => $res 
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } 
        else {
            $data = [
                'status' => '404',
                'message' => 'No users listed',
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

?>
