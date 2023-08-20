<?php 

function onError($status, $message) {
    $data = [
        'status' => $status,
        'message' => $message,
    ];
    header("HTTP/1.0 $status");
    echo json_encode($data);
}

function error422($message) {
    $data = [
        'status' => '422',
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
}

?>