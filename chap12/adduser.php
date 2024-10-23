<?php
require 'dbconn.php'; // DB connection

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password); // Store the password as plain text

        if ($stmt->execute()) {
            echo "User registered successfully!";
        } else {
            echo "Error registering user!";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- HTML form for user registration -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Register Page</h1>
    <form method="POST" action="adduser.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Register">
        <p>If already registered <a href="authenticate.php">Login</a></p>
    </form>
</div>

</body>
</html>
