<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sweatzone";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        "status" => false,
        "message" => "Database connection failed"
    ]);
    exit;
}
