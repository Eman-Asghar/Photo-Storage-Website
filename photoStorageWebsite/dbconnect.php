<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photostorage"; // your database name from phpMyAdmin

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
