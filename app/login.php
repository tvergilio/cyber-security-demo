<?php
session_start(); // Start the session

require 'db.php'; // Include database connection
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to find the user
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Check if the user exists and the password matches
    if ($user && $password === $user['password']) {
        // Set the session variable for the logged-in user
        $_SESSION['username'] = $user['username'];

        // Redirect to index.php after successful login
        header('Location: index.php');
        exit;
    } else {
        echo "<p style='color:red;'>Invalid username or password. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <!-- HSBC Logo -->
    <img src="assets/hsbc.png" alt="HSBC Logo" class="bank-logo">

    <form method="POST" action="login.php" class="login-form">
        <h2 class="login-title">Log into Your Account</h2>

        <label for="username" class="login-label">Username</label>
        <input type="text" name="username" id="username" class="login-input" required>

        <label for="password" class="login-label">Password</label>
        <input type="password" name="password" id="password" class="login-input" required>

        <p class="forgot-link">
            <a href="forgot_password.php">Forgot your password?</a>
        </p>

        <input type="submit" value="Login" class="login-button">

        <p class="logout-link">
            <a href="logout.php">Logout</a>
        </p>
    </form>
</div>
</body>
</html>
