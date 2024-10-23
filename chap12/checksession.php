<?php
session_start();
require 'dbconn.php';

if (!isset($_SESSION['username'])) {
    header("Location: unauthorized.php");
    exit();
}

// Fetch user roles from the database
$username = $_SESSION['username'];
$sql = "SELECT role FROM roles WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$roles = [];
while ($row = $result->fetch_assoc()) {
    $roles[] = $row['role'];
}

$stmt->close();


// Check if the user has the required role
if (!in_array('admin', $roles)) {
    header("Location: unauthorized.php");
    exit();
}
