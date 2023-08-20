<?php 

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