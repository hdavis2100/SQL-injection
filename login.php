<?php
include 'database.php';
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $mysqli->query($query);
if($result->num_rows > 0) {
    
    $query = "SELECT * FROM messages WHERE recipient = '$username'";
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