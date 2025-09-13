<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "university management system"; // keep the space if DB name has space

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
