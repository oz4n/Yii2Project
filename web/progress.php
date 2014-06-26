<?php
session_start();
 
$key = ini_get("session.upload_progress.prefix") . "frontphotosession";
if (!empty($_SESSION[$key])) {
    $current = $_SESSION[$key]["bytes_processed"];
    $total = $_SESSION[$key]["content_length"];
    $data = $current < $total ? ceil($current / $total * 100) : 100;
    echo json_encode(['data'=>$data]);
}
else {
    echo json_encode(['data'=>100]);
}