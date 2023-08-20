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
    onError(405, $requestMethod . ' Method Not Allowed');
}

function isCurrentDateSmaller($currentDateStr, $eventDateStr) {
    $currentDate = DateTime::createFromFormat('d/m/Y', $currentDateStr);
    $eventDate = DateTime::createFromFormat('d/m/Y', $eventDateStr);

    if (!$currentDate || !$eventDate) {
        return false;
    }

    return $currentDate < $eventDate;
}

function getEventList($city, $category, $date)
{
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

            if($date) {
                $filteredEvents = array();
                foreach ($res as $event) {
                    if (isCurrentDateSmaller($date, $event['start_time'])) {
                        $filteredEvents[] = $event;
                    }
                }
                $res = $filteredEvents;
            }

            if (!empty($res)) {
                onSuccess(200, 'Successfully fetched data', $res);
            } else {
                onError(404, 'No events listed');
            }
        } else {
            onError(404, 'No events listed');
        }
    } else {
        onError(500, 'Internal Server Error');
    }
}

function onError($status, $message) {
    $data = [
        'status' => $status,
        'message' => $message,
    ];
    header("HTTP/1.0 $status");
    echo json_encode($data);
}

function onSuccess($status, $message, $data) {
    $response = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    header("HTTP/1.0 $status");
    echo json_encode($response);
}
?>
