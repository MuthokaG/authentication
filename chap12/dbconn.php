<?php
// Database connection settings
$host = 'localhost';  // Replace with your database host
$db   = 'lab7_db';  // Replace with your database name
$user = 'root';  // Replace with your database username
$pass = '';  // Replace with your database password

// Create a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set the character set to UTF-8
$conn->set_charset("utf8");
?>
