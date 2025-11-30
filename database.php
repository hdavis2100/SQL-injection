<?php
// Content of database.php

$mysqli = new mysqli('localhost', 'hdavis2100', '0704!987Ftlee', 'toy');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>