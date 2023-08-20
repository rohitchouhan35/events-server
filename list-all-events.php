<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

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

// I'm taking the filter parameters in the post request
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
    if (!$query_run) onError(500, 'Internal Server Error');

    $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

    if (empty($res)) onError(404, 'No events listed');

    // this function is defined in './date-filter.php'
    if ($date) $res = filterByDate($date, $res);

    if (empty($res) && $date) onError(404, 'No active or upcoming events on choosen date: ' . $date);
    else if (!empty($res)) onSuccess(200, 'Successfully fetched data', $res);
    else onError(404, 'No events listed');
}
?>
