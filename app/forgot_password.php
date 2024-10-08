<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $security_answer = $_POST['security_answer'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND security_answer = ?");
    $stmt->execute([$username, $security_answer]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['reset_user'] = $username;
        header('Location: reset_password.php');
    } else {
        echo "Incorrect security answer!";
    }
}
?>
<h2>Forgot Password</h2>
<form method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <br>

    <label for="security_answer">Answer to your security question:</label>
    <input type="text" name="security_answer" id="security_answer" required>
    <br>

    <input type="submit" value="Submit">
</form>
