<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "university management system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

return $conn;

?>
