<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require './dbcon.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    $city = isset($inputData['city']) ? $inputData['city'] : null;
    $category = isset($inputData['category']) ? $inputData['category'] : null;
    $date = isset($inputData['date']) ? $inputData['date'] : null;

    $eventList = getEventList($city, $category, $date);
    echo $eventList;
} else {
    $data = [
        'status' => '405',
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

function getEventList($city, $category, $date) {
    global $conn;

    $query = "SELECT * FROM events WHERE 1";

    if ($city) {
        $query .= " AND location = '$city'";
    }
    if ($category) {
        $query .= " AND category = '$category'";
    }
    
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

        if (!empty($res)) {
            $data = [
                'status' => '200',
                'message' => 'Successfully fetched data',
                'data' => $res,
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => '404',
                'message' => 'No events listed',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => '500',
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}
?>
