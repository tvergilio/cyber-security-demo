<?php
session_start(); // Start the session

require 'db.php';

$error_message = '';  // Default to no error

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Query the database to find the user
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Check if the user exists and the password matches
    if ($user && $password === $user['password']) {
        // Set session variable to track the logged-in user
        $_SESSION['username'] = $user['username'];

        // Redirect to the homepage
        header('Location: index.php');
        exit;
    } else {
        // Invalid login, set the error message
        $error_message = "Invalid username or password. Please try again.";
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

    <!-- Display the error message, if any -->
    <?php if (!empty($error_message)): ?>
        <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

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
    </form>
</div>
</body>
</html>
