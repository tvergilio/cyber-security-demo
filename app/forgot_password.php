<?php
require 'db.php';

session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $security_answer = $_POST['security_answer'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND security_answer = ?");
    $stmt->execute([$username, $security_answer]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['reset_user'] = $username;
        header('Location: reset_password.php');
        exit;
    } else {
        $error_message = "Incorrect security answer!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Bank</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="forgot-container">
    <h2 class="forgot-title">Forgot Password</h2>

    <!-- Display error message if the answer is incorrect -->
    <?php if (isset($error_message)): ?>
        <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <form method="POST" class="forgot-form">
        <label for="username" class="forgot-label">Username</label>
        <input type="text" name="username" id="username" class="forgot-input" required>

        <label for="security_answer" class="forgot-label">Answer to your security question</label>
        <input type="text" name="security_answer" id="security_answer" class="forgot-input" required>

        <input type="submit" value="Submit" class="forgot-button">
    </form>
</div>
</body>
</html>
