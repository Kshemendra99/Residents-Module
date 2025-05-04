<?php
$host = 'localhost';
$db = 'resident_database';
$user = 'root';
$pass = ''; // Change if your MySQL password differs

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
