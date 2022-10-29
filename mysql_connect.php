<?php

$servername = "localhost";
$username = "root";
$password = "abhiram**68";
$dbname = "user";
$conn = mysqli_connect($servername, $username, $password, $dbname );
if (!$conn) {
  die("Database Connection failed: " . mysqli_connect_error() . "<br>");
}
echo "Connected to database successfully<br>";

?>