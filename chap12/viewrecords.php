<?php
require 'checksession.php';

// Fetch and display records from the classics table
$result = $conn->query("SELECT * FROM classics");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classics Records</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <!-- Logout Button -->
<div class="logout">
    <form action="logout.php" method="post">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>
    <h1>Classics</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
        </tr>

        <?php
        // Display table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['author']) . "</td>";
            echo "<td>" . htmlspecialchars($row['year_published']) . "</td>";
            echo "</tr>";
        }
        ?>

    </table>
</div>

<?php
$conn->close();
?>

</body>
</html>
