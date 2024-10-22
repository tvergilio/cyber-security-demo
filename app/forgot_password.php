<?php
require 'db.php';

session_start(); // Start the session

$hint = "";  // Initialize the hint variable
$error_message = "";  // Initialize the error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    // Retrieve the security question for the given username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // If the user exists, continue
    if ($user) {
        // Store the security question in a variable for later
        $hint = $user['security_question'];

        // Check if the security answer has been submitted
        if (!empty($_POST['security_answer'])) {
            $security_answer = $_POST['security_answer'];

            // Check if the provided answer matches the one in the database
            if ($security_answer === $user['security_answer']) {
                $_SESSION['reset_user'] = $username;
                header('Location: reset_password.php');
                exit;
            } else {
                $error_message = "Incorrect security answer! Hint: " . htmlspecialchars($hint);
            }
        } else {
            $error_message = "Please provide an answer to the security question.";
        }
    } else {
        $error_message = "Username not found!";
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
    <!-- HSBC Logo -->
    <img src="assets/hsbc.png" alt="Bank Logo" class="bank-logo">

    <h2 class="forgot-title">Forgot Password</h2>

    <!-- Display error message (including the hint if security answer was incorrect) -->
    <?php if (!empty($error_message)): ?>
        <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <form method="POST" class="forgot-form">
        <label for="username" class="forgot-label">Username</label>
        <input type="text" name="username" id="username" class="forgot-input" required value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">

        <!-- Show the security answer input if a username was found -->
        <?php if (!empty($user)): ?>
            <label for="security_answer" class="forgot-label">Answer to your security question</label>
            <input type="text" name="security_answer" id="security_answer" class="forgot-input" required>
        <?php endif; ?>

        <input type="submit" value="Submit" class="forgot-button">
    </form>
</div>
</body>
</html>
