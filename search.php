<?php
header('Content-Type: application/json');
include 'database.php';

$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);
$searchKey = $json_obj['searchKey'];
$query = "SELECT username, email FROM users WHERE username = '$searchKey';";
$result = $mysqli->query($query);
error_log("DEBUG QUERY: $query");
if (!$result) {
    error_log("MYSQL ERROR: " . $mysqli->error);
}
$users = array();
while($row = $result->fetch_assoc()) {
    $users[] = $row;
}
echo json_encode($users);
?>