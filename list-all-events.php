<?php
require_once 'header.php';

require './dbcon.php';
require './status/onError.php';
require './status/onSuccess.php';
require './date-filter.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod != "POST") {
    onError(405, $requestMethod . ' Method Not Allowed');
}

$inputData = json_decode(file_get_contents("php://input"), true);
$city = isset($inputData['city']) ? $inputData['city'] : null;
$category = isset($inputData['category']) ? $inputData['category'] : null;
$date = isset($inputData['date']) ? $inputData['date'] : null;

$eventList = getEventList($city, $category, $date);
echo $eventList;

function getEventList($city, $category, $date) {
    global $conn;

    $query = "SELECT * FROM events WHERE 1";

    if ($city) {
        $query .= " AND LOWER(location) = LOWER('$city')";
    }
    if ($category) {
        $query .= " AND LOWER(category) = LOWER('$category')";
    }
    
    $query_run = mysqli_query($conn, $query);
    if (!$query_run) onError(500, 'Internal Server Error');

    $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

    if (empty($res)) return onError(404, 'No events to show');

    if ($date) $res = filterByDate($date, $res);
    else return onSuccess(200, 'Successfully fetched data', $res);

    if (empty($res) && $date) onError(404, 'No active or upcoming events on chosen date: ' . $date);
    else return onSuccess(200, 'Successfully fetched data', $res);
}
?>
