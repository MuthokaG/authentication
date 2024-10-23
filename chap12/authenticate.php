<?php
session_start();  // Start session

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "lab7_db");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $un = $_POST["username"];
    $pw = $_POST["password"];

    // Prepare the query to prevent SQL injection (without password hashing)
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $un);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    // Directly compare the plain-text passwords (for testing purposes)
    if ($stored_password && $pw == $stored_password) {
        // Correct login: store username in session and redirect
        $_SESSION['username'] = $un;
        header("Location: viewrecords.php"); // Redirect to view records
        exit(); // Make sure to exit after redirection
    } else {
        // Incorrect login
        echo "<p style='color:red;'>Invalid login!</p>";
    }

    // Close statement and connection
    $stmt->close();
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Login Page</h1>
    <form method="POST" action="authenticate.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
        <p> If not already registered<a href="adduser.php"> Register </a>
    </form>
</div>

</body>
</html>
