<?php
session_start();
require 'db.php';

// Start output buffering to avoid the "headers already sent" error
ob_start();

if (!isset($_SESSION['reset_user'])) {
    header('Location: forgot_password.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $username = $_SESSION['reset_user'];

    // Update the password (insecure: storing plain text)
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->execute([$new_password, $username]);

    // Display success message
    $success_message = "Password successfully changed! Redirecting to login...";

    // End the session
    session_destroy();

    // Redirect to login page after 3 seconds
    header('Refresh: 3; URL=login.php');
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password - Bank</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="reset-container">
        <h2 class="reset-title">Reset Your Password</h2>

        <!-- Display success message if password has been reset -->
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>

        <form method="POST" class="reset-form">
            <label for="new_password" class="reset-label">New Password</label>
            <input type="password" name="new_password" id="new_password" class="reset-input" required>

            <input type="submit" value="Reset Password" class="reset-button">
        </form>
    </div>
    </body>
    </html>

<?php
// Flush the output buffer and send headers
ob_end_flush();
