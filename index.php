<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_login WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $username;

        // Log user login
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $login_time = date("Y-m-d H:i:s");
        $sql_log = "INSERT INTO user_log (username, login_time, ip_address) VALUES ('$username', '$login_time', '$ip_address')";
        $conn->query($sql_log);

        header('Location: search.php');
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User Login</title>
</head>
<body>
    <div class="login-container">
        <form method="POST" action="">
            <h2>User Login</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
