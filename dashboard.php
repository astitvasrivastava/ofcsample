<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $personal_file_number = $_POST['personal_file_number'];
    $serial_file_number = $_POST['serial_file_number'];
    $wrack = $_POST['wrack'];
    $row = $_POST['row'];

    $sql = "INSERT INTO employee_details (name, personal_file_number, serial_file_number, wrack, row) VALUES ('$name', '$personal_file_number', '$serial_file_number', '$wrack', '$row')";
    $conn->query($sql);
}

$sql = "SELECT * FROM employee_details";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="personal_file_number" placeholder="Personal File Number" required>
            <input type="text" name="serial_file_number" placeholder="Serial File Number" required>
            <input type="text" name="wrack" placeholder="Wrack" required>
            <input type="text" name="row" placeholder="Row" required>
            <button type="submit">Add Employee</button>
        </form>
        <button onclick="location.href='add_user.php'">Add User</button>
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
    </div>
</body>
</html>
