<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST['search_query'];

    $sql = "SELECT * FROM employee_details WHERE name LIKE '%$search_query%' OR id='$search_query'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Search Employee</title>
</head>
<body>
    <div class="search-container">
        <form method="POST" action="">
            <h2>Search Employee</h2>
            <input type="text" name="search_query" placeholder="Enter name or ID" required>
            <button type="submit">Search</button>
        </form>

        <?php if (isset($result) && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Personal File Number</th>
                        <th>Serial File Number</th>
                        <th>Wrack</th>
                        <th>Row</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['personal_file_number'] ?></td>
                            <td><?= $row['serial_file_number'] ?></td>
                            <td><?= $row['wrack'] ?></td>
                            <td><?= $row['row'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php elseif (isset($result)): ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
