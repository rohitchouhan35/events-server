<?php
require_once 'header.php';

require './dbcon.php';
require './status/onError.php';
require './status/onSuccess.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {
    $userList = getUserList();
    echo $userList;
} else {
    onError(405, $requestMethod . ' Method Not Allowed');
}

function getUserList() {
    global $conn;

    $query = "SELECT * FROM users";
    $query_run = mysqli_query($conn, $query);

    if (!$query_run) {
        onError(500, 'Internal Server Error');
    }

    $numRows = mysqli_num_rows($query_run);

    if ($numRows > 0) {
        $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

        onSuccess(200, 'Successfully fetched user data', $res);
    } else {
        onError(404, 'No users listed');
    }
}
?>
