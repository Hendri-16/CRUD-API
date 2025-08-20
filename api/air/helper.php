<?php
function response_json($status, $message, $data = "") {
    http_response_code($status);

    $array_api = [
        'status' => $status,
        'message' => $message,
    ];

    if ($data != "") {
        $array_api['data'] = $data;
    }

    return $array_api;
}

?>