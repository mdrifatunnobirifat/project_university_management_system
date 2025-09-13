<?php
$host="localhost";
$user="root";
$password="";
$db="university management system";

$conn=mysqli_connect($localhost,$root,$password,$db);


if($conn->connect_error)
{
    die("connection falis".$conn->connect_error);
    
}


?>