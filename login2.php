<?php

include 'database.php';
header('Content-Type: application/json');
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);
$username = $json_obj['username'];
$password = $json_obj['password'];

$query = "SELECT password FROM users WHERE username = '$username'";
$result = $mysqli->query($query);
error_log("DEBUG QUERY: $query");
if (!$result) {
    error_log("MYSQL ERROR: " . $mysqli->error);
}

$pass = $result->fetch_assoc();
if($pass && $pass['password'] === $password) {
    
    $query = "SELECT * FROM messages WHERE recipient = '$username' or sender = '$username'";
    $messages_result = $mysqli->query($query);
    $messages = array();
    while($row = $messages_result->fetch_assoc()) {
        $messages[] = $row;
    }
    echo json_encode(array(
        'username' => $username,
        'messages' => $messages,
        'status' => 'Logged in successfully'
    ));

    
} else {
    echo json_encode(array(
        'status' => 'Login failed'
    ));
}
