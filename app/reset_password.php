<?php
session_start();
require 'db.php';

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

    echo "Password successfully changed!";
    session_destroy();  // Reset the session
    header('Location: login.php');
}
?>
<form method="POST">
    New Password: <input type="password" name="new_password">
    <input type="submit" value="Reset Password">
</form>
