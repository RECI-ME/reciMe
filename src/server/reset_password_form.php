<?php
// Include database connection
require_once 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate token
    $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
    $stmt->execute([$token]);
    $reset = $stmt->fetch();

    if ($reset) {
        // Display reset form
        echo '
            <form action="update_password.php" method="POST">
                <input type="hidden" name="token" value="'.$token.'">
                <input type="password" name="new_password" placeholder="New Password" required>
                <input type="password" name="confirm_new_password" placeholder="Confirm New Password" required>
                <button type="submit">Reset Password</button>
            </form>
        ';
    } else {
        echo 'Invalid or expired token.';
    }
}
?>
